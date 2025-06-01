<?php
/**
 * Static Page Template
 */
get_header();
?>

<div class="container content-page">
  <div class="row">
    <div class="col-12">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('py-5'); ?>>
            <div class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </div>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>