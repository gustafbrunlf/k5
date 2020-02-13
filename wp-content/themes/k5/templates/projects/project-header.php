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

	if($style || $video):
?>
<div class="c-page-header__content<?= $video ? ' c-page-header__content--video' : ''; ?>"<?= $style && !$video ? ' style="' . $style . '"' : ''; ?>>
	<?php
	if( $video ) : ?>
		<video poster="" autoplay muted loop playsinline>
			<source src="<?= $video['url']; ?>"
					type="video/webm">
			<source src="<?= $video['url']; ?>"
					type="video/mp4">
			Sorry, your browser doesn't support embedded videos.
		</video>
    <?php endif; ?>
	<h1 class="c-page-header__title" style="color:<?= $color; ?>"><?= $title; ?></h1>
</div>
<?php else : ?>
	<h1 class="t-visually-hidden"><?= get_the_title() ?></h1>
<?php endif; ?>
