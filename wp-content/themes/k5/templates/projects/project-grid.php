<?php
if($grid = get_field('grid')):
    foreach ($grid as  $grid_item) :
?>
<?php if(!$grid_item['fullwidth_grid']): ?>
<div class="o-width-limiter">
<?php endif; ?>
    <div class="o-grid<?= $grid_item['margin_top_bottom'] == 'sm' ? ' o-grid--small' : ''; ?><?= $grid_item['fullwidth_grid'] ? ' o-grid--no-margin' : ''; ?>">
        <?php foreach($grid_item['row'] as $component) : ?>
            <div class="o-grid__column<?= $grid_item['margin_images'] == 'sm' ? ' o-grid__column--small' : ''; ?>" data-size="<?= $component['width']; ?>">
                <a href="<?= wp_get_attachment_image_src($component['image'], 'full')[0]; ?>" class="c-project__image">
                    <img src="<?= wp_get_attachment_image_src($component['image'], 'large')[0]; ?>" alt="<?= $component['image_text']; ?>">
                </a>
                <?php if($component['image_text']): ?>
                    <h3 class="c-project__image-title"><?= $component['image_text']; ?></h3>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php if(!$grid_item['fullwidth_grid']): ?>
</div>
<?php endif; ?>
<?php endforeach;
endif; ?>
