<?php 
/*
Template Name: Universal (2 column)
*/
get_header(); ?>

		<section role="main" class="universal-2">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>				
			<div class="two-column">
				<article>
					<h1><?php the_title(); ?></h1>
					<div class="post">
						<?php the_content(); 
						edit_post_link('[Edit]', '<p>', '</p>'); ?>					
					</div><!--post-->	
				</article>
				<aside>
				
<?php $textboxes = get_group('Sidebar Textbox'); 
if ($textboxes) { 	
	foreach($textboxes as $textbox) {  ?>				
					<div class="callout textbox post">

<?php if ($textbox['sidebar_textbox_title'][1] != '') { ?>
						<h4><?php echo $textbox['sidebar_textbox_title'][1]; ?></h4>
<?php } ?>
						<?php echo $textbox['sidebar_textbox_content'][1]; ?>
					
					</div><!--callout-->
<?php } 

} 





$socials = get_group('X3 Experience Posts'); 
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
<?php endwhile; endif; ?>			
		</section>

				
<?php get_footer(); ?>