<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Plugin Directory.
 */
define('WOO_DISCOUNT_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

/**
 * Plugin Directory URI.
 */
define('WOO_DISCOUNT_URI', untrailingslashit(plugin_dir_url(__FILE__)));

/**
 * Plugin Base Name.
 */
define('WOO_DISCOUNT_PLUGIN_BASENAME', plugin_basename(__FILE__));

if(!function_exists('get_plugin_data')){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

/**
 * Version of Woo Discount Rules.
 */
$pluginDetails = get_plugin_data(plugin_dir_path(__FILE__).'woo-discount-rules.php');
define('WOO_DISCOUNT_VERSION', $pluginDetails['Version']);

if(!class_exists('FlycartWooDiscountRules')){
    class FlycartWooDiscountRules{

        private static $instance;
        public $discountBase;
        public $pricingRules;

        /**
         * To run the plugin
         * */
        public static function init() {
            if ( self::$instance == null ) {
                self::$instance = new FlycartWooDiscountRules();
            }
            return self::$instance;
        }

        /**
         * FlycartWooDiscountRules constructor
         * */
        public function __construct() {
            $this->includeFiles();
            $this->runUpdater();
            $this->discountBase = new FlycartWooDiscountBase();
            $this->pricingRules = new FlycartWooDiscountRulesPricingRules();
            if (is_admin()) {
                $this->loadAdminScripts();
            } else {
                $this->loadSiteScripts();
            }
        }

        /**
         * To include Files
         * */
        protected function includeFiles(){
            include_once('helper/woo-function.php');
            include_once('includes/pricing-rules.php');
            include_once('helper/general-helper.php');
            include_once('includes/cart-rules.php');
            include_once('includes/discount-base.php');
            include_once('helper/purchase.php');
            require_once __DIR__ . '/vendor/autoload.php';
        }

        /**
         * Run Plugin updater
         * */
        protected function runUpdater(){
            try{
                require plugin_dir_path( __FILE__ ).'/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';

                $purchase_helper = new FlycartWooDiscountRulesPurchase();
                $purchase_helper->init();
                $update_url = $purchase_helper->getUpdateURL();

                $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
                    $update_url,
                    plugin_dir_path( __FILE__ ).'woo-discount-rules.php',
                    'woo-discount-rules'
                );
                add_action( 'after_plugin_row', array($purchase_helper, 'woodisc_after_plugin_row'),10,3 );

                add_action('wp_ajax_forceValidateLicenseKey', array($purchase_helper, 'forceValidateLicenseKey'));

                add_action( 'admin_notices', array($purchase_helper, 'errorNoticeInAdminPages'));
            } catch (Exception $e){}
        }

        /**
         * Load Admin scripts
         * */
        protected function loadAdminScripts(){
            // Init in Admin Menu
            add_action('admin_menu', array($this->discountBase, 'adminMenu'));
            add_action('wp_ajax_savePriceRule', array($this->discountBase, 'savePriceRule'));
            add_action('wp_ajax_saveCartRule', array($this->discountBase, 'saveCartRule'));
            add_action('wp_ajax_saveConfig', array($this->discountBase, 'saveConfig'));

            add_action('wp_ajax_UpdateStatus', array($this->discountBase, 'updateStatus'));
            add_action('wp_ajax_RemoveRule', array($this->discountBase, 'removeRule'));
        }

        /**
         * Load Admin scripts
         * */
        protected function loadSiteScripts(){
            $postData = \FlycartInput\FInput::getInstance();
            // Handling Tight update with wooCommerce Changes.
            $empty_add_to_cart = $postData->get('add-to-cart');
            $empty_apply_coupon = $postData->get('apply_coupon');
            $empty_update_cart = $postData->get('update_cart');
            $empty_proceed = $postData->get('proceed');
            if ((!empty($empty_add_to_cart) && is_numeric($postData->get('add-to-cart'))) || $postData->get('action', false) == 'woocommerce_add_to_cart') {

            } else if (!empty($empty_apply_coupon) || !empty($empty_update_cart) || !empty($empty_proceed)) {
                add_action('woocommerce_after_cart_item_quantity_update', array($this->discountBase, 'handleDiscount'), 100);
            } else {
                add_action('woocommerce_cart_loaded_from_session', array($this->discountBase, 'handleDiscount'), 100);
            }

            // Manually Update Line Item Name.
            add_filter('woocommerce_cart_item_name', array($this->discountBase, 'modifyName'));

            // Remove Filter to make the previous one as last filter.
            remove_filter('woocommerce_cart_item_name', 'filter_woocommerce_cart_item_name', 10, 3);

            // Alter the Display Price HTML.
            add_filter('woocommerce_cart_item_price', array($this->pricingRules, 'replaceVisiblePricesCart'), 100, 3);

            //replace visible price in product page
            add_filter('woocommerce_get_price_html', array($this->pricingRules, 'replaceVisiblePrices'), 100, 3);
            //replace visible price in product page for variant
            add_filter('woocommerce_available_variation', array($this->pricingRules, 'replaceVisiblePricesForVariant'), 100, 3);


            // Older Version support this hook.
            add_filter('woocommerce_cart_item_price_html', array($this->pricingRules, 'replaceVisiblePricesCart'), 100, 3);

            // Pricing Table of Individual Product.
            add_filter('woocommerce_before_add_to_cart_form', array($this->pricingRules, 'priceTable'));

            // Updating Log After Creating Order
            add_action('woocommerce_thankyou', array($this->discountBase, 'storeLog'));

            add_action( 'woocommerce_after_checkout_form', array($this->discountBase, 'addScriptInCheckoutPage'));

            //To enable on-sale tag
            add_filter('woocommerce_product_is_on_sale', array($this->pricingRules, 'displayProductIsOnSaleTag'), 10, 2);
        }
    }
}

/**
 * init Woo Discount Rules
 */
FlycartWooDiscountRules::init();