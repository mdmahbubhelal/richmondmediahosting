<!-- Begin nav-postpager.php -->
<?php /* nav-postpager.php * Post Pagination <!--nextpage--> */
global $page, $numpages;
if ( $numpages > 1 ) :
    echo '<div class="pager">' . ( $page == 1 ? '<span class="active">' . sprintf( __( 'Page: %1$s of %2$s', 'wptc_theme_td' ), $page, $numpages ) . '</span>' : '' ) .
	  str_replace( '</a> <a', '</a><span class="active">' . sprintf( __( 'Page: %1$s of %2$s', 'wptc_theme_td' ), $page, $numpages ) . '</span><a', wp_link_pages( array(
                       'before' => '',
		       'after' => '',
		       'next_or_number' => 'next',
		       'previouspagelink' => __( '&laquo; Previous', 'wptc_theme_td' ),
		       'nextpagelink' => __( 'Next &raquo;', 'wptc_theme_td' ),
		       'echo' => false
                    ) ) ) . ( $page == $numpages ? '<span class="active">' . sprintf( __( 'Page: %1$s of %2$s', 'wptc_theme_td' ), $page, $numpages ) . '</span>' : '' ) . '</div>';
endif;
?>
<!-- End nav-postpager.php -->
