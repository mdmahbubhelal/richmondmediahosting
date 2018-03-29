<!-- Begin footer.php -->
<?php global $theme_display_options, $post_theme_display_options; ?>

            </div>
    </div>
<footer class="footer"><div class="footer-inner">
<?php get_sidebar( 'footer' ); ?>
<?php if ( !empty( $theme_display_options['footerText'] ) ) : ?>
    <div class="clearfix"> </div>
    <div class="footer-text">
    <?php echo do_shortcode( $theme_display_options['footerText'] ); ?>
    </div>
<?php endif; ?>
</div></footer>

</div>



<div class="totopshow">
<a class="back-to-top" href="#" style="display: block;"></a>
</div>
<div id="wp-footer">
    <?php wp_footer(); ?>
    <!-- <?php echo get_num_queries() . ' queries. ' . timer_stop( 0, 3 ) . ' seconds.'; ?> -->
</div>
<?php if ( $theme_display_options['showVisitorRespSwitch'] ) :
if ( isset( $_SESSION['showmobileresp'] ) )
if ( $_SESSION['showmobileresp'] == 'yes' ) : ?>
<a href="?showmobileresp=no" style="text-decoration:none;"><div class="respswitch desktop-no-show" style="background-color:<?php echo $theme_display_options['switchBackgroundColor']; ?>; color:<?php echo $theme_display_options['switchTextColor']; ?>;"><?php _e( 'View Desktop Site', 'wptc_theme_td' ); ?></div></a>
<?php elseif ( $_SESSION['showmobileresp'] == 'no' ) : ?>
<a href="?showmobileresp=yes" style="text-decoration:none;"><div class="respswitch" style="background-color:<?php echo $theme_display_options['switchBackgroundColor']; ?>; color:<?php echo $theme_display_options['switchTextColor']; ?>;"><?php _e( 'View Mobile Site', 'wptc_theme_td' ); ?></div></a>
<?php endif;
endif; ?>
<?php include_once 'inc/footerScripts.php'; ?>
</body>
<!-- End footer.php -->
</html>
