<?php
/**
 * Tuxedo Theme Updater
 * Enable theme updating through standard WordPress updater.
 */

/* REPLACE THIS ENTIRE LINE WITH THE CODE WITH THE SERVER'S ADDRESS. GET THIS INFO FROM THE TUX UPDATE PLUGIN */

add_filter( 'site_transient_update_themes', 'tuxedo_check_update' );
add_filter( 'transient_update_themes', 'tuxedo_check_update' );
/**
 * Check for updates.
 */
function tuxedo_check_update( $value ) {

	global $wp_version;
	global $from;
	$from = get_site_url();

	if ( defined( 'DISALLOW_FILE_MODS' ) && true == DISALLOW_FILE_MODS )
		return $value;

	$theme_slug = get_stylesheet();
	if ( empty( $theme_slug ) ) {
		return $value;
	}
	if ( isset ( $value->response[$theme_slug] ) ) {
		unset( $value->response[$theme_slug] );
	}

	$current_theme = wp_get_theme();
	$update_info = get_transient( $theme_slug . '-update-info' );

	if ( ! $update_info ) {

		$response = wp_remote_get( THEME_UPDATE_INFO_URL, array( 'user-agent' => 'WordPress/' . $wp_version . '' . $from . ';' ) );
		if ( ! is_wp_error( $response ) ) {
			$response_body = wp_remote_retrieve_body( $response );
			if ( ! is_wp_error( $response_body ) ) {
				$update_info = json_decode( $response_body, true );
			}
		}

		if ( ! isset( $update_info['new_version'], $update_info['package'] ) ) {
			set_transient( $theme_slug . '-update-info', array( 'new_version' => $current_theme->get( 'Version' ) ), HOUR_IN_SECONDS );
			return $value;
		}

		set_transient( $theme_slug . '-update-info', $update_info, 12 * HOUR_IN_SECONDS );

	}

	if ( version_compare( $current_theme->get( 'Version' ), $update_info['new_version'], '>=' ) ) {
		return $value;
	}

	$value->response[$theme_slug] = $update_info;

	return $value;

}

add_action( 'load-update-core.php', 'tuxedo_force_update_check' );
add_action( 'load-themes.php', 'tuxedo_force_update_check' );
/**
 * Force update check to remote server when on theme/update admin pages.
 */
function tuxedo_force_update_check() {

	$theme_slug = get_stylesheet();
	delete_transient( $theme_slug . '-update-info' );

}