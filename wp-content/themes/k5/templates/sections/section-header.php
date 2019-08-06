<?php 
	$style = "";
	if( $background_image = get_sub_field('background-image') ) : 
		$style = 'background-image: url(' . wp_get_attachment_image_src( $background_image, 'full-size' )[0] . ');';
	elseif( $background_color = get_sub_field('background-color') ) :
		$style .= 'background-color:' . $background_color . ';';
	endif;

	$text = "";
	if( $background_image_text = get_sub_field('background-image-text') ) : 
		$color = get_sub_field('background-image-text-color');
		$text = '<div class="block__text" style="color:' . $color . '">' . $background_image_text . '</div>';
	endif;
?>
<section class="block" style="<?= $style; ?>"><?= $text; ?></section>