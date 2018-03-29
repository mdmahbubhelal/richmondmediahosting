<?php
/*
Plugin Name: QTMisc
Plugin URI: http://www.quickerthemes.com
Description: Security Recommended Plugins By Quicker Themes
Author: Quicker Themes
Version: 1.0
Author URI: http://www.quickerthemes.com
License: GPLv3

  Copyright 2016 Quicker Themes

  Licenced under the GNU GPL:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 *  Start Plugin Activation
 */

add_action( 'tgmpa_register', 'qtmisc_register_required_plugins' );

function qtmisc_register_required_plugins() {

	
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
	  
	     array(
            'name'               => 'QT CSS', // The plugin name.
            'slug'               => 'qt-css', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/qt-css.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		 array(
			'name' 		=> 'WP Media Categories',
			'slug' 		=> 'wp-media-categories',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Featured Image Generator',
			'slug' 		=> 'featured-image-generator',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Download Plugins and Themes from Dashboard',
			'slug' 		=> 'download-plugins-dashboard',
			'required' 	=> false,
		),
		 array(
			'name' 		=> 'Event CLNDR',
			'slug' 		=> 'event-clndr',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Fonto - Web Fonts Manager',
			'slug' 		=> 'fonto',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WD Google Maps',
			'slug' 		=> 'wd-google-maps',
			'required' 	=> false,
		),
		 array(
			'name' 		=> 'Shortcoder',
			'slug' 		=> 'shortcoder',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'TablePress',
			'slug' 		=> 'tablepress',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WP Simple Related Posts',
			'slug' 		=> 'wp-simple-related-posts',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Nino Social Connect',
			'slug' 		=> 'nino-social-connect',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WP Canvas - Gallery',
			'slug' 		=> 'wc-gallery',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Nav Menu Roles',
			'slug' 		=> 'nav-menu-roles',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Easy Google Fonts',
			'slug' 		=> 'easy-google-fonts',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Page scroll to id',
			'slug' 		=> 'page-scroll-to-id',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Yoast SEO',
			'slug' 		=> 'wordpress-seo',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Hide Show Comment',
			'slug' 		=> 'hide-show-comment',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Inline Related Posts',
			'slug' 		=> 'intelly-related-posts',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'My Rules - The Front-End Access Manager',
			'slug' 		=> 'my-rules',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Broken Link Checker',
			'slug' 		=> 'broken-link-checker',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Code Snippets',
			'slug' 		=> 'code-snippets',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Highlight Search Terms',
			'slug' 		=> 'highlight-search-terms',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Asgaros Forum',
			'slug' 		=> 'asgaros-forum',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'ResponsiveVoice Text To Speech',
			'slug' 		=> 'responsivevoice-text-to-speech',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Image Effect CK',
			'slug' 		=> 'image-effect-ck',
			'required' 	=> false,
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

?>