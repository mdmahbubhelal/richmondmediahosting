jQuery.noConflict();
function validateFields(){
    var returnValue = false;
    (function ($) {
        var rule_order = $('#rule_order');
        if(rule_order.val() != ''){
            rule_order.removeClass('invalid-field');
            rule_order.next('.error').remove();
            returnValue = true;
        } else {
            $('a.general_tab').trigger('click');
            rule_order.addClass('invalid-field');
            rule_order.next('.error').remove();
            rule_order.after('<span class="error">Please fill this field</span>');
            returnValue = false;
        }

    })(jQuery);
    return returnValue;
}
(function ($) {
    jQuery(document).ready(function () {
        var ajax_url = $('#ajax_path').val();
        var admin_url = $('#admin_path').val();
        var pro_suffix = $('#pro_suffix').val();
        var is_pro = $('#is_pro').val();
        $(".datepicker").datepicker();

        //--------------------------------------------------------------------------------------------------------------
        //--------------------------------------------PRICING RULES-----------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------


        // Manage Product Selection ON-LOAD
        var active_selection = $('#apply_to').val();
        if (active_selection == 'specific_products') {
            $('#product_list').css('display', 'block');
            $('#category_list').css('display', 'none');
        } else if (active_selection == 'specific_category') {
            $('#product_list').css('display', 'none');
            $('#category_list').css('display', 'block');
        } else {
            $('#product_list').css('display', 'none');
            $('#category_list').css('display', 'none');
        }

        // Manage Customer Selection ON-LOAD
        var user_selection = $('#apply_customer').val();
        if (user_selection == 'only_given') {
            $('#user_list').css('display', 'block');
        } else {
            $('#user_list').css('display', 'none');
        }

        // Saving Rule.
        $('#savePriceRule').on('click', function (event) {
            var validate = validateFields();

            if(validate == false){
                return false;
            }
            var form = $('#form_price_rule').serialize();
            var current = $(this);
            var rule_id = $('#rule_id').val();
            event.preventDefault();
            console.log($('#rule_name').val());
            if ($('#rule_name').val() == '') {
                alert('Please Enter the Rule Name to Create / Save.');
            } else {
                current.removeClass('button-primary');
                current.addClass('button-secondary');
                current.val('Saving...');
                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {action: 'savePriceRule', data: form},
                    success: function () {
                        // After Status Changed.

                        resizeChart = setTimeout(function () {
                            current.addClass('button-primary');
                            current.removeClass('button-secondary');
                            current.val('Save Rule');
                        }, 300);
                        console.log(rule_id);
                        // Reset, if its New Form.
                        if (rule_id == 0) {
                            console.log(admin_url);
                            $('#form_price_rule')[0].reset();

                            $(location).attr('href', admin_url);
                        }
                        adminNotice();
                    }

                });
            }
        });

        // License key check
        $('#woo-disc-license-check').on('click', function (event) {
            var license_key = $('#woo-disc-license-key');
            var resp_msg = $('#woo-disc-license-check-msg');
            if(license_key.val() == ''){
                license_key.addClass('invalid-field');
                resp_msg.html('<div class="notice-message error inline notice-error notice-alt">Please enter a Key</div>');
                return false;
            }else{
                license_key.removeClass('invalid-field');
                resp_msg.html('');
            }
            
            var form = $('#discount_config').serialize();
            var current = $(this);
            
            event.preventDefault();

            current.removeClass('button-primary');
            current.addClass('button-secondary');
            current.val('Saving...');
            $('.license-success, .license-failed').hide();
            var license_chk_req = $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {action: 'forceValidateLicenseKey', data: form},
                success: function () {
                    resizeChart = setTimeout(function () {
                        current.addClass('button-primary');
                        current.removeClass('button-secondary');
                        current.val('Validate');
                    }, 300);
                    
                    //adminNotice();
                    // display a success message
                }
            });
            license_chk_req.done(function( resp ) {
                    
                   response = JSON.parse(resp);
                    if (response['error']) {
                        resp_msg.html('<div class="notice-message error inline notice-error notice-alt">'+response['error']+'</div>');
                    } else if( response['success']){
                        resp_msg.html('<div class="notice-message success inline notice-success notice-alt">'+response['success']+'</div>');
                    }
                    
                });
        });


        // Adding New Discount Range.
        $('#addNewDiscountRange').on('click', function () {
            var count = $('.discount_rule_list').length + 1;
            if (is_pro) {
                var form = '<div class="discount_rule_list"> <div class="form-group"><label>Min Quantity <input type="text" name="discount_range[' + count + '][min_qty]" class="form-control" value="" placeholder="ex. 1"></label>' +
                    '<label>Max Quantity <input type="text" name="discount_range[' + count + '][max_qty]" class="form-control" value="" placeholder="ex. 50"> </label> <label>Adjustment Type<select class="form-control price_discount_type" name="discount_range[' + count + '][discount_type]"> ' +
                    '<option value="percentage_discount"> Percentage Discount </option> <option value="price_discount">Price Discount </option> <option value="product_discount">Product Discount </option> </select></label> <label>Value ' +
                    '<input type="text" name="discount_range[' + count + '][to_discount]" class="form-control price_discount_amount" value="" placeholder="ex. 50"> ';
                form += '<div class="price_discount_product_list_con hide">' +
                    ' Apply for <select class="selectpicker discount_product_option" name="discount_range['+count+'][discount_product_option]"><option value="all">All selected</option><option value="any_cheapest">Any one cheapest from selected</option><option value="any_cheapest_from_all">Any one cheapest from all products</option>' +
                    '</select>';
                form += '<div class="discount_product_option_list_con">';
                if($('#flycart_wdr_woocommerce_version').val() == 2){
                    form += '<input type="hidden" class="wc-product-search" style="width: 250px" data-multiple="true" name="discount_range[' + count + '][discount_product][]" data-placeholder="Search for a product&hellip;" data-action="woocommerce_json_search_products_and_variations" data-selected=""/>';
                } else {
                    form += '<select class="wc-product-search" multiple="multiple" style="width: 250px" name="discount_range[' + count + '][discount_product][]" data-placeholder="Search for a product&hellip;" data-action="woocommerce_json_search_products_and_variations"></select>'
                }
                form += '</div>';
                form += '</div>';
                form += '</label> <label>Action <a href=javascript:void(0) class="button button-secondary form-control remove_discount_range">Remove</a></label> </div> </div>';
            } else {
                var form = '<div class="discount_rule_list"> <div class="form-group"><label>Min Quantity <input type="text" name="discount_range[' + count + '][min_qty]" class="form-control" value="" placeholder="ex. 1"></label>' +
                    '<label>Max Quantity <input type="text" name="discount_range[' + count + '][max_qty]" class="form-control" value="" placeholder="ex. 50"> </label> <label>Adjustment Type<select class="form-control price_discount_type" name="discount_range[' + count + '][discount_type]"> ' +
                    '<option value="percentage_discount"> Percentage Discount </option> <option disabled>Price Discount <b>' + pro_suffix + '</b> </option> <option disabled>Product Discount <b>' + pro_suffix + '</b> </option> </select></label> <label>Value ' +
                    '<input type="text" name="discount_range[' + count + '][to_discount]" class="form-control price_discount_amount" value="" placeholder="ex. 50"> ';
                form += '<div class="price_discount_product_list_con hide"><select class="product_list selectpicker price_discount_product_list" multiple name="discount_range[' + count + '][discount_product][]">';
                form += '<option>none</option>';
                form += '</select></div>';
                form += '</label> <label>Action <a href=javascript:void(0) class="button button-secondary form-control remove_discount_range">Remove</a></label> </div> </div>';
            }
            $('#discount_rule_list').append(form);
            $('.product_list,.selectpicker').selectpicker('refresh');
            $('.wc-product-search').trigger( 'wc-enhanced-select-init' );
        });

        // Removing Discount Rule.
        $(document).on('click', '.remove_discount_range', function () {
            var confirm_delete = confirm('Are you sure to remove this ?');
            if (confirm_delete) {
                $(this).closest('.discount_rule_list').remove();
            }
        });

        // Enabling and Disabling the Status of the Rule.
        $('.manage_status').on('click', function (event) {
            event.preventDefault();
            var current = $(this);
            var id = $(this).attr('id');
            id = id.replace('state_', '');
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {action: 'UpdateStatus', id: id, from: 'pricing-rules'},
                success: function (status) {
                    // After Status Changed.
                    if (status == 'Disable') {
                        current.addClass('button-primary');
                        current.removeClass('button-secondary');
                        current.html('Enable');
                    } else if (status == 'Publish') {
                        current.removeClass('button-primary');
                        current.addClass('button-secondary');
                        current.html('Disable');
                    }
                }

            });
        });

        // Remove Rule.
        $('.delete_rule').on('click', function (event) {
            event.preventDefault();
            var current = $(this);
            var id = $(this).attr('id');
            id = id.replace('delete_', '');
            var confirm_delete = confirm('Are you sure to remove ?');
            if (confirm_delete) {
                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {action: 'RemoveRule', id: id, from: 'pricing-rules'},
                    success: function () {
                        // After Removed.
                        current.closest('tr').remove();
                        location.reload();
                    }
                });
            }
        });

        $('#restriction_block').hide();
        $('#discount_block').hide();

        $('.general_tab').on('click', function () {
            $('#general_block').show();
            $('#restriction_block').hide();
            $('#discount_block').hide();
        });
        $('.restriction_tab').on('click', function () {
            if(validateFields() == true){
                $('#general_block').hide();
                $('#restriction_block').show();
                $('#discount_block').hide();
            }
        });
        $('.discount_tab').on('click', function () {
            $('#general_block').hide();
            $('#restriction_block').hide();
            $('#discount_block').show();
        });

        // Manage the Type of Apply.
        $('#apply_to').on('change', function () {
            var option = $(this).val();

            if (option == 'specific_products') {
                $('#product_list').css('display', 'block');
                $('#category_list').css('display', 'none');
            } else if (option == 'specific_category') {
                $('#product_list').css('display', 'none');
                $('#category_list').css('display', 'block');
            } else {
                $('#product_list').css('display', 'none');
                $('#category_list').css('display', 'none');
            }
        });

        // Manage the Customer.
        $('#apply_customer').on('change', function () {
            var option = $(this).val();
            console.log(option);
            if (option == 'only_given') {
                $('#user_list').show();
            } else {
                $('#user_list').hide();
            }
        });

        $(document).on('keyup', '.rule_descr', function () {
            var value = $(this).val();
            value = '| ' + value;
            var id = $(this).attr('id');
            id = id.replace('rule_descr_', '');
            $('#rule_label_' + id).html(value);
        });


        //--------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------CART RULES-----------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------

        $(document).on('click', '#add_cart_rule', function () {

            var count = $('.cart_rules_list').length;
            console.log(count);
            // Cloning the List.
            var user_list = $('#cart_user_list_0 > option').clone();
            var product_list = $('#cart_product_list_0 > option').clone();
            var category_list = $('#cart_category_list_0 > option').clone();
            var roles_list = $('#cart_roles_list_0 > option').clone();
            var country_list = $('#cart_countries_list_0 > option').clone();
            var order_status_list = $('#order_status_list_0 > option').clone();
            if (is_pro) {
                var form = '<div class="cart_rules_list row"> <div class="col-md-3 form-group"> <label>Type <select class="form-control cart_rule_type" id="cart_condition_type_' + count + '" name="discount_rule[' + count + '][type]"> <optgroup label="Cart Subtotal"><option value="subtotal_least" selected="selected">Subtotal at least</option><option value="subtotal_less">Subtotal less than</option></optgroup>' +
                    '<optgroup label="Cart Item Count"><option value="item_count_least">Count of cart items at least</option><option value="item_count_less">Count of cart items less than</option></optgroup>' +
                    '<optgroup label="Quantity Sum"><option value="quantity_least">Sum of item quantities at least</option><option value="quantity_less">Sum of item quantities less than</option></optgroup><!-- At least one of these should present in the cart to apply. -->' +
                    '<optgroup label="Categories In Cart"><!-- At least one of these should present in the cart to apply. -->' +
                    '<option value="categories_in">Categories in cart</option>' +
                    '</optgroup>' +
                    '<optgroup label="Customer Details (must be logged in)"><option value="users_in">User in list</option><option value="roles_in">User role in list</option><option value="shipping_countries_in">Shipping country in list</option></optgroup>' +
                    '<optgroup label="Customer Email Domain (Eg: edu)"><option value="customer_email_tld">Email ends with</option></optgroup>' +
                    '<optgroup label="Customer Billing Details"><option value="customer_billing_city">Billing city</option></optgroup>' +
                    '<optgroup label="Purchase History"><option value="customer_based_on_purchase_history">Based on Purchase history</option></optgroup></select></label></div>' +
                    '<div class="col-md-3 form-group"><label> Value<div id="general_' + count + '"><input type="text" name="discount_rule[' + count + '][option_value]"></div>' +
                    '<div id="user_div_' + count + '">';
                if($('#flycart_wdr_woocommerce_version').val() == 2){
                    form += '<input class="wc-customer-search" style="width: 250px" name="discount_rule[' + count + '][users_to_apply][]" data-placeholder="Search for a user&hellip;"/>';
                } else {
                    form += '<select class="wc-customer-search" style="width: 250px" multiple="multiple" name="discount_rule[' + count + '][users_to_apply][]" data-placeholder="Search for a user&hellip;"></select>';
                }
                form += '</div>' +
                    '<div id="product_div_' + count + '"><select id="cart_product_list_' + count + '" class="product_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][product_to_apply][]"></select></div>' +
                    '<div id="category_div_' + count + '"><select id="cart_category_list_' + count + '" class="category_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][category_to_apply][]"></select></div>' +
                    '<div id="roles_div_' + count + '"><select id="cart_roles_list_' + count + '" class="roles_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][user_roles_to_apply][]"></select></div>' +
                    '<div id="countries_div_' + count + '"><select id="cart_countries_list_' + count + '" class="country_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][countries_to_apply][]"></select></div>' +
                    '<div id="purchase_history_div_' + count + '">Total purchased amount at least <input name="discount_rule[' + count + '][purchased_history_amount]" value="" type="text"/> In Order status <select id="order_status_list_' + count + '" class="order_status_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][purchase_history_order_status][]"></select></div>' +
                    '</div><div class="col-md-1"> <label> Action <a href=javascript:void(0) class="button button-secondary remove_cart_rule">Remove</a> </label> </div>' +
                    '</label></div>';
            } else {
                var form = '<div class="cart_rules_list row"> <div class="col-md-3 form-group"> <label>Type <select class="form-control cart_rule_type" id="cart_condition_type_' + count + '" name="discount_rule[' + count + '][type]"> <optgroup label="Cart Subtotal"><option value="subtotal_least" selected="selected">Subtotal at least</option><option value="subtotal_less">Subtotal less than</option></optgroup>' +
                    '<optgroup label="Cart Item Count"><option value="item_count_least">Count of cart items at least</option><option value="item_count_less">Count of cart items less than</option></optgroup>' +
                    '<optgroup label="Quantity Sum"><option disabled>Sum of item quantities at least <b>' + pro_suffix + '</b></option><option disabled>Sum of item quantities less than <b>' + pro_suffix + '</b></option></optgroup><!-- At least one of these should present in the cart to apply. -->' +
                    '<optgroup label="Categories In Cart"><!-- At least one of these should present in the cart to apply. -->' +
                        '<option disabled>Categories in cart <b>' + pro_suffix + '</b></option>' +
                    '</optgroup>' +
                    '<optgroup label="Customer Details (must be logged in)"><option disabled>User in list <b>' + pro_suffix + '</b></option><option disabled>User role in list <b>' + pro_suffix + '</b></option><option disabled>Shipping country in list <b>' + pro_suffix + '</b></option></optgroup>' +
                    '<optgroup label="Customer Email Domain (Eg: edu)"><option disabled>Email ends with <b>' + pro_suffix + '</b></option></optgroup>' +
                    '<optgroup label="Customer Billing Details"><option disabled>Billing city <b>' + pro_suffix + '</b></option></optgroup>' +
                    '<optgroup label="Purchase History"><option disabled>Based on Purchase history <b>' + pro_suffix + '</b></option></optgroup></select></label></div>' +
                    '<div class="col-md-3 form-group"><label> Value<div id="general_' + count + '"><input type="text" name="discount_rule[' + count + '][option_value]"></div>' +
                    '<div id="user_div_' + count + '"><select id="cart_user_list_' + count + '" class="user_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][users_to_apply][]"></select></div>' +
                    '<div id="product_div_' + count + '"><select id="cart_product_list_' + count + '" class="product_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][product_to_apply][]"></select></div>' +
                    '<div id="category_div_' + count + '"><select id="cart_category_list_' + count + '" class="category_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][category_to_apply][]"></select></div>' +
                    '<div id="roles_div_' + count + '"><select id="cart_roles_list_' + count + '" class="roles_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][user_roles_to_apply][]"></select></div>' +
                    '<div id="countries_div_' + count + '"><select id="cart_countries_list_' + count + '" class="country_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][countries_to_apply][]"></select></div>' +
                    '<div id="purchase_history_div_' + count + '"><select id="order_status_list_' + count + '" class="order_status_list selectpicker"  data-live-search="true" multiple name="discount_rule[' + count + '][purchase_history_order_status][]"></select></div>' +
                    '</div><div class="col-md-1"> <label> Action <a href=javascript:void(0) class="button button-secondary remove_cart_rule">Remove</a> </label> </div>' +
                    '</label></div>';
            }

            // Append to Cart rules list.
            $('#cart_rules_list').append(form);

            $('.wc-customer-search').trigger( 'wc-enhanced-select-init' );

            // Append the List of Values.
            $('#cart_user_list_' + count).append(user_list);
            $('#cart_product_list_' + count).append(product_list);
            $('#cart_category_list_' + count).append(category_list);
            $('#cart_roles_list_' + count).append(roles_list);
            $('#cart_countries_list_' + count).append(country_list);
            $('#order_status_list_' + count).append(order_status_list);

            // Refresh the SelectPicker.
            $('.product_list').selectpicker('refresh');
            $('.category_list').selectpicker('refresh');
            $('.roles_list').selectpicker('refresh');
            $('.country_list').selectpicker('refresh');
            $('.order_status_list').selectpicker('refresh');

            // Default Hide List.
            $('#user_div_' + count).css('display', 'none');
            $('#product_div_' + count).css('display', 'none');
            $('#category_div_' + count).css('display', 'none');
            $('#roles_div_' + count).css('display', 'none');
            $('#countries_div_' + count).css('display', 'none');
            $('#purchase_history_div_' + count).css('display', 'none');
        });

        $(document).on('change', '.cart_rule_type', function () {
            var id = $(this).attr('id');
            id = id.replace('cart_condition_type_', '');
            var active = $(this).val();
            showOnly(active, id);

        });

        //on change discount type in price discount
        $(document).on('change', '.price_discount_type', function () {
            var discount_amount = $(this).closest('.discount_rule_list').find('.price_discount_amount');
            var price_discount_amount = $(this).closest('.discount_rule_list').find('.price_discount_product_list_con');
            if($(this).val() == 'product_discount'){
                discount_amount.hide();
                price_discount_amount.removeClass('hide').show();
                $('.hide-for-product-discount').hide();
            } else {
                discount_amount.show();
                price_discount_amount.hide();
                $('.hide-for-product-discount').show();
            }
        });
        $('.price_discount_type').trigger('change');

        //on change discount_product_option in product discount
        $(document).on('change', 'select.discount_product_option', function () {
            var discount_product = $(this).closest('.price_discount_product_list_con').find('.discount_product_option_list_con');
            if($(this).val() == 'any_cheapest_from_all'){
                discount_product.addClass('hide');
            } else {
                discount_product.removeClass('hide');
            }
        });
        $('select.discount_product_option').trigger('change');


        // Saving Cart Rule.
        $('#saveCartRule').on('click', function (event) {
            var form = $('#form_cart_rule').serialize();
            var current = $(this);
            var rule_id = $('#rule_id').val();

            event.preventDefault();
            if ($('#rule_name').val() == '') {
                alert('Please Enter the Rule Name to Create / Save.');
            } else {
                current.removeClass('button-primary');
                current.addClass('button-secondary');
                current.val('Saving...');
                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {action: 'saveCartRule', data: form},
                    success: function () {
                        // After Status Changed.

                        resizeChart = setTimeout(function () {
                            current.addClass('button-primary');
                            current.removeClass('button-secondary');
                            current.val('Save Rule');
                        }, 300);

                        // Reset, if its New Form.
                        if (rule_id == 0) {
                            $(location).attr('href', admin_url + '&tab=cart-rules');
                        }
                        adminNotice();
                    }
                });
            }
        });

        // Change the List to Show, on change of Rule Type.
        $('.cart_rule_type').on('change', function () {
            var id = $(this).attr('id');
            console.log(id);
            id = id.replace('cart_condition_type_', '');

            $('#cart_user_list_' + id).selectpicker('val', []);
            $('#cart_product_list_' + id).selectpicker('val', []);
            $('#cart_category_list_' + id).selectpicker('val', []);
            $('#cart_roles_list_' + id).selectpicker('val', []);
            $('#cart_countries_list_' + id).selectpicker('val', []);
            $('#order_status_list_' + id).selectpicker('val', []);

        });

        // Enabling and Disabling the Status of the Rule.
        $('.cart_manage_status').on('click', function (event) {
            event.preventDefault();
            var current = $(this);
            var id = $(this).attr('id');
            id = id.replace('state_', '');
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {action: 'UpdateStatus', id: id, from: 'cart-rules'},
                success: function (status) {
                    // After Status Changed.
                    if (status == 'Disable') {
                        current.removeClass('button-primary');
                        current.addClass('button-secondary');
                        current.html('Enable');
                    } else if (status == 'Publish') {
                        current.addClass('button-primary');
                        current.removeClass('button-secondary');
                        current.html('Disable');
                    }
                }

            });
        });

        // Removing Cart Rule.
        $('.cart_delete_rule').on('click', function (event) {
            event.preventDefault();
            var current = $(this);
            var id = $(this).attr('id');
            id = id.replace('delete_', '');
            var confirm_delete = confirm('Are you sure to remove ?');
            if (confirm_delete) {
                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {action: 'RemoveRule', id: id, from: 'cart-rules'},
                    success: function () {
                        // After Removed.
                        current.closest('tr').remove();
                        location.reload();
                    }
                });
            }
        });

        // Removing Cart Condition.
        $(document).on('click', '.remove_cart_rule', function () {
            var confirm_remove = confirm('Are You Sure to Remove this ?');
            if (confirm_remove) {
                $(this).closest('.cart_rules_list').remove();
            }
        });

        $('#based_on_purchase_history').on('change', function () {
            var checked = $( "input#based_on_purchase_history:checked" ).length;
            if(checked){
                $('#based_on_purchase_history_fields').show();
            } else {
                $('#based_on_purchase_history_fields').hide();
            }
        });
        $('#based_on_purchase_history').trigger('change');

        $('#price_rule_method').on('change', function () {
            var rule_method = $(this).val();
            $('.price_discounts_con, .price_discount_condition_con').hide();
            $('.'+rule_method+'_discount_cont, .'+rule_method+'_condition_cont').show();
        });
        $('#price_rule_method').trigger('change');

        $('#product_based_condition_quantity_rule').on('change', function () {
            var quantity_values = $(this).val();
            if(quantity_values == 'from'){
                $('.product_based_condition_to').css({"display": "inline-block"})
            } else {
                $('.product_based_condition_to').css({"display": "none"})
            }
        });
        $('#product_based_condition_quantity_rule').trigger('change');
        //--------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------SETTINGS-------------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------

        $('#saveConfig').on('click', function (event) {
            event.preventDefault();
            console.log(ajax_url);
            var form = $('#discount_config').serialize();
            var current = $(this);
            current.removeClass('button-primary');
            current.addClass('button-secondary');
            current.val('Saving...');
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {action: 'saveConfig', from: 'settings', data: form},
                success: function () {
                    // After Removed.
                    resizeChart = setTimeout(function () {
                        current.addClass('button-primary');
                        current.removeClass('button-secondary');
                        current.val('Save Rule');
                    }, 300);
                    adminNotice();
                }
            });
        });

        //--------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------SIDE PANEL-----------------------------------------------------
        //--------------------------------------------------------------------------------------------------------------

        $('.woo-side-button').on('click', function () {
            //$('#woo-side-panel').toggle();
            if ($('#sidebar_text').html() == 'Show') {
                $('#sidebar_text').html('Hide');
                $('.woo-side-panel').show();
                $('#sidebar_icon').addClass('dashicons-arrow-left');
                $('#sidebar_icon').removeClass('dashicons-arrow-down');
            } else {
                $('#sidebar_text').html('Show');
                $('.woo-side-panel').hide();
                $('#sidebar_icon').removeClass('dashicons-arrow-left');
                $('#sidebar_icon').addClass('dashicons-arrow-down');
            }
        });

    });

    //------------------------------------------------------------------------------------------------------------------
    function processShowOnlyTags(id_prefix, id){
        var availableTags = ["user_div_", "product_div_", "category_div_", "general_", "roles_div_", "countries_div_", "purchase_history_div_"];
        $.each(availableTags, function( index, value ) {
            if(value == id_prefix)
                $('#'+value+id).css('display', 'block');
            else
                $('#'+value+id).css('display', 'none');
        });
    }
    function showOnly(option, id) {
        if (option == 'products_atleast_one' || option == 'products_not_in') {
            processShowOnlyTags('product_div_', id);
        } else if (option == 'categories_atleast_one' || option == 'categories_not_in' || option == 'categories_in') {
            processShowOnlyTags('category_div_', id);
        } else if (option == 'users_in') {
            processShowOnlyTags('user_div_', id);
        } else if (option == 'roles_in') {
            processShowOnlyTags('roles_div_', id);
        } else if (option == 'shipping_countries_in') {
            processShowOnlyTags('countries_div_', id);
        } else if (option == 'customer_based_on_purchase_history') {
            processShowOnlyTags('purchase_history_div_', id);
        } else {
            processShowOnlyTags('general_', id);
        }

    }

    function adminNotice() {
        jQuery('#woo-admin-message').html(' <div class="notice notice-success is-dismissable"><p>Saved Successfully !</p></div>');

        setTimeout(function () {
            jQuery('#woo-admin-message').html('');
        }, 2000);
    }

})(jQuery);