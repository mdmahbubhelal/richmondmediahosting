<?php /* Shortcodes */

/* Shortcodes tinymce script */
function wptc_shortcodes_tinymce() {
    if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'wptc_register_shortcodes_tinymce_plugin' );
        add_filter( 'mce_buttons', 'wptc_add_shortcodes_tinymce_buttons' );
	add_filter( 'mce_css', 'wptc_add_columns_tinymce_css' );
    }
}
add_action( 'admin_init', 'wptc_shortcodes_tinymce' );
function wptc_register_shortcodes_tinymce_plugin( $plugin_array ) {
    $plugin_array['wptc_shortcodes'] = get_template_directory_uri() . '/scripts/wptc-tinymce-shortcodes.js';
    return $plugin_array;
}
function wptc_add_shortcodes_tinymce_buttons( $buttons ) {
    array_push( $buttons, '|', 'wptcScButton' );
    array_push( $buttons, '|', 'wptcColumnsButton' );
    return $buttons;
}
function wptc_add_columns_tinymce_css( $mce_css ) {
    global $current_screen;
    $mce_css .= ', ' . get_template_directory_uri() . '/scripts/columns.css';
    return $mce_css;
}

/* Quicktags for HTML editor */
function wptc_add_quicktags() {
    if ( wp_script_is( 'quicktags' ) ) { ?>
<script type="text/javascript" id="wptcquicktags">
QTags.addButton( 'wptc_parent_uri', '<?php _e( 'p uri', 'wptc_theme_td' ) ?>', '[wptc-parent-uri]', '', '', '<?php _e( 'Parent Theme URI Shortcode', 'wptc_theme_td' ) ?>', 301 );
QTags.addButton( 'wptc_child_uri', '<?php _e( 'c uri', 'wptc_theme_td' ) ?>', '[wptc-child-uri]', '', '', '<?php _e( 'Child Theme URI Shortcode', 'wptc_theme_td' ) ?>', 302 );
QTags.addButton( 'wptc_search_form', '<?php _e( 'search', 'wptc_theme_td' ) ?>', '[wptc-search-form]', '', '', '<?php _e( 'Search Form Shortcode', 'wptc_theme_td' ) ?>', 303 );
QTags.addButton( 'wptc_button', '<?php _e( 'button', 'wptc_theme_td' ) ?>', '[wptc-button icon="" link="javascript:;" target="" type="" size="" style=""]', '[/wptc-button]', '', '<?php _e( 'Button Shortcode', 'wptc_theme_td' ) ?>', 304 );
QTags.addButton( 'wptc_alert', '<?php _e( 'alert', 'wptc_theme_td' ) ?>', '[wptc-alert type="" textalign=""]', '[/wptc-alert]', '', '<?php _e( 'Alert Shortcode', 'wptc_theme_td' ) ?>', 305 );
QTags.addButton( 'wptc_members', '<?php _e( 'members', 'wptc_theme_td' ) ?>', '[wptc-members]', '[/wptc-members]', '', '<?php _e( 'Members Only Content Shortcode', 'wptc_theme_td' ) ?>', 306 );
QTags.addButton( 'wptc_guests', '<?php _e( 'guests', 'wptc_theme_td' ) ?>', '[wptc-guests]', '[/wptc-guests]', '', '<?php _e( 'Guests Only Content Shortcode', 'wptc_theme_td' ) ?>', 307 );
QTags.addButton( 'wptc_list_posts', '<?php _e( 'list posts', 'wptc_theme_td' ) ?>', '[wptc-list-posts post_type="post" category="" grid="3" thumbnail_size="full" thumbnail_align="center" posts_per_page="20"]', '', '', '<?php _e( 'List Posts Shortcode', 'wptc_theme_td' ) ?>', 308 );
QTags.addButton( 'wptc_list_pages', '<?php _e( 'list pages', 'wptc_theme_td' ) ?>', '[wptc-list-pages include="" grid="1"]', '', '', '<?php _e( 'List Pages Shortcode', 'wptc_theme_td' ) ?>', 309 );
QTags.addButton( 'wptc_snap', '<?php _e( 'snap', 'wptc_theme_td' ) ?>', '[wptc-snap url="http://www.google.com/" alt="Google" w="400" h="300"]', '', '', '<?php _e( 'Website Snapshot Shortcode', 'wptc_theme_td' ) ?>', 310 );
QTags.addButton( 'wptc_year', '<?php _e( 'year', 'wptc_theme_td' ) ?>', '[wptc-year]', '', '', '<?php _e( 'Current Year Shortcode', 'wptc_theme_td' ) ?>', 311 );
QTags.addButton( 'wptc_login', '<?php _e( 'login', 'wptc_theme_td' ) ?>', '[wptc-login avatarsize="70"]', '', '', '<?php _e( 'Login Form Shortcode', 'wptc_theme_td' ) ?>', 312 );
QTags.addButton( 'wptc_sitemap', '<?php _e( 'site map', 'wptc_theme_td' ) ?>', '[wptc-sitemap pages="true" categories="true" archives="true" postspercat="false"]', '', '', '<?php _e( 'Site Map Shortcode', 'wptc_theme_td' ) ?>', 313 );
QTags.addButton( 'wptc_grid_row', '<?php _e( 'g row', 'wptc_theme_td' ) ?>', '[wptc-grid-row]', '[/wptc-grid-row]', '', '<?php _e( 'Grid Row Shortcode', 'wptc_theme_td' ) ?>', 314 );
QTags.addButton( 'wptc_grid_column', '<?php _e( 'g col', 'wptc_theme_td' ) ?>', '[wptc-grid-column size="1"]', '[/wptc-grid-column]', '', '<?php _e( 'Grid Column Shortcode', 'wptc_theme_td' ) ?>', 315 );
QTags.addButton( 'wptc_grid_section', '<?php _e( 'section', 'wptc_theme_td' ) ?>', '[wptc-section fullwidth="true" color="#ffffff" image="" parallax="false" padding="10"]', '[/wptc-section]', '', '<?php _e( 'Full Width Section Shortcode', 'wptc_theme_td' ) ?>', 316 );
QTags.addButton( 'wptc_space', '<?php _e( 'spacing', 'tux_theme_td' ) ?>', '[wptc-space height="200px"]', '', '', '<?php _e( 'Spacing Shortcode', 'tux_theme_td' ) ?>', 317 );
QTags.addButton( 'wptc_stitch', '<?php _e( 'stitched content', 'tux_theme_td' ) ?>', '[wptc-stitch background="#444444" color="#dedede" size="21px"]', '[/wptc-stitch]', '', '<?php _e( 'Stitched Content Shortcode', 'tux_theme_td' ) ?>', 318 );
QTags.addButton( 'wptc_themebutton', '<?php _e( 'theme button', 'tux_theme_td' ) ?>', '[wptc-themebutton  icon="home" label="Button" link="javascript:;" target="_self" align="center"]', '', '', 
'<?php _e( 'Theme Button Shortcode', 'tux_theme_td' ) ?>', 319 );
QTags.addButton( 'wptc_cta', '<?php _e( 'call to action', 'tux_theme_td' ) ?>', '[wptc-cta iconcolor="" iconname="home" title="Call To Action Title" titlecolor="" buttonlabel="Button" buttonlink="javascript:;" buttontarget="_self" buttonalign="center" background="" opacity="1"]', '[/wptc-cta]', '', '<?php _e( 'Call To Action', 'tux_theme_td' ) ?>', 320 );
QTags.addButton( 'wptc_cta_small', '<?php _e( 'call to action small', 'tux_theme_td' ) ?>', '[wptc-cta-small iconcolor="" iconname="home" title="Call To Action Title" titlecolor="" buttonlabel="Button" buttonlink="javascript:;" buttontarget="_self" buttonalign="center" background=" " opacity="1"]', '[/wptc-cta-small]', '', '<?php _e( 'Call To Action Small', 'tux_theme_td' ) ?>', 321 );
QTags.addButton( 'wptc-autocolumns', '<?php _e( 'autocolumns', 'tux_theme_td' ) ?>', '[wptc-autocolumns columns="3" columngap="40px" paddingright="20px" paddingleft="20px"]', '[/wptc-autocolumns]', '', '<?php _e( 'autocolumns', 'tux_theme_td' ) ?>', 322 );
QTags.addButton( 'wptc-callout', '<?php _e( 'callout', 'tux_theme_td' ) ?>', '[wptc-callout align="center" icon="home" iconcolor="" title="Title" titlecolor="" image="http://goo.gl/m2pkvN"]', '[/wptc-callout]', '', '<?php _e( 'callout', 'tux_theme_td' ) ?>', 323 );
QTags.addButton( 'wptc_desktop', '<?php _e( 'large desktop', 'tux_theme_td' ) ?>', '[wptc-desktop]', '[/wptc-desktop]', '', '<?php _e( 'Large Desktop', 'tux_theme_td' ) ?>', 324 );
QTags.addButton( 'wptc_laptop', '<?php _e( 'laptop', 'tux_theme_td' ) ?>', '[wptc-laptop]', '[/wptc-laptop]', '', '<?php _e( 'Laptop', 'tux_theme_td' ) ?>', 325 );
QTags.addButton( 'wptc_noie', '<?php _e( 'no ie', 'tux_theme_td' ) ?>', '[wptc-noie]', '[/wptc-noie]', '', '<?php _e( 'No IE', 'tux_theme_td' ) ?>', 326 );
QTags.addButton( 'wptc_nodesktop', '<?php _e( 'no desktop', 'tux_theme_td' ) ?>', '[wptc-nodesktop]', '[/wptc-nodesktop]', '', '<?php _e( 'No Desktop', 'tux_theme_td' ) ?>', 327 );
QTags.addButton( 'wptc_notablet', '<?php _e( 'no tablet', 'tux_theme_td' ) ?>', '[wptc-notablet]', '[/wptc-notablet]', '', '<?php _e( 'No Tablet', 'tux_theme_td' ) ?>', 328 );
QTags.addButton( 'wptc_nophone', '<?php _e( 'no phone', 'tux_theme_td' ) ?>', '[wptc-nophone]', '[/wptc-nophone]', '', '<?php _e( 'No Phone', 'tux_theme_td' ) ?>', 329 );
QTags.addButton( 'wptc_noresponsive', '<?php _e( 'no responsive', 'tux_theme_td' ) ?>', '[wptc-noresponsive]', '[/wptc-noresponsive]', '', '<?php _e( 'No Responsive', 'tux_theme_td' ) ?>', 330 );
QTags.addButton( 'wptc_margins', '<?php _e( 'margins', 'tux_theme_td' ) ?>', '[wptc-margins margintop="0px" marginbottom="0px" marginright="0px" marginleft="0px" paddingtop="0px" paddingbottom="0px" paddingright="0px" paddingleft="0px" bordercolor="" borderstyle="solid" borderwidthtop="0px" borderwidthright="0px" borderwidthbottom="0px" borderwidthleft="0px"]', '[/wptc-margins]', '', '<?php _e( 'Margins', 'tux_theme_td' ) ?>', 331 );
QTags.addButton( 'wptc_single_bg', '<?php _e( 'single background', 'tux_theme_td' ) ?>', '[wptc-single-bg color="" url=""]', '', '', 
'<?php _e( 'Single Background', 'tux_theme_td' ) ?>', 332 );
QTags.addButton( 'wptc_directions', '<?php _e( 'directions', 'tux_theme_td' ) ?>', '[wptc-directions location=""]', '', '', 
'<?php _e( 'Directions', 'tux_theme_td' ) ?>', 333 );
QTags.addButton( 'wptc_vimeo', '<?php _e( 'vimeo', 'tux_theme_td' ) ?>', '[wptc-vimeo id="" autoplay="0"]', '[/wptc-vimeo]', '', '<?php _e( 'Vimeo', 'tux_theme_td' ) ?>', 334 );
QTags.addButton( 'wptc_youtube', '<?php _e( 'youtube', 'tux_theme_td' ) ?>', '[wptc-youtube id="" autoplay="0"]', '[/wptc-youtube]', '', '<?php _e( 'Youtube', 'tux_theme_td' ) ?>', 335 );
QTags.addButton( 'wptc_iframe', '<?php _e( 'iframe', 'tux_theme_td' ) ?>', '[wptc-iframe url=""]', '[/wptc-iframe]', '', '<?php _e( 'iframe', 'tux_theme_td' ) ?>', 336 );
QTags.addButton( 'wptc_vimeo_card', '<?php _e( 'vimeo card', 'tux_theme_td' ) ?>', '[wptc-vimeo-card id="" autoplay="0" title_color="" title_size="30px" border="wptc-3d"]', '[/wptc-vimeo-card]', '', '<?php _e( 'Vimeo Card', 'tux_theme_td' ) ?>', 337 );
QTags.addButton( 'wptc_youtube_card', '<?php _e( 'youtube card', 'tux_theme_td' ) ?>', '[wptc-youtube-card id="" autoplay="0" title_color="" title_size="30px" border="wptc-3d"]', '[/wptc-youtube-card]', '', '<?php _e( 'Youtube Card', 'tux_theme_td' ) ?>', 338 );
QTags.addButton( 'wptc_card', '<?php _e( 'card', 'tux_theme_td' ) ?>', '[wptc-card image="" title="Card Title" title_color="" title_size="30px" border="wptc-3d" lightbox="lightbox"]', '[/wptc-card]', '', '<?php _e( 'Youtube Card', 'tux_theme_td' ) ?>', 339 );
QTags.addButton( 'wptc_feature', '<?php _e( 'feature', 'tux_theme_td' ) ?>', '[wptc-feature border="wptc-border" link="javascript:;" target="_self" size="300%" icon1="circle" icon1color="#000000" icon2="home" icon2color="#ffffff" title="Feature Title" titlecolor=""]', '[/wptc-feature]', '', '<?php _e( 'Feature', 'tux_theme_td' ) ?>', 340 );
QTags.addButton( 'wptc_trends', '<?php _e( 'trends', 'tux_theme_td' ) ?>', '[wptc-trends h="330px" w="1050" q="wordpress,joomla,drupal" geo="US"]', '[/wptc-trends]', '', '<?php _e( 'Trends', 'tux_theme_td' ) ?>', 341 );
QTags.addButton( 'wptc_heading', '<?php _e( 'heading', 'tux_theme_td' ) ?>', '[wptc-heading topmargin="0px" bottommargin="0px" align="center" iconsize="75px" iconcolor="" icon="home" iconpadding="30px" headingsize="75px" headingcolor="" heading="Heading"]', '', '', '<?php _e( 'Heading Shortcode', 'tux_theme_td' ) ?>', 342 );
QTags.addButton( 'wptc_highlight', '<?php _e( 'highlight', 'tux_theme_td' ) ?>', '[wptc-highlight size="" color="#ffffff" backcolor="#000000"]', '[/wptc-highlight]', '', '<?php _e( 'Highlight', 'tux_theme_td' ) ?>', 343 );
QTags.addButton( 'wptc_logotext', '<?php _e( 'logotext', 'tux_theme_td' ) ?>', '[wptc-logotext topmargin="0px" bottommargin="0px" align="center" link="javascript:;" size="50px" color="" icon1="home" text1="LOGO TEXT" icon2="" text2="" icon3=""]', '', '', '<?php _e( 'LogoText', 'tux_theme_td' ) ?>', 344 );
QTags.addButton( 'wptc_neon', '<?php _e( 'neon', 'tux_theme_td' ) ?>', '[wptc-neon classname="neon1" topmargin="0px" bottommargin="0px" align="center" link="javascript:;" size="50px" color="#000000" shadowcolor="#789AFF" icon1="home" text1="NEON TEXT" icon2="" text2="" icon3=""]', '', '', '<?php _e( 'Neon', 'tux_theme_td' ) ?>', 345 );
QTags.addButton( 'wptc_box', '<?php _e( 'box', 'tux_theme_td' ) ?>', '[wptc-box background="#444444" color="#dedede" size="16px" radius="10px" width="90%" opacity="1"]', '[/wptc-box]', '', '<?php _e( 'Box', 'tux_theme_td' ) ?>', 346 );
QTags.addButton( 'wptc_box2', '<?php _e( 'box2', 'tux_theme_td' ) ?>', '[wptc-box2 classname="box1" width="100%" color="white" backcolor1="black" backcolor2="blue" hovercolor="black" hoverbackcolor1="green" hoverbackcolor2="yellow"]', '[/wptc-box2]', '', '<?php _e( 'Box2', 'tux_theme_td' ) ?>', 347 );
QTags.addButton( 'wptc_delaybox', '<?php _e( 'delaybox', 'tux_theme_td' ) ?>', '[wptc-delaybox classname="delaybox1" width="100%" color="yellow" backcolor="black" hovercolor="#000000" hoverbackcolor="#dddddd" duration="1"]', '[/wptc-delaybox]', '', '<?php _e( 'Delaybox', 'tux_theme_td' ) ?>', 348 );
QTags.addButton( 'wptc_animate', '<?php _e( 'animation', 'tux_theme_td' ) ?>', '[wptc-animate class="wow zoomIn" duration="1" delay="0" offset="270" iteration="1"]', '[/wptc-animate]', '', '<?php _e( 'Animation', 'tux_theme_td' ) ?>', 349 );
QTags.addButton( 'wptc_icon', '<?php _e( 'icon', 'wptc_theme_td' ) ?>', '[wptc-icon name="" style=""]', '', '', '<?php _e( 'Font Awesome Shortcode', 'wptc_theme_td' ) ?>', 350 );
QTags.addButton( 'wptc_more', '<?php _e( 'read more', 'tux_theme_td' ) ?>', '[wptc-more more="Read more" less="Read less" align="left" color="red" size="80%"]', '[/wptc-more]', '', '<?php _e( 'Read More', 'tux_theme_td' ) ?>', 351 );
QTags.addButton( 'wptc_linkbox', '<?php _e( 'linkbox', 'tux_theme_td' ) ?>', '[wptc-linkbox link="javascript:;" target="_self" image="http://goo.gl/m2pkvN" width="25%" title="Linkbox Title"]', '[/wptc-linkbox]', '', '<?php _e( 'Linkbox', 'tux_theme_td' ) ?>', 352 );
QTags.addButton( 'wptc_paypal', '<?php _e( 'paypal button', 'tux_theme_td' ) ?>', '[wptc-paypal name="" price="" align="center"]', '', '', '<?php _e( 'Paypal Button', 'tux_theme_td' ) ?>', 353 );
QTags.addButton( 'wptc_rss', '<?php _e( 'rss feed', 'tux_theme_td' ) ?>', '[wptc-rss rss="https://wordpress.org/plugins/browse/new/feed/" target="_blank" feeds="10" size="22px" color="red" hovercolor="blue"]', '', '', '<?php _e( 'RSS FEED', 'tux_theme_td' ) ?>', 354 );
</script>
    <?php }
}
add_action( 'admin_print_footer_scripts', 'wptc_add_quicktags' );

