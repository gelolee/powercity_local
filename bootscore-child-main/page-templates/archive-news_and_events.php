<?php

/**
 * Template Name: News and Events
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
            <section class="section1" id="news-events-banner">
                <img class="desktop-only" src="<?= get_field('banner_image')['url'] ?>" alt="">
                <img class="mobile-only" src="<?= get_field('mobile_image')['url'] ?>" alt="">
                <div class="center-content" id="mobile-title">
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
            <section id="news-events">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $args = array(
                                'post_type' => 'news_and_events',
                                'order' => 'DESC',
                                'posts_per_page' => 3,
                                'paged' => max(1, get_query_var('paged'))
                            );
                            $query = new WP_Query($args);
                            $rowCtr = 1;
                            if ($query->have_posts()) :
                                while ($query->have_posts()) :
                                    $query->the_post();
                                    $thumbnail_image = get_field('featured_image');
                                    $description_field = get_field('description');
                                    $short_description = get_field('short_description');
                                    $inner_page_link = get_field('news_button');
                                    $permalink = get_permalink();
                            ?>
                                    <div class="row <?= ($rowCtr % 2 == 0) ? 'flex-row-reverse background-noise' : '' ?>">
                                        <div class="col-md-6">
                                            <div class="image-center">
                                                <img src="<?php echo esc_url($thumbnail_image['url']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 news-content">
                                            <div class="content-center">
                                                <h2>
                                                    <?php the_title(); ?>
                                                </h2>
                                                <?php echo ($short_description); ?>
                                                <div class="button">
                                                    <a href="<?php echo esc_url($permalink); ?>" class="hvr-float">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $rowCtr++;
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
                            else :
                                echo 'No posts found';
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
