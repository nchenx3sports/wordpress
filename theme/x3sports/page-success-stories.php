<?php 
/*
Template Name: Success Stories
*/
get_header(); ?>

		<section role="main" class="success">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book my free class now">Book my free class now</a>
			<h1>Success Stories</h1>


<?php $args = array( 'posts_per_page' => -1, 'category' => 2 );
$postlist = get_posts( $args ); 
foreach ( $postlist as $post ) : setup_postdata( $post ); 

$firstname = get_the_title($post->ID);
$title_array = explode(' ', $firstname);
$firstname = $title_array[0]; ?>


			<div class="story"><a name="<?php echo( basename(get_permalink($post->ID)) ); ?>"></a>
				<div class="image">
					<img src="<?php echo get_image('photo',1,1,0,$page->ID) ?>" alt="<?php echo get_the_title($post->ID); ?> now">
<?php if (get('before_photo', 1, 1, false, $page->ID) != '') { ?>					
					<div class="before">
						<img src="<?php echo get_image('before_photo',1,1,0,$page->ID) ?>" alt="<?php echo get_the_title($post->ID); ?> before">
					</div><!--before-->
<?php } ?>
				</div><!--image-->				
				<div class="copy">
					<?php if (get('before_photo', 1, 1, false, $page->ID) != '') { ?>				
						<h2 class="has-before"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h2><?php the_title(); ?></h2>					
					<?php } ?>
					<dl class="stats">

<?php $details = get_group('Details', $post->ID); 
if ($details) { 
	foreach($details as $detail) { ?>
					<dt><?php echo $detail['details_label'][1]; ?></dt>
					<dd><?php echo $detail['details_description'][1]; ?></dd>
<?php } 
} 

$classes = get_group('Classes Taken', $post->ID); 
if ($classes) { ?>
					<dt>Classes Taken</dt>
					<dd>
<?php foreach($classes as $class) { ?>
					<a href="<?php echo get_page_link($class['classes_taken_class'][1]); ?>"><?php echo get_the_title($class['classes_taken_class'][1]); ?></a> 
<?php } ?>
					</dd>
<?php } 
?> 

					</dl>
					<dl class="bio">
						<dt>Straight from <?php echo $firstname; ?></dt>
						<dd>
							<?php the_content(); ?>
						</dd>
					</dl>
				</div><!--copy-->			
			</div><!--story-->
	
	
<?php endforeach; ?>
	<center><FONT COLOR=gray>*Results may vary.</COLOR></center>	
<BR><BR>	
		</section>

				
<?php get_footer(); ?>