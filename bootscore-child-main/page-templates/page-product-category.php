<?php
$argsCat = array(
   'taxonomy' => 'generator_type',
   'hide_empty' => false,
);
$categories = get_terms($argsCat);

?>
<div class="product-category-wrapper">
   <div class="container p-5">
      <div class="row">
         <div class="nav flex-column nav-pills col-12 col-md-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <?php $catCtr = 1;
            foreach ($categories as $category) : ?>
               <button class="nav-link <?= ($catCtr == 1) ? 'active' : '' ?>" id="v-pills-<?= $category->term_id ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $category->term_id ?>" type="button" role="tab" aria-controls="v-pills-<?= $category->term_id ?>" aria-selected="true">
                  <a href="<?= get_term_link($category->term_id) ?>"><?= $category->name ?></a>
               </button>
            <?php $catCtr++;
            endforeach; ?>
         </div>
         <div class="tab-content col-12 col-md-8" id="v-pills-tabContent">
            <?php $prodCtr = 1;
            foreach ($categories as $category) : ?>
               <div class="tab-pane fade <?= ($prodCtr == 1) ? 'show active' : '' ?>" id="v-pills-<?= $category->term_id ?>" role="tabpanel" aria-labelledby="v-pills-<?= $category->term_id ?>" tabindex="0">
                  <div class="row">
                     <?php
                     $argProd = array(
                        'post_type' => 'products',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                        'tax_query' => array(
                           array(
                              'taxonomy' => 'generator_type',
                              'field' => 'term_id',
                              'terms' => $category->term_id
                           )
                        )
                     );
                     $queryProd = get_posts($argProd);
                     ?>
                     <?php foreach ($queryProd as $queryProdItem) : ?>
                        <div class="col-4">
                           <div class="product-item" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300">
                              <a href="<?= get_permalink($queryProdItem->ID) ?>">
                                 <img src="<?= get_field('featured_image', $queryProdItem->ID)['url'] ?>" alt="">
                                 <p><?= $queryProdItem->post_title ?></p>
                              </a>
                           </div>
                        </div>
                     <?php endforeach; ?>
                     <div class="see-all-products pt-3 text-center">
                        <a href="<?= get_term_link($category->term_id) ?>">View More</a>
                     </div>
                  </div>
               </div>
            <?php $prodCtr++;
            endforeach; ?>
         </div>
      </div>
   </div>
</div>