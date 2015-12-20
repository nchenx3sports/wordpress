<?php get_header(); ?>

		<section role="main">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now">Book your free class now</a>
			<article>
				<h1>Not Found</h1>
				<div class="post">

<p>Sorry, but the page or file you're looking for was not found. We just redesigned our site so it may have moved elsewhere. Try doing a search, <a href="#" onclick="history.back(-1)">going back</a>, or maybe <a href="<?php echo get_bloginfo('url'); ?>">go home</a>.</p>
		
				</div><!--post-->								
			</article>
			
		</section>
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
<?php get_footer(); ?>