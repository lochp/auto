<?php
/**
 * @package Automobile Car Dealer
 * @subpackage automobile-car-dealer
 * @since automobile-car-dealer 1.0
 * Setup the WordPress core custom header feature.
 * @uses automobile_car_dealer_header_style()
*/

function automobile_car_dealer_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'automobile_car_dealer_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'automobile_car_dealer_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'automobile_car_dealer_custom_header_setup' );

if ( ! function_exists( 'automobile_car_dealer_header_style' ) ) :

/**
 * Styles the header image and text displayed on the blog
 *
 * @see automobile_car_dealer_custom_header_setup().
 */

function automobile_car_dealer_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		#header{
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}

endif; // automobile_car_dealer_header_style