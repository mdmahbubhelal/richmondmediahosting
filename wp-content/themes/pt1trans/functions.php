<?php /* Functions.php */

/* Unique key constant for database saving */
define( 'WPTC_THEME_NAME_KEY', '_pt1trans' );
include_once 'inc/customFunctions.php';
/* Minimum WordPress version supported is 4.3 */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
    function wptc_theme_unsupported_version_admin_notice() {
        echo '<div id="theme-warning" class="error">' . sprintf( __( '<p><strong>Your current theme, %s, requires WordPress 4.3 or higher.</strong></p> <p>Please <a href="http://codex.wordpress.org/Upgrading_WordPress">upgrade WordPress</a> to use this theme.</p>', 'wptc_theme_td' ), 'pt1trans' ) . '</div>';
    }
    add_action( 'admin_notices', 'wptc_theme_unsupported_version_admin_notice' );
    function wptc_theme_unsupported_version_site_notice() {
        echo '</head><body>' . sprintf( __( '<p><strong>Your current theme, %s, requires WordPress 4.3 or higher.</strong></p> <p>Please <a href="http://codex.wordpress.org/Upgrading_WordPress">upgrade WordPress</a> to use this theme.</p>', 'wptc_theme_td' ), 'pt1trans' ) . '</body></html>';
        die();
    }
    add_action( 'wp_head', 'wptc_theme_unsupported_version_site_notice' );
    return;
}
require_once( 'updater.php' );
/* add_editor_style('style.css'); */
/* Support for Widgets Customizer Editor Button */
add_theme_support( 'customize-selective-refresh-widgets' );
/* Initialize options */
function wptc_options_init() {
    global $theme_display_options, $wptc_theme_display_defaults, $wptc_post_theme_display_defaults;
    /* Set text domain for translation */
    load_theme_textdomain( 'wptc_theme_td', get_template_directory() . '/languages' );

    /* Default settings array */
    include 'includes/defaults.php';

    /* Options */
    include 'includes/theme_options.php';

    /* Get theme options */
    $theme_display_options = get_option( 'wptc_theme_options' . WPTC_THEME_NAME_KEY );
    if ( is_array( $theme_display_options ) ) :
        $theme_display_options = array_merge( $wptc_theme_display_defaults, $theme_display_options );
    else :
        $theme_display_options = $wptc_theme_display_defaults;
    endif;
}
add_action( 'after_setup_theme', 'wptc_options_init' );

/* Load options in customizer */
function theme_were_in_customizer() {
    global $theme_display_options, $wptc_theme_display_defaults;
    $theme_display_options = get_option( 'wptc_theme_options' . WPTC_THEME_NAME_KEY );
    if ( is_array( $theme_display_options ) ) :
        $theme_display_options = array_merge( $wptc_theme_display_defaults, $theme_display_options );
    else :
        $theme_display_options = $wptc_theme_display_defaults;
    endif;
}
add_action( 'customize_preview_init', 'theme_were_in_customizer' );

/* Get post options */
function wptc_get_post_options() {
    if ( is_search() ) :
        global $wp_query;
        if ( $wp_query->post_count == 1 )
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
    endif;
    global $post_theme_display_options, $wptc_post_theme_display_defaults;
    $pageID = 0;
    if ( get_option( 'show_on_front' ) == 'page' && is_home() )
        $pageID = get_option( 'page_for_posts' );
    $pageID = apply_filters( 'wptc_post_options_page_id', $pageID );
    if ( !$pageID && !is_singular() ) :
        $post_theme_display_options = $wptc_post_theme_display_defaults;
        return;
    endif;
    $post_theme_display_options = get_post_meta( ( $pageID ? $pageID : get_the_ID() ), '_wptc_theme_display_options', true );
    if ( is_array( $post_theme_display_options ) ) :
        $post_theme_display_options = array_merge( $wptc_post_theme_display_defaults, $post_theme_display_options );
    else :
        $post_theme_display_options = $wptc_post_theme_display_defaults;
    endif;
}
add_action( 'template_redirect', 'wptc_get_post_options' );

/* Responsive switch session */
function wptc_session_manager() {
    global $theme_display_options;
    if ( $theme_display_options['showVisitorRespSwitch'] ) :
        if ( !session_id() ) session_start();
        if ( isset( $_GET['showmobileresp'] ) && ( $_GET['showmobileresp'] == 'yes' || $_GET['showmobileresp'] == 'no' ) ) :
                $_SESSION['showmobileresp'] = $_GET['showmobileresp'];
        elseif ( !isset( $_SESSION['showmobileresp'] ) || ( $_SESSION['showmobileresp'] != 'yes' && $_SESSION['showmobileresp'] != 'no' ) ) :
                $_SESSION['showmobileresp'] = 'yes';
        endif;
    endif;
}
add_action( 'init', 'wptc_session_manager' );

/* Style switcher */
include 'includes/style_switcher.php';

/* Conditional widgets */
include 'includes/conditional_widgets.php';

/* Shortcodes */
include 'includes/theme_shortcodes.php';

/* bbPress Support v2.5+ */
if ( class_exists( 'bbPress' ) ) :
    if ( version_compare( bbpress()->version, '2.5', '>=' ) ) :
        include 'includes/bbpress.php';
    else :
        function bbpress_unsupported_version_admin_notice() {
            echo '<div id="theme-warning" class="error fade">' . sprintf( __( '<p><strong>Your current theme, %s, requires bbPress 2.5 or higher.</strong></p> <p>Please <a href="http://bbpress.org/">upgrade bbPress</a> to add support.</p>', 'wptc_theme_td' ), 'pt1trans' ) . '</div>';
        }
        add_action( 'admin_notices', 'bbpress_unsupported_version_admin_notice' );
    endif;
endif;

/* WooCommerce Support v2.0+ */
if ( class_exists( 'woocommerce' ) ) :
    if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '>=' ) ) :
        include 'includes/woocommerce.php';
    else :
        function woocommerce_unsupported_version_admin_notice() {
            echo '<div id="theme-warning" class="error fade">' . sprintf( __( '<p><strong>Your current theme, %s, requires WooCommerce 2.0 or higher.</strong></p> <p>Please <a href="http://www.woothemes.com/woocommerce/">upgrade WooCommerce</a> to add support.</p>', 'wptc_theme_td' ), 'pt1trans' ) . '</div>';
        }
        add_action( 'admin_notices', 'woocommerce_unsupported_version_admin_notice' );
    endif;
endif;

/* Experimental features */
//include 'includes/experimental_features.php';

/* Enqueue theme stylesheets and javascripts with jQuery dependency */
function wptc_enq_scripts_method() {
    global $theme_display_options, $wp_styles;
    wp_register_style( 'googlefontstyle', '//fonts.googleapis.com/css?family=Raleway&amp;subset=latin', false, '', '' );
    wp_enqueue_Style( 'googlefontstyle' );
    if ( defined( 'TUX_STYLE_SWITCHER' ) && !TUX_STYLE_SWITCHER ) :
        $stylesheetURI = get_stylesheet_directory_uri();
    else :
        $stylesheetURI = str_replace( array( '%t%', '%s%' ), array( get_template_directory_uri(), get_stylesheet_directory_uri() ), $theme_display_options['styleSheets'] );
    endif;
    wp_register_style( 'stylemain', $stylesheetURI  . '/style.css', array( 'googlefontstyle' ), '', 'screen' );
    if ( defined( 'TUX_STYLE_SWITCHER' ) && !TUX_STYLE_SWITCHER ) $stylesheetURI = get_template_directory_uri();
    wp_register_style( 'styleie7', $stylesheetURI . '/style.ie7.css', array( 'stylemain' ), '', 'screen' );
    $wp_styles->add_data( 'styleie7', 'conditional', 'lte IE 7' );
    wp_enqueue_style( 'stylemain' );
    wp_enqueue_Style( 'styleie7' );
    wp_enqueue_script( 'scriptmain', $stylesheetURI . '/scripts/script.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'qtmainscripts', $stylesheetURI . '/includes/qtscripts.js', array( 'jquery' ), '', true );
	if ( $theme_display_options['animation'] ) wp_enqueue_script( 'qtwowscript', $stylesheetURI . '/includes/wow.min.js', array( 'jquery' ), '', false );
    if ( $theme_display_options['doResponsiveDesign'] ) :
    if ( $theme_display_options['showVisitorRespSwitch'] && isset( $_SESSION['showmobileresp'] ) && $_SESSION['showmobileresp'] == 'no' ) :
        /* do nothing */
    else :
        wp_register_style( 'styleresponsive', $stylesheetURI . '/style.responsive.css', array( 'stylemain' ), '', 'all' );
        wp_enqueue_style( 'styleresponsive' );
        wp_enqueue_script( 'script.responsive.js', $stylesheetURI . '/scripts/script.responsive.js', array( 'jquery' ), '', true );
    endif;
endif;
}
add_action( 'wp_enqueue_scripts', 'wptc_enq_scripts_method', 9 );

/* Enqueue Font Awesome stylesheets */
function wptc_enq_font_awesome() {
    global $wp_styles, $theme_display_options;
    if ( ! $theme_display_options['enableFontAwesome'] ) return;
    wp_register_style( 'fa-styles-maxcdn', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0', 'all' );
    wp_enqueue_style( 'fa-styles-maxcdn' );
}
add_action( 'wp_enqueue_scripts', 'wptc_enq_font_awesome' );
add_action( 'admin_enqueue_scripts', 'wptc_enq_font_awesome' );

/* Font Awesome tinymce script */
function wptc_font_awesome_tinymce() {
    global $theme_display_options;
    if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) && $theme_display_options['enableFontAwesome'] ) {
        add_filter( 'mce_external_plugins', 'wptc_register_fa_tinymce_plugin' );
        add_filter( 'mce_buttons', 'wptc_add_fa_tinymce_buttons' );
        add_filter( 'mce_css', 'wptc_add_fa_tinymce_editor_style' );
    }
}
add_action( 'admin_init', 'wptc_font_awesome_tinymce' );

function wptc_register_fa_tinymce_plugin( $plugin_array ) {
    $plugin_array['wptc_font_awesome'] = get_template_directory_uri() . '/scripts/wptc-font-awesome.js';
    return $plugin_array;
}
function wptc_add_fa_tinymce_buttons( $buttons ) {
    array_push( $buttons, '|', 'wptcFAButton' );
    return $buttons;
}
function wptc_add_fa_tinymce_editor_style( $mce_css ) {
    $mce_css .= ', //maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css';
    return $mce_css;
}


/* Animate CSS */
function wptc_enq_animate() {
    global $wp_styles, $theme_display_options;
    if ( ! $theme_display_options['animation'] ) return;
    wp_register_style( 'an-styles-maxcdn', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', false, '1.0', 'all' );
    wp_enqueue_style( 'an-styles-maxcdn' );
}
add_action( 'wp_enqueue_scripts', 'wptc_enq_animate' );
add_action( 'admin_enqueue_scripts', 'wptc_enq_animate' );

/* Import / Export Settings theme page */
function wptc_import_export_settings_page() {
    global $theme_display_options, $wptc_theme_display_defaults;
    $wptc_import_code = '';
    if ( isset( $_POST['wptc_theme_import_code'] ) && check_admin_referer( 'wptc_theme_import_export_nonce', 'wptc_theme_import_export_nonce' ) ) :
        $wptc_import_code = json_decode( stripslashes( $_POST['wptc_theme_import_code'] ), true );
        if ( $wptc_import_code !== null && is_array( $wptc_import_code ) ) :
            $extra_keys = array_diff_key( $wptc_import_code, $wptc_theme_display_defaults );
            foreach( $extra_keys as $key )
                unset( $wptc_import_code[$key] );
            $wptc_import_code = array_merge( $wptc_theme_display_defaults, $wptc_import_code );
            if ( update_option( 'wptc_theme_options' . TUX_THEME_NAME_KEY, $wptc_import_code ) ) :
                echo '<div id="theme-import-export-notice" class="updated">' . __( '<strong>Success:</strong> Settings were imported.', 'wptc_theme_td' ) . '</div>';
            else :
                echo '<div id="theme-import-export-warning" class="error">' . __( '<strong>Error:</strong> Settings were not imported.', 'wptc_theme_td' ) . '</div>';
            endif;
        else :
            echo '<div id="theme-import-export-warning" class="error">' . __( '<strong>Error:</strong> Unable to import code. ', 'wptc_theme_td' );
            switch (json_last_error()) :
                case JSON_ERROR_NONE:
                    _e( 'No known errors.', 'wptc_theme_td' );
                    break;
                case JSON_ERROR_DEPTH:
                    _e( 'Maximum stack depth exceeded.', 'wptc_theme_td' );
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    _e( 'Underflow or the modes mismatch.', 'wptc_theme_td' );
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    _e( 'Unexpected control character found.', 'wptc_theme_td' );
                    break;
                case JSON_ERROR_SYNTAX:
                    _e( 'Syntax error, malformed JSON.', 'wptc_theme_td' );
                    break;
                case JSON_ERROR_UTF8:
                    _e( 'Malformed UTF-8 characters, possibly incorrectly encoded.', 'wptc_theme_td' );
                    break;
                default:
                    _e( 'Unknown error.', 'wptc_theme_td' );
                    break;
            endswitch;
            echo '</div>';
        endif;
        $wptc_import_code = stripslashes( $_POST['wptc_theme_import_code'] );
    endif;
?>
<div class="wrap">
    <h2><?php _e( 'Import / Export Settings', 'wptc_theme_td' ); ?>: pt1trans</h2>
    <div class="wptc-admin-wrap">
        <h3 class="wptc-headline"><?php _e( 'Import Settings', 'wptc_theme_td' ); ?></h3>
        <div class="wptc-content">
            <?php _e( 'Input the export settings code you\'d like to import.', 'wptc_theme_td' ); ?>
            <form method="post" action="themes.php?page=wptc-import-export-settings">
                <textarea id="wptc_theme_import_code" name="wptc_theme_import_code" rows="10" cols="50" class="large-text code"><?php echo $wptc_import_code; ?></textarea>
                <?php wp_nonce_field( 'wptc_theme_import_export_nonce', 'wptc_theme_import_export_nonce' );
                submit_button( __( 'Import Settings', 'wptc_theme_td' ) ); ?>
            </form>
        </div>
        <h3 class="wptc-headline"><?php _e( 'Export Settings', 'wptc_theme_td' ); ?></h3>
        <div class="wptc-content">
            <?php _e( 'Copy the code below, then paste and save it in a text file.', 'wptc_theme_td' ); ?>
            <textarea id="wptc_theme_export_code" name="wptc_theme_export_code" rows="10" cols="50" class="large-text code"><?php echo json_encode( $theme_display_options ); ?></textarea>
        </div>
    </div>
</div>
<?php
}

/* Help / Support theme page */
function wptc_help_support_page() {
    if ( isset( $_GET['tab'] ) ) :
        $active_tab = $_GET['tab'];
    else :
        $active_tab = 'wptc_about';
    endif;
?>
<div class="wrap">
    <h2><?php _e( 'Help / Support', 'wptc_theme_td' ); ?>: pt1trans</h2>
    <?php
    $help_files = array();
    if ( is_dir( get_template_directory() . '/help' ) ) :
        $handler = opendir( get_template_directory() . '/help' ); /* Theme help directory */
        if ( $handler !== false ) :
            while ( $file = readdir( $handler ) ) :
                if ( $file != '.' && $file != '..' && ( substr( $file, -4 ) == '.php' ) )
                    $help_files[str_replace( '.php', '', $file )] = get_template_directory() . '/help/' . $file;
            endwhile;
            closedir( $handler );
        endif;
    endif;
    if ( is_child_theme() && is_dir( get_stylesheet_directory() . '/help' ) ) :
        $handler = opendir( get_stylesheet_directory() . '/help' ); /* Child theme help directory */
        if ( $handler !== false ) :
            while ( $file = readdir( $handler ) ) :
                if ( $file != '.' && $file != '..' && ( substr( $file, -4 ) == '.php' ) )
                    $help_files[str_replace( '.php', '', $file )] = get_stylesheet_directory() . '/help/' . $file;
            endwhile;
            closedir( $handler );
        endif;
    endif;
    ksort( $help_files );
    ?>
    <h3 class="nav-tab-wrapper">
        <a href="?page=wptc-help-support&tab=wptc_about" class="nav-tab<?php echo $active_tab == 'wptc_about' ? ' nav-tab-active' : ''; ?>"><?php _e( 'About', 'wptc_theme_td' ); ?></a>
        <?php foreach( array_keys( $help_files ) as $tabname ) : ?>
        <a href="?page=wptc-help-support&tab=<?php echo $tabname; ?>" class="nav-tab<?php echo $active_tab == $tabname ? ' nav-tab-active' : ''; ?>"><?php echo str_replace( '_', ' ', $tabname ); ?></a>
        <?php endforeach; ?>
    </h3>
    <?php if ( $active_tab == 'wptc_about' ) : ?>
<div class="wptc-admin-wrap">
<h2 class="wptc-super-headline"><?php _e( 'About', 'wptc_theme_td' ); ?></h2>
<?php if ( is_child_theme() ) : $child_theme = wp_get_theme(); ?>
<h3 class="wptc-headline"><?php _e( 'Child Theme', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <ul>
        <?php if ( $child_theme->exists() ) : ?>
        <li><?php _e( 'Name', 'wptc_theme_td' ); ?>: <?php echo $child_theme->get( 'Name' ); ?></li>
        <li><?php _e( 'Version', 'wptc_theme_td' ); ?>: <?php echo $child_theme->get( 'Version' ); ?></li>
        <li><?php _e( 'Theme Page', 'wptc_theme_td' ); ?>: <a href="<?php echo $child_theme->get( 'ThemeURI' ); ?>" target="_blank"><?php echo $child_theme->get( 'ThemeURI' ); ?></a></li>
        <li><?php _e( 'Author', 'wptc_theme_td' ); ?>: <?php echo $child_theme->get( 'Author' ); ?></li>
        <li><?php _e( 'Author Page', 'wptc_theme_td' ); ?>: <a href="<?php echo $child_theme->get( 'AuthorURI' ); ?>" target="_blank"><?php echo $child_theme->get( 'AuthorURI' ); ?></a></li>
        <?php else : ?>
        <li><?php _e( 'Unable to get theme info.', 'wptc_theme_td' ); ?></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>
<h3 class="wptc-headline"><?php _e( 'Theme', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <ul>
        <li><?php _e( 'Name', 'wptc_theme_td' ); ?>: pt1trans</li>
        <li><?php _e( 'Version', 'wptc_theme_td' ); ?>: </li>
        <li><?php _e( 'Theme Page', 'wptc_theme_td' ); ?>: <a href="" target="_blank"></a></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Author', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <ul>
        <li><?php _e( 'Name', 'wptc_theme_td' ); ?>:  Douglas Dye</li>
        <li><?php _e( 'Home Page', 'wptc_theme_td' ); ?>: <a href=" Doug Dye.com" target="_blank"> Doug Dye.com</a></li>
    </ul>
</div>
<h3 class="wptc-headline"><?php _e( 'Features', 'wptc_theme_td' ); ?></h3>
<div class="wptc-content">
    <ul>
        <li><span class="wptc-checkmark"></span> <?php _e( 'Built on Standard WordPress Core Features', 'wptc_theme_td' ); ?></li>
        <li><span class="wptc-checkmark"></span> <?php _e( 'Conditional Widget Display', 'wptc_theme_td' ); ?></li>
        <li><span class="wptc-checkmark"></span> <?php _e( 'Font Awesome', 'wptc_theme_td' ); ?></li>
        <li><span class="wptc-checkmark"></span> <?php _e( 'bbPress Support', 'wptc_theme_td' ); ?></li>
        <li><span class="wptc-checkmark"></span> <?php _e( 'WooCommerce Support', 'wptc_theme_td' ); ?></li>

    </ul>
</div>
</div>

    <?php else :
        include $help_files[$active_tab];
    endif; ?>
</div>
<?php
}

/* Add theme admin pages */
function wptc_add_admin_pages() {
    add_theme_page( __( 'Import / Export Settings', 'wptc_theme_td' ), __( 'Import / Export Settings', 'wptc_theme_td' ), 'manage_options', 'wptc-import-export-settings', 'wptc_import_export_settings_page' );
    add_theme_page( __( 'Help / Support', 'wptc_theme_td' ), __( 'Help / Support', 'wptc_theme_td' ), 'manage_options', 'wptc-help-support', 'wptc_help_support_page' );
}
add_action( 'admin_menu', 'wptc_add_admin_pages' );

/* CSS for admin theme pages */
function wptc_help_support_page_css() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/wptc-admin-theme-pages.css" />';
}
add_action( 'admin_head', 'wptc_help_support_page_css' );

/* Set content width */
if ( !isset( $content_width ) ) $content_width = 1140;

/* Add styles and scripts to head */
function wptc_head_styles_scripts() {
    global $theme_display_options;
    if ( !has_site_icon() ) echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.ico" />'; ?>
    <!-- Responsive menu hamburger styles -->
    <style id="wptc-head-css" type="text/css">
        .nav .menu-btn { min-width:20px; width:auto; }
        a.menu-btn { text-decoration:none; }
        .nav .menu-btn:after { color:#FFFFFF; content:"<?php echo $theme_display_options['respMenuText']; ?>"; }
        .responsive nav.nav, .responsive .nav-inner { text-align:<?php echo $theme_display_options['respMenuAlign']; ?> !important; }
        <?php if ( $theme_display_options['makeHeaderClickable'] ) : ?>.header { cursor:pointer; }<?php endif; ?>
    </style>
    <!-- Add button class to comment form submit and reply, fix menus, clickable header, left sidebar after content -->
    <script id="wptc-head-script" type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            $( '.postmetadataheader' ).each( function() {
                if ( $.trim( $( this ).text() ) === '' ) {
                    $( this ).remove();
                }
            });
            $( 'input#submit' ).addClass( 'button' );
            $( '#wp-submit' ).addClass( 'button' );
            $( '.comment-footer a' ).addClass( 'button' );
            $( '.bbp-submit-wrapper button' ).addClass( 'button' );
            <?php if ( $theme_display_options['readMoreButton'] ) : ?>$( '.more-link' ).addClass( 'button' );<?php endif; ?>
            $( 'ul.menu li.current-menu-item, ul.menu li.current-menu-item>a, ul.menu li.current-menu-item>ul.sub-menu, ul.menu li.current-menu-parent, ul.menu li.current-menu-parent>a, ul.menu li.current-menu-parent>ul.sub-menu, ul.menu li.current-menu-parent>ul.sub-menu>a' ).addClass( 'active' );
            <?php if ( $theme_display_options['makeHeaderClickable'] ) : ?>
            $( '.header' ).click( function() {
                window.location = '<?php echo $theme_display_options['headerLink']; ?>';
            });
            $( '.header input, .header select' ).click( function( ev ) {
                ev.stopPropagation();
            });<?php endif; ?>
        });
    </script>

<?php
    if ( $theme_display_options['injectHeaderScripts'] )
        echo $theme_display_options['headerScripts'];
}
add_action( 'wp_head', 'wptc_head_styles_scripts' );

/* Add styles and scripts to footer */
function wptc_footer_styles_scripts() {
    global $theme_display_options;
    if ( $theme_display_options['injectFooterScripts'] )
        echo $theme_display_options['footerScripts'];
}
add_action( 'wp_footer', 'wptc_footer_styles_scripts', 20 );

/* Post classes */
function wptc_post_classes( $classes ) {
    global $post_theme_display_options;
    $classes[] = 'post';
    $classes[] = 'article';
    if ( is_singular() )
        $classes[] = 'hentry';
    if ( $post_theme_display_options['wptc_disable_bullets_checkbox'] == 'on' )
        $classes[] = 'disable-bullets';
    return $classes;
}
add_filter( 'post_class', 'wptc_post_classes' );

/* Allow shortcodes in text widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* Allow shortcodes in custom menus */
add_filter( 'wp_nav_menu', 'do_shortcode' );

/* Add feed links to header */
add_theme_support( 'automatic-feed-links' );

/* Add title tag to header */
add_theme_support( 'title-tag' );
include 'includes/wptitle.inc';

/* Featured images/post thumbnails */
add_theme_support( 'post-thumbnails' );

/* Custom header image */
add_theme_support( 'custom-header', array( 'width' => 1920, 'height' => 159, 'flex-width' => true, 'flex-height' => true, 'default-image' => '%s/images/header.jpg', 'header-text' => false, 'uploads' => true, 'wp-head-callback' => 'wptc_custom_header_image_css' ) );
register_default_headers( array( 'theme_default_header' => array( 'url' => '%s/images/header.jpg', 'thumbnail_url' => '%s/images/header.jpg', 'description' => __( 'Theme Default Header', 'wptc_theme_td' ) ) ) );
function wptc_custom_header_image_css() {
    global $post_theme_display_options;
    if ( $post_theme_display_options['wptc_header_image_override'] > 0 ) {
        $headerimg = wp_get_attachment_image_src( $post_theme_display_options['wptc_header_image_override'], 'full' );
        $headerimg = ( $headerimg === false ) ? get_header_image() : $headerimg[0];
    } else {
        $headerimg = get_header_image();
    }
    $headerimgdefault = get_template_directory_uri() . '/images/header.jpg';
    if ( ! empty( $headerimg ) && $headerimg != $headerimgdefault ) {
        echo "<style type=\"text/css\" id=\"custom-header-css-override\">
    .header { background-image: url('$headerimg') !important; background-position: center center !important; background-size: cover; }
</style>
<script type=\"text/javascript\">
    var customHeaderImage = true;
</script>";
    } elseif ( empty( $headerimg ) ) {
        echo "<style type=\"text/css\" id=\"custom-header-css-override\">
    .header { background-image: none !important; }
</style>
<script type=\"text/javascript\">
    var customHeaderImage = true;
</script>";
    }
}

/* Custom background image */
add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', 'default-image' => '', 'wp-head-callback' => 'wptc_custom_background_image_css' ) );
function wptc_custom_background_image_css() {
    $backgroundimg = get_background_image();
    $backgroundclr = get_background_color();
    $bgimgdefault = '';
    $bgclrdefault = 'ffffff';
    if ( $backgroundimg != $bgimgdefault || $backgroundclr != $bgclrdefault ) {
        $style = "background-color: #$backgroundclr;";
        if ( ! empty( $backgroundimg ) ) {
            $image = " background-image: url('$backgroundimg');";
            $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
            if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
                $repeat = 'repeat';
            $repeat = " background-repeat: $repeat;";
            $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
            if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
                $position = 'left';
            $position = " background-position: top $position;";
            $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
            if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
                $attachment = 'scroll';
            $attachment = " background-attachment: $attachment;";
            $style .= $image . $repeat . $position . $attachment;
        }
?>
<style type="text/css" id="custom-background-css">
    #main { background: none; <?php echo trim( $style ); ?> }
</style>
<?php
    }
}

/* Add featured image to posts/pages */
function wptc_add_featured_image( $content ) {
    global $theme_display_options, $post;
    if ( $post->post_type != 'post' && $post->post_type != 'page' ) return $content;
    if ( $theme_display_options['showPostFeaturedImage'] && has_post_thumbnail( $post->ID ) ) {
        $fi_size = $theme_display_options['postFeaturedImageSize'];
        if ( $fi_size == 'custom' )
            $fi_size = array( absint( $theme_display_options['postFeaturedImageWidth'] ), absint( $theme_display_options['postFeaturedImageHeight'] ) );
        return get_the_post_thumbnail( $post->ID, $fi_size, array( 'class' => $theme_display_options['postFeaturedImageAlignment'] ) ) . $content;
    }
    return $content;
}
add_filter( 'the_content', 'wptc_add_featured_image' );

/* Remove image links so lightbox works */
function wptc_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ( $image_set !== 'none' ) update_option( 'image_default_link_type', 'none' );
}
add_action( 'admin_init', 'wptc_imagelink_setup', 10 );

