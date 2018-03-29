<?php /* WooCommerce Support v2.0+ */

add_theme_support( 'woocommerce' );

/* Replace WooCommerce actions */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
function wptc_woocommerce_show_page_title( $a ) { return false; }
add_filter( 'woocommerce_show_page_title', 'wptc_woocommerce_show_page_title' );
function wptc_woocommerce_breadcrumb_defaults( $a ) { $a['wrap_before'] = '<nav>'; $a['wrap_after'] = '</nav>'; return $a; }
add_filter( 'woocommerce_breadcrumb_defaults', 'wptc_woocommerce_breadcrumb_defaults' );

function wptc_woocommerce_before_main_content() {
    remove_action( 'post_class', 'wptc_post_classes' );
    add_action( 'post_class', 'wptc_woocommerce_post_classes' );
    global $theme_display_options, $woo_post_class; ?>
<!-- Begin wptc_woocommerce_before_main_content - woocommerce.inc -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ( $theme_display_options['showWooCommerceBreadcrumb'] && is_singular( 'product' ) ) || ( is_post_type_archive() || is_search() || is_product_category() || is_product_tag() ) ) : ?>

<?php if ( is_search() || is_post_type_archive() || is_product_category() || is_product_tag() ) : ?>
<<?php echo $theme_display_options['postsArticleTag']; ?> class="postheader">
<span class="postheadericon"><?php woocommerce_page_title(); ?></span>
</<?php echo $theme_display_options['postsArticleTag']; ?>>
<?php endif; ?>


<?php if ( $theme_display_options['showWooCommerceBreadcrumb'] ) : ?>
<div class="postheadericons metadata-icons"><?php woocommerce_breadcrumb(); ?></div>
<?php endif; ?>

<?php endif; ?>
<?php $woo_post_class = true; ?>
<div <?php post_class( 'clearfix' ); ?>><p>
<!-- End wptc_woocommerce_before_main_content - woocommerce.inc -->
    <?php
}
add_action( 'woocommerce_before_main_content', 'wptc_woocommerce_before_main_content', 10 );

function wptc_woocommerce_before_shop_single() { ?></p></div><?php }
add_action( 'woocommerce_before_shop_loop', 'wptc_woocommerce_before_shop_single', 99 );
add_action( 'woocommerce_before_single_product', 'wptc_woocommerce_before_shop_single', 99 );

function wptc_woocommerce_after_main_content() {
    ?>
<!-- Begin wptc_woocommerce_after_main_content - woocommerce.inc -->
</article>
<?php if ( have_posts() && ( is_search() || is_post_type_archive() || is_product_category() || is_product_tag() ) ) : ?>
<div id="bottom-pager" class="post article"><?php echo wptc_build_pagination_links() ?></div>
<?php endif;
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End wptc_woocommerce_after_main_content - woocommerce.inc -->
    <?php
}
add_action( 'woocommerce_after_main_content', 'wptc_woocommerce_after_main_content', 20 );

/* Archive / shop grid columns */
function wptc_woocommerce_columns( $columns ) {
    global $theme_display_options;
    return max( absint( $theme_display_options['archiveShopGridColumns'] ), 1 );
}
add_filter( 'loop_shop_columns', 'wptc_woocommerce_columns' );

/* Products per page */
function wptc_woocommerce_products_per_page( $ppp ) {
    global $theme_display_options;
    if ( $theme_display_options['overrideProductsperPage'] )
        return max( absint( $theme_display_options['customProductsperPage'] ), 1 );
    return $ppp;
}
add_filter( 'loop_shop_per_page', 'wptc_woocommerce_products_per_page' );

/* Post classes */
function wptc_woocommerce_post_classes( $classes ) {
    global $post_theme_display_options, $woo_post_class;
    if ( empty( $woo_post_class ) ) :
        $classes[] = 'post';
        $classes[] = 'article';
        if ( is_singular() ) :
            $classes[] = 'hentry';
        endif;
        if ( $post_theme_display_options['wptc_disable_bullets_checkbox'] == 'on' ) :
            $classes[] = 'disable-bullets';
        endif;
    else :
        $classes[] = 'postcontent';
        $classes[] = 'postcontent' . get_the_ID();
    endif;
    return $classes;
}

/* Get post options */
function wptc_woocommerce_get_post_options( $pageID ) {
    if ( is_shop() ) return woocommerce_get_page_id( 'shop' );
    return $pageID;
}
add_filter( 'wptc_post_options_page_id', 'wptc_woocommerce_get_post_options' );

