<?php /* bbPress Support v2.5+ */

/* bbPress search form */
function tux_bbpress_search_form() {
    if ( bbp_allow_search() ) : ?>

		<div class="bbp-search-form">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		</div>

    <?php endif;
}
add_action( 'bbp_template_before_single_forum', 'wptc_bbpress_search_form' );
add_action( 'bbp_template_before_single_topic', 'wptc_bbpress_search_form' );
add_action( 'bbp_template_before_single_reply', 'wptc_bbpress_search_form' );
add_action( 'bbp_template_before_user_details', 'wptc_bbpress_search_form' );

?>
