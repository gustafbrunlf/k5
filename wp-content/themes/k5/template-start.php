<?php
/**
 * Template Name: Start
 **/
?>

<?php while (have_posts()) : the_post(); ?>

<?php 
	$style = "";
	if( $background_image = get_field('background-image') ) : 
		$style = 'background-image: url(' . wp_get_attachment_image_src( $background_image, 'large' )[0] . ');';
	elseif( $background_color = get_field('background-color') ) :
		$style .= 'background-color:' . $background_color . ';';
	endif;

	$pages = get_pages(array(
	    'meta_key' => '_wp_page_template',
	    'meta_value' => 'template-main.php'
	));
?>

<div class="start__container" style="<?= $style; ?>">
	<div class="start__logo-wrapper">
		<div class="start__close-logo"></div>
		<a href="<?= get_permalink($pages[0]->ID); ?>">
			<img src="<?= get_field('logotyp'); ?>" class="start__logo">
		</a>
	</div>
</div>

<?php endwhile; ?>