<?php 
/*
Template Name: Universal (1 column)
*/
get_header(); ?>


		<section role="main">
			<a href="<?php echo get_page_link(48); ?>" id="free-class" title="Book your free class now”>Book your free class now</a>

<!—WOO COMMERCE START—>			
<?php woocommerce_content(); ?>
<!—WOO COMMERCE END—>
		</section>

				
<?php get_footer(); ?>