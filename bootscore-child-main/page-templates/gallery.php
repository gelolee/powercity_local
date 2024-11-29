<?php

/**
 * Template Name: Gallery
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
      <section class="section1" id="gallery-section-one">
        <div class="gallery-banner">
          <img class="desktop-only" src="<?= get_field('banner_image')['url'] ?>" alt="">
          <img class="mobile-only" src="<?= get_field('mobile_image')['url'] ?>" alt="">
        </div>
        <div class="gallery-content" id="mobile-title">
          <div class="container">
            <?php
            if (function_exists('yoast_breadcrumb')) {
              yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
            <h2>
              <?= the_field('banner_title') ?>
            </h2>
            <?= the_field('banner_description') ?>
          </div>
        </div>
      </section>
      <section class="section2" id="images-section-two">
        <div class="image-gallery">
          <div class="container">
            <div class="row">
              <?php
              $group_field = get_field('section2');
              if ($group_field) :
                $repeater_rows = $group_field['images'];
                if ($repeater_rows) :
                  $total_images = count($repeater_rows);
                  $images_per_page = 6; // Adjust as needed
                  $total_pages = ceil($total_images / $images_per_page);
                  $current_page = max(1, get_query_var('paged'));
                  $offset = ($current_page - 1) * $images_per_page;
                  $current_page_images = array_slice($repeater_rows, $offset, $images_per_page);
                  foreach ($current_page_images as $row) :
                    $gallery_field = $row['images_gallery'];
                    $gallery_url = $gallery_field['url'];
                    $gallery_title = $row['title'];
              ?>
                    <div class="col-md-6">
                      <img class="image" src="<?php echo esc_url($gallery_url); ?>">
                      <div class="gallery-title p-3">
                        <h2><?php echo ($gallery_title) ?></h2>
                      </div>
                    </div>
                    <div id="myModal" class="modal">
                      <span class="close">&times;</span>
                      <img class="modal-content" id="modalImg">
                    </div>
              <?php
                  endforeach;
                  echo '<div id="pagination">';
                  echo paginate_links(
                    array(
                      'format' => '?paged=%#%',
                      'current' => $current_page,
                      'total' => $total_pages,
                    )
                  );
                  echo '</div>';
                endif;
              endif;
              ?>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<?php
get_footer();
