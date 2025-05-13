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
    background-color: #343a40;
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
    position: sticky;
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
</style>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="site" id="page">
    <header class="sticky-top">
  <!-- Ubah expand breakpoint ke md (768px) -->
  <nav class="navbar navbar-expand-md navbar-light bg-light py-3">
    <div class="container">
      <a class="navbar-brand" href="/">
        <span class="site-logo-text">ini logo</span>
      </a>
      
      <!-- Toggler hanya muncul di mobile -->
      <button class="navbar-toggler border-0 d-md-none" type="button"
              data-toggle="offcanvas" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu desktop akan muncul otomatis di tablet -->
      <div class="navbar-collapse offcanvas-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/shop">Shop</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"
               id="navbarDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

        <div class="container">
            <div class="row">
                <p>Hello World!!</p>
            </div>
        </div>

        <footer>
            <?php echo "this is footer"; ?>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>

</html>