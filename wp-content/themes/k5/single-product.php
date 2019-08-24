<?php while (have_posts()) : the_post(); ?>
<?php
$style = "";
if( $background_color = get_field('background_color') ) :
    $style .= 'background-color:' . $background_color . ';';
endif;
if( $text_color = get_field('text_color') ) :
    $style .= 'color:' . $text_color . ';';
endif;
?>
<div class="c-product"<?= $style ? 'style="' . $style . '"' : ''; ?>>
    <div class="c-page-header"<?= get_field('fullwidth_background_color') ? 'style="background-color:' . get_field('fullwidth_background_color') .';"' : ''; ?>>
        <?php get_template_part('templates/projects/project-header'); ?>
    </div>

    <?php get_template_part('templates/sidebar'); ?>

    <div class="o-width-limiter o-width-limiter--small">
        <div class="o-grid o-grid--small">
            <div class="o-grid__column o-grid__column--small" data-size="6">
                <h2 class="c-product__title"><?= the_title(); ?><?= get_field('price') ? ' / ' . get_field('price') . ' SEK' : ''; ?></h2>
                <div class="c-product__description">
                    <?= the_content(); ?>
                </div>
            </div>
            <div class="o-grid__column o-grid__column--small" data-size="6">
                <button type="button" name="add-to-bag" data-id="<?= get_the_ID(); ?>" class="button c-product__button c-product__button--add">Add to bag</button>
                <ul class="c-product__info">
                    <li>
                        <button type="button" name="button" class="button c-product__button c-product__button--size">Size guide</button>
                    </li>
                    <?php if($sizes = get_field('sizes')): ?>
                        <li class="c-product__sizes">
                        <?php foreach ($sizes as $key => $size) : ?>
                            <input type="radio" id="size-<?= $key; ?>" class="c-product__size" name="size" value="<?= $size['size'] ?>" <?= $key == 0 ? ' checked' : ''; ?>>
                            <label for="size-<?= $key; ?>"><?= $size['size']; ?></label>
                        <?php endforeach; ?>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="c-product-size-guide">
                    <div class="c-product-size-guide__wrapper">
                        <div class="c-product-size-guide__sizes">
                            <?= get_field('sizes', 'option'); ?>
                        </div>
                        <div class="c-product-size-guide__text">
                            <?= get_field('explanation', 'option'); ?>
                        </div>
                    </div>
                </div>
                <a href="<?= wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="c-product__image--scale">
                    <img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" alt="<?= $title; ?>">
                </a>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
