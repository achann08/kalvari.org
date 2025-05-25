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
      jQuery(document).ready(function($) {
        // Konfigurasi navbar
        const scrollDistance = 50;
        const header = $('header');
        const navLinks = $('.navbar-nav .nav-link');
        const navbarToggler = $('.navbar-toggler');
        const offcanvas = $('.offcanvas-collapse');
        const navbar = $('.navbar');
        const siteTitle = $('.site-title');

        // Fungsi update tampilan navbar
        function updateNavbarState() {
            const isScrolled = $(window).scrollTop() > scrollDistance;
            const isMenuOpen = offcanvas.hasClass('open');

            if(isMenuOpen || isScrolled) {
                header.removeClass("bg-transparent").addClass("bg-light");
                siteTitle.removeClass("text-white").addClass("text-dark")
                navbarToggler.removeClass("border-white").addClass("border-dark")
                document.documentElement.style.setProperty('--toggler-color', '#343a40');
                navLinks.removeClass("text-white");
            } else {
                header.removeClass("bg-light").addClass("bg-transparent");
                siteTitle.removeClass("text-dark").addClass("text-white")
                navbarToggler.removeClass("border-dark").addClass("border-white")
                document.documentElement.style.setProperty('--toggler-color', '#fff');
                navLinks.addClass("text-white");
            }
            
            // Handle khusus untuk mobile saat menu terbuka
            if(isMenuOpen) {
                header.addClass('bg-light');
                navLinks.removeClass('text-white');
            }
        }

        // Fungsi toggle offcanvas
        function toggleOffcanvas() {
            offcanvas.toggleClass('open');
        }

        // Fungsi positioning offcanvas
        function positionOffcanvas() {
            // Hanya berlaku untuk mobile (<768px)
            if ($(window).width() >= 768) {
                offcanvas.removeAttr('style');
                return;
            }

            if (navbar.length && offcanvas.length) {
                const navbarBottom = navbar[0].getBoundingClientRect().bottom;
                offcanvas.css({
                    top: navbarBottom + 'px',
                    height: `calc(100vh - ${navbarBottom}px)`
                });
            }
        }

        // Event handlers
        $(window).on("scroll", updateNavbarState);
        $('[data-toggle="offcanvas"]').on('click', toggleOffcanvas);
        $(window).on('resize', positionOffcanvas);
        
        navbarToggler.on('click', function() {
          navbarToggler.toggleClass('active');
          positionOffcanvas();
          setTimeout(updateNavbarState, 10);
        });

        // Inisialisasi awal
        updateNavbarState();
        positionOffcanvas();

        $('.main-menu .dropdown-toggle').on('click', function (e) {
          e.preventDefault();

          $(this).closest('.menu-item-has-children').
          siblings('.menu-item-has-children').
          find('.dropdown-menu').removeClass('show');
          
          var dropdownMenu = $(this).closest('.menu-item-has-children').find('.dropdown-menu');
          var mainDropdown = dropdownMenu.first();

          mainDropdown.toggleClass('show', function() {
              if ($(this).css("display") == 'none') {
                  dropdownMenu.hide();
              }
          });                       
      });
      $(document).on('click', function (e) {
          if (!$(e.target).closest('.main-menu').length) {
              $('.dropdown-menu').removeClass('show');
          }
      });
    });
  </script>
</body>

</html>