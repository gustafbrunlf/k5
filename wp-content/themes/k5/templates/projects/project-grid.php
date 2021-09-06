<?php
$cookie_name = 'currency';
if(!isset($_COOKIE[$cookie_name])) {
    $currency = 'EUR';
} else {
    $currency = $_COOKIE[$cookie_name];
}

if($grid = get_field('Grid')):
    foreach ($grid as $grid_item) :
?>
<?php if(!$grid_item['fullwidth_grid']): ?>
<div class="o-width-limiter o-width-limiter--small">
<?php endif; ?>
    <div class="o-grid<?= $grid_item['margin_top_bottom'] == 'sm' ? ' o-grid--small' : ''; ?><?= $grid_item['fullwidth_grid'] ? ' o-grid--no-margin' : ''; ?><?= $grid_item['margin_bottom_zero'] ? ' o-grid--no-margin-bottom' : ''; ?>">
        <?php if($grid_item['row']) :
            foreach($grid_item['row'] as $component) : ?>
                <?php
                if($prodID = $component['product']) :
                    $link = get_permalink($prodID);
                    $image = get_post_thumbnail_id($prodID);
                    $hover_image = get_field('hover_image', $prodID);
                    $title = get_field('number', $prodID);
                    $title_hover = get_field('hover_title', $prodID);
                    if($currency === 'EUR') :
                        $secondary_title = get_field('price_europe', $prodID) . ' EUR';
                    else :
                        $secondary_title = get_field('price', $prodID) . ' SEK';
                    endif;
                else :
                    $link = $component['image_link'];
                    $image = $component['image'];
                    $hover_image = $component['hover_image'];
                    $title = $component['image_title'];
                    $title_hover = $component['hover_title'];
                    $secondary_title = $component['image_description'];
                    $slideshow = $component['slideshow'];
                    $slideshow_images = $component['slideshow_images'];
                endif;

                $anchor_link = isset($component['anchor_link']) ? 'id="' . $component['anchor_link'] . '" ' : '';

                $text_size = '';
                if($component['text_size'] == 'lg' || $component['text_size'] == 'xs') {
                    if($component['text_size'] == 'lg') {
                        $text_size = ' o-grid__column--lg-text';
                    }
                    if($component['text_size'] == 'xs') {
                        $text_size = ' o-grid__column--xs-text';
                    }
                }
            ?>
            <div <?= $anchor_link; ?>class="o-grid__column<?= $grid_item['margin_images'] == 'sm' ? ' o-grid__column--small' : ''; ?><?= $text_size; ?>" data-size="<?= $component['width']; ?>">
                <?php if($title || $image || $component['text_block'] || $component['text_blocks']) : ?>
                    <?php if($link && !isset($slideshow)): ?>
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
                                <?php if(!isset($slideshow)): ?>
                                    <img <?= $hover_image ? 'class="c-project__image-original" ' : ''; ?>src="<?= wp_get_attachment_image_src($image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy">
                                    <?php if($hover_image): ?>
                                        <img class="c-project__image-hover" src="<?= wp_get_attachment_image_src($hover_image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="c-project__slideshow">
                                        <?php if($image): ?>
                                            <div class="c-project__slideshow-item">
                                                <?= $link ? '<a href="'. $link . '">' : ''; ?>
                                                    <img src="<?= wp_get_attachment_image_src($image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy" />
                                                <?= $link ? '</a>' : ''; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($hover_image): ?>
                                            <div class="c-project__slideshow-item">
                                                <?= $link ? '<a href="'. $link . '">' : ''; ?>
                                                    <img src="<?= wp_get_attachment_image_src($hover_image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy" />
                                                <?= $link ? '</a>' : ''; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($slideshow_images): ?>
                                            <?php foreach ($slideshow_images as $slideshow_image): ?>
                                            <div class="c-project__slideshow-item">
                                                <?= $slideshow_image['slideshow_item_link'] ? '<a href="'. $slideshow_image['slideshow_item_link'] . '">' : ''; ?>
                                                    <img src="<?= wp_get_attachment_image_src($slideshow_image['slideshow_item'], 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy" />
                                                <?= $slideshow_image['slideshow_item_link'] ? '</a>' : ''; ?>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!$component['product'] && $component['text_block'] && !$component['text_blocks_state']): ?>
                            <div class="c-project__text-block">
                                <?= $component['text_block']; ?>
                            </div>
                        <?php endif; ?>
                        <?php
                            if(!$component['product'] && $component['text_blocks_state'] && !$component['text_block']):
                                if($component['text_blocks']):
                                    foreach ($component['text_blocks'] as $text) : ?>
                                    <div class="c-project__text-block c-project__text-block--<?= $text['margin']; ?>">
                                        <?= $text['text']; ?>
                                    </div>
                        <?php endforeach;
                            endif;
                        endif; ?>
                    <?php if($link): ?>
                    </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach;
        endif; ?>
    </div>
<?php if(!$grid_item['fullwidth_grid']): ?>
</div>
<?php endif; ?>
<?php endforeach;
endif; ?>