// ==============================================
/* RSS Shortcode */
// ==============================================
function wptc_rss_shortcode($atts)
{

	extract(shortcode_atts(array(  
	   	"rss" 		=> '',  
		"feeds" 	=> '100',  
		"target"    => '_self',
		"color"     => '',
		"hovercolor" => '',
		"size"      => '',
	), $atts));


include_once( ABSPATH . WPINC . '/feed.php' );

// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed( $rss);

$maxitems = 0;

if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items( 0, $feeds );

endif;

//	Start the output buffering

ob_start();

?>
<ul class="qp-rss-ul">
    <?php if ( $feeds == 0 ) : ?>
        <li class="qt-rss-li"><?php _e( 'No items found', 'rss-via-shortcode' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) : ?>
		    <li class="qt-rss-li">
                <a target="<?php echo $target; ?>" href="<?php echo esc_url( $item->get_permalink() ); ?>"
                    title="<?php printf( __( 'Posted %s', 'rss-via-shortcode' ), $item->get_date('j F Y | g:i a') ); ?>">
                    <?php echo esc_html( $item->get_title() ); ?>
                </a>
            </li>
		<?php endforeach; ?>
    <?php endif; ?>
</ul>

<style type="text/css">
.qt-rss-li a {
	color: <?php echo $color; ?> !important;
	font-size: <?php echo $size; ?> !important;
}

.qt-rss-li a:hover {
	color: <?php echo $hovercolor; ?> !important;
}
</style>

<?php
$output = ob_get_contents();
ob_end_clean();
return $output;

}

