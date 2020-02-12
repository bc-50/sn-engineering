<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body>

<header>
  <div class="blured-bg"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2">
        <div class="logo-wrapper">
          <a href="<?php echo esc_url(site_url()); ?>"><img src="<?php echo get_theme_file_uri('img/logo.png') ?>" alt="SN Engineering Logo"></a>
          <h2>Welcome to</h2>
          <h2>SN Engineering</h2>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="telephone">
          <a href="tel:01452725210">01452 725210</a>
        </div>
      </div>
      <div class="col-lg-5">
        <nav class="navbar navbar-expand-lg navbar-light">
          <button class="hamburger hamburger--spring  navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <?php 
              wp_nav_menu(array(
              'menu' => 'Main Menu',
              'menu_class' => 'main-nav',
              'depth' => 3,
              'container_class' => 'nav-container',
              'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
              'walker'          => new WP_Bootstrap_Navwalker(),
              )); ?>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>



<section class="header-image">
  <?php 
  $imgIds = get_post_meta(get_field('slider'),'slider_images');
  $first = true;
  $count = 0;
  if (is_front_page()) { ?>
    <div id="homeslider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php foreach ($imgIds[0] as $imgId) { ?>
          <li data-target="#homeslider" data-slide-to="<?php echo $count ?>" <?php echo $count == 0 ? 'class="active"' : '' ?>></li>
        <?php $count++; } ?>
      </ol>
      <div class="carousel-inner">
        <?php foreach ($imgIds[0] as $imgId) { ?>
          <?php $imgsrc = wp_get_attachment_image_url($imgId, 'full'); ?>
          <div class="carousel-item<?php echo $first ? ' active' : '' ?>" style="background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,0.5)), url(<?php echo $imgsrc ?>)">
            <!-- <div class="overlay"></div> -->
            <!-- <?php echo wp_get_attachment_image($imgId, 'full'); ?> -->
          </div>
        <?php $first = false; } ?>
      </div>
    </div>
    <div class="home-title">
      <h1><?php echo get_field('header_title') ? get_field('header_title') : get_the_title() ?></h1>
    </div>
  <?php }else{ ?>
    <div class="main-image" style="background-image: url(<?php echo get_field('header_image') ?>)">
      <div class="dark-overlay">
        <h1><?php echo get_the_title() ?></h1>
      </div>
    </div>

  <?php } ?>
  
</section>
<div class="content-container">
