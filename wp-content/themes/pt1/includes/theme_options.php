<?php /* Theme options */

/* Settings for the customize menu */
function do_theme_customize_register( $wp_customize ) {
    global $wptc_theme_display_defaults;

    $heading_tag_choices = array(
        'h1'    => '&lt;H1&gt;',
        'h2'    => '&lt;H2&gt;',
        'h3'    => '&lt;H3&gt;',
        'h4'    => '&lt;H4&gt;',
        'h5'    => '&lt;H5&gt;',
        'h6'    => '&lt;H6&gt;',
        'div'   => '&lt;DIV&gt;'
    );

    $post_meta_choices = array(
        'none'          => __( 'None', 'wptc_theme_td' ),
        'author'        => __( 'Author', 'wptc_theme_td' ),
        'categories'    => __( 'Categories', 'wptc_theme_td' ),
        'comments'      => __( 'Comments', 'wptc_theme_td' ),
        'date'          => __( 'Date', 'wptc_theme_td' ),
        'tags'          => __( 'Tags', 'wptc_theme_td' )
    );

    $page_meta_choices = array(
        'none'          => __( 'None', 'wptc_theme_td' ),
        'author'        => __( 'Author', 'wptc_theme_td' ),
        'comments'      => __( 'Comments', 'wptc_theme_td' ),
        'date'          => __( 'Date', 'wptc_theme_td' )
    );

    $appearance_choices = array(
        'block' => __( 'Block', 'wptc_theme_td' ),
        'post'  => __( 'Post', 'wptc_theme_td' ),
        'text'  => __( 'Simple Text', 'wptc_theme_td' )
    );

    $customizer = array(
        array(
            'title'             => 'Site Title & Tagline', /* Translation handled by WordPress */
            'id'                => 'title_tagline',
            'controls'          => array(
                array(
                    'title'     => __( 'Show Site Title', 'wptc_theme_td' ),
                    'id'        => 'showSiteTitle',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Tagline', 'wptc_theme_td' ),
                    'id'        => 'showSiteTagline',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Site Title First in Browser Title', 'wptc_theme_td' ),
                    'id'        => 'showSiteTitleFirst',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Browser Title Separator', 'wptc_theme_td' ),
                    'id'        => 'browserTitleSeparator',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Paypal Button', 'wptc_theme_td' ),
                    'id'        => 'qtpaypal',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'User Roles', 'wptc_theme_td' ),
                    'id'        => 'userrole',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Animation', 'wptc_theme_td' ),
                    'id'        => 'animation',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Contact Form [wptc-contact]', 'wptc_theme_td' ),
                    'id'        => 'qtform',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Preloader', 'wptc_theme_td' ),
                    'id'        => 'qtpre',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Display Resources Used', 'wptc_theme_td' ),
                    'id'        => 'serverstats',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Sticky Menu or Header', 'wptc_theme_td' ),
                    'id'        => 'qtsticky',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Elapsed Time', 'wptc_theme_td' ),
                    'id'        => 'qtelapsed',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Dashboard Feed', 'wptc_theme_td' ),
                    'id'        => 'qtfeed',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Dashboard Info', 'wptc_theme_td' ),
                    'id'        => 'qtinfodash',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Delete Posts From Admin Toolbar?', 'wptc_theme_td' ),
                    'id'        => 'qttrash',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Delete Activated Plugins?', 'wptc_theme_td' ),
                    'id'        => 'qtdelete',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Reinstall Themes and Plugins?', 'wptc_theme_td' ),
                    'id'        => 'qtreinstall',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Private Media for Multi Authors', 'wptc_theme_td' ),
                    'id'        => 'qtauthors',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'No Admin Bar For Subscribers', 'wptc_theme_td' ),
                    'id'        => 'qtbaradmin',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Disable Visual Editor Shortcuts', 'wptc_theme_td' ),
                    'id'        => 'qtve',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Duplicate Custom Menu', 'wptc_theme_td' ),
                    'id'        => 'qtdupmenu',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Password Protect Site', 'wptc_theme_td' ),
                    'id'        => 'qtpassprotect',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_siteprotect',
                    'choices'   => array(
					    'nopass'  => __( 'Select', 'wptc_theme_td' ),
                        'protect'  => __( 'Protect', 'wptc_theme_td' ),
                        'maintain'   => __( 'Maintenance Mode', 'wptc_theme_td' )
                    )
                ),
				array(
                    'title'     => __( 'Secret Key', 'wptc_theme_td' ),
                    'id'        => 'skey',
                    'type'      => 'checkbox'
                )
            )
        ),
		array(
            'title'             => 'Navigation', /* Translation handled by WordPress */
            'id'                => 'nav',
            'controls'          => array(
                array(
                    'title'     => __( 'Show Home on Non-Custom Menu', 'wptc_theme_td' ),
                    'id'        => 'showMenuHome',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Home Menu Title', 'wptc_theme_td' ),
                    'id'        => 'menuHomeTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Make Header Clickable', 'wptc_theme_td' ),
                    'id'        => 'makeHeaderClickable',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Header Link', 'wptc_theme_td' ),
                    'id'        => 'headerLink',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Show Top Paging on Archive Pages', 'wptc_theme_td' ),
                    'id'        => 'showTopPager',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Bottom Paging on Archive Pages', 'wptc_theme_td' ),
                    'id'        => 'showBottomPager',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Post Nav Links with Pager Styles', 'wptc_theme_td' ),
                    'id'        => 'showPrevNextPostStylePager',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Top Post Nav Links on Posts', 'wptc_theme_td' ),
                    'id'        => 'showTopPrevNextPost',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Bottom Post Nav Links on Posts', 'wptc_theme_td' ),
                    'id'        => 'showBottomPrevNextPost',
                    'type'      => 'checkbox'
                )
            )
        ),
        array(
            'title'             => __( 'Responsive Design', 'wptc_theme_td' ),
            'id'                => 'responsive_design_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Responsive Breakpoint for CONTENT - For the Theme Columns, QT Builder, Angies Shortcodes, and Autocolumns Shortcode', 'wptc_theme_td' ),
                    'id'        => 'qtbreakpoint',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Responsive Design', 'wptc_theme_td' ),
                    'id'        => 'doResponsiveDesign',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Viewport Initial Scale', 'wptc_theme_td' ),
                    'id'        => 'viewportInitScale',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Viewport Maximum Scale', 'wptc_theme_td' ),
                    'id'        => 'viewportMaxScale',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Viewport User Scalable', 'wptc_theme_td' ),
                    'id'        => 'viewportUserScalable',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Responsive Menu Alignment', 'wptc_theme_td' ),
                    'id'        => 'respMenuAlign',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_resp_menu_align',
                    'choices'   => array(
                        'left'    => __( 'Left', 'wptc_theme_td' ),
                        'center'  => __( 'Center', 'wptc_theme_td' ),
                        'right'   => __( 'Right', 'wptc_theme_td' )
                    )
                ),
                array(
                    'title'     => __( 'Responsive Menu Text', 'wptc_theme_td' ),
                    'id'        => 'respMenuText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Show Visitor Responsive Switch', 'wptc_theme_td' ),
                    'id'        => 'showVisitorRespSwitch',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Switch Background Color', 'wptc_theme_td' ),
                    'id'        => 'switchBackgroundColor',
                    'type'      => 'color'
                ),
                array(
                    'title'     => __( 'Switch Text Color', 'wptc_theme_td' ),
                    'id'        => 'switchTextColor',
                    'type'      => 'color'
                )
            )
        ),
        array(
            'title'             => __( 'Post/Page Featured Images', 'wptc_theme_td' ),
            'id'                => 'post_featured_images_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Show Featured Images on Posts/Pages'),
                    'id'        => 'showPostFeaturedImage',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Featured Image Alignment', 'wptc_theme_td' ),
                    'id'        => 'postFeaturedImageAlignment',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_fi_alignment',
                    'choices'   => array(
                        'alignnone'     => __( 'None', 'wptc_theme_td' ),
                        'aligncenter'   => __( 'Center', 'wptc_theme_td' ),
                        'alignleft'     => __( 'Left', 'wptc_theme_td' ),
                        'alignright'    => __( 'Right', 'wptc_theme_td' )
                    )
                ),
                array(
                    'title'     => __( 'Featured Image Size', 'wptc_theme_td' ),
                    'id'        => 'postFeaturedImageSize',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_fi_size',
                    'choices'   => array(
                        'thumbnail'     => __( 'Thumbnail', 'wptc_theme_td' ),
                        'medium'        => __( 'Medium', 'wptc_theme_td' ),
                        'large'         => __( 'Large', 'wptc_theme_td' ),
                        'full'          => __( 'Full', 'wptc_theme_td' ),
                        'custom'        => __( 'Custom', 'wptc_theme_td' )
                    )
                ),
                array(
                    'title'     => __( 'Custom Size Width (Pixels)', 'wptc_theme_td' ),
                    'id'        => 'postFeaturedImageWidth',
                    'type'      => 'text',
                    'sanitize'  => 'absint'
                ),
                array(
                    'title'     => __( 'Custom Size Height (Pixels)', 'wptc_theme_td' ),
                    'id'        => 'postFeaturedImageHeight',
                    'type'      => 'text',
                    'sanitize'  => 'absint'
                )
            )
        ),
        array(
            'title'             => __( 'Post Meta', 'wptc_theme_td' ),
            'id'                => 'post_meta_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Author Text', 'wptc_theme_td' ),
                    'id'        => 'postMetaAuthorText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Categories Text', 'wptc_theme_td' ),
                    'id'        => 'postMetaCategoriesText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Comments Text', 'wptc_theme_td' ),
                    'id'        => 'postMetaCommentsText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Date Text', 'wptc_theme_td' ),
                    'id'        => 'postMetaDateText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Tags Text', 'wptc_theme_td' ),
                    'id'        => 'postMetaTagsText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Show Post Footer Meta on Pages', 'wptc_theme_td' ),
                    'id'        => 'showPostFooterMetaonPages',
                    'type'      => 'checkbox'
                )
            )
        ),
        array(
            'title'             => __( 'Post Header Meta', 'wptc_theme_td' ),
            'id'                => 'post_header_meta_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Separator', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSeparator',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Slot 1', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot1',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot1LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 2', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot2',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot2LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 3', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot3',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot3LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 4', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot4',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot4LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 5', 'wptc_theme_td' ),
                    'id'        => 'postHeaderMetaSlot5',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                )
            )
        ),
        array(
            'title'             => __( 'Post Footer Meta', 'wptc_theme_td' ),
            'id'                => 'post_footer_meta_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Separator', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSeparator',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Slot 1', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot1',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot1LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 2', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot2',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot2LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 3', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot3',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot3LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 4', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot4',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot4LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 5', 'wptc_theme_td' ),
                    'id'        => 'postFooterMetaSlot5',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $post_meta_choices
                )
            )
        ),
        array(
            'title'             => __( 'Page Header Meta', 'wptc_theme_td' ),
            'id'                => 'page_header_meta_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Separator', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSeparator',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Slot 1', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSlot1',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSlot1LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 2', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSlot2',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSlot2LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 3', 'wptc_theme_td' ),
                    'id'        => 'pageHeaderMetaSlot3',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                )
            )
        ),
        array(
            'title'             => __( 'Page Footer Meta', 'wptc_theme_td' ),
            'id'                => 'page_footer_meta_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Separator', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSeparator',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Slot 1', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSlot1',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSlot1LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 2', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSlot2',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                ),
                array(
                    'title'     => __( 'Line Break', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSlot2LineBreak',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Slot 3', 'wptc_theme_td' ),
                    'id'        => 'pageFooterMetaSlot3',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_post_meta_slot',
                    'choices'   => $page_meta_choices
                )
            )
        ),
        array(
            'title'             => __( 'Heading Tags', 'wptc_theme_td' ),
            'id'                => 'heading_tags_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Site Title Tag (Posts Page)', 'wptc_theme_td' ),
                    'id'        => 'postsSiteTitleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Tagline Tag (Posts Page)', 'wptc_theme_td' ),
                    'id'        => 'postsTaglineTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Article Tag (Posts Page)', 'wptc_theme_td' ),
                    'id'        => 'postsArticleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Widget Title Tag (Posts Page)', 'wptc_theme_td' ),
                    'id'        => 'postsWidgetTitleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Site Title Tag (Single Page)', 'wptc_theme_td' ),
                    'id'        => 'singleSiteTitleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Tagline Tag (Single Page)', 'wptc_theme_td' ),
                    'id'        => 'singleTaglineTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Article Tag (Single Page)', 'wptc_theme_td' ),
                    'id'        => 'singleArticleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                ),
                array(
                    'title'     => __( 'Widget Title Tag (Single Page)', 'wptc_theme_td' ),
                    'id'        => 'singleWidgetTitleTag',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_heading_tag',
                    'choices'   => $heading_tag_choices
                )
            )
        ),
        array(
            'title'             => __( 'Widget Areas', 'wptc_theme_td' ),
            'id'                => 'widget_areas_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Header Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeHeaderWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceHeaderWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'LOGO Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeLOGOWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceLOGOWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'CONTACT Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeCONTACTWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceCONTACTWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'SLOGAN Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeSLOGANWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceSLOGANWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Navigation Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeNavWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceNavWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Page Top Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activePageTopWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearancePageTopWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Content Top Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeContentTopWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceContentTopWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Content Bottom Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeContentBottomWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceContentBottomWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Page Bottom Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activePageBottomWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearancePageBottomWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                ),
                array(
                    'title'     => __( 'Footer Widget Area', 'wptc_theme_td' ),
                    'id'        => 'activeFooterWidgetArea',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Default Appearance', 'wptc_theme_td' ),
                    'id'        => 'appearanceFooterWidgetArea',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_appearance',
                    'choices'   => $appearance_choices
                )
            )
        ),
        array(
            'title'             => __( 'Font Awesome', 'wptc_theme_td' ),
            'id'                => 'font_awesome_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Enable Font Awesome', 'wptc_theme_td' ),
                    'id'        => 'enableFontAwesome',
                    'type'      => 'checkbox'
                )
            )
        ),
        array(
            'title'             => __( 'Home / Archive / Search Pages', 'wptc_theme_td' ),
            'id'                => 'home_archive_search_pages_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Show Post Titles', 'wptc_theme_td' ),
                    'id'        => 'showPostTitles',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Post Meta Headers', 'wptc_theme_td' ),
                    'id'        => 'showPostMetaHeaders',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Post Meta Footers', 'wptc_theme_td' ),
                    'id'        => 'showPostMetaFooters',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Content Read More Text', 'wptc_theme_td' ),
                    'id'        => 'contentReadMoreText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Show Read More as Button', 'wptc_theme_td' ),
                    'id'        => 'readMoreButton',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Excerpts', 'wptc_theme_td' ),
                    'id'        => 'showExcerpts',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Excerpt Length (Words)', 'wptc_theme_td' ),
                    'id'        => 'excerptLength',
                    'type'      => 'text',
                    'sanitize'  => 'absint'
                ),
                array(
                    'title'     => __( 'Excerpt Read More Text', 'wptc_theme_td' ),
                    'id'        => 'excerptReadMoreText',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Link Excerpt Read More to Post', 'wptc_theme_td' ),
                    'id'        => 'excerptReadMoreLink',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Show Featured Image with Excerpt', 'wptc_theme_td' ),
                    'id'        => 'excerptFeaturedImage',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Featured Image Alignment', 'wptc_theme_td' ),
                    'id'        => 'excerptFeaturedImageAlignment',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_fi_alignment',
                    'choices'   => array(
                        'alignnone'     => __( 'None', 'wptc_theme_td' ),
                        'aligncenter'   => __( 'Center', 'wptc_theme_td' ),
                        'alignleft'     => __( 'Left', 'wptc_theme_td' ),
                        'alignright'    => __( 'Right', 'wptc_theme_td' )
                    )
                ),
                array(
                    'title'     => __( 'Featured Image Size', 'wptc_theme_td' ),
                    'id'        => 'excerptFeaturedImageSize',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_fi_size',
                    'choices'   => array(
                        'thumbnail'     => __( 'Thumbnail', 'wptc_theme_td' ),
                        'medium'        => __( 'Medium', 'wptc_theme_td' ),
                        'large'         => __( 'Large', 'wptc_theme_td' ),
                        'full'          => __( 'Full', 'wptc_theme_td' ),
                        'custom'        => __( 'Custom', 'wptc_theme_td' )
                    )
                ),
                array(
                    'title'     => __( 'Custom Size Width (Pixels)', 'wptc_theme_td' ),
                    'id'        => 'excerptFeaturedImageWidth',
                    'type'      => 'text',
                    'sanitize'  => 'absint'
                ),
                array(
                    'title'     => __( 'Custom Size Height (Pixels)', 'wptc_theme_td' ),
                    'id'        => 'excerptFeaturedImageHeight',
                    'type'      => 'text',
                    'sanitize'  => 'absint'
                ),
                array(
                    'title'     => __( 'Show as Grid', 'wptc_theme_td' ),
                    'id'        => 'showAsGrid',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Grid Columns', 'wptc_theme_td' ),
                    'id'        => 'gridColumns',
                    'type'      => 'select',
                    'sanitize'  => 'wptc_customizer_sanitize_grid_columns',
                    'choices'   => array(
                        '2'     => '2',
                        '3'     => '3',
                        '4'     => '4'
                    )
                )
            )
        ),
        array(
            'title'             => __( 'Archive Page Titles', 'wptc_theme_td' ),
            'id'                => 'archive_page_titles_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Category Archive Title', 'wptc_theme_td' ),
                    'id'        => 'categoryArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Tag Archive Title', 'wptc_theme_td' ),
                    'id'        => 'tagArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Day Archive Title', 'wptc_theme_td' ),
                    'id'        => 'dayArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Month Archive Title', 'wptc_theme_td' ),
                    'id'        => 'monthArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Year Archive Title', 'wptc_theme_td' ),
                    'id'        => 'yearArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Search Archive Title', 'wptc_theme_td' ),
                    'id'        => 'searchArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Author Archive Title', 'wptc_theme_td' ),
                    'id'        => 'authorArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Override Post Archive Titles', 'wptc_theme_td' ),
                    'id'        => 'overridePostArchiveTitles',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Post Archive Title', 'wptc_theme_td' ),
                    'id'        => 'postArchivePageTitle',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( 'Default Archive Title', 'wptc_theme_td' ),
                    'id'        => 'defaultArchivePageTitle',
                    'type'      => 'text'
                )
            )
        ),
        array(
            'title'             => __( '404 / Post Not Found Page', 'wptc_theme_td' ),
            'id'                => '404_pnf_page_wptc',
            'controls'          => array(
                array(
                    'title'     => __( '404 / Page Not Found Title', 'wptc_theme_td' ),
                    'id'        => '404Title',
                    'type'      => 'text'
                ),
                array(
                    'title'     => __( '404 / Page Not Found Description', 'wptc_theme_td' ),
                    'id'        => '404Description',
                    'type'      => 'textarea'
                ),
                array(
                    'title'     => __( 'Show Search Form', 'wptc_theme_td' ),
                    'id'        => 'show404Search',
                    'type'      => 'checkbox'
                )
            )
        ),
        array(
            'title'             => __( 'Footer', 'wptc_theme_td' ),
            'id'                => 'footer_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Footer Text', 'wptc_theme_td' ),
                    'id'        => 'footerText',
                    'type'      => 'textarea'
                )
            )
        ),
        array(
            'title'             => __( 'Header/Footer Scripts', 'wptc_theme_td' ),
            'id'                => 'header_footer_scripts_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Header Scripts (Injected before &lt;/head&gt;)', 'wptc_theme_td' ),
                    'id'        => 'headerScripts',
                    'type'      => 'textarea'
                ),
                array(
                    'title'     => __( 'Inject Header Scripts', 'wptc_theme_td' ),
                    'id'        => 'injectHeaderScripts',
                    'type'      => 'checkbox'
                ),
                array(
                    'title'     => __( 'Footer Scripts (Injected before &lt;/body&gt;)', 'wptc_theme_td' ),
                    'id'        => 'footerScripts',
                    'type'      => 'textarea'
                ),
                array(
                    'title'     => __( 'Inject Footer Scripts', 'wptc_theme_td' ),
                    'id'        => 'injectFooterScripts',
                    'type'      => 'checkbox'
                )
            )
        ),
		array(
            'title'             => __( 'Kill Switch - Visual Controls BELOW', 'wptc_theme_td' ),
            'id'                => 'font_control_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Activate ALL the settings for ALL BELOW PANEL SETTINGS - General Page Content, Header/Menu, Block, Footer, and Button Controls', 'wptc_theme_td' ),
                    'id'        => 'qtfontsettings',
                    'type'      => 'checkbox'
                )
            )
        ),
		array(
            'title'             => __( 'General Page Content', 'wptc_theme_td' ),
            'id'                => 'generalpage_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Sheet Color', 'wptc_theme_td' ),
                    'id'        => 'qtsheetcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Content Font Color', 'wptc_theme_td' ),
                    'id'        => 'qtfontcolor',
                    'type'      => 'color'
                ),
                array(
                    'title'     => __( 'Content Font Size ie: 200% or 16px', 'wptc_theme_td' ),
                    'id'        => 'qtfontsize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Apply Font Size To All Links As Well?', 'wptc_theme_td' ),
                    'id'        => 'qtalllinks',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Content Font Line Size ie: 100%, or 30px', 'wptc_theme_td' ),
                    'id'        => 'qtfontlineheight',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Content Link Color', 'wptc_theme_td' ),
                    'id'        => 'qtcontentlinkcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Content Link Hover Color', 'wptc_theme_td' ),
                    'id'        => 'qtcontentlinkhovercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Page/Post Title Font Size ie 26px', 'wptc_theme_td' ),
                    'id'        => 'qttitlesize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Page/Post Title Line Height ie 26px, or 100%', 'wptc_theme_td' ),
                    'id'        => 'qttitlelineheight',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Page/Post Title Font Color', 'wptc_theme_td' ),
                    'id'        => 'qttitlecolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Post Archive Title Font Size ie 26px', 'wptc_theme_td' ),
                    'id'        => 'qtarchivetitlesize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Post Archive Title Line Height ie 26px, or 100%', 'wptc_theme_td' ),
                    'id'        => 'qtarchivelineheight',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Post Archive Title Link Color', 'wptc_theme_td' ),
                    'id'        => 'qtposttitlelink',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Post Archive Title Hover Link Color', 'wptc_theme_td' ),
                    'id'        => 'qtposttitlehover',
                    'type'      => 'color'
                )
            )
        ),
		array(
            'title'             => __( 'Header / Menu Controls', 'wptc_theme_td' ),
            'id'                => 'headercontrols_wptc',
            'controls'          => array(
			   array(
                    'title'     => __( 'Menu Bar Color', 'wptc_theme_td' ),
                    'id'        => 'qtnavcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Hide Header On Homepage?', 'wptc_theme_td' ),
                    'id'        => 'qthidehomeheader',
                    'type'      => 'checkbox'
                ),
               array(
                    'title'     => __( 'Apply Header Color?', 'wptc_theme_td' ),
                    'id'        => 'qtapplyheadercolor',
                    'type'      => 'checkbox'
                ),
				array(
                    'title'     => __( 'Header Color', 'wptc_theme_td' ),
                    'id'        => 'qtheadercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Headline Color', 'wptc_theme_td' ),
                    'id'        => 'qtheadlinecolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Headline Hover Color', 'wptc_theme_td' ),
                    'id'        => 'qtheadlinehover',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Headline Size', 'wptc_theme_td' ),
                    'id'        => 'qtheadlinesize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Headline Relative Vertical Position', 'wptc_theme_td' ),
                    'id'        => 'qtheadlinevposition',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Slogan Color', 'wptc_theme_td' ),
                    'id'        => 'qtslogan',
                    'type'      => 'color'
                )  
            )
        ),
		array(
            'title'             => __( 'Block Controls', 'wptc_theme_td' ),
            'id'                => 'blockcontrols_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Block Header Title Color', 'wptc_theme_td' ),
                    'id'        => 'qtblockheadercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Block Header Title Size', 'wptc_theme_td' ),
                    'id'        => 'qtblockheadersize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Block Content Link Color', 'wptc_theme_td' ),
                    'id'        => 'qtblockcontentlinkcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Block Content Link Size', 'wptc_theme_td' ),
                    'id'        => 'qtblockcontentlinksize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Block Content Link Hover Color', 'wptc_theme_td' ),
                    'id'        => 'qtblockcontentlinkhover',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Block Content List Text Color', 'wptc_theme_td' ),
                    'id'        => 'qtblocklisttextcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Block Content List Text Size', 'wptc_theme_td' ),
                    'id'        => 'qtblocklisttextsize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Block Content Text Color', 'wptc_theme_td' ),
                    'id'        => 'qtblockcontenttextcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Block Content Text Size', 'wptc_theme_td' ),
                    'id'        => 'qtblockcontenttextsize',
                    'type'      => 'text'
                )
            )				
         ),
		 array(
            'title'             => __( 'Footer Controls', 'wptc_theme_td' ),
            'id'                => 'footercontrols_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Footer Color', 'wptc_theme_td' ),
                    'id'        => 'qtfootercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Footer Widget Title Color', 'wptc_theme_td' ),
                    'id'        => 'qtfootertitlecolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Footer Widget Title Size ie: 30px', 'wptc_theme_td' ),
                    'id'        => 'qtfottertitlesize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Footer Content Text Color', 'wptc_theme_td' ),
                    'id'        => 'qtfootertextcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Footer Content Link Color', 'wptc_theme_td' ),
                    'id'        => 'qtfootercontentlink',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Footer Content Link Hover Color', 'wptc_theme_td' ),
                    'id'        => 'qtfootercontentlinkhover',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Footer Widget List Item Text', 'wptc_theme_td' ),
                    'id'        => 'qtfooterlistcolor',
                    'type'      => 'color'
                )
            )				
         ),
		array(
            'title'             => __( 'Button Controls', 'wptc_theme_td' ),
            'id'                => 'buttoncontrols_wptc',
            'controls'          => array(
                array(
                    'title'     => __( 'Theme Button Size ie: 30px', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonsize',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Theme Button Padding ie: 10px', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonpadding',
                    'type'      => 'text'
                ),
				array(
                    'title'     => __( 'Theme Button Font Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttoncolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Theme Button Background Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonbackcolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Theme Button Hover Font Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonhovercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Theme Button Hover Background Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonhoverback',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Theme Button Border Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonbordercolor',
                    'type'      => 'color'
                ),
				array(
                    'title'     => __( 'Theme Button Hover Border Color', 'wptc_theme_td' ),
                    'id'        => 'qtbuttonborderhovercolor',
                    'type'      => 'color'
                )
            )				
         ),
    );
    $customizer = apply_filters( 'wptc_customizer', $customizer );

    class WPTC_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

    $section_count = 201;
    foreach ( $customizer as $section ) :

        $sections_get = $wp_customize->sections();
        if ( empty( $sections_get[$section['id']] ) ) :
            $wp_customize->add_section( $section['id'], array(
                'title'         => $section['title'],
                'priority'      => $section_count,
            ) );
            $section_count++;
        endif;

        $control_count = 101;
        if ( isset( $section['controls'] ) )
        foreach ( $section['controls'] as $control ) :

            $wp_customize->add_setting( 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']', array(
                'default'           => $wptc_theme_display_defaults[$control['id']],
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => isset( $control['sanitize'] ) ? $control['sanitize'] : 'wptc_customizer_sanitize_' . $control['type'],
            ) );

            switch( $control['type'] ) :
                case 'checkbox' :
                case 'text' :
                    $wp_customize->add_control( 'wptc_theme_options_' . $control['id'], array(
                        'settings'      => 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']',
                        'label'         => $control['title'],
                        'section'       => $section['id'],
                        'type'          => $control['type'],
                        'priority'      => $control_count,
                    ) );
                    break;
                case 'select' :
                case 'radio' :
                    $wp_customize->add_control( 'wptc_theme_options_' . $control['id'], array(
                        'settings'      => 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']',
                        'label'         => $control['title'],
                        'section'       => $section['id'],
                        'type'          => $control['type'],
                        'priority'      => $control_count,
                        'choices'       => $control['choices'],
                    ) );
                    break;
                case 'image' :
                    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wptc_theme_options_' . $control['id'], array(
                        'settings'      => 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']',
                        'label'         => $control['title'],
                        'section'       => $section['id'],
                        'priority'      => $control_count,
                    ) ) );
                    break;
                case 'color' :
                    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wptc_theme_options_' . $control['id'], array(
                        'settings'      => 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']',
                        'label'         => $control['title'],
                        'section'       => $section['id'],
                        'priority'      => $control_count,
                    ) ) );
                    break;
                case 'textarea' :
                    $wp_customize->add_control( new WPTC_Customize_Textarea_Control( $wp_customize, 'wptc_theme_options_' . $control['id'], array(
                        'settings'      => 'wptc_theme_options' . WPTC_THEME_NAME_KEY . '[' . $control['id'] . ']',
                        'label'         => $control['title'],
                        'section'       => $section['id'],
                        'priority'      => $control_count,
                    ) ) );
            endswitch;
            $control_count++;

        endforeach;

    endforeach;
}
add_action( 'customize_register', 'do_theme_customize_register' );

