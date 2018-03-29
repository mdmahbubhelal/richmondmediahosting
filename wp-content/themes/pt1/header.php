<!DOCTYPE html>
<!-- Begin header.php --><?php global $theme_display_options, $post_theme_display_options; ?>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?php if ( $theme_display_options['doResponsiveDesign'] && !( $theme_display_options['showVisitorRespSwitch'] && isset( $_SESSION['showmobileresp'] ) && $_SESSION['showmobileresp'] == 'no' ) ) echo '<meta name="viewport" content="initial-scale = ' . abs( floatval( $theme_display_options['viewportInitScale'] ) ) . ', maximum-scale = ' . abs( floatval( $theme_display_options['viewportMaxScale'] ) ) . ', user-scalable = ' . ( $theme_display_options['viewportUserScalable'] ? 'yes' : 'no' ) . ', width = device-width">'; ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>

<style type="text/css">	
/* QT Media Queries Columns, autocolumns, Angie, QT Builder
*/

@media all and (max-width: <?php echo ( $theme_display_options['qtbreakpoint'] ) ?>)
{
    #resp, #resp-m { display: block !important; }
    #resp-t { display: none !important; }
	
.qt-autocolumns { display: inline !important; }

body .wc-shortcodes-one-half,
	body .wc-shortcodes-one-third,
	body .wc-shortcodes-two-third,
	body .wc-shortcodes-three-fourth,
	body .wc-shortcodes-one-fourth,
	body .wc-shortcodes-one-fifth,
	body .wc-shortcodes-two-fifth,
	body .wc-shortcodes-three-fifth,
	body .wc-shortcodes-four-fifth,
	body .wc-shortcodes-one-sixth,
	body .wc-shortcodes-five-sixth 
	{ width: 100%; float: none; margin-left: 0; margin-bottom: 20px; }

.qtbb-col{ width: 100% !important; margin: 0 !important; }
}
</style>
	
<?php if ( $theme_display_options['qtfontsettings'] ) : ?>	
<style type="text/css">
<?php if ( $theme_display_options['qtapplyheadercolor'] ) : ?>
.header {
background-image: url('') !important;
background-color: <?php echo ( $theme_display_options['qtheadercolor'] ) ?> !important;
}
<?php endif; ?>

<?php if ( $theme_display_options['qthidehomeheader'] ) : ?>
body.home .header {
   display:none;
}
<?php endif; ?>