//	Add the shortcode
add_shortcode( 'wptc-rss', 'wptc_rss_shortcode' );

/* Delaybox */
/* [wptc-delaybox classname="delaybox1" width="100%" color="yellow" backcolor="black" hovercolor="#000000" hoverbackcolor="#dddddd" duration="1"]Content[/delaybox-box2] */
function wptc_delaybox_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	    'classname' => '',
	    'width' => '100%',
		'color' => '',
        'backcolor' => '#000000',
		'hovercolor' => '',
		'hoverbackcolor' => '#dddddd',
		'duration' => '1',
	), $atts ) );
	return '<div class="'. $classname .'">' . do_shortcode( $content ) . '</div>
	
<style type="text/css">
.'. $classname .' {
  max-width: 95%;
  color: '. $color .';
  width: '. $width .';
  background: '. $backcolor .';
  margin-left: auto;
  margin-right: auto;
  padding: 25px;
  -webkit-transition: background-color '. $duration .'s ease-out;
  -moz-transition: background-color '. $duration .'s ease-out;
  -o-transition: background-color '. $duration .'s ease-out;
  transition: background-color '. $duration .'s ease-out;
}

.'. $classname .':hover {
  color: '. $hovercolor .';
  background-color: '. $hoverbackcolor .';
  cursor: pointer;
}	
</style>';
}
add_shortcode( 'wptc-delaybox', 'wptc_delaybox_shortcode' );

/* box2 */
/* [wptc-box2 classname="box1" width="100%" color="white" backcolor1="black" backcolor2="blue" hovercolor="black" hoverbackcolor1="green" hoverbackcolor2="yellow"]Content[/wptc-box2] */
function wptc_box2_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	    'classname' => '',
	    'width' => '100%',
		'color' => 'white',
		'backcolor1' => 'black',
		'backcolor2' => 'blue',
		'hovercolor' => 'black',
		'hoverbackcolor1' => 'green',
		'hoverbackcolor2' => 'yellow',
	), $atts ) );
	return '<div class="'. $classname .'">' . do_shortcode( $content ) . '</div>
	
<style type="text/css">
.'. $classname .' {
  max-width: 95%;
  color: '. $color .';
  width: '. $width .';
    background: -webkit-gradient(linear, center top, center bottom, from('. $backcolor1 .'), to('. $backcolor2 .'));
	background: -webkit-linear-gradient(-90deg, '. $backcolor1 .', '. $backcolor2 .');
	background: -moz-linear-gradient(-90deg, '. $backcolor1 .', '. $backcolor2 .');
	background: -ms-linear-gradient(-90deg, '. $backcolor1 .', '. $backcolor2 .');
	background: -o-linear-gradient(-90deg, '. $backcolor1 .', '. $backcolor2 .');
	background: linear-gradient(180deg, '. $backcolor1 .', '. $backcolor2 .');
  margin-left: auto;
  margin-right: auto;
  padding: 25px;
}

.'. $classname .':hover {
  color: '. $hovercolor .';
    background: -webkit-gradient(linear, center top, center bottom, from('. $hoverbackcolor1 .'), to('. $hoverbackcolor2 .'));
	background: -webkit-linear-gradient(-90deg, '. $hoverbackcolor1 .', '. $hoverbackcolor2 .');
	background: -moz-linear-gradient(-90deg, '. $hoverbackcolor1 .', '. $hoverbackcolor2 .');
	background: -ms-linear-gradient(-90deg, '. $hoverbackcolor1 .', '. $hoverbackcolor2 .');
	background: -o-linear-gradient(-90deg, '. $hoverbackcolor1 .', '. $hoverbackcolor2 .');
	background: linear-gradient(180deg, '. $hoverbackcolor1 .', '. $hoverbackcolor2 .');
  cursor: pointer;
}	
</style>';
}
add_shortcode( 'wptc-box2', 'wptc_box2_shortcode' );

/* Neon */
/* [wptc-neon classname="neon1" topmargin="0px" bottommargin="0px" align="center" link="javascript:;" size="50px" color="#000000" shadowcolor="#789AFF" icon1="home" text1="NEON TEXT" icon2="" text2="" icon3=""] */
function wptc_neon_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	    'classname' => 'neon1',
	    'topmargin' => '0px',
		'bottommargin' => '0px',
        'align' => 'center',
		'link' => '',
		'size' => '50px',
		'color' => '#000000',
		'shadowcolor' => '#789AFF',
		'icon1' => 'home',
		'text1' => 'NEON TEXT',
		'icon2' => '',
		'text2' => '',
		'icon3' => '',
    ), $atts ) );
     return '<div class="'. $classname .'" style="margin-top: '. $topmargin .'; margin-bottom: '. $bottommargin .'; text-align: '. $align .';"><a href="'. $link .'"><span style="font-size: '. $size .'; color: '. $color .';"><i class="fa fa-'. $icon1 .'">  '. $text1 .' <i class="fa fa-'. $icon2 .'"> '. $text2 .' <i class="fa fa-'. $icon3 .'"> </i></i></i></span></a></div>
	 
<style type="text/css">
.'. $classname .' {
transition: 1s ease-in-out; 
line-height: 125%;
text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px '. $shadowcolor .', 0 0 30px '. $shadowcolor .', 0 0 40px '. $shadowcolor .', 0 0 55px '. $shadowcolor .', 0 0 75px '. $shadowcolor .';
}