/* Display post/pages id number in dashboard */
function wptc_posts_columns_id( $defaults ){
    $defaults['wptc_post_id'] = __( 'ID', 'wptc_theme_td' );
    return $defaults;
}
add_filter( 'manage_posts_columns', 'wptc_posts_columns_id', 5 );
add_filter( 'manage_pages_columns', 'wptc_posts_columns_id', 5 );
function wptc_posts_custom_id_columns( $column_name, $id ){
    if ( $column_name === 'wptc_post_id' ) echo $id;
}
add_action( 'manage_posts_custom_column', 'wptc_posts_custom_id_columns', 5, 2 );
add_action( 'manage_pages_custom_column', 'wptc_posts_custom_id_columns', 5, 2 );

/* Check if wp cerber exists */
if( function_exists('cerber_login_screen')) {
// Do Nothing
} else {
/* Display user id number and url in dashboard */
function wptc_users_columns_id( $column ) {
    $column['wptc_user_id'] = __( 'ID', 'wptc_theme_td' );
    $column['wptc_user_url'] = __( 'Website', 'wptc_theme_td' );
    return $column;
}
add_filter( 'manage_users_columns', 'wptc_users_columns_id' );
function wptc_users_custom_id_column( $val, $column_name, $user_id ) {
    if ( $column_name === 'wptc_user_id' ) return $user_id;
    if ( $column_name === 'wptc_user_url' ) {
        $user = get_userdata( $user_id );
        if ( !empty( $user->user_url ) ) {
            return '<a href="' . $user->user_url . '" target="_blank">' . $user->user_url . '</a>';
        }
    }
}
add_filter( 'manage_users_custom_column', 'wptc_users_custom_id_column', 10, 3 );

// ==============================================
/* Display last logged date/time in admin */
// ==============================================
add_action('wp_login','wpdb_capture_user_last_login', 10, 2);
function wpdb_capture_user_last_login($user_login, $user){
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}

add_filter( 'manage_users_columns', 'wpdb_user_last_login_column');
function wpdb_user_last_login_column($columns){
    $columns['lastlogin'] = __('Last Login', 'lastlogin');
    return $columns;
}
 
add_action( 'manage_users_custom_column',  'wpdb_add_user_last_login_column', 10, 3); 
function wpdb_add_user_last_login_column($value, $column_name, $user_id ) {
    if ( 'lastlogin' != $column_name )
        return $value;
 
    return get_user_last_login($user_id,false);
}
 
function get_user_last_login($user_id,$echo = true){
    $date_format = get_option('date_format') . ' ' . get_option('time_format');
    $last_login = get_user_meta($user_id, 'last_login', true);
    $login_time = 'Never logged in';
    if(!empty($last_login)){
       if(is_array($last_login)){
            $login_time = mysql2date($date_format, array_pop($last_login), false);
        }
        else{
            $login_time = mysql2date($date_format, $last_login, false);
        }
    }
    if($echo){
        echo $login_time;
    }
    else{
        return $login_time;
    }
}
}
/* End of wp Cerber check */

/* Display MEDIA FILE SIZE in dashboard */
add_filter( 'manage_upload_columns', 'qt_237131_add_column_file_size' );
add_action( 'manage_media_custom_column', 'qt_237131_column_file_size', 10, 2 );

function qt_237131_add_column_file_size( $columns ) { // Create the column
    $columns['filesize'] = 'File Size';
    return $columns;
}
function qt_237131_column_file_size( $column_name, $media_item ) { // Display the file size
if ( 'filesize' != $column_name || !wp_attachment_is_image( $media_item ) ) {
  return;
}
$filesize = filesize( get_attached_file( $media_item ) );
$filesize = size_format($filesize, 2);
echo $filesize;
}

/* Display MEDIA URL in dashboard */
add_filter( 'manage_media_columns', 'qt_media_columns_url' );
/**
 * Filter the Media list table columns to add a URL column.
 *
 * @param array $posts_columns Existing array of columns displayed in the Media list table.
 * @return array Amended array of columns to be displayed in the Media list table.
 */
function qt_media_columns_url( $posts_columns ) {
    $posts_columns['media_url'] = 'URL';
    return $posts_columns;
}
 
add_action( 'manage_media_custom_column', 'qt_media_custom_column_url' );
/**
 * Display URL custom column in the Media list table.
 *
 * @param string $column_name Name of the custom column.
 */
function qt_media_custom_column_url( $column_name ) {
    if ( 'media_url' !== $column_name ) {
        return;
    }
 
    echo '<input type="text" width="100%" onclick="jQuery(this).select();" value="' . wp_get_attachment_url() . '" />';
}
 
add_action( 'admin_print_styles-upload.php', 'qt_url_column_css' );
/**
 * Add custom CSS on Media Library page in WP admin
 */
function qt_url_column_css() {
    echo '<style>
            @media only screen and (min-width: 1400px) {
                .fixed .column-media_url {
                    width: 15%;
                }
            }
        </style>';
}

/* Display MEDIA DIMENSIONS in dashboard */
function wh_column( $cols ) {
        $cols["dimensions"] = "Dimensions (w, h)";
        return $cols;
}
function wh_value( $column_name, $id ) {
    if ( $column_name == "dimensions" ):
    $meta = wp_get_attachment_metadata($id);
           if(isset($meta['width']))
           echo $meta['width'].' x '.$meta['height'];
    endif;
}
add_filter( 'manage_media_columns', 'wh_column' );
add_action( 'manage_media_custom_column', 'wh_value', 10, 2 );

/* Excerpt length */
function wptc_excerpt_length( $length ) {
    global $theme_display_options;
    return absint( $theme_display_options['excerptLength'] );
}
add_filter( 'excerpt_length', 'wptc_excerpt_length', 999 );

/* Excerpt read more */
function wptc_excerpt_more( $more ) {
    global $theme_display_options;
    if ( $theme_display_options['excerptReadMoreLink'] )
        return ' <a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . $theme_display_options['excerptReadMoreText'] . '</a>';

    return ' ' . $theme_display_options['excerptReadMoreText'];
}
add_filter( 'excerpt_more', 'wptc_excerpt_more' );

/* Stop WordPress from adding 10px to wp-caption div width */
function fix_img_caption_shortcode( $val, $attr, $content = null ) {
    extract( shortcode_atts( array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr ) );
    if ( 1 > (int) $width || empty( $caption ) ) return $val;
    return '<div id="' . $id . '" class="wp-caption ' . esc_attr( $align ) . '" style="width: ' . ( 0 + (int) $width ) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter( 'img_caption_shortcode', 'fix_img_caption_shortcode', 10, 3 );

/* Render post / page meta box */
function wptc_post_meta_box_render() {
    global $post, $wptc_post_theme_display_defaults, $theme_display_options;
    $values = get_post_meta( $post->ID, '_wptc_theme_display_options', true );
    $wptc_menu_select = isset( $values['wptc_menu_select'] ) ? $values['wptc_menu_select'] : $wptc_post_theme_display_defaults['wptc_menu_select'];
    $wptc_title_check = isset( $values['wptc_title_checkbox'] ) ? $values['wptc_title_checkbox'] : $wptc_post_theme_display_defaults['wptc_title_checkbox'];
    $wptc_meta_header_check = isset( $values['wptc_meta_header_checkbox'] ) ? $values['wptc_meta_header_checkbox'] : $wptc_post_theme_display_defaults['wptc_meta_header_checkbox'];
    $wptc_meta_footer_check = isset( $values['wptc_meta_footer_checkbox'] ) ? $values['wptc_meta_footer_checkbox'] : $wptc_post_theme_display_defaults['wptc_meta_footer_checkbox'];
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
        <input type="checkbox" id="wptc_title_checkbox" name="wptc_title_checkbox" <?php checked( $wptc_title_check, 'on' ); ?> />
        <label for="wptc_title_checkbox"><?php _e( 'Post Title', 'wptc_theme_td' ); ?></label>
    </p>
    <p>
        <input type="checkbox" id="wptc_meta_header_checkbox" name="wptc_meta_header_checkbox" <?php checked( $wptc_meta_header_check, 'on' ); ?> />
        <label for="wptc_meta_header_checkbox"><?php _e( 'Post Meta Header', 'wptc_theme_td' ); ?></label>
    </p>
    <p<?php if ( $post->post_type == 'page' && !$theme_display_options['showPostFooterMetaonPages'] ) : ?> style="display:none;"<?php endif; ?>>
        <input type="checkbox" id="wptc_meta_footer_checkbox" name="wptc_meta_footer_checkbox" <?php checked( $wptc_meta_footer_check, 'on' ); ?> />
        <label for="wptc_meta_footer_checkbox"><?php _e( 'Post Meta Footer', 'wptc_theme_td' ); ?></label>
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

/* Save post / page meta options */
function wptc_post_meta_box_save( $post_id ) {
    global $wptc_post_theme_display_defaults;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
    if ( !isset( $_POST['theme_display_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['theme_display_options_meta_box_nonce'], 'wptc_theme_display_options_meta_box_nonce' ) ) return $post_id;
    if ( 'page' == $_POST['post_type'] ) :
        if ( !current_user_can( 'edit_page', $post_id ) ) : return $post_id; endif;
    else :
        if ( !current_user_can( 'edit_post', $post_id ) ) : return $post_id; endif;
    endif;

    $wptc_post_meta_save = array();
    $wptc_post_meta_save['wptc_menu_select'] = isset( $_POST['wptc_menu_select'] ) ? $_POST['wptc_menu_select'] : $wptc_post_theme_display_defaults['wptc_menu_select'];
    $wptc_post_meta_save['wptc_title_checkbox'] = isset( $_POST['wptc_title_checkbox'] ) && $_POST['wptc_title_checkbox'] ? 'on' : 'off';
    $wptc_post_meta_save['wptc_meta_header_checkbox'] = isset( $_POST['wptc_meta_header_checkbox'] ) && $_POST['wptc_meta_header_checkbox'] ? 'on' : 'off';
    $wptc_post_meta_save['wptc_meta_footer_checkbox'] = isset( $_POST['wptc_meta_footer_checkbox'] ) && $_POST['wptc_meta_footer_checkbox'] ? 'on' : 'off';
    $wptc_post_meta_save['wptc_disable_bullets_checkbox'] = isset( $_POST['wptc_disable_bullets_checkbox'] ) && $_POST['wptc_disable_bullets_checkbox'] ? 'on' : 'off';
    $wptc_post_meta_save['wptc_header_image_override'] = isset( $_POST['wptc_header_image_override'] ) ? intval( $_POST['wptc_header_image_override'] ) : $wptc_post_theme_display_defaults['wptc_header_image_override'];

    update_post_meta( $post_id, '_wptc_theme_display_options', $wptc_post_meta_save );
}
add_action( 'save_post', 'wptc_post_meta_box_save' );

/* Post / page add meta options */
function wptc_post_meta_box_add() {
    add_meta_box( 'wptc_post_meta_box', __( 'Theme Display Options', 'wptc_theme_td' ), 'wptc_post_meta_box_render', 'post', 'side', 'default' );
    add_meta_box( 'wptc_post_meta_box', __( 'Theme Display Options', 'wptc_theme_td' ), 'wptc_post_meta_box_render', 'page', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'wptc_post_meta_box_add' );

/* Add display options for image attachments */
function wptc_add_attachment_meta( $form_fields, $post ) {
    if ( !wp_attachment_is_image( $post->ID ) ) return $form_fields;
    $wptc_image_class = get_post_meta( $post->ID, '_wptc_attachment_display_options', true );
    if ( !isset( $wptc_image_class['wptc_resp_desktop'] ) ) $wptc_image_class['wptc_resp_desktop'] = 'on';
    if ( !isset( $wptc_image_class['wptc_resp_tablet'] ) ) $wptc_image_class['wptc_resp_tablet'] = 'on';
    if ( !isset( $wptc_image_class['wptc_resp_phone'] ) ) $wptc_image_class['wptc_resp_phone'] = 'on';
    if ( !isset( $wptc_image_class['wptc_image_classes'] ) ) $wptc_image_class['wptc_image_classes'] = '';
    if ( !isset( $wptc_image_class['wptc_lightbox'] ) ) $wptc_image_class['wptc_lightbox'] = 'off';
    $form_fields['wptc_img_attach_title'] = array(
        'tr' => '<tr class="compat-field-wptc_img_attach_title"><td><h3>' . __( 'Theme Display Options', 'wptc_theme_td' ) . '</h3></td></tr>',
    );
    $form_fields['wptc_image_classes'] = array(
        'label' => __( 'Classes', 'wptc_theme_td' ),
        'input' => 'text',
        'value' => $wptc_image_class['wptc_image_classes'],    );
    $form_fields['wptc_lightbox'] = array(
        'label' => __( 'Lightbox', 'wptc_theme_td' ),
        'input' => 'html',
        'html'  => '<input type="checkbox" value="on" id="attachments-' . $post->ID . '-wptc_lightbox" name="attachments[' . $post->ID . '][wptc_lightbox]" ' . checked( $wptc_image_class['wptc_lightbox'], 'on', false ) . ' />',
        'value' => $wptc_image_class['wptc_lightbox'],
    );
    $form_fields['wptc_resp_desktop'] = array(
        'label' => __( 'Desktop', 'wptc_theme_td' ),
        'input' => 'html',
        'html'  => '<input type="checkbox" value="on" id="attachments-' . $post->ID . '-wptc_resp_desktop" name="attachments[' . $post->ID . '][wptc_resp_desktop]" ' . checked( $wptc_image_class['wptc_resp_desktop'], 'on', false ) . ' />',
        'value' => $wptc_image_class['wptc_resp_desktop'],
    );
    $form_fields['wptc_resp_tablet'] = array(
        'label' => __( 'Tablet', 'wptc_theme_td' ),
        'input' => 'html',
        'html'  => '<input type="checkbox" value="on" id="attachments-' . $post->ID . '-wptc_resp_tablet" name="attachments[' . $post->ID . '][wptc_resp_tablet]" ' . checked( $wptc_image_class['wptc_resp_tablet'], 'on', false ) . ' />',
        'value' => $wptc_image_class['wptc_resp_tablet'],
    );
    $form_fields['wptc_resp_phone'] = array(
        'label' => __( 'Phone', 'wptc_theme_td' ),
        'input' => 'html',
        'html'  => '<input type="checkbox" value="on" id="attachments-' . $post->ID . '-wptc_resp_phone" name="attachments[' . $post->ID . '][wptc_resp_phone]" ' . checked( $wptc_image_class['wptc_resp_phone'], 'on', false ) . ' />',
        'value' => $wptc_image_class['wptc_resp_phone'],
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'wptc_add_attachment_meta', 10, 2 );

/* Save display options for image attachments */
function wptc_save_attachment_meta( $post, $attachment ) {
    if ( !wp_attachment_is_image( $post['ID'] ) ) return $post;
    $wptc_image_class = array();
    $wptc_image_class['wptc_resp_desktop'] = isset( $attachment['wptc_resp_desktop'] ) && $attachment['wptc_resp_desktop'] == 'on' ? 'on' : 'off';
    $wptc_image_class['wptc_resp_tablet'] = isset( $attachment['wptc_resp_tablet'] ) && $attachment['wptc_resp_tablet'] == 'on' ? 'on' : 'off';
    $wptc_image_class['wptc_resp_phone'] = isset( $attachment['wptc_resp_phone'] ) && $attachment['wptc_resp_phone'] == 'on' ? 'on' : 'off';
    $wptc_image_class['wptc_image_classes'] = isset( $attachment['wptc_image_classes'] ) ? sanitize_text_field( $attachment['wptc_image_classes'] ) : '';
    $wptc_image_class['wptc_lightbox'] = isset( $attachment['wptc_lightbox'] ) && $attachment['wptc_lightbox'] == 'on' ? 'on' : 'off';
    update_post_meta( $post['ID'], '_wptc_attachment_display_options', $wptc_image_class );
    return $post;
}
add_filter( 'attachment_fields_to_save', 'wptc_save_attachment_meta', 10, 2 );

/* Apply display options for image attachments */
function wptc_image_class_tag( $classes, $post_id, $align, $size ) {
    $wptc_image_class = get_post_meta( $post_id, '_wptc_attachment_display_options', true );
    if ( isset( $wptc_image_class['wptc_image_classes'] ) && !empty( $wptc_image_class['wptc_image_classes'] ) ) $classes .= ' ' . $wptc_image_resp['wptc_image_classes'];
    if ( isset( $wptc_image_class['wptc_lightbox'] ) && $wptc_image_class['wptc_lightbox'] == 'on' ) $classes .= ' lightbox';
    if ( isset( $wptc_image_class['wptc_resp_desktop'] ) && $wptc_image_class['wptc_resp_desktop'] == 'off' ) $classes .= ' desktop-no-show';
    if ( isset( $wptc_image_class['wptc_resp_tablet'] ) && $wptc_image_class['wptc_resp_tablet'] == 'off' ) $classes .= ' tablet-no-show';
    if ( isset( $wptc_image_class['wptc_resp_phone'] ) && $wptc_image_class['wptc_resp_phone'] == 'off' ) $classes .= ' phone-no-show';
    return $classes;
}
add_filter( 'get_image_tag_class', 'wptc_image_class_tag', 10, 4 );

/* Custom comment callback */
function wptc_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );
    ?>
    <div id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comment postcontent clearfix' : 'parent comment postcontent clearfix' ) ?>>
        <?php if ( $args['avatar_size'] != 0 ) { ?><div class="comment-avatar"><?php echo get_avatar( $comment, $args['avatar_size'], '', 'Avatar image' ); ?></div><?php } ?>
        <div class="comment-inner">
            <div class="comment-header"><?php comment_author_link(); ?> on <?php comment_date(); echo ' '; comment_time(); ?></div>
            <div class="comment-content">
                <?php if ( $comment->comment_approved == '0' ) { ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wptc_theme_td' ); ?></em>
		<br />
                <?php }
                comment_text(); ?>
            </div>
            <div class="comment-footer">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth ) ) ); ?>
            </div>
        </div>
    </div>
    <?php }

/* Do nothing to overide WordPress adding divs to end of comments */
function wptc_comment_end() { }

/* Build paginatation links for archive pages */
function wptc_build_pagination_links() {
    global $wp_query;
    if ( $wp_query->max_num_pages < 2 ) return '';
    $big = 999999999;
    return '<div class="pager">' . str_replace( array( 'current', 'dots' ), array( 'current active ', 'dots more ' ),
        paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format'    => '?paged=%#%',
	    'current'   => max( 1, get_query_var( 'paged' ) ),
	    'total'     => $wp_query->max_num_pages,
	) ) ) . '</div>';
}

