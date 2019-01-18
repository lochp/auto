<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Automobile Car Dealer
 */
get_header(); ?>

<div id="content_box">
    <div class="container">
        <div class="page-content">
            <h1><?php printf( '<strong>%s</strong> %s', esc_html__( '404', 'automobile-car-dealer' ), esc_html__( 'Not Found', 'automobile-car-dealer' ) ) ?></h1>
            <p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn', 'automobile-car-dealer' ); ?></p>
            <p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'automobile-car-dealer' ); ?></p>
            <div class="read-moresec">
                <a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Back to Home Page', 'automobile-car-dealer' ); ?></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>