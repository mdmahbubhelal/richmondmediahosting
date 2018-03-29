<form class="search" method="get" name="searchform" action="<?php echo home_url(); ?>/">
	<input name="s" type="text" value="<?php echo esc_attr(get_search_query()); ?>" />
	<input class="search-button" type="submit" value="<?php _e( 'Search', 'wptc_theme_td' ); ?>" />
</form>