/* Create a header title for archives and special pages */
function wptc_archive_page_title() {
    global $theme_display_options;
    $page_title = '';
    if ( !is_home() && !is_front_page() ) :
        if ( is_category() ) :
	    $page_title = sprintf( $theme_display_options['categoryArchivePageTitle'], single_cat_title( '', false ) );
	elseif ( is_tag() ) :
	    $page_title = sprintf( $theme_display_options['tagArchivePageTitle'], single_tag_title( '', false ) );
	elseif ( is_day() ) :
	    $page_title = sprintf( $theme_display_options['dayArchivePageTitle'], get_the_date() );
	elseif ( is_month() ) :
	    $page_title = sprintf( $theme_display_options['monthArchivePageTitle'], get_the_date( 'F Y' ) );
	elseif ( is_year() ) :
	    $page_title = sprintf( $theme_display_options['yearArchivePageTitle'], get_the_date( 'Y' ) );
        elseif ( is_search() ) :
	    $page_title = sprintf( $theme_display_options['searchArchivePageTitle'], get_search_query() );
	elseif ( is_author() ) :
            $curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
	    $page_title = sprintf( $theme_display_options['authorArchivePageTitle'], $curauth->display_name );
	elseif ( is_post_type_archive() && $theme_display_options['overridePostArchiveTitles'] ) :
	    $page_title = sprintf( $theme_display_options['postArchivePageTitle'], post_type_archive_title( '', false ) );
	elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) :
	    $page_title = $theme_display_options['defaultArchivePageTitle'];
	endif;
    endif;
    return $page_title;
}

/* Menu fallback */
function wptc_menu_fallback( $args ) {
    global $theme_display_options;
    $home_item = false;
    if ( $theme_display_options['showMenuHome'] ) :
        $home_item = true;
        if ( !empty( $theme_display_options['menuHomeTitle'] ) )
            $home_item = $theme_display_options['menuHomeTitle'];
    endif;
    $wptc_menu = wp_page_menu( array(
        'menu_class'    => '',
        'echo'          => false,
        'show_home'     => $home_item,
    ) );
    if ( !empty( $wptc_menu ) ) :
        echo '<ul class="menu hmenu">' . substr( $wptc_menu, 9, -7 );
    endif;
}

/* Post meta output */
function wptc_post_meta_output( $type ) {
    global $theme_display_options;
    if ( is_page() ) :
        $type = 'page' . $type;
        $typeamt = 3;
    else :
        $type = 'post' . $type;
        $typeamt = 5;
    endif;
    $meta_slot = $type . 'MetaSlot';
    for ( $i = 1; $i <= $typeamt; $i++ ) :
        switch( $theme_display_options[$meta_slot . $i] ) :
            case 'author' :
                echo '<span class="postauthoricon author vcard">' . sprintf( $theme_display_options['postMetaAuthorText'], ' <a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="View all posts by ' . get_the_author() . '" rel="author">' . get_the_author() . '</a> ' ) . '</span>';
                break;
            case 'categories' :
                echo '<span class="postcategoryicon">' . sprintf( $theme_display_options['postMetaCategoriesText'], ' ' . get_the_category_list( ', ' ) . ' ' ) . '</span>';
                break;
            case 'comments' :
                $num_comments = get_comments_number();
                if ( $num_comments > 0 || comments_open() ) :
                    if ( $num_comments == 0 ) :
                        $comments_text = __( 'No Comments', 'wptc_theme_td' );
                    elseif ( $num_comments > 1 ) :
                        $comments_text = sprintf( __( '%s Comments', 'wptc_theme_td' ), $num_comments );
                    else :
                        $comments_text = __( '1 Comment', 'wptc_theme_td' );
                    endif;
                    echo '<span class="postcommentsicon">' . sprintf( $theme_display_options['postMetaCommentsText'], ' <a href="' . get_comments_link() . '" title="View all comments for ' . esc_attr( get_the_title() ) . '">' . $comments_text . '</a> ' ) . '</span>';
                endif;
                break;
            case 'date' :
                echo '<span class="postdateicon entry-date">' . sprintf( $theme_display_options['postMetaDateText'], '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time> ' ) . '</span>';
                break;
            case 'tags' :
                $j = 0;
                $post_tags = get_the_tags();
                $tot_tags = count( $post_tags );
                if ( $post_tags ) :
                    $the_tags = '';
                    foreach ( $post_tags as $tag ) :
                        $j++;
                        $the_tags .= '<a href="' . get_tag_link( $tag->term_id ) . '" title="' . $tag->name . ' Tag" rel="tag">' . $tag->name . '</a>';
                        if ( $j < $tot_tags )
                            $the_tags .= ', ';
                    endforeach;
                else :
                    $the_tags = 'No tags';
                endif;
                echo '<span class="posttagicon">' . sprintf( $theme_display_options['postMetaTagsText'], ' ' . $the_tags . ' ' ) . '</span>';
                break;
        endswitch;
        if ( $i < $typeamt ) :
            if ( $theme_display_options[$meta_slot . ($i + 1)] != 'none' ) :
                if ( $theme_display_options[$meta_slot . $i . 'LineBreak'] ) :
                    echo '<br>';
                else :
                    echo ' ' . $theme_display_options[$type . 'MetaSeparator'] . ' ';
                endif;
            endif;
        endif;
    endfor;
}

