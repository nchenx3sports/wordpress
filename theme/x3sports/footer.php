		<footer>
			<div class="content">
				<div class="col">
					<div class="section">
						<h6>Classes</h6>
						<ul>
<?php $pages = get_pages(array('child_of' => 10, 'parent' => 10, 'sort_column' => 'menu_order')); 
  foreach ( $pages as $page ) {	echo '<li><a href="'.get_page_link( $page->ID ).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>'; } ?>	
						</ul>
					</div><!--section-->
					<div class="section">
						<ul><TABLE BACKGROUND=WHITE><TD>
							<li><a href="<?php echo get_page_link(43); ?>">Schedules</a></li>
							<li><a href="<?php echo get_page_link(101); ?>">Membership Programs</a></li>
							<li><a href="<?php echo get_page_link(106); ?>">Members</a></li>
							<li><a href="<?php echo get_page_link(57); ?>">Success Stories</a></li>
							<li><a href="<?php echo get_category_link(1); ?>">Blog</a></li>
							<li><a href="<?php echo get_page_link(12); ?>">X3 Experience</a></li>
							<li><a href="http://x3-sports.myshopify.com/">X3 Store</a></li>
							<li><a href="<?php echo get_page_link(104); ?>">How We Started</a></li>
							<li><a href="<?php echo get_page_link(90); ?>">Contact Us</a></li>
						</TD></TABLE>
</ul>
					</div><!--section-->
				</div><!--col-->
				<div class="col">
					<div class="section">
						<h6>Locations</h6>
<?php $pages = get_pages(array('child_of' => 8, 'parent' => 8, 'sort_column' => 'menu_order')); 
  foreach ( $pages as $page ) {	?>
						<p><strong><a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a></strong>
							<a href="<?php echo get('google_map_url', 1, 1, false, $page->ID); ?>"><?php $locationaddress = get('address', 1, 1, false, $page->ID); $locationaddress = str_replace('<p>', '', $locationaddress); $locationaddress = str_replace('</p>', '', $locationaddress); echo $locationaddress; ?></a><br>
							<?php echo get('phone_number', 1, 1, false, $page->ID); ?></p>
<?php } ?>	
					</div><!--section-->
				</div><!--col-->
				<div class="col">
<!--SOCIAL MEDIA HERE, REMOVED-->
					<ul class="callouts">
						<li><a href="<?php echo get_page_link(108); ?>">License an X3 Sports</a></li>
						<li><a href="<?php echo get_page_link(110); ?>">Fight Team</a></li>
						<li><a href="<?php echo get_page_link(96); ?>">Careers</a></li>
						<li><a href="<?php echo get_page_link(98); ?>">X3 Community Partners</a></li>
					</ul>
					<?php echo get('footer_copy', 1, 1, false, 87); ?>
				</div><!--col-->
			</div><!--content-->
		</footer>
		<?php wp_footer(); ?>

<script type="text/javascript">
piAId = '14572';
piCId = '5671';

(function() {
function async_load(){
var s = document.createElement('script'); s.type = 'text/javascript';
s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
}
if(window.attachEvent) { window.attachEvent('onload', async_load); }
else { window.addEventListener('load', async_load, false); }
})();
</script>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5012692-3");
pageTracker._initData();
pageTracker._trackPageview();
</script>

	</body>
</html>