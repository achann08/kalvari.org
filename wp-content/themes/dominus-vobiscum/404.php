<?php 
/**
 * 404 Not Found template
 */
get_header(); 
?>
<div class="container py-5">
  <div class="row">
    <div class="col-12 text-center">
        <div class="entry-header mb-5">
            <h1 class="entry-title">404 - Halaman Tidak Ditemukan</h1>
        </div>
        <div class="entry-content">
            <p>Maaf, halaman yang Anda cari tidak ditemukan.</p>
            <a href="<?php echo home_url(); ?>" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>