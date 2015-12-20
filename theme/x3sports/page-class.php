<?php
/*
Template Name: Class
*/
get_header(); ?>

		<section role="main" class="class">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>

<?php if (get('hero_image') != '') { ?>
			<div class="hero" style="background-image:url('<?php echo get_image('hero_image',1,1,0,null); ?>')"></div><!--hero-->
<?php } ?>

			<div class="two-column">
				<article>
						<h1><?php the_title(); ?></h1>

					<div class="post">
						<?php the_content();
						edit_post_link('[Edit]', '<p>', '</p>'); ?>
					</div><!--post-->
				</article>
				<aside>
					<div class="callout signup">
						<h4>Free Class Signup</h4>
						<form role="search" method="get" action="<?php echo get_page_link(48); ?>">
							<ul>
					      <li class="name">
					      	<label style="display:none">First Name*</label>
					        <input type="text" value="" name="sign-up-first-name" id="signup-firstname" placeholder="First Name*">
					      </li>
					      <li class="name">
					      	<label style="display:none">Last Name*</label>
					        <input type="text" value="" name="sign-up-last-name" id="signup-lastname" placeholder="Last Name*">
					      </li>
					      <li>
					      	<label style="display:none">Email*</label>
					        <input type="text" value="" name="sign-up-email" id="signup-email" placeholder="Email*">
					      </li>
					      <li>
					      	<label style="display:none">Phone*</label>
					        <input type="text" value="" name="sign-up-phone" id="signup-phone" placeholder="Phone*">
					      </li>
					      <li>
					        <select name="sign-up-location" id="signup-location">
					          <option value="">Select Location*</option>
					          <option value="not sure">Not Sure</option>
					        </select>
					      </li>
					      <li>
					        <select name="sign-up-class" id="signup-class">
					          <option value="">Class Preference*</option>
					        </select>
					      </li>
					      <li>
					        <select name="sign-up-source" id="sign-up-source">
					          <option value="0">How did you hear about us?</option>
					        </select>
					      </li>
								<li>
					      	<label style="display:none">Goals </label>
									<textarea name="sign-up-goals" id="signup-goals" placeholder="Goals"></textarea>
								</li>
								<li class="radio">
									<input name="schedule-method" type="radio" value="Contact me to schedule" id="schedule-method-contact" checked="checked">
									<label for="schedule-method-contact">Contact me to schedule</label>
								</li>
								<li class="radio">
									<input name="schedule-method" type="radio" value="Reserve spot myself" id="schedule-method-self">
									<label for="schedule-method-self">Reserve spot myself</label>
								</li>
					    </ul>
                                            <p class="no-self-schedule">This class is not presently available for self-scheduling. Our team will be in touch to complete your class booking.</p>
							<div>
								<input type="submit" value="Submit">
							</div>
							<p id="validation-message"></p>
						</form>
						<p>Your privacy is important to us. Phone number and email will only be used for scheduling purposes.</p>
					</div><!--callout-->



