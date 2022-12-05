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
	if(!get_field('two_column_images')):
		if($background_image_mobile = get_field('fullwidth_mobile_image')): ?>
			<div class="c-page-header__content c-page-header__content--mobile" style="background-image: url('<?= wp_get_attachment_image_src( $background_image_mobile, 'full-size' )[0]; ?>')">
				<h1 class="c-page-header__title" style="color:<?= $color; ?>"><?= $title; ?></h1>
			</div>
		<?php endif; ?>
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
		<div class="c-page-header__columns">
			<div class="c-page-header__column">
				<img src="<?= wp_get_attachment_image_src( get_field('fullwidth_media'), 'full-size' )[0]; ?>" alt="First of two column image" <?= get_field('fullwidth_mobile_image') ? 'class="c-page-header__column-image"' : ''?>>
				<?php if($fullwidth_mobile_image = get_field('fullwidth_mobile_image')): ?>
					<img src="<?= wp_get_attachment_image_src( $fullwidth_mobile_image, 'full-size' )[0]; ?>" alt="First of two column image" class="c-page-header__column-image--mobile">
				<?php endif; ?>
				<?php if($link = get_field('first_column_link')): ?>
					<a href="<?= $link; ?>" class="c-page-header__link c-page-header__link--right" style="color:<?= get_field('first_column_link_color'); ?>">
						<span><?= get_field('first_column_link_text'); ?></span>
					</a>
				<?php endif; ?>
			</div>
			<div class="c-page-header__column">
				<img src="<?= wp_get_attachment_image_src( get_field('fullwidth_second_media'), 'full-size' )[0]; ?>" alt="Second of two column image" <?= get_field('fullwidth_second_media_mobile') ? 'class="c-page-header__column-image"' : ''?>>
				<?php if($fullwidth_second_media_mobile = get_field('fullwidth_second_media_mobile')): ?>
					<img src="<?= wp_get_attachment_image_src( $fullwidth_second_media_mobile, 'full-size' )[0]; ?>" alt="Second of two column image" class="c-page-header__column-image--mobile">
				<?php endif; ?>
				<?php if($second_link = get_field('second_column_link')): ?>
					<a href="<?= $second_link; ?>" class="c-page-header__link c-page-header__link--left" style="color:<?= get_field('second_link_color'); ?>">
						<span><?= get_field('second_column_link_text'); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
<?php else : ?>
	<h1 class="t-visually-hidden"><?= get_the_title() ?></h1>
<?php endif; ?>
