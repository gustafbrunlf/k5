<header class="header" role="banner">
    <div class="header__inner">
        <?php if ( get_field('sound', 'option') && is_page_template('template-start.php') ) : ?>
            <div class="header__sound">
            	<button id="sound-button">Sound off</button>
            </div>
        <?php endif; ?>
        <nav class="header__nav">
            <?php wp_nav_menu(); ?>
        </nav>
        <div class="header__cart">
            <span>Cart / <span class="header__cart-qty">0</span></span>
        </div>
        <div class="header__link">
            <?php
            $pages = get_pages(array(
        	    'meta_key' => '_wp_page_template',
        	    'meta_value' => 'template-products.php'
        	));
            ?>
            <a href="<?= get_permalink($pages[0]->ID); ?>"><?= $pages[0]->post_title; ?></a>
        </div>
    </div>
</header>
