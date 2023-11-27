<?php
/*
Plugin Name: WooCommerce Request a Quote
Description: WooCommerce Request a Quote Button on PDP (Product Details Page). It can be integrated with Contact Form 7
Version: 1.0
Author: Abdul Hannan Danish
Author URI: https://www.abdulhannandanish.com
Contact: mrahdanish@gmail.com
*/

function custom_hidden_form_shortcode() {
    global $product;

    ob_start(); ?>

    <div class="quote-button-container">
        <form id="quote_request_form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="quote_request_action">
            <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
            <input type="hidden" name="product_title" value="<?php echo esc_attr($product->get_title()); ?>">
            <input type="hidden" name="product_image" value="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>">
            <button type="submit" class="quote-button">Get Quote</button>
        </form>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('get_quote_button', 'custom_hidden_form_shortcode');

// Hook the shortcode under the "Add to Cart" button
function display_quote_button_shortcode() {
    echo do_shortcode('[get_quote_button]');
}
add_action('woocommerce_after_single_product', 'display_quote_button_shortcode', 20);

// Hook to handle the form submission
add_action('init', 'custom_handle_quote_request');

function custom_handle_quote_request() {
    if (isset($_POST['action']) && $_POST['action'] === 'quote_request_action') {
        // Handle form submission
        $product_id = isset($_POST['product_id']) ? sanitize_text_field($_POST['product_id']) : '';
        $product_title = isset($_POST['product_title']) ? sanitize_text_field($_POST['product_title']) : '';
        $product_image = isset($_POST['product_image']) ? esc_url($_POST['product_image']) : '';

        $posted_data = array('product_id' => $product_id,
            'product_title' => $product_title,
            'product_image' => $product_image);


        // Redirect to the page containing the Contact Form 7
        $redirect_url = add_query_arg(
            $posted_data,
            site_url('/donorfy-api/') // Replace with your actual page URL
        );
        wp_redirect($redirect_url);

        exit();
    }
}