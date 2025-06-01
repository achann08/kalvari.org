<?php
$id = uniqid('accordion-');
?>
<div class="accordion" id="<?php echo esc_attr($id); ?>">
    <?php foreach($instance['items'] as $i => $item): ?>
        <div class="card">
            <div class="card-header" id="heading-<?php echo $i; ?>">
                <h5 class="mb-0">
                    <button class="btn btn-link <?php echo $item['is_open'] ? '' : 'collapsed'; ?>" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#collapse-<?php echo esc_attr($id . '-' . $i); ?>" 
                            aria-expanded="<?php echo $item['is_open'] ? 'true' : 'false'; ?>" 
                            aria-controls="collapse-<?php echo esc_attr($id . '-' . $i); ?>">
                        <?php echo esc_html($item['title']); ?>
                    </button>
                </h5>
            </div>

            <div id="collapse-<?php echo esc_attr($id . '-' . $i); ?>" 
                 class="collapse <?php echo $item['is_open'] ? 'show' : ''; ?>" 
                 aria-labelledby="heading-<?php echo $i; ?>" 
                 data-parent="#<?php echo esc_attr($id); ?>">
                <div class="card-body">
                    <?php echo wp_kses_post($item['content']); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>