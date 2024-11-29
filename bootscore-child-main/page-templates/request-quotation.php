<?php

/**
 * Template Name: Request Quotation
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
            <div class="entry-content">
                <section class="section" id="contact-form">
                    <div class="container">
                        <div class="contact-content">
                            <h2><?php the_title() ?></h2>
                            <div class="row">
                                <div class="col-12">
                                    <?php echo do_shortcode('[wpforms id="733" title="false"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>

<?php
get_footer();
