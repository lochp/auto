<?php
/**
 * The template for displaying all pages.
 * @package Automobile Car Dealer
 */

get_header(); ?>

<?php do_action( 'automobile_car_dealer_page_top' ); ?>

<div id="content_box" class="container">
    <div class="main-wrapper">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title();?></h1>
            <?php if(has_post_thumbnail()) { ?>
                <div class="feature-box">   
                    <img src="<?php the_post_thumbnail_url('full'); ?>" width="100%">
                </div>
            <?php } ?>
            <?php the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'automobile-car-dealer' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'automobile-car-dealer' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            
            ?>
            <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || '0' != get_comments_number() ) {
                    comments_template();
                }
            ?>
        <?php endwhile; // end of the loop. ?>     
        <div class="clear"></div>    
    </div>
</div>

<?php do_action( 'automobile_car_dealer_page_bottom' ); ?>

<?php get_footer(); ?>