<?php
/**
 * The Header for our theme.
 * @package Automobile Car Dealer
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'automobile-car-dealer' ) ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','automobile-car-dealer'); ?></a></div>

<div id="header">
  <div class="container inner-box">
    <div class="row m-0">
      <div class="col-md-3 col-sm-3 logo_bar">
        <div class="logo">
          <?php if( has_custom_logo() ){ automobile_car_dealer_the_custom_logo();
             }else{ ?>
            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?> 
              <p class="site-description"><?php echo esc_html($description); ?></p>
          <?php endif; }?>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 padding0">
        <div class="topbar row">
          <div class="col-md-7 col-sm-7">
            <?php if( get_theme_mod( 'automobile_car_dealer_mail','' ) != '') { ?>
            <span><i class="fas fa-envelope"></i><?php echo esc_html( get_theme_mod('automobile_car_dealer_mail',__('example@123.com','automobile-car-dealer') )); ?></span>
            <?php }?>
            <?php if( get_theme_mod( 'automobile_car_dealer_phone','' ) != '') { ?>
            <span><i class="fa fa-phone"></i><?php echo esc_html( get_theme_mod('automobile_car_dealer_phone',__('(518) 356-5373','automobile-car-dealer') )); ?></span>
            <?php }?>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="socialbox">
              <?php if( get_theme_mod( 'automobile_car_dealer_cont_facebook') != '') { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'automobile_car_dealer_cont_facebook','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
              <?php } ?>
              <?php if( get_theme_mod( 'automobile_car_dealer_cont_twitter') != '') { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'automobile_car_dealer_cont_twitter','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if( get_theme_mod( 'automobile_car_dealer_google_plus') != '') { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'automobile_car_dealer_google_plus','' ) ); ?>"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if( get_theme_mod( 'automobile_car_dealer_pinterest') != '') { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'automobile_car_dealer_pinterest','' ) ); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if( get_theme_mod( 'automobile_car_dealer_tumblr') != '') { ?>
                <a href="<?php echo esc_url( get_theme_mod( 'automobile_car_dealer_tumblr','' ) ); ?>"><i class="fab fa-tumblr" aria-hidden="true"></i></a>
              <?php } ?>
            </div>
          </div>
          <div class="search-box col-md-1 col-sm-1">
            <span><i class="fas fa-search"></i></span>
          </div>
          <div class="serach_outer">
            <div class="closepop"><i class="far fa-window-close"></i></div>
            <div class="serach_inner">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
        <div class="row m-0">
          <div class="col-md-9 col-sm-9 padding0">
            <div class="menus">
              <div class="menubox header">
                <div class="nav">
                  <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
        </div>
          <?php if( get_theme_mod( 'automobile_car_dealer_button_link','' ) != '') { ?>
            <div class="col-md-3 col-sm-3 appointbtn">
               <i class="fas fa-calendar-alt"></i><a href="<?php echo esc_url( get_theme_mod('automobile_car_dealer_button_link','#' ) ); ?>"><?php esc_html_e( 'MAKE AN APPOINTMENT','automobile-car-dealer' ); ?></a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>