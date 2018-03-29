/* Back to top script */
jQuery(document).ready(function () {
    var offset = 200;
    var duration = 500;
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({ scrollTop: 0 }, duration);
        return false;
    });
});
/* Back to top script end */
/* More Less Script */
jQuery('.wptc-content').addClass('wptc-content-hide')
jQuery('.wptc-show, .wptc-hide').removeClass('wptc-content-hide')
jQuery('.wptc-show').on('click', function(e) {
  jQuery(this).next('.wptc-content').removeClass('wptc-content-hide');
  jQuery(this).addClass('wptc-content-hide');
  e.preventDefault();
});
jQuery('.wptc-hide').on('click', function(e) {
  var wptc = jQuery(this).parent('.wptc-content');
  wptc.addClass('wptc-content-hide');
  wptc.prev('.wptc-show').removeClass('wptc-content-hide');
  e.preventDefault();
});
/* Initialize wow script */
new WOW().init();