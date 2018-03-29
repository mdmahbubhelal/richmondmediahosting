<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination">

	<?php bbp_forum_pagination_count(); ?>

	<div class="pager">
		<?php echo str_replace( array( 'current', 'dots' ), array( 'current active ', 'dots more ' ), bbp_get_forum_pagination_links() ); ?>
	</div>

</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