/* Render product meta box */
function wptc_woocommerce_meta_box_render() {
    global $post, $wptc_post_theme_display_defaults;
    $values = get_post_meta( $post->ID, '_wptc_theme_display_options', true );
    $wptc_menu_select = isset( $values['wptc_menu_select'] ) ? $values['wptc_menu_select'] : $wptc_post_theme_display_defaults['wptc_menu_select'];
    $wptc_disable_bullets_check = isset( $values['wptc_disable_bullets_checkbox'] ) ? $values['wptc_disable_bullets_checkbox'] : $wptc_post_theme_display_defaults['wptc_disable_bullets_checkbox'];
    $wptc_header_image_override = isset( $values['wptc_header_image_override'] ) ? intval( $values['wptc_header_image_override'] ) : $wptc_post_theme_display_defaults['wptc_header_image_override'];

    wp_nonce_field( 'wptc_theme_display_options_meta_box_nonce', 'theme_display_options_meta_box_nonce' );
    ?>
    <p>
        <label for="wptc_menu_select"><?php _e( 'Menu Override', 'wptc_theme_td' ); ?></label><br>
        <select id="wptc_menu_select" name="wptc_menu_select">
            <option value="-2" <?php selected( intval( $wptc_menu_select ), -2 ); ?>>&mdash; <?php _e( 'Default Menu', 'wptc_theme_td' ); ?> &mdash;</option>
            <option value="-1" <?php selected( intval( $wptc_menu_select ), -1 ); ?>>&mdash; <?php _e( 'Disable Menu', 'wptc_theme_td' ); ?> &mdash;</option>
            <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
            foreach ( $menus as $menu ) : ?>
            <option value="<?php echo $menu->term_id; ?>" <?php selected( intval( $wptc_menu_select ), $menu->term_id ); ?>><?php echo $menu->name; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <input type="checkbox" id="wptc_disable_bullets_checkbox" name="wptc_disable_bullets_checkbox" <?php checked( $wptc_disable_bullets_check, 'on' ); ?> />
        <label for="wptc_disable_bullets_checkbox"><?php _e( 'Disable Bullets', 'wptc_theme_td' ); ?></label>
    </p>
    <p>
        <input type="hidden" id="wptc_header_image_override" name="wptc_header_image_override" value="<?php echo $wptc_header_image_override; ?>" />
        <div class="wptc-image-upload-div"><?php if ( $wptc_header_image_override > 0 ) { $imgurl = wp_get_attachment_image_src( $wptc_header_image_override, 'full' ); echo '<img src="' . $imgurl[0] . '" title="' . $imgurl[0] . '" style="width:100%;margin:0;padding:0;cursor:pointer;" />'; } ?></div>
        <a href="#" class="wptc-image-upload-link"><?php _e( 'Override header image', 'wptc_theme_td' ); ?></a>
    </p>
    <p>
        <a href="#" class="wptc-image-remove-link"<?php if ( $wptc_header_image_override < 1 ) { echo ' style="display:none;"'; } ?>><?php _e( 'Remove override image', 'wptc_theme_td' ); ?></a>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($){
        var wptcimgframe;
        $('.wptc-image-upload-div,.wptc-image-upload-link').click(function(e){
            e.preventDefault();
            if(!wptcimgframe){
                wptcimgframe = wp.media({
                    className:'media-frame',
                    multiple:false,
                    title:'<?php _e( 'Override header image', 'wptc_theme_td' ); ?>',
                    library:{type:'image'}
                });
            }
            wptcimgframe.open();
            wptcimgframe.off('select');
            wptcimgframe.on('select',function(){
                var selection=wptcimgframe.state().get('selection').toJSON();
                $('.wptc-image-upload-div').empty();
                $('.wptc-image-upload-div').append('<img src="' + selection[0].url + '" title="' + selection[0].url + '" style="width:100%;margin:0;padding:0;cursor:pointer;" />');
                $('#wptc_header_image_override').val(selection[0].id);
                $('.wptc-image-remove-link').show();
            });
        });
        $('.wptc-image-remove-link').click(function(e){
            e.preventDefault();
            $('.wptc-image-upload-div').empty();
            $('#wptc_header_image_override').val('0');
            $(this).hide();
        });
        });
    </script>
    <?php
}

