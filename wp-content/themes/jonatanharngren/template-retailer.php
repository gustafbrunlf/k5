<?php
/**
 * Template Name: Retailer
 **/
?>
<?php while (have_posts()) : the_post(); ?>

<div class="retailer__wrapper">
	<div class="retailer__header">
		<img src="">
	</div>
	<?php the_content(); ?>
</div>

<?php endwhile; ?>