.'. $classname .':hover  {
  transform: perspective(400px) rotateX(20deg) rotateY(-15deg);
  text-shadow: 10px 10px 10px '. $shadowcolor .';
}
</style>';
}
add_shortcode( 'wptc-neon', 'wptc_neon_shortcode' );

/* LinkBox Shortcode */
/* [wptc-linkbox link="javascript:;" target="_self" image="" width="25%" title="Linkbox Title"]Content[/wptc-linkbox] */
function wptc_linkbox_shortcode ( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'link' => 'javascript:;',
		'target' => '_self',
		'image' => 'http://goo.gl/m2pkvN',
		'width' => '25%',
		'title' => 'LinkBox Title',
	), $atts ) );
    return '<div class="qt-linkbox"><a href="'. $link .'" target="'. $target .'" rel="noopener noreferrer"><img class="linkbox-image" src="'. $image .'" width="'. $width .'" height="" /></a>
<div class="linkbox-title">
<h2><a href="'. $link .'" target="'. $target .'" rel="noopener noreferrer"><strong>'. $title .'</strong></a></h2>
</div>
<div class="linkbox-text">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'wptc-linkbox', 'wptc_linkbox_shortcode' );

/* Read More Shortcode */
/* [wptc-more more="Read more" less="read less" align="left" color="red" size="80%"]Content[/wptc-more] */
add_shortcode( 'wptc-more', 'wptc');
function wptc( $attr, $smcontent ) {
  if (!isset($attr['color'])) $attr['color'] = '#cc0000';
  if (!isset($attr['list'])) $attr['list'] = '';
  if (!isset($attr['align'])) $attr['align'] = 'left';
  if (!isset($attr['more'])) $attr['more'] = 'Read more';
  if (!isset($attr['less'])) $attr['less'] = 'Read less';
  if (!isset($attr['size'])) $attr['size'] = '80%';
  $wptc_string  = '<div class="show_more">';
  $wptc_string .= '<p class="wptc-show" style="color: ' . $attr['color'] .'; font-size: ' . $attr['size'] . '; text-align: ' . $attr['align'] .';">'; 
  $wptc_string .= $attr['list']. ' '  . $attr['more'];
  $wptc_string .= '</p><div class="wptc-content">';
  $wptc_string .= do_shortcode($smcontent);
  $wptc_string .= ' <p class="wptc-hide" style="color: ' . $attr['color'] .'; font-size: ' . $attr['size'] . '; text-align: ' . $attr['align'] .';">'; 
  $wptc_string .= $attr['list']. ' '  . $attr['less'];
  $wptc_string .= '</p>';
  $wptc_string .= '</div></div>';
  return $wptc_string;
}

/* Animation Shortcode */
/* [wptc-animate class="wow zoomIn" duration="1" delay="0" offset="270" iteration="1"]Content[/wptc-animate] */
function wptc_animate_shortcode ( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'wow zoomIn',
		'duration' => '1',
		'delay' => '0',
		'offset' => '270',
		'iteration' => '1',
	    ), $atts ) );
    return '<div class="'. $class .'" data-wow-duration="'. $duration .'s" data-wow-delay="'. $delay .'s" data-wow-offset="'. $offset .'" data-wow-iteration="'. $iteration .'">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-animate', 'wptc_animate_shortcode' );

/* Box Shortcode */
/* [wptc-box background="#444444" color="#dedede" size="16px" radius="10px" width="98%" opacity="1"]Content[/wptc-box] */
function wptc_box_shortcode ( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'background' => '#444444',
		'color' => '#dedede',
		'size' => '16px',
		'radius' => '10px',
		'width' => '90%',
		'opacity' => '1',
    ), $atts ) );
    return '<div class="qt-box" style="max-width: 95%; padding: 20px; margin: 10px; background: '. $background .'; color: '. $color .'; font-size: '. $size .'; border-radius: '. $radius .'; box-shadow: 0 0 0 4px '. $background .', 2px 1px 6px 4px rgba(10, 10, 0, 0.5); width: '. $width .'; opacity: '. $opacity .'; margin-left: auto !important; margin-right: auto !important;
   font-weight: normal;">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-box', 'wptc_box_shortcode' );

/* LogoText */
/* [wptc-logotext topmargin="0px" bottommargin="0px" align="center" link="" size="50px" color="" icon1="home" text1="LOGO TEXT" icon2="" text2="" icon3=""] */
function wptc_logotext_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	    'topmargin' => '0px',
		'bottommargin' => '0px',
        'align' => 'center',
		'link' => '',
		'size' => '50px',
		'color' => '',
		'icon1' => 'home',
		'text1' => 'LOGO TEXT',
		'icon2' => '',
		'text2' => '',
		'icon3' => '',
    ), $atts ) );
     return '<div class="qt-logotext" style="margin-top: '. $topmargin .'; margin-bottom: '. $bottommargin .'; text-align: '. $align .';"><a href="'. $link .'"><span style="font-size: '. $size .'; color: '. $color .';"><i class="fa fa-'. $icon1 .'">  '. $text1 .' <i class="fa fa-'. $icon2 .'"> '. $text2 .' <i class="fa fa-'. $icon3 .'"> </i></i></i></span></a></div>';
}
add_shortcode( 'wptc-logotext', 'wptc_logotext_shortcode' );

/* Images */
/* [wptc-image url="" width="100%" align="alignleft" shadow="shadow" corners="rounded10" lightbox="lightbox" alt="" margintop="0px" marginright="0px" marginbottom="0px" marginleft="0px"] */
function wptc_image_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'url' => '',
		'width' => '100%',
		'align' => 'alignleft',
		'shadow' => 'shadow',
		'corners' => 'rounded10',
		'lightbox' => 'lightbox',
		'alt' => '',
		'margintop' => '0px',
		'marginright' => '0px',
		'marginbottom' => '0px',
		'marginleft' => '0px',
	), $atts ) );
     return '<img class="qt-image '. $align .' size-large '. $shadow .' '. $corners .' '. $lightbox .'" style="margin-top: '. $margintop .'; margin-right: '. $marginright .'; margin-bottom: '. $marginbottom .'; margin-left: '. $marginleft .';" src="'. $url .'" alt="'. $alt .'" width="'. $width .'" />';
}
add_shortcode( 'wptc-image', 'wptc_image_shortcode' );

/* wptc-highlight */
/* [wptc-highlight size="" color="#ffffff" backcolor="#000000"]Content[/wptc-highlight]*/
function wptc_highlight_shortcode( $atts , $content = null ) {

	extract( shortcode_atts( array(
			'size' => '',
			'color' => '#ffffff',
			'backcolor' => '#000000',
			), $atts ) );

	return '<span style="padding:5px; font-size: '. $size .'; color: '. $color .'; background: '. $backcolor .';">' . do_shortcode( $content ) . '</span>';
}
add_shortcode( 'wptc-highlight', 'wptc_highlight_shortcode' );

/* Code */
/* [wptc-code background="#e8e8e8" fontcolor="#444"][/wptc-code] */
function wptc_code_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'background' => '#e8e8e8',
		'fontcolor' => '#444',
		), $atts ) );
     return '<pre class="qt-code" style="line-height: 90%; background: '. $background .'; padding: 15px;"><code style="color: '. $fontcolor .';">' . do_shortcode( $content ) . '</code></pre>';
}
add_shortcode( 'wptc-code', 'wptc_code_shortcode' );

/* Headings */
/* [wptc-heading topmargin="0px" bottommargin="0px" align="center" iconsize="75px" iconcolor="" icon="home" iconpadding="30px" headingsize="75px" headingcolor="" heading="Heading"] */
function wptc_heading_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'topmargin' => '0px',
		'bottommargin' => '0px',
		'align' => 'center',
		'iconsize' => '75px',
		'iconcolor' => '',
		'icon' => 'home',
		'iconpadding' => '30px',
		'headingsize' => '75px',
		'headingcolor' => '',
		'heading' => 'Heading',
    ), $atts ) );
     return '<div class="qt-heading">
<p style="margin-top: '. $topmargin .'; margin-bottom: '. $bottommargin .'; text-align: '. $align .';"><span style="font-size: '. $iconsize .'; color: '. $iconcolor .';"><i class="fa fa-'. $icon .'"><span style="padding-left: '. $iconpadding .'; font-size: '. $headingsize .'; color: '. $headingcolor .';">'. $heading .'</span></i></span></p>
</div>';
}
add_shortcode( 'wptc-heading', 'wptc_heading_shortcode' );


