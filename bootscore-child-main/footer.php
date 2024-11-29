<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 *
 * @version 5.3.0
 */

?>
<footer class="second-footer">
  <!-- Top Footer Widget -->
  <?php if (is_active_sidebar('top-footer')) : ?>
    <?php dynamic_sidebar('top footer'); ?>
  <?php endif; ?>
</footer>

<footer class="color-white">

  <div class="bootscore-footer pt-5 pb-3">
    <div class="<?= bootscore_container_class(); ?>">

      <div class="row">

        <!-- Footer 1 Widget -->
        <div class="footer-1 col-md-6 col-lg-3">
          <a class="navbar-brand xs d-md-none" href="<?= esc_url(home_url()); ?>"><img src="<?= esc_url(get_stylesheet_directory_uri()); ?>/img/logo/power-city-logo.png" alt="logo" class="logo xs"></a>
          <a class="navbar-brand md d-none d-md-block" href="<?= esc_url(home_url()); ?>"><img src="<?= esc_url(get_stylesheet_directory_uri()); ?>/img/logo/power-city-logo.png" alt="logo" class="logo md"></a>
        </div>

        <!-- Footer 2 Widget -->
        <div class="col-md-6 col-lg-3 powercity-corp footer-desktop">
          <?php if (is_active_sidebar('footer-2')) : ?>
            <?php dynamic_sidebar('footer-2'); ?>
          <?php endif; ?>
        </div>

        <!-- Footer 3 Widget -->
        <div class="col-md-6 col-lg-3 custom-footer footer-desktop">
          <h2>Contact us</h2>
          <div class="footer-three">
            <div class="footer-content">
              <span><i class="fa-solid fa-phone"></i>
                <h3>8-869-1991 | 8-869-7520 Fax: 8-869-3869</h3>
              </span>
              <span><i class="fa-solid fa-envelope"></i>
                <a href="mailto:contactus@powercity.ph" target="_blank">contactus@powercity.ph</a>
              </span>
              <span><i class="fa-solid fa-location-dot"></i>
                <a href="https://www.google.com/maps/place/20+E+Service+Rd,+Sucat,+Muntinlupa,+Metro+Manila/@14.4567598,121.0457295,21z/data=!4m20!1m13!4m12!1m4!2m2!1d121.0253312!2d14.6341888!4e1!1m6!1m2!1s0x3397cfb80ed7cc2d:0x77780b145a848506!2s20,+East+Service+Road,+Muntinlupa+City,+Metro+Manila,+Philippines!2m2!1d121.0458278!2d14.4567675!3m5!1s0x3397cfb80ed7cc2d:0x77780b145a848506!8m2!3d14.4567675!4d121.0458278!16s%2Fg%2F11gmb5sgbv?entry=ttu" target="_blank">Km. 20, East Service Road, Muntinlupa City, Metro Manila, Philippines</a>
              </span>
            </div>
          </div>
        </div>

        <!-- Footer 4 Widget -->
        <div class="col-md-6 col-lg-3 information footer-desktop">
          <?php if (is_active_sidebar('footer-4')) : ?>
            <?php dynamic_sidebar('footer-4'); ?>
          <?php endif; ?>
        </div>

        <div class="footer-section pt-4 text-start" id="footer-mobile">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                  Powercity Corporation
                </button>
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                  <div class="col-md-6 col-lg-3 powercity-corp">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                      <?php dynamic_sidebar('footer-2'); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                  Contact Us
                </button>
              </h2>
              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                  <div class="col-md-6 col-lg-3 custom-footer">
                    <h2>Contact us</h2>
                    <div class="footer-three">
                      <div class="footer-content">
                        <span><i class="fa-solid fa-phone"></i>
                          <h3>8-869-1991 | 8-869-7520 Fax: 8-869-3869</h3>
                        </span>
                        <span><i class="fa-solid fa-envelope"></i>
                          <a href="mailto:contactus@powercity.ph" target="_blank">contactus@powercity.ph</a>
                        </span>
                        <span><i class="fa-solid fa-location-dot"></i>
                          <a href="https://www.google.com/maps/place/20+E+Service+Rd,+Sucat,+Muntinlupa,+Metro+Manila/@14.4567598,121.0457295,21z/data=!4m20!1m13!4m12!1m4!2m2!1d121.0253312!2d14.6341888!4e1!1m6!1m2!1s0x3397cfb80ed7cc2d:0x77780b145a848506!2s20,+East+Service+Road,+Muntinlupa+City,+Metro+Manila,+Philippines!2m2!1d121.0458278!2d14.4567675!3m5!1s0x3397cfb80ed7cc2d:0x77780b145a848506!8m2!3d14.4567675!4d121.0458278!16s%2Fg%2F11gmb5sgbv?entry=ttu" target="_blank">Km. 20, East Service Road, Muntinlupa City, Metro Manila, Philippines</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                  Information
                </button>
              </h2>
              <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                <div class="accordion-body">
                  <div class="col-md-6 col-lg-3 information">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                      <?php dynamic_sidebar('footer-4'); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Bootstrap 5 Nav Walker Footer Menu -->
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'footer-menu',
          'container' => false,
          'menu_class' => '',
          'fallback_cb' => '__return_false',
          'items_wrap' => '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
          'depth' => 1,
          'walker' => new bootstrap_5_wp_nav_menu_walker()
        )
      );
      ?>

    </div>
  </div>

  <div class="bootscore-info py-2 text-center">
    <div class="<?= bootscore_container_class(); ?>">
      <?php if (is_active_sidebar('footer-info')) : ?>
        <?php dynamic_sidebar('footer-info'); ?>
      <?php endif; ?>

      <div class="all-right">
        <small class="bootscore-copyright"><span class="cr-symbol">&copy;</span> Copyright Powercity Corporation
          &nbsp;<?= date('Y'); ?> | All Rights Reserved.</small>
      </div>
    </div>
  </div>

</footer>

<!-- To top button -->
<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020">
  <i class="fa-solid fa-chevron-up"></i>
  <span class="visually-hidden-focusable">To top</span>
</a></div><!-- #page --><?php wp_footer(); ?></body>

</html>