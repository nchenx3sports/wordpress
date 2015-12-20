<?php 
/*
Template Name: Redirect to first child
*/
	$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
	$firstchild = $pagekids[0];
	wp_redirect(get_permalink($firstchild->ID));
?>