// ==============================================
/* Google Trends */
// ==============================================
function wps_trend($atts){
        extract( shortcode_atts( array(
                'w' => '500',           // width
                'h' => '330',           // height
                'q' => '',              // query
                'geo' => 'US',          // geolocation
        ), $atts ) );
        //format input
        $h=(int)$h;
        $w=(int)$w;
        $q=esc_attr($q);
        $geo=esc_attr($geo);
         ob_start();
?>
<script type="text/javascript" src="http://www.google.com/trends/embed.js?hl=en-US&q=<?php echo $q;?>&geo=<?php echo $geo;?>&cmpt=q&content=1&cid=TIMESERIES_GRAPH_0&export=5&w=<?php echo $w;?>&h=<?php echo $h;?>"></script>
<?php
return ob_get_clean();
}
add_shortcode("wptc-trends","wps_trend");

/* Cards */
/* [wptc-card ] */
function wptc_card_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'image' => '',
		'lightbox' => 'lightbox',
		'title' => 'Card Title',
		'title_color' => '',
		'title_size' => '24px',
		'border' => '',
    ), $atts ) );
     return '<div class="qt-card '. $border .'"><div style="text-align: center;"><img class="size-full aligncenter '. $lightbox .'" style="margin-top: 0;" src="'. $image .'"/></div>
<div style="padding-top: 15px; padding-bottom: 0px; padding-right: 15px; padding-left: 15px; text-align: center;"><span style="color: '. $title_color .'; font-size: '. $title_size .';"><strong>'. $title .'</strong></span></div>
<div style="padding-top: 0px; padding-bottom: 15px; padding-right: 15px; padding-left: 15px;">' . do_shortcode( $content ) . '</div></div><br>';
}
add_shortcode( 'wptc-card', 'wptc_card_shortcode' );

/* Youtube Card */
/* [wptc-youtube-card id="video-id"] */
function wptc_youtube_card_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '',
		'autoplay' => '0',
		'title' => 'Youtube Card Title',
		'title_color' => '',
		'title_size' => '24px',
		'border' => '',
    ), $atts ) );
     return '<div class="qt-vimeo-card '. $border .'"> <div class="video-card"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://youtube.com/embed/'. $id .'?autoplay='. $autoplay .'" frameborder="0" allowFullScreen></iframe></div></div><p style="padding:15px;text-align: center;"><strong><span style="color:'. $title_color .'; font-size:'. $title_size .';">'. $title .'</span></strong></p><div style="padding:15px;">' . do_shortcode( $content ) . '</div></div><br>';
}
add_shortcode( 'wptc-youtube-card', 'wptc_youtube_card_shortcode' );

/* Vimeo Card */
/* [wptc-vimeo-card id="video-id"] */
function wptc_vimeo_card_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '',
		'autoplay' => '0',
		'title' => 'Vimeo Card Title',
		'title_color' => '',
		'title_size' => '24px',
		'border' => '',
    ), $atts ) );
     return '<div class="qt-vimeo-card '. $border .'"> <div class="video-card"><style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://player.vimeo.com/video/'. $id .'?autoplay='. $autoplay .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div><p style="padding:15px;text-align: center;"><strong><span style="color:'. $title_color .'; font-size:'. $title_size .';">'. $title .'</span></strong></p><div style="padding:15px;">' . do_shortcode( $content ) . '</div></div><br>';
}
add_shortcode( 'wptc-vimeo-card', 'wptc_vimeo_card_shortcode' );

/* Responsive Iframe */
/* [wptc-iframe url="url"] */
function wptc_iframe_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'url' => '',
	), $atts ) );
     return '<div class="qt-iframe"> <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="'. $url .'" style="border:0"></iframe></div>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-iframe', 'wptc_iframe_shortcode' );

/* Responsive Vimeo Video */
/* [wptc-vimeo id="video-id"] */
function wptc_vimeo_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '',
		'autoplay' => '0',
    ), $atts ) );
     return '<div class="qt-vimeo"> <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://player.vimeo.com/video/'. $id .'?autoplay='. $autoplay .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-vimeo', 'wptc_vimeo_shortcode' );

/* Responsive Youtube Video */
/* [wptc-youtube id="video-id"] */
function wptc_youtube_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '',
		'autoplay' => '0',
    ), $atts ) );
     return '<div class="qt-youtube"> <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://www.youtube.com/embed/'. $id .'?autoplay='. $autoplay .'" frameborder="0" allowfullscreen></iframe></div>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-youtube', 'wptc_youtube_shortcode' );

/* wptc-feature */
function wptc_feature_shortcode( $atts , $content = null ) {

             extract( shortcode_atts( array(
			'link' => '',
			'target' => '_self',
			'size' => '300%',
			'icon1' => 'circle',
			'icon1color' => '#000000',
			'icon2' => 'home',
			'icon2color' => '#ffffff',
			'title' => 'Feature Title',
			'titlecolor' => '',
			'border' => 'wptc-border',
			), $atts ) );
	

	return '<div class="qt-feature '. $border .'">
<p style="text-align: center;"><a href="' . $link . '" target="' . $target . '"><span class="fa-stack" style="font-size:' . $size . ';"><i class="fa fa-' . $icon1 . ' fa-stack-2x" style="color:' . $icon1color . ';"></i><i class="fa fa-' . $icon2 . ' fa-stack-1x wptc-icon" style="color:' . $icon2color . ';"></i></span></a></p><h2 style="text-align: center;color:' . $titlecolor . ';"><strong>' . $title . '</strong></h2><div style="text-align: center;padding:15px;">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'wptc-feature', 'wptc_feature_shortcode' );

/* ===================================================================
 *
 * Single Background - [single_bg url="http://yoursite.com/my-image.jpg"] or [single_bg color="#000000"]
 *
 * ================================================================ */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function the_single_background_plugin( $atts, $content = null ) {
	
	if( is_single() or is_page() ){
		
		Extract(
			shortcode_atts(
				array(
					"url"		=>	"",
					"color"		=>	"" 
				),$atts
			)
		);
		
		if ( !empty($url) ){ 
			return '<style type="text/css">	
						html{
							background-image:none !important;
							background:none !important;
						}
						body{
							background:url('.$url.') 0 0 fixed no-repeat !important;
							background-size:100% 100% !important;
							-webkit-background-size:100% 100% !important;
							-moz-background-size:100% 100% !important;
							-o-background-size:100% 100% !important;
						}
						/*
						body.logged-in{
							background-position: 0 -32px !important;
						}
						*/
#main {background: transparent;}
					</style>';
			return false;
		} 
		
		if ( !empty($color) ){ 
			return '<style type="text/css">	
						html{
							background-image:none !important;
							background:none !important;
						}
						body{
							background-image:none !important;
							background:none !important;
							background-color:'.$color.' !important;
						}
#main {background: transparent;}
					</style>';
		} 
	
	} 
	
} 
add_shortcode("wptc-single-bg", "the_single_background_plugin"); 

/* Directions */
/* [wptc-directions location="Microsoft"] */
function wptc_directions_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array (
	    'location'   => 'Location',
	), $atts ) );
      return '<div class="qt-directions"><form action="http://maps.google.com/maps" method="get" target="_blank">
   <label for="saddr">Enter your location</label>
   <input type="text" name="saddr" />
   <input type="hidden" name="daddr" value="' .$location. '" />
   <input style="margin-top:5px;color:#666" type="submit" value="Get directions" />
</form></div>';
}
add_shortcode( 'wptc-directions', 'wptc_directions_shortcode' );

/* wptc-MARGINS */
/* [wptc-margins top="" bottom="" right="" left=""]Content[/wptc-margins] */
function wptc_margins_shortcode( $atts , $content = null ) {

	extract( shortcode_atts( array(
			'margintop' => '0px',
			'marginbottom' => '0px',
			'marginright' => '0px',
			'marginleft' => '0px',
			'paddingtop' => '0px',
			'paddingbottom' => '0px',
			'paddingright' => '0px',
			'paddingleft' => '0px',
			'bordercolor' => '',
			'borderstyle' => 'solid',
			'borderwidthtop' => '0px',
			'borderwidthright' => '0px',
			'borderwidthbottom' => '0px',
			'borderwidthleft' => '0px',
			), $atts ) );

	return '<div class="qt-margins" style="margin-top:' . $margintop . ';margin-bottom:' . $marginbottom . ';margin-right:' . $marginright . ';margin-left:' . $marginleft . ';padding-top:' . $paddingtop . ';padding-bottom:' . $paddingbottom . ';padding-right:' . $paddingright . ';padding-left:' . $paddingleft . ';border-color:' . $bordercolor . ';border-style:' . $borderstyle . ';border-top-width:' . $borderwidthtop . ';border-right-width:' . $borderwidthright . ';border-bottom-width:' . $borderwidthbottom . ';border-left-width:' . $borderwidthleft . ';">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-margins', 'wptc_margins_shortcode' );

