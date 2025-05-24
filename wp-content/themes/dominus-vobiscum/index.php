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
    transition: background-color 0.5s ease;
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

.bg-purple { background-color: #6f42c1; }

.lh-100 { line-height: 1; }
.lh-125 { line-height: 1.25; }
.lh-150 { line-height: 1.5; }

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

</style>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="site" id="page">
      <header class="fixed-top bg-transparent">
          <!-- Ubah expand breakpoint ke md (768px) -->
          <nav class="navbar navbar-expand-md navbar-light py-3">
            <div class="container">
              <a class="navbar-brand" href="/">
                <span class="site-logo-text">ini logo</span>
              </a>
              
              <button class="navbar-toggler border-0 d-md-none" type="button"
                      data-toggle="offcanvas" data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent"
                      aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="navbar-collapse offcanvas-collapse" id="navbarSupportedContent">
                  <?php
                    wp_nav_menu(array(
                        'theme_location'    => 'dominus_vobiscum_nav_menu',
                        'container'         => false,
                        'menu_class'        => 'navbar-nav ml-auto',
                        'depth'             => 2,
                        'walker'            => new WP_Bootstrap_Navwalker(),
                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback'
                    ));
                  ?>
              </div>
            </div>
          </nav>
        </header>
        <section id="jumbotron-section" class="jumbotron jumbotron-fluid position-relative">
          <div class="jumbotron-overlay"></div>
          <img
            src="https://images.unsplash.com/photo-1583364486567-ce2e045676e9?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="img-cover"
            alt="Jumbotron Background"
          >
          <div class="container jumbotron-content">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p class="lead">
              This is a modified jumbotron that occupies the entire horizontal space of its parent.
            </p>
          </div>
        </section>

        <div class="container">
            <div class="row">
              <div class="col-12">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla orci mauris, elementum a hendrerit non, dapibus in ante. Vestibulum dictum, ex non condimentum porta, eros orci ullamcorper purus, non tristique neque turpis quis nulla. Quisque interdum magna sit amet nisl convallis tempus. Nam molestie venenatis ligula eu sagittis. Donec tincidunt facilisis ipsum non dapibus. Aliquam feugiat eget est eu faucibus. Sed pretium convallis euismod. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras tincidunt dictum pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla facilisi. Duis tincidunt erat nec erat elementum, ut tincidunt arcu imperdiet. Ut maximus varius ligula, et consequat libero mattis sit amet.</p>
                <p>Maecenas non quam molestie, ultricies orci a, placerat lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras non lorem commodo mauris semper venenatis at et arcu. Fusce efficitur augue eu lectus posuere, vel faucibus quam luctus. Duis tellus nisi, tincidunt sed ullamcorper at, interdum sed tortor. Aliquam et dolor eleifend, iaculis arcu eu, blandit felis. In vel lectus in odio convallis bibendum eu vulputate tortor. Vivamus vel neque a erat lobortis aliquet fringilla at sem. Donec sollicitudin eget risus id vulputate. Praesent varius condimentum est vel gravida. Praesent tortor massa, tempus sed condimentum non, semper in lacus. Aenean ut commodo tellus. Etiam sed urna volutpat, convallis ante vitae, malesuada nunc. Cras convallis dignissim luctus. Sed ultrices volutpat nibh in dapibus. Aliquam vitae metus lectus.</p>
                <p>Phasellus interdum eros diam, ac ultrices est lacinia vitae. Nam nisl nunc, dapibus id laoreet et, suscipit sed est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus vel augue tristique, viverra lacus vel, sodales purus. Proin hendrerit luctus porttitor. Phasellus ornare dolor at odio elementum rhoncus. Aliquam aliquet risus purus, ut pellentesque tellus blandit sed. Pellentesque sit amet nisi finibus, gravida massa non, bibendum nunc. Aliquam fringilla sed mauris a congue.</p>
                <p>Vivamus facilisis interdum mollis. Nunc ut efficitur sapien, sit amet vulputate felis. Integer accumsan, justo vitae malesuada elementum, odio justo pharetra augue, ultricies aliquet elit magna ut magna. Nam mollis erat ac imperdiet hendrerit. Duis fringilla, elit ut ultricies ornare, mi nisi vestibulum dui, non congue mi orci eget massa. Nunc imperdiet mi ac consequat tincidunt. Sed volutpat vel purus eget ultrices. Ut eu odio ac diam auctor gravida quis imperdiet nisi. Etiam rutrum orci eu metus iaculis bibendum. Curabitur at ultrices lacus, commodo efficitur dolor.</p>
                <p>Suspendisse rhoncus maximus elit nec sagittis. Fusce ac eros leo. Etiam tincidunt nunc at vulputate sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum a vehicula felis. Suspendisse potenti. Sed ac faucibus nisl, sed tincidunt risus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla orci mauris, elementum a hendrerit non, dapibus in ante. Vestibulum dictum, ex non condimentum porta, eros orci ullamcorper purus, non tristique neque turpis quis nulla. Quisque interdum magna sit amet nisl convallis tempus. Nam molestie venenatis ligula eu sagittis. Donec tincidunt facilisis ipsum non dapibus. Aliquam feugiat eget est eu faucibus. Sed pretium convallis euismod. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras tincidunt dictum pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla facilisi. Duis tincidunt erat nec erat elementum, ut tincidunt arcu imperdiet. Ut maximus varius ligula, et consequat libero mattis sit amet.</p>
                <p>Maecenas non quam molestie, ultricies orci a, placerat lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras non lorem commodo mauris semper venenatis at et arcu. Fusce efficitur augue eu lectus posuere, vel faucibus quam luctus. Duis tellus nisi, tincidunt sed ullamcorper at, interdum sed tortor. Aliquam et dolor eleifend, iaculis arcu eu, blandit felis. In vel lectus in odio convallis bibendum eu vulputate tortor. Vivamus vel neque a erat lobortis aliquet fringilla at sem. Donec sollicitudin eget risus id vulputate. Praesent varius condimentum est vel gravida. Praesent tortor massa, tempus sed condimentum non, semper in lacus. Aenean ut commodo tellus. Etiam sed urna volutpat, convallis ante vitae, malesuada nunc. Cras convallis dignissim luctus. Sed ultrices volutpat nibh in dapibus. Aliquam vitae metus lectus.</p>
                <p>Phasellus interdum eros diam, ac ultrices est lacinia vitae. Nam nisl nunc, dapibus id laoreet et, suscipit sed est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus vel augue tristique, viverra lacus vel, sodales purus. Proin hendrerit luctus porttitor. Phasellus ornare dolor at odio elementum rhoncus. Aliquam aliquet risus purus, ut pellentesque tellus blandit sed. Pellentesque sit amet nisi finibus, gravida massa non, bibendum nunc. Aliquam fringilla sed mauris a congue.</p>
                <p>Vivamus facilisis interdum mollis. Nunc ut efficitur sapien, sit amet vulputate felis. Integer accumsan, justo vitae malesuada elementum, odio justo pharetra augue, ultricies aliquet elit magna ut magna. Nam mollis erat ac imperdiet hendrerit. Duis fringilla, elit ut ultricies ornare, mi nisi vestibulum dui, non congue mi orci eget massa. Nunc imperdiet mi ac consequat tincidunt. Sed volutpat vel purus eget ultrices. Ut eu odio ac diam auctor gravida quis imperdiet nisi. Etiam rutrum orci eu metus iaculis bibendum. Curabitur at ultrices lacus, commodo efficitur dolor.</p>
                <p>Suspendisse rhoncus maximus elit nec sagittis. Fusce ac eros leo. Etiam tincidunt nunc at vulputate sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum a vehicula felis. Suspendisse potenti. Sed ac faucibus nisl, sed tincidunt risus.</p>
              </div>
            </div>
        </div>
        <footer>
          <section class="border-top bg-light">
            <div class="container py-5">
              <div class="row">
                <?php if (is_active_sidebar('kreasi-sidebar-footer1')) : ?>
                  <?php dynamic_sidebar('kreasi-sidebar-footer1'); ?>
                <?php endif; ?>
              </div>
              <div class="row">
                <?php if (is_active_sidebar('kreasi-sidebar-footer2')) : ?>
                  <?php dynamic_sidebar('kreasi-sidebar-footer2'); ?>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <section class="border-top pt-3 bg-dark">
            <div class="container">
              <div class="row">
                <div class="col-12 text-center">
                  <p class="text-white">
                    <?php
                      $copyright_text = get_theme_mod('set_copyright', '© ' . '[date format="Y"] - Copyright Your Company Name - All Rights Reserved');
                      echo do_shortcode($copyright_text);
                    ?>
                  </p>
                </div>
                <!-- <div class="col-sm-8">
                  <ul class="list-unstyled d-flex justify-content-center justify-content-sm-end flex-wrap">
                    <li class="ms-3">
                      <a class="link-dark" href="#">
                        <span class="fa-stack fa-1x" style="flex-shrink: 0;">
                          <i class="fas fa-square fa-stack-2x"></i>
                          <i class="fab fa-x-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="ms-3">
                      <a class="link-dark" href="#">
                        <span class="fa-stack fa-1x" style="flex-shrink: 0;">
                          <i class="fas fa-square fa-stack-2x"></i>
                          <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="ms-3">
                      <a class="link-dark" href="#">
                        <span class="fa-stack fa-1x" style="flex-shrink: 0;">
                          <i class="fas fa-square fa-stack-2x"></i>
                          <i class="fa-brands fa-instagram fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                  </ul>
                </div> -->
              </div>
            </div>
          </section>
        </footer>
    </div>
    <?php wp_footer(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
          const scrollDistance = 50;
          const header = $('header');
          const navLinks = $('.navbar-nav .nav-link');
          const navbarToggler = $('.navbar-toggler');

          function updateNavbarState() {
            const isScrolled = $(window).scrollTop() > scrollDistance;
            const isMenuOpen = $('.offcanvas-collapse').hasClass('open');

            if(isMenuOpen || isScrolled) {
              header.removeClass("bg-transparent").addClass("bg-light");
              navLinks.removeClass('text-white');
            } else {
              header.removeClass("bg-light").addClass("bg-transparent");
              navLinks.addClass('text-white');
            }
            
            // Handle khusus untuk mobile saat menu terbuka
            if(isMenuOpen) {
              header.addClass('bg-light');
              navLinks.removeClass('text-white');
            }
          }

          // Event untuk scroll
          $(window).on("scroll", updateNavbarState);
          
          // Event khusus untuk tombol toggle
          navbarToggler.on('click', function() {
            // Delay sedikit untuk menunggu class 'open' ditambahkan
            setTimeout(updateNavbarState, 10);
          });

          // Inisialisasi pertama kali
          updateNavbarState();
        });
    </script>
</body>

</html>