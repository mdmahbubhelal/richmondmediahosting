<?php /* The template for displaying comments */
if ( post_password_required() || ( !comments_open() && get_comments_number() < 1 ) )
	return;
?>

<div id="comments" class="postcontent comments">

	<?php if ( have_comments() ) : ?>
		<?php
			// Are there comments to navigate through?
			$numcompages = get_comment_pages_count();
			if ( $numcompages > 1 && get_option( 'page_comments' ) ) :
			global $cpage;
		?>
		<div class="pager">
			<?php previous_comments_link( __( '&laquo; Previous Comments', 'wptc_theme_td' ) ); ?><span class="active"><?php printf( __( 'Comment Page: %1$s of %2$s', 'wptc_theme_td' ), $cpage, $numcompages ); ?></span><?php next_comments_link( __( 'Next Comments &raquo;', 'wptc_theme_td' ) ); ?>
		</div>
		<?php endif; ?>
		<h2 class="postheader comments">
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'wptc_theme_td' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<div id="comments-list">
			<?php
				wp_list_comments( array(
					'style' => 'div',
					'short_ping' => true,
					'avatar_size' => 80,
					'reply_text' => __( 'Reply', 'wptc_theme_td' ),
					'login_text' => __( 'Log in to Reply', 'wptc_theme_td' ),
					'callback' => 'wptc_comment',
					'end-callback' => 'wptc_comment_end',
				) );
			?>
		</div>

		<?php
			// Are there comments to navigate through?
			if ( $numcompages > 1 && get_option( 'page_comments' ) ) :
		?>
		<div class="pager">
			<?php previous_comments_link( __( '&laquo; Previous Comments', 'wptc_theme_td' ) ); ?><span class="active"><?php printf( __( 'Comment Page: %1$s of %2$s', 'wptc_theme_td' ), $cpage, $numcompages ); ?></span><?php next_comments_link( __( 'Next Comments &raquo;', 'wptc_theme_td' ) ); ?>
		</div>
		<?php endif; ?>

		<?php if ( !comments_open() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'wptc_theme_td' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	<div class="commentsform">
		<?php comment_form(); ?>
	</div>

</div>