/* No IE 10 and 11 */
function wptc_noie_shortcode ( $atts, $content = null ) {
    return '<div class="noie">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-noie', 'wptc_noie_shortcode' );

/* Show on Large Monitors only 1370px or bigger */
function wptc_desktop_shortcode ( $atts, $content = null ) {
    return '<div class="wptc-desktop">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-desktop', 'wptc_desktop_shortcode' );

/* Show on Laptop and smaller devices 1370px or smaller */
function wptc_laptop_shortcode ( $atts, $content = null ) {
    return '<div class="wptc-laptop">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-laptop', 'wptc_laptop_shortcode' );

/* Desktop No Show */
function wptc_nodesktop_shortcode ( $atts, $content = null ) {
    return '<div class="desktop-no-show">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-nodesktop', 'wptc_nodesktop_shortcode' );

/* Tablet No Show */
function wptc_notablet_shortcode ( $atts, $content = null ) {
    return '<div class="tablet-no-show">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-notablet', 'wptc_notablet_shortcode' );

/* Phone No Show */
function wptc_nophone_shortcode ( $atts, $content = null ) {
    return '<div class="phone-no-show">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-nophone', 'wptc_nophone_shortcode' );

/* Responsive No Show */
function wptc_noresponsive_shortcode ( $atts, $content = null ) {
    return '<div class="tablet-no-show phone-no-show">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-noresponsive', 'wptc_noresponsive_shortcode' );

/* wptc-CALLOUT */
/* [wptc-callout align="center" icon="home" iconcolor="" title="Title" titlecolor="" image=""]Content[/wptc-callout] */
function wptc_callout_shortcode( $atts , $content = null ) {

	extract( shortcode_atts( array(
			'align' => 'left',
			'icon' => 'home',
			'iconcolor' => '',
			'title' => 'Callout Title',
			'titlecolor' => '',
			'image' => 'http://goo.gl/m2pkvN',
			), $atts ) );

	return '<div class="qt-callout">
<h1 style="text-align:' . $align . ';"><i class="fa fa-' . $icon . '" style="color: ' . $iconcolor . ';"></i>&nbsp;&nbsp;<span style="color: ' . $titlecolor . ';">' . $title . '</span></h1></br>
<img class="aligncenter size-full" src="' . $image . '" />' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-callout', 'wptc_callout_shortcode' );

/* wptc-AUTOCOLUMNS */
/* [wptc-autocolumns columns="3" columngap="40px" paddingright="20px" paddingleft="20px"] */
function wptc_autocolumns_shortcode( $atts , $content = null ) {

	extract( shortcode_atts( array(
			'columns' => '3',
			'columngap' => '40px',
			'paddingright' => '20px',
			'paddingleft' => '20px',
			), $atts ) );

	return '<div class="qt-autocolumns" style="-moz-column-count:' . $columns . ';-moz-column-gap:' . $columngap . '; -webkit-column-count:' . $columns . ';-webkit-column-gap:' . $columngap . ';column-count:'. $columns . ';column-gap:' . $columngap . ';padding-right:' . $paddingright . ';padding-left:' . $paddingleft . ';">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-autocolumns', 'wptc_autocolumns_shortcode' );

/* Call To Action */
/* [wptc-cta]content[/wptc-cta] */
function wptc_cta_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'iconcolor' => '',
		'iconname' => 'home',
		'title' => 'Call To Action Title',
		'titlecolor' => '',
		'buttonlabel'   => 'Button',
        'buttonlink'   => '',
		'buttontarget'   => '_self',
		'buttonalign'   => 'center',
		'background'   => '#ffffff',
		'opacity'   => '1',
	), $atts ) );
     return '<div class="qt-cta" style="background: '. $background .' !important;opacity: '. $opacity .';background-size:cover !important;-webkit-box-shadow: #444 1px 1px 5px ;-moz-box-shadow: #444 1px 1px 5px ;box-shadow: #444 1px 1px 5px ;padding-top: 15px ;padding-right: 15px ;padding-bottom: 60px ;padding-left: 15px ;border-top-color: #DDDDDD ;border-right-color: #DDDDDD ;border-bottom-color: #DDDDDD ;border-left-color: #DDDDDD ;border-top-width: 1px ;border-right-width: 1px ;border-bottom-width: 1px ;border-left-width: 1px ;border-top-style: solid ;border-right-style: solid ;border-bottom-style: solid ;border-left-style: solid ;-webkit-border-radius: 10px 10px 10px 10px ;-moz-border-radius: 10px 10px 10px 10px ;border-radius: 10px 10px 10px 10px ;">
<p style="text-align: center; color: '. $iconcolor .';"><i class="fa fa-'. $iconname .' fa-5x"> </i></p> 
<h1 style="color: '. $titlecolor .';text-align: center; font-weight: bold;">'. $title .'</h1>' . do_shortcode( $content ) . '
<p style="text-align: ' . $buttonalign . ';"><a style="padding-top: 10px;padding-bottom: 10px;padding-right: 60px;padding-left: 60px;font-size: 16px;" class="button" href="' . $buttonlink . '" target="' .$buttontarget . '">' .$buttonlabel. '</a></p></div></br>';
}
add_shortcode( 'wptc-cta', 'wptc_cta_shortcode' );

/* Call To Action Small */
/* [wptc-cta-small]content[/wptc-cta-small] */
function wptc_cta_small_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'iconcolor' => '',
		'iconname' => 'home',
		'title' => 'Call To Action Title',
		'titlecolor' => '',
		'buttonlabel'   => 'Button',
        'buttonlink'   => '',
		'buttontarget'   => '_self',
		'buttonalign'   => 'center',
		'background'   => '#ffffff',
		'opacity'   => '1',
	), $atts ) );
     return '<div class="qt-cta-small" style="background: '. $background .' !important;opacity: '. $opacity .';background-size:cover !important;-webkit-box-shadow: #444 1px 1px 5px ;-moz-box-shadow: #444 1px 1px 5px ;box-shadow: #444 1px 1px 5px ;padding-top: 15px ;padding-right: 15px ;padding-bottom: 15px ;padding-left: 15px ;border-top-color: #DDDDDD ;border-right-color: #DDDDDD ;border-bottom-color: #DDDDDD ;border-left-color: #DDDDDD ;border-top-width: 1px ;border-right-width: 1px ;border-bottom-width: 1px ;border-left-width: 1px ;border-top-style: solid ;border-right-style: solid ;border-bottom-style: solid ;border-left-style: solid ;-webkit-border-radius: 10px 10px 10px 10px ;-moz-border-radius: 10px 10px 10px 10px ;border-radius: 10px 10px 10px 10px ;">
<h1 style="text-align: center; color: '. $iconcolor .';"><i class="fa fa-'. $iconname .' fa-1x"> </i> <span style="color: '. $titlecolor .';text-align: center;">' . $title . '</span></h1>' . do_shortcode( $content ) . '
<p style="text-align: ' . $buttonalign . ';"><a class="button" href="' . $buttonlink . '" target="' .$buttontarget . '">' .$buttonlabel. '</a></p></div></br>';
}
add_shortcode( 'wptc-cta-small', 'wptc_cta_small_shortcode' );

/* Create a boxed section */
/* [wptc-section background=#dddddd]content[/wptc-section] */
function wptc_section_box_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'background' => '#dddddd',
    ), $atts ) );
     return '<div id="qt-section" style="background-color: ' . $background .';padding-top:30px;padding-bottom:30px;padding-left:30px;padding-right:30px;margin-right: -20px;margin-left: -20px;">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-section-box', 'wptc_section_box_shortcode' );

/* Add Vertical space */
/* [wptc-space height=200px] */
function wptc_space_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'height' => '200px',
    ), $atts ) );
     return '<div style="margin: '. $height .' 0;">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-space', 'wptc_space_shortcode' );

/* Stitched Shortcode */
/* [wptc-stitch background="#444444" color="#dedede" size="21px"]Content[/wptc-stitch] */
function wptc_stitch_shortcode ( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'background' => '#444444',
		'color' => '#dedede',
		'size' => '21px',
    ), $atts ) );
    return '<div class="qt-dash" style="padding: 20px; margin: 10px; background: '. $background .'; color: '. $color .'; font-size: '. $size .'; line-height: 1.3em; border: 2px dashed #fff; border-radius: 10px; box-shadow: 0 0 0 4px '. $background .', 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
   font-weight: normal;">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-stitch', 'wptc_stitch_shortcode' );

