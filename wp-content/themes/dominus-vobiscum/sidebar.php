<?php 
/**
 * Sidebar template
 */
if (is_active_sidebar('dominus-vobiscum-sidebar')) : ?>
  <aside class="sidebar">
    <?php dynamic_sidebar('dominus-vobiscum-sidebar'); ?>
  </aside>
<?php endif; ?>