<?php $socials = get_group('X3 Experience Posts');
if ($socials) {
	foreach($socials as $social) {
		$postID = $social['x3_experience_posts_post_id'][1]; ?>

					<div class="callout social">

<?php //INSTAGRAM
if (get('item_source', 1, 1, 0, $postID) == "Instagram") { ?>

						<div class="photo">
							<img src="<?php echo get_image('photo',1,1,0,$postID) ?>" alt="">
						</div><!--photo-->
						<div class="text icon instagram">
							<h3><?php echo get('full_name',1,1,0,$postID) ?> <span>@<?php echo get('username',1,1,0,$postID) ?></span></h3>
							<?php $temppost = get_post($postID);
$socialcontent = $temppost->post_content;
$socialcontent = apply_filters('the_content', $socialcontent);
$socialcontent = str_replace(']]>', ']]>', $socialcontent);
echo $socialcontent; ?>
						</div><!--text-->

<?php }

//FACEBOOK
else if (get('item_source', 1, 1, 0, $postID) == "Facebook") { ?>

			<?php if (get_image('photo',1,1,0,$postID) != '') { ?>
						<div class="photo">
							<img src="<?php echo get_image('photo',1,1,0,$postID) ?>" alt="">
					</div><!--photo-->
			<?php } ?>
						<div class="text icon facebook">
							<h3><?php echo get('full_name',1,1,0,$postID) ?></h3>
							<?php $temppost = get_post($postID);
$socialcontent = $temppost->post_content;
$socialcontent = apply_filters('the_content', $socialcontent);
$socialcontent = str_replace(']]>', ']]>', $socialcontent);
echo $socialcontent; ?>
						</div><!--text-->


<?php }

//TWITTER
else if (get('item_source', 1, 1, 0, $postID) == "Twitter") { ?>


			<?php if (get_image('photo',1,1,0,$postID) != '') { ?>
						<div class="photo">
							<img src="<?php echo get_image('photo',1,1,0,$postID) ?>" alt="">
					</div><!--photo-->
			<?php } ?>
						<div class="text icon twitter">
							<h3><?php echo get('full_name',1,1,0,$postID) ?> <span>@<?php echo get('username',1,1,0,$postID) ?></span></h3>
							<?php $temppost = get_post($postID);
$socialcontent = $temppost->post_content;
$socialcontent = apply_filters('the_content', $socialcontent);
$socialcontent = str_replace(']]>', ']]>', $socialcontent);
echo $socialcontent; ?>
						</div><!--text-->

<?php }

//REVIEW
else if (get('item_source', 1, 1, 0, $postID) == "Review") { ?>

						<div class="text icon yelp">
							<div class="review <?php if (get_image('user_icon',1,1,0,$postID) != '') { ?>with-icon<?php } ?>">
								<span>
			<?php if (get('star_rating',1,1,0,$postID) == 1) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 1.5) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star-half.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 2) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 2.5) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star-half.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 3) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 3.5) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star-half.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 4) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
			<?php } else if (get('star_rating',1,1,0,$postID) == 4.5) { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star-half.png" alt="">
			<?php } else { ?>
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
									<img src="/assets/images/x3-exp-star.png" alt="">
			<?php } ?>
								</span>
								<h4><?php echo get('full_name',1,1,0,$postID) ?></h4>
			<?php if (get('review_title',1,1,0,$postID) != '') { ?>
								<h3><?php echo get('review_title',1,1,0,$postID) ?></h3>
			<?php } ?>
								<?php $temppost = get_post($postID);
$socialcontent = $temppost->post_content;
$socialcontent = apply_filters('the_content', $socialcontent);
$socialcontent = str_replace(']]>', ']]>', $socialcontent);
echo $socialcontent; ?>
			<?php if (get('review_source',1,1,0,$postID) != '') { ?>
								<p class="source"><?php echo get('review_source',1,1,0,$postID) ?></p>
			<?php } ?>
			<?php if (get_image('user_icon',1,1,0,$postID) != '') { ?>
								<img src="<?php echo get_image('user_icon',1,1,0,$postID) ?>" alt="">
			<?php } ?>
							</div><!--review-->
						</div><!--text-->


<?php } //end source boolean ?>



					</div><!--social-->
<?php }
} ?>







				</aside>
			</div><!--two-column-->

<?php if (get('related_blog_posts_post_1_id') != '') { ?>
						<div id="blog-posts">
				<ul>

	<?php $temppost = get_post(get('related_blog_posts_post_1_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('related_blog_posts_post_1_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('related_blog_posts_post_1_id')); ?></p>
<a href="<?php echo get_permalink(get('related_blog_posts_post_1_id')); ?>" title="Read more">Read more</a>
</li>



<?php if (get('related_blog_posts_post_2_id') != '') {

$temppost = get_post(get('related_blog_posts_post_2_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('related_blog_posts_post_2_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('related_blog_posts_post_2_id')); ?></p>
<a href="<?php echo get_permalink(get('related_blog_posts_post_2_id')); ?>" title="Read more">Read more</a>
</li>

<?php }

if (get('related_blog_posts_post_3_id') != '') {

$temppost = get_post(get('related_blog_posts_post_3_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('related_blog_posts_post_3_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('related_blog_posts_post_3_id')); ?></p>
<a href="<?php echo get_permalink(get('related_blog_posts_post_3_id')); ?>" title="Read more">Read more</a>
</li>

<?php } ?>

				</ul>
			</div><!--blog-posts-->
<?php } ?>







	<?php endwhile; endif; ?>
		</section>

<?php get_footer(); ?>
