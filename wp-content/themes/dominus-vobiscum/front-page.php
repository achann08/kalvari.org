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

<div class="container">
  <div class="row">
    <div class="col-12">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit... <!-- Konten placeholder --></p>
    </div>
  </div>
</div>

<?php get_footer(); ?>