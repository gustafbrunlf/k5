<?php
	$style = "";
	if( $background_image = get_field('fullwidth_media') ) :
		$style = 'background-image: url(' . wp_get_attachment_image_src( $background_image, 'full-size' )[0] . ');';
    endif;

	if($background_image_text = get_field('fullwidth_text') ) :
		$color = get_field('fullwidth_text_color');
        $title = $background_image_text;
    else :
        $title = '<span class="t-visually-hidden">' . get_the_title() . '</span>';
        $color = '#000';
	endif;

    $text = '';

	$video = get_field('fullwidth_video') ? get_field('fullwidth_video') : '';
?>
<?php if(!get_field('full_width_layout')) : ?>
<div class="o-width-limiter">
<?php endif; ?>
<div class="c-project-header__content<?= $video ? ' c-project-header__content--video' : ''; ?>"<?= $style && !$video ? ' style="' . $style . '"' : ''; ?>>
	<?php
	if( $video ) : ?>
		<video autoplay muted loop>
			<source src="<?= $video['url']; ?>"
					type="video/webm">
			<source src="<?= $video['url']; ?>"
					type="video/mp4">
			Sorry, your browser doesn't support embedded videos.
		</video>
    <?php endif; ?>
	<h1 class="c-project-header__title" style="color:<?= $color; ?>"><?= $title; ?></h1>
</div>
<?php if(!get_field('full_width_layout')) : ?>
</div>
<?php endif; ?>