/* Product add meta options */
function wptc_woocommerce_meta_box_add() {
    add_meta_box( 'wptc_woocommerce_meta_box', __( 'Theme Display Options', 'wptc_theme_td' ), 'wptc_woocommerce_meta_box_render', 'product', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'wptc_woocommerce_meta_box_add' );

/* Show / Hide Add to Cart Buttons */
function wptc_show_hide_wc_add_to_cart_buttons() {
    global $theme_display_options;
    if ( $theme_display_options['showAddtoCartLoggedIn'] && ! is_user_logged_in() ) {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
    if ( ! $theme_display_options['showAddtoCartArchiveShop'] )
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    if ( ! $theme_display_options['showAddtoCartProduct'] )
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}
add_action( 'init', 'wptc_show_hide_wc_add_to_cart_buttons' );

/* Show / Hide Prices */
function wptc_show_hide_wc_prices( $price ) {
    global $theme_display_options;
    if ( $theme_display_options['showPricesLoggedIn'] && ! is_user_logged_in() )
        return '';
    if ( ! $theme_display_options['showPricesArchiveShop'] && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) )
        return '';
    if ( ! $theme_display_options['showPricesProduct'] && is_product() )
        return '';
    return $price;
}
add_action( 'woocommerce_get_price_html', 'wptc_show_hide_wc_prices' );

/* Inject style for li product width for Archive / Shop Grid Columns */
function wptc_shop_grid_columns_product_width() {
    if ( ! is_shop() && ! is_product_taxonomy() ) return;
    global $theme_display_options;
    $cols = max( absint( $theme_display_options['archiveShopGridColumns'] ), 1 );
    if ( $cols == 4 ) return;
    $colwidth = round( ( 99.6 - ( 3.8 * ( $cols - 1 ) ) ) / $cols, 2 );
    echo "<style type=\"text/css\">@media screen and (min-width: 769px) { .woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width: $colwidth%; } }</style>";
}
add_action( 'wp_head', 'wptc_shop_grid_columns_product_width' );

/* WooCommerce customizer options */
function wptc_woocommerce_options( $customizer ) {
    $customizer[] = array(
        'title'             => __( 'WooCommerce', 'wptc_theme_td' ),
        'id'                => 'woocommerce_wptc',
        'controls'          => array(
            array(
                'title'     => __( 'Primary Color <small>(action buttons/price slider/layered nav UI)</small>', 'wptc_theme_td' ),
                'id'        => 'WCPrimaryColor',
                'type'      => 'color'
            ),
            array(
                'title'     => __( 'Secondary Color <small>(buttons and tabs)</small>', 'wptc_theme_td' ),
                'id'        => 'WCSecondaryColor',
                'type'      => 'color'
            ),
            array(
                'title'     => __( 'Highlight Color <small>(price labels and sale flashes)</small>', 'wptc_theme_td' ),
                'id'        => 'WCHighlightColor',
                'type'      => 'color'
            ),
            array(
                'title'     => __( 'Content Background Color <small>(your themes page background - used for tab active states)</small>', 'wptc_theme_td' ),
                'id'        => 'WCContentBgColor',
                'type'      => 'color'
            ),
            array(
                'title'     => __( 'Subtext Color <small>(used for certain text and asides - breadcrumbs, small text etc)</small>', 'wptc_theme_td' ),
                'id'        => 'WCSubtextColor',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Add To Cart Button Text Color <small>(For products archive page)</small>', 'wptc_theme_td' ),
                'id'        => 'addbuttontextcolorarchive',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Add To Cart Button Hover Text Color <small>(For products archive page)</small>', 'wptc_theme_td' ),
                'id'        => 'addbuttontextcolorarchivehover',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Add To Cart Button Text Color <small>(For single product page)</small>', 'wptc_theme_td' ),
                'id'        => 'addbuttontextcolor',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Add To Cart Button Hover Text Color <small>(For single product page)</small>', 'wptc_theme_td' ),
                'id'        => 'addbuttontextcolorhover',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Tab Text Color', 'wptc_theme_td' ),
                'id'        => 'disabledtabtext',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Tab Hover Text Color', 'wptc_theme_td' ),
                'id'        => 'disabledtabtexthover',
                'type'      => 'color'
            ),
			array(
                'title'     => __( 'Top margin for cart button - ie: 20px', 'wptc_theme_td' ),
                'id'        => 'carttopmargin',
                'type'      => 'text'
            ),
			array(
                'title'     => __( 'Display Product Cards?', 'wptc_theme_td' ),
                'id'        => 'woocards',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Hide Review Stars on Archives?', 'wptc_theme_td' ),
                'id'        => 'woostars',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'View Purchased Items in Orders List?', 'wptc_theme_td' ),
                'id'        => 'listitems',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Manual Up-Sells?', 'wptc_theme_td' ),
                'id'        => 'autoupsells',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Manually Approve Product Commments?', 'wptc_theme_td' ),
                'id'        => 'approvecomments',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Enable Zoom?', 'wptc_theme_td' ),
                'id'        => 'qzoom',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Enable Lightbox?', 'wptc_theme_td' ),
                'id'        => 'qlightbox',
                'type'      => 'checkbox'
            ),
			array(
                'title'     => __( 'Enable Flexslider?', 'wptc_theme_td' ),
                'id'        => 'qflexslider',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show MiniCart in Header', 'wptc_theme_td' ),
                'id'        => 'showWCMiniCart',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show MiniCart to Logged In Users Only', 'wptc_theme_td' ),
                'id'        => 'showWCMiniCartLoggedIn',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'MiniCart Align', 'wptc_theme_td' ),
                'id'        => 'wcMiniCartAlign',
                'type'      => 'select',
                'sanitize'  => 'wptc_customizer_sanitize_minicart_align',
                'choices'   => array( 'none' => __( 'None', 'wptc_theme_td' ), 'left' => __( 'Left', 'wptc_theme_td' ), 'center' => __( 'Center', 'wptc_theme_td' ), 'right' => __( 'Right', 'wptc_theme_td' ) )
            ),
            array(
                'title'     => __( 'Show Breadcrumbs', 'wptc_theme_td' ),
                'id'        => 'showWooCommerceBreadcrumb',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Add to Cart Buttons to Logged In Users Only', 'wptc_theme_td' ),
                'id'        => 'showAddtoCartLoggedIn',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Prices to Logged In Users Only', 'wptc_theme_td' ),
                'id'        => 'showPricesLoggedIn',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Add to Cart Buttons on Product Pages', 'wptc_theme_td' ),
                'id'        => 'showAddtoCartProduct',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Prices on Product Pages', 'wptc_theme_td' ),
                'id'        => 'showPricesProduct',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Add to Cart Buttons on Archive / Shop Pages', 'wptc_theme_td' ),
                'id'        => 'showAddtoCartArchiveShop',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Show Prices on Archive / Shop Pages', 'wptc_theme_td' ),
                'id'        => 'showPricesArchiveShop',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Archive / Shop Grid Columns', 'wptc_theme_td' ),
                'id'        => 'archiveShopGridColumns',
                'type'      => 'text',
                'sanitize'  => 'absint'
            ),
            array(
                'title'     => __( 'Override Products per Page (WordPress Posts per Page)', 'wptc_theme_td' ),
                'id'        => 'overrideProductsperPage',
                'type'      => 'checkbox'
            ),
            array(
                'title'     => __( 'Custom Products per Page', 'wptc_theme_td' ),
                'id'        => 'customProductsperPage',
                'type'      => 'text',
                'sanitize'  => 'absint'
            )
        )
    );
    return $customizer;
}
add_filter( 'wptc_customizer', 'wptc_woocommerce_options' );

