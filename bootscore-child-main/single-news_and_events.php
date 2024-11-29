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
    ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="custom container">
          <header class="entry-header">
            <?php
            if (function_exists('yoast_breadcrumb')) {
              yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
            <?php
            $thumbnail_image = get_field('featured_image');
            if ($thumbnail_image) :
            ?>
              <img src="<?php echo esc_url($thumbnail_image['url']); ?>" alt="">
              <h2>
                <?php the_title(); ?>
              </h2>
            <?php endif; ?>
            <?php
            $date_field = get_field('inner_page_date');
            if ($thumbnail_image) :
            ?>
              <span>
                <?php echo esc_html($date_field); ?>
              </span>
            <?php endif; ?>
            <?php
            $paragraph_field = get_field('inner_page_description');
            if ($thumbnail_image) :
            ?>
              <div class="paragraph">
                <?php echo ($paragraph_field); ?>
              </div>
            <?php endif; ?>
            <hr>
          </header>
          <!-- .entry-header -->
        </div>
        <div class="navigation container">
          <?php
          $next_post = get_previous_post();
          if ($next_post) {
            $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
            $next_featured_image = get_field('featured_image', $next_post->ID); // Fetching ACF featured image
            if ($next_featured_image) {
              echo "\t" . '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title . '" class="next-button"><div class="featured-image-wrapper"><img src="' . $next_featured_image['url'] . '" alt="' . $next_featured_image['alt'] . '"></div><div class="next-title"> Next post<br /><strong>' . $next_title . '</strong></div></a>' . "\n";
            }
          }

          $prev_post = get_next_post();
          if ($prev_post) {
            $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
            $prev_featured_image = get_field('featured_image', $prev_post->ID); // Fetching ACF featured image
            if ($prev_featured_image) {
              echo "\t" . '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title . '" class="prev-button"><div class="featured-image-wrapper"><img src="' . $prev_featured_image['url'] . '" alt="' . $prev_featured_image['alt'] . '"></div><div class="prev-title"> Previous post<br /><strong>' . $prev_title . '</strong></div></a>' . "\n";
            }
          }
          ?>

        </div>
      </article>
      <!-- #post-<?php the_ID(); ?> -->
    <?php
    endwhile;
    ?>
  </main>
  <!-- #main -->
</div>
<!-- #primary -->

<?php
get_footer(); // Include footer if needed
?>