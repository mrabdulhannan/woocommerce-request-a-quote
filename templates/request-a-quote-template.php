<?php
/*
Template Name: Request a Quote Custom Page Template
*/
get_header();
// Retrieve product details from URL parameters
$product_id = isset($_GET['product_id']) ? sanitize_text_field($_GET['product_id']) : '';
$product_title = isset($_GET['product_title']) ? sanitize_text_field($_GET['product_title']) : '';
$product_image = isset($_GET['product_image']) ? esc_url($_GET['product_image']) : '';
?>

<div class="page-content">

    <!-- Product details -->
    <div class="product-details-container">
        <div class="product-image">
            <?php
            // Retrieve product image from URL parameter
            //            $product_image = isset($_GET['product_image']) ? esc_url($_GET['product_image']) : '';

            // Output product image
            echo '<img src="' . $product_image . '" alt="Product Image">';
            ?>
        </div>
        <div class="product-info">
            <?php
            // Retrieve product details from Contact Form 7 hidden fields
            //            $product_id = isset($_POST['product_id']) ? sanitize_text_field($_POST['product_id']) : '';
            //            $product_title = isset($_POST['product_title']) ? sanitize_text_field($_POST['product_title']) : '';

            // Output product details
            echo '<p class="product-name">' . $product_title . '</p>';
            echo '<p class="product-id">Product ID: ' . $product_id . '</p>';
            ?>
        </div>
    </div>

    <?php
    // Output existing content
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php
get_footer();
?>
<style>
    /* CSS styles for the page content */
    .page-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Add your existing content styles here */

    /* CSS styles for product details */
    .product-details-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-image img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    .product-info {
        flex-grow: 1;
        padding-left: 20px;
    }

    .product-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-id {
        font-size: 16px;
        color: #888;
    }

    /* Add your product details styles here */

    /* CSS styles for Contact Form 7 form */
    .contact-form-container {
        margin-top: 20px;
    }

    /* Add your Contact Form 7 form styles here */

</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var productId = "<?= $product_id ?>";
        var productTitle = "<?= $product_title ?>";
        var productImage = "<?= $product_image ?>";
        // Replace 'your-hidden-field-name' with the actual name of your hidden field
        $('input[name="product_id"]').val(productId);
        $('input[name="product_title"]').val(productTitle);
        $('input[name="product_image"]').val(productImage);
    });
</script>
