<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php do_action( 'automobile_car_dealer_above_slider' ); ?>

<?php /** slider section **/ ?>
 <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $pages = array();
            for ( $count = 1; $count <= 3; $count++ ) {
              $mod = intval( get_theme_mod( 'automobile_car_dealer_slider' . $count ));
              if ( 'page-none-selected' != $mod ) {
                $pages[] = $mod;
              }
            }
            if( !empty($pages) ) :
            $args = array(
                'post_type' => 'page',
                'post__in' => $pages,
                'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
            <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                      <h2><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h2>
                      <p><?php the_excerpt(); ?></p> 

                     <div class="slide-button">
                     <i class="fas fa-long-arrow-alt-right"></i>
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More','automobile-car-dealer' ); ?></a>
                      </div>              
                      
                  </div>
                </div>
            </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left" ></i></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right" ></i></span>
        </a>
      </div>  
      <div class="clearfix"></div>
  </section> 

<?php do_action( 'automobile_car_dealer_above_project' ); ?>

<?php /** About Us section **/ ?>
<section id="project">
  <div class="container">
    <?php if( get_theme_mod('automobile_car_dealer_sec_title') != ''){ ?>     
      <h3><i class="fas fa-car"></i><?php echo esc_html(get_theme_mod('automobile_car_dealer_sec_title',__('About Us','automobile-car-dealer'))); ?></h3>
    <?php }?>
    <div class="row">
      <div class="col-md-7 col-sm-7">
        <?php
        $args = array( 'name' => esc_html(get_theme_mod('automobile_car_dealer_project_single_post','')));
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="mainbox">
              <p><?php the_excerpt();?></p>
              <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>"></a>
            </div>
          <?php endwhile; 
          wp_reset_postdata();?>
          <?php else : ?>
             <div class="no-postfound"></div>
           <?php
          endif; ?>
          <div class="clearfix"></div>
      </div>
      <div class="col-md-5 col-sm-5">
        <?php 
          $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('automobile_car_dealer_project_category'),'theblog')));?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="categorybox row">
              <div class="col-md-4 col-sm-4">
                <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
              </div>
              <div class="col-md-8 col-sm-8">
                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( automobile_car_dealer_string_limit_words( $excerpt,10 ) ); ?></p>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        ?>
      </div>
    </div>
  </div> 
</section>

<?php do_action( 'automobile_car_dealer_above_content' ); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>