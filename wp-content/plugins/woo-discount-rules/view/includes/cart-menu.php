<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly ?>
<?php
$proText = $purchase->getProText();
?>
<i><h2>Woo Discount Rules <?php echo $proText; ?> <span class="woo-discount-version">v<?php echo WOO_DISCOUNT_VERSION; ?></span></h2></i>
<hr>
<h3 class="nav-tab-wrapper">
    <a class="nav-tab" href=javascript:void(0) id="cart_general_tab">
        <i class="fa fa-tags" style="font-size: 0.8em;"></i> &nbsp;General </a>
    <a class="nav-tab" href=javascript:void(0) id="cart_restriction_tab">
        <i class="fa fa-shopping-cart" style="font-size: 0.8em;"></i> &nbsp;Conditions </a>
    <a class="nav-tab" href=javascript:void(0) id="cart_discount_tab" >
        <i class="fa fa-cogs" style="font-size: 0.8em;"></i> &nbsp;Discount </a>
</h3>
