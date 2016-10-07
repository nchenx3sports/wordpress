(function($){
    $(document).on("ready", function() {
    // allow for debug mode where CR is treated as readonly
    if(localStorage['readonly']) {
        $.post = function(){
            console.log('POST to CR: ', arguments);
            return $.Deferred().resolve({});
        };
        $.ajax = function(){
            console.log('POST to CR: ', arguments);
            return $.Deferred().resolve({});
        };
    }

    // Helpers for doing some date math and lookups
    Date.prototype.addDays = function(days){
        var tmp = new Date(this);
        return new Date(tmp.setDate(tmp.getDate() + days));
    }
    Date.prototype.addHours = function(hours){
        var tmp = new Date(this);
        return new Date(tmp.setHours(tmp.getHours() + hours));
    }
    Date.prototype.addMinutes = function(minutes){
        var tmp = new Date(this);
        return new Date(tmp.setMinutes(tmp.getMinutes() + minutes));
    }
    var days = "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(' ');
    var months = "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(' ');

    var self_signup_disallowed_classes = ["689", "626"];


    // Helper functions for sorting and processing lists
    var sortByDate = function(a,b){return a.datetime - b.datetime;}
    var sortByTextProperty = function(a,b){
        if(a.text && a.text.toLowerCase() == 'other') return 1;
        if(b.text && b.text.toLowerCase() == 'other') return -1;
        return a.text == b.text ? 0 : a.text > b.text ? 1 : -1;}
    var uniqByValueProperty = function(a){return a.value;}
    var emptyTextEntries = function(a){return !a.text; }

    // Helper to allow us to override text from ClubReady
    var display_text = function(str){ return  text_overrides[str] || str; }
    var text_overrides = {
        "X3 Sports Marietta": "Marietta",
        "X3 Sports Inman Park": "Inman Park Atlanta",
        "X3 Sports West Midtown": "West Midtown Atlanta"
    };

    var cache = _.memoize(function(timeout, func){
        return function(){
        var key = JSON.stringify(arguments);
        var saved_value = localStorage[key];
        if(saved_value){
            saved_value = JSON.parse(saved_value);
            if(new Date(saved_value.expiration) > new Date()){
            if(saved_value.deferred){
                var deferred = $.Deferred();
                _.defer(function(){deferred.resolve(saved_value.value)})
                return deferred;
            } else { return saved_value.value; }
            }
        }

        var response = func.apply(this, arguments);
        saved_value = {expiration: new Date().addMinutes(timeout), value: response, deferred: false};
        if(response.then){
            response.then(function(response){
            saved_value.deferred = true;
            saved_value.value = response;
            localStorage[key] = JSON.stringify(saved_value);
            });
        } else {
            localStorage[key] = JSON.stringify(saved_value);
        }

        return response;
        };
    }, function(){return JSON.stringify(arguments)});

    

    // ClubReady Api Adapter
    var ClubReadyAPI = {

        // memoized adapter to make API GET requests
        get: cache(30, function(url, data){
        return $.ajax({url: '/clubready.php', dataType: 'json', data: _.extend({ChainId: 8, url: url}, data)});
        }),
        post: function(url, data){
        return $.ajax({url: '/clubready.php', type: 'post', dataType: 'json', data: _.extend({ChainId: 8, url: url}, data)});
        },

        // List all locations
        get_clubs_list: function(){return ClubReadyAPI.get('http://www.clubready.com/api/corp/{chainId}/clubs') },

        // Get a flatened schedule of a specific location
        get_club_schedule: function(club){

        // Function to project values for display of a class
        //   nested here to capture `club` to project the location name on each class
        var cutoff = new Date().addHours(4);
        var toInt = function(x){ return parseInt(x, 10)};
        var asClassViewModel = function(entry){
            // Add a real datetime for computations
            var date_parts = _(entry.Date.split('-')).map(toInt);
            var time_parts = entry.StartTime.split(' ');
            var pm = time_parts[1].toLowerCase() == 'pm';
            time_parts = _(time_parts[0].split(':')).map(toInt);
            time_parts[0] = (time_parts[0] % 12) + (pm ? 12 : 0); // To 24-hour time format
            entry.datetime = new Date(date_parts[2], date_parts[0]-1, date_parts[1], time_parts[0], time_parts[1]);

            // Is the class available for online singup
            entry.available = entry.datetime > cutoff ? "enabled" : "disabled";

            // Instructor Display Name
            if(entry.InstructorFirstName){
            entry.InstructorShortName = entry.InstructorFirstName + " " + entry.InstructorLastName[0] + ".";
            }

            // Location Name of class
            entry.location = display_text(club.Name);
            return entry;
        }

        // base URL for API query
        var classScheduleUrl = 'http://www.clubready.com/api/scheduling/class-schedule';

        // schedule for this location, this week
        var thisWeek= new Date();
        var thisWeekScheduleRequest = ClubReadyAPI.get(classScheduleUrl,
                { StoreId: club.Id, FromDate: thisWeek.toDateString(), ToDate: thisWeek.addDays(6).toDateString() })
                // mark classes as 'this week'
            .then(function(entries){ return _(entries).map(function(entry){ entry.week = 'thisweek'; return entry; }) });

        // schedule for this location, next week
        var nextWeek = thisWeek.addDays(7);
        var nextWeekScheduleRequest = ClubReadyAPI.get(classScheduleUrl,
                { StoreId: club.Id, FromDate: nextWeek.toDateString(), ToDate: nextWeek.addDays(6).toDateString() })
            // mark classes as 'next week'
            .then(function(entries){ return _.map(entries, function(entry){ entry.week = 'nextweek'; return entry; }) });

        // Synchronize on the two async requests
        return $.when(thisWeekScheduleRequest, nextWeekScheduleRequest).then(function(thisWeekSchedule, nextWeekSchedule){

            // concatenate the two schedules and project each class as a view model
            return _(thisWeekSchedule.concat(nextWeekSchedule)).chain().map(asClassViewModel).value();
        });
        },

        // Get a flattened schedule of all locations
        get_full_schedule: function(filter){
        // Get a list of the locations
        return ClubReadyAPI.get_clubs_list().then(function(clubs_list){

            // Keep track of each request
            var club_schedule_requests = [];

            // Request each club's schedule
            $(clubs_list).each(function(i, club){
            // Register the request to synchronize on later
            club_schedule_requests.push(ClubReadyAPI.get_club_schedule(club));
            });

            // Synchronize on the requests
            return $.when.apply(null, club_schedule_requests).then(function(){
            // for readability
            var array = [];

            // convert the arguments into an array
            var club_schedules = _.toArray(arguments).slice();

            // Concatenate all the schedules, sort by date/time
            var sorted_schedule = array.concat.apply(array, club_schedules).sort(sortByDate);

            // Optionally filter by provided predicate
            if(filter) sorted_schedule = _(sorted_schedule).filter(filter);

            return sorted_schedule;
            })
        });
        },

        // Get the schedule of all locations, grouped by Date
        get_full_schedule_by_date: function(filter){
        // Get the flattened schedule
        return ClubReadyAPI.get_full_schedule().then(function(sorted_schedule){
            // Container for new grouping
            var schedule_by_day = [];

            // today's date for comparison
            var today = new Date().toDateString();

            // Trackers for segmentation
            var previousDate, currentSet, currentWeek;

            // Loop over the classes in the schedule
            for(var i=0, j=sorted_schedule.length; i<j; i++){
            var entry = sorted_schedule[i];

            // If we are on a 'new' date
            if(previousDate != entry.Date){

                // Get the Display Name for the day
                var day = entry.datetime.toDateString() == today ? 'Today' : days[entry.datetime.getDay()]

                // create a new set
                currentSet = {
                title: day + ", " + (months[entry.datetime.getMonth()]) + " " + entry.datetime.getDate(),
                week: entry.week,
                on: currentWeek != entry.week ? "on" : "",
                entries: []
                };

                // add it to the list
                schedule_by_day.push(currentSet);

                // update date trackers
                previousDate = entry.Date;
                currentWeek = entry.week;
            }

            // Add the class to the current date set
            if(!filter || filter(entry)) currentSet.entries.push(entry);
            }
            return schedule_by_day;
        });
        },

        get_referral_types: function(store_id){
        var deferred = $.Deferred();
        deferred.resolve([{ Id: 48944, Name: "Indicard" }, { Id: 48376, Name: "Yelp" }, { Id: 48375, Name: "Waze" }, { Id: 48374, Name: "X3 Member" }, { Id: 14882, Name: "X3 Employee" }, { Id: 48223, Name: "Snapchat" }, { Id: 15227, Name: "Flyer" }, { Id: 15229, Name: "Internet Search" }, { Id: 47619, Name: "Internet Ad" }, { Id: 14881, Name: "Local Event" }, { Id: 15839, Name: "Facebook" }, { Id: 36625, Name: "Twitter" }, { Id: 36626, Name: "Instagram" }, { Id: 15228, Name: "Friend (Non-Member)" },{Id: 14883, Name: "Other" } ]);
        return deferred;
        },

        get_employee_types: function(store_id){
        var deferred = $.Deferred();
        deferred.resolve([{ Id: "Bruce Clem", Name: "Bruce Clem" }, { Id: "Scott Williams", Name: "Scott Williams" }, { Id: "Ilona Shenderovich", Name: "Ilona Shenderovich" }, { Id: "Lael Lasha", Name: "Lael Lasha" }, { Id: "Tristan Shonfelt", Name: "Tristan Shonfelt" }, { Id: "James Young", Name: "James Young" }, { Id: "Dae Smith", Name: "Dae Smith" }, { Id: "Laura Broomfield", Name: "Laura Broomfield" }, { Id: "Reills Reichwein", Name: "Reills Reichwein" }, { Id: "Brett Smith", Name: "Brett Smith" }, { Id: "April Owens", Name: "April Owens" }, { Id: "Leo Brown", Name: "Leo Brown" }, { Id: "Rosevelt Watson", Name: "Rosevelt Watson" }, { Id: "Demetry Young", Name: "Demetry Young" }, { Id: "Don Johnson", Name: "Don Johnson" }, { Id: "Rasheed Williams", Name: "Rasheed Williams" }, { Id: "Joel Toledo", Name: "Joel Toledo" }, { Id: "Jason Barnes", Name: "Jason Barnes" }, { Id: "Jeanette Kunitz", Name: "Jeanette Kunitz" }, { Id: "Doug Killingsworth", Name: "Doug Killingsworth" }, { Id: "Paul Gibson", Name: "Paul Gibson" }, { Id: "Ben Allen", Name: "Ben Allen" }, { Id: "No, I have not spoken to an employee.", Name: "No, I have not spoken to an employee." }]);
        return deferred;
        },

        get_prospect_types: function(store_id){
        var deferred = $.Deferred();

        var values = {
            231: [{Id: 771, Name: "Unscheduled"}, {Id: 772, Name: "Scheduled"}],
            230: [{Id: 834, Name: "Unscheduled"}, {Id: 835, Name: "Scheduled"}],
            994: [{Id: 5272, Name: "Unscheduled"}, {Id: 5273, Name: "Scheduled"}],
        };
        deferred.resolve(values[store_id]);
        return deferred;
        },

        // register a new prospect in Club Ready
        save_prospect: function(prospect_data){
        if(prospect_data.StoreId && prospect_data.StoreId.toLowerCase() == 'not sure') prospect_data.StoreId = "231,230,994";
        return ClubReadyAPI.post('http://www.clubready.com/api/users/prospect', _.extend({}, ClubReadyAPI.common_data, prospect_data));
        },

        schedule_prospect: function(booking_data){
        return ClubReadyAPI.post('http://www.clubready.com/api/scheduling/class-booking', _.extend({}, ClubReadyAPI.common_data, booking_data));
        },

        // search through existing users
        check_existing_user: function(data){
        
        return ClubReadyAPI.get('http://www.clubready.com/api/users/find/', data);
        }
    };
    
    //HubSpot API
    var HS_API = {        
            //Subit the form to HubSpot
            submit_form: function(prospect_data) {
                var data = {
                    "firstname": prospect_data.FirstName,
                    "lastname": prospect_data.LastName,
                    "email": prospect_data.Email,
                    "phone": prospect_data.Phone,
                    "locations": prospect_data.Location,
                    "comments": prospect_data.Note
                };
                return $.post( "/hubspot.php", data );
            }
    };

    




    // Schedule Page
    if ($('section.schedule').not('.signup').length) {

        // Show the location values in the dropdown
        ClubReadyAPI.get_clubs_list().then(function(clubs_list){
        var locationOptions = $(clubs_list).map(function(i,c){return {text: display_text(c.Name), value: c.Id}}).get();
        $('#filter-location').ddslick('data', locationOptions);
        })

        // Show the class and instructor values in the dropdowns
        ClubReadyAPI.get_full_schedule().then(function(schedule){
        var classOptions = _(schedule).chain().map(function(e){return {text: e.Title, value: e.ClassId}})
            // sort by text, uniq on classId, reject empty text values
            .sort(sortByTextProperty).uniq(true, uniqByValueProperty).reject(emptyTextEntries)
            // rollup classes with the same name but different classIds
            .reduce(function(memo, e){
                if(memo.last.text == e.text){memo.last.value+=','+e.value}
                else { memo.last = e; memo.list.push(e); }
                return memo;
            }, {list:[], last: {}}).value().list;
        $('#filter-class').ddslick('data', classOptions);

        var instructorOptions = _(schedule).chain().map(function(e){return {text: e.InstructorShortName, value: e.InstructorId}})
            // sort by text, uniq on instructorId, reject empty text values
            .sort(sortByTextProperty).uniq(uniqByValueProperty).reject(emptyTextEntries)
            // rollup instructors with the same name but different instructorIds
            .reduce(function(memo, e){
                if(memo.last.text == e.text){memo.last.value+=','+e.value}
                else { memo.last = e; memo.list.push(e); }
                return memo;
            }, {list:[], last: {}}).value().list;
        $('#filter-instructor').ddslick('data', instructorOptions);
        })

        // Render the Class Schedule
        ClubReadyAPI.get_full_schedule_by_date().then(function(scheduleByDate){
        $('#days-list').html(Handlebars.compile($('#schedule-template').html())(scheduleByDate));
        //daysNav.first().click();
        showWeek('thisweek');
        $('article.loading').removeClass('loading');
        $('section.schedule').trigger('schedule-loaded');
        })

        // Hookup listeners to buttons for switching displayed days
        var showWeek = function(week){
        daysNav.parent().removeClass('disabled').end().filter('[data-week="'+week+'"]').parent().addClass('disabled');
        $('.day-list').addClass('hidden').filter('[data-week="'+week+'"]').removeClass('hidden');
        }
        var daysNav = $('.days-nav a').on('click', function(){
        var week = $(this).data().week;
        showWeek(week);
        if($(this).hasClass('bottom')) $(window).scrollTop($('#days-list').offset().top);
        return false;
        });
    }



    // Signup Callout
    if ($('.callout.signup, .schedule.signup').length){

        var signupLocation = $('#signup-location');
        var signupClass = $('#signup-class');
        var signupSource =  $('#sign-up-source');
        var employeeReferral = $('#spoken-to-an-employee');

        // Show the location values in the dropdown
        ClubReadyAPI.get_clubs_list().then(function(clubs_list){
        var locationOptions = $(clubs_list).map(function(i,c){return {text: display_text(c.Name), value: c.Id}}).get();
        signupLocation.ddslick('data', locationOptions);
        })

        // Show the class values in the dropdowns
        ClubReadyAPI.get_full_schedule().then(function(schedule){
        var classOptions = _(schedule).chain().map(function(e){return {text: e.Title, value: e.ClassId}})
            // sort by text, uniq on classId, reject empty text values
            .sort(sortByTextProperty).uniq(true, uniqByValueProperty).reject(emptyTextEntries)
            // rollup classes with the same name but different classIds
            .reduce(function(memo, e){
                if(memo.last.text == e.text){memo.last.value+=','+e.value}
                else { memo.last = e; memo.list.push(e); }
                return memo;
            }, {list:[], last: {}}).value().list;
        signupClass.ddslick('data', classOptions);
        })

        ClubReadyAPI.get_referral_types().then(function(employee_types){
        var employee_options = _(employee_types).chain().map(function(e){return {text: e.Name, value: e.Id}}).sort(sortByTextProperty).value();
        signupSource.ddslick('data', employee_options);
        })

        // ssss

        // if signup class is changed to advanced boxing,
        // remove option for self reservations
        $('#signup-class').change(function() {
        var classes_disallowed = _.intersection($(this).val().split(','), self_signup_disallowed_classes).length
        if (classes_disallowed) {
            $('#schedule-method-self').parent().hide();
            $('p.no-self-schedule').show();
            $('#schedule-method-contact').click();
        } else {
            $('#schedule-method-self').parent().show();
            $('p.no-self-schedule').hide();
        }
        });


        $('.signup.training form').submit(function(){


        // validate required class preference selection
        var ms = $('#membership-status');

        if( !ms.val()){
            missing_required = true;
            ms.parents('.dd-container').addClass('error');
            return false;
        }


        // validate required class preference selection
        var sus = $('#sign-up-source');

        if( !sus.val() || sus.val() == 0 ){
            missing_required = true;
            sus.parents('.dd-container').addClass('error');
            return false;
        }


        var locations = {
            '231':'Inman Park Atlanta',
            '230':'Marietta',
            '994': 'West Midtown Atlanta'
        };

        var trainers = {
            '231': 'X3inmanpark@X3sports.com',
            '230': 'X3marietta@x3sports.com',
            '994': 'X3westmidtown@X3sports.com'      
        };

        var trainingLeads = {
            '231':'4753',
            '230': '20103',
            '994': '20104'
        };


        // Validation Clear Check

        if($('form .error').length == 0){

            var data = {
                "Email": $('#sign-up-email').val(), 
                "FirstName": $('#sign-up-first-name').val(),
                "LastName": $('#sign-up-last-name').val(),
                "Phone": $('#sign-up-phone').val(),
                "StoreId": $('#sign-up-location').val(),
                "Membership": $('#membership-status').val(),
                "HearAboutUs": $('#sign-up-source').val(),
                "Goals": $('#sign-up-goals').val(),
                'ToEmail': trainers[$('#sign-up-location').val()],
                'Notes': "New user created from training assesment."
            };

            if(trainingLeads[data['StoreId']])
                data['ProspectTypeID'] = trainingLeads[data['StoreId']];

            if(!trainers[data['StoreId']])
                data['ToEmail'] = trainers['231'] + ', ' + trainers['230'] + ', ' + trainers['994'];

            var data_check = {"Email": $('#sign-up-email').val()};

            ClubReadyAPI.check_existing_user(data_check).then(function(response){

            var users = response.users,
                userLength = response.users.length,
                userExists = false;
            

            for(var i = 0; i < userLength; i++){
                

                if(users[i].Email == data.Email){
                userExists = true;

                break;
                }

            }

            if(!userExists){
                data['SendEmail'] = 'False';

                ClubReadyAPI.save_prospect(data).then(function(){
                
                console.log('new user created');

                });

            }

            ClubReadyAPI.get_referral_types().then(function(referral_types){

                var searchObjectArray = function search(value, searchParam, myArray, returnParam){

                    for (var i=0; i < myArray.length; i++) {

                        console.log(myArray[i][searchParam]);
                        if (myArray[i][searchParam] == value) {
                            return myArray[i][returnParam];
                        }

                    }

                }
                console.log('initial: ' + data['HearAboutUs']);
                data['HearAboutUs'] = searchObjectArray(data['HearAboutUs'],'Id', referral_types, 'Name');
                console.log(searchObjectArray(data['HearAboutUs'],'Id', referral_types, 'Name'));
                data['StoreId'] = locations[data['StoreId']];
                
                $.ajax({url: '/training-assesment-mail.php', type: 'post', data: data}).success(function(){
                window.location = '/thank-you';
                });

            

            });

            
        

        

    
        });

    }

    });





        // hook into the form submit action
        $('.callout.signup form').submit(function(e){


        

        // validate required text fields
        var missing_required = false,
            validation_message = $('#validation-message').hide();
        $(this).find('input[type="text"]').each(function(){
            if(!$(this).val()){
            missing_required = true;
            $(this).addClass('error');
            }
        });

        // validate required location selection
        var loc = $('#signup-location');
        if( !loc.val() ) {
            missing_required = true;
            loc.parents('.dd-container').addClass('error');
        }

        // validate required class preference selection
        var cls = $('#signup-class');
        if( !cls.val() ){
            missing_required = true;
            cls.parents('.dd-container').addClass('error');
        }


        // show validation message if required field(s) left blank & return
        if(missing_required){
            validation_message
            .text("Some information appears to be missing. Please update the needed fields and try again.")
            .slideDown(250);
            return false;
        }

        // validate full phone number
        var phn = $('#signup-phone');
        if (phn.val().replace(/[^\d]/g, '').length != 10){
            phn.addClass('error');
            validation_message
            .text("Please provide a 10 digit phone number.")
            .slideDown(250);
            return false;
        }

        // validate reserve spot and location selections make sense
        if($('#schedule-method-self').is(':checked') && loc.val().toLowerCase() == 'not sure'){
            loc.parents('.dd-container').addClass('error');
            validation_message
            .text("Please select a specific location to reserve spot yourself.")
            .slideDown(250);
            return false;
        }

        // passed validation. See if we can submit directly to CR
        if($('#schedule-method-contact').is(':checked')){

            var self_scheduled = false;
            var notes = [];
            var selected_class = $('.dd-option-value[value="' + $('#signup-class').val() + '"]').first().next('label').text()
            notes.push("Class Preference: " +  selected_class + ", self-scheduled: " + (self_scheduled ? "Yes" : "No"));
        var goals,
            promo;
        if(goals = $('#sign-up-goals').val()) notes.push("Goals: " + goals);
        if(promo = $('#sign-up-promo').val()) notes.push("Promo Code: " + promo);

            var prospect_data = {
            FirstName: $('#signup-firstname').val(),
            LastName: $('#signup-lastname').val(),
            Email: $('#signup-email').val(),
            Phone: $('#signup-phone').val(),
            StoreId: $('#signup-location').val(),
            SendEmail: 'False',
            Note: notes.join("\n\n")
            };
            var referral_type;
        
        if(referral_type = $('#sign-up-source').val()) prospect_data.ReferralTypeId = referral_type;
        if(employee_type = $('#spoken-to-an-employee').val()) notes.push("Employee Referral: " + employee_type);

            // Get a list of the prospect types for the location so we can set the
            // prospect as either "Scheduled" or "Unscheduled"
            ClubReadyAPI.get_prospect_types(prospect_data.StoreId).then(function(prospect_types){

            // Lookup the Id of the appropriate prospect type
            if(prospect_types)
                prospect_data.ProspectTypeId = _(prospect_types).find(function(type){ return type.Name == (self_scheduled ? "Scheduled" : "Unscheduled")}).Id;

            ClubReadyAPI.save_prospect(prospect_data).then(function(){
                window.location = '/thank-you';
            })
            })
            return false;

        }

        }).find('input,select,texarea').change(function(){
        $(this).parents('.error').andSelf().removeClass('error');
        })
    }




    // Signup Page
    if ($('section.signup').length) {

        var signupLocation = $('#sign-up-location');
        var signupClass = $('#sign-up-class');
        var scheduleSelf = $('#schedule-method-self');
        var signupSource = $('#sign-up-source');
        var employeeReferral = $('#spoken-to-an-employee');

        // Show the location values in the dropdown
        ClubReadyAPI.get_clubs_list().then(function(clubs_list){
        var locationOptions = $(clubs_list).map(function(i,c){return {text: display_text(c.Name), value: c.Id}}).get();
        signupLocation.ddslick('data', locationOptions);
        var initial_value = signupLocation.data('initialvalue');
        if(initial_value) signupLocation.ddslick('select', {id: initial_value});
        })

        // Show the class values in the dropdowns
        ClubReadyAPI.get_full_schedule().then(function(schedule){
        var classOptions = _(schedule).chain().map(function(e){return {text: e.Title, value: e.ClassId}})
            // sort by text, uniq on classId, reject empty text values
            .sort(sortByTextProperty).uniq(true, uniqByValueProperty).reject(emptyTextEntries)
            // rollup classes with the same name but different classIds
            .reduce(function(memo, e){
                if(memo.last.text == e.text){memo.last.value+=','+e.value}
                else { memo.last = e; memo.list.push(e); }
                return memo;
            }, {list:[], last: {}}).value().list;
        signupClass.ddslick('data', classOptions);
        var initial_value = signupClass.data('initialvalue');
        if(initial_value) signupClass.ddslick('select', {id: initial_value});
        })

        ClubReadyAPI.get_referral_types().then(function(referral_types){
        var referral_options = _(referral_types).chain().map(function(e){return {text: e.Name, value: e.Id}}).sort(sortByTextProperty).value();
        signupSource.ddslick('data', referral_options);
        var source = decodeURIComponent(window.location.search.match(/sign-up-source=([^&]+)/g));
        if(source)
            var initial_value = source.split('=')[1];

        if(initial_value) signupSource.ddslick('select', {id: initial_value});
        })

        ClubReadyAPI.get_employee_types().then(function(employee_types){
        var employee_options = _(employee_types).chain().map(function(e){return {text: e.Name, value: e.Id}}).sort(sortByTextProperty).value();
        employeeReferral.ddslick('data', employee_options);
        var source = decodeURIComponent(window.location.search.match(/spoken-to-an-employee=([^&]+)/g));
        
        if(source)
            var initial_value = source.replace(/\+/g, ' ').split('=')[1];

        if(initial_value) employeeReferral.ddslick('select', {id: initial_value});
        })


        // function to show/hide text regarding choosing a class
        var update_helpful_text = function(){
        if( scheduleSelf.is(':checked') && !$('input[name="ScheduleId"]:checked').length ){
            $('form p.cta').slideDown(250);
        } else {
            $('form p.cta').slideUp(250);
        }
        }
        $('input,textarea').on('change', update_helpful_text);

        // Helper function to generate a filter function to limit the classes to only those matching the form selections
        var filterBySelections = function(){
        var selectedLocation = signupLocation.val();
        var selectedClasses = _(signupClass.val().split(','));

        return function(entry){
            return selectedClasses.contains(''+entry.ClassId) && entry.ClubId == selectedLocation && entry.available != 'disabled';
        }
        }

        // Function to redraw the schedule portion of the form
        var update_schedule_view = function(){
        if (signupClass.val()) {
            var classes_disallowed = _.intersection(signupClass.val().split(','), self_signup_disallowed_classes).length
            if (classes_disallowed) {
            scheduleSelf.parent().hide();
            $('p.no-self-schedule').show();
            $('#schedule-method-contact').click();
            return;
            } else {
            scheduleSelf.parent().show();
            $('p.no-self-schedule').hide();
            }
        }

        // If all values are not provided, remove the schedule
        if( !signupLocation.val() || signupLocation.val().toLowerCase() == 'not sure' || !signupClass.val() || !scheduleSelf.is(':checked')){
            $('article .day-list, .user-info > h2,  .user-info > p').slideUp(250, function(){
                $('#days-list').empty()
            });
            $('.days-nav').addClass('hidden');
            return;
        }

        $('article.loading').addClass('loading');

        // Get the schedule, filtered by selections
        ClubReadyAPI.get_full_schedule_by_date(filterBySelections()).then(function(scheduleByDate){

            // render the updated schedule options
            $('#days-list').empty().html(Handlebars.compile($('#schedule-template').html())(scheduleByDate));
            $('article.loading').removeClass('loading');

            // show the schedule options
            $('article .day-list, .user-info > h2').slideDown(250);
            $('.days-nav').removeClass('hidden');

            showWeek('thisweek');

            $('input[name="ScheduleId"]').on('change', update_helpful_text);

            $('section.signup').trigger('schedule-loaded');
        })
        }

        // Register schedule rendering on changes to pertinent fields
        $('#sign-up-class,#sign-up-location,input[name="schedule-method"]').change( update_schedule_view );

        // Function to toggle which days of the schedule are being shown
        var showWeek = function(week){
        daysNav.parent().removeClass('disabled').end().filter('[data-week="'+week+'"]').parent().addClass('disabled');
        $('.day-list').addClass('hidden').filter('[data-week="'+week+'"]').removeClass('hidden');
        }

        // Hookup listeners to buttons for switching displayed days
        var daysNav = $('.days-nav a').on('click', function(){
        showWeek($(this).data().week);
        if($(this).hasClass('bottom')) $(window).scrollTop($('#days-list').offset().top);
        return false;
        });

        // If a scheduleId is provided in the URL
        var match;
        if(match = window.location.hash.match(/scheduleId=(\d+)/)){
        var requestedScheduleId = parseInt(match[1],10);
        // Pull the schedule (we keep it locally, don't worry)
        ClubReadyAPI.get_full_schedule().then(function(schedule){
            // Extract the requested Class
            var requestedClass = _(schedule).where({ScheduleId: requestedScheduleId})[0];
            // Protect ourselves from gibberish that didn't map to a class
            if(requestedClass){
            // Prefill the form with the requested class information
            signupLocation.ddslick('select', {id: requestedClass.ClubId});

            // Lookup the Class entry, since many classIds share the same title
            var requestedClassId = ''+requestedClass.ClassId;
            var classIndex = signupClass.parents('.dd-container').find('.dd-option-value').filter(function(){
                return _($(this).val().split(',')).contains(requestedClassId);
            }).first().parents('li').first().prevAll().length;
            signupClass.ddslick('select', {index: classIndex})

            $('section.signup').on('schedule-loaded', function(){
                showWeek(requestedClass.week);
                $('.day-list').removeClass('on');

                $('input[name="ScheduleId"]').filter('[value="'+requestedClass.ScheduleId+'"]').click()
                    .parents('.day-list').addClass('on');
            });

            // use disallowed class dictionary to check if self schedule is ok
            class_disallowed = _.contains(self_signup_disallowed_classes, requestedClassId)
            if (!class_disallowed) {
                // Select the "schedule self" option
                scheduleSelf.click();
            } else {
                scheduleSelf.parent().hide();
                $('.no-self-schedule').show();
                return
            }
            }
        });
        }

        // If User prefill information is in the URL, prefill it
        if(match = window.location.search.match(/sign-up-([\w-]+)=([^&]+)/g)){
        _(match).each(function(match){
            match = match.split('=');
            var value = decodeURIComponent(match[1].replace(/\+/g, '%20')),
                target = $('#'+match[0]);

            


                console.log($(target));

            target.is('.dd-selected-value') ? target.data('initialvalue', value) : target.val(value);

            


        })
        }

        if(match = window.location.search.match(/schedule-method=reserve\+spot\+myself/i)){
        $('#schedule-method-self').click();
        $(window).scrollTop($('#days-list').offset().top);
        }

        $('article form').on('validation-passed', function(){
        var self_scheduled = $('#schedule-method-self').is(':checked');
        var notes = [];
        var selected_class = $('.dd-option-value[value="' + $('#sign-up-class').val() + '"]').first().next('label').text()
        notes.push("Class Preference: " +  selected_class + ", self-scheduled: " + (self_scheduled ? "Yes" : "No"));
        var location = $('.dd-option-value[value="' + $('#sign-up-location').val() + '"]').first().next('label').text();
        var goals,
            promo;
        if(goals = $('#sign-up-goals').val()) notes.push("Goals: " + goals);
        if(promo = $('#sign-up-promo').val()) notes.push("Promo Code: " + promo);
        if(employee_type = $('#spoken-to-an-employee').val()) notes.push("Employee Referral: " + employee_type);


        var prospect_data = {
            FirstName: $('#sign-up-first-name').val(),
            LastName: $('#sign-up-last-name').val(),
            Email: $('#sign-up-email').val(),
            Phone: $('#sign-up-phone').val(),
            StoreId: $('#sign-up-location').val(),
            SendEmail: 'False',
            Note: notes.join("\n\n")
        };
        var referral_type;
        
        if(referral_type = $('#sign-up-source').val()) prospect_data.ReferralTypeId = referral_type;

        // Get a list of the prospect types for the location so we can set the
        // prospect as either "Scheduled" or "Unscheduled"
        ClubReadyAPI.get_prospect_types(prospect_data.StoreId).then(function(prospect_types){

            // Lookup the Id of the appropriate prospect type
            if(prospect_types)
            prospect_data.ProspectTypeId = _(prospect_types).find(function(type){ return type.Name == (self_scheduled ? "Scheduled" : "Unscheduled")}).Id;
            if(window.location.pathname != '/sign-up-training-assessment/'){

            ClubReadyAPI.save_prospect(prospect_data)
                        .then(function(user_data){
                            HS_API.submit_form(_.extend(prospect_data, {"Location": location})).done(function( result ) {
                                if( ! result ) {
                                    console.log("ERROR: Request was bad");
                                }
                                if(!self_scheduled){
                                    window.location = window.location.href.replace('sign-up', 'thank-you');
                                    return;
                                }
                                var selected_class = $('input[name="ScheduleId"]:checked')
                                var booking_data = {
                                    UserId: user_data.UserId,
                                    StoreId: parseInt(selected_class.data('location'),10),
                                    ScheduleId: parseInt(selected_class.val(),10)
                                    };
                                ClubReadyAPI.schedule_prospect(booking_data).then(function(){
                                    window.location = window.location.href.replace('sign-up', 'thank-you');
                                })
                            });                      
            });

            }
            
        });
        });
    }
    });
})(jQuery);
