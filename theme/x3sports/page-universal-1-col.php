<?php 
/*
Template Name: Universal (1 column)
*/
get_header(); ?>


		<section role="main">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>
			<article>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>			
				<h1><?php the_title(); ?></h1>
				<div class="post">
					<?php the_content(); 
					edit_post_link('[Edit]', '<p>', '</p>'); ?>					
				</div><!--post-->								
			</article>
			
<?php if (get('show_3_latest_blog_posts')) { ?>			
						<div id="blog-posts">
				<ul>
<?php $posts = get_posts(array('category' => 1, 'posts_per_page' => 3)); 
  foreach ( $posts as $post ) {	setup_postdata( $post );  ?>

<li>
<h4><a href="<?php the_permalink(); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a></h4>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" title="Read more">Read more</a>
</li> 

<?php } 
wp_reset_postdata(); ?>

				</ul>
			</div><!--blog-posts-->
<?php } 

endwhile; endif; ?>
		</section>

				
<?php get_footer(); ?>