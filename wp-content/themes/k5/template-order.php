<?php
/**
 * Template Name: Checkout - order complete
 **/
?>
<?php while (have_posts()) : the_post(); ?>
<div class="c-order">
    <div class="o-width-limiter o-width-limiter--small">
        <div class="o-grid o-grid--small">
            <div class="o-grid__column o-grid__column--small" data-size="6">
                <h2>Thank you</h2>
            </div>
            <div class="o-grid__column o-grid__column--small" data-size="6">
                <?= the_content(); ?>
            </div>
        </div>
    </div>
    <h2 class="c-order__title"><a href="<?= get_site_url(); ?>">/5</a></h2>
</div>
<?php endwhile; ?>
