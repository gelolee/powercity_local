<?php

/**
 * Template Name: Front Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <!-- Hook to add something nice -->
    <?php bs_after_primary(); ?>
    <main id="main" class="site-main">
      <section class="section-1" id="homepage-banner">
        <div class="image-banner">
          <img class="desktop-only" src="<?= get_field('banner_image')['url'] ?>" alt="">
          <img class="mobile-only" src="<?= get_field('mobile_image')['url'] ?>" alt="">
        </div>
        <div class="section1-content">
          <div class="container">
            <h2>
              <?= the_field('banner_title') ?>
            </h2>
            <?= the_field('banner_description') ?>
            <!--<div class="animate__fadeInLeft animate__animated animate__slow animate__delay-.2s">
            </div>-->
          </div>
        </div>
      </section>
      <section class="section2" id="section-two">
        <!--<div class="content" data-aos="fade-up" data-aos-duration="1000">--->
        <div class="content">
          <div class="container">
            <?= get_field('section2')['title'] ?>
          </div>
        </div>
        <div class="numb-prod">
          <div class=" container">
            <div class="number-count">
              <?php
              $group_field = get_field('section2');
              if ($group_field) :
                $repeater_rows = $group_field['content'];
                if ($repeater_rows) :
                  $count = 1;
                  foreach ($repeater_rows as $row) :
                    $number_field = $row['number'];
                    $subhead_field = $row['subhead'];
                    $delay = ($count === 1) ? 500 : (($count === 2) ? 700 : (($count === 3) ? 900 : 0));
                    $duration = 800;
              ?>
                    <!--<div class="numbers d-flex flex-column aos-init" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-aos-duration="<?php echo $duration; ?>">-->
                    <div class="numbers d-flex flex-column">
                      <p>
                        <?php echo esc_html($number_field); ?><i class="fa-sharp fa-solid fa-plus"></i>
                      </p>
                      <div class="numbers-2">
                        <p>
                          <?php echo esc_html($subhead_field); ?>
                        </p>
                      </div>
                    </div>
              <?php
                    $count++;
                  endforeach;
                endif;
              endif;
              ?>
            </div>
          </div>
        </div>
      </section>

      <section class="section3" id="section-three">
        <div class="container img-products py-5">
          <div class="back-shadow">
            <div class="container">
              <h3>Products</h3>
            </div>
          </div>
          <h2 class="text-center p-5"><?= get_field('section3')['title_new_section'] ?></h2>
          <div class="container-fluid">
            <div class="row">
              <?php
              $group_field = get_field('section3');
              if ($group_field) :
                $repeater_rows = $group_field['products'];
                if ($repeater_rows) :
                  $count = 0;
                  foreach ($repeater_rows as $row) :
                    $product_field = $row['image_products'];
                    $image_url = $product_field['url'];
                    $title_fields = $row['title_products'];
              ?>
                    <div class="col-12 col-md-4 col-sm-6 col-xs-6 text-center p-4 column-products">
                      <div class="animation">
                        <a href="<?php echo ($title_fields)['url'] ?>">
                          <img src="<?php echo esc_url($image_url); ?>">
                          <div class="button p-3">
                            <a href="<?php echo ($title_fields)['url'] ?>"><?php echo ($title_fields)['title'] ?></a>
                          </div>
                        </a>
                      </div>
                    </div>
              <?php
                    $count++;
                  endforeach;
                endif;
              endif;
              ?>
            </div>
          </div>
        </div>
      </section>

      <?php
      $argsPromo = array(
        'numberposts' => -1,
        'post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'ID',
        'post_status' => 'publish',
        'category_name' => 'homepage-product-carousel',
      );
      // print_r(get_posts($argsPromo)); 
      ?>
      <section class="section4" id="section-four">
        <div class="container">
          <div class="owl-carousel products" id="owl-products">
            <?php
            foreach (get_posts($argsPromo) as $postVal) :
            ?>
              <div class="machine-product" data-aos="fade-up" data-aos-duration="1300">
                <div class="back-shadow">
                  <div class="container">
                    <h3 class="shadow-one">Featured Product</h3>
                    <h3 class="shadow-two">Explore</h3>
                  </div>
                </div>
                <h2>
                  <?= the_field('product_title', $postVal->ID) ?>
                </h2>
                <div class="row">
                  <div class="col-md-6">
                    <?php $imgProduct = get_field('product_images', $postVal->ID); ?>
                    <img src="<?= $imgProduct['url'] ?>">
                  </div>
                  <div class="col-md-6 product-content">
                    <div class="right">
                      <?= the_field('product_description', $postVal->ID) ?>
                    </div>
                    <div class="cta-wrapper">
                      <a href="<?= get_field('button_product', $postVal->ID)['url'] ?>">
                        <span>
                          <?= get_field('button_product', $postVal->ID)['title'] ?>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
      <section class="section5" id="section-five">
        <div class="slider">
          <div class="back-shadow" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="800" data-aos-offset="0">
            <div class="container">
              <h3>Services</h3>
            </div>
          </div>
          <div class="service" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1300">
            <div class="container">
              <h2>
                <?= get_field('section5')['section5_title'] ?>
              </h2>
            </div>
          </div>
          <div class="container">
            <div class="card mb-3">
              <div class="row image-gallery g-0">
                <?php
                $group_field = get_field('section5');
                if ($group_field) :
                  $repeater_rows = $group_field['list_item'];
                  if ($repeater_rows) :
                ?>
                    <div class="col-md-6">
                      <div class="body">
                        <ul id="itemList" class="list-group list-group-flush">
                          <?php
                          $Ctr = 1;
                          foreach ($repeater_rows as $index => $row) :
                            $offer_field = $row['images'];
                            $image_offer_url = $offer_field['url'];
                            $item_field = $row['items'];
                            $active_class = ($index === 0) ? 'active' : '';
                            $services_page_link = add_query_arg('item', $Ctr, get_permalink(get_page_by_path('services')));
                          ?>
                            <li class="item list-group-item <?php echo $active_class; ?>" data-image="<?php echo esc_url($image_offer_url); ?>" data-number="<?php echo $Ctr; ?>">
                              <a href="<?php echo esc_url($services_page_link); ?>"><?php echo esc_html($item_field); ?></a>
                              <i class="font fa-solid fa-arrow-right <?php echo $active_class; ?>"></i>
                            </li>
                          <?php
                            $Ctr++;
                          endforeach; ?>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <img id="selectedImage" src="<?php echo esc_url($repeater_rows[0]['images']['url']); ?>">
                    </div>
                <?php
                  endif;
                endif;
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section6" id="clients-review">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-4 left-side">
              <div class="back-shadow">
                <div class="container">
                  <h3>Reviews</h3>
                </div>
              </div>
              <h2>
                <?= get_field('section6')['review_left_side']['title'] ?>
              </h2>
              <?= get_field('section6')['review_left_side']['description'] ?>
            </div>
            <div class="col-12 col-md-8 right-side">
              <div class="owl-carousel client-review">
                <?php
                $args = array(
                  'post_type' => 'reviews',
                  'posts_per_page' => -1,
                  'orderby' => 'ASC'
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                  while ($query->have_posts()) :
                    $query->the_post();

                    $review_field = get_field('review');
                    $name_field = get_field('name');
                    $position_field = get_field('position');
                    $subhead_field = get_field('subhead');
                ?>
                    <div class="card h-100">
                      <?php echo $review_field ?>
                      <div class="card-body">
                        <h2>
                          <?php echo $name_field ?>
                        </h2>
                        <h3>
                          <?php echo $position_field ?>
                        </h3>
                        <span>
                          <?php echo $subhead_field ?>
                        </span>
                      </div>
                    </div>
                <?php
                  endwhile;
                  wp_reset_postdata();
                else :
                  echo 'No posts found';
                endif;
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<?php
get_footer();
