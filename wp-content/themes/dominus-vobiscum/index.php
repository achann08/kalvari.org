<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dominus Vobiscum
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<style>
html,
body {
  overflow-x: hidden;
}

header {
  transition: all 0.3s ease;
}

/* Ubah breakpoint menjadi mobile-only (di bawah 768px) */
@media (max-width: 767.98px) {
  .offcanvas-collapse {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #fff;
    transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
  }
  .offcanvas-collapse.open {
    visibility: visible;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
  }
  .navbar {
    top: 0;
    z-index: 1000;
  }
  
  /* Sembunyikan dropdown menu di mobile */
  .navbar .dropdown-menu {
    background-color: transparent;
    border: none;
    box-shadow: none;
  }
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  color: rgba(255, 255, 255, .75);
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-underline .nav-link {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
  color: #6c757d;
}

.nav-underline .nav-link:hover {
  color: #007bff;
}

.nav-underline .active {
  font-weight: 500;
  color: #343a40;
}

/* jumbotron */
.img-cover {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 0;
}

.jumbotron-content {
  position: relative;
  z-index: 2; /* Pastikan di atas gambar */
  padding: 2rem;
  color: white;
}

/* Overlay untuk meningkatkan keterbacaan teks */
.jumbotron-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

/* Perbaikan untuk header */
header.sticky-top {
  z-index: 1001;
}

/* hamburger menu animation css */

:root {
  --toggler-color: #fff;
}

.navbar-toggler{
  cursor: pointer;
  width: 1.8em;
  height: 1.8em;
  padding: 0 0 0.15em 0.3em;
  border-width: 2px !important;

  .navbar-toggler-inner,
  .navbar-toggler-inner::before,
  .navbar-toggler-inner::after{
    width: 1em;
    height: 0.16em;
    background-color: var(--toggler-color);
    transition: all 0.3s ease; 
    position: absolute;
  }

  .navbar-toggler-inner::before{
    content: "";
    display: block;
    top: -0.3em;
  }

  .navbar-toggler-inner::after{
    content: "";
    display: block;
    bottom: -0.3em;
  }

  .navbar-toggler-inner{
    transition: 0.2s;
    transform: rotate(0deg);
  }
}

.navbar-toggler.active{

  .navbar-toggler-inner{
    transition: 0.2s;
    transform: rotate(405deg);
  }

  .navbar-toggler-inner::before{
    top: 0;
    opacity: 0;
  }

  .navbar-toggler-inner::after{
    bottom: 0;
    transform: rotate(-90deg);
  }

}

.navbar-brand img {
  max-height: 40px;
  width: auto;
}

/* Navbar Styles */
.main-menu {
    padding: 0;
}

.main-menu ul {
    padding: 0;
    margin: 0 0 0 -1.1px;
    font-size: 18px;
    font-weight: 500;
    border-radius: 0;
}

.main-menu ul li ul li a {
    padding: 0.5rem;
    width: auto !important;
}

.main-menu .dropdown .dropdown-menu .nav-item ul li {
    margin-left: 8%;
    position: relative;
    padding-left: 1em;
}

.main-menu .dropdown-menu .btn-group {
    width: 100% !important; /* Pastikan btn-group mengambil lebar penuh */
    display: flex !important;
    align-items: center; /* Pusatkan vertikal */
}

.main-menu .dropdown-menu .btn-group .nav-link {
    color: #343a40 !important;
    text-wrap: wrap !important;
    flex: 100;
}

.main-menu .dropdown-menu .btn-group .dropdown-item {
    flex: 1 !important;
    border-left: 1px solid #dee2e6; /* mirip border Bootstrap default */
    font-weight: 500;
}

.main-menu .dropdown-menu ul li::before {
    font-family: "dashicons";
    content: "\f474";
    position: absolute;
    transform: scaleX(-1);
    font-size: larger;
    margin: 5px 3%;
    left: -8%;
}

.main-menu .nav-link:focus,
.main-menu .nav-link:hover,
.main-menu .dropdown-item:focus,
.main-menu .dropdown-item:hover {
    background-color: rgba(128, 128, 128, 0.1); /* Abu-abu dengan opacity 0.5 */
}


.main-menu .dropdown-menu li {
    display: block;
}
.main-menu .dropdown-menu .show{
    display: contents;
    width: max-content;
}

.main-menu .dropdown-menu .dropdown-menu {
    top: -0.8px;
    left: 100%;
}


@media (max-width: 767px) {
    .navbar-nav .nav-link {
        padding-right: 2vw !important;
        padding-left: 2.1vw !important;
    }
}


/* Responsive styles */
@media (max-width: 767px){
    .main-menu {
        padding: 2%;
        margin-top: 2%;
    }
}

@media screen and (min-width: 768px) {
    .main-menu .dropdown-menu {
        width: max-content !important;
    }
}


.glass-button {
  padding: 0.75rem 1.5rem;
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.5);
  background: rgb(255 255 255 / 10%);
  backdrop-filter: blur(5px);
  border-radius: 999px;
  font-weight: 600;
  text-shadow: 0 0 5px rgba(0,0,0,0.3);
  transition: background 0.3s ease, border 0.3s ease;
}


