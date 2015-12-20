<?php

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the links to the extra feeds such as category feeds
//remove_action( 'wp_head', 'feed_links', 2 ); // Removes links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Removes the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link'); // Removes the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'parent_post_rel_link_wp_head', 10, 0); // Removes the prev link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Removes the relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Removes the WordPress version i.e. - WordPress 2.8.4
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Removes the shortlink link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
wp_deregister_script('l10n');
wp_deregister_script('jquery');

add_filter( 'show_admin_bar', '__return_false' );
//add_filter('widget_text', 'do_shortcode');

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', '1');



add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}


add_filter('single_template', 'check_for_category_single_template');
function check_for_category_single_template( $t )
{
  foreach( (array) get_the_category() as $cat ) 
  { 
    if ( file_exists(TEMPLATEPATH . "/single-category-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-category-{$cat->slug}.php"; 
    if($cat->parent)
    {
      $cat = get_the_category_by_ID( $cat->parent );
      if ( file_exists(TEMPLATEPATH . "/single-category-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-category-{$cat->slug}.php";
    }
  } 
  return $t;
}


function customformatTinyMCE($init) {
	// Add block format elements you want to show in dropdown
	$init['theme_advanced_blockformats'] = 'p,h1,h2,h3';
	$init['theme_advanced_disable'] = 'h4,h5,h6,pre,addr,strikethrough,underline,forecolor,justifyfull';

	return $init;
}
add_filter('tiny_mce_before_init', 'customformatTinyMCE' );


// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 ); 



function excludeCatsFromSearchResults( $query ) {
     if ( $query->is_search ) {
          $query->set( 'cat', '-2,-3' ); // category ids to exclude
     } return $query;
} add_action( 'pre_get_posts', 'excludeCatsFromSearchResults' );


function get_the_post_excerpt($id=false) {
    global $post;

    $old_post = $post;
    if ($id != $post->ID) {
		$post = get_page($id);
    }

    if (!$excerpt = trim($post->post_excerpt)) {
		$excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

		$words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
		    array_pop($words);
		    $excerpt = implode(' ', $words);
		    $excerpt = $excerpt . $excerpt_more;
		} else {
		    $excerpt = implode(' ', $words);
		}
    }

    $post = $old_post;

    return $excerpt;
}


// Add Infusion feedback form to a page:

function infusionForm() {
    return '<form accept-charset="UTF-8" action="https://pn211.infusionsoft.com/app/form/process/f068869bd9a7973180508423a6539fba" class="infusion-form" method="POST"><input name="inf_form_xid" type="hidden" value="f068869bd9a7973180508423a6539fba" /><input name="inf_form_name" type="hidden" value="Fill out form" /><input name="infusionsoft_version" type="hidden" value="1.38.0.37" /><label for="inf_field_Email">Email *</label><input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="text" /><label for="inf_custom_aField0">Comments/Feedback *</label><textarea cols="24" id="inf_custom_aField0" name="inf_custom_aField0" rows="5"></textarea><input type="submit" value="Submit" /></form><script type="text/javascript" src="https://pn211.infusionsoft.com/app/webTracking/getTrackingCode?trackingId=6f40f66548c835e8030338891dc485a1"></script>';
}
add_shortcode('infusion_form', 'infusionForm');


?>