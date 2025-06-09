<?php
/**
 * The template for displaying single posts
 */
get_header();
?>

<div class="container single-post-container">
  <div class="row">
    <div class="col-12">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('py-5'); ?>>
          <div class="entry-header mb-3">
            <?php if (has_post_thumbnail($post->ID)): 
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $featured_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
                $alt_text = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
            ?>
            <div class="mt-4" style="position: relative;">
              <div style="border-radius: 1rem; position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
              <img class="img-fluid w-100" style="border-radius: 1rem; height: 50vw; object-fit: cover; position: relative;" src="<?php echo $featured_image[0]; ?>" alt="<?php echo esc_attr($alt_text); ?>">
            </div>
            <?php endif; ?>
            <div class="breadcrumbs py-4">
              <?php echo custom_breadcrumbs(); ?>
            </div>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </div>
          
          <!-- Meta Info dengan Flexbox -->
          <div class="entry-meta d-flex align-items-center flex-wrap mb-4">
            <!-- Author -->
            <div class="d-flex align-items-center my-1">
              <img src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle mr-2" style="width: 25px; height: 25px;">
              <a class="mr-2" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author(); ?></a>
            </div>
            
            <!-- Tanggal -->
            <div class="d-flex align-items-center my-1">
              <div class="d-flex align-items-center mr-3">
                <span class="dashicons dashicons-calendar mr-2"></span>
                <span><?php echo get_the_date(); ?></span>
              </div>
              
              <?php if (get_the_modified_date() !== get_the_date()): ?>
                <div class="d-flex align-items-center">
                  <span class="dashicons dashicons-update mr-2"></span>
                  <span><?php echo get_the_modified_date(); ?></span>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Konten Artikel -->
          <div class="entry-content">
            <?php the_content(); ?>
          </div>

        </article>
        
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>