<?php /* Conditional widgets */

/* Conditional widgets form */
function wptc_conditional_widgets_form( $widget, $return, $instance ) {
    global $theme_display_options;
    if ( $return == 'noform' ) $return = true;
    $instance = wptc_init_conditional_widget_instance( $instance );
    ?>
    <div id="wptc-widget-options-<?php echo $widget->id; ?>">
        <a href="#wptc-widget-options-<?php echo $widget->id; ?>" onclick="jQuery('#wptc-widget-<?php echo $widget->id; ?>').toggle(280); return false;"><strong><?php _e( 'Theme Display Options', 'wptc_theme_td' ); ?></strong></a><br /><br />
        <div id="wptc-widget-<?php echo $widget->id; ?>" style="display:none;">
        <strong><?php _e( 'Appearance:', 'wptc_theme_td' ); ?></strong><br />
        <select name="wptc_appearance">
            <option value="default" <?php selected( $instance['wptc_appearance'], 'default' ); ?> ><?php _e( 'Sidebar Default', 'wptc_theme_td' ); ?></option>
            <option value="block" <?php selected( $instance['wptc_appearance'], 'block' ); ?> ><?php _e( 'Block', 'wptc_theme_td' ); ?></option>
            <option value="post" <?php selected( $instance['wptc_appearance'], 'post' ); ?> ><?php _e( 'Post', 'wptc_theme_td' ); ?></option>
            <option value="text" <?php selected( $instance['wptc_appearance'], 'text' ); ?> ><?php _e( 'Simple Text', 'wptc_theme_td' ); ?></option>
            <option value="custom" <?php selected( $instance['wptc_appearance'], 'custom' ); ?> ><?php _e( 'Custom Only', 'wptc_theme_td' ); ?></option>
        </select><br /><br />
        <input type="checkbox" id="wptc_disable_bullets<?php echo $widget->id; ?>" name="wptc_disable_bullets" <?php checked( $instance['wptc_disable_bullets'], 'on' ); ?> /> <label for="wptc_disable_bullets<?php echo $widget->id; ?>">Disable Bullets</label><br /><br />
        <label for="wptc_widget_classes<?php echo $widget->id; ?>"><?php _e( 'Custom Widget Classes <small>(space separated)</small>', 'wptc_theme_td' ); ?></label><br />
        <input class="widefat" type="text" id="wptc_widget_classes<?php echo $widget->id; ?>" name="wptc_widget_classes" value="<?php echo $instance['wptc_widget_classes']; ?>" /><br />
        <label for="wptc_header_classes<?php echo $widget->id; ?>"><?php _e( 'Custom Widget Header Classes <small>(space separated)</small>', 'wptc_theme_td' ); ?></label><br />
        <input class="widefat" type="text" id="wptc_header_classes<?php echo $widget->id; ?>" name="wptc_header_classes" value="<?php echo $instance['wptc_header_classes']; ?>" /><br />
        <label for="wptc_content_classes<?php echo $widget->id; ?>"><?php _e( 'Custom Widget Content Classes <small>(space separated)</small>', 'wptc_theme_td' ); ?></label><br />
        <input class="widefat" type="text" id="wptc_content_classes<?php echo $widget->id; ?>" name="wptc_content_classes" value="<?php echo $instance['wptc_content_classes']; ?>" /><br />
        <label for="wptc_title_link<?php echo $widget->id; ?>"><?php _e( 'Title Link to URL <small>(http://www.site.com)</small>', 'wptc_theme_td' ); ?></label><br />
        <input class="widefat" type="text" id="wptc_title_link<?php echo $widget->id; ?>" name="wptc_title_link" value="<?php echo $instance['wptc_title_link']; ?>" /><br /><br />
        <strong><?php _e( 'Display Widget On:', 'wptc_theme_td' ); ?></strong><br />
        <select name="wptc_display">
            <option value="all" <?php selected( $instance['wptc_display'], 'all' ); ?> ><?php _e( 'All Pages', 'wptc_theme_td' ); ?></option>
            <option value="show" <?php selected( $instance['wptc_display'], 'show' ); ?> ><?php _e( 'Selected Pages', 'wptc_theme_td' ); ?></option>
            <option value="hide" <?php selected( $instance['wptc_display'], 'hide' ); ?> ><?php _e( 'All Except Selected Pages', 'wptc_theme_td' ); ?></option>
        </select><br /><br />
        <input type="checkbox" id="wptc_home_page<?php echo $widget->id; ?>" name="wptc_home_page" <?php checked( $instance['wptc_home_page'], 'on' ); ?> /> <label for="wptc_home_page<?php echo $widget->id; ?>"><?php _e( 'Home Posts Page', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_front_page<?php echo $widget->id; ?>" name="wptc_front_page" <?php checked( $instance['wptc_front_page'], 'on' ); ?> /> <label for="wptc_front_page<?php echo $widget->id; ?>"><?php _e( 'Front Page', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_single_posts<?php echo $widget->id; ?>" name="wptc_single_posts" <?php checked( $instance['wptc_single_posts'], 'on' ); ?> /> <label for="wptc_single_posts<?php echo $widget->id; ?>"><?php _e( 'Single Posts', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_single_pages<?php echo $widget->id; ?>" name="wptc_single_pages" <?php checked( $instance['wptc_single_pages'], 'on' ); ?> /> <label for="wptc_single_pages<?php echo $widget->id; ?>"><?php _e( 'Single Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_404_page<?php echo $widget->id; ?>" name="wptc_404_page" <?php checked( $instance['wptc_404_page'], 'on' ); ?> /> <label for="wptc_404_page<?php echo $widget->id; ?>"><?php _e( '404 Page', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_all_archive_pages<?php echo $widget->id; ?>" name="wptc_all_archive_pages" <?php checked( $instance['wptc_all_archive_pages'], 'on' ); ?> /> <label for="wptc_all_archive_pages<?php echo $widget->id; ?>"><?php _e( 'All Archive Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_attachment_pages<?php echo $widget->id; ?>" name="wptc_attachment_pages" <?php checked( $instance['wptc_attachment_pages'], 'on' ); ?> /> <label for="wptc_attachment_pages<?php echo $widget->id; ?>"><?php _e( 'Attachment Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_author_archive_pages<?php echo $widget->id; ?>" name="wptc_author_archive_pages" <?php checked( $instance['wptc_author_archive_pages'], 'on' ); ?> /> <label for="wptc_author_archive_pages<?php echo $widget->id; ?>"><?php _e( 'Author Archive Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_category_archive_pages<?php echo $widget->id; ?>" name="wptc_category_archive_pages" <?php checked( $instance['wptc_category_archive_pages'], 'on' ); ?> /> <label for="wptc_category_archive_pages<?php echo $widget->id; ?>"><?php _e( 'Category Archive Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_date_archive_pages<?php echo $widget->id; ?>" name="wptc_date_archive_pages" <?php checked( $instance['wptc_date_archive_pages'], 'on' ); ?> /> <label for="wptc_date_archive_pages<?php echo $widget->id; ?>"><?php _e( 'Date Archive Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_search_pages<?php echo $widget->id; ?>" name="wptc_search_pages" <?php checked( $instance['wptc_search_pages'], 'on' ); ?> /> <label for="wptc_search_pages<?php echo $widget->id; ?>"><?php _e( 'Search Pages', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_tag_archive_pages<?php echo $widget->id; ?>" name="wptc_tag_archive_pages" <?php checked( $instance['wptc_tag_archive_pages'], 'on' ); ?> /> <label for="wptc_tag_archive_pages<?php echo $widget->id; ?>"><?php _e( 'Tag Archive Pages', 'wptc_theme_td' ); ?></label><br /><br />
        <label for="wptc_post_page_ids<?php echo $widget->id; ?>">Post/Page IDs <small>(comma separated)</small></label><br />
        <input class="widefat" type="text" id="wptc_post_page_ids<?php echo $widget->id; ?>" name="wptc_post_page_ids" value="<?php echo $instance['wptc_post_page_ids']; ?>" /><br /><br />
        <strong><?php _e( 'User Display On:', 'wptc_theme_td' ); ?></strong><br />
        <input type="checkbox" id="wptc_user_logged_in<?php echo $widget->id; ?>" name="wptc_user_logged_in" <?php checked( $instance['wptc_user_logged_in'], 'on' ); ?> /> <label for="wptc_user_logged_in<?php echo $widget->id; ?>"><?php _e( 'User Logged In', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_user_logged_out<?php echo $widget->id; ?>" name="wptc_user_logged_out" <?php checked( $instance['wptc_user_logged_out'], 'on' ); ?> /> <label for="wptc_user_logged_out<?php echo $widget->id; ?>"><?php _e( 'User Logged Out', 'wptc_theme_td' ); ?></label>
        <?php if ( $theme_display_options['doResponsiveDesign'] ) : ?>
        <br /><br />
        <strong><?php _e( 'Responsive Display On:', 'wptc_theme_td' ); ?></strong><br />
        <input type="checkbox" id="wptc_resp_desktop<?php echo $widget->id; ?>" name="wptc_resp_desktop" <?php checked( $instance['wptc_resp_desktop'], 'on' ); ?> /> <label for="wptc_resp_desktop<?php echo $widget->id; ?>"><?php _e( 'Desktop', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_resp_tablet<?php echo $widget->id; ?>" name="wptc_resp_tablet" <?php checked( $instance['wptc_resp_tablet'], 'on' ); ?> /> <label for="wptc_resp_tablet<?php echo $widget->id; ?>"><?php _e( 'Tablet', 'wptc_theme_td' ); ?></label><br />
        <input type="checkbox" id="wptc_resp_phone<?php echo $widget->id; ?>" name="wptc_resp_phone" <?php checked( $instance['wptc_resp_phone'], 'on' ); ?> /> <label for="wptc_resp_phone<?php echo $widget->id; ?>"><?php _e( 'Phone', 'wptc_theme_td' ); ?></label>
        <?php endif; ?>
        </div>
    </div>
    <?php
}
add_action( 'in_widget_form', 'wptc_conditional_widgets_form', 10, 3 );

/* Update widget options */
function wptc_conditional_widgets_update( $new_instance, $old_instance ) {
    $instance = $new_instance;

    $instance['wptc_appearance'] = isset( $_POST['wptc_appearance'] ) ? $_POST['wptc_appearance'] : 'default';
    $instance['wptc_widget_classes'] = isset( $_POST['wptc_widget_classes'] ) ? sanitize_text_field( $_POST['wptc_widget_classes'] ) : '';
    $instance['wptc_header_classes'] = isset( $_POST['wptc_header_classes'] ) ? sanitize_text_field( $_POST['wptc_header_classes'] ) : '';
    $instance['wptc_content_classes'] = isset( $_POST['wptc_content_classes'] ) ? sanitize_text_field( $_POST['wptc_content_classes'] ) : '';
    $instance['wptc_title_link'] = isset( $_POST['wptc_title_link'] ) ? sanitize_text_field( $_POST['wptc_title_link'] ) : '';
    $instance['wptc_disable_bullets'] = isset( $_POST['wptc_disable_bullets'] ) && $_POST['wptc_disable_bullets'] ? 'on' : 'off';
    $instance['wptc_display'] = isset( $_POST['wptc_display'] ) ? $_POST['wptc_display'] : 'all';
    $instance['wptc_home_page'] = isset( $_POST['wptc_home_page'] ) && $_POST['wptc_home_page'] ? 'on' : 'off';
    $instance['wptc_front_page'] = isset( $_POST['wptc_front_page'] ) && $_POST['wptc_front_page'] ? 'on' : 'off';
    $instance['wptc_single_posts'] = isset( $_POST['wptc_single_posts'] ) && $_POST['wptc_single_posts'] ? 'on' : 'off';
    $instance['wptc_single_pages'] = isset( $_POST['wptc_single_pages'] ) && $_POST['wptc_single_pages'] ? 'on' : 'off';
    $instance['wptc_404_page'] = isset( $_POST['wptc_404_page'] ) && $_POST['wptc_404_page'] ? 'on' : 'off';
    $instance['wptc_all_archive_pages'] = isset( $_POST['wptc_all_archive_pages'] ) && $_POST['wptc_all_archive_pages'] ? 'on' : 'off';
    $instance['wptc_attachment_pages'] = isset( $_POST['wptc_attachment_pages'] ) && $_POST['wptc_attachment_pages'] ? 'on' : 'off';
    $instance['wptc_author_archive_pages'] = isset( $_POST['wptc_author_archive_pages'] ) && $_POST['wptc_author_archive_pages'] ? 'on' : 'off';
    $instance['wptc_category_archive_pages'] = isset( $_POST['wptc_category_archive_pages'] ) && $_POST['wptc_category_archive_pages'] ? 'on' : 'off';
    $instance['wptc_date_archive_pages'] = isset( $_POST['wptc_date_archive_pages'] ) && $_POST['wptc_date_archive_pages'] ? 'on' : 'off';
    $instance['wptc_search_pages'] = isset( $_POST['wptc_search_pages'] ) && $_POST['wptc_search_pages'] ? 'on' : 'off';
    $instance['wptc_tag_archive_pages'] = isset( $_POST['wptc_tag_archive_pages'] ) && $_POST['wptc_tag_archive_pages'] ? 'on' : 'off';
    $instance['wptc_post_page_ids'] = isset( $_POST['wptc_post_page_ids'] ) ? preg_replace( array( '/[^\d,]/', '/(?<=,),+/', '/^,+/', '/,+$/' ), '', $_POST['wptc_post_page_ids'] ) : '';
    $instance['wptc_user_logged_in'] = isset( $_POST['wptc_user_logged_in'] ) && $_POST['wptc_user_logged_in'] ? 'on' : 'off';
    $instance['wptc_user_logged_out'] = isset( $_POST['wptc_user_logged_out'] ) && $_POST['wptc_user_logged_out'] ? 'on' : 'off';
    $instance['wptc_resp_desktop'] = isset( $_POST['wptc_resp_desktop'] ) && $_POST['wptc_resp_desktop'] ? 'on' : 'off';
    $instance['wptc_resp_tablet'] = isset( $_POST['wptc_resp_tablet'] ) && $_POST['wptc_resp_tablet'] ? 'on' : 'off';
    $instance['wptc_resp_phone'] = isset( $_POST['wptc_resp_phone'] ) && $_POST['wptc_resp_phone'] ? 'on' : 'off';

    return $instance;
}
add_filter( 'widget_update_callback', 'wptc_conditional_widgets_update', 10, 2 );

/* To display the widget, or not to display the widget */
function wptc_display_widget_test( $instance ) {
    if ( $instance['wptc_display'] != 'all' && $instance['wptc_display'] != 'show' && $instance['wptc_display'] != 'hide' ) return false;

    if ( $instance['wptc_display'] == 'show' ) :
        $show_widget = false;
    elseif ( $instance['wptc_display'] == 'hide' ) :
        $show_widget = true;
    endif;

    if ( $instance['wptc_display'] == 'all' ) :
        $show_widget = true;
    elseif ( is_home() && $instance['wptc_home_page'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_front_page() && $instance['wptc_front_page'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_single() && $instance['wptc_single_posts'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_page() && $instance['wptc_single_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_404() && $instance['wptc_404_page'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_archive() && $instance['wptc_all_archive_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_attachment() && $instance['wptc_attachment_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_author() && $instance['wptc_author_archive_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_category() && $instance['wptc_category_archive_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_date() && $instance['wptc_date_archive_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_search() && $instance['wptc_search_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( is_tag() && $instance['wptc_tag_archive_pages'] == 'on' ) :
        $show_widget = !$show_widget;
    elseif ( $instance['wptc_post_page_ids'] != '' && ( is_single( explode( ',', $instance['wptc_post_page_ids'] ) ) || is_page( explode( ',', $instance['wptc_post_page_ids'] ) ) ) ) :
        $show_widget = !$show_widget;
    endif;
    if ( $show_widget ) :
        if ( is_user_logged_in() && $instance['wptc_user_logged_in'] == 'off' ) :
            $show_widget = !$show_widget;
        elseif ( !is_user_logged_in() && $instance['wptc_user_logged_out'] == 'off' ) :
            $show_widget = !$show_widget;
        endif;
    endif;

    return $show_widget;
}

/* Conditionally display widgets */
function wptc_conditional_widgets_display( $instance, $widget = null, $args = null ) {
    global $theme_display_options;

    if ( $widget == null || $args == null ) return $instance;

    $instance = wptc_init_conditional_widget_instance( $instance );

    $show_widget = wptc_display_widget_test( $instance );

    if ( $show_widget ) :

        $resp_classes = '';
        if ( $theme_display_options['doResponsiveDesign'] ) :
            $resp_classes = $instance['wptc_resp_desktop'] == 'off' ? ' desktop-no-show' : '';
            $resp_classes .= $instance['wptc_resp_tablet'] == 'off' ? ' tablet-no-show' : '';
            $resp_classes .= $instance['wptc_resp_phone'] == 'off' ? ' phone-no-show' : '';
        endif;
        $bullets_class = $instance['wptc_disable_bullets'] == 'on' ? ' disable-bullets' : '';
        $widget_classes = !empty( $instance['wptc_widget_classes'] ) ? ' ' . $instance['wptc_widget_classes'] . $bullets_class . $resp_classes : $bullets_class . $resp_classes;
        $header_classes = !empty( $instance['wptc_header_classes'] ) ? ' ' . $instance['wptc_header_classes'] : '';
        $content_classes = !empty( $instance['wptc_content_classes'] ) ? ' ' . $instance['wptc_content_classes'] : '';
        $appearance = $instance['wptc_appearance'];

        if ( $instance['wptc_appearance'] == 'default' ) :
            switch ( $args['id'] ) :
                case 'header-widget-area' :
                    $appearance = $theme_display_options['appearanceHeaderWidgetArea'];
                    break;
                case 'first-nav-widget-area' :
                case 'second-nav-widget-area' :
                    $appearance = $theme_display_options['appearanceNavWidgetArea'];
                    break;
                case 'first-page-top-widget-area' :
                case 'second-page-top-widget-area' :
                case 'third-page-top-widget-area' :
                case 'fourth-page-top-widget-area' :
                    $appearance = $theme_display_options['appearancePageTopWidgetArea'];
                    break;
                case 'first-content-top-widget-area' :
                case 'second-content-top-widget-area' :
                    $appearance = $theme_display_options['appearanceContentTopWidgetArea'];
                    break;
                case 'first-content-bottom-widget-area' :
                case 'second-content-bottom-widget-area' :
                    $appearance = $theme_display_options['appearanceContentBottomWidgetArea'];
                    break;
                case 'first-page-bottom-widget-area' :
                case 'second-page-bottom-widget-area' :
                case 'third-page-bottom-widget-area' :
                case 'fourth-page-bottom-widget-area' :
                    $appearance = $theme_display_options['appearancePageBottomWidgetArea'];
                    break;
                case 'first-footer-widget-area' :
                case 'second-footer-widget-area' :
                case 'third-footer-widget-area' :
                case 'fourth-footer-widget-area' :
                    $appearance = $theme_display_options['appearanceFooterWidgetArea'];
                    break;
                case 'logo-widget-area' :
                    $appearance = $theme_display_options['appearanceLOGOWidgetArea'];
                    break;
                case 'contact-widget-area' :
                    $appearance = $theme_display_options['appearanceCONTACTWidgetArea'];
                    break;
                case 'slogan-widget-area' :
                    $appearance = $theme_display_options['appearanceSLOGANWidgetArea'];
                    break;
            endswitch;
        endif;

        ob_start();
        $widget->widget( $args, $instance );
        $widget_output = ob_get_clean();

        if ( strpos( $widget_output, 'wptc-widget-header-class' ) !== false )
            $widget_output = substr_replace( $widget_output, '', strpos( $widget_output, '<div class="wptc-widget-content-class">' ), 39 );

        if ( strpos( $widget_output, 'vmenu' ) !== false ) :
            $widget_output = str_replace( 'wptc-widget-class', 'vmenublock widget' . $widget_classes, $widget_output );
            $widget_output = str_replace( 'wptc-widget-header-class', 'vmenublockheader' . $header_classes, $widget_output );
            $widget_output = str_replace( 'wptc-widget-content-class', 'vmenublockcontent' . $content_classes, $widget_output );
        else :
            switch ( $appearance ) :
                case 'block' :
                    $widget_output = str_replace( 'wptc-widget-class', 'block widget' . $widget_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-header-class', 'blockheader' . $header_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-content-class', 'blockcontent' . $content_classes, $widget_output );
                    break;
                case 'post' :
                    $widget_output = str_replace( 'wptc-widget-class', 'post article widget' . $widget_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-header-class', 'postheader' . $header_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-content-class', 'postcontent' . $content_classes, $widget_output );
                    break;
                case 'text' :
                    $widget_output = str_replace( 'wptc-widget-class', 'widget widget' . $widget_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-header-class', 'widget-title' . $header_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-content-class', 'widget-content' . $content_classes, $widget_output );
                    break;
                case 'custom' :
                    $widget_output = str_replace( 'wptc-widget-class', 'widget' . $widget_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-header-class', $header_classes, $widget_output );
                    $widget_output = str_replace( 'wptc-widget-content-class', $content_classes, $widget_output );
                    break;
            endswitch;
        endif;

        echo $widget_output;

    endif;

    return false;
}
add_filter( 'widget_display_callback', 'wptc_conditional_widgets_display', 10, 3 );

function wptc_widget_title_link( $title, $instance = null ) {
  if ( !empty( $title ) && !empty( $instance['wptc_title_link'] ) )
    $title = '<a href="' . $instance['wptc_title_link'] . '">' . $title . '</a>';
  return $title;
}
add_filter( 'widget_title', 'wptc_widget_title_link', 99, 2 );

/* Init widget instance with defaults */
function wptc_init_conditional_widget_instance( $instance ) {
    $wptc_widget_instance_defaults = array (
        'wptc_appearance'                => 'default',
        'wptc_widget_classes'            => '',
        'wptc_header_classes'            => '',
        'wptc_content_classes'           => '',
        'wptc_title_link'                => '',
        'wptc_disable_bullets'           => 'off',
        'wptc_display'                   => 'all',
        'wptc_home_page'                 => 'off',
        'wptc_front_page'                => 'off',
        'wptc_single_posts'              => 'off',
        'wptc_single_pages'              => 'off',
        'wptc_404_page'                  => 'off',
        'wptc_all_archive_pages'         => 'off',
        'wptc_attachment_pages'          => 'off',
        'wptc_author_archive_pages'      => 'off',
        'wptc_category_archive_pages'    => 'off',
        'wptc_date_archive_pages'        => 'off',
        'wptc_search_pages'              => 'off',
        'wptc_tag_archive_pages'         => 'off',
        'wptc_post_page_ids'             => '',
        'wptc_user_logged_in'            => 'on',
        'wptc_user_logged_out'           => 'on',
        'wptc_resp_desktop'              => 'on',
        'wptc_resp_tablet'               => 'on',
        'wptc_resp_phone'                => 'on',
    );

    return array_merge( $wptc_widget_instance_defaults, $instance );
}

/* Add sidebar rows and columns. */
function wptc_add_sidebar_rows_cols( $params ) {

    if ( !in_array( $params[ 0 ][ 'id' ], array( 'first-page-top-widget-area', 'first-content-top-widget-area', 'first-content-bottom-widget-area', 'first-page-bottom-widget-area', 'first-footer-widget-area', ) ) ) {
        if ( strpos( $params[ 0 ][ 'widget_id' ], 'wptc_row' ) !== false || strpos( $params[ 0 ][ 'widget_id' ], 'wptc_col' ) !== false ) {
            $params[ 0 ][ 'before_widget' ] = '';
            $params[ 0 ][ 'after_widget' ] = '';
        }
        return $params;
    }

	static $sidebar_id = '';           // Current sidebar id.
	static $cur_widget = 1;            // Current widget.
	static $total_widgets = 1;         // Total widgets in current sidebar.
	static $cur_row = 0;               // Current row (zero-based).
	static $cur_col_in_row = 1;        // Current column in row.
	static $cols_per_row = array( 1 ); // Columns per row.
	$before = '';

	if ( $sidebar_id != $params[ 0 ][ 'id' ] ) {

        global $wp_registered_widgets;
		$sidebar_widgets = wp_get_sidebars_widgets(); // Get list of sidebars and their widgets.
		$total_widgets = count( $sidebar_widgets[ $params[ 0 ][ 'id' ] ] );
		$cur_widget = 1;
		$sidebar_id = $params[ 0 ][ 'id' ];
		$cur_row = 0;
		$cols_per_row = array( 1 );
        //print_r( $sidebar_widgets ); echo '<br><br>'; print_r( $params ); die();
		foreach ( $sidebar_widgets[ $sidebar_id ] as $widget_id ) {
			if ( strpos( $widget_id, 'wptc_col' ) !== false ) {
                $options = (array) get_option( $wp_registered_widgets[ $widget_id ][ 'callback' ][ 0 ]->option_name );
                preg_match( '/-([0-9]+)$/', $widget_id, $matches );
                $options = wptc_init_conditional_widget_instance( (array) $options[ $matches[ 1 ] ] );
                if ( wptc_display_widget_test( $options ) ) {
                    if ( $cols_per_row[ $cur_row ] == 4 ) {
    					$cur_row++;
    					$cols_per_row[ $cur_row ] = 1;
    				} else {
    					$cols_per_row[ $cur_row ]++;
    				}
                }
			} elseif ( strpos( $widget_id, 'wptc_row' ) !== false ) {
                $options = (array) get_option( $wp_registered_widgets[ $widget_id ][ 'callback' ][ 0 ]->option_name );
                preg_match( '/-([0-9]+)$/', $widget_id, $matches );
                $options = wptc_init_conditional_widget_instance( (array) $options[ $matches[ 1 ] ] );
                if ( wptc_display_widget_test( $options ) ) {
    				$cur_row++;
    				$cols_per_row[ $cur_row ] = 1;
                }
			}
		}
		$cur_row = 0;
        $cur_col_in_row = 1;
		$before = '<div class="content-layout-row"><div class="layout-cell layout-cell-size' . $cols_per_row[ 0 ] . '">';

	}

	if ( strpos( $params[ 0 ][ 'widget_id' ], 'wptc_row' ) !== false || $cur_col_in_row > 4 ) {
		$cur_row++;
		$before = $before . '</div></div></div><div class="content-layout"><div class="content-layout-row"><div class="layout-cell layout-cell-size' . $cols_per_row[ $cur_row ] . '">';
		$cur_col_in_row = 1;
		$params[ 0 ][ 'before_widget' ] = '';
	} elseif ( strpos( $params[ 0 ][ 'widget_id' ], 'wptc_col' ) !== false ) {
		$before = $before . '</div><div class="layout-cell layout-cell-size' . $cols_per_row[ $cur_row ] . '">';
		$cur_col_in_row++;
		$params[ 0 ][ 'before_widget' ] = '';
	}

	$params[ 0 ][ 'before_widget' ] = $before . $params[ 0 ][ 'before_widget' ];

	if ( $cur_widget == $total_widgets ) {
		$params[ 0 ][ 'after_widget' ] .= '</div></div>';
	}
	$cur_widget++;

	return $params;

}
add_filter( 'dynamic_sidebar_params', 'wptc_add_sidebar_rows_cols' );

/* WPTC_Widget_Row widget class */
class WPTC_Widget_Row extends WP_Widget {

	public function __construct() {

		parent::__construct( 'wptc_row', __( 'Layout: New Column on New Row', 'wptc_theme_td' ), array(
			'classname'   => 'wptc_widget_row',
			'description' => __( 'Create a new row and column of widgets.', 'wptc_theme_td' ),
		) );

	}

	public function widget( $args, $instance ) {

		echo $args[ 'before_widget' ];

	}

	public function update( $new_instance, $old_instance ) {

		return $new_instance;

	}

	public function form( $instance ) { ?><br/><?php }

}

/* WPTC_Widget_Column widget class */
class WPTC_Widget_Column extends WP_Widget {

	public function __construct() {

		parent::__construct( 'wptc_col', __( 'Layout: New Column', 'wptc_theme_td' ), array(
			'classname'   => 'wptc_widget_col',
			'description' => __( 'Create a new column of widgets.', 'wptc_theme_td' ),
		) );

	}

	public function widget( $args, $instance ) {

		echo $args[ 'before_widget' ];

	}

	public function update( $new_instance, $old_instance ) {

		return $new_instance;

	}

	public function form( $instance ) { ?><br/><?php }

}

/* Register widgets. */
function wptc_register_widgets() {

	register_widget( 'WPTC_Widget_Row' );
	register_widget( 'WPTC_Widget_Column' );

}
add_action( 'widgets_init', 'wptc_register_widgets' );

?>
