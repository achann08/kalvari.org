<?php
/**
 * Header Template
 */
$is_front_page = is_front_page();
$header_class = $is_front_page ? 'bg-transparent' : 'bg-dark';
$navbar_class = $is_front_page ? 'navbar-light' : 'navbar-dark';
$title_class = $is_front_page ? 'text-white' : 'text-white';
$toggler_class = $is_front_page ? 'border-light' : 'border-light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<?php if(!is_front_page()): ?>
<body <?php body_class('pt-5'); ?>>
<?php else: ?>
<body <?php body_class(); ?>>
<?php endif; ?>
  <?php wp_body_open(); ?>
  <div class="site" id="page">
    <header class="fixed-top <?php echo $header_class; ?>">
      <nav class="main-menu navbar navbar-expand-lg <?php echo $navbar_class; ?> navbar-dark py-3">
        <div class="container">
          <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo_img = $custom_logo_id ? wp_get_attachment_image($custom_logo_id, 'full', false, ['class'=>'custom-logo']) : '';
          ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand d-flex align-items-center">
            <?php if ($logo_img): ?>
              <?php echo $logo_img; ?>
            <?php endif; ?>
            <div class="site-branding-text mb-2 ml-2">
              <span class="site-title mb-0 <?php echo $title_class; ?>"><?php bloginfo('name'); ?></span>
              <small class="site-description d-block"><?php bloginfo('description'); ?></small>
            </div>
          </a>
          <button class="navbar-toggler border <?php echo $toggler_class; ?> d-lg-none" type="button"
              data-toggle="offcanvas" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
            <div class="navbar-toggler-inner"></div>
          </button>
          <div class="navbar-collapse offcanvas-collapse" id="navbarSupportedContent">
              <?php
                wp_nav_menu(array(
                    'theme_location'    => 'dominus_vobiscum_nav_menu',
                    'container'         => '',
                    'menu_class'        => 'navbar-nav ml-auto no-wrap mb-2 mb-lg-0',
                    'depth'             => 4,
                    'walker'            => new WP_Bootstrap_Navwalker(),
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback'
                ));
              ?>
          </div>
        </div>
      </nav>
    </header>