/* Theme button */
/* [wptc-themebutton label=Microsoft link=microsoft.com target=_blank align=right] */
function wptc_themebutton_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array (
	    'icon'   => 'Icon',
	    'label'   => 'Button',
        'link'   => '#',
		'target'   => '_self',
		'align'   => 'center',
    ), $atts ) );
	return '<p style="text-align: ' . $align . ';"><a class="button" href="' . $link . '" target="' .$target . '"><i class="fa fa-' .$icon. '"></i> ' .$label. '</a></p>';
}
add_shortcode( 'wptc-themebutton', 'wptc_themebutton_shortcode' );

/* Parent theme uri */
/* [wptc-parent-uri] */
function wptc_parent_uri_shortcode( $atts, $content = null ) {
    return get_template_directory_uri();
}
add_shortcode( 'wptc-parent-uri', 'wptc_parent_uri_shortcode' );
add_shortcode( 'tux-parent-uri', 'wptc_parent_uri_shortcode' );

/* Child theme uri */
/* [wptc-child-uri] */
function wptc_child_uri_shortcode( $atts, $content = null ) {
    return get_stylesheet_directory_uri();
}
add_shortcode( 'wptc-child-uri', 'wptc_child_uri_shortcode' );
add_shortcode( 'tux-child-uri', 'wptc_child_uri_shortcode' );

/* Search form */
/* [wptc-search-form] */
function wptc_search_form_shortcode( $atts, $content = null ) {
    return get_search_form( false );
}
add_shortcode( 'wptc-search-form', 'wptc_search_form_shortcode' );
add_shortcode( 'tux-search-form', 'wptc_search_form_shortcode' );

/* Creates a button */
/* [wptc-button link="http://mysite.com" target="_blank" type="primary" size="large" style="padding:10px;"]content[/wptc-button] */
function wptc_button_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array (
	    'icon'   => '',
        'type'   => '',
        'size'   => '',
        'style'  => '',
        'link'   => '',
        'target' => '',
    ), $atts ) );
    if ( !empty( $type ) ) $type = ' btn-' . $type;
    if ( !empty( $size ) ) $size = ' btn-' . $size;
    if ( !empty( $style ) ) $style = ' style="' . $style . '"';
    if ( !empty( $target ) ) $target = ' target="' . $target . '"';
    return '<a href="' . $link . '"' . $target . ' class="button' . $type . $size . '"' . $style . '><i class="fa fa-' .$icon. '"></i> ' . do_shortcode( $content ) . '</a>';
}
add_shortcode( 'wptc-button', 'wptc_button_shortcode' );
add_shortcode( 'tux-button', 'wptc_button_shortcode' );

/* Create an alert */
/* [wptc-alert type="success"]content[/wptc-alert] */
function wptc_alert_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'type' 	     => '',
	'textalign' => '',
    ), $atts ) );
    if ( !empty( $type ) ) $type = ' alert-' . $type;
    if ( !empty( $textalign ) ) $textalign = ' style="text-align:' . $textalign . '"';
    return '<div class="qt-alert alert' . $type . '"' . $textalign . '>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-alert', 'wptc_alert_shortcode' );
add_shortcode( 'tux-alert', 'wptc_alert_shortcode' );

/* Show content to logged in users only */
/* [wptc-members]content[/wptc-members] */
function wptc_members_shortcode( $atts, $content = null ) {
    if ( is_user_logged_in() )
	return do_shortcode( $content );
    return '';
}
add_shortcode( 'wptc-members', 'wptc_members_shortcode' );
add_shortcode( 'tux-members', 'wptc_members_shortcode' );

/* Show content to logged out users only */
/* [wptc-guests]content[/wptc-guests] */
function wptc_guests_shortcode( $atts, $content = null ) {
    if ( !is_user_logged_in() )
	return do_shortcode( $content );
    return '';
}
add_shortcode( 'wptc-guests', 'wptc_guests_shortcode' );
add_shortcode( 'tux-guests', 'wptc_guests_shortcode' );

/* Show a snapshot of any website */
/* [wptc-snap url="http://somesite.com" alt="SomeSite.com Website" w="400" h="300"] */
function wptc_snap_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'snap' => 'http://s.wordpress.com/mshots/v1/',
        'url'  => 'http://www.google.com/',
        'alt'  => 'Google',
        'w'    => '400',
        'h'    => '300'
    ), $atts ) );
    return '<img alt="' . $alt . '" src="' . $snap . '' . urlencode( $url ) . '?w=' . $w . '&h=' . $h . '" />';
}
add_shortcode( 'wptc-snap', 'wptc_snap_shortcode' );
add_shortcode( 'tux-snap', 'wptc_snap_shortcode' );

/* Show the current year */
/* [wptc-year] */
function wptc_year_shortcode( $atts, $content = null ) {
    return date( 'Y' );
}
add_shortcode( 'wptc-year', 'wptc_year_shortcode' );
add_shortcode( 'tux-year', 'wptc_year_shortcode' );

/* Show a login form */
/* [wptc-login avatarsize="70"] */
function wptc_login_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	'avatarsize' => '70'
    ), $atts ) );
    if ( !is_user_logged_in() ) {
	return '<div class="login-shortcode">' . wp_login_form( array( 'echo' => 0 ) ) . '<p class="login-shortcode-bottom"><a href="' . wp_lostpassword_url( $_SERVER['REQUEST_URI'] ) . '" title="Lost Password">' . __( 'Lost Password', 'wptc_theme_td' ) . '</a> ' . wp_register( '', '', false ) . '</p></div>';
    } else {
        global $current_user;
        return '<div class="login-shortcode">' .
	( intval( $avatarsize ) > 0 ? '<div class="login-shortcode-avatar">' . get_avatar( $current_user->ID, intval( $avatarsize ) ) . '</div>' : '' ) .
        '<p class="login-shortcode-welcome">' . sprintf( __( 'Welcome %s', 'wptc_theme_td' ), $current_user->display_name ) . '</p>' .
        '<p class="login-shortcode-bottom">' .
        ( current_user_can( 'edit_posts' ) ? wp_register( '', '', false ) . ' ' : '' ) .
        '<a href="' . wp_logout_url( $_SERVER['REQUEST_URI'] ) . '" title="Logout">' . __( 'Logout', 'wptc_theme_td' ) . '</a>' .
	'</p></div>';
    }
    return '';
}
add_shortcode( 'wptc-login', 'wptc_login_shortcode' );
add_shortcode( 'tux-login', 'wptc_login_shortcode' );

/* Show a simple sitemap */
/* [wptc-sitemap pages="true" categories="true" archives="true" postspercat="false"] */
function wptc_sitemap_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
		'pages'	      => 'true',
		'categories'  => 'true',
		'archives'    => 'true',
		'postspercat' => 'false'
    ), $atts ) );
?>
    <div>
<?php if ( $pages == 'true' ) { ?>        <div>
	    <h2><?php _e('Pages', ''); ?></h2>
	    <ul>
		<?php wp_list_pages('title_li='); ?>
	    </ul>
	</div><?php } ?>
<?php if ( $categories == 'true' ) { ?>        <div>
	    <h2><?php _e('Categories', ''); ?></h2>
	    <ul>
		<?php wp_list_categories('title_li='); ?>
	    </ul>
	</div><?php } ?>
<?php if ( $archives == 'true' ) { ?>        <div>
	    <h2><?php _e('Archives', ''); ?></h2>
	    <ul>
		<?php wp_get_archives('type=monthly&show_post_count=0'); ?>
	    </ul>
	</div><?php } ?>
<?php if ( $postspercat == 'true' ) { ?>        <div>
	    <h2><?php _e('Posts per category', ''); ?></h2>
	    <?php
		$cats = get_categories();
		foreach ( $cats as $cat ) {
		query_posts( 'cat=' . $cat->cat_ID );
	    ?>
	    <h3><?php echo $cat->cat_name; ?></h3>
	    <ul>
		<?php while ( have_posts() ) { the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php } wp_reset_query(); ?>
	    </ul>
	    <?php } ?>
	</div><?php } ?>
    </div>
<?php
}
add_shortcode( 'wptc-sitemap', 'wptc_sitemap_shortcode' );
add_shortcode( 'tux-sitemap', 'wptc_sitemap_shortcode' );

