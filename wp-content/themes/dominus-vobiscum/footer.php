<?php
/**
 * Footer Template
 */
?>
      <footer>
        <section class="border-top bg-light">
          <div class="container py-5">
            <div class="row">
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