/* Sanitize checkbox */
function wptc_customizer_sanitize_checkbox( $input ) {
    if ( $input == 1 ) :
        return 1;
    else :
        return '';
    endif;
}

/* Sanitize text */
function wptc_customizer_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/* Sanitize textarea */
function wptc_customizer_sanitize_textarea( $input ) {
    if ( current_user_can( 'unfiltered_html' ) )
	return $input;
    else
	return stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
}

/* Sanitize Site Protection */
function wptc_customizer_siteprotect( $input ) {
    $valid = array(
        'nopass'      => 'Select',
        'protect'     => 'Protect',
        'maintain'    => 'Maintenance Mode'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'nopass';
    endif;
}

/* Sanitize image */
function wptc_customizer_sanitize_image( $input ) {
    return esc_url_raw( $input );
}

/* Sanitize color */
function wptc_customizer_sanitize_color( $input ) {
    return sanitize_hex_color( $input );
}

/* Sanitize select */
function tuz_customizer_sanitize_select( $input ) {
    return $input;
}

/* Sanitize radio */
function tuz_customizer_sanitize_radio( $input ) {
    return $input;
}

/* Sanitize heading tag */
function wptc_customizer_sanitize_heading_tag( $input ) {
    $valid = array(
        'h1'    => '&lt;H1&gt;',
        'h2'    => '&lt;H2&gt;',
        'h3'    => '&lt;H3&gt;',
        'h4'    => '&lt;H4&gt;',
        'h5'    => '&lt;H5&gt;',
        'h6'    => '&lt;H6&gt;',
        'div'   => '&lt;DIV&gt;'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'div';
    endif;
}

/* Sanitize appearance */
function wptc_customizer_sanitize_appearance( $input ) {
    $valid = array(
        'block' => 'Block',
        'post'  => 'Post',
        'text'  => 'Simple Text'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'block';
    endif;
}

/* Sanitize featured image alignment */
function wptc_customizer_sanitize_fi_alignment( $input ) {
    $valid = array(
        'alignnone'     => 'None',
        'aligncenter'   => 'Center',
        'alignleft'     => 'Left',
        'alignright'    => 'Right'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'alignnone';
    endif;
}

/* Sanitize featured image size */
function wptc_customizer_sanitize_fi_size( $input ) {
    $valid = array(
        'thumbnail'     => 'Thumbnail',
        'medium'        => 'Medium',
        'large'         => 'Large',
        'full'          => 'Full',
        'custom'        => 'Custom'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'thumbnail';
    endif;
}

/* Sanitize grid columns */
function wptc_customizer_sanitize_post_meta_slot( $input ) {
    $valid = array(
        'none'          => 'None',
        'author'        => 'Author',
        'categories'    => 'Categories',
        'comments'      => 'Comments',
        'date'          => 'Date',
        'tags'          => 'Tags'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'none';
    endif;
}

/* Sanitize grid columns */
function wptc_customizer_sanitize_grid_columns( $input ) {
    $valid = array(
        '2'     => '2',
        '3'     => '3',
        '4'     => '4'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return '2';
    endif;
}

/* Sanitize responsive menu alignment */
function wptc_customizer_sanitize_resp_menu_align( $input ) {
    $valid = array(
        'left'     => 'Left',
        'center'   => 'Center',
        'right'    => 'Right'
    );
    if ( array_key_exists( $input, $valid ) ) :
        return $input;
    else :
        return 'center';
    endif;
}

?>
