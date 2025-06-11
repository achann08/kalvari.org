<?php
/**
 * Front Page Template File
 */
get_header();
?>

<section class="jumbotron jumbotron-fluid position-relative" style="padding: 10rem 2rem">
  <div class="jumbotron-overlay"></div>
  <img
    src="<?php echo get_theme_mod('set_homepage_banner'); ?>"
    class="img-cover"
    alt="<?php echo get_theme_mod('set_homepage_banner_alt'); ?>"
  >
  <div class="container jumbotron-content">
    <div class="row">
      <div class="col-12 col-lg-8 col-md-12">
        <h1 class="display-5"><?php echo get_theme_mod('set_homepage_banner_title'); ?></h1>
        <?php 
          $desc = wp_strip_all_tags(get_theme_mod('set_homepage_banner_description'));
          if ($desc) {
            echo '<p class="lead">'. esc_html($desc) .'</p>';
          }
        ?>
        <div class="d-md-inline-flex">
          <div class="col-12 col-md-12 col-sm-12 mb-2 px-0 mr-3">
            <a href="<?php echo get_permalink(get_theme_mod('set_banner_buttons')[0]['link_target']); ?>"
              class="btn btn-outline-light rounded-pill w-100 py-2 glass-button">
              <?php echo get_theme_mod('set_banner_buttons')[0]['link_text']; ?>
            </a>
          </div>
          <div class="col-12 col-md-12 col-sm-12 mb-2 px-0">
            <a href="<?php echo get_permalink(get_theme_mod('set_banner_buttons')[1]['link_target']); ?>"
              class="btn btn-outline-light rounded-pill w-100 py-2 glass-button">
              <?php echo get_theme_mod('set_banner_buttons')[1]['link_text']; ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container py-5">
  <div class="row">
    <div class="border col-lg-8 p-4">
      <h2 class="font-weight-bold mb-4">
        <span class="text-warning">Be</span>rita <span class="text-warning">Kal</span>vari Terbaru
      </h2>
      <?php
      // Query untuk mendapatkan post terbaru
      $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4, // Jumlah post yang ditampilkan
        'post_status'    => 'publish'
      );
      $homepage_query = new WP_Query($args);
      
      if ($homepage_query->have_posts()) :
        while ($homepage_query->have_posts()) : $homepage_query->the_post();
      ?>
        <div class="card mb-4 border-0">
          <div class="row g-0">
            <!-- Kolom gambar -->
            <div class="col-md-4 p-md-1">
              <div style="height: auto; overflow: hidden;">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('medium', array(
                    'class' => 'img-fluid h-100 w-100 py-2 px-2',
                    'style' => 'object-fit: cover;'
                  )); ?>
                <?php else : ?>
                  <div class="bg-light d-flex align-items-center justify-content-center h-100">
                    <span class="text-muted">No Image</span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Kolom konten -->
            <div class="col-md-8">
              <div class="card-body py-md-2">
                <?php 
                $categories = get_the_category();
                if (!empty($categories)) : ?>
                  <div class="mb-2">
                    <?php foreach ($categories as $index => $category) : 
                      if ($index < 2) : // Hanya tampilkan maksimal 2 kategori ?>
                        <span class="badge rounded-pill bg-primary me-1">
                          <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                            class="text-white text-decoration-none">
                            <?php echo esc_html($category->name); ?>
                          </a>
                        </span>
                      <?php endif; 
                    endforeach; ?>
                    
                    <?php if (count($categories) > 2) : ?>
                      <span class="badge rounded-pill bg-secondary">
                        +<?php echo count($categories) - 2; ?> more
                      </span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                
                <h3 class="h5 card-title">
                  <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                    <?php the_title(); ?>
                  </a>
                </h3>
                
                <div class="d-flex align-items-center my-2 text-muted small">
                  <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 30)); ?>" 
                    class="rounded-circle mr-2" 
                    style="width: 25px; height: 25px;">
                  <span>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="text-muted">
                      <?php the_author(); ?>
                    </a>
                  </span>
                  <span class="mx-2">•</span>
                  <span><?php echo get_the_date(); ?></span>
                </div>
                
                <p class="card-text">
                  <span class="mr-2">
                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                  </span>
                  <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-link p-0 text-nowrap">
                    Baca Selengkapnya &raquo;
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>Tidak ada artikel ditemukan.</p>';
      endif;
      ?>
    </div>
    
    <div class="col-lg-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>