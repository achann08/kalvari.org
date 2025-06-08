<?php
/**
 * Blog template
 */
get_header();
?>

<div class="container content-page">
  <div class="row">
    <div class="col-12">
        <div id="post-<?php the_ID(); ?>" <?php post_class('py-5'); ?>>
            <div class="entry-header mb-5">
                <h1 class="entry-title">Bekal</h1>
            </div>
            <div class="entry-content">
                <p>Helloo World</p>
            </div>
        </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>