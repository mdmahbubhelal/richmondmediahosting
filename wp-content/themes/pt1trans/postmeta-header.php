<?php /* postmeta-header.php * Post Header Meta */
global $theme_display_options;
if ( $theme_display_options['postHeaderMetaSlot1'] == 'none' && $theme_display_options['postHeaderMetaSlot2'] == 'none' && $theme_display_options['postHeaderMetaSlot3'] == 'none' && $theme_display_options['postHeaderMetaSlot4'] == 'none' && $theme_display_options['postHeaderMetaSlot5'] == 'none' )
    return; ?>
<!-- Begin postmeta-header.php -->
<div class="postheadericons metadata-icons">
<?php wptc_post_meta_output( 'Header' ); ?>
</div>
<!-- End postmeta-header.php -->