/* Register menus and widget areas */
function wptc_register_menus_widget_areas() {
    global $theme_display_options;

    /* Register menu */
    register_nav_menus( array(
        'primary-menu' => __( 'Primary Navigation', 'wptc_theme_td' ),
        'guest-menu' => __( 'Guest Navigation', 'wptc_theme_td' )
    ) );



    /* Register header widget area */
    if( $theme_display_options['activeHeaderWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Header Widget Area', 'wptc_theme_td' ),
        'id' => 'header-widget-area',
        'description' => __( 'The header widget area. Use the unique widget ids to control the design and position of individual widgets with CSS code.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );
    
/* Register LOGO widget area */
    if ( $theme_display_options['activeLOGOWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'LOGO Widget Area', 'wptc_theme_td' ),
        'id' => 'logo-widget-area',
        'description' => __( 'This widget area is located in the header.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );
    
/* Register CONTACT widget area */
    if ( $theme_display_options['activeCONTACTWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'CONTACT Widget Area', 'wptc_theme_td' ),
        'id' => 'contact-widget-area',
        'description' => __( 'This widget area is located in the header.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );
    
/* Register SLOGAN widget area */
    if ( $theme_display_options['activeSLOGANWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'SLOGAN Widget Area', 'wptc_theme_td' ),
        'id' => 'slogan-widget-area',
        'description' => __( 'This widget area is located in the header.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register first nav widget area */
    if( $theme_display_options['activeNavWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'First Navigation Widget Area', 'wptc_theme_td' ),
        'id' => 'first-nav-widget-area',
        'description' => __( 'This sidebar is displayed before the horizontal menu.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register second nav widget area */
    if( $theme_display_options['activeNavWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Second Navigation Widget Area', 'wptc_theme_td' ),
        'id' => 'second-nav-widget-area',
        'description' => __( 'This sidebar is displayed after the horizontal menu.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register page top widget area */
    if( $theme_display_options['activePageTopWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Page Top Widget Area', 'wptc_theme_td' ),
        'id' => 'first-page-top-widget-area',
        'description' => __( 'This sidebar is displayed above the main content and sidebars.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register content top widget area */
    if( $theme_display_options['activeContentTopWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Content Top Widget Area', 'wptc_theme_td' ),
        'id' => 'first-content-top-widget-area',
        'description' => __( 'This sidebar is displayed above the main content.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register content bottom widget area */
    if( $theme_display_options['activeContentBottomWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Content Bottom Widget Area', 'wptc_theme_td' ),
        'id' => 'first-content-bottom-widget-area',
        'description' => __( 'This sidebar is displayed below the main content.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register page bottom widget area */
    if( $theme_display_options['activePageBottomWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Page Bottom Widget Area', 'wptc_theme_td' ),
        'id' => 'first-page-bottom-widget-area',
        'description' => __( 'This sidebar is displayed below the main content and sidebars.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );

    /* Register footer widget area */
    if( $theme_display_options['activeFooterWidgetArea'] )
    register_sidebar( array(
        'name' => __( 'Footer Widget Area', 'wptc_theme_td' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area. You can add a text widget for custom footer text.', 'wptc_theme_td' ),
        'before_widget' => '<div id="%1$s" class="wptc-widget-class %2$s clearfix"><div class="wptc-widget-content-class">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wptc-widget-header-class"><div class="t">',
        'after_title' => '</div></h3><div class="wptc-widget-content-class">'
    ) );
}
add_action( 'widgets_init', 'wptc_register_menus_widget_areas' );

/* Vertical menu widget */
class VMenuWidget extends WP_Widget {
    function __construct() {
	$widget_ops = array( 'classname' => 'vmenu_widget', 'description' => __( 'Use this widget to add one of your custom menus as a widget.', 'wptc_theme_td' ) );
	parent::__construct( 'vmenu_widget', __( 'Vertical Menu', 'wptc_theme_td' ), $widget_ops );
    }

    function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
	echo $before_widget . $before_title . $title . $after_title;
        wp_nav_menu( array( 'menu' => $instance['nav_menu'], 'fallback_cb' => '', 'container' => 'nav', 'container_class' => '', 'menu_class' => 'menu menu vmenu' ) );
	echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['nav_menu'] = (int) $new_instance['nav_menu'];
	return $instance;
    }

    function form( $instance ) {
	//Defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'nav_menu' => '' ) );
	$title = esc_attr( $instance['title'] );
	$nav_menu = $instance['nav_menu'];

	// Get menus
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	?>
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
	</p>
	<p>
	    <?php
	    // If no menus exists, direct the user to go and create some.
	    if ( !$menus ) {
		printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'wptc_theme_td' ), admin_url( 'nav-menus.php' ) );
	    } else {
	    ?>
		<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:', 'wptc_theme_td' ); ?></label><br />
		<select class="widefat" id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
		<?php
		foreach ( $menus as $menu ) {
		    $selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
		    echo '<option' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
		}
		?>
		</select>
		<?php
	    }
	    ?>
	</p>
	<?php
    }
}

/* Login widget */
class WPTCLoginWidget extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'login-widget', 'description' => __( 'Use this widget to add a login form as a widget.', 'wptc_theme_td' ) );
	parent::__construct( 'wptc_login_widget', __( 'Login Form', 'wptc_theme_td' ), $widget_ops );
    }

    function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

	echo $before_widget . $before_title . $title . $after_title;
	if ( !is_user_logged_in() ) {
            $loginformargs = array();
            if ( !empty( $instance['labelusername'] ) ) $loginformargs['label_username'] = $instance['labelusername'];
            if ( !empty( $instance['labelpassword'] ) ) $loginformargs['label_password'] = $instance['labelpassword'];
            if ( !empty( $instance['labelrememberme'] ) ) $loginformargs['label_remember'] = $instance['labelrememberme'];
            if ( !empty( $instance['labellogin'] ) ) $loginformargs['label_log_in'] = $instance['labellogin'];
	    wp_login_form( $loginformargs );
            echo '<p class="login-widget-bottom"><ul><li><a href="' . wp_lostpassword_url( $_SERVER['REQUEST_URI'] ) . '">' . ( empty( $instance['labellostpassword'] ) ? __( 'Lost Password', 'wptc_theme_td' ) : $instance['labellostpassword'] ) . '</a></li>' . wp_register( '<li>', '</li>', false ) . '</ul></p>';
	} else {
            global $current_user;
            if ( intval( $instance['avatarsize'] ) > 0 ) echo '<div class="login-widget-avatar">' . get_avatar( $current_user->ID, intval( $instance['avatarsize'] ) ) . '</div>';
	    echo '<p class="login-widget-welcome">' . $current_user->display_name . '</p>';
            echo '<p class="login-widget-bottom"><ul>';
            if ( current_user_can( 'edit_posts' ) ) { echo '<li>'; wp_register( '', '' ); echo '</li>'; }
            echo '<li><a href="' . wp_logout_url( $_SERVER['REQUEST_URI'] ) . '">' . ( empty( $instance['labellogout'] ) ? __( 'Log Out', 'wptc_theme_td' ) : $instance['labellogout'] ) . '</a></li>';
            echo '</ul></p>';
        }
	echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['avatarsize'] = intval( $new_instance['avatarsize'] );
        $instance['labelusername'] = strip_tags( $new_instance['labelusername'] );
        $instance['labelpassword'] = strip_tags( $new_instance['labelpassword'] );
        $instance['labelrememberme'] = strip_tags( $new_instance['labelrememberme'] );
        $instance['labellogin'] = strip_tags( $new_instance['labellogin'] );
        $instance['labellogout'] = strip_tags( $new_instance['labellogout'] );
        $instance['labellostpassword'] = strip_tags( $new_instance['labellostpassword'] );
	return $instance;
    }

    function form( $instance ) {
	//Defaults
	$instance = wp_parse_args( (array) $instance, array(
            'title' => 'Login',
            'avatarsize' => 200,
            'labelusername' => '',
            'labelpassword' => '',
            'labelrememberme' => '',
            'labellogin' => '',
            'labellogout' => '',
            'labellostpassword' => '',
            'labelregister' => '',
            'labelsiteadmin' => ''
        ) );
	?>
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for"<?php echo $this->get_field_id( 'avatarsize' ); ?>"><?php _e( 'Avatar Size (in pixels):', 'wptc_theme_td' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'avatarsize' ); ?>" name="<?php echo $this->get_field_name( 'avatarsize' ); ?>" value="<?php echo intval( $instance['avatarsize'] ); ?>" />
        </p>
        <p>
            <strong><?php _e( 'Override Form Labels', 'wptc_theme_td' ); ?></strong>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labelusername' ); ?>"><?php _e( 'Username:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labelusername' ); ?>" name="<?php echo $this->get_field_name( 'labelusername' ); ?>" value="<?php echo esc_attr( $instance['labelusername'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labelpassword' ); ?>"><?php _e( 'Password:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labelpassword' ); ?>" name="<?php echo $this->get_field_name( 'labelpassword' ); ?>" value="<?php echo esc_attr( $instance['labelpassword'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labelrememberme' ); ?>"><?php _e( 'Remember Me:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labelrememberme' ); ?>" name="<?php echo $this->get_field_name( 'labelrememberme' ); ?>" value="<?php echo esc_attr( $instance['labelrememberme'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labellogin' ); ?>"><?php _e( 'Log In:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labellogin' ); ?>" name="<?php echo $this->get_field_name( 'labellogin' ); ?>" value="<?php echo esc_attr( $instance['labellogin'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labellogout' ); ?>"><?php _e( 'Log Out:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labellogout' ); ?>" name="<?php echo $this->get_field_name( 'labellogout' ); ?>" value="<?php echo esc_attr( $instance['labellogout'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'labellostpassword' ); ?>"><?php _e( 'Lost Password:', 'wptc_theme_td' ); ?></label>
	    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'labellostpassword' ); ?>" name="<?php echo $this->get_field_name( 'labellostpassword' ); ?>" value="<?php echo esc_attr( $instance['labellostpassword'] ); ?>" />
        </p>
	<?php
    }
}

/* Init widgets */
function wptc_widgets_init() {
    register_widget( 'VMenuWidget' );
    register_widget( 'WPTCLoginWidget' );
}
add_action( 'widgets_init', 'wptc_widgets_init' );


/**
 *  Start Plugin Activation
 */


require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pt1trans_register_required_plugins' );

function pt1trans_register_required_plugins() {

	
	$plugins = array(

		array(
            'name'               => '1 QT Essential Plugins', // The plugin name.
            'slug'               => 'essentials', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-essentials.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
			array(
            'name'               => '2 QT Security Plugins', // The plugin name.
            'slug'               => 'security', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-security.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '3 QT Misc', // The plugin name.
            'slug'               => 'misc', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-misc.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '4 QT Speed', // The plugin name.
            'slug'               => 'speed', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-speed.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '5 QT Sliders', // The plugin name.
            'slug'               => 'sliders', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-sliders.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '6 QT Page Builders', // The plugin name.
            'slug'               => 'builders', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-builders.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '7 QT Woocommerce', // The plugin name.
            'slug'               => 'wooc', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-wooc.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'               => '8 QT Development', // The plugin name.
            'slug'               => 'development', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-development.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
);

	
	$theme_text_domain = 'tgmpa';

	
	$config = array(
		'domain'       		=> $theme_text_domain,         	
		'default_path' 		=> '',                         	
		'parent_menu_slug' 	=> 'themes.php', 				
		'parent_url_slug' 	=> 'themes.php', 				
		'menu'         		=> 'install-required-plugins', 	
		'has_notices'      	=> true,                       	
		'is_automatic'    	=> true,					   	
		'message' 			=> '',							
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/**
 *  End Plugin Activation
 */
 
// ==============================================
// show post thumbnails in feeds
// ==============================================
function diw_post_thumbnail_feeds($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<div>' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'diw_post_thumbnail_feeds');
add_filter('the_content_feed', 'diw_post_thumbnail_feeds');

// ==============================================
// Multi author media separation
// ==============================================
function qt_multiauthors() {
   global $theme_display_options;
   if ( $theme_display_options['qtauthors'] ) :
function um_filter_media_files($wp_query)
{
	global $current_user;

	if(!current_user_can('manage_options') && (is_admin() && $wp_query->query['post_type'] === 'attachment'))
		$wp_query->set('author', $current_user->ID);
}

function um_recount_attachments($counts_in)
{
	global $wpdb;
	global $current_user;

	$and = wp_post_mime_type_where(''); //Default mime type //AND post_author = {$current_user->ID}
	$count = $wpdb->get_results( "SELECT post_mime_type, COUNT( * ) AS num_posts FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status != 'trash' AND post_author = {$current_user->ID} $and GROUP BY post_mime_type", ARRAY_A );

	$counts = array();
	foreach((array)$count as $row)
		$counts[ $row['post_mime_type'] ] = $row['num_posts'];

	$counts['trash'] = $wpdb->get_var( "SELECT COUNT( * ) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_author = {$current_user->ID} AND post_status = 'trash' $and");
	return $counts;
};

add_filter('wp_count_attachments', 'um_recount_attachments');
add_action('pre_get_posts', 'um_filter_media_files');

/* Change media Authors. */
defined('ABSPATH') or die('Direct access is not allowed.');


/* Register the new bulk actions. */
function bulk_change_media_author_register_actions($bulk_actions) {
	$bulk_actions['bulk_change_media_author_action'] = __( 'Change Author', 'bulk-change-media-author');
	return $bulk_actions;
}
add_filter('bulk_actions-upload', 'bulk_change_media_author_register_actions');


/* Handle the new bulk actions. */
function bulk_change_media_author_action_handler($redirect_to, $action_name, $media_ids) {
	if ('bulk_change_media_author_action' === $action_name) {
		$redirect_to = add_query_arg('media', urlencode(json_encode($media_ids)), 'options.php?page=bulk-change-media-author-edit-page' );
	}

	return $redirect_to;
}
add_filter('handle_bulk_actions-upload', 'bulk_change_media_author_action_handler', 10, 3);


/* Register the author change page. */
function bulk_change_media_author_register_edit_page() {
	add_submenu_page(
		'',
		__( 'Bulk Change Media Author', 'bulk-change-media-author' ),
		__( '', 'bulk-change-media-author' ),
		'manage_options',
		'bulk-change-media-author-edit-page',
		'bulk_change_media_author_edit_page_callback'
	);
}
add_action('admin_menu', 'bulk_change_media_author_register_edit_page');


/* Change author for the media. */
function bulk_change_media_author_update_author($author_id, $media_ids) {
	foreach ($media_ids as $media_id) {
		wp_update_post(array(
			'ID' => $media_id,
			'post_author' => $author_id,
		));
	}
}


/* Display the author change page. */
function bulk_change_media_author_edit_page_callback() {
	$author = (isset($_REQUEST['author'])) ? $_REQUEST['author'] : false;
	$media = urldecode(stripslashes($_REQUEST['media']));
	$media_ids = json_decode($media);
	$redirectToMediaLibrary = false;
	?>
	<div class="wrap">
		<h1><?php _e('Bulk change author for media', 'bulk-change-media-author'); ?></h1>
		<?php
		if (count($media_ids) == 0) {
			echo '<hr /><div class="result">' . __( 'No media items selected. Redirecting back to Media Library...', 'bulk-change-media-author') . '</div>';
			$redirectToMediaLibrary = true;
		} else if ($author) {
			bulk_change_media_author_update_author($author, $media_ids);

			echo '<hr /><div class="result">';
			_e('Updated! New author: ', 'bulk-change-media-author');
			 echo get_the_author_meta('display_name', $author) . '. ';
			_e('Redirecting back to Media Library...', 'bulk-change-media-author');
			echo '</div>';

			$redirectToMediaLibrary = true;
		}

		if ($redirectToMediaLibrary) {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function(){ window.location = "' . admin_url('upload.php') . '" }, 1000);';
			echo '</script>';
		}
		?>
		<hr />
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<p><?php _e('Select a new author for the media:', 'bulk-change-media-author'); ?></p>
			<input type="hidden" name="page" value="bulk-change-media-author-edit-page" />
			<input type="hidden" name="media" value="<?php echo urlencode($media); ?>" />
			<div>
				<select name="author"><?php
				$users = get_users();
				foreach ($users as $user):
					echo '<option value="' . esc_html($user->ID) . '">' . esc_html($user->user_login) . '</option>';
				endforeach;
				?></select>
				<input type="submit" class="button-primary" value="Change"> <a href="<?php echo admin_url('upload.php'); ?>" class="button-secondary" >Cancel</a>
			</div>
		</form>
		<hr />
		<p><?php _e('Selected media items (the author will be changed for the items below)', 'bulk-change-media-author'); ?>:</p>
		<div><?php
		foreach ($media_ids as $media_id):
			$media_name = get_the_title($media_id);
			$media_name = (strlen($media_name) > 13) ? substr($media_name, 0, 10) . '...' : $media_name;
			$media_file = basename(get_attached_file($media_id));
			$media_file = (strlen($media_file) > 10) ? substr($media_file, 0, 7) . '...' : $media_file;
			$media_title = $media_name . ' (' . $media_file . ')';

			echo '<div class="media">';
			echo '<a href="'. get_edit_post_link($media_id) . '" target="_blank">';
			echo '<div class="media-author">' . get_the_author_meta('display_name', get_post_field ('post_author', $media_id)) . '</div>';
			echo '<div>' . $media_title . '</div>';
			echo '<div class="media-thumb">' . wp_get_attachment_image($media_id) . '</div>';
			echo '</a>';
			echo '</div>';
		endforeach;
		?></div>
		<hr />
		<style>
			.result {
				font-weight: bold;
			}
			.media {
				display: inline-block;
				padding: 10px;
				margin: 10px;
				background: #fff;
			}
			.media a {
				text-decoration: none;
				color: #000;
			}
			.media-author {
				font-weight: bold;
			}
			.media-thumb {
				margin-top: 5px;
				border: 1px solid rgba(0,0,0,.07);
				max-width: 150px;
		    max-height: 150px;
			}
		</style>
	</div>
	<?php
}
   endif;
}
add_action( 'after_setup_theme', 'qt_multiauthors' );

// ==============================================
// Slug as body class - body.page-contact h1 { color : red; } as oppose to body.page-id-4 ...
// ==============================================
add_filter( 'body_class', 'slug_as_body_class' );

function slug_as_body_class( $classes ) {
	global $post;

	if ( isset( $post ) && is_singular() ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	return $classes;
}

// ==============================================
// Support for QTCSS
// ==============================================
if( function_exists('qtcss_css_js_scripts_important')) {
// Do Nothing
} else {

// ==============================================
/* Custom CSS stylesheets for posts and pages */
/* CHANGE THE FOLLOWING IF YOU NEED A DIFFERENT PATH IT MUST BE A SUBDIR IN YOUR THEME'S FOLDER */
define('CCSS_PATH','/page-css/');
/* AND THAT'S ABOUT IT */
// ==============================================

define('CCSS_VERSION','1.1');

function ccss_box() {
 $ccss_post_types = _ccss_get_post_types();
	
	foreach ($ccss_post_types as $key=>$value)
	{
		add_meta_box( 'custom-css', 'Custom CSS for posts/pages - No Archives', 'ccss_add_box', $key, 'normal','high' );
	}
}

function ccss_add_box() {
  global $post_ID;
  $current = get_post_meta($post_ID, 'css_sheet', 'true'); 
  $dir_url = get_stylesheet_directory()	. CCSS_PATH;
  echo "Select your custom stylesheet:";
  echo "<select id='ccss' name='ccss'>";
  echo "<option value='-1'>Select a stylesheet</option>";  
  if ($handle = opendir($dir_url)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if ($current != $file) {
             echo "<option value='". $file . "'>" . $file . "</option>";
            }
            else {
             echo "<option value='". $file . "' selected='selected'>" . $file . "</option>";
            }
        }
    }
    closedir($handle);
   } 
  echo "</select>";
} 

function ccss_save() {	
	global $post_ID;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if (!current_user_can( 'edit_post', $post_id ) ) return;

	$id = $_POST['post_ID'];
	$css_sheet = $_POST['ccss'];
	
	// no need to keep extra info in db for posts/pages without an extra stylesheet.
	if ($css_sheet != '-1') {
 	update_post_meta($id, 'css_sheet', $css_sheet);
 }
 else {
  delete_post_meta($id, 'css_sheet');
 }
}

function ccss_include() {
 global $wp_query;
 $id = $wp_query->post->ID;
 $the_sheet  = get_post_meta($id, 'css_sheet','true'); // stylesheet name
 $the_path   = get_stylesheet_directory_uri(); // path to our template folder
 $the_output = $the_path . CCSS_PATH . $the_sheet; // let's create the whole thing
 if ($the_sheet) {
  if (is_single() || is_page())
	 wp_enqueue_style('css_sheet', $the_output, TRUE, CCSS_VERSION, 'screen,projection'); 
 }
}

// fetch a list of all custom types so we can assign the dropdown to each one of them
function _ccss_get_post_types()
{
	// Get the post types available
	$types = array();
	$types = get_post_types($args = array(
		'public'   => true
	), 'objects');

	unset($types['attachment']);
	return $types;
}

// oi! wait! where are you going? are you sure? 100%? a second thought? come on let's talk about it. oh well.
function ccss_uninstall() {
			global $wpdb;	
			$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE meta_key = 'css_sheet'"));
}

add_action('admin_menu', 'ccss_box');
add_action('save_post', 'ccss_save');
add_action('wp_print_styles','ccss_include',999);
register_uninstall_hook(__FILE__, 'ccss_uninstall');

// ==============================================
//Custom CSS in pages and posts
// ==============================================
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high');
}
function custom_css_input() {
	global $post;
	echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
	echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
	if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_css = $_POST['custom_css'];
	update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
	if (is_page() || is_single()){
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<style type="text/css">'.get_post_meta(get_the_ID(), '_custom_css', true).'</style>';
		endwhile; endif;
		rewind_posts();
		}
		}
}
		
// ==============================================
/* Link thumbs to post */
// ==============================================
add_filter( 'post_thumbnail_html', 'wps_post_thumbnail', 10, 3 );
function wps_post_thumbnail( $html, $post_id, $post_image_id ) {
  if ( class_exists( 'woocommerce' ) && is_woocommerce() ) return $html;
  return '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
}

// ==============================================
/* Register Menus For Widgets and Footer Menu */
// ==============================================
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
If (is_plugin_active('megamenu/megamenu.php')) {
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'widget1', __( 'Widget 1 Menu', 'theme-slug' ) );
  register_nav_menu( 'widget2', __( 'Widget 2 Menu', 'theme-slug' ) );
  register_nav_menu( 'footer', __( 'Footer Menu', 'theme-slug' ) );
}

/* Max Mega Menu Themes */

/* Begin Primary Theme */

function megamenu_add_theme_primary_1479515037($themes) {
    $themes["primary_1479515037"] = array(
        'title' => 'Primary',
        'container_background_from' => 'rgba(34, 34, 34, 0)',
        'container_background_to' => 'rgba(34, 34, 34, 0)',
        'menu_item_align' => 'center',
        'menu_item_background_hover_from' => 'rgb(68, 68, 68)',
        'menu_item_background_hover_to' => 'rgb(68, 68, 68)',
        'menu_item_link_font_size' => '16px',
        'menu_item_link_height' => '58px',
        'menu_item_link_weight' => 'inherit',
        'menu_item_link_padding_left' => '20px',
        'menu_item_link_padding_right' => '20px',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => 'rgb(34, 34, 34)',
        'panel_second_level_font_color_hover' => 'rgb(34, 34, 34)',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '18px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => 'rgb(255, 255, 255)',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '16px',
        'panel_third_level_background_hover_from' => 'rgb(102, 102, 102)',
        'panel_third_level_background_hover_to' => 'rgb(102, 102, 102)',
        'flyout_width' => '250px',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'responsive_breakpoint' => '1100px',
        'toggle_background_from' => 'rgba(34, 34, 34, 0)',
        'toggle_background_to' => 'rgba(34, 34, 34, 0)',
        'toggle_font_color' => '#ffffff',
        'toggle_bar_height' => '58px',
        'mobile_menu_item_height' => '58px',
        'mobile_background_from' => 'rgba(34, 34, 34, 0)',
        'mobile_background_to' => 'rgba(34, 34, 34, 0)',
        'custom_css' => '#{$wrap} #{$menu} {
    /** Custom styles should be added below this line **/
}
#{$wrap} {
    clear: both;
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_primary_1479515037");

/* End Primary Theme */

/* Begin Header-Widget1-Menu2 Theme */

function megamenu_add_theme_menu2_1479514527($themes) {
    $themes["menu2_1479514527"] = array(
        'title' => 'Menu2',
        'container_background_from' => 'rgba(34, 34, 34, 0)',
        'container_background_to' => 'rgba(34, 34, 34, 0)',
        'menu_item_background_hover_from' => 'rgb(68, 68, 68)',
        'menu_item_background_hover_to' => 'rgb(68, 68, 68)',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_background_hover_from' => 'rgba(221, 221, 221, 0)',
        'panel_second_level_background_hover_to' => 'rgba(221, 221, 221, 0)',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'panel_third_level_background_hover_from' => 'rgb(193, 193, 193)',
        'panel_third_level_background_hover_to' => 'rgb(193, 193, 193)',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'responsive_breakpoint' => '1000px',
        'toggle_background_from' => 'rgba(34, 34, 34, 0)',
        'toggle_background_to' => 'rgba(34, 34, 34, 0)',
        'toggle_font_color' => '#ffffff',
        'mobile_background_from' => 'rgba(34, 34, 34, 0)',
        'mobile_background_to' => 'rgba(34, 34, 34, 0)',
        'custom_css' => '#{$wrap} #{$menu} {
    /** Custom styles should be added below this line **/
}
#{$wrap} {
    clear: both;
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_menu2_1479514527");

/* End Header-Widget1-Menu2 Theme */

/* Begin Widget2 Theme */

function megamenu_add_theme_widget2_1472747084($themes) {
    $themes["widget2_1472747084"] = array(
        'title' => 'Widget2',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'panel_third_level_background_hover_from' => 'rgb(193, 193, 193)',
        'panel_third_level_background_hover_to' => 'rgb(193, 193, 193)',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'responsive_breakpoint' => '1100px',
        'toggle_background_from' => '#222',
        'toggle_background_to' => '#222',
        'toggle_font_color' => '#ffffff',
        'mobile_background_from' => '#222',
        'mobile_background_to' => '#222',
        'custom_css' => '/** Push menu onto new line **/
#{$wrap} {
    clear: both;
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_widget2_1472747084");

/* End Widget2 Theme */

/* Begin Footer Theme */

function megamenu_add_theme_footer_1479515535($themes) {
    $themes["footer_1479515535"] = array(
        'title' => 'Footer',
        'container_background_from' => 'rgba(34, 34, 34, 0)',
        'container_background_to' => 'rgba(34, 34, 34, 0)',
        'menu_item_align' => 'center',
        'menu_item_background_hover_from' => 'rgb(68, 68, 68)',
        'menu_item_background_hover_to' => 'rgb(68, 68, 68)',
        'menu_item_link_font_size' => '18px',
        'menu_item_link_color' => 'rgb(255, 255, 255)',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'toggle_background_from' => 'rgba(34, 34, 34, 0)',
        'toggle_background_to' => 'rgba(34, 34, 34, 0)',
        'toggle_font_color' => 'rgb(255, 255, 255)',
        'mobile_background_from' => 'rgba(34, 34, 34, 0)',
        'mobile_background_to' => 'rgba(34, 34, 34, 0)',
        'custom_css' => '#{$wrap} #{$menu} {
    /** Custom styles should be added below this line **/
}
#{$wrap} {
    clear: both;
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_footer_1479515535");

/* End Footer Theme */



}


// ==============================================
/* Admin Bar Additions */
// ==============================================

function toolbar_quick_menu( $wp_admin_bar ) {
	$args = array(
		'id'    => 'general_settings',
		'title' => 'General Settings',
		'href'  => admin_url() . 'options-general.php',
                
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'    => 'posts',
		'title' => 'Posts',
		'href'  => admin_url() . 'edit.php',
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'pages',
		'title' => 'Pages',
		'href'  => admin_url( 'edit.php?post_type=page'),
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

       $args = array(
		'id'    => 'media_library',
		'title' => 'Media Library',
		'href'  => admin_url() . 'upload.php',
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'media_settings',
		'title' => 'Media Settings',
		'href'  => admin_url() . 'options-media.php',
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'users',
		'title' => 'Users',
		'href'  => admin_url() . 'users.php',
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'    => 'add_user',
		'title' => 'Add User',
		'href'  => admin_url() . 'user-new.php',
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'help',
		'title' => 'Theme Help',
		'href'  => admin_url( 'themes.php?page=wptc-help-support&tab=Shortcodes'),
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'install_plugins',
		'title' => 'Install Suggested Plugins',
		'href'  => admin_url( 'themes.php?page=install-required-plugins'),
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'theme_editor',
		'title' => 'Theme Editor',
		'href'  => admin_url( 'theme-editor.php'),
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        $args = array(
		'id'    => 'press_this',
		'title' => 'Press This',
		'href'  => admin_url( 'press-this.php'),
		'parent' => 'general_settings'
	);
	$wp_admin_bar->add_node( $args );

        
}
add_action( 'admin_bar_menu', 'toolbar_quick_menu', 999 );

// ==============================================
/* Smooth Scrolling */
// ==============================================
function easy_smooth_scroll_js_file(){
	 wp_enqueue_script( "easy_smooth_scroll_js_file", get_template_directory_uri() . "/includes/SmoothScroll.js" , array("jquery"), "1.0.0.0", true );
}
add_action("wp_enqueue_scripts","easy_smooth_scroll_js_file");

// ==============================================
/* Widgets Shortcode */
// ==============================================
add_shortcode( 'widget', 'widget_shortcode' );
add_action( 'widgets_init', 'widget_shortcode_arbitrary_sidebar', 20 );
add_action( 'in_widget_form', 'widget_shortcode_form', 10, 3 );


function do_widget( $args ) {
	global $_wp_sidebars_widgets, $wp_registered_widgets, $wp_registered_sidebars;

	extract( shortcode_atts( array(
		'id' => '',
		'title' => true, 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
		'after_widget' => '</div>',
		'echo' => true
	), $args, 'widget' ) );

	if( empty( $id ) || ! isset( $wp_registered_widgets[$id] ) )
		return;

	preg_match( '/(\d+)/', $id, $number );
	$options = get_option( $wp_registered_widgets[$id]['callback'][0]->option_name );
	$instance = $options[$number[0]];
	$class = get_class( $wp_registered_widgets[$id]['callback'][0] );
	$widgets_map = widget_shortcode_get_widgets_map();
	$_original_widget_position = $widgets_map[$id];

	if( ! $class )
		return;

	$show_title = ( '0' == $title ) ? false : true;

	$params = array(
		0 => array(
			'name' => $wp_registered_sidebars[$_original_widget_position]['name'],
			'id' => $wp_registered_sidebars[$_original_widget_position]['id'],
			'description' => $wp_registered_sidebars[$_original_widget_position]['description'],
			'before_widget' => $before_widget,
			'before_title' => $before_title,
			'after_title' => $after_title,
			'after_widget' => $after_widget,
			'widget_id' => $id,
			'widget_name' => $wp_registered_widgets[$id]['name']
		),
		1 => array(
			'number' => $number[0]
		)
	);
	$params = apply_filters( 'dynamic_sidebar_params', $params );

	if( ! $show_title ) {
		$params[0]['before_title'] = '<h3 class="widgettitle">';
		$params[0]['after_title'] = '</h3>';
	} elseif( is_string( $title ) && strlen( $title ) > 0 ) {
		$instance['title'] = $title;
	}

	$classname_ = '';
	foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
		if ( is_string( $cn ) )
			$classname_ .= '_' . $cn;
		elseif ( is_object($cn) )
			$classname_ .= '_' . get_class( $cn );
	}
	$classname_ = ltrim( $classname_, '_' );
	$params[0]['before_widget'] = sprintf( $params[0]['before_widget'], $id, $classname_ );

	ob_start();
	the_widget( $class, $instance, $params[0] );
	$content = ob_get_clean();

	if( ! $show_title ) {
		$content = preg_replace( '/<h3 class="widgettitle">(.*?)<\/h3>/', '', $content );
	}

	if( $echo !== true )
		return $content;
	echo $content;
}

function widget_shortcode( $atts, $content = null ) {
	$atts['echo'] = false;
	return do_widget( $atts );
}

function widget_shortcode_arbitrary_sidebar() {
	register_sidebar( array(
		'name' => __( 'Theme Widget Shortcodes' ),
		'id' => 'arbitrary',
		'description'	=> __( 'This widget area can be used for [widget] shortcode.' ),
		'before_widget' => '',
		'after_widget'	=> '',
	) );
}

function widget_shortcode_form( $widget, $return, $instance ) {
	echo '<p>' . __( 'Shortcode' ) . ': ' . ( ( $widget->number == '__i__' ) ? __( 'Please save this first.' ) : '<code>[widget id="'. $widget->id .'"]</code>' ) . '</p>';
}

function widget_shortcode_get_widgets_map() {
	$sidebars_widgets = wp_get_sidebars_widgets();
	$widgets_map = array();
	if ( ! empty( $sidebars_widgets ) )
		foreach( $sidebars_widgets as $position => $widgets )
			if( ! empty( $widgets) )
				foreach( $widgets as $widget )
					$widgets_map[$widget] = $position;

	return $widgets_map;
}

/* ===================================================================
 *
 * Add font size select buttons to TinyMCE & Page Break with Fonto Support
 *
 * ================================================================ */
if( function_exists('fonto')) {
    // DO NOTHING 
} else {
// Enable font size & font family selects in the editor
if ( ! function_exists( 'wpmg_mce_buttons' ) ) {
	function wpmg_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'wpmg_mce_buttons' );
	
	// Customize mce editor font sizes
if ( ! function_exists( 'wpmg_mce_text_sizes' ) ) {
	function wpmg_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "14px 16px 18px 21px 24px 28px 32px 36px 40px 46px 50px 60px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpmg_mce_text_sizes' );

/* Add Next Page Button in First Row */
add_filter( 'mce_buttons', 'my_add_next_page_button', 1, 2 ); // 1st row
 
function my_add_next_page_button( $buttons, $id ){
 
    /* only add this for content editor */
    if ( 'content' != $id )
        return $buttons;
 
    /* add next page after more tag button */
    array_splice( $buttons, 13, 0, 'wp_page' );
 
    return $buttons;
}
}

// ==============================================
/* Site Icon As Login Logo */
// ==============================================
add_filter( 'login_headerurl', 'login_site_icon_url' );
function login_site_icon_url() {
	return get_site_url();
}

add_filter( 'login_headertitle', 'login_site_icon_title' );
function login_site_icon_title( $title ) {
	return get_bloginfo( 'name' );
}

add_action( 'login_head', 'login_site_icon_img_css' );
function login_site_icon_img_css() {
	if ( has_site_icon() ) { ?>
	<style type="text/css">
		.login h1 a {
			background-image: url('<?php site_icon_url( 180 ); ?>');
		}
	</style>
	<?php }
}

// ==============================================
/* Reinstall without deleting first */
// ==============================================
function qt_installagain() {
   global $theme_display_options;
   if ( $theme_display_options['qtreinstall'] ) :
   
add_filter( "upgrader_package_options", "allow_reinstalls_upgrader_package_options" );
function allow_reinstalls_upgrader_package_options( $options ) {
	$options['abort_if_destination_exists'] = false;
	return( $options );
}

   endif;
}
add_action( 'after_setup_theme', 'qt_installagain' );

// ==============================================
/* Force Delete Plugins - without deactivating them first */
// ==============================================
function qt_forcedelete() {
   global $theme_display_options;
   if ( $theme_display_options['qtdelete'] ) :
   
if ( ! defined( 'WPINC' ) ) {
	die;
}

function wp_ajax_pre_delete_plugin() {
	check_ajax_referer( 'updates' );

	if ( empty( $_POST['slug'] ) || empty( $_POST['plugin'] ) ) {
		return false;
	}

	$plugin = plugin_basename( sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) );

	if ( ! current_user_can( 'delete_plugins' ) ) {
		return false;
	}

	if ( is_plugin_active( $plugin ) ) {
		deactivate_plugins( $plugin );
	}
}

function reorder_ajax_hooks_before_deleting() {
	$removed = remove_action( 'wp_ajax_delete-plugin', 'wp_ajax_delete_plugin', 1 );
	add_action( 'wp_ajax_delete-plugin', 'wp_ajax_pre_delete_plugin', 1 );
	add_action( 'wp_ajax_delete-plugin', 'wp_ajax_delete_plugin', 2 );
	return $removed;
}
add_action( 'admin_init', 'reorder_ajax_hooks_before_deleting' );

   endif;
}
add_action( 'after_setup_theme', 'qt_forcedelete' );

// ==============================================
/* Exclude Categories Widget */
// ==============================================

class ExcludeCategory extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Exclude Category Widget' );
	}

	function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );
		
		echo $args['before_widget'];
		
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		echo "<ul>";
		
		$cat_args['title_li'] = '';
		$cat_args['exclude'] = trim($instance['text'],',');
		
		wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
		
		echo "</ul>";

		echo $args['after_widget'];
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] =  strip_tags(preg_replace("/[^0-9,.]/", "",trim($new_instance['text'])));
        return $instance;
	}

	function form( $instance ) {
		if (!is_array($instance)) $instance = array();
        $instance = array_merge(array('title'=>'', 'text'=>''), $instance);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                Title:
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </label>


            <label for="<?php echo $this->get_field_id('text'); ?>">
                Category Ids:
                <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_html($instance['text']); ?></textarea>
            </label>
			<p>write category ids with (,) separate for excluding categories </p>
		<?php 
	}
}

function exclude_category_register_widgets() {
	register_widget( 'ExcludeCategory' );
}

add_action( 'widgets_init', 'exclude_category_register_widgets' );


// ==============================================
/* Disable admin bar on the frontend of your website for subscribers. */
// ==============================================
function qt_adminbar() {
   global $theme_display_options;
   if ( $theme_display_options['qtbaradmin'] ) :
function nosubs_disable_admin_bar() { 
	if ( ! current_user_can('edit_posts') ) {
		add_filter('show_admin_bar', '__return_false');	
	}
}
add_action( 'after_setup_theme', 'nosubs_disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to 
 * WP admin for Subscribers.
 */
function themeblvd_redirect_admin(){
	if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
		wp_redirect( site_url() );
		exit;		
	}
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );
   endif;
}
add_action( 'after_setup_theme', 'qt_adminbar' );


// ==============================================
/* Open Comment Links in New Window */
// ==============================================
function open_in_new_window($text) {
	$return_url = str_replace('<a', '<a target="_blank"', $text);
	return $return_url;
}
add_filter('get_comment_author_link', 'open_in_new_window');
add_filter('comment_text', 'open_in_new_window');

// ==============================================
/* Display elapsed time */
// ==============================================
function qt_time() {
   global $theme_display_options;
   if ( $theme_display_options['qtelapsed'] ) :
add_filter( 'get_the_date', 'dadf__convert_to_time_ago' , 10, 1 ); 
add_filter( 'the_date', 'dadf__convert_to_time_ago' , 10, 1 ); 
add_filter( 'get_the_time', 'dadf__convert_to_time_ago' , 10, 1 ); 
add_filter( 'the_time', 'dadf__convert_to_time_ago' , 10, 1 );

/* Callback function for post time and date filter hooks */
function dadf__convert_to_time_ago( $post_time ) {
	global $post;
	$post_time = strtotime( $post->post_date ); 
	return human_time_diff( $post_time, current_time( 'timestamp' ) ).' '. __( 'ago', 'wptc_theme_td' );
}
   endif;
}
add_action( 'after_setup_theme', 'qt_time' );

// ==============================================
/* Link Twitter Usernames */
// ==============================================
function content_twitter_mention($content) {
	return preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/', "$1<a href=\"http://twitter.com/$2\" target=\"_blank\" rel=\"nofollow\">@$2</a>", $content);
}

add_filter('the_content', 'content_twitter_mention');   
add_filter('comment_text', 'content_twitter_mention');

// ==============================================
/* Add Media From URL */
// ==============================================
class qtm_add_media_from_url_plugin {
private function reconstruct_url($url){    
    $url_parts = parse_url($url);
    $constructed_url = $url_parts['scheme'] . '://' . $url_parts['hostname'] . $url_parts['path'];
    return $constructed_url;
}

private function handle_upload(){
if (current_user_can('upload_files')){
if (!wp_verify_nonce( $_POST['qtm_add_media_from_url-nonce'], "qtm_add_media_from_url-file_url")) {
		return new WP_Error('qtm_add_media_from_url', 'Could not verify request nonce');
	}
$upload_url = esc_url(sanitize_text_field($_POST['qtm_add_media_from_url-file_url']));
	// build up array like PHP file upload
	$file = array();
	$file['name'] = time().basename($this->reconstruct_url($upload_url)).'.png';
	$file['tmp_name'] = download_url($upload_url);
	if (is_wp_error($file['tmp_name'])) {
		@unlink($file['tmp_name']);
		return new WP_Error('qtm_add_media_from_url', 'Could not download file from remote source');
	}
if (!is_wp_error($file['tmp_name'])) {
$attachmentId = media_handle_sideload($file, "0");
	// create the thumbnails
	$attach_data = wp_generate_attachment_metadata( $attachmentId,  get_attached_file($attachmentId));
	wp_update_attachment_metadata( $attachmentId,  $attach_data );
	return $attachmentId;	
}
}
}
function add_media_from_url() {
global $pagenow;
//Check to make sure we're on the right page and performing the right action
if( 'upload.php' != $pagenow ){
	return false;
} elseif ( empty( $_POST[ 'qtm_add_media_from_url-file_url' ] ) ){
 return false;
} else {
$return = $this->handle_upload();
if ( is_wp_error( $return ) ) {
//Upload has failed add to a global for display on the form page
$GLOBALS['qtm_add_media_from_url-form-result'] = $return;
} else {
//Upload has succeeded, redirect to mediapage
wp_safe_redirect( admin_url( 'post.php?post='.$return.'&action=edit') );
exit();
}
}
}
function plugin_menu() {
add_media_page('qtm Add Media from URL', 'Add from URL', 'read', 'qtm-add-media-from-url.php', array($this,"plugin_options"));
}
function plugin_options() {
if (!current_user_can('upload_files')){
wp_die( __('You do not have sufficient permissions to access this page.') );
}
$qtm_add_media_from_url_hidden_field_name = 'qtm_add_media_from_url_submit_hidden';
echo "<h1>" . __( 'Add Media from URL', 'qtm-add-media-from-url-identifier' ) . "</h1>";
if ($GLOBALS['qtm_add_media_from_url-form-result']){
if ( is_wp_error( $GLOBALS['qtm_add_media_from_url-form-result'] ) ) {
        foreach ( $GLOBALS['qtm_add_media_from_url-form-result']->get_error_messages() as $error ) {
            echo '<strong>ERROR</strong>: ';
            echo $error . '<br/>';
}
} 
}
if ($_POST[ 'qtm_add_media_from_url-file_url' ]){
$value = $_POST['qtm_add_media_from_url-file_url'];
} elseif ($_GET['qtm_add_media_from_url-file_url']){
$value = $_GET['qtm_add_media_from_url-file_url'];
}
?>
<form method="post">
<label for="qtm_add_media_from_url-file_url">URL: </label><input type="url" name="qtm_add_media_from_url-file_url" id="qtm_add_media_from_url-file_url" value="<?php echo $value; ?>" size="50" />
<input type="submit" value="Submit" /> 
<input type="hidden" value="<?php echo wp_create_nonce("qtm_add_media_from_url-file_url"); ?>" name="qtm_add_media_from_url-nonce" id="qtm_add_media_from_url-nonce" />
</form>
<?php if (!$value){  ?>


<?php
}
}
function __construct() {
add_action('admin_menu', array($this,"plugin_menu"));
add_action( 'admin_init', array($this,"add_media_from_url"));
}
}
$qtm_add_media_from_url = new qtm_add_media_from_url_plugin();

// ==============================================
/* Search and load pages/posts in the edit screens */
// ==============================================
class APSDSearchBox {
	
	public function __construct() {

		if ( is_admin() ) {
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			add_action( 'do_meta_boxes', array( &$this, 'addSearchBox' ), 10, 2 );
		}	
	}
		public function getPostsResult() {
		global $wpdb;
		$posts = array();
		$query  = "SELECT ID, post_title FROM {$wpdb->posts} ";
		if ( $this->post_type && isset( $_GET['post'] ) && isset( $_GET['action'] ) ) {
			$query .= "WHERE post_type = %s ";
		} else {
			$query .= "WHERE post_type != 'revision' ";
		}
		$post_results = $wpdb->get_results( $wpdb->prepare( $query, $this->post_type ) );
		if ( $post_results ) {
			foreach ( $post_results as $post_result ) {
				if ( $post_result->post_title ) {
					$posts[] = array( 'label' => 'ID = ' . $post_result->ID  . ' - ' . $post_result->post_title, 'value' => admin_url( 'post.php?post=' . $post_result->ID . '&action=edit' ) );
				}
			}	
		} else {
			$posts[] = array( 'label' => 'Nothing Found', 'value' => '' );
		}
		return json_encode( $posts );

	}
	
	public function showSearchBox() {
		global $post;
		$this->post_type = $post->post_type;
		$this->posts = $this->getPostsResult();
		?>
		<script type="text/javascript">
		jQuery(document).ready(function(){
			
			var currentPosts = <?php echo $this->posts; ?>;
			jQuery('#posts_search').autocomplete({
				source: currentPosts,
		        select: function( event, ui ) { 
		            window.location.href = ui.item.value;
		        }		
			});	
		});	
		</script>	
		<input type="text" name="posts_search" id="posts_search" style="width: 100%;">
		<?php
	}

	public function addSearchBox( $page, $context ) {
		
		add_meta_box( 'map-posts-search', 'Search', array( &$this, 'showSearchBox' ), $page, 'side', 'high' );
	
	}		
}

function do_searching() {
	$do_searching = new APSDSearchBox();
}
do_searching();

// ==============================================
/* User Notes */
// ==============================================
function user_notes_get_delim($link) {
  return ((preg_match("#\?#",$link))?'&':'?');
}

function user_notes_show_field($wp_user) {
  //If not an admin -- don't show this -- that would be bad :)
  if(!current_user_can('list_users'))
    return;
  
  $notes = get_user_meta($wp_user->ID, 'user-notes-note', true);
  
  ?>
    <h3><?php _e('User Notes', 'user-notes'); ?></h3>
    
    <table class="form-table">
      <tbody>
        <tr>
          <td colspan="2">
            <?php wp_editor($notes, 'user_notes_note', array('teeny' => true)); ?>
          </td>
        </tr>
      </tbody>
    </table>
  <?php
}
add_action('show_user_profile', 'user_notes_show_field');
add_action('edit_user_profile', 'user_notes_show_field');

function user_notes_save_note($user_id) {
  //Only admins, and only if it's set (so we don't wipe out the notes when non-admins save the profile)
  if(!current_user_can('list_users') || !isset($_POST['user_notes_note']))
    return;
  
  $notes = (!empty($_POST['user_notes_note']))?stripslashes($_POST['user_notes_note']):'';
  
  update_user_meta($user_id, 'user-notes-note', $notes);
}
add_action('personal_options_update', 'user_notes_save_note');
add_action('edit_user_profile_update', 'user_notes_save_note');

function user_notes_add_users_column($cols) {
  $cols = array_merge($cols, array('user_notes_note' => __('Notes', 'user-notes')));
  
  return $cols;
}
add_filter('manage_users_columns', 'user_notes_add_users_column');

function user_notes_display_column($val, $col_name, $user_id) {
  if($col_name == 'user_notes_note') {
    $notes = get_user_meta($user_id, 'user-notes-note', true);
    
    //If no notes -- return none
    if(empty($notes))
      return '<a href="' . admin_url('user-edit.php?user_id=' . $user_id . '#wp-user_notes_note-wrap') . '">' . __('Add Note', 'user-notes') . '</a>';
    
    $notes_excerpt = strip_tags(substr($notes, 0, 100)) . ' ...';
    $notes_excerpt = trim(preg_replace('/\s+/', ' ', $notes_excerpt));
    
    $user = new WP_User($user_id);
    $title = __('Note for', 'user-notes') . ' ' . $user->user_login . "\n" . $notes_excerpt;
    
    //Get the dilimiter
    $uri = $_SERVER['REQUEST_URI'];
    $delim = user_notes_get_delim($uri);
    
    ob_start();
    
    ?>
      <div id="user_notes_thickbox_<?php echo $user_id; ?>" style="display:none;">
        <?php echo wpautop($notes); ?>
        <p><a href="<?php echo admin_url('user-edit.php?user_id=' . $user_id . '#wp-user_notes_note-wrap'); ?>"><?php _e('Edit Note'); ?></a></p>
      </div>
      <strong><a href="#TB_inline<?php echo $delim; ?>inlineId=user_notes_thickbox_<?php echo $user_id; ?>" class="thickbox" title="<?php echo $title; ?>" style="color:navy;"><?php _e('View Note', 'user-notes'); ?></a></strong>
    <?php
    
    return ob_get_clean();
  }
  
  return $val;
}
add_action('manage_users_custom_column', 'user_notes_display_column', 10, 3);

function user_notes_enqueue_thickbox($hook) {
  if($hook != 'users.php')
    return;
  
  wp_enqueue_style('thickbox');
  wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts', 'user_notes_enqueue_thickbox');

// ==============================================
/* Change default outgoing email address */
// ==============================================
function personal_email_from( $from_email ) {
	/* Calculate the default address */
	$sitename = strtolower( $_SERVER['SERVER_NAME'] );
	if ( 'www.' === substr( $sitename, 0, 4 ) ) {
		$sitename = substr( $sitename, 4 );
	}
	/* Check that we don't effect emails not sent with the default address */
	if ( 'wordpress@' . $sitename === $from_email ) {
		$from_email = get_bloginfo( 'admin_email' );
	}
	return $from_email;
}
add_filter( 'wp_mail_from', 'personal_email_from' );

function personal_email_from_name( $from_name ) {
	if ( 'WordPress' === $from_name ) {
		$from_name = get_bloginfo( 'name' );
	}
	return $from_name;
}
add_filter( 'wp_mail_from_name', 'personal_email_from_name' );

// ==============================================
/*  Remove references to SiteOrigin Premium */
// ==============================================
add_filter( 'siteorigin_premium_upgrade_teaser', '__return_false' );

// ==============================================
/* Preloader */
// ==============================================

function qt_preloader() {
   global $theme_display_options;
   if ( $theme_display_options['qtpre'] ) :
      /* Adding Latest jQuery from WordPress */
function qt_preloader_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'qt_preloader_latest_jquery');

/* HTML Content */
function qt_preloader_markup() {
?>
	<div id="loader-wrapper">
		<div id="loader"></div>
	</div>
<?php
}
add_action ('wp_enqueue_scripts', 'qt_preloader_markup');

/* PRELOADER ACTIVATION */
function qt_preloader_activation() {
?>
	<script>
		jQuery(window).load(function() {
			jQuery("#loader").delay(300).fadeOut("slow");
			jQuery("#loader-wrapper").delay(1200).fadeOut("slow");
		});
	</script>
<?php
}
add_action ('wp_footer', 'qt_preloader_activation');
   endif;
}
add_action( 'after_setup_theme', 'qt_preloader' );

// ==============================================
/* Secret Key */
// ==============================================
function qt_skey() {
   global $theme_display_options;
   if ( $theme_display_options['skey'] ) :
   
    if ( ! defined( 'ABSPATH' ) ) exit;
add_action('admin_menu', 'qtcode_menu');
function qtcode_menu() {
    add_submenu_page(
        'users.php',
        'Secret Code',
        'Secret Code',
        'manage_options',
        'qtcode',
        'qtcode_page' );
}

add_action('admin_init', 'qtcode_register_settings');
function qtcode_register_settings() {
    register_setting('qtcode_settings', 'qtcode_settings', 'qtcode_settings_validate');
}

function qtcode_settings_validate($options) {
    if(isset($options['code'])) {
        if(!empty($options['code'])) {
			if(strlen($options['code']) > 20) {
				add_settings_error('qtcode_settings', 'qtcode_code', 'Secret code cannot be longer than 20 characters.', $type = 'error');
				return false;
			} elseif(strlen($options['code']) < 3) {
				add_settings_error('qtcode_settings', 'qtcode_code', 'Secret code cannot be shorter than 3 characters.', $type = 'error');
				return false;
			} else {
				add_settings_error('qtcode_settings', 'qtcode_code', 'Settings saved.', $type = 'updated');
			}
		} else {
			add_settings_error('qtcode_settings', 'qtcode_code', 'Secret code has been disabled.', $type = 'updated');
		}
    }

    return $options;
}

add_action('admin_notices', 'qtcode_admin_notices');
function qtcode_admin_notices() {
	settings_errors();
}

function qtcode_page() {
?>
<div class="wrap">
	<h1>Secret Code</h1>
	<p><?php echo __('Make sure to write down your Secret code. Leave the field blank to disable.', 'qtcode') ?></p>
	<form method="post" action="options.php">
	<?php
    settings_fields( 'qtcode_settings' );
    do_settings_sections( __FILE__ );

    $options = get_option( 'qtcode_settings' );
	?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="auth_field"><?php echo __('Secret Code', 'qtcode') ?></label>
					</th>
					<td>
						<input type="text" name="qtcode_settings[code]" id="auth_field" autocomplete="off" value="<?php echo (isset($options['code']) && $options['code'] != '') ? $options['code'] : ''; ?>" min="3" max="20" />
					</td>
				</tr>
			</tbody>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}
function do_qtcode() {
	$options = get_option( 'qtcode_settings' );

	if(!empty($options['code'])) {
	add_filter( 'login_form', function() {
		printf(
			'<p class="login-authenticate">
				<label for="auth_key">%s</label>
				<input type="text" name="qtcode_auth_key" 
						id="qtcode_auth_key" class="input" 
						value="" size="20" autocomplete="off" />
			</p>',
			esc_html__( 'Secret Code', 'qtcode' )
		);
	} );

	add_filter( 'authenticate', function( $user ) {
		$options = get_option( 'qtcode_settings' );

		$submit_code = filter_input( INPUT_POST, 'qtcode_auth_key',
			FILTER_SANITIZE_STRING );
			
		if ( is_wp_error( $user ) ) {
			return $user;
		}

		$is_valid_auth_code = ! empty( $options['code'] ) 
			&& ( $options['code'] === $submit_code );
			
		if( ! $is_valid_auth_code )
			$user = new WP_Error(
				'invalid_auth_code',
				sprintf(
					'<strong>%s</strong>: %s',
					esc_html__( 'ERROR', 'qtcode' ),
					esc_html__( 'Secret code is invalid.', 'qtcode' )
				)
			); 

		return $user;

	}, 100 );

	add_action( 'login_head', function() { echo '<style type="text/css">div#login{padding: 4% 0 0;}</style>'; });
	
	}
}

do_qtcode();

 

   endif;
}
add_action( 'after_setup_theme', 'qt_skey' );

// ==============================================
// Removing the meta generator tag
// ==============================================
remove_action('wp_head', 'wp_generator');

if ( ! function_exists( 'wd_remove_version_arg' ) ) :
function wd_remove_version_arg( $query ) {
	return add_query_arg( 'ver', false, $query );
	}

	add_filter( 'script_loader_src', 'wd_remove_version_arg', 90, 1 );
	add_filter( 'style_loader_src', 'wd_remove_version_arg', 90, 1 );
endif;

// ==============================================
/* HIDE LOGIN ERROR MESSAGES Wrong Password, No Such User etc */
// ==============================================
add_filter('login_errors',create_function('$a', "return null;"));

// ==============================================
/* Disable Visual Editor Shortcuts */
// ==============================================
function qt_veshort() {
   global $theme_display_options;
   if ( $theme_display_options['qtve'] ) :
function disable_mce_wptextpattern( $opt ) {

	if ( isset( $opt['plugins'] ) && $opt['plugins'] ) {
		$opt['plugins'] = explode( ',', $opt['plugins'] );
		$opt['plugins'] = array_diff( $opt['plugins'] , array( 'wptextpattern' ) );
		$opt['plugins'] = implode( ',', $opt['plugins'] );
	}

	return $opt;
}

add_filter( 'tiny_mce_before_init', 'disable_mce_wptextpattern' );
   endif;
}
add_action( 'after_setup_theme', 'qt_veshort' );



// ==============================================
/* Duplicate Menu */
// ==============================================
function qt_menudup() {
   global $theme_display_options;
   if ( $theme_display_options['qtdupmenu'] ) :
      function duplicate_menu_options_page() {
    add_theme_page( 'Duplicate Menu', 'Duplicate Menu', 'manage_options', 'duplicate-menu', array( 'DuplicateMenu', 'options_screen' ) );
}

add_action( 'admin_menu', 'duplicate_menu_options_page' );

/**
* Duplicate Menu
*/
class DuplicateMenu {

    function duplicate( $id = null, $name = null ) {

        // sanity check
        if ( empty( $id ) || empty( $name ) ) {
	        return false;
        }

        $id = intval( $id );
        $name = sanitize_text_field( $name );
        $source = wp_get_nav_menu_object( $id );
        $source_items = wp_get_nav_menu_items( $id );
        $new_id = wp_create_nav_menu( $name );

        if ( ! $new_id ) {
            return false;
        }

        // key is the original db ID, val is the new
        $rel = array();

        $i = 1;
        foreach ( $source_items as $menu_item ) {
            $args = array(
                'menu-item-db-id'       => $menu_item->db_id,
                'menu-item-object-id'   => $menu_item->object_id,
                'menu-item-object'      => $menu_item->object,
                'menu-item-position'    => $i,
                'menu-item-type'        => $menu_item->type,
                'menu-item-title'       => $menu_item->title,
                'menu-item-url'         => $menu_item->url,
                'menu-item-description' => $menu_item->description,
                'menu-item-attr-title'  => $menu_item->attr_title,
                'menu-item-target'      => $menu_item->target,
                'menu-item-classes'     => implode( ' ', $menu_item->classes ),
                'menu-item-xfn'         => $menu_item->xfn,
                'menu-item-status'      => $menu_item->post_status
            );

            $parent_id = wp_update_nav_menu_item( $new_id, 0, $args );

            $rel[$menu_item->db_id] = $parent_id;

            // did it have a parent? if so, we need to update with the NEW ID
            if ( $menu_item->menu_item_parent ) {
                $args['menu-item-parent-id'] = $rel[$menu_item->menu_item_parent];
                $parent_id = wp_update_nav_menu_item( $new_id, $parent_id, $args );
            }

	        // allow developers to run any custom functionality they'd like
	        do_action( 'duplicate_menu_item', $menu_item, $args );

            $i++;
        }

        return $new_id;
    }

    function options_screen() {
        $nav_menus = wp_get_nav_menus();
    ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br /></div>
            <h2><?php _e( 'Duplicate Menu' ); ?></h2>

            <?php if ( ! empty( $_POST ) && wp_verify_nonce( $_POST['duplicate_menu_nonce'], 'duplicate_menu' ) ) : ?>
                <?php
                    $source         = intval( $_POST['source'] );
                    $destination    = sanitize_text_field( $_POST['new_menu_name'] );

                    // go ahead and duplicate our menu
                    $duplicator = new DuplicateMenu();
                    $new_menu_id = $duplicator->duplicate( $source, $destination );
                ?>

                <div id="message" class="updated"><p>
                    <?php if ( $new_menu_id ) : ?>
                        <?php _e( 'Menu Duplicated' ) ?>. <a href="nav-menus.php?action=edit&amp;menu=<?php echo absint( $new_menu_id ); ?>"><?php _e( 'View' ) ?></a>
                    <?php else: ?>
                        <?php _e( 'There was a problem duplicating your menu. No action was taken.' ) ?>.
                    <?php endif; ?>
                </p></div>

            <?php endif; ?>


            <?php if ( empty( $nav_menus ) ) : ?>
                <p><?php _e( "You haven't created any Menus yet." ); ?></p>
            <?php else: ?>
                <form method="post" action="">
                    <?php wp_nonce_field( 'duplicate_menu','duplicate_menu_nonce' ); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <label for="source"><?php _e( 'Duplicate this menu' ); ?>:</label>
                            </th>
                            <td>
                                <select name="source">
                                    <?php foreach ( (array) $nav_menus as $_nav_menu ) : ?>
                                        <option value="<?php echo esc_attr($_nav_menu->term_id) ?>">
                                            <?php echo esc_html( $_nav_menu->name ); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="display:inline-block; padding:0 10px;"><?php _e( 'and call it' ); ?></span>
                                <input name="new_menu_name" type="text" id="new_menu_name" value="" class="regular-text" />
                            </td>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button-primary" value="Duplicate Menu" />
                    </p>
                </form>
            <?php endif; ?>
        </div>
    <?php }
}
   endif;
}
add_action( 'after_setup_theme', 'qt_menudup' );

// ==============================================
/* Password Protect Site */
// ==============================================
function qt_sitepass() {
   global $theme_display_options;
   if ( $theme_display_options['qtpassprotect'] == "protect" ) :
function protect_whole_site() {
    if ( !is_user_logged_in() ) {
        auth_redirect();
    }
}
add_action ('template_redirect', 'protect_whole_site');
   endif;
}
add_action( 'after_setup_theme', 'qt_sitepass' );

// ==============================================
/* Maintenance - Front Page Visible Only */
// ==============================================
function qt_passfront() {
   global $theme_display_options;
   if ( $theme_display_options['qtpassprotect']== "maintain" ) :
function protect_whole_site() {
    if ( !is_user_logged_in() && !is_front_page() ) {
        auth_redirect();
    }
}
add_action ('template_redirect', 'protect_whole_site');
   endif;
}
add_action( 'after_setup_theme', 'qt_passfront' );

// ==============================================
/* Sticky Menu */
// ==============================================
function qt_stickymenu() {                                
   global $theme_display_options;                        
   if ( $theme_display_options['qtsticky'] ) :
   
function qtmystickymenu2(){
	 wp_enqueue_script( "mystickymenu", get_template_directory_uri() . "/includes/mystickymenu.min.js" , array("jquery"), "1.0.0.0", true );
}
add_action("wp_enqueue_scripts","qtmystickymenu2");

class MyStickyMenuPage
{

    private $options;

	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'mysticky_load_transl') );
		add_action( 'admin_init', array( $this, 'page_init' ) );
		add_action( 'admin_init', array( $this, 'mysticky_default_options' ) );
	}
		
	public function mysticky_load_transl()
	{
		load_plugin_textdomain('mystickymenu', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
	}
	
	public function add_plugin_page()
	{
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin', 
			'Sticky', 
			'manage_options', 
			'my-stickymenu-settings', 
			array( $this, 'create_admin_page' )
		);
	}

	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'mysticky_option_name');
		?>
		<div class="wrap">
			<h2><?php _e('Sticky Settings', 'mystickymenu'); ?></h2>       
			<form method="post" action="options.php">
			<?php
				settings_fields( 'mysticky_option_group' );   
				do_settings_sections( 'my-stickymenu-settings' );
				submit_button(); 
			?>
			</form>
			</div>
		<?php
	}
	
	public function page_init()
	{   
		global $id, $title, $callback, $page;     
		register_setting(
			'mysticky_option_group',
			'mysticky_option_name',
			array( $this, 'sanitize' )
		);
		
		add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() );

		add_settings_section(
			'setting_section_id',
			__("Options", 'mystickymenu'),
			array( $this, 'print_section_info' ),
			'my-stickymenu-settings'
		);
		add_settings_field(
			'mysticky_class_selector',
			__("Sticky Class", 'mystickymenu'),
			array( $this, 'mysticky_class_selector_callback' ),
			'my-stickymenu-settings',
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_zindex', 
			__("Sticky z-index", 'mystickymenu'),
			array( $this, 'myfixed_zindex_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_bgcolor', 
			__("Sticky Background Color", 'mystickymenu'),
			array( $this, 'myfixed_bgcolor_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_opacity', 
			__("Sticky Opacity", 'mystickymenu'),
			array( $this, 'myfixed_opacity_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_transition_time', 
			__("Sticky Transition Time", 'mystickymenu'),
			array( $this, 'myfixed_transition_time_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_disable_small_screen', 
			__("Disable at Small Screen Sizes", 'mystickymenu'),
			array( $this, 'myfixed_disable_small_screen_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'mysticky_active_on_height', 
			__("Make visible on Scroll", 'mystickymenu'),
			array( $this, 'mysticky_active_on_height_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'mysticky_active_on_height_home', 
			__("Make visible on Scroll at homepage", 'mystickymenu'),
			array( $this, 'mysticky_active_on_height_home_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'myfixed_fade', 
			__("Fade or slide effect", 'mystickymenu'),
			array( $this, 'myfixed_fade_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);	
		add_settings_field(
			'myfixed_cssstyle', 
			__(".myfixed css class", 'mystickymenu'),
			array( $this, 'myfixed_cssstyle_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
		add_settings_field(
			'disable_css', 
			__("Disable CSS style", 'mystickymenu'),
			array( $this, 'disable_css_callback' ), 
			'my-stickymenu-settings', 
			'setting_section_id'
		);
	}
/**
* Sanitize each setting field as needed
*
* @param array $input Contains all settings fields as array keys
*/
	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['mysticky_class_selector'] ) )
			$new_input['mysticky_class_selector'] = sanitize_text_field( $input['mysticky_class_selector'] );

		if( isset( $input['myfixed_zindex'] ) )
			$new_input['myfixed_zindex'] = absint( $input['myfixed_zindex'] );

		if( isset( $input['myfixed_bgcolor'] ) )
			$new_input['myfixed_bgcolor'] = sanitize_text_field( $input['myfixed_bgcolor'] );

		if( isset( $input['myfixed_opacity'] ) )
			$new_input['myfixed_opacity'] = absint( $input['myfixed_opacity'] );

		if( isset( $input['myfixed_transition_time'] ) )
			$new_input['myfixed_transition_time'] = sanitize_text_field( $input['myfixed_transition_time'] );

		if( isset( $input['myfixed_disable_small_screen'] ) )
			$new_input['myfixed_disable_small_screen'] = absint( $input['myfixed_disable_small_screen'] );

		if( isset( $input['mysticky_active_on_height'] ) )
			$new_input['mysticky_active_on_height'] = absint( $input['mysticky_active_on_height'] );

		if( isset( $input['mysticky_active_on_height_home'] ) )
			$new_input['mysticky_active_on_height_home'] = absint( $input['mysticky_active_on_height_home'] );

		if( isset( $input['myfixed_fade'] ) )
			$new_input['myfixed_fade'] = sanitize_text_field( $input['myfixed_fade'] ); 
			
		if( isset( $input['myfixed_cssstyle'] ) )
			$new_input['myfixed_cssstyle'] = sanitize_text_field( $input['myfixed_cssstyle'] );
			
		if( isset( $input['disable_css'] ) )
			$new_input['disable_css'] = sanitize_text_field( $input['disable_css'] );	

		return $new_input;
	}

	public function mysticky_default_options() {

		global $options;
		$default = array(

				'mysticky_class_selector' => '.nav-inner',
				'myfixed_zindex' => '1000000',
				'myfixed_bgcolor' => '#000000',
				'myfixed_opacity' => '95',
				'myfixed_transition_time' => '1.0',
				'myfixed_disable_small_screen' => '500',
				'mysticky_active_on_height' => '320',
				'mysticky_active_on_height_home' => '320',
				'myfixed_fade' => false,
				'myfixed_cssstyle' => '.myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }'
			);

		if ( get_option('mysticky_option_name') == false ) {	
			update_option( 'mysticky_option_name', $default );		
		}
	}
	
	public function print_section_info()
	{
		echo __("Add nice modern sticky menu or header to any theme. Defaults works for Twenty Thirteen theme. <br />For other themes change 'Sticky Class' to div class desired to be sticky (div id can be used too).", 'mystickymenu');
    }

	public function mysticky_class_selector_callback()
	{
		printf(
			'<p class="description"><input type="text" size="8" id="mysticky_class_selector" name="mysticky_option_name[mysticky_class_selector]" value="%s" /> ',  
			isset( $this->options['mysticky_class_selector'] ) ? esc_attr( $this->options['mysticky_class_selector']) : '' 
		);
		 echo __("menu or header div class or id. For example, .nav, .nav-inner, or .header", 'mystickymenu');
		 echo '</p>';
	}

	public function myfixed_zindex_callback()
	{
		printf(
			'<p class="description"><input type="number" min="0" max="2147483647" step="1" id="myfixed_zindex" name="mysticky_option_name[myfixed_zindex]" value="%s" /></p>',
			isset( $this->options['myfixed_zindex'] ) ? esc_attr( $this->options['myfixed_zindex']) : ''
		);
	}

	public function myfixed_bgcolor_callback()
	{
		printf(
			'<p class="description"><input type="text" id="myfixed_bgcolor" name="mysticky_option_name[myfixed_bgcolor]" class="my-color-field" value="%s" /></p> ' ,
			isset( $this->options['myfixed_bgcolor'] ) ? esc_attr( $this->options['myfixed_bgcolor']) : ''
		);
	}

	public function myfixed_opacity_callback()
	{
		printf(
			'<p class="description"><input type="number" class="small-text" min="0" step="1" max="100" id="myfixed_opacity" name="mysticky_option_name[myfixed_opacity]"  value="%s" /> ',
			isset( $this->options['myfixed_opacity'] ) ? esc_attr( $this->options['myfixed_opacity']) : ''
		);
		echo __("numbers 1-100.", 'mystickymenu');
		echo '</p>';
	}

	public function myfixed_transition_time_callback()
	{
		printf(
			'<p class="description"><input type="number" class="small-text" min="0" step="0.1" id="myfixed_transition_time" name="mysticky_option_name[myfixed_transition_time]" value="%s" /> ',
			isset( $this->options['myfixed_transition_time'] ) ? esc_attr( $this->options['myfixed_transition_time']) : ''
		);
		echo __("in seconds.", 'mystickymenu');
		echo '</p>';
	}

	public function myfixed_disable_small_screen_callback()
	{
		printf(
		'<p class="description">'
		);
		echo __("less than", 'mystickymenu');
		printf(
		' <input type="number" class="small-text" min="0" step="1" id="myfixed_disable_small_screen" name="mysticky_option_name[myfixed_disable_small_screen]" value="%s" />',
			isset( $this->options['myfixed_disable_small_screen'] ) ? esc_attr( $this->options['myfixed_disable_small_screen']) : ''
		);
		echo __("px width, 0  to disable.", 'mystickymenu');
		echo '</p>';
	}

	public function mysticky_active_on_height_callback()
	{
		printf(
		'<p class="description">'
		);
		echo __("after", 'mystickymenu');
		printf(
		' <input type="number" class="small-text" min="0" step="1" id="mysticky_active_on_height" name="mysticky_option_name[mysticky_active_on_height]" value="%s" />',
			isset( $this->options['mysticky_active_on_height'] ) ? esc_attr( $this->options['mysticky_active_on_height']) : ''
		);
		echo __("px.", 'mystickymenu');
		echo '</p>';
	}

	public function mysticky_active_on_height_home_callback()
	{
		printf(
		'<p class="description">'
		);
		echo __("after", 'mystickymenu');
		printf(
		' <input type="number" class="small-text" min="0" step="1" id="mysticky_active_on_height_home" name="mysticky_option_name[mysticky_active_on_height_home]" value="%s" />',
			isset( $this->options['mysticky_active_on_height_home'] ) ? esc_attr( $this->options['mysticky_active_on_height_home']) : ''
		);
		echo __("px.", 'mystickymenu');
		echo '</p>';
	}

	public function myfixed_fade_callback()
	{
		printf(
			'<p class="description"><input id="%1$s" name="mysticky_option_name[myfixed_fade]" type="checkbox" %2$s /> ',
			'myfixed_fade',
			checked( isset( $this->options['myfixed_fade'] ), true, false ) 
		);
		echo __("Checked is slide, unchecked is fade.", 'mystickymenu');
		echo '</p>';	
	} 

	public function myfixed_cssstyle_callback()
	{
		printf(
		'<p class="description">'
		);
		echo __("Add/Edit .myfixed css class to change sticky menu style. Leave it blank for default style.", 'mystickymenu');
		echo '</p>';
		printf(
			'<textarea type="text" rows="4" cols="60" id="myfixed_cssstyle" name="mysticky_option_name[myfixed_cssstyle]">%s</textarea> <br />',
			isset( $this->options['myfixed_cssstyle'] ) ? esc_attr( $this->options['myfixed_cssstyle']) : ''
		);
		echo '<p class="description">';
		echo __("Default style: ", 'mystickymenu'); 
		echo '.myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }<br /><br />';
		echo'</p>';
	}
	
	public function disable_css_callback()
	{
		printf(
			'<p class="description"><input id="%1$s" name="mysticky_option_name[disable_css]" type="checkbox" %2$s /> ',
			'disable_css',
			checked( isset( $this->options['disable_css'] ), true, false ) 
		);
		echo __("Use this option if you plan to include CSS Style manually", 'mystickymenu');
		echo '</p>';	
	} 
	
}

	if( is_admin() )
	$my_settings_page = new MyStickyMenuPage();
	

	function mysticky_remove_more_jump_link($link) 
	{ 
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"',$offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}

	add_filter('the_content_more_link', 'mysticky_remove_more_jump_link');


	function mysticky_build_stylesheet_content() {

	$mysticky_options = get_option( 'mysticky_option_name' );
	
		if (isset($mysticky_options['disable_css'])){
				 //do nothing
			} else {
				$mysticky_options['disable_css'] = false;
		};
	
if  ($mysticky_options ['disable_css'] == false ){
	
    echo
'<style type="text/css">';
	if ( is_user_logged_in() ) {
		
    echo '#wpadminbar { position: absolute !important; top: 0px !important;}';
	}
	
	if (  $mysticky_options['myfixed_cssstyle'] == "" )  {
	echo '.myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }';
	}
	echo
		$mysticky_options ['myfixed_cssstyle'] ; 
	echo
	'
	#mysticky-nav { width:100%!important;  position: static;';
    
	if (isset($mysticky_options['myfixed_fade'])){
	
	echo
	'top: -100px;';
	}
	echo
	'}';
	
	if  ($mysticky_options ['myfixed_opacity'] == 100 ){

	echo
	'.wrapfixed { position: fixed!important; top:0px!important; left: 0px!important; margin-top:0px!important;  z-index: '. $mysticky_options ['myfixed_zindex'] .'; -webkit-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -moz-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -o-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;  background-color: ' . $mysticky_options ['myfixed_bgcolor'] . '!important;  }
	';
	}
	
	if  ($mysticky_options ['myfixed_opacity'] < 100 ){
   
	echo
	'.wrapfixed { position: fixed!important; top:0px!important; left: 0px!important; margin-top:0px!important;  z-index: '. $mysticky_options ['myfixed_zindex'] .'; -webkit-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -moz-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -o-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;   -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=' . $mysticky_options ['myfixed_opacity'] . ')"; filter: alpha(opacity=' . $mysticky_options ['myfixed_opacity'] . '); opacity:.' . $mysticky_options ['myfixed_opacity'] . '; background-color: ' . $mysticky_options ['myfixed_bgcolor'] . '!important;  }
	';
	}
	
	if  ($mysticky_options ['myfixed_disable_small_screen'] > 0 ){
		
    echo
		'@media (max-width: ' . $mysticky_options ['myfixed_disable_small_screen'] . 'px) {.wrapfixed {position: static!important; display: none!important;}}
	';
	}
	echo 
'</style>
	';
	}
}
	
	add_action('wp_head', 'mysticky_build_stylesheet_content');

	function mystickymenu_script() {
		
		$mysticky_options = get_option( 'mysticky_option_name' );
		
		// needed for update 1.7 => 1.8 ... will be removed in the future ()
		if (isset($mysticky_options['mysticky_active_on_height_home'])){
				 //do nothing
			} else {
				$mysticky_options['mysticky_active_on_height_home'] = $mysticky_options['mysticky_active_on_height'];
		};
		
		if  ($mysticky_options['mysticky_active_on_height_home'] == 0 ){
			$mysticky_options['mysticky_active_on_height_home'] = $mysticky_options['mysticky_active_on_height'];
		};
		
		if ( is_home() ) {
			$mysticky_options['mysticky_active_on_height'] = $mysticky_options['mysticky_active_on_height_home'];
		};
		
		$mysticky_translation_array = array( 
		    'mysticky_string' => $mysticky_options['mysticky_class_selector'] ,
			'mysticky_active_on_height_string' => $mysticky_options['mysticky_active_on_height'],
			'mysticky_disable_at_width_string' => $mysticky_options['myfixed_disable_small_screen']
		);
		
			wp_localize_script( 'mystickymenu', 'mysticky_name', $mysticky_translation_array );
	}

	add_action( 'wp_enqueue_scripts', 'mystickymenu_script' );

endif;	
}
add_action( 'after_setup_theme', 'qt_stickymenu' );

// ==============================================
/* Open RSS Feeds Widget in a new tab */
// ==============================================
add_action('wp_footer' , 'rss_widget_links_in_new_window');
function rss_widget_links_in_new_window() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            ! function ($) {
                //prevents js conflicts
                "use strict";
                var extLinksStyle = true; /* set this to false to not display the external icon */
                $('a' , '.widget.widget_rss').each( function() {
                    if ( extLinksStyle && $(this).children('img').length == 0 )
                        $(this).after('<span class="tc-external">');
                    $(this).attr('target' , '_blank');
                });
            }(window.jQuery)
        });
    </script>
    <?php
}

// ==============================================
/* Used Server Resources */
// ==============================================
function qt_resources() {
   global $theme_display_options;
   if ( $theme_display_options['serverstats'] ) :
   
define('USAGEQT_QUERIES', 'Queries:');
define('USAGEQT_TIME', 'Time:');
define('USAGEQT_MEMORY', 'Memory:');

define('USAGEQT_CSS', '<style scoped>
#UsageQT {
	position: relative;
	z-index: 0;
	height: 24px;
	line-height: 24px;
	background-color: #000;
	color: #fff;
	font-family: Arial,Helvetica,sans-serif;
	font-size: 13px;
	text-align: center;
}
</style>');

define ('USAGEQT_AJAX_USAGE', false);

class usageqt {
	var $starttime = 0;
	var $servertime = '';

	function __construct() {
		if (!empty($_SERVER['REQUEST_TIME_FLOAT'])) {
			$this->starttime = $_SERVER['REQUEST_TIME_FLOAT'];
		}

		add_filter('template_include', array($this, 'time_to_first_byte'));
		register_shutdown_function(array($this, 'display_usage'));
	}

	function time_to_first_byte($template) {
		if ($this->starttime) {
			$this->servertime = strval(round(microtime(true) - $this->starttime, 3)) . '&nbsp;|&nbsp;';
		}

		return $template;
	}

	function display_usage() {
		if (!defined('WP_INSTALLING') && (!defined('DOING_AJAX') || (defined('DOING_AJAX') && USAGEQT_AJAX_USAGE === true)) && current_user_can('update_core')) {
			global $wpdb;
			$memory_usage = round(memory_get_peak_usage() / 1000000, 2);
			$time_usage = (!$this->starttime)? '' : '<span style="margin-left:12px"></span>' . USAGEQT_TIME . '<strong>' . $this->servertime . round(microtime(true) - $this->starttime, 3) . '</strong>';
			echo USAGEQT_CSS . '<div id="UsageQT"><span>' . USAGEQT_QUERIES . '<strong>' . $wpdb->num_queries . '</strong>' . $time_usage . '<span style="margin-left:12px"></span>' . USAGEQT_MEMORY . '<strong>' . $memory_usage . ' MB</strong></span></div>';
		}
	}
}

new usageqt;

  endif;
}
add_action( 'after_setup_theme', 'qt_resources' );

// ==============================================
/* Delete Posts and Pages from the Admin Toolbar */
// ==============================================
function qt_deletefromtoolbar() {
   global $theme_display_options;
   if ( $theme_display_options['qttrash'] ) :
   
if ( ! defined( 'WPINC' ) ) {
  die;
}
function fb_add_admin_bar_trash_menu() {
  global $wp_admin_bar;
  if ( !is_super_admin() || !is_admin_bar_showing() )
      return;
  $current_object = get_queried_object();
  if ( empty($current_object) )
      return;
  if ( !empty( $current_object->post_type ) &&
     ( $post_type_object = get_post_type_object( $current_object->post_type ) ) &&
     current_user_can( $post_type_object->cap->edit_post, $current_object->ID )
  ) {
    $wp_admin_bar->add_menu(
        array( 'id' => 'delete',
            'title' => __('Move to Trash'),
            'href' => get_delete_post_link($current_object->term_id)
        )
    );
  }
}
add_action( 'admin_bar_menu', 'fb_add_admin_bar_trash_menu', 35 );

   endif;
}
add_action( 'after_setup_theme', 'qt_deletefromtoolbar' );

// ==============================================
/* Contact Form */
// ==============================================
function qt_contactform() {
   global $theme_display_options;
   if ( $theme_display_options['qtform'] ) :
   
add_shortcode('wptc-contact', 'qtf_render_contact_form');
function qtf_render_contact_form() {
    $to = get_option('admin_email');
    $spam_q = '3 + 4 =';
    $spam_a = '7';
    $subject = "Someone sent a message from ".get_bloginfo('name');
    $headers = 'From: '. $to . "\r\n" .'Reply-To: ' . $_POST['message_email'] . "\r\n";
    $html = '<div id="contact-response">';
    if (isset($_POST['submitted'])) {
        if($_POST['message_human'] != $spam_a) {
        $html .= '<div class="qtf-error">Human verification Failed.</div>';
        } elseif (!filter_var($_POST['message_email'], FILTER_VALIDATE_EMAIL)) {
            $html .= '<div class="qtf-error">Email Address Invalid.</div>';
        } elseif (empty($_POST['message_name']) || empty($_POST['message_text'])) {
            $html .= '<div class="qtf-error">Please supply all information.</div>';
        } elseif (!isset($_POST['basic_contact_form']) || !wp_verify_nonce( $_POST['basic_contact_form'],'basic_contact_form' )) {
            $html .= '<div class="qtf-error">Permissions Error.</div>';
        } else {
            $email_content = strip_tags("Name: ".$_POST['message_name']."\r\nEmail: ".$_POST['message_email']);
            $email_content .= "\r\nIP Address: ".$_SERVER['REMOTE_ADDR']."\r\n\r\nMessage:\r\n".$_POST['message_text'];
            $sent = wp_mail($to, $subject, $email_content, $headers);
            
            
                $html .= '<div class="qtf-success">Thanks! Your message has been sent.</div>'; //message sent!
           
                
            
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $html .= '<div class="qtf-error">Please supply all information.</div>';
    }
    $html .= '</div><form action="'. get_permalink(). '" method="post">';
    $html .= wp_nonce_field( 'basic_contact_form','basic_contact_form',true,false );
    $html .= '<p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" value="'. esc_attr($_POST['message_name']).'"></label></p>';
    $html .= '<p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="'. esc_attr($_POST['message_email']).'"></label></p>';
    $html .= '<p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text">'.esc_textarea($_POST['message_text']).'</textarea></label></p>';
    $html .= '<p><label for="message_human">Human Verification: <span>*</span> <br>'.$spam_q.' <input type="text" class="human-verify-input" name="message_human"></label>';
    $html .= '<br/><br/><input type="hidden" name="submitted" value="1"><input class="qtf-submit" type="submit"></p></form>';
    return $html;
}

   endif;
}
add_action( 'after_setup_theme', 'qt_contactform' );

// ==============================================
/* Allow Shortcodes in Manual Excerpts */
// ==============================================
add_filter('the_excerpt', 'shortcode_unautop');
add_filter('the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'shortcode_unautop');
add_filter('get_the_excerpt', 'do_shortcode');

// ==============================================
/* User Roles */
// ==============================================
function qt_userrole() {
   global $theme_display_options;
   if ( $theme_display_options['userrole'] ) :

class Ur_editroles 
{
	public static function init (){
		   	 // add cap to user permission
         	add_action( 'admin_init', array( __CLASS__, 'Ur_add_permission_caps'));
	          // add page user Roles
	         add_action('admin_menu', array( __CLASS__, 'Ur_UserRoles_menu'));
              // delete role
	         add_action( 'wp_ajax_Ur_delete_role', array( __CLASS__, 'Ur_delete_role'));
              // page user Roles js
	         add_action( 'admin_footer', array( __CLASS__, 'Ur_user_permission_js'));
	}

	public static function Ur_add_permission_caps() {
	    $role = get_role( 'administrator' );
	    $role->add_cap( 'edit_user_permission' ); 
	}

	public static function Ur_UserRoles_menu() {
		add_users_page( __('User Roles'), __('User Roles'), 'edit_user_permission', 'user_permission', array( __CLASS__, 'Ur_page_user_permission'));
	}
	public static function Ur_delete_role(){
			$role = sanitize_text_field($_REQUEST['delete']);
         if ( ! wp_verify_nonce( $_REQUEST['token'], $role ) ) {
               $result['type'] = "error";
               $result['role_count'] = __('Sorry, you are not allowed to delete this item.');         	
			}elseif (!current_user_can('edit_user_permission') ) {
				   $result['type'] = "error";
				   $result['role_count'] = __('Sorry, you are not allowed to delete this item.');
			}elseif ($role == 'administrator') {
				   $result['type'] = "error";
				   $result['role_count'] = __('Sorry, you are not allowed to delete this item.');
			}elseif(!get_role($role)){
				   $result['type'] = "error";
	            $result['role_count'] = sprintf( __( 'The role %s does not exist.'), $role );
          }elseif( get_role($role) ){
          	$args2 = array('role' => $role);
          	$authors = get_users($args2);
          	if($authors){
          		foreach ($authors as $user) {
          			wp_update_user( array('ID' => $user->ID,'role' => get_option('default_role')) );
          		}
          	}	
          	remove_role($role);
          	$result['type'] = "success";
          }
          if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
          	$result = json_encode($result);
          	echo $result;
          }
          else {
          	header("Location: ".$_SERVER["HTTP_REFERER"]);
          }
          die();
   }
   public static function Ur_user_permission_js() {
	   	global $current_screen;
	   	$current_scre = $current_screen->id ;
	   	if( 'users_page_user_permission' != $current_scre ) {
	   		return;
	   	}
	   	?>
	   	<script type="text/javascript">jQuery(document).ready(function(a){a(document).on("click",".delete_user_roless",function(){if(!confirm(commonL10n.warnDelete))return!1;var b=a(this),c=b.data("name"),d=b.data("token"),e=a("#"+c);return a.ajax({type:"post",url:"<?php echo admin_url( 'admin-ajax.php' );?>",dataType:"json",data:{action:"Ur_delete_role",token:d,delete:c},success:function(b){"success"==b.type?e.remove():a("#ajax-response").html('<div class="error notice"><p><strong>'+b.role_count+"</strong></p></div>")}}),!1}),a(".toggle-all-terms").on("change",function(){a("#rolechecklist").closest("ul").find(":checkbox").prop("checked",this.checked)})});</script>
	   	<?php 
	}
   public static function Ur_get_rolecaps( $role ) {
			$caps = array();
			$role_obj = get_role($role);
			if ( $role_obj && isset( $role_obj->capabilities ) )
				$caps = $role_obj->capabilities;
			return $caps;
	}
	public static function Ur_get_role( $name, $role, $default = false ) {
	    $options = Ur_editroles::Ur_get_rolecaps($role);
	    // Return specific option
	    if ( isset( $options[$name] ) ) {
	        return $options[$name];
	    }
	    return $default;
	}	
	public static function UR_add_role( $role, $name, $caps ) {
		global $wp_user_roles;
		$string = preg_replace('/\s+/', '', $role);
		$role_obj = get_role( $string );
		   if (!current_user_can('edit_user_permission') ) {
			    return false;
			}elseif ( ! $role_obj ) {
			$capabilities = array();
			foreach ( (array) $caps as $cap ) {
				$capabilities[ $cap ] = true;
			}
			$result= add_role( $string, $name, $capabilities );
			if ( null !== $result ) {
				return true;
			}
			else {
				return false;
			}				
			if ( ! isset( $wp_user_roles[ $string ] ) ) {
				$wp_user_roles[ $string ] = array(
					'name' => $name,
					'capabilities' => $capabilities,
					);
			}
			eg_refresh_current_user_caps( $string );
		} else {
			return false;
		}
	}
	public static function UR_merge_rolecaps( $role, $caps ) {
			global $wp_user_roles , $wp_roles;
			$role_obj = get_role( $role );
		   if (!current_user_can('edit_user_permission') || $role == 'administrator' ) {
			    return false;
			}elseif ( ! $role_obj )
				return false;
			 $capabilities = array();
				foreach ( (array) $caps as $cap ) {
					$capabilities[ $cap ] = true;
				}
			$current_caps = Ur_editroles::Ur_get_rolecaps('administrator');
			foreach ( $current_caps as $capremove => $value ) {
			  if(isset( $capabilities[$capremove]) ){
				 $role_obj->add_cap($capremove);
				}else{
            $role_obj->remove_cap($capremove);
				}
         }
			if ( isset( $wp_user_roles[ $role ] ) ) {
			$wp_user_roles[ $role ] = array(
						'capabilities' => $caps
						);
			}
			Ur_editroles::UR_refresh_usercaps( $role );
	}
	public static function UR_refresh_usercaps( $role ) {
			if ( is_user_logged_in() && current_user_can( $role ) ) {
				wp_get_current_user()->get_role_caps();
			}
	}
	public static function UR_roles_static(){
		global $wp_roles; $result = count_users();
		foreach($result['avail_roles'] as $role => $count){   	
			if ($role == 'none') {
				$roell = __('No role');
			} else {
				$roell = _x($wp_roles->roles[ $role ]['name'],'User role');
			}
			echo '<tr><td><span class="dashicons dashicons-admin-users"></span> '.$roell.'</td><td>'.$count.'</td></tr>';
		}
	}
   public static function Ur_list_cps (){
	   global $wp_roles;
	    if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();
		$roles = $wp_roles->get_names();
		foreach ($roles as $role_value => $role_name) { ?>
	      <tr id="<?php echo $role_value; ?>" class="iedit <?php echo $role_value; ?> ">
	        <td class="title column-title" data-colname="Title">
	          <a href="users.php?page=user_permission&edit&user_role=<?php echo $role_value; ?>"><strong><?php echo _x($role_name,'User role'); ?></strong></a>
	        </td>
	        <td class="slug column-slug" data-colname="Slug">
	          <?php echo $role_value; ?>
	        </td>
	        <td class="column-role" data-colname="<?php echo $role_value; ?>">
	          <a href="users.php?page=user_permission&edit&user_role=<?php echo $role_value; ?>" title="<?php _e('Edit'); ?>"><span class="dashicons dashicons-admin-generic"></span></a> |
	          <a class="delete_user_roless" href="<?php echo admin_url('admin-ajax.php?action=Ur_delete_role&delete='.$role_value.'&token='.wp_create_nonce($role_value)); ?>" data-name="<?php echo $role_value; ?>" data-token="<?php echo wp_create_nonce($role_value); ?>" title="<?php _e('Delete'); ?>" ><span class="dashicons dashicons-trash"></span></a>
	        </td>
	      </tr>
<?php  
   } }


   public static function Ur_page_user_permission() { 
			if ( ! current_user_can('edit_user_permission') ) {
				wp_die(
					'<h1>' . __( 'Cheatin&#8217; uh?' ) . '</h1>' .
					'<p>' . __( 'Sorry, you are not allowed to manage terms in this taxonomy.' ) . '</p>',
					403
				);
			}	
			if(isset($_POST['addroless'])){
				$roless_id = sanitize_text_field( $_POST['roless_id']);
				$roless_name = sanitize_text_field( $_POST['roless_id']);
				$permission = isset( $_POST['permission'] ) ? (array) $_POST['permission'] : array();
				$permission = array_map( 'esc_attr', $permission );
				if ( ! wp_verify_nonce( $_POST['authenticity_token'], 'add_user_roless' ) ) {
					$eg_error = __('Sorry, you are not allowed to delete this item.');
				}elseif (!current_user_can('edit_user_permission') ) {
					$eg_error =  __('Sorry, you are not allowed to delete this item.');
				}elseif (empty($roless_name)) {
					$eg_error = __('Item not added.');
				}elseif (empty($roless_id)) {
					$eg_error = __('Invalid term ID.');
				}elseif (empty($permission)) {
					$eg_error = __('Item not added.');
				}else{
					$UR_add_roles = Ur_editroles::UR_add_role($roless_id, $roless_name, $permission );
					if($UR_add_roles === false) {
						$eg_error = __('Item not added.');
					}else {
						$eg_success = __('Item added.');
					}
				}
			}	
			if(isset($_POST['editrole'])){
				$idrole = sanitize_text_field( $_POST['idrole']);
				$permission = isset( $_POST['permission'] ) ? (array) $_POST['permission'] : array();
				$permission = array_map( 'esc_attr', $permission );
				if ( ! wp_verify_nonce( $_POST['authenticity_token'], 'editrole-'.$idrole ) ) {
		        $eg_error = __('Sorry, you are not allowed to delete this item.');
				}elseif (!current_user_can('edit_user_permission') ) {
				   $eg_error =  __('Sorry, you are not allowed to delete this item.');
				}elseif (empty($idrole)) {
					$eg_error = __('Item not updated.');
				}elseif (empty($permission)) {
					$eg_error = __('Item not updated.');
				}else{
		        $UR_merge_role = Ur_editroles::UR_merge_rolecaps($idrole, $permission );
				  if($UR_merge_role === false) {
				     $eg_error = __('Item not updated.');
				   }else {
				      $eg_success = __('Item updated.');
				   }
				}
			} 
			   ?>
		<div class="wrap nosubsub">
   	<h1 class="wp-heading-inline">
   		<?php if(isset($_GET['edit'])) {
   			   echo _ex('Edit', 'menu').' ' .__('Role');
   				}else{
   					echo __('User Roles');
   		} ?>
   	</h1>	
      <?php if (!empty($eg_error)) { ?>
   	<div id="message" class="error notice is-dismissible">
		<p><strong><?php echo $eg_error; ?></strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Dismiss this notice.'); ?></span></button>
		</div>
		<?php } ?>
      <?php if (!empty($eg_success)) { ?>
   	<div id="message" class="updated notice is-dismissible">
		<p><strong><?php echo $eg_success; ?></strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Dismiss this notice.'); ?></span></button>
		</div>
		<?php } ?>		
		<div id="ajax-response"></div>   	
   	<div class="tablenav top">
   		<div id="col-container" class="wp-clearfix">
   			<?php if(isset($_GET['edit'])) {
   				      // page edit role
   				   Ur_editroles::UR_user_page_edit();
   				}else{
   					  // page default roles
   					Ur_editroles::UR_user_page_default();
   				} ?>
   		</div> 
   	</div>
   </div>
<?php
}
public static function UR_user_page_default(){
?>	   
<div id="col-left">
  <div class="col-wrap">
    <div class="form-wrap">
      <h2><?php _ex('Add New', 'plugin'); ?></h2>
      <form method="post">
        <input type="hidden" name="authenticity_token" id="authenticity_token" value="<?php echo wp_create_nonce('add_user_roless'); ?>" />
        <div class="form-field form-required term-name-wrap">
          <label for="roless_name"><?php _e( 'Name'); ?></label>
          <input name="roless_name" id="roless_name" size="40" aria-required="true" type="text">
          <p class="description"><?php _e('The name is how it appears on your site.'); ?></p></td>
        </div>
        <div class="form-field form-required term-name-wrap">
          <label for="roless_id"><?php _e('Role'); ?> <small>(ID)</small></label>
          <input name="roless_id" id="roless_id" size="40" aria-required="true" type="text">
          <p><?php _e('Language') ?> <?php _e('English') ?></p>
        </div>
				<div id="Capabilities" class="taxonomydiv">
					<ul  class="taxonomy-tabs">
						<li class="tabs"><?php _e('Capabilities'); ?></li>
					</ul>
					<div class="tabs-panel">
						<ul id="rolechecklist" class="form-no-clear">
							<?php  $caps = Ur_editroles::Ur_get_rolecaps('administrator');
							foreach ( $caps as $key=>$value ): ?>
							<li>
								<label>
									<input  name="permission[]" value="<?php echo $key; ?>" type="checkbox"><?php echo $key; ?>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</div><!-- /.tabs-panel -->
				<p class="button-controls wp-clearfix">
				<span class="list-controls">
			    <label class="select-all"><input type="checkbox" class="toggle-all-terms"/><?php _e('Select All'); ?></label>
			    </span>
				</p>
			</div>
        <p class="submit">
        <input name="addroless" id="addroless" class="button button-primary" value="<?php _ex('Add New', 'plugin'); ?>" type="submit"></p>
        <p><?php _e( '<a href="https://codex.wordpress.org/Roles_and_Capabilities" target="_blank">Descriptions of Roles and Capabilities</a>' ); ?></p>
      </form>
    </div>
  </div>
</div>
<div id="col-right">
  <div class="col-wrap">
    <div class="tablenav top">
    </div>
      <table class="wp-list-table widefat fixed striped posts">
        <thead>
          <tr>
            <th scope="col" id="title" class="name column-name has-row-actions column-primary">
              <span><?php _e('Name'); ?></span><br></th>
            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
              <span><?php _e('Role'); ?> <small>(ID)</small></span>
            </th>
            <th scope="col" id="Action" class="manage-column column-role"><?php _e('Actions'); ?></th>
          </tr>
        </thead>
        <tbody id="the-list">
         <?php Ur_editroles::Ur_list_cps(); ?>
        </tbody>
        <tfoot>
          <tr>
            <th scope="col" id="title" class="name column-name has-row-actions column-primary">
              <span><?php _e('Name'); ?></span><br></th>
            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
              <span><?php _e('Role'); ?> <small>(ID)</small></span>
            </th>
            <th scope="col" id="Action" class="manage-column column-role"><?php _e('Actions'); ?></th>
          </tr>
        </tfoot>
      </table>
		<table class="wp-list-table widefat fixed striped">
		  <h2><span><?php _e('At a Glance'); ?></span></h2>
		  <thead>
		    <tr>
		      <th class="name column-name has-row-actions column-primary">
		        <?php _e('Name'); ?>
		      </th>
		      <th class="manage-column column-categories">
		        <?php _ex('Count','Number/count of items'); ?>
		      </th>
		    </tr>
		  </thead>
		  <tfoot>
		    <tr>
		      <th class="name column-name has-row-actions column-primary">
		        <?php _e('Name'); ?>
		      </th>
		      <th class="manage-column column-categories">
		        <?php _ex('Count','Number/count of items'); ?>
		      </th>
		    </tr>
		  </tfoot>
		  <tbody>
		    <tr>
		      <?php Ur_editroles::UR_roles_static();?>
		      <td></td>
		      <td></td>
		    </tr>
		  </tbody>
		  </table>
  </div>
</div>
<?php
}
public static function UR_user_page_edit(){
	global $wp_roles;
	$role = $_GET['user_role'];
	?>
<form name="editrole" id="editrole" method="post" class="validate">
   <input type="hidden" name="authenticity_token" id="authenticity_token" value="<?php echo wp_create_nonce('editrole-'.$role); ?>" />
   <input type="hidden" name="idrole" id="idrole" value="<?php echo $role; ?>" />
	<table class="form-table">
		<tbody><tr class="form-field form-required role-name-wrap">
			<th scope="row"><label for="name"><?php _e('Name'); ?></label></th>
			<td><input id="name" value="<?php echo _x($wp_roles->roles[ $role ]['name'],'User role'); ?>" size="40" aria-required="true" type="text"  disabled>
			<p class="description"><?php _e('The name is how it appears on your site.'); ?></p></td>
		</tr>
		<tr class="form-field role-Capabilities-wrap">
			<th scope="row"><label><?php _e('Capabilities'); ?></label></th>
			<td>
				<div id="Capabilities" class="taxonomydiv">
					<ul  class="taxonomy-tabs">
						<li class="tabs"><?php _e('Please select an option.'); ?></li>
					</ul>
					<div class="tabs-panel">
						<ul id="rolechecklist" class="form-no-clear">
							<?php  $caps = Ur_editroles::Ur_get_rolecaps('administrator');
							foreach ( $caps as $key=>$value ): ?>
							<li>
								<label>
									<input  name="permission[]" value="<?php echo $key; ?>" <?php if(Ur_editroles::Ur_get_role($key,$role) == 1){ echo'checked="checked"';} ?> type="checkbox"> <?php echo $key; ?>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</div><!-- /.tabs-panel -->
				<p class="button-controls wp-clearfix">
				<span class="list-controls">
			    <label class="select-all"><input type="checkbox" class="toggle-all-terms"/><?php _e('Select All'); ?></label>
			    </span>
				</p>
			</div>
			</td>
		</tr>
			</tbody></table>
   <p class="submit">
   <input name="editrole" id="editrole" class="button button-primary" value="<?php _e('Update'); ?>" type="submit"></p>
   </form>

<?php
}
}
// initialize Ur_editroles
Ur_editroles::init();

   endif;
}
add_action( 'after_setup_theme', 'qt_userrole' );

// ==============================================
/* Paypal Buttons */
// ==============================================
function qt_paypal() {
   global $theme_display_options;
   if ( $theme_display_options['qtpaypal'] ) :

global $pagenow, $typenow;


// plugin functions

register_activation_hook( __FILE__, "wpecpp_activate" );
register_deactivation_hook( __FILE__, "wpecpp_deactivate" );
register_uninstall_hook( __FILE__, "wpecpp_uninstall" );

function wpecpp_activate() {

	$wpecpp_settingsoptions = array(
	'currency'    		=> '25',
	'language'    		=> '3',
	'liveaccount'    	=> '',
	'sandboxaccount'    => '',
	'mode'    			=> '2',
	'size'    			=> '2',
	'opens'    			=> '2',
	'cancel'    		=> '',
	'return'    		=> '',
	'note'    			=> '1',
	'tax_rate'    		=> '',
	'tax'    			=> '',
	'weight_unit'    	=> '1',
	'cbt'    			=> '',
	'upload_image'    	=> '',
	'showprice'    		=> '2',
	'showname'    		=> '2',
	'paymentaction' 	=> '1'
	);

	add_option("wpecpp_settingsoptions", $wpecpp_settingsoptions);

}


function wpecpp_deactivate() {
	delete_option("wpecpp_my_plugin_notice_shown");
}

function wpecpp_uninstall() {
}



// display activation notice

add_action('admin_notices', 'wpecpp_my_plugin_admin_notices');

function wpecpp_my_plugin_admin_notices() {
	if (!get_option('wpecpp_my_plugin_notice_shown')) {
		echo "<div class='updated'><p><a href='admin.php?page=wp-ecommerce-settings'>Click here to view the plugin settings</a>.</p></div>";
		update_option("wpecpp_my_plugin_notice_shown", "true");
	}
}






// settings page menu link
add_action( "admin_menu", "wpecpp_plugin_menu" );

function wpecpp_plugin_menu() {
	add_options_page( "PayPal Button", "PayPal Button", "manage_options", "wp-ecommerce-settings", "wpecpp_plugin_options" );
}
add_filter('plugin_action_links', 'wpecpp_myplugin_plugin_action_links', 10, 2);

function wpecpp_myplugin_plugin_action_links($links, $file) {
	static $this_plugin;
	
	if (!$this_plugin) {
		$this_plugin = plugin_basename(__FILE__);
	}
	
	if ($file == $this_plugin) {
		$settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wp-ecommerce-settings">Settings</a>';
		array_unshift($links, $settings_link);
	}
	
	return $links;
}

function wpecpp_plugin_settings_link($links) {
	unset($links['edit']);

	$forum_link   = '<a target="_blank" href="https://wordpress.org/support/plugin/wp-ecommerce-paypal">' . __('Support', 'PTP_LOC') . '</a>';
	$premium_link = '<a target="_blank" href="https://wpplugin.org/downloads/easy-paypal-buy-now-button/">' . __('Purchase Premium', 'PTP_LOC') . '</a>';
	array_push($links, $forum_link);
	array_push($links, $premium_link);
	return $links;
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'wpecpp_plugin_settings_link' );



function wpecpp_plugin_options() {
	
	if ( !current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
	}

	// settings page




	echo "<table width='100%'><tr><td width='70%'><br />";
	echo "<label style='color: #000;font-size:18pt;'><center>PayPal Buy Now Button Settings</center></label>";
	echo "<form method='post' action='".$_SERVER["REQUEST_URI"]."'>";


	// save and update options
	if (isset($_POST['update'])) {

		$options['currency'] = 			$_POST['currency'];
		$options['language'] = 			$_POST['language'];
		$options['liveaccount'] = 		$_POST['liveaccount'];
		$options['sandboxaccount'] = 	$_POST['sandboxaccount'];
		$options['mode'] = 				$_POST['mode'];
		$options['size'] = 				$_POST['size'];
		$options['opens'] = 			$_POST['opens'];
		$options['cancel'] = 			$_POST['cancel'];
		$options['return'] = 			$_POST['return'];
		$options['paymentaction'] = 	$_POST['paymentaction'];

		update_option("wpecpp_settingsoptions", $options);

		echo "<br /><div class='updated'><p><strong>"; _e("Settings Updated."); echo "</strong></p></div>";

	}


	// get options
	$options = get_option('wpecpp_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = $v; }


	echo "</td><td></td></tr><tr><td>";





	// form
	echo "<br />";
	?>

	<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
	&nbsp; Usage
	</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

	You can activate and deactivate the Paypal Button functionality from the customizer. You can create the buttons from the Theme Shortcodes Buttons in the editor.
	<br /><br />

	You can put the Buy Now buttons as many times in a page or post as you want, there is no limit. If you want to remove a Buy Now button, just remove the shortcode text in your page or post.


	<br /><br />
	</div><br /><br />

	<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
	&nbsp; Language & Currency
	</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

	<b>Language:</b>
	<select name="language">
	<option <?php if ($value['language'] == "1") { echo "SELECTED"; } ?> value="1">Danish</option>
	<option <?php if ($value['language'] == "2") { echo "SELECTED"; } ?> value="2">Dutch</option>
	<option <?php if ($value['language'] == "3") { echo "SELECTED"; } ?> value="3">English</option>
	<option <?php if ($value['language'] == "20") { echo "SELECTED"; } ?> value="20">English - UK</option>
	<option <?php if ($value['language'] == "4") { echo "SELECTED"; } ?> value="4">French</option>
	<option <?php if ($value['language'] == "5") { echo "SELECTED"; } ?> value="5">German</option>
	<option <?php if ($value['language'] == "6") { echo "SELECTED"; } ?> value="6">Hebrew</option>
	<option <?php if ($value['language'] == "7") { echo "SELECTED"; } ?> value="7">Italian</option>
	<option <?php if ($value['language'] == "8") { echo "SELECTED"; } ?> value="8">Japanese</option>
	<option <?php if ($value['language'] == "9") { echo "SELECTED"; } ?> value="9">Norwgian</option>
	<option <?php if ($value['language'] == "10") { echo "SELECTED"; } ?> value="10">Polish</option>
	<option <?php if ($value['language'] == "11") { echo "SELECTED"; } ?> value="11">Portuguese</option>
	<option <?php if ($value['language'] == "12") { echo "SELECTED"; } ?> value="12">Russian</option>
	<option <?php if ($value['language'] == "13") { echo "SELECTED"; } ?> value="13">Spanish</option>
	<option <?php if ($value['language'] == "14") { echo "SELECTED"; } ?> value="14">Swedish</option>
	<option <?php if ($value['language'] == "15") { echo "SELECTED"; } ?> value="15">Simplified Chinese -China only</option>
	<option <?php if ($value['language'] == "16") { echo "SELECTED"; } ?> value="16">Traditional Chinese - Hong Kong only</option>
	<option <?php if ($value['language'] == "17") { echo "SELECTED"; } ?> value="17">Traditional Chinese - Taiwan only</option>
	<option <?php if ($value['language'] == "18") { echo "SELECTED"; } ?> value="18">Turkish</option>
	<option <?php if ($value['language'] == "19") { echo "SELECTED"; } ?> value="19">Thai</option>
	</select>

	PayPal currently supports 18 languages.
	<br /><br />

	<b>Currency:</b> 
	<select name="currency">
	<option <?php if ($value['currency'] == "1") { echo "SELECTED"; } ?> value="1">Australian Dollar - AUD</option>
	<option <?php if ($value['currency'] == "2") { echo "SELECTED"; } ?> value="2">Brazilian Real - BRL</option> 
	<option <?php if ($value['currency'] == "3") { echo "SELECTED"; } ?> value="3">Canadian Dollar - CAD</option>
	<option <?php if ($value['currency'] == "4") { echo "SELECTED"; } ?> value="4">Czech Koruna - CZK</option>
	<option <?php if ($value['currency'] == "5") { echo "SELECTED"; } ?> value="5">Danish Krone - DKK</option>
	<option <?php if ($value['currency'] == "6") { echo "SELECTED"; } ?> value="6">Euro - EUR</option>
	<option <?php if ($value['currency'] == "7") { echo "SELECTED"; } ?> value="7">Hong Kong Dollar - HKD</option> 	 
	<option <?php if ($value['currency'] == "8") { echo "SELECTED"; } ?> value="8">Hungarian Forint - HUF</option>
	<option <?php if ($value['currency'] == "9") { echo "SELECTED"; } ?> value="9">Israeli New Sheqel - ILS</option>
	<option <?php if ($value['currency'] == "10") { echo "SELECTED"; } ?> value="10">Japanese Yen - JPY</option>
	<option <?php if ($value['currency'] == "11") { echo "SELECTED"; } ?> value="11">Malaysian Ringgit - MYR</option>
	<option <?php if ($value['currency'] == "12") { echo "SELECTED"; } ?> value="12">Mexican Peso - MXN</option>
	<option <?php if ($value['currency'] == "13") { echo "SELECTED"; } ?> value="13">Norwegian Krone - NOK</option>
	<option <?php if ($value['currency'] == "14") { echo "SELECTED"; } ?> value="14">New Zealand Dollar - NZD</option>
	<option <?php if ($value['currency'] == "15") { echo "SELECTED"; } ?> value="15">Philippine Peso - PHP</option>
	<option <?php if ($value['currency'] == "16") { echo "SELECTED"; } ?> value="16">Polish Zloty - PLN</option>
	<option <?php if ($value['currency'] == "17") { echo "SELECTED"; } ?> value="17">Pound Sterling - GBP</option>
	<option <?php if ($value['currency'] == "18") { echo "SELECTED"; } ?> value="18">Russian Ruble - RUB</option>
	<option <?php if ($value['currency'] == "19") { echo "SELECTED"; } ?> value="19">Singapore Dollar - SGD</option>
	<option <?php if ($value['currency'] == "20") { echo "SELECTED"; } ?> value="20">Swedish Krona - SEK</option>
	<option <?php if ($value['currency'] == "21") { echo "SELECTED"; } ?> value="21">Swiss Franc - CHF</option>
	<option <?php if ($value['currency'] == "22") { echo "SELECTED"; } ?> value="22">Taiwan New Dollar - TWD</option>
	<option <?php if ($value['currency'] == "23") { echo "SELECTED"; } ?> value="23">Thai Baht - THB</option>
	<option <?php if ($value['currency'] == "24") { echo "SELECTED"; } ?> value="24">Turkish Lira - TRY</option>
	<option <?php if ($value['currency'] == "25") { echo "SELECTED"; } ?> value="25">U.S. Dollar - USD</option>
	</select>
	PayPal currently supports 25 currencies.
	<br /><br /></div>

	<?php


	?>
	<br /><br /><div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
	&nbsp; PayPal Account </div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

	<?php

	echo "<b>Live Account: </b><input type='text' name='liveaccount' value='".$value['liveaccount']."'> Required";
	echo "<br />Enter a valid Merchant account ID (strongly recommend) or PayPal account email address. All payments will go to this account.";
	echo "<br /><br />You can find your Merchant account ID in your PayPal account under Profile -> My business info -> Merchant account ID";

	echo "<br /><br />If you don't have a PayPal account, you can sign up for free at <a target='_blank' href='https://paypal.com'>PayPal</a>. <br /><br />";


	echo "<b>Sandbox Account: </b><input type='text' name='sandboxaccount' value='".$value['sandboxaccount']."'> Optional";
	echo "<br />Enter a valid sandbox PayPal account email address. A Sandbox account is a PayPal accont with fake money used for testing. This is useful to make sure your PayPal account and settings are working properly being going live.";
	echo "<br /><br />To create a Sandbox account, you first need a Developer Account. You can sign up for free at the <a target='_blank' href='https://www.paypal.com/webapps/merchantboarding/webflow/unifiedflow?execution=e1s2'>PayPal Developer</a> site. <br /><br />";

	echo "Once you have made an account, create a Sandbox Business and Personal Account <a target='_blank' href='https://developer.paypal.com/webapps/developer/applications/accounts'>here</a>. Enter the Business acount email on this page and use the Personal account username and password to buy something on your site as a customer. <br /><br /><br />";

	echo "<b>Sandbox Mode:</b>";
	echo "&nbsp; &nbsp; <input "; if ($value['mode'] == "1") { echo "checked='checked'"; } echo " type='radio' name='mode' value='1'>On (Sandbox mode)";
	echo "&nbsp; &nbsp; <input "; if ($value['mode'] == "2") { echo "checked='checked'"; } echo " type='radio' name='mode' value='2'>Off (Live mode)";

	echo "<br /><br /><b>Payment Action:</b>";
	echo "&nbsp; &nbsp; <input "; if ($value['paymentaction'] == "1") { echo "checked='checked'"; } echo " type='radio' name='paymentaction' value='1'>Sale (Default)";
	echo "&nbsp; &nbsp; <input "; if ($value['paymentaction'] == "2") { echo "checked='checked'"; } echo " type='radio' name='paymentaction' value='2'>Authorize (Learn more <a target='_blank' href='https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/authcapture/'>here</a>)";

	echo "<br /><br /></div>";



	?>

	<br /><br />
	<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
	&nbsp; Other Settings
	</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

	<?php
	echo "<table><tr><td valign='top'>";




	echo "<b>Button Size and type:</b></td><td valign='top' style='text-align: center;'>";
	echo "<input "; if ($value['size'] == "1") { echo "checked='checked'"; } echo " type='radio' name='size' value='1'>Small <br /><img src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif'></td><td valign='top' style='text-align: center;'>";
	echo "<input "; if ($value['size'] == "2") { echo "checked='checked'"; } echo " type='radio' name='size' value='2'>Big <br /><img src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif'></td><td valign='top' style='text-align: center;'>";
	echo "<input "; if ($value['size'] == "3") { echo "checked='checked'"; } echo " type='radio' name='size' value='3'>Big with credit cards <br /><img src='https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif'></td><td valign='top' style='text-align: center;'>";
	echo "<input "; if ($value['size'] == "5") { echo "checked='checked'"; } echo " type='radio' name='size' value='5'>Gold (English Only) <br /><img src='https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png'></td><td valign='top' style='text-align: center;'>";




	echo "</td></tr><tr><td><b>PayPal opens in:</b></td>";
	echo "<td><input "; if ($value['opens'] == "1") { echo "checked='checked'"; } echo " type='radio' name='opens' value='1'>Same window</td>";
	echo "<td><input "; if ($value['opens'] == "2") { echo "checked='checked'"; } echo " type='radio' name='opens' value='2'>New window</td></tr>";



	echo "</table><br /><br />";



	$siteurl = get_site_url();

	echo "<b>Cancel URL: </b>";
	echo "<input type='text' name='cancel' value='".$value['cancel']."'> Optional <br />";
	echo "If the customer goes to PayPal and clicks the cancel button, where do they go. Example: $siteurl/cancel. Max length: 1,024. <br /><br />";

	echo "<b>Return URL: </b>";
	echo "<input type='text' name='return' value='".$value['return']."'> Optional <br />";
	echo "If the customer goes to PayPal and successfully pays, where are they redirected to after. Example: $siteurl/thankyou. Max length: 1,024. <br /><br />";

	echo "Note: The Cancel and Return pages are not automatically created; /cancel and /thankyou are just possible example page names.";


	?>
	<br /><br /></div>

	<input type='hidden' name='update'><br />
	<input type='submit' name='btn2' class='button-primary' style='font-size: 17px;line-height: 28px;height: 32px;' value='Save Settings'>

	<br /><br /><br />


	This Paypal Button feature is a fork of the WPPlugin plugin, which is an offical PayPal Partner. Various trademarks held by their respective owners.


	</form>


	</td><td width='5%'>
	</td><td width='24%' valign='top'>

	<br />

		</td><td width='1%'>

	</td></tr></table>


	<?php

	// end settings page and required permissions
}

// shortcode

add_shortcode('wptc-paypal', 'wpecpp_options');

function wpecpp_options($atts) {

	// get shortcode user fields
	$atts = shortcode_atts(array('name' => 'Example Name','price' => '0.00','size' => '','align' => ''), $atts);

	// get settings page values
	$options = get_option('wpecpp_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = $v; }


	// live of test mode
	if ($value['mode'] == "1") {
		$account = $value['sandboxaccount'];
		$path = "sandbox.paypal";
	} elseif ($value['mode'] == "2")  {
		$account = $value['liveaccount'];
		$path = "paypal";
	}

	// payment action
	if ($value['paymentaction'] == "1") {
		$paymentaction = "sale";
	} elseif ($value['paymentaction'] == "2")  {
		$paymentaction = "authorization";
	} else {
		$paymentaction = "sale";
	}

	// currency
	if ($value['currency'] == "1") { $currency = "AUD"; }
	if ($value['currency'] == "2") { $currency = "BRL"; }
	if ($value['currency'] == "3") { $currency = "CAD"; }
	if ($value['currency'] == "4") { $currency = "CZK"; }
	if ($value['currency'] == "5") { $currency = "DKK"; }
	if ($value['currency'] == "6") { $currency = "EUR"; }
	if ($value['currency'] == "7") { $currency = "HKD"; }
	if ($value['currency'] == "8") { $currency = "HUF"; }
	if ($value['currency'] == "9") { $currency = "ILS"; }
	if ($value['currency'] == "10") { $currency = "JPY"; }
	if ($value['currency'] == "11") { $currency = "MYR"; }
	if ($value['currency'] == "12") { $currency = "MXN"; }
	if ($value['currency'] == "13") { $currency = "NOK"; }
	if ($value['currency'] == "14") { $currency = "NZD"; }
	if ($value['currency'] == "15") { $currency = "PHP"; }
	if ($value['currency'] == "16") { $currency = "PLN"; }
	if ($value['currency'] == "17") { $currency = "GBP"; }
	if ($value['currency'] == "18") { $currency = "RUB"; }
	if ($value['currency'] == "19") { $currency = "SGD"; }
	if ($value['currency'] == "20") { $currency = "SEK"; }
	if ($value['currency'] == "21") { $currency = "CHF"; }
	if ($value['currency'] == "22") { $currency = "TWD"; }
	if ($value['currency'] == "23") { $currency = "THB"; }
	if ($value['currency'] == "24") { $currency = "TRY"; }
	if ($value['currency'] == "25") { $currency = "USD"; }

	// language
	if ($value['language'] == "1") {
		$language = "da_DK";
		$image = "https://www.paypalobjects.com/da_DK/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/da_DK/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/da_DK/DK/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Danish

	if ($value['language'] == "2") {
		$language = "nl_BE";
		$image = "https://www.paypalobjects.com/nl_NL/NL/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/nl_NL/NL/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/nl_NL/NL/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Dutch

	if ($value['language'] == "3") {
		$language = "EN_US";
		$image = "https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //English

	if ($value['language'] == "20") {
		$language = "en_GB";
		$image = "https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //English - UK

	if ($value['language'] == "4") {
		$language = "fr_CA";
		$image = "https://www.paypalobjects.com/fr_CA/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/fr_CA/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/fr_CA/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //French

	if ($value['language'] == "5") {
		$language = "de_DE";
		$image = "https://www.paypalobjects.com/de_DE/DE/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/de_DE/DE/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/de_DE/DE/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //German

	if ($value['language'] == "6") {
		$language = "he_IL";
		$image = "https://www.paypalobjects.com/he_IL/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/he_IL/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/he_IL/IL/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Hebrew

	if ($value['language'] == "7") {
		$language = "it_IT";
		$image = "https://www.paypalobjects.com/it_IT/IT/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/it_IT/IT/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Italian

	if ($value['language'] == "8") {
		$language = "ja_JP";
		$image = "https://www.paypalobjects.com/ja_JP/JP/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/ja_JP/JP/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/ja_JP/JP/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Japanese

	if ($value['language'] == "9") {
		$language = "no_NO";
		$image = "https://www.paypalobjects.com/no_NO/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/no_NO/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/no_NO/NO/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Norwgian

	if ($value['language'] == "10") {
		$language = "pl_PL";
		$image = "https://www.paypalobjects.com/pl_PL/PL/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/pl_PL/PL/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/pl_PL/PL/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Polish

	if ($value['language'] == "11") {
		$language = "pt_BR";
		$image = "https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Portuguese

	if ($value['language'] == "12") {
		$language = "ru_RU";
		$image = "https://www.paypalobjects.com/ru_RU/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/ru_RU/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/ru_RU/RU/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Russian

	if ($value['language'] == "13") {
		$language = "es_ES";
		$image = "https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Spanish

	if ($value['language'] == "14") {
		$language = "sv_SE";
		$image = "https://www.paypalobjects.com/sv_SE/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/sv_SE/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/sv_SE/SE/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Swedish

	if ($value['language'] == "15") {
		$language = "zh_CN";
		$image = "https://www.paypalobjects.com/zh_XC/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/zh_XC/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/zh_XC/C2/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Simplified Chinese - China

	if ($value['language'] == "16") {
		$language = "zh_HK";
		$image = "https://www.paypalobjects.com/zh_HK/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/zh_HK/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/zh_HK/HK/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Traditional Chinese - Hong Kong

	if ($value['language'] == "17") {
		$language = "zh_TW";
		$image = "https://www.paypalobjects.com/zh_TW/TW/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/zh_TW/TW/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/zh_TW/TW/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Traditional Chinese - Taiwan

	if ($value['language'] == "18") {
		$language = "tr_TR";
		$image = "https://www.paypalobjects.com/tr_TR/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/tr_TR/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/tr_TR/TR/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Turkish

	if ($value['language'] == "19") {
		$language = "th_TH";
		$image = "https://www.paypalobjects.com/th_TH/i/btn/btn_buynow_SM.gif";
		$imageb = "https://www.paypalobjects.com/th_TH/i/btn/btn_buynow_LG.gif";
		$imagecc = "https://www.paypalobjects.com/th_TH/TH/i/btn/btn_buynowCC_LG.gif";
		$imagenew = "https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png";
	} //Thai

	if (!empty($atts['size'])) {
		if ($atts['size'] == "1") { $img = $image; }
		if ($atts['size'] == "2") { $img = $imageb; }
		if ($atts['size'] == "3") { $img = $imagecc; }
		if ($atts['size'] == "5") { $img = $imagenew; }
	} else {
		if ($value['size'] == "1") { $img = $image; }
		if ($value['size'] == "2") { $img = $imageb; }
		if ($value['size'] == "3") { $img = $imagecc; }
		if ($value['size'] == "4") { $img = $value['upload_image']; }
		if ($value['size'] == "5") { $img = $imagenew; }
	}

	// window action
	if ($value['opens'] == "1") { $target = ""; }
	if ($value['opens'] == "2") { $target = "_blank"; }

	// alignment
	if ($atts['align'] == "left") { 	$alignment = "style='float: left;'"; }
	if ($atts['align'] == "right") { 	$alignment = "style='float: right;'"; }
	if ($atts['align'] == "center") { 	$alignment = "style='margin-left: auto;margin-right: auto;width:170px'"; }

	if (!isset($alignment)) { $alignment = ""; }

	if (!isset($note)) { $note = ""; }



	$output = "";

	if (empty($account)) {
		$output .= "(Please enter your PayPal Account or Merchant ID on the settings pages.)";
	}

	$output .= "<div $alignment>";
	$output .= "<form target='$target' action='https://www.$path.com/cgi-bin/webscr' method='post'>";
	$output .= "<input type='hidden' name='cmd' value='_xclick' />";
	$output .= "<input type='hidden' name='business' value='$account' />";
	$output .= "<input type='hidden' name='item_name' value='". $atts['name'] ."' />";
	$output .= "<input type='hidden' name='currency_code' value='$currency' />";
	$output .= "<input type='hidden' name='amount' value='". $atts['price'] ."' />";
	$output .= "<input type='hidden' name='lc' value='$language'>";
	$output .= "<input type='hidden' name='no_note' value='$note'>";
	$output .= "<input type='hidden' name='paymentaction' value='$paymentaction'>";
	$output .= "<input type='hidden' name='return' value='". $value['return'] ."' />";
	$output .= "<input type='hidden' name='bn' value='WPPlugin_SP'>";
	$output .= "<input type='hidden' name='cancel_return' value='". $value['cancel'] ."' />";
	$output .= "<input style='border: none;' class='paypalbuttonimage' type='image' src='$img' border='0' name='submit' alt='Make your payments with PayPal. It is free, secure, effective.'>";
	$output .= "<img alt='' border='0' style='border:none;display:none;' src='https://www.paypal.com/$language/i/scr/pixel.gif' width='1' height='1'>";
	$output .= "</form></div>";

	return $output;

}


  endif;
}
add_action( 'after_setup_theme', 'qt_paypal' );

// ==============================================
/* Dashboard Info Widget */
// ==============================================
function qt_infowidget() {
   global $theme_display_options;
   if ( $theme_display_options['qtinfodash'] ) :
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() { 
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
} 
function custom_dashboard_help() { echo '<p>Welcome to a Custom QuickerThemes theme! This theme was created by the only automated software to create "Premium" quality themes, the QuickerThemes Artisteer export plugin. For more information regarding our themes and plugins, please visit: <a href="http://www.quickerthemes.com" target="_blank">Quicker Themes</a></p><br/>You can also get help from Appearance -> Help/Support pages from within this website.';
}

   endif;
}
add_action( 'after_setup_theme', 'qt_infowidget' );

// ==============================================
/* Dashboard Feed */
// ==============================================
function qt_dashfeed() {
   global $theme_display_options;
   if ( $theme_display_options['qtfeed'] ) :
add_action('wp_dashboard_setup', 'my_dashboard_widgets');
function my_dashboard_widgets() {
     global $wp_meta_boxes;
     unset(
          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
     );
     wp_add_dashboard_widget( 'dashboard_custom_feed', 'Theme News & Updates' , 'dashboard_custom_feed_output' );
}
function dashboard_custom_feed_output() {
     echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'https://quickerthemes.wordpress.com/feed/',
          'title' => 'MY_FEED_TITLE',
          'items' => 3,
          'show_summary' => 1,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo '</div>';
}
   endif;
}
add_action( 'after_setup_theme', 'qt_dashfeed' );



add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price( $cart_obj ) {

    //  This is necessary for WC 3.0+
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    foreach ( $cart_obj->get_cart() as $key => $value ) {

     //echo'<pre>';  print_r($value['data']->parent_id); echo'<pre>';
       // $value['data']->set_price( 3 );
    }
 }

//Custom Hook For Discount

function mysite_box_discount( ) {
  
    global $woocommerce;
 
    /* Grab current total number of products */
    $number_products = $woocommerce->cart->cart_contents_count;
   
    $total_discount = 0;
    $my_increment = 1; // Apply another discount every 15 products
    $discount = 8.85;
    
    if ($number_products >= $my_increment) {
       
      /* Loop through the total number of products */
      foreach ( range(0, $number_cards, $my_increment) as $val ) {
        if ($val != 0) {
      		$total_discount += $discount;
      	}
      }
   
      // Alter the cart discount total
    // $woocommerce->cart->discount_total = 100;
    }   
}
//add_action('woocommerce_calculate_totals', 'mysite_box_discount');
