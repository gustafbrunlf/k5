<?php
/**
 * Template Name: Checkout
 **/
?>
<?php while (have_posts()) : the_post(); ?>
<?php
$cookie_name = 'products';
if(!isset($_COOKIE[$cookie_name])) {
    $cart_value = 0;
} else {
    $cart = json_decode(stripslashes($_COOKIE[$cookie_name]));
    if(empty($cart)) {
        $cart_value = 0;
    } else {
        $cart_value = count($cart);
    }
}

$total_price = 0;
?>
<div class="c-checkout">
    <div class="c-page-header">
        <?php get_template_part('templates/projects/project-header'); ?>
    </div>
    <div class="o-width-limiter o-width-limiter--small">
        <div class="o-grid o-grid--small">
            <?php if($cart_value < 1): ?>
                <div class="o-grid__column o-grid__column--small" data-size="6">
                    <h2>Cart empty</h2>
                </div>
            <?php else : ?>
                <form class="c-checkout__form" action="index.html" method="post">
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <?php if($cart_value > 0) : ?>
                            <div class="c-checkout__items">
                            <?php foreach ($cart as $product) : ?>
                                <div class="c-checkout__item">
                                    <div class="c-checkout__item-title">
                                        <button class="button c-checkout__item-remove" type="button" name="button" data-prod="<?= $product->id; ?>"><span class="t-visually-hidden">Remove button</span></button>
                                        <h2><a href="<?= get_permalink($product->id); ?>"><?= get_the_title($product->id); ?></a></h2>
                                        <input type="hidden" name="product-title-<?= $product->id; ?>" value="<?= get_the_title($product->id); ?>">
                                        <?php if(has_post_thumbnail($product->id)): ?>
                                            <img class="c-checkout__item-image" src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'full')[0]; ?>" alt="<?= get_the_title($product->id); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="c-checkout__item-size">
                                        <?php if($sizes = get_field('sizes', $product->id)): ?>
                                            <select name="size">
                                                <?php foreach ($sizes as $size) : ?>
                                                    <option value="<?= $size["size"]; ?>" <?= $product->size == $size["size"] ? ' selected' : ''; ?>><?= $size["size"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <div class="c-checkout__item-qty">
                                        <select name="qty" data-price="<?= get_field('price', $product->id); ?>">
                                            <?php for ($i=1; $i <= 10; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <p class="c-checkout__item-price" data-price-sek="<?= get_field('price', $product->id); ?>" data-price-eur="<?= get_field('price_europe', $product->id); ?>"><span><?= get_field('price', $product->id); ?></span> SEK</p>
                                    <input class="c-checkout__item-price--hidden" type="hidden" name="price" value="<?= get_field('price', $product->id); ?>">
                                </div>
                                <?php $total_price += intval(get_field('price', $product->id)); ?>
                            <?php endforeach; ?>
                                <div class="c-checkout__item">
                                    <div class="c-checkout__item-shipping">
                                        <select name="shipping">
                                            <option value="Sweden" data-amount="<?= get_field('shipping_sweden', 'option'); ?>" selected>Shipping Sweden</option>
                                            <option value="Europe" data-amount="<?= get_field('shipping_europe', 'option'); ?>">Shipping Europe</option>
                                            <option value="World" data-amount="<?= get_field('shipping_world', 'option'); ?>">Shipping World</option>
                                        </select>
                                    </div>
                                    <p class="c-checkout__item-price-shipping"><span><?= get_field('shipping_sweden', 'option'); ?></span> SEK</p>
                                </div>
                            </div>
                            <?php $total_price += intval(get_field('shipping_sweden', 'option')); ?>

                        <?php endif; ?>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <div class="c-product__description">
                            <?= the_content(); ?>
                        </div>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <div class="c-checkout__customer">
                            <label for="checkout-email"><span>Type your email</span>
                                <input type="email" name="email" placeholder="Email" id="checkout-email" required="required">
                                <input type="email" name="email2" placeholder="Email2" id="checkout-email-alt">
                            </label>
                            <label for="checkout-email"><span>Total</span>
                                <input type="text" id="checkout-total" value="<?= $total_price; ?> SEK" disabled>
                                <input type="hidden" id="checkout-currency" value="SEK">
                                <input type="hidden" id="checkout-total-shipping" value="<?= get_field('shipping_sweden', 'option'); ?>">
                                <input type="hidden" id="checkout-total-hidden" value="<?= $total_price; ?>">
                            </label>
                        </div>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <button class="button c-checkout__button" name="button" disabled>Send request</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
