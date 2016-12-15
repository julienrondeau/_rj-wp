<?php
/**
 * Base Range  WooCommerce custom functions
 *
 * Hook in on activation
 */




// Change number of products per row
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 10;
	}
}
// Display  products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 20;' ), 20 );

/**
 * Define image sizes
 */
function yourtheme_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '1920',	// px
		'height'	=> '',	// px
		'crop'		=> 0		// true
	);

	$single = array(
		'width' 	=> '1920',	// px
		'height'	=> '',	// px
		'crop'		=> 0		// true
	);

	$thumbnail = array(
		'width' 	=> '416',	// px
		'height'	=> '',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'after_switch_theme', 'yourtheme_woocommerce_image_dimensions', 1 );

/* Custom Baserange cart image sizes */
add_image_size( 'cart_item_image_size', 215, 215, true );
add_filter( 'woocommerce_cart_item_thumbnail', 'cart_item_thumbnail', 10, 3 );

function cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) {
 // create the product object
 $product = get_product( $cart_item['product_id'] );
return $product->get_image( 'cart_item_image_size' );
}

/* Custom Baserange display of the single product content summary */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );

add_action( 'woocommerce_baserange_after_single_product_summary', 'woocommerce_output_related_products', 5 );

/* change the 'Proceed to checkout" text*/
if ( ! function_exists( 'woocommerce_button_proceed_to_checkout' ) ) {

	/**
	 * Output the proceed to checkout button.
	 *
	 * @subpackage	Cart
	 */
	function woocommerce_button_proceed_to_checkout() {
		$checkout_url = WC()->cart->get_checkout_url();

		?>
		<a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
		<?php
	}
}


/* deplacer message erreur
remove_action( 'woocommerce_before_single_product', 'woocommerce_show_messages' );
add_action( 'woocommerce_after_single_product', 'woocommerce_show_messages', 15 );
 */

/* image paypal */
function replacePayPalIcon($iconUrl) {
	return get_bloginfo('stylesheet_directory') . '/img/logo-paypal.png';
}
add_filter('woocommerce_paypal_icon', 'replacePayPalIcon');


add_filter( 'wc_add_to_cart_message', 'foo' );
function foo() {

$product_id = $_REQUEST[ 'product_id' ];

if ( is_array( $product_id ) ) {

    $titles = array();

    foreach ( $product_id as $id ) {
        $titles[] = get_the_title( $id );
    }

    $added_text = sprintf( __( 'Added &quot;%s&quot; to your Shopping cart.', 'woocommerce' ), join( __( '&quot; and &quot;', 'woocommerce' ), array_filter( array_merge( array( join( '&quot;, &quot;', array_slice( $titles, 0, -1 ) ) ), array_slice( $titles, -1 ) ) ) ) );

} else {
    $added_text = sprintf( __( '&quot;%s&quot; was successfully added to your Shopping cart.', 'woocommerce' ), get_the_title( $product_id ) );
}

// Output success messages
if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :

    $return_to  = apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );

    $message    = sprintf(
        '<a href="%s" class="alert-link">%s</a> %s',
        $return_to, __( 'Continue Shopping', 'woocommerce' ),
        $added_text
    );

else :

    $message    = sprintf(
        '<a href="%s" class="alert-link">%s</a> %s',
        get_permalink( wc_get_page_id( 'cart' ) ),
        __( 'View Shopping cart', 'woocommerce' ),
        $added_text );

endif;

return $message;
}

/* override function to modify $value in cart-totals;php and review-order.php */

function wc_cart_totals_order_total_baserange() {
	$value = '<strong>' . WC()->cart->get_total() . '</strong> ';

	// If prices are tax inclusive, show taxes here
	if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'incl' ) {
		$tax_string_array = array();

		if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
			foreach ( WC()->cart->get_tax_totals() as $code => $tax )
				$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
		} else {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

		if ( ! empty( $tax_string_array ) ) {
			$value .= '<small class="includes_tax">' . sprintf( __( '(incl. %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
		}
	}

	echo apply_filters( 'woocommerce_cart_totals_order_total_baserange', $value );
}

/* Change Woocommerce_checkout_fields */

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_postcode']['placeholder'] = 'Zipcode';
     $fields['billing']['billing_postcode']['label'] = 'Zipcode';
     $fields['billing']['billing_city']['placeholder'] = 'City';
     $fields['billing']['billing_city']['label'] = 'City';
     $fields['billing']['billing_email']['label'] = 'Email';
     $fields['shipping']['shipping_postcode']['placeholder'] = 'Zipcode';
     $fields['shipping']['shipping_postcode']['label'] = 'Zipcode';
     $fields['shipping']['shipping_city']['placeholder'] = 'City';
     $fields['shipping']['shipping_city']['label'] = 'City';
     $fields['account']['account_username']['label'] = 'email';
     $fields['account']['account_password']['label'] = 'password';

     return $fields;
}