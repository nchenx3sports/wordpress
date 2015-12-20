<?php
/*
Template Name: Sign Up for Body Assessment & Fitness Consultation
*/
get_header(); ?>

		<section role="main" class="schedule signup training">
			<div class="two-column">
				<h1>Free Body Assessment & Fitness Goal Consultation Sign Up</h1>
				<article class="loading">
					<div class="post">

						<?php if (have_posts()): while (have_posts()) : the_post(); the_content(); edit_post_link('[Edit]', '<p>', '</p>'); endwhile; endif; ?>

					</div><!--post-->
					<p id="confirmation">Thanks for your interest in X3 Sports!<br /><br />Your free Body Assessment & Fitness Goal Consultation request has been submitted, and our X3 Sports team will contact you soon to set up an appointment.</p>
					<form method="post" action="http://google.com">
						<div class="user-info">
							<ul>
								<li>
									<label for="sign-up-first-name">First Name</label>
									<input type="text" id="sign-up-first-name" placeholder="First Name *">
								</li>
								<li>
									<label for="sign-up-last-name">Last Name</label>
									<input type="text" id="sign-up-last-name" placeholder="Last Name *">
								</li>
								<li>
									<label for="sign-up-email">Email *</label>
									<input type="text" id="sign-up-email" placeholder="Email *">
								</li>
								<li>
									<label for="sign-up-phone">Phone *</label>
									<input type="text" id="sign-up-phone" placeholder="Phone *">
								</li>
								<li>
									<label for="membership-status">Membership Status:</label>
									<select id="membership-status">
										<option value="">Membership Status *</option>
										<option value="Current Member">Current Member</option>
										<option value="Former Member">Former Member</option>
										<option value="Not Yet a Member">Not Yet a Member</option>
                  </select>
								</li>								
								<li>
									<label for="sign-up-source">How did you hear about us?</label>
									<select id="sign-up-source">
										<option value="0">How did you hear about us? *</option>
                  </select>
								</li>
								<li>
									<label for="sign-up-location">Select Location</label>
									<select id="sign-up-location">
										<option value="">Select Location *</option>
					          <option value="not sure">Not Sure</option>
									</select>
								</li>
								<li>
									<label for="sign-up-goals">Goals</label>
									<textarea id="sign-up-goals" placeholder="Goals"></textarea>
								</li>
									We will contact you soon to schedule an appointment.
								</li>
							</ul>
						<h4><input type="submit" value="Submit"></h4>
						<p>
							<span id="validation-required">Some information appears to be missing. Please update the needed fields and try again.</span>
							<span id="validation-phone-length">Please provide a 10 digit phone number.</span>
							<span id="validation-choose-location">Please select a specific location.</span>
						</p>
					</form>
<center><font color="#C0C0C0">* Phone and email are for scheduling purposes only. Your privacy is important to us.</font></center>
				</article>
			</div><!--two-column-->
		</section>

<?php get_footer(); ?>
