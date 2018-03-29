<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
$active = 'pricing-rules';
include_once(WOO_DISCOUNT_DIR . '/view/includes/header.php');
include_once(WOO_DISCOUNT_DIR . '/view/includes/sub-menu.php');

$config = (isset($config)) ? $config : '{}';
$rule_id = 0;
$form = '';

$status = 'publish';

if (is_string($config)) {
    $data = json_decode($config);
} elseif (is_object($config)) {
    if (isset($config->form)) {
        $form = $config->form;
    }
}
$data = $config;
$rule_id = (isset($data->ID)) ? $data->ID : 0;

?>
<div class="container-fluid">
    <form id="form_price_rule">
        <div class="row-fluid">
            <div class="col-md-8">
                <div class="col-md-12" align="right">
                    <input type="submit" id="savePriceRule" value="Save Rule" class="button button-primary">
                    <a href="?page=woo_discount_rules" class="button button-secondary">Cancel</a>
                </div>
                <?php if ($rule_id == 0) { ?>
                    <div class="col-md-12"><h2>New Price Rule</h2></div>
                <?php } else { ?>
                    <div class="col-md-12"><h2>Edit Price Rule
                            | <?php echo(isset($data->rule_name) ? $data->rule_name : ''); ?></h2></div>
                <?php } ?>
                <div class="col-md-12" id="general_block"><h4 class="text text-muted"> General</h4>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"><label> Order : <i
                                        class="text-muted glyphicon glyphicon-exclamation-sign"
                                        title="The Simple Ranking concept to said, which one is going to execute first and so on."></i></label>
                            </div>
                            <div class="col-md-6"><input type="number" class="rule_order"
                                                         id="rule_order"
                                                         name="rule_order"
                                                         min=1
                                                         value="<?php echo(isset($data->rule_order) ? $data->rule_order : '-'); ?>"
                                                         placeholder="ex. 1">
                                <code>WARNING: More than one rule should not have same priority. </code>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"><label> Rule Name <i
                                        class="text-muted glyphicon glyphicon-exclamation-sign"
                                        title="Rule Desctriptions."></i></label></div>
                            <div class="col-md-6"><input type="text" class="form-control rule_descr"
                                                         id="rule_name"
                                                         name="rule_name"
                                                         value="<?php echo(isset($data->rule_name) ? $data->rule_name : ''); ?>"
                                                         placeholder="ex. Standard Rule."></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"><label> Rule Description <i
                                        class="text-muted glyphicon glyphicon-exclamation-sign"
                                        title="Rule Desctriptions."></i></label></div>
                            <div class="col-md-6"><input type="text" class="form-control rule_descr"
                                                         name="rule_descr"
                                                         value="<?php echo(isset($data->rule_descr) ? $data->rule_descr : ''); ?>"
                                                         id="rule_descr"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"><label> Method <i
                                        class="text-muted glyphicon glyphicon-exclamation-sign"
                                        title="Method to Apply."></i></label></div>
                            <?php $opt = (isset($data->rule_method) ? $data->rule_method : ''); ?>
                            <div class="col-md-6"><select class="form-control"
                                                          name="rule_method" id="price_rule_method">
                                    <option
                                        value="qty_based" <?php if ($opt == 'qty_based') { ?> selected=selected <?php } ?>>
                                        Quantity based by product/category and BOGO deals
                                    </option>
                                    <option
                                        <?php if (!$pro) { ?> disabled <?php } else { ?> value="product_based" <?php
                                        }
                                        if ($opt == 'product_based') { ?> selected=selected <?php } ?>>
                                        <?php if (!$pro) { ?>
                                            Dependant product based discount <b><?php echo $suffix; ?></b>
                                        <?php } else { ?>
                                            Dependant product based discount
                                        <?php } ?>
                                    </option>
                                </select></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"><label> Validity <i
                                        class="text-muted glyphicon glyphicon-exclamation-sign"
                                        title="Period of Rule Active."></i></label></div>
                            <div class="col-md-6">
                                <div class="form-inline"><input type="text"
                                                                name="date_from"
                                                                class="form-control datepicker"
                                                                value="<?php echo(isset($data->date_from) ? $data->date_from : ''); ?>"
                                                                placeholder="From">
                                    <input type="text" name="date_to"
                                           class="form-control datepicker"
                                           value="<?php echo(isset($data->date_to) ? $data->date_to : ''); ?>"
                                           placeholder="To - Leave Empty if No Expiry"></div>
                            </div>
                        </div>
                        <div align="right">
                            <input type="button" class="button button-primary restriction_tab" value="Next">
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="restriction_block"><h4 class="text text-muted"> Discount
                        Conditions </h4>
                    <hr>
                    <div class="qty_based_condition_cont price_discount_condition_con">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label> Apply To </label></div>
                                <?php $opt = (isset($data->apply_to) ? $data->apply_to : ''); ?>
                                <div class="col-md-6"><select class="selectpicker"
                                                              name="apply_to" id="apply_to">
                                        <option
                                            value="all_products" <?php if ($opt == 'all_products') { ?> selected=selected <?php } ?>>
                                            All Products
                                        </option>
                                        <option
                                            <?php if (!$pro) { ?> disabled <?php } else { ?> value="specific_category" <?php }
                                            if ($opt == 'specific_category') { ?> selected=selected <?php } ?>>
                                            <?php if (!$pro) { ?>
                                                Specific Categories <b><?php echo $suffix; ?></b>
                                            <?php } else { ?>
                                                Specific Categories
                                            <?php } ?>
                                        </option>
                                        <option
                                            value="specific_products" <?php if ($opt == 'specific_products') { ?> selected=selected <?php } ?>>
                                            Specific Products
                                        </option>
                                    </select>
                                    <div class="form-group" id="product_list">
                                        <?php $products_list = json_decode((isset($data->product_to_apply) ? $data->product_to_apply : '{}'), true);
                                        echo FlycartWoocommerceProduct::getProductAjaxSelectBox($products_list, 'product_to_apply');
                                        ?>
                                    </div>
                                    <div class="form-group" id="category_list">
                                        <?php $category_list = json_decode((isset($data->category_to_apply) ? $data->category_to_apply : '{}'), true); ?>
                                        <select class="category_list selectpicker" multiple
                                                name="category_to_apply[]">
                                            <?php foreach ($category as $index => $value) { ?>
                                                <option
                                                    value="<?php echo $index; ?>"<?php if (in_array($index, $category_list)) { ?> selected=selected <?php } ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $is_cumulative = (isset($data->is_cumulative))? $data->is_cumulative : 0 ?>
                                        <input type="checkbox" name="is_cumulative" id="is_cumulative" value="1" <?php if($is_cumulative) { echo "checked"; } ?>> <label class="checkbox_label" for="is_cumulative">Is Cumulative</label>
                                        <div class="apply_child_categories">
                                            <?php $apply_child_categories = (isset($data->apply_child_categories))? $data->apply_child_categories : 0 ?>
                                            <input type="checkbox" name="apply_child_categories" id="apply_child_categories" value="1" <?php if($apply_child_categories) { echo "checked"; } ?>> <label class="checkbox_label" for="apply_child_categories">Apply Child Categories</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label> Customers </label></div>
                                <?php $opt = (isset($data->customer) ? $data->customer : ''); ?>
                                <div class="col-md-6"><select class="selectpicker"
                                                              name="customer" id="apply_customer">
                                        <option value="all" <?php if ($opt == 'all') { ?> selected=selected <?php } ?>>
                                            All
                                        </option>
                                        <option
                                            <?php if (!$pro) { ?> disabled <?php } else { ?> value="only_given" <?php
                                            }
                                            if ($opt == 'only_given') { ?> selected=selected <?php } ?>>
                                            <?php if (!$pro) { ?>
                                                Only Given <b><?php echo $suffix; ?></b>
                                            <?php } else { ?>
                                                Only Given
                                            <?php } ?>
                                        </option>
                                    </select>
                                    <div class="form-group" id="user_list">
                                        <?php $users_list = json_decode((isset($data->users_to_apply) ? $data->users_to_apply : '{}'), true);
                                        echo FlycartWoocommerceProduct::getUserAjaxSelectBox($users_list, 'users_to_apply');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label> <?php esc_html_e('User roles', 'woo-discount-rules') ?> </label></div>
                                <div class="col-md-6">
                                    <?php
                                    if($pro){
                                        $roles_list = json_decode((isset($data->user_roles_to_apply) ? $data->user_roles_to_apply : '{}'), true); ?>
                                        <select class="roles_list selectpicker" id="product_roles_list" multiple name="user_roles_to_apply[]">
                                            <?php foreach ($userRoles as $index => $user) { ?>
                                                <option value="<?php echo $index; ?>"<?php if (in_array($index, $roles_list)) { ?> selected=selected <?php } ?>><?php echo $user; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="woo-support-in_pro">
                                            <?php
                                            esc_html_e('Supported in PRO version', 'woo-discount-rules');
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label><?php esc_html_e('Purchase History', 'woo-discount-rules'); ?></label></div>
                                <?php $based_on_purchase_history = (isset($data->based_on_purchase_history) ? $data->based_on_purchase_history : 0); ?>
                                <div class="col-md-6">
                                    <?php
                                    if($pro){
                                    ?>
                                        <input type="checkbox" class="" id="based_on_purchase_history" name="based_on_purchase_history"
                                               value="1" <?php if($based_on_purchase_history){ echo 'checked'; } ?>>
                                        <label class="checkbox_label" for="based_on_purchase_history"><?php esc_html_e('Yes, based on Purchase history.', 'woo-discount-rules'); ?></label>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="woo-support-in_pro">
                                            <?php
                                            esc_html_e('Supported in PRO version', 'woo-discount-rules');
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="form-group" id="based_on_purchase_history_fields">
                                        <?php $purchased_history_amount = (isset($data->purchased_history_amount) ? $data->purchased_history_amount : 0); ?>
                                        <label><?php esc_html_e('Total purchased amount at least', 'woo-discount-rules'); ?></label>
                                        <input type="text" value="<?php echo $purchased_history_amount; ?>" name="purchased_history_amount"/>
                                        <label><?php esc_html_e('In Order status', 'woo-discount-rules'); ?></label>
                                        <?php
                                        $woocommerce_order_status = wc_get_order_statuses();
                                        $purchase_history_status_list = json_decode((isset($data->purchase_history_status_list) ? $data->purchase_history_status_list : '{}'), true);
                                        if(empty($purchase_history_status_list)){
                                            $purchase_history_status_list[] = 'wc-completed';
                                        }
                                        ?>
                                        <select class="purchase_history_status_list selectpicker" multiple name="purchase_history_status_list[]">
                                            <?php foreach ($woocommerce_order_status as $index => $value) { ?>
                                                <option
                                                        value="<?php echo $index; ?>"<?php if (in_array($index, $purchase_history_status_list)) { ?> selected=selected <?php } ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_based_condition_cont price_discount_condition_con">
                        <?php
                        $product_based_conditions = json_decode((isset($data->product_based_condition) ? $data->product_based_condition : '{}'), true);
                        $product_based_condition_product_buy_type = isset($product_based_conditions['product_buy_type']) ? $product_based_conditions['product_buy_type'] : 'any';
                        $product_based_condition_product_quantity_rule = isset($product_based_conditions['product_quantity_rule']) ? $product_based_conditions['product_quantity_rule'] : 'more';
                        $product_based_condition_product_quantity_from = isset($product_based_conditions['product_quantity_from']) ? $product_based_conditions['product_quantity_from'] : '';
                        $product_based_condition_product_quantity_to = isset($product_based_conditions['product_quantity_to']) ? $product_based_conditions['product_quantity_to'] : '';
                        $product_based_condition_product_to_buy = isset($product_based_conditions['product_to_buy']) ? $product_based_conditions['product_to_buy'] : array();
                        $product_based_condition_product_to_apply = isset($product_based_conditions['product_to_apply']) ? $product_based_conditions['product_to_apply'] : array();
                        ?>
                        <div class="form-group" id="product_list">
                            <label ><?php esc_html_e('Buy', 'woo-discount-rules') ?></label>
                            <select class="selectpicker" name="product_based_condition[product_buy_type]">
                                <option value="any"<?php echo ($product_based_condition_product_buy_type == 'any')? ' selected="selected"': ''; ?>><?php esc_html_e('Any', 'woo-discount-rules') ?></option>
                                <option value="each"<?php echo ($product_based_condition_product_buy_type == 'each')? ' selected="selected"': ''; ?>><?php esc_html_e('Each', 'woo-discount-rules') ?></option>
                                <option value="combine"<?php echo ($product_based_condition_product_buy_type == 'combine')? ' selected="selected"': ''; ?>><?php esc_html_e('Combine', 'woo-discount-rules') ?></option>
                            </select>
                            <select class="selectpicker" id="product_based_condition_quantity_rule" name="product_based_condition[product_quantity_rule]">
                                <option value="more"<?php echo ($product_based_condition_product_quantity_rule == 'more')? ' selected="selected"': ''; ?>><?php esc_html_e('More than', 'woo-discount-rules') ?></option>
                                <option value="less"<?php echo ($product_based_condition_product_quantity_rule == 'less')? ' selected="selected"': ''; ?>><?php esc_html_e('Less than', 'woo-discount-rules') ?></option>
                                <option value="equal"<?php echo ($product_based_condition_product_quantity_rule == 'equal')? ' selected="selected"': ''; ?>><?php esc_html_e('Equal', 'woo-discount-rules') ?></option>
                                <option value="from"<?php echo ($product_based_condition_product_quantity_rule == 'from')? ' selected="selected"': ''; ?>><?php esc_html_e('From', 'woo-discount-rules') ?></option>
                            </select>
                            <input placeholder="<?php esc_html_e('Quantity', 'woo-discount-rules') ?>" type="text" name="product_based_condition[product_quantity_from]" value="<?php echo $product_based_condition_product_quantity_from; ?>"/ >
                            <div class="product_based_condition_to">
                                <label ><?php esc_html_e('to', 'woo-discount-rules')?></label>
                                <input placeholder="<?php esc_html_e('Quantity', 'woo-discount-rules') ?>" type="text" name="product_based_condition[product_quantity_to]" value="<?php echo $product_based_condition_product_quantity_to; ?>"/ >
                            </div>
                            <label ><?php esc_html_e('Product(s) from', 'woo-discount-rules')?></label>
                            <?php echo FlycartWoocommerceProduct::getProductAjaxSelectBox($product_based_condition_product_to_buy, 'product_based_condition[product_to_buy]'); ?>
                            <label ><?php esc_html_e('and get discount in ', 'woo-discount-rules') ?></label>
                            <?php echo FlycartWoocommerceProduct::getProductAjaxSelectBox($product_based_condition_product_to_apply, 'product_based_condition[product_to_apply]'); ?>
                            <label ><?php esc_html_e('Product(s)', 'woo-discount-rules') ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div align="right">
                                <input type="button" class="button button-secondary general_tab" value="Previous">
                                <input type="button" class="button button-primary discount_tab" value="Next">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TODO: Implement ForEach Concept -->
                <div class="col-md-12" id="discount_block">
                    <h4 class="text text-muted"> Discount</h4>
                    <div class="qty_based_discount_cont price_discounts_con">
                        <a href=javascript:void(0) class="button button-primary" id="addNewDiscountRange"><i
                                class="glyphicon glyphicon-plus"></i> Add New Range</a>
                        <hr>
                        <div id="discount_rule_list">
                            <?php
                            $discount_range = new stdClass();
                            if (isset($data->discount_range)) {
                                if (is_string($data->discount_range)) {
                                    $discount_range = json_decode($data->discount_range);
                                } else {
                                    $discount_range = $data->discount_range;
                                }
                            }

                            // Make Dummy Element.
                            if ($discount_range == '') $discount_range = array(0 => '');
                            $fieldIndex = 1;
                            foreach ($discount_range as $index => $discount) {
                                ?>
                                <div class="discount_rule_list">
                                    <div class="form-group">
                                        <label>Min Quantity
                                            <input type="text"
                                                   name="discount_range[<?php echo $fieldIndex; ?>][min_qty]"
                                                   class="form-control"
                                                   value="<?php echo(isset($discount->min_qty) ? $discount->min_qty : ''); ?>"
                                                   placeholder="ex. 1">
                                        </label>
                                        <label>Max Quantity
                                            <input type="text"
                                                   name="discount_range[<?php echo $fieldIndex; ?>][max_qty]"
                                                   class="form-control"
                                                   value="<?php echo(isset($discount->max_qty) ? $discount->max_qty : ''); ?>"
                                                   placeholder="ex. 50"> </label>
                                        <label>Adjustment Type
                                            <select class="form-control price_discount_type"
                                                    name="discount_range[<?php echo $fieldIndex; ?>][discount_type]">
                                                <?php $opt = (isset($discount->discount_type) ? $discount->discount_type : ''); ?>
                                                <option
                                                    value="percentage_discount" <?php if ($opt == 'percentage_discount') { ?> selected=selected <?php } ?> >
                                                    Percentage Discount
                                                </option>

                                                <option
                                                    <?php if (!$pro) { ?> disabled <?php } else { ?> value="price_discount" <?php
                                                    }
                                                    if ($opt == 'price_discount') { ?> selected=selected <?php } ?>>
                                                    <?php if (!$pro) { ?>
                                                        Price Discount <b><?php echo $suffix; ?></b>
                                                    <?php } else { ?>
                                                        Price Discount
                                                    <?php } ?>
                                                </option>
                                                <option
                                                    <?php if (!$pro) { ?> disabled <?php } else { ?> value="product_discount" <?php
                                                    }
                                                    if ($opt == 'product_discount') { ?> selected=selected <?php } ?>>
                                                    <?php if (!$pro) { ?>
                                                        Product Discount <b><?php echo $suffix; ?></b>
                                                    <?php } else { ?>
                                                        Product Discount
                                                    <?php } ?>
                                                </option>
                                            </select></label>
                                        <label><span class="hide-for-product-discount">Value</span>
                                            <input type="text"
                                                   name="discount_range[<?php echo $fieldIndex; ?>][to_discount]"
                                                   class="form-control price_discount_amount"
                                                   value="<?php echo(isset($discount->to_discount) ? $discount->to_discount : ''); ?>"
                                                   placeholder="ex. 50">
                                            <?php
                                            $products_list = (isset($discount->discount_product) ? $discount->discount_product : array());
                                            $discount_product_option = (isset($discount->discount_product_option) ? $discount->discount_product_option : 'all');
                                            ?>
                                            <div class="price_discount_product_list_con">
                                                <?php esc_html_e('Apply for', 'woo-discount-rules') ?>
                                                <select class="selectpicker discount_product_option" name="discount_range[<?php echo $fieldIndex; ?>][discount_product_option]">
                                                    <option value="all"<?php echo ($discount_product_option == 'all')? ' selected="selected"': '' ?>><?php esc_html_e('All selected', 'woo-discount-rules') ?></option>
                                                    <option value="any_cheapest"<?php echo ($discount_product_option == 'any_cheapest')? ' selected="selected"': '' ?>><?php esc_html_e('Any one cheapest from selected', 'woo-discount-rules') ?></option>
                                                    <option value="any_cheapest_from_all"<?php echo ($discount_product_option == 'any_cheapest_from_all')? ' selected="selected"': '' ?>><?php esc_html_e('Any one cheapest from all products', 'woo-discount-rules') ?></option>
                                                </select>
                                                <div class="discount_product_option_list_con hide">
                                                    <?php
                                                    echo FlycartWoocommerceProduct::getProductAjaxSelectBox($products_list, "discount_range[".$fieldIndex."][discount_product]");
                                                    ?>
                                                </div>
                                            </div>
                                        </label>

                                        <label>Action <a href=javascript:void(0)
                                                         class="button button-secondary form-control remove_discount_range">Remove</a></label>

                                    </div>
                                </div>
                            <?php $fieldIndex++; } ?>
                        </div>
                    </div>
                    <div class="product_based_discount_cont price_discounts_con">
                        <div class="price_discount_product_list_con">
                            <?php
                            $product_based_discounts = json_decode((isset($data->product_based_discount) ? $data->product_based_discount : '{}'), true);
                            $product_based_discount_type = isset($product_based_discounts['discount_type']) ? $product_based_discounts['discount_type'] : 'percentage_discount';
                            $product_based_discount_value = isset($product_based_discounts['discount_value']) ? $product_based_discounts['discount_value'] : '';
                            ?>
                            <select class="selectpicker" name="product_based_discount[discount_type]">
                                <option value="percentage_discount"<?php echo ($product_based_discount_type == 'percentage_discount')? ' selected="selected"': ''; ?>><?php esc_html_e('Percent', 'woo-discount-rules') ?></option>
                                <option value="price_discount"<?php echo ($product_based_discount_type == 'price_discount')? ' selected="selected"': ''; ?>><?php esc_html_e('Fixed', 'woo-discount-rules') ?></option>
                            </select> <label><?php esc_html_e('Value', 'woo-discount-rules') ?></label>
                            <input type="text" name="product_based_discount[discount_value]" value="<?php echo $product_based_discount_value; ?>" />
                        </div>
                    </div>
                    <div align="right">
                        <input type="button" class="button button-secondary restriction_tab" value="Previous">
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <!-- Sidebar -->
            <?php include_once(__DIR__ . '/template/sidebar.php'); ?>
            <!-- Sidebar END -->
            <input type="hidden" name="rule_id" id="rule_id" value="<?php echo $rule_id; ?>">
            <input type="hidden" name="form" value="<?php echo $form; ?>">
            <input type="hidden" id="ajax_path" value="<?php echo admin_url('admin-ajax.php'); ?>">
            <input type="hidden" id="admin_path"
                   value="<?php echo admin_url('admin.php?page=woo_discount_rules'); ?>">
            <input type="hidden" id="pro_suffix" value="<?php echo $suffix; ?>">
            <input type="hidden" id="is_pro" value="<?php echo $pro; ?>">
            <input type="hidden" id="flycart_wdr_woocommerce_version" value="<?php echo $flycart_wdr_woocommerce_version; ?>">
    </form>
</div>

<?php include_once(WOO_DISCOUNT_DIR . '/view/includes/footer.php'); ?>
