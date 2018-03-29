<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
include_once(WOO_DISCOUNT_DIR . '/helper/general-helper.php');
include_once(WOO_DISCOUNT_DIR . '/includes/pricing-productbased.php');

/**
 * Class FlycartWooDiscountRulesPricingRules
 */
if (!class_exists('FlycartWooDiscountRulesPricingRules')) {
    class FlycartWooDiscountRulesPricingRules
    {
        /**
         * @var string
         */
        private $option_name = 'woo_discount_price_option';

        /**
         * @var string
         */
        public $post_type = 'woo_discount';

        /**
         * @var bool
         */
        public $discount_applied = false;

        /**
         * @var
         */
        private $rules;

        /**
         * @var
         */
        public $rule_sets;

        /**
         * @var
         */
        public $matched_sets;

        /**
         * @var
         */
        public $baseConfig;

        /**
         * @var
         */
        public $apply_to;

        /**
         * @var string
         */
        public $default_option = 'woo-discount-config';

        public $postData;

        public static $rules_loaded = 0;
        public static $pricingRules;

        /**
         * FlycartWooDiscountRulesPricingRules constructor.
         */
        public function __construct()
        {
            $this->updateBaseConfig();
            $this->postData = \FlycartInput\FInput::getInstance();
        }

        /**
         * Update the Base config with live.
         */
        public function updateBaseConfig()
        {
            $base = new FlycartWooDiscountBase();
            $base = $base->getBaseConfig();
            if (is_string($base)) $base = json_decode($base, true);
            $this->baseConfig = $base;
            $this->apply_to = (isset($this->baseConfig['price_setup']) ? $this->baseConfig['price_setup'] : 'all');
        }

        /**
         * Saving the Price Rule Set.
         *
         * @param $request
         * @return bool
         */
        public function save($request)
        {
            $id = (isset($request['rule_id']) ? $request['rule_id'] : false);

            $id = intval($id);
            if (!$id && $id != 0) return false;

            $title = (isset($request['rule_name']) ? $request['rule_name'] : 'New');
            $slug = str_replace(' ', '-', strtolower($title));

            // To Lowercase.
            $slug = strtolower($slug);

            // Encoding String with Space.
            $slug = str_replace(' ', '-', $slug);

            if ($id) {
                $post = array(
                    'ID' => $id,
                    'post_title' => $title,
                    'post_name' => $slug,
                    'post_content' => 'New Rule',
                    'post_type' => $this->post_type,
                    'post_status' => 'publish'
                );
                wp_update_post($post);
            } else {
                $post = array(
                    'post_title' => $title,
                    'post_name' => $slug,
                    'post_content' => 'New Rule',
                    'post_type' => $this->post_type,
                    'post_status' => 'publish'
                );
                $id = wp_insert_post($post);
            }

            $form = array(
                'rule_name',
                'rule_descr',
                'rule_method',
                'qty_based_on',
                'date_from',
                'date_to',
                'apply_to',
                'customer',
                'min_qty',
                'max_qty',
                'discount_type',
                'to_discount',
                'status',
                'customer',
                'discount_range',
                'product_based_condition',
                'product_based_discount',
                'rule_order'
            );

            //----------------------------------------------------------------------------------------------------------
            // Manage Products with it's ID or Category.
            $apply_to = 'all_products';

            if (isset($request['apply_to'])) $apply_to = $request['apply_to'];

            if ($apply_to == 'specific_category') {
                $apply_to = 'category_to_apply';
                if(isset($request['is_cumulative']) && $request['is_cumulative'] == 1){
                    $request['is_cumulative'] = 1;
                } else {
                    $request['is_cumulative'] = 0;
                }
                $form[] = 'is_cumulative';

                if(isset($request['apply_child_categories']) && $request['apply_child_categories'] == 1){
                    $request['apply_child_categories'] = 1;
                } else {
                    $request['apply_child_categories'] = 0;
                }
                $form[] = 'apply_child_categories';

            } elseif ($apply_to == 'specific_products') {
                $apply_to = 'product_to_apply';
            }
            $form[] = $apply_to;

            if (isset($request[$apply_to])) $request[$apply_to] = json_encode($request[$apply_to]);
            //----------------------------------------------------------------------------------------------------------

            // Manage Users.
            $apply_to = 'all';

            if (isset($request['customer'])) $apply_to = $request['customer'];

            if ($apply_to == 'only_given') {
                $apply_to = 'users_to_apply';
            }
            $form[] = $apply_to;
            if (isset($request[$apply_to])) $request[$apply_to] = json_encode($request[$apply_to]);

            $form[] = 'user_roles_to_apply';
            if (!isset($request['user_roles_to_apply'])) $request['user_roles_to_apply'] = array();
            $request['user_roles_to_apply'] = json_encode($request['user_roles_to_apply']);

            $based_on_purchase_history = 0;
            if (isset($request['based_on_purchase_history'])) $based_on_purchase_history = $request['based_on_purchase_history'];
            $request['based_on_purchase_history'] = $based_on_purchase_history;
            $form[] = 'based_on_purchase_history';
            if($based_on_purchase_history){
                $form[] = 'purchased_history_amount';
                $form[] = 'purchase_history_status_list';
                if (isset($request['purchase_history_status_list'])) $request['purchase_history_status_list'] = json_encode($request['purchase_history_status_list']);
                else $request['purchase_history_status_list'] = json_encode(array('wc-completed'));
            }

            //----------------------------------------------------------------------------------------------------------

            // Manage list of Discount Ranges.
            if (isset($request['discount_range'])) {

                foreach ($request['discount_range'] as $index => $value) {
                    $request['discount_range'][$index] = FlycartWooDiscountRulesGeneralHelper::makeString($value);
                    $request['discount_range'][$index]['title'] = isset($request['rule_name']) ? $request['rule_name'] : '';

                }

                $request['discount_range'] = json_encode($request['discount_range']);
            } else {
                // Reset the Discount Range, if its empty.
                $request['discount_range'] = '';
            }
            if(isset($request['rule_method']) && $request['rule_method'] == 'product_based'){
                $request['product_based_condition'] = json_encode($request['product_based_condition']);
                $request['product_based_discount'] = json_encode($request['product_based_discount']);
            } else {
                $request['product_based_condition'] = '{}';
                $request['product_based_discount'] = '{}';
            }

            $request['status'] = 'publish';

            if (is_null($id) || !isset($id)) return false;

            foreach ($request as $index => $value) {
                if (in_array($index, $form)) {
                    if (get_post_meta($id, $index)) {
                        update_post_meta($id, $index, $value);
                    } else {
                        add_post_meta($id, $index, $value);
                    }
                }
            }
        }

        /**
         * Load View with Specif post id.
         *
         * @param $option
         * @param integer $id Post ID.
         * @return string mixed response.
         */
        public function view($option, $id)
        {
            $id = intval($id);
            if (!$id) return false;
            $post = get_post($id, 'OBJECT');
            if (isset($post)) {
                if (isset($post->ID)) {
                    $post->meta = get_post_meta($post->ID);
                }
            }
            return $post;
        }

        // -------------------------------------------------RULE IMPLEMENTATION---------------------------------------------

        /**
         * To Analyzing the Pricing Rules to Apply the Discount in terms of price.
         */
        public function analyse($woocommerce)
        {
            $this->organizeRules();
            $this->applyRules();
            $this->initAdjustment();
        }

        /**
         * To Organizing the rules to make possible sets.
         */
        public function organizeRules()
        {
            // Loads the Rules to Global.
            $this->getRules();
            // Validate and Re-Assign the Rules.
            $this->filterRules();
        }

        /**
         * To Get Set of Rules.
         *
         * @return mixed
         */
        public function getRules($onlyCount = false)
        {
            if(self::$rules_loaded) return $this->rules = self::$pricingRules;

            $posts = get_posts(array('post_type' => $this->post_type, 'numberposts' => '-1'));
            if ($onlyCount) return count($posts);
            if (isset($posts) && count($posts) > 0) {
                foreach ($posts as $index => $item) {
                    $posts[$index]->meta = get_post_meta($posts[$index]->ID);
                }
                $this->rules = $posts;
            }
            self::$rules_loaded = 1;
            self::$pricingRules = $posts;
            return $posts;
        }

        /**
         * To Updating the Log of Implemented Price Discounts.
         *
         * @return bool
         */
        public function makeLog()
        {
            if (is_null($this->matched_sets)) return false;

            $discount_log = array(
                'line_discount' => $this->matched_sets,
            );
            WC()->session->set('woo_price_discount', json_encode($discount_log));
        }

        /**
         * @return array
         */
        public function getBaseConfig()
        {
            $option = get_option($this->default_option);
            if (!$option || is_null($option)) {
                return array();
            } else {
                return $option;
            }
        }

        /**
         * List of Checklist.
         */
        public function checkPoint()
        {
            // Apply rules with products.
            // NOT YET USED.
            if ($this->discount_applied) return true;
        }

        /**
         * Filter the Rules with some validations.
         */
        public function filterRules()
        {
            $rules = $this->rules;

            if (is_null($rules) || !isset($rules)) return false;

            // Start with empty set.
            $rule_set = array();

            foreach ($rules as $index => $rule) {
                $status = (isset($rule->status) ? $rule->status : false);

                // To Check as Plugin Active - InActive.
                if ($status == 'publish') {
                    $date_from = (isset($rule->date_from) ? strtotime($rule->date_from) : false);
                    $date_to = (isset($rule->date_to) ? strtotime($rule->date_to) : false);
                    $today = strtotime(date('m/d/Y'));

                    // Validating Rule with Date of Expiry.
                    if (($date_from <= $today) && (($date_to == '') || ($date_to >= $today))) {

                        // Validating the Rule with its Order ID.
                        if (isset($rule->rule_order)) {
                            // If Order ID is '-', then this rule not going to implement.
                            if ($rule->rule_order !== '-') {
                                $rule_set[] = $rule;
                            }
                        }
                    }
                }
            }
            $this->rules = $rule_set;

            // To Order the Rules, based on its order ID.
            $this->orderRules();
        }

        /**
         * Ordering the Set of Rules.
         *
         * @return bool
         */
        public function orderRules()
        {
            if (empty($this->rules)) return false;

            $ordered_rules = array();

            // Make associative array with Order ID.
            foreach ($this->rules as $index => $rule) {
                if (isset($rule->rule_order)) {
                    if ($rule->rule_order != '') {
                        $ordered_rules[$rule->rule_order] = $rule;
                    }
                }
            }
            // Order the Rules with it's priority.
            ksort($ordered_rules);

            $this->rules = $ordered_rules;
        }

        /**
         * Apply the Rules to line items.
         *
         * @return bool
         */
        public function applyRules()
        {
            global $woocommerce;

            // If there is no rules, then return false.
            if (!isset($this->rules)) return false;

            // Check point having list of checklist to apply.
            if ($this->checkPoint()) return false;

            // To Generate Valid Rule sets.
            $this->generateRuleSets($woocommerce);
            // Sort cart by price ascending

            $cart_contents = $this->sortCartPrice($woocommerce->cart->cart_contents, 'asc');

            //to handle buy one get one
            $free_product_quantity_exists = $this->reduceCartItemQuantityIfFreeProductExistsAlready();

            foreach ($cart_contents as $index => $item) {
                $this->matchRules($index, $item);
            }

            //to handle buy one get one
            $this->applyDiscountForFreeProduct($free_product_quantity_exists);

            $this->makeLog();
        }

        /**
         * apply the discount for Free product
         * */
        public function applyDiscountForFreeProduct($quantity_exists){
            $postData = \FlycartInput\FInput::getInstance();
            $empty_apply_coupon = $postData->get('apply_coupon');
            $empty_update_cart = $postData->get('update_cart');
            $empty_proceed = $postData->get('proceed');
            $runFreeProduct = (!empty($empty_apply_coupon) || !empty($empty_update_cart) || !empty($empty_proceed)) ? false : true;
            $free_products = WC()->session->get('woo_discount_rules_get_free_product', array());
            if(!empty($free_products) && $runFreeProduct){
                //check if product already in cart
                $cart = FlycartWoocommerceCart::get_cart();
                if ( sizeof( $cart ) > 0 ) {
                    foreach ($free_products as $productId => $free_product_detail) {
                        $product = FlycartWoocommerceProduct::wc_get_product($productId);
                        $productParentId = FlycartWoocommerceProduct::get_parent_id($product);
                        if($productParentId){
                            FlycartWoocommerceCart::add_to_cart($productParentId, $free_product_detail['count'], $productId, FlycartWoocommerceProduct::get_attributes($product));
                        } else {
                            FlycartWoocommerceCart::add_to_cart($productId, $free_product_detail['count']);
                        }
                        $cart = FlycartWoocommerceCart::get_cart();
                        foreach ($cart as $cart_item_key => $values) {
                            $_product = $values['data'];
                            if (FlycartWoocommerceProduct::get_id($_product) == $productId){
                                $discountAmount = array('price_discount' => FlycartWoocommerceProduct::get_price($_product));
                                if(isset($quantity_exists[$productId]) && $quantity_exists[$productId] > 0){
                                    $price = FlycartWoocommerceProduct::get_price($_product);
                                    //discount_price = (original_price - ((original_price / (buy_qty + free_qty))*buy_qty))
                                    $discount_price = $price - (($price/($quantity_exists[$productId]+$free_product_detail['count'])) * $quantity_exists[$productId]);
                                    $discountAmount = array('price_discount' => $discount_price);
                                }
                                $freeProductRule[0] = $this->formatRulesToApply($discountAmount, $free_product_detail['rule_name'], $cart_item_key, FlycartWoocommerceProduct::get_id($_product));
                                $this->matched_sets[$cart_item_key] = $freeProductRule;
                            }
                        }
                    }
                }
            }
        }

        /**
         * Reduce the Cart item quantity if free product already exists
         * */
        public function reduceCartItemQuantityIfFreeProductExistsAlready(){
            $free_products = WC()->session->get('woo_discount_rules_get_free_product', array());
            $postData = \FlycartInput\FInput::getInstance();
            $empty_apply_coupon = $postData->get('apply_coupon');
            $empty_update_cart = $postData->get('update_cart');
            $empty_proceed = $postData->get('proceed');
            $runFreeProduct = (!empty($empty_apply_coupon) || !empty($empty_update_cart) || !empty($empty_proceed)) ? false : true;
            $quantity_exists = array();
            if(!empty($free_products) && $runFreeProduct){
                //check if product already in cart
                $cart = FlycartWoocommerceCart::get_cart();
                if ( sizeof($cart) > 0 ) {
                    foreach ($free_products as $productId => $free_product_detail) {
                        $found = false;
                        foreach ($cart as $cart_item_key => $values) {
                            $_product = $values['data'];
                            $_product_id = FlycartWoocommerceProduct::get_id($_product);
                            if ($_product_id == $productId){
                                $_quantity = $values['quantity'];
                                $_cart_item_key = $cart_item_key;
                                $found = true;
                            }
                        }
                        // if product found, add it
                        if ($found) {
                            FlycartWoocommerceCart::remove_cart_item($_cart_item_key);
                            $quantity_exists[$productId] = $_quantity-$free_product_detail['count'];
                            if($quantity_exists[$productId] > 0){
                                $product = FlycartWoocommerceProduct::wc_get_product($productId);
                                $productParentId = FlycartWoocommerceProduct::get_parent_id($product);
                                if($productParentId){
                                    FlycartWoocommerceCart::add_to_cart($productParentId, $quantity_exists[$productId], $productId, FlycartWoocommerceProduct::get_attributes($product));
                                } else {
                                    FlycartWoocommerceCart::add_to_cart($productId, $quantity_exists[$productId]);
                                }
                            }
                        }
                    }
                }
            }
            WC()->session->set('woo_discount_rules_get_free_product', array());
            return $quantity_exists;
        }

        /**
         * Generate the Suitable and active rule sets.
         *
         * @param $woocommerce
         * @return bool
         */
        public function generateRuleSets($woocommerce)
        {
            $rule_sets = array();

            if (!isset($this->rules)) return false;

            // Loop the Rules set to collect matched rules.
            foreach ($this->rules as $index => $rule) {
                // General Rule Info.
                $rule_sets[$index]['discount_type'] = 'price_discount';
                $rule_sets[$index]['name'] = (isset($rule->rule_name) ? $rule->rule_name : 'Rule_' . $index);
                $rule_sets[$index]['descr'] = (isset($rule->rule_descr) ? $rule->rule_descr : '');
                $rule_sets[$index]['method'] = (isset($rule->rule_method) ? $rule->rule_method : 'qty_based');
                $rule_sets[$index]['qty_based_on'] = (isset($rule->qty_based_on) ? $rule->qty_based_on : 'each_product');
                $rule_sets[$index]['date_from'] = (isset($rule->date_from) ? $rule->date_from : false);
                $rule_sets[$index]['date_to'] = (isset($rule->date_to) ? $rule->date_to : false);
                $rule_sets[$index]['allow']['purchase_history'] = 'yes';
                // Default setup for all customers.
                $rule_sets[$index]['allow']['users'] = 'all';
                $rule_sets[$index]['allow']['user_role'] = true;

                // For quantity based discount
                if($rule_sets[$index]['method'] == 'qty_based'){
                    // List the type of apply, by Product or by Category.
                    if (isset($rule->apply_to)) {
                        // If Rule is processed by Specific Products, then..
                        if ($rule->apply_to == 'specific_products') {
                            if (isset($rule->product_to_apply)) {
                                $rule_sets[$index]['type']['specific_products'] = $this->checkWithProducts($rule, $woocommerce);
                            }
                        } else if ($rule->apply_to == 'specific_category') {
                            if (isset($rule->apply_child_categories) && $rule->apply_child_categories) {
                                $rule_sets[$index]['type']['apply_child_categories'] = 1;
                            } else {
                                $rule_sets[$index]['type']['apply_child_categories'] = 0;
                            }

                            if (isset($rule->category_to_apply)) {
                                $rule_sets[$index]['type']['specific_category'] = $this->checkWithCategory($rule, $woocommerce);
                                if($rule_sets[$index]['type']['apply_child_categories']){
                                    $cat = $rule_sets[$index]['type']['specific_category'];
                                    $rule_sets[$index]['type']['specific_category'] =  $this->getAllSubCategories($cat);
                                }
                            }
                            if (isset($rule->is_cumulative) && $rule->is_cumulative) {
                                $rule_sets[$index]['type']['is_cumulative'] = 1;
                            } else {
                                $rule_sets[$index]['type']['is_cumulative'] = 0;
                            }
                        } else {
                            $rule_sets[$index]['type'] = 'all';
                        }

                        $rule_sets[$index]['discount'] = 0;
                        if (isset($rule->discount_range)) {
                            if ($rule->discount_range != '') {
                                $rule_sets[$index]['discount'] = $this->getDiscountRangeList($rule);
                            }
                        }

                        // If Rule is processed by Specific Customers, then..
                        if ($rule->customer == 'only_given') {
                            if (isset($rule->users_to_apply)) {
                                $rule_sets[$index]['allow']['users'] = $this->checkWithUsers($rule, $woocommerce);
                            }
                        }
                        $rule_sets[$index]['apply_to'] = $rule->apply_to;

                        // Default setup for purchase history
                        if(isset($rule->based_on_purchase_history) && $rule->based_on_purchase_history){
                            $rule_sets[$index]['allow']['purchase_history'] = $this->checkWithUsersPurchaseHistory($rule, $woocommerce);
                        }

                        // check for user roles
                        if(isset($rule->user_roles_to_apply)){
                            $rule_sets[$index]['allow']['user_role'] = $this->checkWithUserRoles($rule);
                        }
                    }

                    // If Current Customer is not Allowed to use this discount, then it's going to be removed.
                    if ($rule_sets[$index]['allow']['users'] == 'no' || !$rule_sets[$index]['allow']['user_role'] || $rule_sets[$index]['allow']['purchase_history'] == 'no') {
                        unset($rule_sets[$index]);
                    }

                } else if($rule_sets[$index]['method'] == 'product_based'){
                    $rule_sets[$index]['product_based_condition'] = json_decode((isset($rule->product_based_condition) ? $rule->product_based_condition : '{}'), true);
                    $rule_sets[$index]['product_based_discount'] = json_decode((isset($rule->product_based_discount) ? $rule->product_based_discount : '{}'), true);
                }
            }
            $this->rule_sets = $rule_sets;
        }

        /**
         * Check with users roles
         * */
        public function checkWithUserRoles($rule){
            $user_roles_to_apply = json_decode($rule->user_roles_to_apply, true);
            if(!empty($user_roles_to_apply)){
                if (count(array_intersect(FlycartWooDiscountRulesGeneralHelper::getCurrentUserRoles(), $user_roles_to_apply)) == 0) {
                    return false;
                }
            }
            return true;
        }

        /**
         * Check with users purchase history
         * */
        public function checkWithUsersPurchaseHistory($rule, $woocommerce)
        {
            $allowed = 'no';
            $user = get_current_user_id();
            if($user){
                if(isset($rule->purchased_history_amount) && isset($rule->purchase_history_status_list)){
                    if($rule->purchased_history_amount > 0){
                        $purchase_history_status_list = json_decode($rule->purchase_history_status_list, true);
                        $customerOrders = get_posts( array(
                            'numberposts' => -1,
                            'meta_key'    => '_customer_user',
                            'meta_value'  => $user,
                            'post_type'   => wc_get_order_types(),
                            'post_status' => $purchase_history_status_list,
                        ) );
                        $totalPurchasedAmount = 0;
                        if(!empty($customerOrders)){
                            foreach ($customerOrders as $customerOrder) {
                                $order = FlycartWoocommerceOrder::wc_get_order($customerOrder->ID);
                                $total = FlycartWoocommerceOrder::get_total($order);
                                $totalPurchasedAmount += $total;
                            }
                        }
                        if($totalPurchasedAmount >= $rule->purchased_history_amount){
                            $allowed = 'yes';
                        }
                    }
                }
            }

            return $allowed;
        }

        /**
         * Get all sub categories
         * */
        public function getAllSubCategories($cat){
            $category_with_sub_cat = $cat;
            foreach($cat as $c) {
                $args = array('hierarchical' => 1,
                    'show_option_none' => '',
                    'hide_empty' => 0,
                    'parent' => $c,
                    'taxonomy' => 'product_cat');
                $categories = get_categories( $args );
                foreach($categories as $category) {
                    $category_with_sub_cat[] = $category->term_id;
                }
            }
            $category_with_sub_cat = array_unique($category_with_sub_cat);

            return $category_with_sub_cat;
        }

        /**
         * To format rules to apply
         *
         * @param array $discount_amount
         * @param string $rule_name
         * @param string $cart_key
         * @param int $product_id
         * @param int $rule_order
         * @param array $additional_keys
         * @return array
         * */
        public function formatRulesToApply($discount_amount, $rule_name, $cart_key, $product_id, $rule_order = 0, $additional_keys = array()){
            $toApply = array();
            $toApply['amount'] = $discount_amount;
            $toApply['name'] = $rule_name;
            $toApply['item'] = $cart_key;
            $toApply['id'] = $product_id;
            if($rule_order)
                $toApply['rule_order'] = $rule_order;
            if(!empty($additional_keys)) foreach ($additional_keys as $key => $additional_key) $toApply[$key] = $additional_key;

            return $toApply;
        }

        /**
         * Fetch back the Matched rules.
         *
         * @param $index
         * @param array $item line item.
         */
        public function matchRules($index, $item, $product_page = 0)
        {
            $applied_rules = array();
            $quantity = (isset($item['quantity']) ? $item['quantity'] : 0);
            $i = 0;
            if(!empty($this->rule_sets))
                foreach ($this->rule_sets as $id => $rule) {
                    if(isset($rule['method']) && $rule['method'] == 'qty_based'){
                        if (isset($rule['type']) && isset($rule['apply_to'])) {

                            // Working with Products and Category.
                            switch ($rule['apply_to']) {

                                case 'specific_products':
                                    if ($this->isItemInProductList($rule['type']['specific_products'], $item)) {
                                        $discount_amount = $this->getAdjustmentAmount($quantity, $this->array_first($rule['discount']));
                                        $applied_rules[$i] = $this->formatRulesToApply($discount_amount, $rule['name'], $index, $item['product_id'], $id);
                                    }
                                    break;

                                case 'specific_category':
                                    if ($this->isItemInCategoryList($rule['type']['specific_category'], $item)) {
                                        $alreadyExists = 0;
                                        if(isset($rule['type']['is_cumulative']) && $rule['type']['is_cumulative']){
                                            $totalQuantityInThisCategory = $this->getProductQuantityInThisCategory($rule['type']['specific_category']);
                                            $quantity = $totalQuantityInThisCategory;
                                            //Check for product_discount to apply the rule only once
                                            if(isset($rule['discount'])){
                                                if(!empty($rule['discount'])){
                                                    foreach($rule['discount'] as $discount_rules){
                                                        if(isset($discount_rules->discount_type) && $discount_rules->discount_type == 'product_discount'){
                                                            if(!empty($this->matched_sets)){
                                                                foreach($this->matched_sets as $machedRules){
                                                                    foreach($machedRules as $machedRule){
                                                                        if(isset($machedRule['rule_order']) && $machedRule['rule_order'] == $id){
                                                                            $alreadyExists = 1;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        if(!$alreadyExists){
                                            $discount_amount = $this->getAdjustmentAmount($quantity, $this->array_first($rule['discount']));
                                            $applied_rules[$i] = $this->formatRulesToApply($discount_amount, $rule['name'], $index, $item['product_id'], $id);
                                        }
                                    }
                                    break;

                                case 'all_products':
                                default:
                                    $discount_amount = $this->getAdjustmentAmount($quantity, $this->array_first($rule['discount']));
                                    $applied_rules[$i] = $this->formatRulesToApply($discount_amount, $rule['name'], $index, $item['product_id'], $id);
                                    break;
                            }
                            if(isset($applied_rules[$i]['amount']['product_ids'])){
                                if(!empty($applied_rules[$i]['amount']['product_ids'])){
                                    $applyToProducts = $applied_rules[$i]['amount']['product_ids'];
                                    $applyPercent = $applied_rules[$i]['amount'];
                                    $applied_rules = array();
                                    foreach ($applyToProducts as $key => $productId) {
                                        $cart = FlycartWoocommerceCart::get_cart();
                                        foreach ($cart as $cart_item_key => $values) {
                                            $_product = $values['data'];
                                            if (FlycartWoocommerceProduct::get_id($_product) == $productId){
                                                $additionalKeys = array('apply_from' => $item['product_id']);
                                                $this->matched_sets[$cart_item_key][] = $this->formatRulesToApply($applyPercent, $rule['name'], $cart_item_key, $productId, $id, $additionalKeys);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else if(isset($rule['method']) && $rule['method'] == 'product_based'){
                        $checkRuleMatches = $this->checkProductBasedRuleMatches($rule, $item, $quantity);
                        if(!empty($checkRuleMatches)){
                            foreach ($checkRuleMatches['apply_to']['products'] as $key => $productId) {
                                if($product_page && $productId == $index){
                                    $additionalKeys = array('apply_from' => $item['product_id']);
                                    $applied_rules_new = $this->formatRulesToApply($checkRuleMatches['amount'], $rule['name'], $index, $productId, $id, $additionalKeys);
                                    $this->matched_sets[$index][] = $applied_rules_new;
                                } else {
                                    $cart = FlycartWoocommerceCart::get_cart();
                                    foreach ($cart as $cart_item_key => $values) {
                                        $_product = $values['data'];
                                        if (FlycartWoocommerceProduct::get_id($_product) == $productId){
                                            $additionalKeys = array('apply_from' => $item['product_id']);
                                            $applied_rules_new = $this->formatRulesToApply($checkRuleMatches['amount'], $rule['name'], $cart_item_key, $productId, $id, $additionalKeys);
                                            $alreadyExists = 0;
                                            if(!empty($this->matched_sets[$cart_item_key])){
                                                foreach($this->matched_sets[$cart_item_key] as $machedRules){
                                                    if(isset($machedRules['rule_order']) && $machedRules['rule_order'] == $id){
                                                        $alreadyExists = 1;
                                                        break;
                                                    }
                                                }
                                            }
                                            if(!$alreadyExists) $this->matched_sets[$cart_item_key][] = $applied_rules_new;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $i++;
                }
            if(isset($this->matched_sets[$index]) && !empty($this->matched_sets[$index])){
                $this->matched_sets[$index] = array_merge($this->matched_sets[$index], $applied_rules);
            } else {
                $this->matched_sets[$index] = $applied_rules;
            }
        }

        /**
         * Check Product based rules matches
         * */
        public function checkProductBasedRuleMatches($rule, $item, $quantity){
            $result = array();
            if(isset($rule['product_based_condition']) && !empty($rule['product_based_condition'])){
                $product_based_conditions = $rule['product_based_condition'];
                $buy_type = isset($product_based_conditions['product_buy_type']) ? $product_based_conditions['product_buy_type'] : 'any';
                $quantity_rule = isset($product_based_conditions['product_quantity_rule']) ? $product_based_conditions['product_quantity_rule'] : 'more';
                $quantity_from = isset($product_based_conditions['product_quantity_from']) ? $product_based_conditions['product_quantity_from'] : '';
                $quantity_to = isset($product_based_conditions['product_quantity_to']) ? $product_based_conditions['product_quantity_to'] : '';
                $product_to_buy = isset($product_based_conditions['product_to_buy']) ? $product_based_conditions['product_to_buy'] : array();
                $product_to_buy = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_buy);
                $product_to_apply = isset($product_based_conditions['product_to_apply']) ? $product_based_conditions['product_to_apply'] : array();
                $product_to_apply = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_apply);

                $product_based_discounts = isset($rule['product_based_discount']) ? $rule['product_based_discount'] : array();
                $discount_type = isset($product_based_discounts['discount_type']) ? $product_based_discounts['discount_type'] : 'percentage_discount';
                $discount_value = isset($product_based_discounts['discount_value']) ? $product_based_discounts['discount_value'] : '';
                $cart = FlycartWoocommerceCart::get_cart();
                $_quantity = array();
                if ( sizeof( $cart ) > 0 ) {
                    foreach ($product_to_buy as $key => $productId) {
                        foreach ($cart as $cart_item_key => $values) {
                            $_product = $values['data'];
                            if (FlycartWoocommerceProduct::get_id($_product) == $productId){
                                $_quantity[$productId] = $values['quantity'];
                            }
                        }
                    }
                }
                $quantity = FlycartWooDiscountRulesPriceProductBased::adjustQuantity($buy_type, $_quantity);
                if((in_array($item['product_id'], $product_to_buy) || in_array($item['product_id'], $product_to_apply)) && !empty($_quantity)){
                    $proceed = 1;
                    if($buy_type == 'each'){
                        $allProductsInCart = array_keys($_quantity);
                        $matchedProducts = array_intersect($allProductsInCart, $product_to_buy);
                        if(count($product_to_buy) != count($matchedProducts)) $proceed = 0;
                    }
                    if($proceed){
                        $quantityMatched = FlycartWooDiscountRulesPriceProductBased::verifyQuantity($quantity_rule, $quantity, $quantity_from, $quantity_to, $buy_type);
                        if($quantityMatched){
                            $result['amount'][$discount_type] = $discount_value;
                            $result['apply_to']['products'] = $product_to_apply;
                        }
                    }
                }
            }
            return $result;
        }

        /**
         * Get quantity of products in specific category
         * */
        public function getProductQuantityInThisCategory($category){
            global $woocommerce;
            $quantity = 0;
            if(count($woocommerce->cart->cart_contents)){
                foreach ($woocommerce->cart->cart_contents as $cartItem) {
                    $terms = get_the_terms( $cartItem['product_id'], 'product_cat' );
                    if($terms){
                        $has = 0;
                        foreach ($terms as $term) {
                            if(in_array($term->term_id, $category)){
                                $has = 1;
                            }
                        }
                        if($has){
                            $quantity = $quantity + $cartItem['quantity'];
                        }
                    }
                }
            }
            return $quantity;
        }

        /**
         * Return the First index.
         *
         * @param $array
         * @return mixed
         */
        public function array_first($array)
        {
            if (is_object($array)) $array = (array)$array;
            if (is_array($array)) return $array;
            foreach ($array as $first) {
                return $first;
            }
        }

        /**
         * Return the Adjustment amount.
         *
         * @param $quantity
         * @param $discount_range
         * @return array|bool
         */
        public function getAdjustmentAmount($quantity, $discount_ranges)
        {
            $adjustment = array();
            foreach($discount_ranges as $discount_range) {
                if (!is_array($discount_range) && !is_object($discount_range)) return false;
                $range = is_array($discount_range) ? (object) $discount_range : $discount_range;
                $min = (isset($range->min_qty) ? $range->min_qty : 0);
                $max = (isset($range->max_qty) ? $range->max_qty : false);
                if($max == 0 || $max == '' || $max == false) $max = 999;

                $type = (isset($range->discount_type) ? $range->discount_type : 'price_discount');

                if ($max == false) continue;

                if ((int)$min <= (int)$quantity && (int)$max >= (int)$quantity) {
                    if($type == 'product_discount'){
                        $discount_product_option = isset($range->discount_product_option) ? $range->discount_product_option : 'all';
                        $productIds = isset($range->discount_product) ? $range->discount_product : array();
                        $productIds = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($productIds);
                        if($discount_product_option == 'any_cheapest_from_all'){
                            $productCheapest = $this->getCheapestProductFromCart($productIds, 1);
                            if(!empty($productCheapest)){
                                $adjustment = array ( 'price_discount' => $productCheapest['percent'], 'product_ids' => array($productCheapest['product']) ) ;
                            }
                        } else if($discount_product_option == 'any_cheapest'){
                            $productCheapest = $this->getCheapestProductFromCart($productIds);
                            if(!empty($productCheapest)){
                                $adjustment = array ( 'price_discount' => $productCheapest['percent'], 'product_ids' => array($productCheapest['product']) ) ;
                            }
                        } else {
                            //to handle product discount
                            $free_product = WC()->session->get('woo_discount_rules_get_free_product', array());
                            if(!empty($productIds)){
                                foreach ($productIds as $productId){
                                    if(isset($free_product[$productId])){
                                        $free_product[$productId]['count'] = $free_product[$productId]['count']+1;
                                    } else {
                                        $free_product[$productId]['count'] = 1;
                                        $free_product[$productId]['rule_name'] = $range->title;
                                    }
                                }
                                WC()->session->set('woo_discount_rules_get_free_product', $free_product);
                            }
                            $adjustment[$type] = $productIds;
                        }
                    } else {
                        $adjustment[$type] = (isset($range->to_discount) ? $range->to_discount : 0);
                    }
                }
            }
            return $adjustment;
        }

        /**
         * Get cheapest product
         * */
        public function getCheapestProductFromCart($products, $all = 0){
            if(!$all){
                if(empty($products)) return array();
            }
            $cheapestProductValue = 0;
            $cart = FlycartWoocommerceCart::get_cart();
            foreach ($cart as $cart_item_key => $values) {
                $_product = $values['data'];
                $productId = FlycartWoocommerceProduct::get_id($_product);
                if(!in_array($productId, $products) && !$all) continue;

                if($cheapestProductValue == 0){
                    $cheapestProductValue = FlycartWoocommerceProduct::get_price($_product);
                    $cheapestProduct = FlycartWoocommerceProduct::get_id($_product);
                    $quantity = $values['quantity'];
                } else if($cheapestProductValue > FlycartWoocommerceProduct::get_price($_product)){
                    $cheapestProductValue = FlycartWoocommerceProduct::get_price($_product);
                    $cheapestProduct = FlycartWoocommerceProduct::get_id($_product);
                    $quantity = $values['quantity'];
                }
            }
            if($cheapestProductValue > 0){
                //discount_price = (original_price - ((original_price / (buy_qty + free_qty))*buy_qty))
                $discount_price = $cheapestProductValue - (($cheapestProductValue/($quantity)) * ($quantity-1));
                return array('product' => $cheapestProduct, 'percent' => $discount_price);
            }
            return array();
        }

        /**
         * Validating the Active user with rule sets.
         *
         * @param $rule
         * @return string
         */
        public function manageUserAccess($rule)
        {
            $allowed = 'no';
            if (!isset($rule->users_to_apply)) return $allowed;

            $users = $rule->users_to_apply;

            if (is_string($users)) $users = json_decode($users, true);

            $users = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($users);

            if (!is_array($users)) return $allowed;

            $user = get_current_user_id();

            if (count(array_intersect($users, array($user))) > 0) {
                $allowed = 'yes';
            }

            return $allowed;
        }

        /**
         * To Check active cart items are in the rules list item.
         *
         * @param $product_list
         * @param $product
         * @return bool
         */
        public function isItemInProductList($product_list, $product)
        {
            if (!isset($product['product_id'])) return false;
            $product_ids = array($product['product_id']);
            if(!empty($product['variation_id'])) $product_ids[] = $product['variation_id'];
            if (!is_array($product_list)) $product_list = (array)$product_list;
            if (count(array_intersect($product_list, $product_ids)) >= 1) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * To Check that the items are in specified category.
         *
         * @param $category_list
         * @param $product
         * @return bool
         */
        public function isItemInCategoryList($category_list, $product)
        {
            $helper = new FlycartWooDiscountRulesGeneralHelper();
            $all_category = $helper->getCategoryList();
            if (!isset($product['product_id'])) return false;
            $product_category = FlycartWooDiscountRulesGeneralHelper::getCategoryByPost($product);
            $status = false;
            //check any one of category matches
            $matching_cats = array_intersect($product_category, $category_list);
            $result = !empty( $matching_cats );
            if($result){
                $status = true;
            }

            return $status;
        }

        /**
         *
         */
        public function isUserInCustomerList()
        {

        }

        /**
         * Sort cart by price
         *
         * @access public
         * @param array $cart
         * @param string $order
         * @return array
         */
        public function sortCartPrice($cart, $order)
        {
            $cart_sorted = array();

            foreach ($cart as $cart_item_key => $cart_item) {
                $cart_sorted[$cart_item_key] = $cart_item;
            }

            uasort($cart_sorted, array($this, 'sortCartByPrice_' . $order));

            return $cart_sorted;
        }

        /**
         * Sort cart by price uasort collable - ascending
         *
         * @access public
         * @param mixed $first
         * @param mixed $second
         * @return bool
         */
        public function sortCartByPrice_asc($first, $second)
        {
            if (isset($first['data'])) {
                if (FlycartWoocommerceProduct::get_price($first['data']) == FlycartWoocommerceProduct::get_price($second['data'])) {
                    return 0;
                }
            }
            return (FlycartWoocommerceProduct::get_price($first['data']) < FlycartWoocommerceProduct::get_price($second['data'])) ? -1 : 1;
        }

        /**
         * Sort cart by price uasort collable - descending
         *
         * @access public
         * @param mixed $first
         * @param mixed $second
         * @return bool
         */
        public function sortCartByPrice_desc($first, $second)
        {
            if (isset($first['data'])) {
                if (FlycartWoocommerceProduct::get_price($first['data']) == FlycartWoocommerceProduct::get_price($second['data'])) {
                    return 0;
                }
            }
            return (FlycartWoocommerceProduct::get_price($first['data']) > FlycartWoocommerceProduct::get_price($second['data'])) ? -1 : 1;
        }

        /**
         * Return the List of Products to Apply.
         *
         * @param $woocommerce
         * @param $rule
         * @return array
         */
        public function checkWithProducts($rule, $woocommerce)
        {
            $specific_product_list = array();
            if (is_string($rule->product_to_apply)) {
                $specific_product_list = json_decode($rule->product_to_apply, true);
                $specific_product_list = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($specific_product_list);
            }
            return $specific_product_list;
        }

        /**
         * Check with category list.
         *
         * @param $rule
         * @param $woocommerce
         * @return array|mixed
         */
        public function checkWithCategory($rule, $woocommerce)
        {
            $specific_category_list = array();
            if (is_string($rule->category_to_apply)) {
                $specific_category_list = json_decode($rule->category_to_apply, true);
            }
            return $specific_category_list;
        }

        /**
         * Check with User list.
         *
         * @param $rule
         * @param $woocommerce
         * @return array|mixed
         */
        public function checkWithUsers($rule, $woocommerce)
        {
            // Return as , User is allowed to use this discount or not.
            // Working Users.
            return $this->manageUserAccess($rule);
        }

        /**
         * To Return the Discount Ranges.
         *
         * @param $rule
         * @return array|mixed
         */
        public function getDiscountRangeList($rule)
        {
            $discount_range_list = array();
            if (is_string($rule->discount_range)) {
                $discount_range_list = json_decode($rule->discount_range);
            }
            return $discount_range_list;
        }

        /**
         * For Display the price discount of a product.
         */
        public function priceTable()
        {
            global $product;

            $config = $this->baseConfig;
            $show_discount = true;
            // Base Config to Check whether display table or not.
            if (isset($config['show_discount_table'])) {
                if ($config['show_discount_table'] == 'show') {
                    $show_discount = true;
                } else {
                    $show_discount = false;
                }
            }
            // If Only allowed to display, then only its display the table.
            if ($show_discount) {
                $table_data = $this->generateDiscountTableData($product);
                $path_from_template = $this->getTemplateOverride('discount-table.php');
                $path = WOO_DISCOUNT_DIR . '/view/template/discount-table.php';
                if($path_from_template){
                    $path = $path_from_template;
                }
                $this->generateTableHtml($table_data, $path);
            }
        }

        /**
         * Get template override
         * @param string $template_name
         * @return string
         * */
        public function getTemplateOverride($template_name){
            $template = locate_template(
                array(
                    trailingslashit( dirname(WOO_DISCOUNT_PLUGIN_BASENAME) ) . $template_name,
                    $template_name,
                )
            );

            return $template;
        }

        /**
         * To generate the Discount table data.
         *
         * @param $product
         * @return array|bool|string
         */
        public function generateDiscountTableData($product)
        {
            global $product;
            if(empty($product)) return false;
            $product_id = FlycartWoocommerceProduct::get_id($product);
            $id = (($product_id != 0 && $product_id != null) ? $product_id : 0);
            if ($id == 0) return false;

            $this->organizeRules();

            $discount_range = array();
            if(is_array($this->rules) && count($this->rules) > 0) {
                foreach ($this->rules as $index => $rule) {
                    $status = false;
                    if(isset($rule->rule_method) && $rule->rule_method == 'qty_based'){
                        // Check with Active User Filter.
                        if (isset($rule->customer)) {
                            $status = false;
                            if ($rule->customer == 'all') {
                                $status = true;
                            } else {
                                $users = (is_string($rule->users_to_apply) ? json_decode($rule->users_to_apply, true) : array());
                                $users = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($users);
                                if(empty($users)) $users = array();
                                $user_id = get_current_user_id();
                                if (count(array_intersect($users, array($user_id))) > 0) {
                                    $status = true;
                                }
                            }
                        }

                        if ($rule->apply_to == 'specific_products') {

                            // Check with Product Filter.
                            $products_to_apply = json_decode($rule->product_to_apply);
                            $products_to_apply = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($products_to_apply);

                            if ($rule->product_to_apply == null) $status = true;

                            if ($rule->product_to_apply != null) {
                                $status = false;
                                if (in_array($id, $products_to_apply)) {
                                    $status = true;
                                }
                                $variations = FlycartWoocommerceProduct::get_variant_ids($product_id);
                                if(!empty($variations)){
                                    if (count(array_intersect($variations, $products_to_apply)) > 0) {
                                        $status = true;
                                    }
                                }
                            }
                        } elseif ($rule->apply_to == 'specific_category') {
                            // Check with Product Category Filter.
                            $category = FlycartWooDiscountRulesGeneralHelper::getCategoryByPost($id, true);

                            if ($rule->category_to_apply == null) $status = true;

                            if ($rule->category_to_apply != null) {
                                $category_to_apply = json_decode($rule->category_to_apply);
                                if (isset($rule->apply_child_categories) && $rule->apply_child_categories == 1) {
                                    $category_to_apply = $this->getAllSubCategories($category_to_apply);
                                }
                                FlycartWooDiscountRulesGeneralHelper::toInt($category_to_apply);
                                $status = false;
                                if (count(array_intersect($category_to_apply, $category)) > 0) {
                                    $status = true;
                                }
                            }
                        } else if ($rule->apply_to == 'all_products') {
                            $status = true;
                        }

                        // check for user roles
                        if(isset($rule->user_roles_to_apply)){
                            $statusRoles = $this->checkWithUserRoles($rule);
                            if($statusRoles === false){
                                $status = false;
                            }
                        }

                        if ($status) {
                            $discount_range[] = (isset($rule->discount_range) ? json_decode($rule->discount_range) : array());
                        }
                    } else if(isset($rule->rule_method) && $rule->rule_method == 'product_based'){
                        $product_based_conditions = json_decode((isset($rule->product_based_condition) ? $rule->product_based_condition : '{}'), true);
                        $product_to_buy = isset($product_based_conditions['product_to_buy']) ? $product_based_conditions['product_to_buy'] : array();
                        $product_to_buy = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_buy);
                        $product_to_apply = isset($product_based_conditions['product_to_apply']) ? $product_based_conditions['product_to_apply'] : array();
                        $product_to_apply = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_apply);
                        if (in_array($id, $product_to_buy) || in_array($id, $product_to_apply)) {
                            $product_based_discounts = json_decode((isset($rule->product_based_discount) ? $rule->product_based_discount : '{}'), true);
                            $product_based_discount_type = isset($product_based_discounts['discount_type']) ? $product_based_discounts['discount_type'] : 'percentage_discount';
                            $product_based_discount_value = isset($product_based_discounts['discount_value']) ? $product_based_discounts['discount_value'] : '';
                            $newTableContent = new stdClass();
                            $newTableContent->rule_method = $rule->rule_method;
                            $newTableContent->discount_type = $product_based_discount_type;
                            $newTableContent->to_discount = $product_based_discount_value;
                            $newTableContent->title = $rule->rule_name;
                            $condition = $this->getTextForProductDiscountCondition($rule);
                            $newTableContent->condition = $condition;
                            $discount_range[][] = $newTableContent;
                        }
                    }

                }
            }

            return $discount_range;
        }

        public function getTextForProductDiscountCondition($rule){
            $product_based_conditions = json_decode((isset($rule->product_based_condition) ? $rule->product_based_condition : '{}'), true);
            $product_buy_type = isset($product_based_conditions['product_buy_type']) ? $product_based_conditions['product_buy_type'] : 'any';
            $product_quantity_rule = isset($product_based_conditions['product_quantity_rule']) ? $product_based_conditions['product_quantity_rule'] : 'more';
            $product_quantity_from = isset($product_based_conditions['product_quantity_from']) ? $product_based_conditions['product_quantity_from'] : '';
            $product_quantity_to = isset($product_based_conditions['product_quantity_to']) ? $product_based_conditions['product_quantity_to'] : '';
            $product_to_buy = isset($product_based_conditions['product_to_buy']) ? $product_based_conditions['product_to_buy'] : array();
            $product_to_buy = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_buy);
            $product_to_apply = isset($product_based_conditions['product_to_apply']) ? $product_based_conditions['product_to_apply'] : array();
            $product_to_apply = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_to_apply);
            $condition = esc_html__('Buy', 'woo-discount-rules');

            switch ($product_quantity_rule) {
                case 'less':
                    $quantity_text = esc_html__(' less than or equal to ', 'woo-discount-rules').$product_quantity_from.esc_html__(' Quantity', 'woo-discount-rules');
                    break;
                case 'equal':
                    $quantity_text = ' '.$product_quantity_from.esc_html__(' Quantity ', 'woo-discount-rules');
                    break;
                case 'from':
                    $quantity_text = '( '.$product_quantity_from.' - '.$product_quantity_to.' )'.esc_html__(' Quantity', 'woo-discount-rules');
                    break;
                case 'more':
                default:
                $quantity_text = ' '.$product_quantity_from.esc_html__(' or more Quantity', 'woo-discount-rules');
            }

            switch ($product_buy_type) {
                case 'combine':
                case 'any':
                    if(count($product_to_buy) == 1){
                        $condition .= $quantity_text;
                    } else {
                        $condition .= esc_html__(' any ', 'woo-discount-rules').$quantity_text.esc_html__(' products from ','woo-discount-rules');
                    }
                    break;
                case 'each':
                    if(count($product_to_buy) == 1){
                        $condition .= $quantity_text;
                    } else {
                        $condition .= ' '.$quantity_text.esc_html__(' in each products', 'woo-discount-rules');
                    }
                    break;
            }
            if(count($product_to_buy)){
                $htmlProduct = '';
                foreach ($product_to_buy as $product_id){
                    $product = FlycartWoocommerceProduct::wc_get_product($product_id);
                    $htmlProduct .= '<a href="'.FlycartWoocommerceProduct::get_permalink($product).'">'.FlycartWoocommerceProduct::get_title($product).'</a>, ';
                }
                $condition .= ' '.trim($htmlProduct, ', ').' ';
            }
            $condition .= esc_html__(' and get discount in ', 'woo-discount-rules');
            if(count($product_to_apply)){
                $htmlProduct = '';
                foreach ($product_to_apply as $product_id){
                    $product = FlycartWoocommerceProduct::wc_get_product($product_id);
                    $htmlProduct .= '<a href="'.FlycartWoocommerceProduct::get_permalink($product).'">'.FlycartWoocommerceProduct::get_title($product).'</a>, ';
                }
                $condition .= trim($htmlProduct, ', ');
            }
            return $condition;
        }

        /**
         * To Return the HTML table for show available discount ranges.
         *
         * @param $table_data
         * @param $path
         * @return bool|string
         */
        public function generateTableHtml($table_data, $path)
        {
            //ob_start();
            if (!isset($table_data)) return false;
            if (!isset($path) || empty($path) || is_null($path)) return false;
            if (!file_exists($path)) return false;
            $data = $this->getBaseConfig();
            $table_data_content = $this->getDiscountTableContentInHTML($table_data, $data);
            include($path);
            //$html = ob_get_contents();
           // ob_clean();
            //ob_get_clean();
        }

        /**
         * get Discount table content in html
         * */
        private function getDiscountTableContentInHTML($table_data, $data){
            $dataReturn = array();
            $table = $table_data;
            foreach ($table as $index => $item) {
                if ($item) {
                    foreach ($item as $id => $value) {
                        if(isset($value->rule_method) && $value->rule_method == 'product_based'){
                            $title = $value->title;
                            $condition = $value->condition;
                            if ($value->discount_type == 'percentage_discount') {
                                $discount = $value->to_discount.' %';
                            } else {
                                $discount = FlycartWoocommerceProduct::wc_price($value->to_discount);
                            }
                        } else {
                            $title = isset($value->title) ? $value->title : '';
                            $min = isset($value->min_qty) ? $value->min_qty : 0;
                            $max = isset($value->max_qty) ? $value->max_qty : 0;
                            if($max == 0 || $max == '' || $max == false) $max = 999;
                            $discount_type = isset($value->discount_type) ? $value->discount_type : 0;
                            $to_discount = isset($value->to_discount) ? $value->to_discount : 0;
                            $product_discount = isset($value->discount_product) ? $value->discount_product : array();
                            $discount_product_option = isset($value->discount_product_option) ? $value->discount_product_option : 'all';
                            $product_discount = FlycartWoocommerceVersion::backwardCompatibilityStringToArray($product_discount);
                            if (isset($base_config['show_discount_title_table'])) {
                            }
                            $condition = $min .' - ' . $max;
                            if ($discount_type == 'product_discount') {
                                $htmlProduct = '';
                                if($discount_product_option == 'any_cheapest_from_all'){
                                    $htmlProduct .= esc_html__('Any cheapest one from cart', 'woo-discount-rules');
                                } else {
                                    if($discount_product_option == 'any_cheapest'){
                                        $htmlProduct .= esc_html__('Any cheapest one of ', 'woo-discount-rules');
                                    }
                                    if(count($product_discount)){
                                        foreach ($product_discount as $product_id){
                                            $product = FlycartWoocommerceProduct::wc_get_product($product_id);
                                            $htmlProduct .= FlycartWoocommerceProduct::get_title($product);
                                            $htmlProduct .= ' ('.FlycartWoocommerceProduct::get_price_html($product).')<br>';
                                        }
                                    }
                                }

                                $discount = trim($htmlProduct, '<br>');
                            } else if ($discount_type == 'percentage_discount') {
                                $discount = $to_discount.' %';
                            } else {
                                $discount = FlycartWoocommerceProduct::wc_price($to_discount);
                            }

                        }
                        $dataReturn[$index.$id]['title'] = $title;
                        $dataReturn[$index.$id]['condition'] = $condition;
                        $dataReturn[$index.$id]['discount'] = $discount;
                    }
                }
            }
            return $dataReturn;
        }

        /**
         * Start Implementing the adjustments.
         *
         * @return bool
         */
        public function initAdjustment()
        {
            global $woocommerce;

            // Get settings
            $config = new FlycartWooDiscountBase();
            $config = $config->getBaseConfig();
            if (is_string($config)) $config = json_decode($config, true);
            if(isset($config['price_setup'])){
                $type = $config['price_setup'];
            } else {
                $type = 'all';
            }

            $cart_items = $woocommerce->cart->cart_contents;

            foreach ($cart_items as $cart_item_key => $cart_item) {
                $this->applyAdjustment($cart_item, $cart_item_key, $type);
            }
        }

        /**
         * Start Implement adjustment on individual items in the cart.
         *
         * @param $cart_item
         * @param $cart_item_key
         * @param $type
         * @return bool
         */
        public function applyAdjustment($cart_item, $cart_item_key, $type)
        {
            global $woocommerce;

            // All Sets are Collected properly, just process with that.
            if (!isset($cart_item)) return false;

            // If Product having the rule sets then,
            if (!isset($this->matched_sets[$cart_item_key])) return false;
            if (empty($this->matched_sets[$cart_item_key])) return false;
            
            $adjustment_set = $this->matched_sets[$cart_item_key];
            $product = $woocommerce->cart->cart_contents[$cart_item_key]['data'];
            $price = FlycartWoocommerceProduct::get_price($product);

            if ($type == 'first') {
                // For Apply the First Rule.
                $discount = $this->getAmount($adjustment_set, $price, 'first');
                $amount = $price - $discount;
                $log = 'Discount | ' . $discount;
                $this->applyDiscount($cart_item_key, $amount, $log);
            } else if ($type == 'biggest') {
                // For Apply the Biggest Discount.
                $discount = $this->getAmount($adjustment_set, $price, 'biggest');
                $amount = $price - $discount;
                $log = 'Discount | ' . $discount;
                $this->applyDiscount($cart_item_key, $amount, $log);
            } else {
                // For Apply All Rules.
                $discount = $this->getAmount($adjustment_set, $price);
                $amount = $price - $discount;
                $log = 'Discount | ' . $discount;
                $this->applyDiscount($cart_item_key, $amount, $log);
            }
        }

        /**
         * To Get Amount based on the Setting that specified.
         *
         * @param $sets
         * @param $price
         * @param string $by
         * @return bool|float|int
         */
        public function getAmount($sets, $price, $by = 'all')
        {
            $discount = 0;
            $overall_discount = 0;

            if (!isset($sets) || empty($sets)) return false;

            if ($price == 0) return $price;

            // For the biggest price, it compares the current product's price.
            if ($by == 'biggest') {
                $discount = $this->getBiggestDiscount($sets, $price);
                return $discount;
            }

            foreach ($sets as $id => $set) {
                // For the First price, it will return the amount after get hit.
                if ($by == 'first') {
                    if (isset($set['amount']['percentage_discount'])) {
                        $discount = ($price / 100) * $set['amount']['percentage_discount'];
                    } else if (isset($set['amount']['price_discount'])) {
                        $discount = $set['amount']['price_discount'];
                    }
                    return $discount;
                } else {
                    // For All, All rules going to apply.
                    if (isset($set['amount']['percentage_discount'])) {
                        $discount = ($price / 100) * $set['amount']['percentage_discount'];
                        // Append all Discounts.
                        $overall_discount = $overall_discount + $discount;
                    } else if (isset($set['amount']['price_discount'])) {
                        $discount = $set['amount']['price_discount'];
                        // Append all Discounts.
                        $overall_discount = $overall_discount + $discount;
                    }
                }
            }
            return $overall_discount;
        }

        /**
         * To Return the Biggest Discount across the available rule sets.
         *
         * @param $discount_list
         * @param $price
         * @return float|int
         */
        public function getBiggestDiscount($discount_list, $price)
        {
            $big = 0;
//            $amount = $price;
            $amount = 0;
            foreach ($discount_list as $id => $discount_item) {
                $amount_type = (isset($discount_item['amount']['percentage_discount']) ? 'percentage_discount' : 'price_discount');
                if ($amount_type == 'percentage_discount') {
                    if (isset($discount_item['amount']['percentage_discount'])) {
                        $amount = (($price / 100) * $discount_item['amount']['percentage_discount']);
                    }
                } else {
                    if (isset($discount_item['amount']['price_discount'])) {
                        $amount = $discount_item['amount']['price_discount'];
                    }
                }

                if ($big < $amount) {
                    $big = $amount;
                }
            }
            return $big;
        }

        /**
         * Finally Apply the Discount to the Cart item by update to WooCommerce Instance.
         *
         * @param $item
         * @param $amount
         * @param $log
         */
        public function applyDiscount($item, $amount, $log)
        {
            global $woocommerce;
            // Make sure item exists in cart
            if (!isset($woocommerce->cart->cart_contents[$item])) {
                return;
            }
            $product =  $woocommerce->cart->cart_contents[$item]['data'];
            // Log changes
            $woocommerce->cart->cart_contents[$item]['woo_discount'] = array(
                'original_price' => get_option('woocommerce_tax_display_cart') == 'excl' ? FlycartWoocommerceProduct::get_price_excluding_tax($product) : FlycartWoocommerceProduct::get_price_including_tax($product),
                'log' => $log,
            );

            // To handle Woocommerce currency switcher
            global $WOOCS;
            if(isset($WOOCS)){
                if (method_exists($WOOCS, 'get_currencies')){
                    $currencies = $WOOCS->get_currencies();
                    $amount = $amount / $currencies[$WOOCS->current_currency]['rate'];
                }
            }

            // Actually adjust price in cart
//            $woocommerce->cart->cart_contents[$item]['data']->price = $amount;
            FlycartWoocommerceProduct::set_price($product, $amount);

        }

        /**
         * For Show the Actual Discount of a product.
         *
         * @param integer $item_price Actual Price.
         * @param object $cart_item Cart Items.
         * @param string $cart_item_key to identify the item from cart.
         * @return string processed price of a product.
         */
        public function replaceVisiblePricesCart($item_price, $cart_item = array(), $cart_item_key = null)
        {

            if (!isset($cart_item['woo_discount'])) {
                return $item_price;
            }

            // Get price to display
            $price = get_option('woocommerce_tax_display_cart') == 'excl' ? FlycartWoocommerceProduct::get_price_excluding_tax($cart_item['data']) : FlycartWoocommerceProduct::get_price_including_tax($cart_item['data']);

            // Format price to display
            $price_to_display = FlycartWoocommerceProduct::wc_price($price);
            $original_price_to_display = FlycartWoocommerceProduct::wc_price($cart_item['woo_discount']['original_price']);;

            if ($cart_item['woo_discount']['original_price'] != $price) {
                $item_price = '<span class="cart_price"><del>' . $original_price_to_display . '</del> <ins>' . $price_to_display . '</ins></span>';
            } else {
                $item_price = $price_to_display;
            }

            return $item_price;
        }

        /**
         * Replace visible price if rule matches for variants
         * */
        public function replaceVisiblePricesForVariant($data, $product, $variations)
        {
            if(FlycartWoocommerceVersion::wcVersion('3.0')) return $data;
            $item_price = $data['price_html'];
            $notAdmin = !is_admin();
            $show_price_discount_on_product_page = (isset($this->baseConfig['show_price_discount_on_product_page']))? $this->baseConfig['show_price_discount_on_product_page']: 'dont';
            if($show_price_discount_on_product_page == 'show' && $notAdmin){
                $discountPrice = $this->getDiscountPriceForTheProduct($product, FlycartWoocommerceProduct::get_price($variations));
                if($discountPrice > 0){
                    $price_to_display = FlycartWoocommerceProduct::wc_price($discountPrice);
                    $item_price = preg_replace('/<del>.*<\/del>/', '', $item_price);
                    $item_price = '<del>' . $item_price . '</del> <ins>' . ($price_to_display).$product->get_price_suffix() . '</ins>';
                }

            }

            $data['price_html'] = $item_price;
            return $data;
        }

        /**
         * Replace visible price if rule matches
         * */
        public function replaceVisiblePrices($item_price, $product)
        {
            $notAdmin = !is_admin();
            $show_price_discount_on_product_page = (isset($this->baseConfig['show_price_discount_on_product_page']))? $this->baseConfig['show_price_discount_on_product_page']: 'dont';
            if($show_price_discount_on_product_page == 'show' && $notAdmin){
                $discountPrice = $this->getDiscountPriceForTheProduct($product);
                if($discountPrice > 0){
                    $price_to_display = FlycartWoocommerceProduct::wc_price($discountPrice);
                    $item_price = preg_replace('/<del>.*<\/del>/', '', $item_price);
                    $item_price = '<span class="cart_price"><del>' . $item_price . '</del> <ins>' . ($price_to_display).$product->get_price_suffix() . '</ins></span>';
                }
            }

            return $item_price;
        }

        /**
         * Display Product sale tag on the product page
         * */
        public function displayProductIsOnSaleTag($on_sale, $product){
            $notAdmin = !is_admin();
            $show_price_discount_on_product_page = (isset($this->baseConfig['show_sale_tag_on_product_page']))? $this->baseConfig['show_sale_tag_on_product_page']: 'dont';
            if($show_price_discount_on_product_page == 'show' && $notAdmin){
                $discountPrice = $this->getDiscountPriceForTheProduct($product);
                if($discountPrice > 0){
                    $on_sale = true;
                }
            }
            return $on_sale;
        }

        /**
         * To check discount for this product or not
         * */
        public function getDiscountPriceForTheProduct($product, $variationPrice = 0){
            $discountPrice = 0;
            $product_id = FlycartWoocommerceProduct::get_id($product);
            $item['product_id'] = $product_id;
            $item['data'] = $product;
            $item['quantity'] = ($this->getQuantityOfProductInCart($product_id))+1;
            global $woocommerce;
            $this->analyse($woocommerce);
            $this->matchRules($product_id, $item, 1);
            if(isset($this->matched_sets[$product_id])){
                if($variationPrice){
                    $discountPrice = $this->getAdjustmentDiscountedPrice($product, $product_id, $this->apply_to, $variationPrice);
                } else {
                    $discountPrice = $this->getAdjustmentDiscountedPrice($product, $product_id, $this->apply_to);
                }
            }
            return $discountPrice;
        }

        /**
         * Get Quantity of product in cart
         * */
        protected function getQuantityOfProductInCart($productId){
            $qty = 0;
            $cart = FlycartWoocommerceCart::get_cart();
            foreach ( $cart as $cart_item ) {
                if($cart_item['product_id'] == $productId ){
                    $qty =  $cart_item['quantity'];
                    break; // stop the loop if product is found
                }
            }
            return $qty;
        }

        /**
         * get discounted value
         * */
        public function getAdjustmentDiscountedPrice($cart_item, $cart_item_key, $type, $price = 0)
        {
            // All Sets are Collected properly, just process with that.
            if (!isset($cart_item)) return false;

            // If Product having the rule sets then,
            if (!isset($this->matched_sets[$cart_item_key])) return false;

            $adjustment_set = $this->matched_sets[$cart_item_key];
            if(!($price > 0)){
                $price = FlycartWoocommerceProduct::get_price($cart_item);
            }

            if(!($price > 0)){
                $children = FlycartWoocommerceProduct::get_children($cart_item);
                if(!empty($children) && is_array($children)){
                    if(isset($children[0])){
                        $product = FlycartWoocommerceProduct::wc_get_product($children[0]);
                        $price = FlycartWoocommerceProduct::get_price($product);
                    }
                }
            }
            
            $amount = 0;
            $discount = 0;
            if ($type == 'first') {
                // For Apply the First Rule.
                $discount = $this->getAmount($adjustment_set, $price, 'first');

            } else if ($type == 'biggest') {
                // For Apply the Biggest Discount.
                $discount = $this->getAmount($adjustment_set, $price, 'biggest');
            } else {
                // For Apply All Rules.
                $discount = $this->getAmount($adjustment_set, $price);
            }
            if($discount > 0){
                $amount = $price - $discount;
            }

            return $amount;
        }
    }
}