.nav {
background: <?php echo ( $theme_display_options['qtnavcolor'] ) ?>;
background: -webkit-linear-gradient(<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: -o-linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: -moz-linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
}

.desktop-nav div {
background: <?php echo ( $theme_display_options['qtnavcolor'] ) ?>;
background: -webkit-linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: -o-linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: -moz-linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
background: linear-gradient (<?php echo ( $theme_display_options['qtnavcolor'] ) ?>, <?php echo ( $theme_display_options['qtnavcolor'] ) ?>);
}

.sheet {
	background-color: <?php echo ( $theme_display_options['qtsheetcolor'] ) ?> !important;
}

.postcontent, .content li {
	font-size: <?php echo ( $theme_display_options['qtfontsize'] ) ?>;
	line-height: <?php echo ( $theme_display_options['qtfontlineheight'] ) ?>;
	color: <?php echo ( $theme_display_options['qtfontcolor'] ) ?>;
}

.postheadericon {
	font-size: <?php echo ( $theme_display_options['qttitlesize'] ) ?>;
	color: <?php echo ( $theme_display_options['qttitlecolor'] ) ?>;
	line-height: <?php echo ( $theme_display_options['qttitlelineheight'] ) ?>;
}

/** Post Header Link **/ 
.postheader a {
	display: block !important;
    color: <?php echo ( $theme_display_options['qtposttitlelink'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtarchivetitlesize'] ) ?> !important;
	line-height: <?php echo ( $theme_display_options['qtarchivelineheight'] ) ?> !important;
} 

/** Post Header Link Hover **/ 
.postheadericon a:hover { 
    color: <?php echo ( $theme_display_options['qtposttitlehover'] ) ?> !important;
}

<?php if ( $theme_display_options['qtalllinks'] ) : ?>
.postcontent a {
	font-size: <?php echo ( $theme_display_options['qtfontsize'] ) ?> !important;
}
<?php endif; ?>

/** Paragraph link **/
p a {
	color: <?php echo ( $theme_display_options['qtcontentlinkcolor'] ) ?> !important;
}

/** Paragraph link Hover **/
p a:hover {
	color: <?php echo ( $theme_display_options['qtcontentlinkhovercolor'] ) ?> !important;
}

.footer {
	background: <?php echo ( $theme_display_options['qtfootercolor'] ) ?>; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(<?php echo ( $theme_display_options['qtfootercolor'] ) ?>, <?php echo ( $theme_display_options['qtfootercolor'] ) ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(<?php echo ( $theme_display_options['qtfootercolor'] ) ?>, <?php echo ( $theme_display_options['qtfootercolor'] ) ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(<?php echo ( $theme_display_options['qtfootercolor'] ) ?>, <?php echo ( $theme_display_options['qtfootercolor'] ) ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(<?php echo ( $theme_display_options['qtfootercolor'] ) ?>, <?php echo ( $theme_display_options['qtfootercolor'] ) ?>); /* Standard syntax */
	background-color: <?php echo ( $theme_display_options['qtfootercolor'] ) ?> !important;
}
.widget-title .t {
	color: <?php echo ( $theme_display_options['qtfootertitlecolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtfottertitlesize'] ) ?> !important;
}
.footer-inner p {
	color: <?php echo ( $theme_display_options['qtfootertextcolor'] ) ?> !important;
}
.footer-inner a {
color: <?php echo ( $theme_display_options['qtfootercontentlink'] ) ?> !important;
}
.footer-inner a:hover {
color: <?php echo ( $theme_display_options['qtfootercontentlinkhover'] ) ?> !important;
}
.widget-content li {
	color: <?php echo ( $theme_display_options['qtfooterlistcolor'] ) ?> !important;
}
.blockheader .t {
	color: <?php echo ( $theme_display_options['qtblockheadercolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtblockheadersize'] ) ?> !important;
}
.blockcontent a {
	color: <?php echo ( $theme_display_options['qtblockcontentlinkcolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtblockcontentlinksize'] ) ?> !important;
}
.blockcontent a:hover {
	color: <?php echo ( $theme_display_options['qtblockcontentlinkhover'] ) ?> !important;
}
.blockcontent p {
	color: <?php echo ( $theme_display_options['qtblockcontenttextcolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtblockcontenttextsize'] ) ?> !important;
}

/** Art block list item **/
.block li {
	color: <?php echo ( $theme_display_options['qtblocklisttextcolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtblocklisttextsize'] ) ?> !important;
}

.headline, .headline a, .headline a:link, .headline a:visited {
/**	font-family: Helvetica !important; **/
	color: <?php echo ( $theme_display_options['qtheadlinecolor'] ) ?> !important;
	font-size: <?php echo ( $theme_display_options['qtheadlinesize'] ) ?> !important;
	position: relative !important;
	bottom: <?php echo ( $theme_display_options['qtheadlinevposition'] ) ?>;
}

.responsive .headline, .responsive .headline a, .responsive .headline a:link, .responsive .headline a:visited {
	bottom: 0px !important;
}

.headline a:hover {
	color: <?php echo ( $theme_display_options['qtheadlinehover'] ) ?> !important;
}

.slogan {
	color: <?php echo ( $theme_display_options['qtslogan'] ) ?> !important;
}

.button {
    font-size: <?php echo ( $theme_display_options['qtbuttonsize'] ) ?> !important;
    padding: <?php echo ( $theme_display_options['qtbuttonpadding'] ) ?> !important;
    background-color: <?php echo ( $theme_display_options['qtbuttonbackcolor'] ) ?> !important;
	color: <?php echo ( $theme_display_options['qtbuttoncolor'] ) ?> !important;
	border-color: <?php echo ( $theme_display_options['qtbuttonbordercolor'] ) ?> !important;
}

.button.hover, .button:hover
{
   color: <?php echo ( $theme_display_options['qtbuttonhovercolor'] ) ?> !important;
   background: <?php echo ( $theme_display_options['qtbuttonhoverback'] ) ?> !important;
   border-color: <?php echo ( $theme_display_options['qtbuttonborderhovercolor'] ) ?> !important;
}
</style>
<?php endif; ?>

<?php if ( class_exists( 'woocommerce' )) { ?>
<?php if ( $theme_display_options['woocards'] ) { ?>

<style type="text/css">
/** Products **/
.products .product {
	box-sizing: border-box;
	border-top-color: rgb(220, 220, 220);
	border-right-color: rgb(220, 220, 220);
	border-bottom-color: rgb(220, 220, 220);
	border-left-color: rgb(220, 220, 220);
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}

/** Products Hover **/
.products .product:hover {
	-webkit-box-shadow: 3px 3px 15px 0 rgb(220, 218, 218);
	-moz-box-shadow: 3px 3px 15px 0 rgb(220, 218, 218);
	box-shadow: 3px 3px 15px 0 rgb(220, 218, 218);
	box-sizing: border-box;
	border-top-color: rgb(220, 220, 220);
	border-right-color: rgb(220, 220, 220);
	border-bottom-color: rgb(220, 220, 220);
	border-left-color: rgb(220, 220, 220);
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}

/** Product Price for crads when used with a shortcode **/
.product span {
	text-align: center !important;
}

/** Title **/
.woocommerce-loop-product__title {
	text-align: center;
}

/** Price **/
.woocommerce-LoopProduct-link span {
	text-align: center;
}

/**  Add To Cart Button Archive **/
.woocommerce ul.products li.product .button {
	text-align: center;
	text-transform: uppercase;
	display: block;
	color: <?php echo ( $theme_display_options['addbuttontextcolorarchive'] ) ?> !important;
	font-size: 16px !important;
	line-height: 16px !important;
}

/**  Add To Cart Button Archive Hover **/
.woocommerce ul.products li.product .button:hover {
	color: <?php echo ( $theme_display_options['addbuttontextcolorarchivehover'] ) ?> !important;
}

/** Woo single product button text **/
.single_add_to_cart_button {
	color: <?php echo ( $theme_display_options['addbuttontextcolor'] ) ?> !important;
	font-size: 20px !important;
	line-height: 20px !important;
	margin-top: <?php echo ( $theme_display_options['carttopmargin'] ) ?> !important;
}

/** Woo single product button text Hover **/
.single_add_to_cart_button:hover {
	color: <?php echo ( $theme_display_options['addbuttontextcolorhover'] ) ?> !important;
}

/** Star Rating **/
.woocommerce ul.products li.product .star-rating {
	margin-right: auto;
	margin-left: auto;
}

/** Added To Cart Text **/
.added_to_cart {
	font-weight: bold;
	text-align: center;
	text-transform: uppercase;
	display: block !important;
}

/** Woo Tabs Text Color **/
.tabs a {
	color: <?php echo ( $theme_display_options['disabledtabtext'] ) ?> !important;
}

.tabs a:hover {
	color: <?php echo ( $theme_display_options['disabledtabtexthover'] ) ?> !important;
}

/** Emptycart **/
.emptycart {
	font-size: 16px !important;
}

/** Checkout button **/
.checkout-button {
	font-size: 30px !important;
}

/** Return to shop button **/
.return-to-shop .button {
	font-size: 20px !important;
}

/** Cross sells price **/
.cross-sells .price {
	text-align: center;
}
</style>

<?php 
} else { ?>
<style type="text/css">
/** Woo single product button text **/
.single_add_to_cart_button {
	color: <?php echo ( $theme_display_options['addbuttontextcolor'] ) ?> !important;
	font-size: 20px !important;
	line-height: 20px !important;
	margin-top: <?php echo ( $theme_display_options['carttopmargin'] ) ?> !important;
}

/** Woo single product button text Hover **/
.single_add_to_cart_button:hover {
	color: <?php echo ( $theme_display_options['addbuttontextcolorhover'] ) ?> !important;
}

/**  Add To Cart Button Archive **/
.woocommerce ul.products li.product .button {
	text-transform: uppercase;
	color: <?php echo ( $theme_display_options['addbuttontextcolorarchive'] ) ?> !important;
	font-size: 16px !important;
	line-height: 16px !important;
}

/**  Add To Cart Button Archive Hover **/
.woocommerce ul.products li.product .button:hover {
	color: <?php echo ( $theme_display_options['addbuttontextcolorarchivehover'] ) ?> !important;
}

/** Woo Tabs Text Color **/
.tabs a {
	color: <?php echo ( $theme_display_options['disabledtabtext'] ) ?> !important;
}

.tabs a:hover {
	color: <?php echo ( $theme_display_options['disabledtabtexthover'] ) ?> !important;
}

/** Emptycart **/
.emptycart {
	font-size: 16px !important;
}

/** Checkout button **/
.checkout-button {
	font-size: 30px !important;
}

/** Return to shop button **/
.return-to-shop .button {
	font-size: 20px !important;
}
</style>
<?php } ?>


<?php if ( $theme_display_options['woostars'] ) : ?>

<style type="text/css">
.woocommerce ul.products li.product .star-rating {
	display: none;
}
</style>
<?php endif; ?>
<?php } ?>
	
</head>
<body <?php body_class(); ?>>
<div id="main">
<header class="header">
<?php if ( is_active_sidebar( 'header-widget-area' ) ) dynamic_sidebar( 'header-widget-area' ); ?>

    <div class="shapes">
        
            </div>


<?php if ( is_active_sidebar( 'logo-widget-area' ) ) :
    echo '<div class="positioncontrol positioncontrol-2016317142" id="LOGO">';
    dynamic_sidebar( 'logo-widget-area' );
    echo '</div>';
endif; ?>
<?php if ( is_active_sidebar( 'contact-widget-area' ) ) :
    echo '<div class="positioncontrol positioncontrol-1713306932" id="CONTACT">';
    dynamic_sidebar( 'contact-widget-area' );
    echo '</div>';
endif; ?>
<?php if ( is_active_sidebar( 'slogan-widget-area' ) ) :
    echo '<div class="positioncontrol positioncontrol-93815320" id="SLOGAN">';
    dynamic_sidebar( 'slogan-widget-area' );
    echo '</div>';
endif; ?>




                        
                    
</header>
<?php get_template_part( 'nav', 'menu' ); ?>
<div class="sheet clearfix">
            <div class="layout-wrapper">
                
<!-- End header.php -->
