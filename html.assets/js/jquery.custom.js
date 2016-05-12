(function($){
    
    //Wrap in ready event so we can bind to elements when everything is loaded.
    $(document).on("ready", function() {

        //FastClick.attach(document.body);

        //GLOBAL functions

        //toggle nav and subnav
        $('nav ul.main > li > span, nav ul.second > li.subnav > span').click(function(e) {
            if (!$(this).parent().hasClass('on')) {
                $('nav ul > li').removeClass('on');
                $(this).parent().toggleClass('on');
            } else {
                $('nav ul > li').removeClass('on');
            }
        });



        //toggle search
        $('nav ul li.search span').click(function() {
            $('nav ul.main > li.on, nav ul.second > li.subnav.on').removeClass('on');
            $('nav ul li.search, nav form').toggleClass('on');
        });


        //track clicks and close top nav dropdowns if user clicks off
        $(document).click(function(e) {
            var clickedItem = e.target;
            if (!$(clickedItem).parents('ul.main').length && !$(clickedItem).parents('ul.second').length) {
                $('nav ul.main li.on, nav ul.second li.on').removeClass('on');
            }

            if (!$(clickedItem).parents('.mobile-nav ul').length && !$(clickedItem).parents('#header').length) {
                $('.mobile-nav ul li.on').removeClass('on');
                $('#header.search, #header.menu').removeClass();
            }

            if (!$(clickedItem).parents('li.search.on').length && !$(clickedItem).parents('nav form').length) {
                $('nav li.search, nav form').removeClass('on');
            }

        });


        $('nav form #query').focus(function(){
            if ($(this).val() == 'Search') { $(this).val(''); }
            }).blur(function(){
                if ($(this).val() == '') { $(this).val('Search'); }
        })


        if ($('.home #x3-exp').length) {
            var container = document.querySelector('#x3-exp .content');
            var msnry = new Masonry( container, {
                columnWidth: 330,
                gutter: 0,
                transitionDuration: 0,
                itemSelector: '#x3-exp .content > div'
            });
        } //x3-exp




        //mobile nav options
        $('.mobile-nav ul li:first-child').click(function() {
            $(this).toggleClass('on').siblings().removeClass('on');
            $('#header').toggleClass('search').removeClass('menu');
        });

        $('.mobile-nav ul li:last-child').click(function() {
            $(this).toggleClass('on').siblings().removeClass('on');
            $('#header').toggleClass('menu').removeClass('search');
        });




        //slider functions

        if ($('.iosSlider').length) {

            $('.iosSlider').iosSlider({
                snapToChildren: true,
                desktopClickDrag: true,
                autoSlide: true,
                infiniteSlider: true,
                snapSlideCenter: true,
                onSlideStart: slideStart,
                onSlideComplete: SlideComplete,
                autoSlideTransTimer: 800,
                navPrevSelector: $('.slider-controls ol li:first-child'),
                navNextSelector: $('.slider-controls ol li:last-child'),
                stageCSS: {
                    overflow: 'visible'
                }
            });

        } //slider

        function slideStart(args) {
            try {
                $('.slider-controls li').removeClass('active');
            }
            catch(err) { }
        } //slideStart


        function SlideComplete(args) {
            try {
                $('.slider-controls li').eq(args.currentSlideNumber - 1).addClass('active');
            }
            catch(err) { }
        } //SlideComplete


        $('.slider-controls ul li').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('.iosSlider').iosSlider('goToSlide', $(this).index() + 1);
        });



        //INTERIOR functions


        if ($('.post').length) {
            $('.post').fitVids();
        } //all posts


        if ($('section.schedule').not('.signup').length) {

            $('.filters select').each(function() {
                $(this).ddslick({
                    onSelected: function(){

                        $('.day-list ol > li.hidden').removeClass('hidden');

                        var chosenLocation = $('#filter-location').val();
                        var chosenClass = $('#filter-class').val();
                        var chosenInstructor = $('#filter-instructor').val();

                        if (chosenLocation) {
                            $('.day-list ol > li').not('[data-location='+ chosenLocation +']').addClass('hidden');
                        }

                        if (chosenClass) {
                            var chosenClasses = _(chosenClass.split(','));
                            $('.day-list ol > li').filter(function(){
                                return !chosenClasses.contains(''+$(this).data('class'));
                            }).addClass('hidden');
                        }

                        if (chosenInstructor) {
                            var chosenInstructors = _(chosenInstructor.split(','));
                            $('.day-list ol > li').filter(function(){
                                return !chosenInstructors.contains(''+$(this).data('instructor'));
                            }).addClass('hidden');
                        }

                        $('.day-list').each(function() {

                            if ($(this).children('ol').find('> li').not('.hidden').not('.disabled').length) {
                                $(this).removeClass('empty');
                            } else {
                                $(this).addClass('empty');
                            }

                        });

                    }
                });
            });

            $(this).on('schedule-loaded', function(){

                $('.day-list ul li:nth-child(3) a').magnificPopup({
                    type: 'iframe',
                    closeBtnInside: true,
                    closeMarkup: '<a title="%title%" class="mfp-close">Close <span>&times;</span><a>'
                });


                $('.day-list h3').click(function() {
                    $(this).parent().toggleClass('on');
                });

                $('.day-list li.disabled a').click(function(e) {
                    e.preventDefault();
                });

                $('.days-nav li.disabled a').click(function(e) {
                    e.preventDefault();
                });
            });


        } //schedule page



        if ($('section.signup').length) {


            $('article select').each(function() {
                $(this).ddslick({
                    onSelected: function(data){

                        if (data.selectedIndex == 0) {
                            $(data.selectedItem).parent().parent().addClass('empty');
                        } else {
                            $(data.selectedItem).parent().parent().removeClass('empty');
                        }
                    }

                });
            });


            $('article form').submit(function() {

                $('form h4 + p').slideUp(250);
                $('form h4 + p span').hide();
                var hasErrors = false;
                var required_message = $('#validation-required');
                var phone_length_message = $('#validation-phone-length');
                var choose_location_message = $('#validation-choose-location');

                $('.user-info input[type="text"]').each(function() {
                    if($(this).attr('id') != 'sign-up-promo')
                    if (!$(this).val()) {
                        $(this).addClass('error');
                        required_message.show();
                        hasErrors = true;
                    } else {
                        $(this).removeClass('error');
                    }
                });

                $('.user-info input[type="hidden"]').each(function() {
                    if(this.id == 'sign-up-source') return;
                    if (!$(this).val()) {
                        $(this).parent().parent().addClass('error');
                        required_message.show();
                        hasErrors = true;
                    } else {
                        $(this).parent().parent().removeClass('error');
                    }
                });

                if ($('.user-info input[type="radio"]:checked').val() == "Reserve spot myself" && $('form [name="ScheduleId"]:checked').val() == null) {
                    $('.user-info > p').show();
                    hasErrors = true;
                    required_message.show();
                } else {
                    $('.user-info > p').hide();
                }

        var phn = $('#sign-up-phone');
        if (!hasErrors && phn.val().replace(/[^\d]/g, '').length != 10){
            phn.addClass('error');
            phone_length_message.show();
            hasErrors = true;
        }

        var loc = required_message.show();
        if (!hasErrors && $('#schedule-method-self').is(':checked') && loc.val().toLowerCase() == 'not sure'){
            loc.parents('.dd-container').addClass('error');
            choose_location_message.show();
            hasErrors = true;
        }

                if (hasErrors) {
                    $('form h4 + p').slideDown(250);
                } else {
                    $(this).trigger('validation-passed');
                }
                return false;

            }).find('input,select,textarea').on('change', function(){
                $(this).parents('.error').andSelf().removeClass('error');
            });


            $(this).on('schedule-loaded',function(){

            $('.day-list').each(function() {
            if ($(this).children('ol').find('> li').not('.hidden').not('.disabled').length) {
                $(this).removeClass('empty');
            } else {
                $(this).addClass('empty');
            }

            });

                $('.day-list h3').click(function() {
                    $(this).parent().toggleClass('on');
                });

                $('.days-nav li.disabled a').click(function(e) {
                    e.preventDefault();
                });
            });


            $('.lt-ie9 article input[name="schedule-method"]').click(function() {
                $('input[name="schedule-method"]').not($(this)).removeAttr('checked');
            });



        } //sign-up page

        if ($('.callout.signup').length){

            $('.callout.signup select').ddslick();

        } // signup callout


        if ($('.x3-exp #x3-exp').length) {


            // load FeedMagnet SDK
            var fm_server = 'x3sports.feedmagnet.com'
            ;(function() {
                window.fm_ready = function(fx) {
                    if (typeof $FM !== 'undefined' && typeof $FM.ready === 'function') {
                        $FM.ready(fx);
                    } else {
                        window.setTimeout(function() { fm_ready.call(null, fx); }, 50);
                    }
                };

                var fmjs = document.createElement('script');
                fmjs.src = 'http://' + fm_server + '/embed.js';
                fmjs.setAttribute('async', 'true');
                $('head').append(fmjs);
            })();

            fm_ready(function($, _) {
                var expFeed = $FM.Feed('x3-experience').options({'limit': 30}).get()
                expFeed.connect('new_update', function(self, data) {
                var udata = data.update.data;
                parseFeed(udata, data);
            }) //update fetching

            // display the feed on the page
            var output = $FM.Element('#x3-exp .content').display(expFeed)

            var finishedOutput=setInterval(function(){fmComplete()},1000);
            var runOnce = true;

            function fmComplete() {

                if ($('#x3-exp div:eq(0)').css('display') != 'none' && runOnce) {
                    runOnce = false;

                    var container = document.querySelector('#x3-exp .content');
                    var msnry = new Masonry( container, {
                        columnWidth: 330,
                        gutter: 0,
                        transitionDuration: 0,
                        itemSelector: '#x3-exp .content > div'
                    });

                    msnry.on( 'layoutComplete', function() {
                        $('#x3-exp .content > div').css({'opacity': 0, 'visibility': 'visible'}).animate({'opacity': 1}, 250);
                        $('#x3-exp > h1').slideUp(250);
                    });

                    msnry.layout();

                }
            } //fmcomplete


            function parseFeed(udata, data) {

                var udata = udata;

                if (udata.author.username != null) {
                    var formattedUsername = udata.author.username;
                    if (formattedUsername.charAt(0) != '@') {
                        var formattedUsername = '<span>@'+ udata.author.username +'</span>';
                    } else {
                        var formattedUsername = '<span>'+ udata.author.username +'</span>';
                    }
                } else {
                    var formattedUsername = '';
                }

                //PHOTO UPDATES

                if ((udata.photos.length > 0) || (udata.videos.length > 0)) {

                    if (udata.photos.length > 0) { var currMedia = udata.photos[0] } else { var currMedia = udata.videos[0] }

                    data.update.html =
                    '<div class="photo"><img src="'+ currMedia.local_url + '385/385/" alt=""></div>'+
                    '<div class="text icon '+ udata.channel +'">'+
                        '<h3>'+ udata.author.alias + ' ' + formattedUsername + '</h3>';
                        if (udata.original_text.length) { data.update.html += '<p>'+ udata.original_text +'&nbsp;</p>'; }
                    data.update.html += '</div>';

                //TEXT UPDATES
                } else {

                    data.update.html =
                    '<div class="text icon '+ udata.channel +'">'+
                        '<h3>'+ udata.author.alias + ' ' + formattedUsername + '</h3>'+
                        '<p>'+ udata.original_text +'&nbsp;</p>'+
                    '</div>';

                } //formatting boolean

                return data.update.html;

            } //parseFeed

            }) //end FM


        } //x3 exp page



        if ($('section.locations').length) {

            //get latlng, strip spaces, break into array so Google Maps accepts it
            var latlng = $('section.locations').data().latlng.replace(/ /g,'').split(",");
            var mapCenter = new google.maps.LatLng(parseFloat(latlng[0]), parseFloat(latlng[1]));

            //creates pin, sets point, resets point to bottom of the caret
            var image = {
            url: $('section.locations').data().pinurl,
            size: new google.maps.Size(206, 190),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(103, 167),
            scaledSize: new google.maps.Size(206, 190)
            };

            var mapOptions = {
                zoom: 14,
                mapTypeControl: false,
                center: mapCenter,
                zoomControlOptions: { style:google.maps.ZoomControlStyle.SMALL },
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{featureType:'all',stylers:[{saturation:-100},{gamma:0.50}]}]
            }

            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            var marker = new google.maps.Marker({
                position: mapCenter,
                map: map,
                icon: image
            });

            marker.setMap(map);
            google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(mapCenter); });

            google.maps.event.addListener(marker, 'click', function() {
                window.open($('section.locations').data().gmap);
            });

        } //locations
        
    });

})(jQuery);
