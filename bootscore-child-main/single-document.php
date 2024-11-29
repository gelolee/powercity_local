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
                        $content_description = get_field('inner_page_content');
                        ?>
                        <section class="section" id="documents-inner-page">
                            <div class="paragraph">
                                <?php echo ($content_description); ?>
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