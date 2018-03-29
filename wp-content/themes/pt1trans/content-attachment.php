<!-- Begin content-single.php -->
<?php /* content-single.php * Single Content Loop */
global $theme_display_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<<?php echo $theme_display_options['singleArticleTag']; ?> class="postheader entry-title">
    <span class="postheadericon">
        <?php the_title(); ?>
    </span>
</<?php echo $theme_display_options['singleArticleTag']; ?>>



<div class="postcontent postcontent-<?php the_ID(); ?> entry-content clearfix">
<?php if ( wp_attachment_is_image() ) :
    $attachments = array_values( get_children( array(
                        'post_parent'       => $post->post_parent,
                        'post_status'       => 'inherit',
                        'post_type'         => 'attachment',
                        'post_mime_type'    => 'image',
                        'order'             => 'ASC',
                        'orderby'           => 'menu_order ID'
                    ) ) );
    foreach ( $attachments as $k => $attachment ) :
        if ( $attachment->ID == $post->ID ) break;
    endforeach;
    $k++;
    $next_attachment_url = '';
    /* If there is more than 1 image attachment in a gallery */
    if ( count( $attachments ) > 1 ) :
        if ( isset( $attachments[$k] ) ) :
            /* get the URL of the next image attachment */
	    $next_attachment_url = get_attachment_link( $attachments[$k]->ID );
	else :
            /* or get the URL of the first image attachment */
	    $next_attachment_url = get_attachment_link( $attachments[0]->ID );
        endif;
    else :
	/* or, if there's only 1 image attachment, get the URL of the image */
	$next_attachment_url = wp_get_attachment_url();
    endif; ?>
    <p class="attachment center">
	<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( strip_tags( get_the_title() ) ); ?>" rel="attachment">
	<?php $attachment_size = apply_filters( 'attachment_size', 600 );
	echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
	?>
	</a>
    </p>
    <p>
        <?php if ( has_excerpt() ) :
	    the_excerpt();
        endif; ?>
    </p>
<?php else : ?>
    <p class="attachment center">
	<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( strip_tags( get_the_title() ) ); ?>" rel="attachment">
	<?php echo basename( get_permalink() ); ?>
	</a>
    </p>
<?php endif;
if ( !empty( $post->post_content ) ) :
    the_content();
    get_template_part( 'nav', 'postpager' );
endif; ?>
</div>
</article>
<!-- End content-single.php -->
