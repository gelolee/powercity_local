<?php

/**
 * Template Name: Services
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
            <section class="section1" id="services-banner">
                <div class="banner-bg">
                    <img class="desktop-only" src="<?= get_field('banner_image')['url'] ?>" alt="">
                    <img class="mobile-only" src="<?= get_field('mobile_image')['url'] ?>" alt="">
                    <div class="service-content" id="mobile-title">
                        <div class="container">
                            <?php if (function_exists('yoast_breadcrumb')) {
                                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                            } ?>
                            <h2>
                                <?= get_field('banner_title') ?>
                            </h2>
                            <?= get_field('banner_description') ?>
                        </div>
                    </div>
                </div>
                <div class="services-column">
                    <div class="align-items-center">
                        <div class="container-fluid">
                            <?php
                            $group_field = get_field('section1');
                            if ($group_field) :
                                $repeater_rows = $group_field['service_content'];
                                if ($repeater_rows) :
                                    $rowCtr = 1;
                                    $posts_per_page = 5; // Number of items per page
                                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $offset = ($paged - 1) * $posts_per_page;
                                    $total_items = count($repeater_rows);
                                    $total_pages = ceil($total_items / $posts_per_page);
                                    foreach (array_slice($repeater_rows, $offset, $posts_per_page) as $index => $row) :
                                        $image_field = $row['image_service'];
                                        $image_url = $image_field['url'];
                                        $content_field = $row['content'];
                                        $title_field = $row['titles'];
                            ?>
                                        <div id="section-<?php echo ($index + 1); ?>" class="row <?= ($rowCtr % 2 == 0) ? 'flex-row-reverse background-noise' : '' ?>">
                                            <div class="col-md-6 image custom-col">
                                                <img src="<?php echo esc_url($image_url); ?>">
                                            </div>
                                            <div class="col-md-6 content custom-col">
                                                <div class="body ">
                                                    <h2>
                                                        <?php echo esc_html($title_field) ?>
                                                    </h2>
                                                    <?php echo ($content_field); ?>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                        $rowCtr++;
                                    endforeach;
                                    echo '<div id="pagination">';
                                    echo paginate_links(
                                        array(
                                            'total' => $total_pages,
                                            'current' => $paged,
                                            'prev_text' => '&laquo;',
                                            'next_text' => '&raquo;',
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