/* WooCommerce options defaults */
function wptc_woocommerce_options_defaults( $wptc_theme_display_defaults ) {
    $wptc_theme_display_defaults['WCPrimaryColor'] = '#a46497';
    $wptc_theme_display_defaults['WCSecondaryColor'] = '#ebe9eb';
    $wptc_theme_display_defaults['WCHighlightColor'] = '#77a464';
    $wptc_theme_display_defaults['WCContentBgColor'] = '#ffffff';
    $wptc_theme_display_defaults['WCSubtextColor'] = '#777777';
    $wptc_theme_display_defaults['WCPrimaryColor'] = '#a46497';
    $wptc_theme_display_defaults['WCSecondaryColor'] = '#ebe9eb';
    $wptc_theme_display_defaults['WCHighlightColor'] = '#77a464';
    $wptc_theme_display_defaults['WCContentBgColor'] = '#ffffff';
    $wptc_theme_display_defaults['WCSubtextColor'] = '#777777';
	$wptc_theme_display_defaults['addbuttontextcolorarchive'] = '';
	$wptc_theme_display_defaults['addbuttontextcolorarchivehover'] = '#dd3333';
	$wptc_theme_display_defaults['addbuttontextcolor'] = '';
	$wptc_theme_display_defaults['addbuttontextcolorhover'] = '#eeee22';
	$wptc_theme_display_defaults['disabledtabtext'] = '';
	$wptc_theme_display_defaults['disabledtabtexthover'] = '#000000';
	$wptc_theme_display_defaults['carttopmargin'] = '';
	$wptc_theme_display_defaults['woocards'] = true;
	$wptc_theme_display_defaults['woostars'] = true;
	$wptc_theme_display_defaults['listitems'] = true;
	$wptc_theme_display_defaults['autoupsells'] = true;
	$wptc_theme_display_defaults['approvecomments'] = true;
	$wptc_theme_display_defaults['qzoom'] = true;
	$wptc_theme_display_defaults['qlightbox'] = true;
	$wptc_theme_display_defaults['qflexslider'] = true;
    $wptc_theme_display_defaults['showWooCommerceBreadcrumb'] = true;
    $wptc_theme_display_defaults['showAddtoCartLoggedIn'] = false;
    $wptc_theme_display_defaults['showPricesLoggedIn'] = false;
    $wptc_theme_display_defaults['showAddtoCartProduct'] = true;
    $wptc_theme_display_defaults['showPricesProduct'] = true;
    $wptc_theme_display_defaults['showAddtoCartArchiveShop'] = true;
    $wptc_theme_display_defaults['showPricesArchiveShop'] = true;
    $wptc_theme_display_defaults['archiveShopGridColumns'] = '3';
    $wptc_theme_display_defaults['overrideProductsperPage'] = true;
    $wptc_theme_display_defaults['customProductsperPage'] = '12';
    $wptc_theme_display_defaults['showWCMiniCart'] = true;
    $wptc_theme_display_defaults['showWCMiniCartLoggedIn'] = false;
    $wptc_theme_display_defaults['wcMiniCartAlign'] = 'center';
    return $wptc_theme_display_defaults;
}
add_filter( 'wptc_theme_defaults', 'wptc_woocommerce_options_defaults' );

/* WooCommerce Color CSS */
function wptc_woocommerce_color_css() {
    global $theme_display_options, $wptc_theme_display_defaults;
    if ( !is_woocommerce() && !is_cart() && !is_shop() ) return;
    $pclr = $theme_display_options['WCPrimaryColor'];
    $rgb = wptc_wc_hex2rgb( $pclr );
    $pclrd6 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 6 ) );
    $pclrd25 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 25 ) );
    $ptclr = wc_light_or_dark( $pclr, wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_darken( $rgb, 50 ), 18 ) ), wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_lighten( $rgb, 50 ), 18 ) ) );
    $sclr = $theme_display_options['WCSecondaryColor'];
    $rgb = wptc_wc_hex2rgb( $sclr );
    $sclrd3 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 3 ) );
    $sclrd5 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 5 ) );
    $sclrd10 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 10 ) );
    $sclrd15 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 15 ) );
    $sclrd20 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 20 ) );
    $sclrd40 = wptc_wc_rgb2hex( wptc_wc_darken( $rgb, 40 ) );
    $stclr = wc_light_or_dark( $sclr, wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_darken( $rgb, 60 ), 18 ) ), wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_lighten( $rgb, 60 ), 18 ) ) );
    $stclrd10 = wptc_wc_rgb2hex( wptc_wc_darken( wptc_wc_hex2rgb( $stclr ), 10 ) );
    $stclrl10 = wptc_wc_rgb2hex( wptc_wc_lighten( wptc_wc_hex2rgb( $stclr ), 10 ) );
    $hclr = $theme_display_options['WCHighlightColor'];
    $rgb = wptc_wc_hex2rgb( $hclr );
    $hclrds75 = wptc_wc_desaturate( $rgb, 75 );
    $htclr = wc_light_or_dark( $hclr, wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_darken( $rgb, 60 ), 18 ) ), wptc_wc_rgb2hex( wptc_wc_desaturate( wptc_wc_lighten( $rgb, 60 ), 18 ) ) );
    $cbclr = $theme_display_options['WCContentBgColor'];
    $sbclr = $theme_display_options['WCSubtextColor'];
