<header class="header" role="banner">
    <div class="header__logo-wrapper">
    	<div class="header__close-logo"></div>
        <a href="<?= get_home_url(); ?>" class="header__logo">
        	<img src="<?=get_template_directory_uri()?>/dist/images/logomenupage.png">
        </a>
    </div>
    <?php wp_nav_menu(); ?>
</header>