/* Create a full width section */
/* [wptc-section fullwidth="true" color="#dddddd" image="" parallax="false" padding="10"]content[/wptc-section] */
function wptc_section_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'fullwidth' => 'true',
		'color' => '#ffffff',
		'image' => '',
		'parallax' => 'false',
		'padding' => '10'
    ), $atts ) );
    if ( !empty( $image ) ) {
	$image = ' url(' . $image . ')';
	if ( $parallax == 'true' ) $image .= ' fixed';
	$image .= ' center center; background-size:cover';
    }
    $boxsizing = ( $fullwidth == 'true' ? 'content-box' : 'border-box' );
    $padding = ' padding:' . $padding . 'px ' . ( ( $fullwidth == 'true' ) ? '2000px; margin:0 -2000px;' : $padding . 'px; margin:0;' );
    return '<div class="qt-fullsection clearfix" style="-webkit-box-sizing:' . $boxsizing . '; -moz-box-sizing:' . $boxsizing . '; box-sizing:' . $boxsizing . '; width:100%; background:' . $color . $image . ';' . $padding . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-section', 'wptc_section_shortcode' );
add_shortcode( 'tux-section', 'wptc_section_shortcode' );

/* List pages */
/* [wptc-list-pages include=1 grid=2] */
function wptc_list_pages_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'sort_order' 	   => 'ASC',
		'sort_column' 	   => 'post_title',
		'hierarchical' 	   => 1,
		'exclude' 		   => '',
		'include' 		   => '',
		'meta_key' 		   => '',
		'meta_value' 	   => '',
		'authors' 		   => '',
		'child_of' 		   => 0,
		'parent' 		   => -1,
		'exclude_tree' 	   => '',
		'number' 		   => '',
		'offset' 		   => 0,
		'post_type' 	   => 'page',
		'post_status' 	   => 'publish',
		'before'		   => '',
		'after'			   => '',
		'before_title'	   => '<h3>',
		'after_title'	   => '</h3>',
		'title'			   => 'true',
		'title_link'	   => 'true',
		'before_content'   => '<p>',
		'after_content'    => '</p>',
		'content'		   => 'true',
		'grid'			   => '1',
		'thumbnail'		   => 'true',
		'thumbnail_size'   => 'thumbnail',
		'thumbnail_align'  => 'left'
	), $atts ) );
	$show_posts = get_pages( array(
		'sort_order' 	   => $sort_order,
		'sort_column' 	   => $sort_column,
		'hierarchical' 	   => $hierarchical,
		'exclude' 		   => $exclude,
		'include' 		   => $include,
		'meta_key' 		   => $meta_key,
		'meta_value' 	   => $meta_value,
		'authors' 		   => $authors,
		'child_of' 		   => $child_of,
		'parent' 		   => $parent,
		'exclude_tree' 	   => $exclude_tree,
		'number' 		   => $number,
		'offset' 		   => $offset,
		'post_type' 	   => $post_type,
		'post_status' 	   => $post_status
	) );
	global $post;
	$grid = intval( $grid );
	$grid = min( max( $grid, 1 ), 4 );
	$out = '';
	if ( $show_posts ) {
		$out = html_entity_decode( $before );
		$i = 0;
		$cur = 0;
		$post_count = count( $show_posts );
		foreach( $show_posts as $post ) {
			setup_postdata( $post );
			$cur++;
			$i++;
			if ( $i == 1 ) $out .= '<div class="content-layout"><div class="content-layout-row">';
			$out .= '<div class="layout-cell layout-cell-size' . $grid . '">';
			if ( $title == 'true' ) {
				$out .= html_entity_decode( $before_title ) . ( $title_link == 'true' ? '<a href="' . get_permalink() . '">' : '' ) . get_the_title() . ( $title_link == 'true' ? '</a>' : '' ) . html_entity_decode( $after_title );
			}
			if ( $content == 'true' ) {
				$out .= html_entity_decode( $before_content ) . ( $thumbnail == 'true' ? get_the_post_thumbnail( $post->ID, $thumbnail_size, array( 'class' => 'align' . $thumbnail_align ) ) : '' ) . ( $content == 'true' ? apply_filters( 'the_content', get_the_content() ) : '' ) . html_entity_decode( $after_content );
			}
			$out .= '</div>';
			if ( $i == $grid || $cur == $post_count ) {
				$out .= '</div></div>';
				$i = 0;
			}
		}
		wp_reset_postdata();
		$out .= html_entity_decode( $after );
	}
	return $out;
}
add_shortcode( 'wptc-list-pages', 'wptc_list_pages_shortcode' );
add_shortcode( 'tux-list-pages', 'wptc_list_pages_shortcode' );

/* List posts */
/* [wptc-list-posts post_type="post" category="" grid="3" thumbnail_size="full" thumbnail_align="center" posts_per_page="20"] */
function wptc_list_posts_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'before'		   => '',
		'after'			   => '',
		'before_title'	   => '<h3>',
		'after_title'	   => '</h3>',
		'title'			   => 'true',
		'title_link'	   => 'true',
		'before_content'   => '<p>',
		'after_content'    => '</p>',
		'excerpt'		   => 'true',
		'content'		   => 'false',
		'more_link_text'   => __( 'Read More...', 'wptc_theme_td' ),
		'grid'			   => '1',
		'thumbnail'		   => 'true',
		'thumbnail_size'   => 'thumbnail',
		'thumbnail_align'  => 'left'
	), $atts ) );
	$show_posts = get_posts( array(
		'posts_per_page'   => $posts_per_page,
		'offset'           => $offset,
		'category'         => $category,
		'category_name'    => $category_name,
		'orderby'          => $orderby,
		'order'            => $order,
		'include'          => $include,
		'exclude'          => $exclude,
		'meta_key'         => $meta_key,
		'meta_value'       => $meta_value,
		'post_type'        => $post_type,
		'post_mime_type'   => $post_mime_type,
		'post_parent'      => $post_parent,
		'post_status'      => $post_status,
		'suppress_filters' => $suppress_filters
	) );
	global $post;
	$grid = intval( $grid );
	$grid = min( max( $grid, 1 ), 4 );
	$out = '';
	if ( $show_posts ) {
		$out = html_entity_decode( $before );
		$i = 0;
		$cur = 0;
		$post_count = count( $show_posts );
		foreach( $show_posts as $post ) {
			setup_postdata( $post );
			$cur++;
			$i++;
			if ( $i == 1 ) $out .= '<div class="content-layout"><div class="content-layout-row">';
			$out .= '<div class="layout-cell layout-cell-size' . $grid . '">';
			if ( $title == 'true' ) {
				$out .= html_entity_decode( $before_title ) . ( $title_link == 'true' ? '<a href="' . get_permalink() . '">' : '' ) . get_the_title() . ( $title_link == 'true' ? '</a>' : '' ) . html_entity_decode( $after_title );
			}
			if ( $excerpt == 'true' || $content == 'true' ) {
				$out .= html_entity_decode( $before_content ) . ( $excerpt == 'true' ? ( $thumbnail == 'true' ? get_the_post_thumbnail( $post->ID, $thumbnail_size, array( 'class' => 'align' . $thumbnail_align ) ) : '' ) . get_the_excerpt() : '' ) . ( $content == 'true' ? apply_filters( 'the_content', get_the_content( $more_link_text ) ) : '' ) . html_entity_decode( $after_content );
			}
			$out .= '</div>';
			if ( $i == $grid || $cur == $post_count ) {
				$out .= '</div></div>';
				$i = 0;
			}
		}
		wp_reset_postdata();
		$out .= html_entity_decode( $after );
	}
	return $out;
}
add_shortcode( 'wptc-list-posts', 'wptc_list_posts_shortcode' );
add_shortcode( 'tux-list-posts', 'wptc_list_posts_shortcode' );

/* Creates a grid row */
/* [wptc-grid-row]content[/wptc-grid-row] */
function wptc_grid_row_shortcode( $atts, $content = null ) {
    return '<div class="content-layout"><div class="content-layout-row">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'wptc-grid-row', 'wptc_grid_row_shortcode' );
add_shortcode( 'tux-grid-row', 'wptc_grid_row_shortcode' );

/* Creates a grid column */
/* [wptc-grid-column size=4]content[/wptc-grid-column] */
function wptc_grid_column_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
	'size' => '1',
    ), $atts ) );
    return '<div class="layout-cell layout-cell-size' . $size . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'wptc-grid-column', 'wptc_grid_column_shortcode' );
add_shortcode( 'tux-grid-column', 'wptc_grid_column_shortcode' );

/* Creates a Font Awesome icon */
/* [wptc-icon name=flag style="padding:10px;"] */
function wptc_icon_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'name'  => '',
        'style' => '',
    ), $atts ) );
    if ( empty( $name ) ) return '';
    if ( !empty( $style ) ) $style = ' style="' . $style . '"';
    return '<i class="fa fa-' . $name . '"' . $style . '>&nbsp;</i>';
}
add_shortcode( 'wptc-icon', 'wptc_icon_shortcode' );
add_shortcode( 'tux-icon', 'wptc_icon_shortcode' );
?>