?>
    <style id="wptc-woocommerce-color-css" type="text/css">
        p.demo_store{background-color:<?php echo $pclr; ?>;color:<?php echo $ptclr; ?>;}.woocommerce small.note{color:<?php echo $sbclr; ?>;}.woocommerce .woocommerce-breadcrumb{color:<?php echo $sbclr; ?>;}.woocommerce .woocommerce-breadcrumb a{color:<?php echo $sbclr; ?>;}.woocommerce div.product span.price,.woocommerce div.product p.price{color:<?php echo $hclr; ?>;}.woocommerce div.product .stock{color:<?php echo $hclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li{border:1px solid <?php echo $sclrd10; ?>;background-color:<?php echo $sclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li a{color:<?php echo $stclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{color:<?php echo $stclrd10; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li.active{background:<?php echo $cbclr; ?>;border-bottom-color:<?php echo $cbclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before{box-shadow:2px 2px 0 <?php echo $cbclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after{box-shadow:-2px 2px 0 <?php echo $cbclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li:before,.woocommerce div.product .woocommerce-tabs ul.tabs li:after{border:1px solid <?php echo $sclrd10; ?>;position:absolute;bottom:-1px;width:5px;height:5px;content:" ";}.woocommerce div.product .woocommerce-tabs ul.tabs li:before{left:-6px;-webkit-border-bottom-right-radius:4px;-moz-border-bottom-right-radius:4px;border-bottom-right-radius:4px;border-width:0 1px 1px 0;box-shadow:2px 2px 0 <?php echo $sclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs li:after{right:-6px;-webkit-border-bottom-left-radius:4px;-moz-border-bottom-left-radius:4px;border-bottom-left-radius:4px;border-width:0 0 1px 1px;box-shadow:-2px 2px 0 <?php echo $sclr; ?>;}.woocommerce div.product .woocommerce-tabs ul.tabs:before{border-bottom:1px solid <?php echo $sclrd10; ?>;}.woocommerce span.onsale{background-color:<?php echo $hclr; ?>;color:<?php echo $htclr; ?>;}.woocommerce ul.products li.product .price{color:<?php echo $hclr; ?>;}.woocommerce ul.products li.product .price .from{color:<?php echo 'rgba(' . $hclrds75[0] . ',' . $hclrds75[1] . ',' . $hclrds75[2] . ',0.5)'; ?>;}.woocommerce nav.woocommerce-pagination ul{border:1px solid <?php echo $sclrd10; ?>;}.woocommerce nav.woocommerce-pagination ul li{border-right:1px solid <?php echo $sclrd10; ?>;}.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus{background:<?php echo $sclr; ?>;color:<?php echo $sclrd40; ?>;}.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit{color:<?php echo $stclr; ?>;background-color:<?php echo $sclr; ?>;}.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover{background-color:<?php echo $sclrd10; ?>;color:<?php echo $stclr; ?>;}.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt{background-color:<?php echo $pclr; ?>;color:<?php echo $ptclr; ?>;}.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit.alt:hover{background-color:<?php echo $pclrd6; ?>;color:<?php echo $ptclr; ?>;}.woocommerce a.button.alt.disabled,.woocommerce button.button.alt.disabled,.woocommerce input.button.alt.disabled,.woocommerce #respond input#submit.alt.disabled,.woocommerce a.button.alt:disabled,.woocommerce button.button.alt:disabled,.woocommerce input.button.alt:disabled,.woocommerce #respond input#submit.alt:disabled,.woocommerce a.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce a.button.alt.disabled:hover,.woocommerce button.button.alt.disabled:hover,.woocommerce input.button.alt.disabled:hover,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce a.button.alt:disabled:hover,.woocommerce button.button.alt:disabled:hover,.woocommerce input.button.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit.alt:disabled[disabled]:hover{background-color:<?php echo $pclr; ?>;color:<?php echo $ptclr; ?>;}.woocommerce a.button:disabled:hover,.woocommerce button.button:disabled:hover,.woocommerce input.button:disabled:hover,.woocommerce #respond input#submit:disabled:hover,.woocommerce a.button.disabled:hover,.woocommerce button.button.disabled:hover,.woocommerce input.button.disabled:hover,.woocommerce #respond input#submit.disabled:hover,.woocommerce a.button:disabled[disabled]:hover,.woocommerce button.button:disabled[disabled]:hover,.woocommerce input.button:disabled[disabled]:hover,.woocommerce #respond input#submit:disabled[disabled]:hover{background-color:<?php echo $sclr; ?>;}.woocommerce #reviews h2 small{color:<?php echo $sbclr; ?>;}.woocommerce #reviews h2 small a{color:<?php echo $sbclr; ?>;}.woocommerce #reviews #comments ol.commentlist li .meta{color:<?php echo $sbclr; ?>;}.woocommerce #reviews #comments ol.commentlist li img.avatar{background:<?php echo $sclr; ?>;border:1px solid <?php echo $sclrd3; ?>;}.woocommerce #reviews #comments ol.commentlist li .comment-text{border:1px solid <?php echo $sclrd3; ?>;}.woocommerce #reviews #comments ol.commentlist #respond{border:1px solid <?php echo $sclrd3; ?>;}.woocommerce .star-rating:before{color:<?php echo $sclrd10; ?>;}.woocommerce.widget_shopping_cart .total,.woocommerce .widget_shopping_cart .total{border-top:3px double <?php echo $sclr; ?>;}.woocommerce form.login,.woocommerce form.checkout_coupon,.woocommerce form.register{border:1px solid <?php echo $sclrd10; ?>;}.woocommerce .order_details li{border-right:1px dashed <?php echo $sclrd10; ?>;}.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background-color:<?php echo $pclr; ?>;}.woocommerce .widget_price_filter .ui-slider .ui-slider-range{background-color:<?php echo $pclr; ?>;}.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content{background-color:<?php echo $pclrd25; ?>;}.woocommerce-cart table.cart td.actions .coupon .input-text{border:1px solid <?php echo $sclrd10; ?>;}.woocommerce-cart .cart-collaterals .cart_totals p small{color:<?php echo $sbclr; ?>;}.woocommerce-cart .cart-collaterals .cart_totals table small{color:<?php echo $sbclr; ?>;}.woocommerce-cart .cart-collaterals .cart_totals .discount td{color:<?php echo $hclr; ?>;}.woocommerce-cart .cart-collaterals .cart_totals tr td,.woocommerce-cart .cart-collaterals .cart_totals tr th{border-top:1px solid <?php echo $sclr; ?>;}.woocommerce-checkout .checkout .create-account small{color:<?php echo $sbclr; ?>;}.woocommerce-checkout #payment{background:<?php echo $sclr; ?>;}.woocommerce-checkout #payment ul.payment_methods{border-bottom:1px solid <?php echo $sclrd10; ?>;}.woocommerce-checkout #payment div.payment_box{background-color:<?php echo $sclrd5; ?>;color:<?php echo $stclr; ?>;}.woocommerce-checkout #payment div.payment_box input.input-text,.woocommerce-checkout #payment div.payment_box textarea{border-color:<?php echo $sclrd15; ?>;border-top-color:<?php echo $sclrd20; ?>;}.woocommerce-checkout #payment div.payment_box ::-webkit-input-placeholder{color:<?php echo $sclrd20; ?>;}.woocommerce-checkout #payment div.payment_box :-moz-placeholder{color:<?php echo $sclrd20; ?>;}.woocommerce-checkout #payment div.payment_box :-ms-input-placeholder{color:<?php echo $sclrd20; ?>;}.woocommerce-checkout #payment div.payment_box span.help{color:<?php echo $sbclr; ?>;}.woocommerce-checkout #payment div.payment_box:after{content:"";display:block;border:8px solid <?php echo $sclrd5; ?>;border-right-color:transparent;border-left-color:transparent;border-top-color:transparent;position:absolute;top:-3px;left:0;margin:-1em 0 0 2em;}
    </style>
<?php
}
add_action( 'wp_head', 'wptc_woocommerce_color_css' );

/* Color support functions */
function wptc_wc_hex2rgb( $hex ) {
    $hex = str_replace( "#", "", $hex );
    if( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    $rgb = array( $r, $g, $b );
    return $rgb;
}
function wptc_wc_rgb2hex( $rgb ) {
    $hex = "#";
    $hex .= str_pad( dechex( $rgb[0] ), 2, "0", STR_PAD_LEFT );
    $hex .= str_pad( dechex( $rgb[1] ), 2, "0", STR_PAD_LEFT );
    $hex .= str_pad( dechex( $rgb[2] ), 2, "0", STR_PAD_LEFT );
    return $hex;
}
function wptc_wc_darken( $rgb, $amount ) {
    $amount = ( $amount / 100 ) * 255;
    return array( max( 0, $rgb[0] - $amount ), max( 0, $rgb[1] - $amount ), max( 0, $rgb[2] - $amount ) );
}
function wptc_wc_lighten( $rgb, $amount ) {
    $amount = ( $amount / 100 ) * 255;
    return array( min( 255, $rgb[0] + $amount ), min( 255, $rgb[1] + $amount ), min( 255, $rgb[2] + $amount ) );
}
function wptc_wc_desaturate( $rgb, $amount ) {
    $amount /= 100;
    $gry = ( $rgb[0] + $rgb[1] + $rgb[2] ) / 3;
    return array( $rgb[0] + ( ( $gry - $rgb[0] ) * $amount ), $rgb[1] + ( ( $gry - $rgb[1] ) * $amount ), $rgb[2] + ( ( $gry - $rgb[2] ) * $amount ) );
}

/* WooCommerce mini-cart widget */
class WPTCWCMiniCartWidget extends WP_Widget {
    function __construct() {
	$widget_ops = array( 'classname' => 'wcminicart', 'description' => __( 'Use this widget to add a WooCommerce mini-cart.', 'wptc_theme_td' ) );
	parent::__construct( 'wptcwcminicart_widget', __( 'WooCommerce Mini-Cart', 'wptc_theme_td' ), $widget_ops );
    }

    function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
        global $woocommerce;
        if ( $instance['align'] != 'none' )
            echo '<div style="text-align:' . $instance['align'] . ';">';
        echo wptc_woocommerce_mini_cart_link();
	if ( $instance['align'] != 'none' )
            echo '</div>';
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
	$instance['title'] = strip_tags( $new_instance['title'] );
        $instance['align'] = $new_instance['align'];
        if ( $instance['align'] != 'none' && $instance['align'] != 'left' && $instance['align'] != 'center' && $instance['align'] != 'right' )
            $instance['align'] = 'none';
    	return $instance;
    }

    function form( $instance ) {
	//Defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'align' => 'none' ) );
	$title = esc_attr( $instance['title'] );
        $align = $instance['align'];
	?>
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
	</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php _e( 'Align:', 'wptc_theme_td' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
		<option <?php selected( $align, 'none' ); ?> value="none"><?php _e( 'None', 'wptc_theme_td' ); ?></option>
                <option <?php selected( $align, 'left' ); ?> value="left"><?php _e( 'Left', 'wptc_theme_td' ); ?></option>
                <option <?php selected( $align, 'center' ); ?> value="center"><?php _e( 'Center', 'wptc_theme_td' ); ?></option>
                <option <?php selected( $align, 'right' ); ?> value="right"><?php _e( 'Right', 'wptc_theme_td' ); ?></option>
	    </select>
        </p>
	<?php
    }
}

/* Create mini cart link */
function wptc_woocommerce_mini_cart_link() {
    global $woocommerce;
    return '<a class="wptcwcminicart" href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( 'View your shopping cart', 'wptc_theme_td' ) . '"><span class="cartcontents">' . sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'wptc_theme_td' ), $woocommerce->cart->cart_contents_count ) . '</span> - <span class="amount">' . $woocommerce->cart->get_cart_total() . '</span></a>';
}

/* Mini cart ajax */
function wptc_woocommerce_mini_cart_ajax( $fragments ) {
		$fragments['a.wptcwcminicart'] = wptc_woocommerce_mini_cart_link();
		return $fragments;
}
add_filter( 'add_to_cart_fragments', 'wptc_woocommerce_mini_cart_ajax' );

/* Init widget */
function wptcwcminicart_widget_init() {
    register_widget( 'WPTCWCMiniCartWidget' );
}
add_action( 'widgets_init', 'wptcwcminicart_widget_init' );

// ==============================================
/* Change Woocommerce Out Of Stock Text */
// ==============================================
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
   // if ( $_product->is_in_stock() ) {
   //     $availability['availability'] = _e('Available!', 'wptc_theme_td');
  //  }
  
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = _e('Sold Out', 'wptc_theme_td');
    }
    return $availability;
}

// ==============================================
/* Date Order For Woocommerce - olders first */
// ==============================================
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
 
 // Apply custom args to main query
function custom_woocommerce_get_catalog_ordering_args( $args ) {

	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
 
	if ( 'oldest_to_recent' == $orderby_value ) {
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	}
 
	return $args;
}
 
// Create new sorting method
function custom_woocommerce_catalog_orderby( $sortby ) {
	
	$sortby['oldest_to_recent'] = _e( 'Oldest to most recent', 'wptc_theme_td' );
	
	return $sortby;
}

// ==============================================
/* Woocommrce Empty Cart */
// ==============================================
if(!class_exists('WC_Empty_Cart')) {
	class WC_Empty_Cart {
		public function __construct() 
		{
			if ( (get_option('before_empty_cart_button') == 'yes') || (get_option('before_empty_cart_button') == '1') ) {
				add_action('woocommerce_before_cart', array($this,'pt_wc_before_empty_cart_button'));
			} 
			if ( (get_option('after_empty_cart_button') == 'yes') || (get_option('after_empty_cart_button') == '1') ) {
				add_action('woocommerce_after_cart_contents', array($this,'pt_wc_after_empty_cart_button'));
			}
			add_action('woocommerce_after_mini_cart', array($this,'after_mini_cart'),10,1);
			add_action('init', array($this,'pt_wc_clear_cart_url'));
			add_filter( 'woocommerce_general_settings', array($this,'add_a_wc_setting') );	
		}
		public function after_mini_cart ($cart) {
				global $woocommerce;
				$cart_url = $woocommerce->cart->get_cart_url();
		?>
				<a class="button emptycart" href="<?php echo $cart_url;?>?empty=empty-cart"><?php _e('Empty Cart','wptc_theme_td'); ?></a>
		<?php
		}
		public function pt_wc_after_empty_cart_button($cart) {
			/* $cart = calling the cart */
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			?>
						<tr>
							<td colspan="6" class="actions">
								<?php 
								if(empty($_GET)) {?>
									<a class="button emptycart" href="<?php echo $cart_url;?>?empty=empty-cart"><?php _e('Empty Cart','wptc_theme_td'); ?></a>
								<?php } else {?>
									<a class="button emptycart" href="<?php echo $cart_url;?>&empty=empty-cart"><?php _e('Empty Cart','wptc_theme_td'); ?></a>
								<?php } ?>
							</td>
						</tr>
	<?php }		
		public function pt_wc_before_empty_cart_button($cart) {
			/* $cart = calling the cart */
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			?>
						<?php 
						if(empty($_GET)) {?>
							<div class="">
								<a class="button emptycart" style="display:inline-block;float:right;margin-bottom:10px;" href="<?php echo $cart_url;?>?empty=empty-cart"><?php _e('Empty Cart','wptc_theme_td'); ?></a>
							</div>
						<?php } else {?>
							<div class="">
								<a class="button emptycart" style="display:inline-block;float:right;margin-bottom:10px;" href="<?php echo $cart_url;?>?empty=empty-cart"><?php _e('Empty Cart','wptc_theme_td'); ?></a>
							</div>
						<?php } ?>
		<?php }
		public function pt_wc_clear_cart_url() {
			global $woocommerce;
			if( isset($_REQUEST['empty']) ) {
				$woocommerce->cart->empty_cart();
			}
		}
		public function add_a_wc_setting($settings) {
					$updated_settings = array();
					foreach($settings as $section){
							if ( isset( $section['id'] ) && 'general_options' == $section['id'] && isset( $section['type'] ) && 'sectionend' == $section['type'] ) {
								$updated_settings[] =
										array(
											'name'		=> __( 'Empty Cart Button before cart', 'wptc_theme_td'),
											'desc'		=> __( '<em>If check, the empty cart button will display before cart table</em>', 'wptc_theme_td'),
											'id' 		=> 'before_empty_cart_button',
											'default'	=> 'yes',
											'type' 		=> 'checkbox'
										);
								$updated_settings[] =
										array(
											'name'		=> __( 'Empty Cart Button after cart', 'wptc_theme_td'),
											'desc'		=> __( '<em>If check, the empty cart button will display after cart table</em>', 'wptc_theme_td'),
											'id' 		=> 'after_empty_cart_button',
											'default'	=> 'yes',
											'type' 		=> 'checkbox'
										);
							}
						    $updated_settings[] = $section;
					}
					return $updated_settings;
		}
	}
	$wchook = new WC_Empty_Cart();
}

// ==============================================
/* No Automated up-sells and cross-sells */
// ==============================================
function qt_upsells() {
   global $theme_display_options;
   if ( $theme_display_options['autoupsells'] ) :
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
endif;
}
add_action( 'after_setup_theme', 'qt_upsells' );

// ==============================================
/* Enable Image Zoom */
// ==============================================
function qt_zoom() {
   global $theme_display_options;
   if ( $theme_display_options['qzoom'] ) :
add_theme_support( 'wc-product-gallery-zoom' );
endif;
}
add_action( 'after_setup_theme', 'qt_zoom' );

// ==============================================
/* Enable Lightbox */
// ==============================================
function qt_lightbox() {
   global $theme_display_options;
   if ( $theme_display_options['qlightbox'] ) :
add_theme_support( 'wc-product-gallery-lightbox' );
endif;
}
add_action( 'after_setup_theme', 'qt_lightbox' );

// ==============================================
/* Enable FlexSlider */
// ==============================================
function qt_flexslider() {
   global $theme_display_options;
   if ( $theme_display_options['qflexslider'] ) :
add_theme_support( 'wc-product-gallery-slider' );
endif;
}
add_action( 'after_setup_theme', 'qt_flexslider' );

// ==============================================
/* Search Woo Products by SKU */
// ==============================================
if ( !function_exists('wsops_get_product_by_sku')){
	function wsops_get_product_by_sku( $sku ) {
	  global $wpdb;
	  $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

	  if ( $product_id ) {
		return new WC_Product( $product_id );
	  }else{
	  	return null;
	  }
	  	
	}
}

if ( !function_exists('wsops_product_redirect')){
	function wsops_product_redirect() {
	  global $post;
	    if(isset($_GET['s'])) {
			$result = wsops_get_product_by_sku($_GET['s']);
			if( $result != null){
				if($result->post->post_parent != 0 ) {
				
					$parent = new WC_Product( $result->post->post_parent );
					
					wp_redirect( get_permalink($parent->id) );
					exit;
				} else {
					wp_redirect( get_permalink($result->id) );
					exit;
				}
			}
		}
	}
	add_action( 'template_redirect', 'wsops_product_redirect', 0 );
}

// ==============================================
/* Manually Approve Comments */
// ==============================================
function qt_approvecomments() {
   global $theme_display_options;
   if ( $theme_display_options['approvecomments'] ) :
   
   if ( is_admin() ) return;
function teckel_comment_inserted($comment_id, $comment_object) {
		if ( get_post_type($comment_object->comment_post_ID) == 'product' ) {
			wp_set_comment_status($comment_object->comment_ID, 'hold');
		}
	}
	add_action( 'wp_insert_comment','teckel_comment_inserted', 99, 2 );
	
	endif;
}
add_action( 'after_setup_theme', 'qt_approvecomments' );

// ==============================================
/* View Purchased Items in Orders List */
// ==============================================
function qt_itemslist() {
   global $theme_display_options;
   if ( $theme_display_options['listitems'] ) :
   
if ( ! class_exists( 'display_order_details' ) ) {
    
    class display_order_details {
        
        public function __construct() {
            
            add_filter( 'manage_edit-shop_order_columns', array( &$this, 'od_column_header' ), 10, 1 );
            add_action( 'manage_shop_order_posts_custom_column', array( &$this, 'od_column_value' ), 10, 1 );
        }
        
        function od_column_header( $columns ) {
            
            // get all columns up to Order
            $new_columns = array();
            foreach ( $columns as $name => $value ) {
                if ( $name == 'billing_address' ) {
                    prev( $columns );
                    break;
                }
                $new_columns[ $name ] = $value;
            }
            // inject our columns
            $new_columns[ 'dot_items' ] = __( 'Items', 'display-items' );
            // add the remaining columns
            foreach ( $columns as $name => $value ) {
                $new_columns[ $name ] = $value;
            }
             
            
            return $new_columns;
        }
        
        function od_column_value( $column ) {
            
            if ( $column == 'dot_items' ) {
                global $post;
                
                $item_link = '';
                $order_id = $post->ID;
                $order = wc_get_order( $order_id );
                $items = $order->get_items();
                
                foreach( $items as $item_value ) {
                    
                    $order_data = $item_value->get_data();
                    
                    $product_id = $order_data[ 'product_id' ];
                    $product_name = $order_data[ 'name' ];
                    $quantity = $order_data[ 'quantity' ];
                    
                    $args[ 'post' ] = $product_id;
                    $args[ 'action' ] = 'edit';
                    
                    $item_link .= "<a href='" . esc_url_raw( add_query_arg( $args, get_admin_url( null, 'post.php' ) ) ) . "'>$product_name</a> x $quantity<br>"; 
                }
                
                echo $item_link;
            }

        }
    } // end of class
} 
$display_order_details = new display_order_details();

endif;
}
add_action( 'after_setup_theme', 'qt_itemslist' );
?>
