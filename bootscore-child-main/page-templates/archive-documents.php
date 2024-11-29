<?php

/**
 * Template Name: Document
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
            <section class="section1" id="documents-banner">
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
            <section class="section" id="documents">
                <div class="container">
                    <?php
                    // Initialize counter variable
                    $document_counter = 0;
                    $total_document = $wp_query->post_count;
                    ?>
                    <div class="row g-4">
                        <?php
                        $args = array(
                            'post_type' => 'document',
                            'order' => 'DESC',
                            'posts_per_page' => 8,
                            'paged' => max(1, get_query_var('paged'))
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                                $thumbnail_image = get_field('featured_image');
                                $description_field = get_field('description');
                                $content_description = get_field('inner_page_content');
                                $inner_page_link = get_field('application_button');
                                $file_pdf = get_field('pdf_file');
                                $permalink = get_permalink();
                                $document_counter++; // Increment the counter
                                // Output item in a new row after every 4 items
                                if ($document_counter % 4 === 1) {
                                    echo '</div><div class="row">';
                                }
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 border-style <?php echo ($document_counter % 4 === 1) ? 'hide-left-border' : ''; ?> <?php echo $is_last_row_item ? 'hide-bottom-border' : ''; ?>">
                                    <div class="card h-100">
                                        <?php if (!empty($file_pdf)) : ?>
                                            <a href="<?php echo esc_url($file_pdf['url']); ?>" download>
                                                <img src="<?php echo esc_url($thumbnail_image['url']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>">
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url($permalink); ?>">
                                                <img src="<?php echo esc_url($thumbnail_image['url']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>">
                                            </a>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h2>
                                                <?php the_title(); ?>
                                            </h2>
                                            <div class="button">
                                                <?php if (!empty($file_pdf)) : ?>
                                                    <a href="<?php echo esc_url($file_pdf['url']); ?>" download class="hvr-float"><span>Download</span></a>
                                                <?php else : ?>
                                                    <a href="<?php echo esc_url($permalink); ?>" class="hvr-float"><span>Read</span></a>
                                                <?php endif; ?>
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
                        else :
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
