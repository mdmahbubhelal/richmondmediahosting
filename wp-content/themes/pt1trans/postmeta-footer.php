<?php /* postmeta-footer.php * Post Footer Meta */
global $theme_display_options;
if ( is_page() && !$theme_display_options['showPostFooterMetaonPages'] )
    return;
if ( $theme_display_options['postFooterMetaSlot1'] == 'none' && $theme_display_options['postFooterMetaSlot2'] == 'none' && $theme_display_options['postFooterMetaSlot3'] == 'none' && $theme_display_options['postFooterMetaSlot4'] == 'none' && $theme_display_options['postFooterMetaSlot5'] == 'none' )
    return; ?>
<!-- Begin postmeta-footer.php -->
<div class="postmetadatafooter"><div class="postfootericons metadata-icons">
<?php wptc_post_meta_output( 'Footer' ); ?>
</div></div>
<!-- End postmeta-footer.php -->
