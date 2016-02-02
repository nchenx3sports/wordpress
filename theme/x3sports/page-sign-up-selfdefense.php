<?php
/*
Template Name: Sign Up for Free Self-Defense Seminar
*/
get_header(); ?>

		<section role="main" class="schedule signup self-defense">
			<div class="two-column">
				<h1>Free Self-Defense Seminar Sign Up</h1>
				<article class="loading">
					<div class="post">

						<?php if (have_posts()): while (have_posts()) : the_post(); the_content(); edit_post_link('[Edit]', '<p>', '</p>'); endwhile; endif; ?>

					</div><!--post-->
					<p id="confirmation">Thanks for your interest in X3 Sports Self-Defense Seminar!<br /><br />Your registration has been submitted. We look forward to seeing you at the seminar!
					<BR>Please show up 30 minutes before the seminar.
					<BR>Please bring your driver's license and credit card.
					<BR>Dress appropriately in workout/fitness attire with tennis shoes.
					<BR>Bringing a bottle of water is recommended.
					</p>
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
									<label for="sign-up-source">How did you hear about us?</label>
									<select id="sign-up-source">
										<option value="0">How did you hear about us? *</option>
                  </select>
								</li>
								<li>
									<label for="sign-up-goals">Goals</label>
									<textarea id="sign-up-goals" placeholder="Goals"></textarea>
								</li>
								</li>
							</ul>
						<h4><input type="submit" value="Submit"></h4>
						<p>
							<span id="validation-required">Some information appears to be missing. Please update the needed fields and try again.</span>
							<span id="validation-phone-length">Please provide a 10 digit phone number.</span>
						</p>
					</form>
<center><font color="#C0C0C0">* Phone and email are registration purposes only. Your privacy is important to us.</font></center>
				</article>
			</div><!--two-column-->
		</section>

<?php get_footer(); ?>