</style>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="site" id="page">
      <header class="fixed-top bg-transparent">
        <nav class="main-menu navbar navbar-expand-md navbar-light py-3">
          <div class="container">
            <?php
              $custom_logo_id = get_theme_mod('custom_logo');
              $logo_img = $custom_logo_id ? wp_get_attachment_image($custom_logo_id, 'full', false, ['class'=>'custom-logo']) : '';
            ?>
            <a href="<?php echo esc_url( home_url('/')); ?>" class="navbar-brand d-flex align-items-center">
              <?php if ( $logo_img ): ?>
                <?php echo $logo_img; ?>
              <?php endif; ?>
              <div class="site-branding-text ml-2">
                <span class="site-title h4 mb-0 text-white"><?php bloginfo('name'); ?></span>
                <small class="site-description d-block"><?php bloginfo('description'); ?></small>
              </div>
            </a>
            <button class="navbar-toggler border border-white d-md-none" type="button"
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
                      'menu_class'        => 'navbar-nav mx-auto mb-2 mb-lg-0',
                      'depth'             => 4,
                      'walker'            => new WP_Bootstrap_Navwalker(),
                      'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback'
                  ));
                ?>
            </div>
          </div>
        </nav>
      </header>

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
                $desc = wp_strip_all_tags( get_theme_mod('set_homepage_banner_description') );
                if ( $desc ) {
                  echo '<p class="lead">'. esc_html( $desc ) .'</p>';
                }
              ?>
              <div class="d-md-inline-flex">
                <div class="col-12 col-md-12 col-sm-12 mb-2 px-0 mr-3">
                  <a href="<?php echo get_permalink( get_theme_mod('set_banner_buttons')[0]['link_target'] ); ?>"
                    class="btn btn-outline-light rounded-pill w-100 py-2 glass-button">
                    <?php echo get_theme_mod('set_banner_buttons')[0]['link_text']; ?>
                  </a>
                </div>
                <div class="col-12 col-md-12 col-sm-12 mb-2 px-0">
                  <a href="<?php echo get_permalink( get_theme_mod('set_banner_buttons')[1]['link_target'] ); ?>"
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
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla orci mauris, elementum a hendrerit non, dapibus in ante. Vestibulum dictum, ex non condimentum porta, eros orci ullamcorper purus, non tristique neque turpis quis nulla. Quisque interdum magna sit amet nisl convallis tempus. Nam molestie venenatis ligula eu sagittis. Donec tincidunt facilisis ipsum non dapibus. Aliquam feugiat eget est eu faucibus. Sed pretium convallis euismod. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras tincidunt dictum pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla facilisi. Duis tincidunt erat nec erat elementum, ut tincidunt arcu imperdiet. Ut maximus varius ligula, et consequat libero mattis sit amet.</p>
          </div>
        </div>
      </div>
      <footer>
        <section class="border-top bg-light">
          <div class="container py-5">
            <div class="row">
              <!-- Kolom besar di atas pada mobile, di kiri pada tablet & desktop -->
              <div class="col-12 col-md-6">
                <p class="text-dark"><?php echo get_theme_mod('set_footer_text'); ?></p>
              </div>
              <?php if (is_active_sidebar('dominus-vobiscum-footer')) : ?>
                <?php dynamic_sidebar('dominus-vobiscum-footer'); ?>
              <?php endif; ?>
            </div>
          </div>
        </section>
        <section class="border-top pt-3 bg-light">
          <div class="container">
            <div class="row">
              <div class="col-5 text-left">
                <p class="text-dark"><?php echo get_theme_mod('set_copyright'); ?></p>
              </div>
              <div class="col-7 text-right">
                <p class="text-dark"><?php echo get_theme_mod('set_territory'); ?></p>
              </div>
            </div>
          </div>
        </section>
      </footer>
    </div>
    <?php wp_footer(); ?>
</body>

</html>