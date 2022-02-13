<?php
$cookie_name = 'currency';
if(!isset($_COOKIE[$cookie_name])) {
    $currency = 'EUR';
} else {
    $currency = $_COOKIE[$cookie_name];
} ?>
<header class="c-header" role="banner">
    <div class="c-header__inner">
        <?php if ( get_field('sound', 'option') && !is_page_template('template-checkout.php') && !is_page_template('template-order.php') ) : ?>
            <div class="c-header__sound">
            	<button id="sound-button">Sound off</button>
            </div>
        <?php endif; ?>
        <nav class="c-header__nav">
        <?php if(!is_page_template('template-checkout.php')): ?>
            <?php wp_nav_menu(); ?>
        <?php else : ?>
            <a href="<?= get_home_url(); ?>">Keep shopping</a>
        <?php endif; ?>
        </nav>
        <div class="c-header__cart">
            <?php
            $cookie_name = 'products';
            if(!isset($_COOKIE[$cookie_name])) {
                $cart_value = 0;
            } else {
                $cart_value = json_decode(stripslashes($_COOKIE[$cookie_name]));

                if(empty($cart_value)) {
                    $cart_value = 0;
                } else {
                    $cart_value = count($cart_value);
                }
            }

            $checkout = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-checkout.php'
            ));
            ?>
            <?= $cart_value > 0 ? '<a href="' . get_permalink($checkout[0]->ID)  . '">' : '' ?>Cart / <span class="c-header__cart-qty"><?= $cart_value; ?></span><?= $cart_value > 0 ? '<span class="c-header__cart-checkout"> / Checkout</span></a>' : '';?>
        </div>

        <?php if(!is_page_template('template-checkout.php')): ?>
            <div class="c-header__currency<?= is_page_template('template-products.php') ? ' c-header__currency--show-xs' : '';?>">
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                    <input type="radio" name="currency[]" value="EUR" id="eur" class="c-header__auto-submit"<?= $currency == 'EUR' ? ' checked' : ''; ?>>
                    <label for="eur">EUR</label>
                    <input type="radio" name="currency[]" value="SEK" id="sek" class="c-header__auto-submit"<?= $currency == 'SEK' ? ' checked' : ''; ?>>
                    <label for="sek">SEK</label>
                </form>
            </div>
            <div class="c-header__link<?= is_page_template('template-products.php') ? ' c-header__link--hide-xs' : '';?>">
                <?php
                $all_products = get_pages(array(
            	    'meta_key' => '_wp_page_template',
            	    'meta_value' => 'template-products.php'
            	));
                ?>
                <a href="<?= get_permalink($all_products[0]->ID); ?>"><?= $all_products[0]->post_title; ?></a>
            </div>
        <?php endif; ?>
    </div>
</header>
