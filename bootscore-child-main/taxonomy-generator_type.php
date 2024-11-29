<?php

/**
 * Template Name: Products Archive
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
            <section class="section2" id="products">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 product-filtering">
                            <div class="filter-color">
                                <h2>Filter by</h2>
                                <h3>RATING kW-kVA</h3>
                                <div class="number-range-buttons">
                                    <button id="reset-filter">Show All</button>
                                    <button class="number-range" data-min="10" data-max="75">10 - 75 <span class="item-count"></button>
                                    <button class="number-range" data-min="100" data-max="300">100 - 300 <span class="item-count"></button>
                                    <button class="number-range" data-min="340" data-max="1500">340 - 1500 <span class="item-count"></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="view-toggle">
                                <button class="btn-toggle grid-view active"><i class="fa-solid fa-table-cells"></i></button>
                                <button class=" btn-toggle list-view"><i class="fa-solid fa-list"></i></button>
                            </div>
                            <?php
                            $item_counter = 0;
                            $total_items = $wp_query->post_count;
                            ?>
                            <div class="row products-grid">
                                <?php
                                $current_category = get_queried_object();
                                $term_id = $current_category->term_id;
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $posts_per_page = 6; // Change this number as needed
                                $args = array(
                                    'post_type' => 'products',
                                    'posts_per_page' => $posts_per_page,
                                    'paged' => $paged,
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => $current_category->taxonomy,
                                            'field' => 'term_id',
                                            'terms' => $term_id,
                                        ),
                                    ),
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) {
                                    $products = array();
                                    $item_counter = 0;
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $thumbnail_image = get_field('featured_image');
                                        $description_field = get_field('description');
                                        // $button_name = get_field('button');
                                        $permalink = get_permalink();
                                        $the_title = get_the_title();
                                        $current_category = single_cat_title('', false);
                                        // preg_match('/\(([^)]+)\)/', $the_title, $matches);
                                        // $extracted_text = isset($matches[0]) ? $matches[0] : '';
                                        // $item_counter++; // Increment the counter
                                        // $items_remaining = $total_items - ($item_counter - 1); // Number of items remaining after current item
                                        // $is_last_row_item = $items_remaining <= 3 && $items_remaining > 0;
                                        preg_match('/\d+/', $the_title, $matches);
                                        $numeric_part = isset($matches[0]) ? intval($matches[0]) : 0;
                                        $products[] = array(
                                            'title' => $the_title,
                                            'permalink' => $permalink,
                                            'thumbnail_image' => $thumbnail_image,
                                            'description' => $description_field,
                                            'numeric_part' => $numeric_part
                                        );
                                    }
                                    function sort_products_by_numeric_part($a, $b)
                                    {
                                        return $a['numeric_part'] - $b['numeric_part'];
                                    }
                                    // Sort the products array
                                    usort($products, 'sort_products_by_numeric_part');
                                    // Loop through sorted products array and display
                                    $item_counter++; // Increment the counter
                                    foreach ($products as $product) {
                                ?>
                                        <div class="col-lg-4 col-md-6 col-sm-12 line-design">
                                            <div class="card h-100">
                                                <a href="<?php echo esc_url($product['permalink']); ?>">
                                                    <img src="<?php echo esc_url($product['thumbnail_image']['url']); ?>" alt="<?php echo esc_attr($product['thumbnail_image']['alt']); ?>">
                                                </a>
                                                <div class="card-body">
                                                    <span><?php echo $current_category ?></span>
                                                    <h2><?php echo $product['title']; ?></h2>
                                                    <div class="button">
                                                        <a href="<?php echo esc_url($product['permalink']); ?>" class="hvr-float">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    echo '<div id="pagination">';
                                    echo paginate_links(
                                        array(
                                            'format' => '?paged=%#%',
                                            'current' => $paged,
                                            'total' => $query->max_num_pages,
                                        )
                                    );
                                    echo '</div>';
                                } else {
                                    echo 'No products found for Diesel Generator';
                                }
                                wp_reset_postdata();
                                ?>
                            </div>

                            <div class="row products-list" id="filtered-products">
                                <div class="card">
                                    <?php
                                    $current_category = get_queried_object();
                                    $term_id = $current_category->term_id;
                                    $args = array(
                                        'post_type' => 'products',
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $current_category->taxonomy,
                                                'field' => 'term_id',
                                                'terms' => $term_id,
                                            ),
                                        ),
                                    );
                                    $query = new WP_Query($args);
                                    if ($query->have_posts()) {
                                        $products = array();
                                        $item_counter = 0;
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                            $thumbnail_image = get_field('featured_image');
                                            $description_field = get_field('description');
                                            $button_name = get_field('button');
                                            $current_category = single_cat_title('', false);
                                            $permalink = get_permalink();
                                            $the_title = get_the_title();
                                            // preg_match('/\(([^)]+)\)/', $the_title, $matches);
                                            // $extracted_text = isset ($matches[0]) ? $matches[0] : '';
                                            preg_match('/\d+/', $the_title, $matches);
                                            $numeric_part = isset($matches[0]) ? intval($matches[0]) : 0;
                                            $products[] = array(
                                                'title' => $the_title,
                                                'permalink' => $permalink,
                                                'thumbnail_image' => $thumbnail_image,
                                                'description' => $description_field,
                                                'numeric_part' => $numeric_part
                                            );
                                        }
                                        function sort_products_by_numeric_part($a, $b)
                                        {
                                            return $a['numeric_part'] - $b['numeric_part'];
                                        }
                                        // Sort the products array
                                        usort($products, 'sort_products_by_numeric_part');
                                        // Loop through sorted products array and display
                                        $item_counter++; // Increment the counter
                                        foreach ($products as $product) {
                                    ?>
                                            <div class="grid d-flex">
                                                <img src="<?php echo esc_url($product['thumbnail_image']['url']); ?>" alt="<?php echo esc_attr($product['thumbnail_image']['alt']); ?>">
                                                <div class="body">
                                                    <span><?php echo $current_category; ?></span>
                                                    <h2><?php echo $product['title']; ?></h2>
                                                </div>
                                                <div class="button">
                                                    <a href="<?php echo esc_url($product['permalink']); ?>" class="hvr-float">View Details</a>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                        wp_reset_postdata();
                                    } else {
                                        echo 'No products found for Diesel Generator';
                                    }
                                    ?>
                                </div>
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
