<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bootscore
 */

get_header();
?>
<div id="content" class="site-content <?= bootscore_container_class(); ?> py-5 mt-5">
  <div id="primary" class="content-area">
    <!-- Hook to add something nice -->
    <?php bs_after_primary(); ?>
    <div class="row d-flex justify-content-center search-page">
      <div class="<?= bootscore_main_col_class(); ?>">
        <main id="main" class="site-main">
          <?php if (have_posts()) : ?>
            <header class="page-header mb-4">
              <h1>
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Search Results for: %s', 'bootscore'), '<span class="text-secondary">' . get_search_query() . '</span>');
                ?>
              </h1>
            </header>
            <div class="pb-3">
              <form class="searchform input-group" method="get" action="<?= esc_url(home_url('/')); ?>">
                <input type="text" name="s" class="form-control" placeholder="<?php _e('Search', 'bootscore'); ?>">
                <button type="submit" class="input-group-text btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i><span class="visually-hidden-focusable">Search</span></button>
              </form>
            </div>
          <?php
            /* Start the Loop */
            while (have_posts()) :
              the_post();
              /**
               * Run the loop for the search to output the results.
               * If you want to overload this in a child theme then include a file
               * called content-search.php and that will be used instead.
               */
              get_template_part('template-parts/content', 'search');
            endwhile;
            bootscore_pagination();
          else :
            get_template_part('template-parts/content', 'none');
          endif;
          ?>
        </main><!-- #main -->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
