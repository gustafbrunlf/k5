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
                                    <h2><?= get_the_title($product); ?></h2>
                                    <select name="size">
                                        <option value="small">S</option>
                                        <option value="small">M</option>
                                        <option value="small">L</option>
                                    </select>
                                    <select name="qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <p><?= get_field('price', $product); ?> SEK</p>
                                    <select name="shipping">
                                        <option value="standard">Standard shipping</option>
                                        <option value="pickup">Pickup</option>
                                    </select>
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
                        <label for="checkout-email">Type your email</label>
                        <input type="email" name="email" id="checkout-email">
                        <label for="checkout-email">Total</label>
                        <input type="number" name="total" id="checkout-email" value="<?= $total_price; ?>" disabled>
                    </div>
                    <div class="o-grid__column o-grid__column--small" data-size="6">
                        <button name="button">Send request</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
