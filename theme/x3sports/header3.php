<!doctype html>
<?php $htmlclass = ""; if (is_front_page()) { $htmlclass .= "home "; } else { $htmlclass .= "interior "; } ?>
<!--[if lt IE 9]><html class="lt-ie9 <?php echo $htmlclass; ?>" lang="en"><![endif]-->
<!--[if IE 9]><html class="lte-ie9 <?php echo $htmlclass; ?>" lang="en"><![endif]-->
<!--[if gt IE 9]><!--><html lang="en" class="<?php echo $htmlclass; ?>"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:700,800,600" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Titillium+Web:700,600" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="/assets/css/magnific-popup.min.css" media="all">
		<link rel="stylesheet" type="text/css" href="/assets/css/x3sports.css" media="all">
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?new">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<?php $root_page_id = ( empty( $post->ancestors ) ) ? $post->ID : end( $post->ancestors );

		if ($root_page_id == 8) { ?>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyD7RGy7HvAzvgoDHH52eV36PbmlNSz8mIA"></script>
		<?php } ?>

		<script src="/assets/js/jquery.iosslider.min.js"></script>
		<script src="/assets/js/masonry.pkgd.min.js"></script>
		<script src="/assets/js/fastclick.min.js"></script>
		<script src="/assets/js/jquery.fitvids.js"></script>
		<script src="/assets/js/jquery.ddslick.min.js"></script>
		<script src="/assets/js/jquery.magnific.popup.min.js"></script>
		<script src="/assets/js/jquery.custom.js"></script>

		<script src="/assets/js/handlebars.js"></script>
		<script src="/assets/js/underscore.js"></script>
		<script src="/assets/js/jquery.clubready.custom.js"></script>

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="/assets/js/css3-mediaqueries.js"></script>
			<script src="/assets/js/selectivizr.min.js"></script>
		<![endif]-->
		<?php wp_head(); 
		
		//thank you page codes
		
		if (is_page(2545)) { ?>

		<!-- Google Code for Free Session Form Conversion Page -->
		<script language="JavaScript" type="text/javascript">
		<!--
		var google_conversion_id = 1052881263;
		var google_conversion_language = "en_US";
		var google_conversion_format = "1";
		var google_conversion_color = "000000";
		var google_conversion_label = "oh-9CI3nRhDv4ob2Aw";
		//-->
		</script>
		
		<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
		<noscript><img height="1" width="1" border="0" style="display:none" src="http://www.googleadservices.com/pagead/conversion/1052881263/?label=oh-9CI3nRhDv4ob2Aw&amp;script=0"/></noscript>
		

<!-- Facebook Conversion Code for Leads - Tammi Armstrong 2 since 10/14/15 -->
<!-- BEGIN Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1110341385672559');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1110341385672559&ev=PageView&noscript=1"
/></noscript>
<!-- END Facebook Pixel Code -->	


<!-- BEGIN Tammi's Twitter Pixel -->
<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">twttr.conversion.trackPid('nthu9', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=nthu9&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=nthu9&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
</noscript>		<script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.msn.com/mstag/site/122fe662-5d5d-43b8-bc89-a84d3a599840/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"565246",type:"1",actionid:"65106"})</script> <noscript> <iframe src="//flex.msn.com/mstag/tag/122fe662-5d5d-43b8-bc89-a84d3a599840/analytics.html?dedup=1&domainId=565246&type=1&actionid=65106" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe> </noscript>
<!-- END Tammi's Twitter Pixel -->

		<?php } 
		
		//Adventure Race page
		
		if (is_page(4215)) { ?>
		
		<!-- Facebook Conversion Code for Adventure Race Conversion Campaign -->
		<script>(function() {
		var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
		}
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6027411379906', {'value':'0.01','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6027411379906&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

		<!-- Google Code for Obstacle Race Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1052881263;
		var google_conversion_language = "en";
		var google_conversion_format = "2";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "gjQLCJbKyFkQ7-KG9gM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1052881263/?label=gjQLCJbKyFkQ7-KG9gM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>

		
		<?php }
		
		//normal pages ?>
		
		<script type="text/javascript">(function(){
		window._fbds = window._fbds || {};
		_fbds.pixelId = 1376762509258705;
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(["track", "PixelInitialized", {}]);
		</script>

	</head>
		<div id="header">
			<div>
				<a href="<?php echo home_url(); ?>" title="X3 Sports &mdash; Home"><img src="/assets/images/logo.png" alt="X3 Sports"></a>
				<nav>
					<ul class="main">
						<li><a href="<?php echo get_page_link(48); ?>" title="Book Your Free Class Now">Book Your Free Class Now</a></li>
						<li><span <?php if ($root_page_id == 10) { echo 'class="on"'; } ?>>Classes <ins>&#9660;</ins></span>
							<ul>
<?php $pages = get_pages(array('child_of' => 10, 'parent' => 10, 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {	echo '<li><a href="'.get_page_link( $page->ID ).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>'; } ?>
							</ul>
						</li>
						<li><a href="<?php echo get_page_link(43); ?>" <?php if ($root_page_id == 43) { echo 'class="on"'; } ?>>Schedules</a></li>
						<li><span <?php if ($root_page_id == 8) { echo 'class="on"'; } ?>>Locations <ins>&#9660;</ins></span>
							<ul>
<?php $pages = get_pages(array('child_of' => 8, 'parent' => 8, 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {	echo '<li><a href="'.get_page_link( $page->ID ).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>'; } ?>
							</ul>
						</li>
						<li><a href="<?php echo get_page_link(57); ?>" <?php if ($root_page_id == 57) { echo 'class="on"'; } ?>>Success Stories</a></li>
						<li><span <?php if ($root_page_id == 6) { echo 'class="on"'; } ?>>About Us <ins>&#9660;</ins></span>
							<ul>
<?php $pages = get_pages(array('child_of' => 6, 'parent' => 6, 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {	echo '<li><a href="'.get_page_link( $page->ID ).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>'; } ?>
							</ul>
						</li>
						<li>&nbsp;</li>
					</ul>
					<ul class="second">
						<li><a href="<?php echo get_page_link(106); ?>">Members</a></li>
						<li><a href="http://x3-sports.myshopify.com/" target="_blank">X3 Store</a></li>
						<li><a href="<?php echo get_page_link(90); ?>">Contact Us</a></li>
						<li class="search"><span>Search</span></li>
					</ul>
					<form role="search" method="get" action="<?php echo home_url(); ?>/">
						<label for="query">Search for:</label>
						<input type="text" value="Search" name="s" id="query">
						<input type="submit" value="Submit">
					</form>
				</nav>
			</div>
		</div><!--header-->
		<div class="mobile-nav">
			<a href="<?php echo home_url(); ?>" title="X3 Sports &mdash; Home"><img src="/assets/images/logo.png" alt="X3 Sports"></a>
			<ul>
				<li>Search</li>
				<li>Menu</li>
			</ul>
		</div>