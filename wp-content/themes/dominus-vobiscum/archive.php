<?php
/**
 * Archive template
 */
get_header();
?>

<div class="container content-page">
  <div class="row">
    <div class="col-12">
        <div id="post-<?php the_ID(); ?>" <?php post_class('py-5'); ?>>
            <div class="entry-header mb-5">
                <div class="breadcrumbs py-4">
                  <?php echo custom_breadcrumbs(); ?>
                </div>
                <h1 class="entry-title">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        echo 'Artikel oleh: ' . get_the_author();
                    } elseif (is_day()) {
                        echo 'Arsip Harian: ' . get_the_date();
                    } elseif (is_month()) {
                        echo 'Arsip Bulanan: ' . get_the_date('F Y');
                    } elseif (is_year()) {
                        echo 'Arsip Tahunan: ' . get_the_date('Y');
                    } else {
                        post_type_archive_title();
                    }
                    ?>
                </h1>
            </div>
            <div class="entry-content">
                <?php
                  global $wpdb;

                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  $s = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
                  $post_type = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : 'post';

                  // Build query based on archive context
                  $query_args = array(
                      'post_type' => $post_type,
                      'post_status' => 'publish',
                      'orderby' => 'post_date',
                      'order' => 'ASC',
                      'posts_per_page' => 6,
                      'paged' => $paged,
                      's' => $s
                  );

                  // Add taxonomy filters based on current archive
                  if (is_category()) {
                      $query_args['cat'] = get_queried_object_id();
                  } elseif (is_tag()) {
                      $query_args['tag_id'] = get_queried_object_id();
                  } elseif (is_author()) {
                      $query_args['author'] = get_queried_object_id();
                  } elseif (is_date()) {
                      $query_args['date_query'] = array(
                          array(
                              'year' => get_query_var('year'),
                              'month' => get_query_var('monthnum'),
                              'day' => get_query_var('day')
                          )
                      );
                  } elseif (is_tax()) {
                      $term = get_queried_object();
                      $query_args['tax_query'] = array(
                          array(
                              'taxonomy' => $term->taxonomy,
                              'field' => 'id',
                              'terms' => $term->term_id
                          )
                      );
                  }

                  $query = new WP_Query($query_args);
                  $total_pages = $query->max_num_pages; // Simpan total halaman di variabel
              ?>

              <!-- Pindahkan jumlah artikel ke luar #postAjax -->
              <p>Menampilkan <?php echo $query->found_posts; ?> artikel</p>

              <div class="row" id="postAjax">
                  <?php if ($query->have_posts()): ?>
                      <?php while ($query->have_posts()): $query->the_post(); ?>
                          <div class="col-lg-4 col-md-6 mb-3">
                              <article <?php post_class(); ?>>
                                  <div class="card h-100 border-0" style="width: 100%;">
                                      <div style="height: 200px; overflow: hidden; background: rgba(0, 0, 0, 0.3); border-radius: 1vw;">
                                          <?php echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'card-img-top', 'style' => 'object-fit: cover;')); ?>
                                      </div>
                                      <div class="card-body px-0">
                                          <?php 
                                              $categories = get_the_category();
                                              $category_count = count($categories);
                                              if(!empty($categories)){
                                                  $max_to_show = 2;
                                                  for ($j = 0; $j < $max_to_show && $j < $category_count; $j++) {
                                                      ?>
                                                      <span class="badge rounded-pill bg-primary my-2">
                                                          <a href="<?php echo get_category_link($categories[$j]->term_id) ?>" class="text-white mx-1 text-decoration-none"><?php echo $categories[$j]->name; ?></a>
                                                      </span>
                                                      <?php
                                                  }
                                                  if ($category_count > $max_to_show) {
                                                      ?>
                                                      <span class="badge rounded-pill bg-secondary my-2">+<?php echo $category_count - $max_to_show; ?> more</span>
                                                      <?php
                                                  }
                                              }
                                          ?>
                                          <h2 class="card-title h5">
                                              <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                          </h2>
                                          <div class="d-flex align-items-center my-3">
                                              <img src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle" style="width: 25px; height: 25px;">
                                              <div class="px-2">
                                                  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author(); ?></a>
                                              </div>
                                          </div>
                                          <p class="card-text mt-2"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                      </div>
                                  </div>
                              </article>
                          </div>
                      <?php endwhile; ?>
                  <?php else: ?>
                      <div class="col-12">
                          <p>Tidak ada artikel yang ditemukan</p>
                      </div>
                  <?php endif; ?>
              </div>

              <?php if ($query->have_posts() && $total_pages > 1): ?>
              <div class="row mt-5">
                  <div class="col-12 d-flex justify-content-center">
                      <!-- Tambahkan ID untuk pagination -->
                      <div id="paginationAjax">
                          <?php
                              $big = 999999999;
                              echo paginate_links( array(
                                  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                  'format' => '?paged=%#%',
                                  'current' => max( 1, get_query_var('paged') ),
                                  'total' => $total_pages,
                                  'prev_text' => __('« prev'),
                                  'next_text' => __('next »')
                              ) );
                          ?>
                      </div>
                  </div>
              </div>
              <?php endif; ?>

              <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>