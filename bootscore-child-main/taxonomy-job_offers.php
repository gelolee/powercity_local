<?php

/**
 * Template Name: Careers
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
      <section class="section1" id="diesel-banner">
        <?php
        $current_category = single_cat_title('', false);
        $term = get_queried_object();
        $hero_image = get_field('products_banner', $term);
        $hero_image_mobile = get_field('mobile_banner', $term);
        ?>
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
              <?php echo $current_category; ?>
            </h2>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
          </div>
        </div>
      </section>
      <section class="section" id="careers">
        <div class="container">
          <div class="back-shadow">
            <div class="container">
              <h3>Job Offers</h3>
            </div>
          </div>
          <h2 class="job-titles">FIND THE RIGHT JOB FOR YOU</h2>
          <div class="row g-4">
            <?php
            $args = array(
              'post_type' => 'careers',
              'order' => 'ASC',
              'posts_per_page' => -1,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()):
              while ($query->have_posts()):
                $query->the_post();
                $permalink = get_permalink();
                ?>
                <div class="col-12">
                  <div class="card h-100">
                    <div class="card-body d-flex justify-content-between">
                      <h2>
                        <?php the_title(); ?>
                      </h2>
                      <div class="button">
                        <a href="<?php echo esc_url($permalink); ?>" class="hvr-float">View Role</a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
              echo '<div id="pagination">';
              echo paginate_links(
                array(
                  'format' => '?paged=%#%',
                  'current' => max(1, get_query_var('paged')),
                  'total' => $query->max_num_pages,
                )
              );
              echo '</div>';
              wp_reset_postdata();
            else:
              echo 'No posts found';
            endif;
            ?>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<?php
get_footer();
?>