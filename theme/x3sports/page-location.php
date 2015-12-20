<?php 
/*
Template Name: Location
*/
get_header(); ?>

		<section role="main" class="locations" data-pinurl="<?php echo get('pin_image'); ?>" data-latlng="<?php echo get('latitude_and_longitude'); ?>" data-gmap="<?php echo get('google_map_url'); ?>">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>	

			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>
			<h1>Locations <span><?php the_title(); ?></span></h1>


<?php $images = get_group('Photos'); 
if ($images) { ?>

			<div class="containerOuter">
				<div class="container">
					<div class="iosSliderContainer">
						<div class="iosSlider">
							<div class="slider">
	<?php $num = 0; foreach($images as $image) { $num++; ?>
								<div class="item"  style="background-image:url('<?php echo get_image('photos_image',$num,1,0,NULL) ?>')"></div>	
	<?php } ?>
							</div><!--slider-->
						</div><!--iosSlider-->
					</div><!--iosSliderContainer-->
				</div><!--container-->
			</div><!--containerOuter-->
			<div class="slider-controls">
				<ul>			

	<?php $num = 0; foreach($images as $image) { $num++; ?>
								<li <?php if ($num == 1) { echo 'class="active"'; } ?>><?php echo $image['photos_title'][1]; ?></li>
	<?php } ?>
					<li>&nbsp;</li>	
				</ul>
				<ol>
					<li>Previous</li>
					<li>Next</li>
				</ol>
				<p>View training areas for the <?php the_title(); ?> location</p>
			</div><!--slider-controls-->	
	
<?php } ?> 


			
			<div class="content">
				<div id="map-canvas"></div>
				<article>			
					<h1><?php the_title(); ?></h1>
					<h2>Location</h2>
					<p><a target="_blank" href="<?php echo get('google_map_url'); ?>"><?php $locationaddress = get('address'); $locationaddress = str_replace('<p>', '', $locationaddress); $locationaddress = str_replace('</p>', '', $locationaddress); echo $locationaddress; ?></a></p>
					<p><?php echo get('phone_number'); ?></p>
					<h2>Hours</h2>
					<table>
<?php $hours = get_group('Hours');
if ($hours) {
	foreach($hours as $hour) { ?>
						<tr>
							<td><?php echo $hour['hours_day'][1]; ?></td>
							<td><?php echo $hour['hours_hours'][1]; ?></td>
						</tr>	
	<?php }
} ?> 
					</table>
					<div class="post">
						<?php the_content(); 
						edit_post_link('[Edit]', '<p>', '</p>'); ?>	
					</div><!--post-->
				</article>
			</div><!--content-->
	<?php endwhile; endif; ?>	
				
		</section>
				
<?php get_footer(); ?>