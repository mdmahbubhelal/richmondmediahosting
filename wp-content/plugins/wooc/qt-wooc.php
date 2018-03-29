<?php
/*
Plugin Name: QTWooc
Plugin URI: http://www.quickerthemes.com
Description: Woocommerce Recommended Plugins By Quicker Themes
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

add_action( 'tgmpa_register', 'qtwooc_register_required_plugins' );

function qtwooc_register_required_plugins() {

	
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
	  
	        array(
			'name' 		=> 'WooCommerce Shortcodes',
			'slug' 		=> 'woocommerce-shortcodes',
			'required' 	=> false,
		),
			array(
			'name' 		=> 'WooCommerce External Product New Tab',
			'slug' 		=> 'wc-external-product-new-tab',
			'required' 	=> false,
		),
			array(
			'name' 		=> 'WC Product Tabs Plus',
			'slug' 		=> 'wc-product-tabs-plus',
			'required' 	=> false,
		),
			array(
			'name' 		=> 'WooCommerce - excelling eCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),
		    array(
			'name' 		=> 'Woocommerce Menu Cart',
			'slug' 		=> 'woocommerce-menu-bar-cart',
			'required' 	=> false,
		),
			array(
			'name' 		=> 'Price by User Role for WooCommerce',
			'slug' 		=> 'price-by-user-role-for-woocommerce',
			'required' 	=> false,
		),
	        array(
			'name' 		=> 'WC Vendors',
			'slug' 		=> 'wc-vendors',
			'required' 	=> false,
		),
		    array(
            'name'               => 'grant-download-permissions-for-past-woocommerce-orders-master', // The plugin name.
            'slug'               => 'grant-download-permissions-for-past-woocommerce-orders-master', // The plugin slug (typically the folder name).
            'source'             => 'http://www.quickerthemes.com/qtplugins/grant-download-permissions-for-past-woocommerce-orders-master.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		    array(
			'name' 		=> 'Sale Counter',
			'slug' 		=> 'sale-counter',
			'required' 	=> false,
		),
		    array(
			'name' 		=> 'WooCommerce Digital Goods Checkout',
			'slug' 		=> 'wc-digital-goods-checkout',
			'required' 	=> false,
		),
		    array(
			'name' 		=> 'WooCommerce Personal Discount',
			'slug' 		=> 'woo-personal-discount',
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