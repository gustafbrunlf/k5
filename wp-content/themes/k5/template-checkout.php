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
    $cart = json_decode($_COOKIE[$cookie_name]);
    $cart_value = count($cart);
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
                                        <button class="button c-checkout__item-remove" type="button" name="button"><span class="t-visually-hidden">Remove button</span></button>
                                        <h2><a href="<?= get_permalink($product); ?>"><?= get_the_title($product); ?></a></h2>
                                        <input type="hidden" name="product-title-<?= $product; ?>" value="<?= get_the_title($product); ?>">
                                    </div>
                                    <div class="c-checkout__item-size">
                                        <select name="size">
                                            <option value="small">S</option>
                                            <option value="small">M</option>
                                            <option value="small">L</option>
                                        </select>
                                    </div>
                                    <div class="c-checkout__item-qty">
                                        <select name="qty" data-price="<?= get_field('price', $product); ?>">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <p class="c-checkout__item-price"><span><?= get_field('price', $product); ?></span> SEK</p>
                                    <input type="hidden" name="price" value="<?= get_field('price', $product); ?>">
                                    <?php if(false): ?>
                                        <div class="c-checkout__item-shipping">
                                            <select name="shipping">
                                                <option value="standard">Standard shipping</option>
                                                <option value="pickup">Pickup</option>
                                            </select>
                                        </div>
                                        <p class="c-checkout__item-price-shipping">100 SEK</p>
                                    <?php endif; ?>
                                </div>
                                <?php $total_price += intval(get_field('price', $product)); ?>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <div class="c-product__description">
                            <?= the_content(); ?>
                        </div>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <div class="c-checkout__customer">
                            <label for="checkout-email">Type your email
                                <input type="email" name="email" placeholder="Email" id="checkout-email" required="required">
                                <input type="email" name="email2" placeholder="Email2" id="checkout-email-alt">
                            </label>
                            <label for="checkout-email">Total
                                <input type="number" id="checkout-total" value="<?= $total_price; ?>" disabled>
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
