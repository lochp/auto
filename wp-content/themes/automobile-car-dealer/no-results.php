<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package Automobile Car Dealer
 */
?>

<header>
	<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'automobile-car-dealer' ); ?></h1>
</header>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.','automobile-car-dealer'), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'automobile-car-dealer' ); ?></p><br />
		<?php get_search_form(); ?>
<?php else : ?>
	<p><?php esc_html_e( 'Dont worry it happens to the best of us.', 'automobile-car-dealer' ); ?></p><br />
	<div class="read-moresec">
		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Back to Home Page', 'automobile-car-dealer' ); ?></a>
	</div>
<?php endif; ?>