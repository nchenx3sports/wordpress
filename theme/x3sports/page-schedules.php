<?php
/*
Template Name: Schedules
*/
get_header(); ?>

		<section role="main" class="schedule">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book my free class now">Book my free class now</a>
			<h1>Schedules</h1>
			<div class="two-column">
				<aside>

					<?php $callouts = get_group('Callout');
					if ($callouts) {
						$num = 0;
						foreach($callouts as $callout) {
							$num++;
							if ($num != 1) { echo '<hr>'; }
							echo $callout['callout_text'][1]; }
					} ?>

				</aside>
				<article class="loading">
					<div class="filters">
						<h6>Filter By</h6>
						<select id="filter-location">
							<option value="">All Locations</option>
						</select>
						<select id="filter-class">
							<option value="">All Classes</option>
						</select>
						<select id="filter-instructor">
							<option value="">All Instructors</option>
						</select>
					</div>
					
					<h4>Please note, free trials must be scheduled at least 4 hours in advance. If interested in a free trial within 4 hours, please call a location. Instructors are subject to change without notice.</h4>
					
					<?php /*
					<!--filters-->
					<ul class="days-nav">
						<li><a href="#" data-week="thisweek">Previous 7 Days</a></li>
						<li><a href="#" data-week="nextweek">Next 7 Days</a></li>
					</ul> */ ?>

				  <div id="days-list"></div>

					<script id="schedule-template" type="text/x-handlebars-template">
						{{#each .}}
						<div class="day-list {{on}} hidden" data-week="{{week}}">
							<h3>{{title}}</h3>
							<ol>
								{{#each entries}}
								<li class="{{available}}" data-class="{{ClassId}}" data-instructor="{{InstructorId}}" data-location="{{ClubId}}">
									<ul>
										<li>{{Title}}</li>
										<li>{{StartTime}} - {{EndTime}}</li>
										<li>
											{{#if InstructorShortName}}
											{{InstructorShortName}}
											{{/if}}
										</li>
										<li>{{location}}</li>
										<li><a href="<?php echo get_page_link(48); ?>#scheduleId={{ScheduleId}}">Try Free!</a></li>
									</ul>
								</li>
								{{/each}}
							</ol>

							<p>There are no available classes on this day for the filters you've selected. Please try a different day or change your filters. </p>
						</div>
						{{/each}}
					</script>


					<ul class="days-nav">
						<li><a href="#" class="bottom" data-week="thisweek">Previous 7 Days</a></li>
						<li><a href="#" class="bottom" data-week="nextweek">Next 7 Days</a></li>
					</ul>

				</article>
			</div><!--two-column-->
		</section>

<?php get_footer(); ?>
