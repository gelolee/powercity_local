<?php

/**
 * Template Name: Custom Post Type Single
 *
 * This template file is used to display single posts of your custom post type.
 */

get_header(); // Include header if needed
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <?php
    while (have_posts()) :
      the_post();
      $post_id = get_the_ID();
      $taxonomy_type = 'products';
      $taxonomy_types = get_taxonomies();
      foreach ($taxonomy_types as $taxonomy) {
        $terms = get_the_terms($post_id, $taxonomy);
        if ($terms && !is_wp_error($terms)) {
          $taxonomy_type = $taxonomy;
          break;
        }
      }
      $terms = get_the_terms($post_id, $taxonomy_type);
      if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
          $term_title = $term->name;
          $term_description = $term->description;
          $hero_image = get_field('products_banner', $term);
          $hero_image_mobile = get_field('mobile_banner', $term);
        }
      }
    ?>
      <article id="post-<?php the_ID() . 'products'; ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <section class="section1" id="diesel-banner">
            <img class="desktop-only" src="<?= $hero_image['url'] ?>" alt="">
            <img class="mobile-only" src="<?= $hero_image_mobile['url'] ?>" alt="">
            <div class="center-content" id="mobile-title">
              <div class="container">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                  yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
                <h2>
                  <?php echo $term_title; // Output the term title 
                  ?>
                </h2>
                <p>
                  <?php echo $term_description; // Output the term description 
                  ?>
                </p>
              </div>
            </div>
          </section>
          <section class="section pt-5" id="inner-page-product">
            <div class="product-title">
              <div class="container">
                <h3>
                  <?php echo $term_title ?>
                </h3>
                <h2>
                  <?= the_title(); ?>
                </h2>
              </div>
            </div>
            <div class="gallery-slider">
              <div class="container">
                <?php
                $slide_count = 0;
                $group_field = get_field('inner_page');
                if ($group_field) :
                  $repeater_rows = $group_field['repeat_image'];
                  if ($repeater_rows) :
                    foreach ($repeater_rows as $row) :
                      $slide_count++;
                      $product_field = $row['image_slider']['url'];
                ?>
                      <div class="mySlides">
                        <img src="<?php echo esc_url($product_field); ?>" alt="Slide <?php echo $slide_count; ?>">
                      </div>
                <?php
                    endforeach;
                  endif;
                endif;
                ?>
                <div class="row">
                  <?php
                  $slide_count = 0;
                  $group_field = get_field('inner_page');
                  if ($group_field) :
                    $repeater_rows = $group_field['repeat_image'];
                    if ($repeater_rows) :
                      foreach ($repeater_rows as $row) :
                        $slide_count++;
                        $thumbnail_url = $row['image_slider']['url'];
                  ?>
                        <div class="column" onclick="currentSlide(<?php echo $slide_count; ?>)">
                          <img class="demo cursor" src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail <?php echo $slide_count; ?>">
                        </div>
                  <?php
                      endforeach;
                    endif;
                  endif;
                  ?>
                </div>
              </div>
            </div>
          </section>
          <section class="section" id="accordion-section">
            <div class="container">
              <div class="row">
                <?php
                $group_field = get_field('inner_page_accordion');
                if ($group_field) :
                  $repeater_rows = $group_field['accordion_item'];
                  if ($repeater_rows) :
                ?>
                    <div class="col-md-5">
                      <div class="left-side">
                        <h2>
                          Description
                        </h2>
                        <?= get_field('inner_page_left_side')['left_description'] ?>
                      </div>
                    </div>
                  <?php else : ?>
                    <div class="col-md-5">
                      <div class="left-side">
                        <h2>
                          Description
                        </h2>
                        <?= get_field('inner_page_left_side')['left_description'] ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="col-md-7">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <?php
                      foreach ($repeater_rows as $index => $row) :
                        $item_title = $row['accordion_title'];
                        $item_content = $row['accordion_content'];
                        $item_image = $row['accordion_image'];
                        // $file_download = $row['pdf_file_upload'];
                        $item_url = '';
                        if (is_array($item_image) && isset($item_image['url'])) {
                          $item_url = $item_image['url'];
                        }
                      ?>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $index; ?>">
                              <?php echo $item_title; ?>
                            </button>
                          </h2>
                          <div id="flush-collapse<?php echo $index; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                              <?php echo $item_content; ?>
                            </div>
                            <img class="accordion-body" src="<?php echo esc_url($item_url); ?>" alt="">
                          </div>
                        </div>
                      <?php
                      endforeach;
                      ?>
                      <?php
                      $file_field = $group_field['pdf_file_upload'];
                      $text_field = $group_field['title_file_upload'];
                      if ($file_field && isset($file_field['url'])) : ?>
                        <div class="accordion-item last-item d-flex justify-content-between align-items-center">
                          <h2 class="accordion-header">
                            Brochure
                          </h2>
                          <div class="accordion-download">
                            <a href="<?php echo esc_url($file_field['url']); ?>" download>
                              <button class="accordion-download-btn btn btn-primary">
                                Download <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                  <polyline points="7 10 12 15 17 10"></polyline>
                                  <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                              </button>
                            </a>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <section class="section" id="carousel-products">
            <div class="container">
              <div class="related-product py-3">
                <h2>Related Products</h2>
              </div>
              <div class="owl-carousel inner-page-products">
                <?php
                $args = array(
                  'post_type' => 'products',
                  'posts_per_page' => 6,
                  'orderby' => 'rand', // Order by random
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'generator_type', // Replace 'generator_type' with your actual taxonomy name
                      'operator' => 'EXISTS', // Ensures that the post has a term in the specified taxonomy
                    ),
                  ),
                );
                $current_permalink = get_permalink();
                $query = new WP_Query($args);
                if ($query->have_posts()) {
                  while ($query->have_posts()) {
                    $query->the_post();
                    $product_permalink = get_permalink();
                    if ($product_permalink != $current_permalink) {
                      $thumbnail_image = get_field('featured_image');
                      $description_field = get_field('banner_title');
                      $button_name = get_field('button');
                      $permalink = get_permalink();
                      $the_title = get_the_title();
                      // preg_match('/\(([^)]+)\)/', $the_title, $matches);
                      // $extracted_text = isset($matches[0]) ? $matches[0] : '';
                ?>
                      <div class="card h-100">
                        <img src="<?php echo esc_url($thumbnail_image['url']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>">
                        <div class="card-body">
                          <span>
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'generator_type');
                            if ($terms && !is_wp_error($terms)) {
                              foreach ($terms as $term) {
                                echo '<span>' . esc_html($term->name) . '</span>';
                              }
                            }
                            ?>
                          </span>
                          <h2>
                            <?php echo $the_title ?>
                          </h2>
                          <div class="button">
                            <a class="hvr-float" href="<?php echo esc_url($permalink); ?>">
                              View Details
                            </a>
                          </div>
                        </div>
                      </div>
                <?php
                    }
                  }
                  wp_reset_postdata();
                } else {
                  echo 'No products found for Diesel Generator';
                }
                ?>
              </div>
            </div>
          </section>
        </header>
      </article>
  </main>
  <!-- #main -->
  <!-- #post-<?php the_ID(); ?> -->
<?php
    endwhile;
?>
</div>
<!-- #primary -->

<?php
get_footer(); // Include footer if needed
?>