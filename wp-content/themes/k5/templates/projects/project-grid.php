<?php
if($grid = get_field('Grid')):
    foreach ($grid as  $grid_item) :
?>
<?php if(!$grid_item['fullwidth_grid']): ?>
<div class="o-width-limiter o-width-limiter--small">
<?php endif; ?>
    <div class="o-grid<?= $grid_item['margin_top_bottom'] == 'sm' ? ' o-grid--small' : ''; ?><?= $grid_item['fullwidth_grid'] ? ' o-grid--no-margin' : ''; ?><?= $grid_item['margin_bottom_zero'] ? ' o-grid--no-margin-bottom' : ''; ?>">
        <?php foreach($grid_item['row'] as $component) : ?>
            <div class="o-grid__column<?= $grid_item['margin_images'] == 'sm' ? ' o-grid__column--small' : ''; ?><?= $component['text_size'] != 'sm' ? ' o-grid__column--lg-text' : ''; ?>" data-size="<?= $component['width']; ?>">
                <?php
                if($prodID = $component['product']) :
                    $link = get_permalink($prodID);
                    $image = get_post_thumbnail_id($prodID);
                    $hover_image = get_field('hover_image', $prodID);
                    $title = get_field('number', $prodID);
                    $title_hover = get_field('hover_title', $prodID);
                    $secondary_title = get_field('price', $prodID) . ' SEK';
                else :
                    $link = $component['image_link'];
                    $image = $component['image'];
                    $hover_image = $component['hover_image'];
                    $title = $component['image_title'];
                    $title_hover = $component['hover_title'];
                    $secondary_title = $component['image_description'];
                endif; ?>

                <?php if($title || $image || $component['text_block'] || $component['text_blocks']) : ?>
                    <?php if($link): ?>
                    <a href="<?= $link; ?>" class="c-project__image">
                    <?php endif; ?>
                        <?php if($title): ?>
                            <h3 class="c-project__image-title"><?= $title; ?>
                            <?= $title_hover ? '<span class="c-project__image-title-hover">' . $title_hover . '</span>' : ''; ?>
                            <?= $secondary_title ? '<span>' . $secondary_title . '</span>' : ''; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if($image): ?>
                            <div class="c-project__image-wrapper">
                                <img <?= $hover_image ? 'class="c-project__image-original" ' : ''; ?>src="<?= wp_get_attachment_image_src($image, 'large')[0]; ?>" alt="<?= $title; ?>">
                                <?php if($hover_image): ?>
                                    <img class="c-project__image-hover" src="<?= wp_get_attachment_image_src($hover_image, 'large')[0]; ?>" alt="<?= $title; ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!$component['product'] && $component['text_block']): ?>
                            <div class="c-project__text-block">
                                <?= $component['text_block']; ?>
                            </div>
                        <?php endif; ?>
                        <?php
                            if(!$component['product'] && $component['text_blocks']):
                                foreach ($component['text_blocks'] as $text) : ?>
                                    <div class="c-project__text-block c-project__text-block--<?= $text['margin']; ?>">
                                        <?= $text['text']; ?>
                                    </div>
                        <?php endforeach;
                        endif; ?>
                    <?php if($link): ?>
                    </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php if(!$grid_item['fullwidth_grid']): ?>
</div>
<?php endif; ?>
<?php endforeach;
endif; ?>
