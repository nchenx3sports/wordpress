<?php 
/*
Template Name: Homepage
*/
get_header(); ?>

		<section role="main">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>
			<div class="containerOuter">
				<div class="container">
					<div class="iosSliderContainer">
						<div class="iosSlider">
							<div class="slider">
								<div class="item kickboxing" style="background-image:url('<?php echo get('kickboxing_hero_image') ?>')">
									<div class="text">
										<h3>"I'm incomplete without it."</h3>
										<p>Lost: 14 inches. Gained: Strength, endurance, a new life.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2639)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div><!--fasttrack-->
								<div class="item fasttrack" style="background-image:url('<?php echo get('fast_track_hero_image') ?>')">
									<div class="text">
										<h3>"The camaraderie keeps me motivated."</h3>
										<p>Lost: 30 lbs. Gained: Lean muscle.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2650)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item mma" style="background-image:url('<?php echo get('mma_hero_image') ?>')">
									<div class="text">
										<h3>"I could feel the family atmosphere and loved it."</h3>
										<p>Lost: Hard times. Gained: Celebrity status as a UFA fighter.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2656)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item powertrack" style="background-image:url('<?php echo get('power_track_hero_image') ?>')">
									<div class="text">
										<h3>"X3 delivered fit and more."</h3>
										<p>Lost: The body my wife married. Gained: A body my wife can be proud of.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2666)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item boxing" style="background-image:url('<?php echo get('boxing_hero_image') ?>')">
									<div class="text">
										<h3>"I feel awesome every time I am done with my routine."</h3>
										<p>Lost: My fear. Gained: Strength and balance to cope with muscular dystrophy.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2673)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item bjj" style="background-image:url('<?php echo get('brazilian_jiu_jitsu_hero_image') ?>')">
									<div class="text">
										<h3>"X3 is my life now."</h3>
										<p>Lost: 40 lbs. Gained: A home away from home.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2676)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item yoga" style="background-image:url('<?php echo get('yoga_hero_image') ?>')">
									<div class="text">
										<h3>"Yoga has provided me with such a sense of strength."</h3>
										<p>Lost: My noodle arms. Gained: Muscles I never knew I had.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2681)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item youth" style="background-image:url('<?php echo get('youth_hero_image') ?>')">
									<div class="text">
										<h3>"X3's service is no less than an A+."</h3>
										<p>Lost: Unathleticism. Gained: Silver medal in the 100 & 200 meter dash.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2684)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
								<div class="item muaythai" style="background-image:url('<?php echo get('muay_thai_hero_image') ?>')">
									<div class="text">
										<h3>"I'm in the best shape of my life."</h3>
										<p>Lost: 20 lbs. Gained: Self-discipline.</p>
										<a href="<?php echo get_page_link(57); ?>#<?php echo( basename(get_permalink(2687)) ); ?>" title="Read my story">Read my story</a>
									</div><!--text-->
								</div>
							</div><!--slider-->
						</div><!--iosSlider-->
					</div><!--iosSliderContainer-->
				</div><!--container-->
			</div><!--containerOuter-->
			<div class="slider-controls">
				<ul>
					<li class="active">Kickboxing</li>
					<li>Fast Track&#8480;</li>
					<li>MMA</li>
					<li>Power Track&#8480;</li>
					<li>Boxing</li>
					<li>Brazilian Jiu Jitsu</li>
					<li>Yoga</li>
					<li>Youth</li>
					<li>Muay Thai</li>
					<li>&nbsp;</li>
				</ul>
				<ol>
					<li>Previous</li>
					<li>Next</li>
				</ol>
			</div><!--slider-controls-->
		


<!--TINTUP SOCIAL INSTAGRAM LIVE FEED-->
<script async src="https://d36hc0p18k1aoc.cloudfront.net/public/js/modules/tintembed.js"></script><div class="tintup" data-id="x3sports" data-columns="3" data-expand="true"  data-count="12"  data-paginate="true"  style="height:500px;width:100%;"></div>
<!--TINTUP SOCIAL INSTAGRAM LIVE FEED-->



<?php if (get('blog_posts_post_1_id') != '') { ?>			
						<div id="blog-posts">
				<ul>

	<?php $temppost = get_post(get('blog_posts_post_1_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('blog_posts_post_1_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('blog_posts_post_1_id')); ?></p>
<a href="<?php echo get_permalink(get('blog_posts_post_1_id')); ?>" title="Read more">Read more</a>
</li> 



<?php if (get('blog_posts_post_2_id') != '') { 

$temppost = get_post(get('blog_posts_post_2_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('blog_posts_post_2_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('blog_posts_post_2_id')); ?></p>
<a href="<?php echo get_permalink(get('blog_posts_post_2_id')); ?>" title="Read more">Read more</a>
</li> 

<?php }

if (get('blog_posts_post_3_id') != '') { 

$temppost = get_post(get('blog_posts_post_3_id')); ?>

<li>
<h4><a href="<?php echo get_permalink(get('blog_posts_post_3_id')); ?>" title="<?php echo $temppost->post_title; ?>"><?php echo $temppost->post_title; ?></a></h4>
<p><?php echo get_the_post_excerpt(get('blog_posts_post_3_id')); ?></p>
<a href="<?php echo get_permalink(get('blog_posts_post_3_id')); ?>" title="Read more">Read more</a>
</li> 

<?php } ?>

				</ul>
			</div><!--blog-posts-->
<?php } ?>

<!--REMOVE MOTIVATION GUIDE AREA--
			<div id="callout2">
				<div class="content">
					<div>
						<h2>Need motivation?</h2>
						<h3>Get Our Expert Guide:<br>6 Simple Tips<br>to Improve Your Motivation.</h3>
						<a href="<?php echo get_page_link(93); ?>" title="Download now">Download now <span>&rarr;</span></a>
					</div>
				</div><!--content-->
				<div class="bg"></div>
			</div><!--callout2-->
--END REMOVE MOTIVATION GUIDE AREA-->			
		</section>
		
<?php get_footer(); ?>
