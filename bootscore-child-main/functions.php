<?php

// style and scripts
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles()
{

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // custom.js
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', false, '', true);
  // wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
function enqueue_font_awesome()
{
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_owl_carousel');
function enqueue_owl_carousel()
{
  // Enqueue Owl Carousel stylesheet
  wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4');

  // Enqueue Owl Carousel JavaScript file
  wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);
}

// Add custom filter dropdown for taxonomy terms
function custom_taxonomy_filter()
{
  global $typenow;
  if ($typenow == 'products') {
    $taxonomy = 'generator_type'; // Replace 'your_taxonomy_slug' with the slug of your custom taxonomy
    $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $args = array(
      'taxonomy' => $taxonomy,
      'name' => $taxonomy,
      'orderby' => 'name',
      'selected' => $selected,
      'show_count' => true,
      'hide_empty' => true,
      'hierarchical' => true,
      'depth' => 3,
      'show_option_none' => __('Select Category'),
      'value_field' => 'slug',
    );
    wp_dropdown_categories($args);

    // Show All Products button
    echo '<a href="' . admin_url('edit.php?post_type=products&all_posts=1') . '" class="button" style="margin-right:5px;">Show All Products</a>';
  }
}
add_action('restrict_manage_posts', 'custom_taxonomy_filter');

// Filter products based on selected taxonomy term
function custom_taxonomy_filter_query($query)
{
  global $pagenow;
  $type = 'products'; // Change this to your custom post type
  $taxonomy = 'generator_type'; // Replace 'your_taxonomy_slug' with the slug of your custom taxonomy
  if ($pagenow == 'edit.php' && isset($_GET[$taxonomy])) {
    $term_slug = $_GET[$taxonomy];
    if (isset($_GET['all_posts']) && $_GET['all_posts'] == '1') {
      // If 'all_posts' parameter is set to '1', show all products, regardless of the taxonomy term
      return;
    } elseif ($term_slug !== '-1') {
      $taxonomy_query = array(
        array(
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => $term_slug,
        ),
      );
      $query->set('tax_query', $taxonomy_query);
    }
  }
}
add_filter('parse_query', 'custom_taxonomy_filter_query');

function taxonomy_rewrite_fix($wp_rewrite)
{
  $r = array();
  foreach ($wp_rewrite->rules as $k => $v) {
    $r[$k] = str_replace('products=$matches[1]&paged=', 'products=$matches[1]&paged=', $v);
  }
  $wp_rewrite->rules = $r;
}
add_filter('generate_rewrite_rules', 'taxonomy_rewrite_fix');

function custom_pagination_rewrite_rule()
{
  add_rewrite_rule('^generator_type/([^/]+)/page/([0-9]+)/?$', 'index.php?generator_type=$matches[1]&paged=$matches[2]', 'top');
}
add_action('init', 'custom_pagination_rewrite_rule');
