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
            $taxonomy_type = 'careers';
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
            <article id="post-<?php the_ID() . 'careers'; ?>" <?php post_class(); ?>>
                <section class="section1" id="documents-banner">
                    <img class="desktop-only" src="<?= $hero_image['url'] ?>" alt="">
                    <img class="mobile-only" src="<?= $hero_image_mobile['url'] ?>" alt="">
                    <div class="center-content">
                        <div class="container">
                            <?php
                            if (function_exists('yoast_breadcrumb')) {
                                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                            }
                            ?>
                            <h2>
                                <?php the_title(); ?>
                            </h2>
                        </div>
                    </div>
                </section>
                <div class="custom container">
                    <header class="entry-header">
                        <section class="section position-relative" id="careers-inner-page">
                            <div class="container">
                                <div class="back-shadow">
                                    <div class="container">
                                        <h3>Careers</h3>
                                    </div>
                                </div>
                                <h2 class="position-title">
                                    <?php the_title(); ?>
                                </h2>
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php
                                        $repeater_rows = get_field('inner_page_content');
                                        foreach ($repeater_rows as $rows) :
                                            $title_careers = $rows['title'];
                                            $description_careers = $rows['description'];
                                        ?>
                                            <div class="content">
                                                <h2>
                                                    <?php echo $title_careers; ?>
                                                </h2>
                                                <?php echo $description_careers; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="apply-now-content">
                                            <?php the_field('apply_content') ?>
                                            <button type="button" class="btn hvr-float" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Apply
                                                Now!</button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">WORK
                                                                WITH US</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo do_shortcode('[wpforms id="834"]'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </header>
                    <!-- .entry-header -->
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