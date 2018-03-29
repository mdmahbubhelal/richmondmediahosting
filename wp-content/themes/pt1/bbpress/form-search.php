<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" class="search" name="searchform" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search Forums', 'wptc_theme_td' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input tabindex="<?php bbp_tab_index(); ?>" type="text" placeholder="<?php esc_attr_e( 'Search Forums', 'wptc_theme_td' ); ?>" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="search-button" type="submit" id="bbp_search_submit" value="<?php esc_attr_e( 'Search Forums', 'wptc_theme_td' ); ?>" />
	</div>
</form>
