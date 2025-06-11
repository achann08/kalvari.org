<?php 
/**
 * Search Form template
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="input-group">
    <input type="search" class="form-control" placeholder="Cari..." value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" class="btn btn-primary">Cari</button>
  </div>
</form>