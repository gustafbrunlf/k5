<?php if(have_posts()) :
$page_id = get_queried_object_id();
$term = get_term($page_id, 'category' );
$style = "";
if( $background_color = get_field('background_color', 'category_' . $term->term_id) ) :
    $style .= 'background-color:' . $background_color . ';';
endif;
if( $text_color = get_field('text_color', 'category_' . $term->term_id) ) :
    $style .= 'color:' . $text_color . ';';
endif;
?>
	<div class="c-project" style="<?= $style; ?>">
	    <div class="c-page-header"<?= get_field('fullwidth_background_color', 'category_' . $term->term_id) ? 'style="background-color:' . get_field('fullwidth_background_color', 'category_' . $term->term_id) .';"' : ''; ?>>
            <?php
            	$style = "";
            	if( $background_image = get_field('fullwidth_media', 'category_' . $term->term_id) ) :
            		$style = 'background-image: url(' . wp_get_attachment_image_src( $background_image, 'full-size' )[0] . ');';
                endif;

            	if($background_image_text = get_field('fullwidth_text', 'category_' . $term->term_id) ) :
            		$color = get_field('fullwidth_text_color');
                    $title = $background_image_text;
                else :
                    $title = '<span class="t-visually-hidden">' . get_the_title() . '</span>';
                    $color = '#000';
            	endif;

                $text = '';

            	$video = get_field('fullwidth_video', 'category_' . $term->term_id) ? get_field('fullwidth_video', 'category_' . $term->term_id) : '';
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
	    </div>
		<?php get_template_part('templates/sidebar'); ?>

        <?php
        if($grid = get_field('Grid', 'category_' . $term->term_id)):
            foreach ($grid as  $grid_item) :
        ?>
        <?php if(!$grid_item['fullwidth_grid']): ?>
        <div class="o-width-limiter o-width-limiter--small">
        <?php endif; ?>
            <div class="o-grid<?= $grid_item['margin_top_bottom'] == 'sm' ? ' o-grid--small' : ''; ?><?= $grid_item['fullwidth_grid'] ? ' o-grid--no-margin' : ''; ?>">
                <?php if($grid_item['row']) :
                    foreach($grid_item['row'] as $component) : ?>
                    <div class="o-grid__column<?= $grid_item['margin_images'] == 'sm' ? ' o-grid__column--small' : ''; ?>" data-size="<?= $component['width']; ?>">
                        <?php
                        if($prodID = $component['product']) :
                            $link = get_permalink($prodID);
                            $image = get_post_thumbnail_id($prodID);
                            $hover_image = get_field('hover_image', $prodID);
                            $title = get_field('number', $prodID);
                            $title_hover = get_field('hover_title', $prodID);
                            $secondary_title = get_field('price', $prodID) . ' SEK';
                        else :
                            $link = $component['image_link'];
                            $image = $component['image'];
                            $hover_image = $component['hover_image'];
                            $title = $component['image_title'];
                            $title_hover = $component['hover_title'];
                            $secondary_title = $component['image_description'];
                        endif; ?>

                        <?php if($title || $image || $component['text_block']) : ?>
                            <?php if($link): ?>
                            <a href="<?= $link; ?>" class="c-project__image">
                            <?php endif; ?>
                                <?php if($title): ?>
                                    <h3 class="c-project__image-title"><?= $title; ?>
                                    <?= $title_hover ? '<span class="c-project__image-title-hover">' . $title_hover . '</span>' : ''; ?>
                                    <?= $secondary_title ? '<span>' . $secondary_title . '</span>' : ''; ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if($image): ?>
                                    <div class="c-project__image-wrapper">
                                        <img <?= $hover_image ? 'class="c-project__image-original" ' : ''; ?>src="<?= wp_get_attachment_image_src($image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy">
                                        <?php if($hover_image): ?>
                                            <img class="c-project__image-hover" src="<?= wp_get_attachment_image_src($hover_image, 'full')[0]; ?>" alt="<?= $title; ?>" loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                    if(!$component['product'] && $component['text_block']):
                                        foreach ($component['text_block'] as $text) : ?>
                                            <div class="c-project__text-block c-project__text-block--<?= $text['margin']; ?>">
                                                <?= $text['text']; ?>
                                            </div>
                                <?php endforeach;
                                endif; ?>
                            <?php if($link): ?>
                            </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach;
                endif; ?>
            </div>
        <?php if(!$grid_item['fullwidth_grid']): ?>
        </div>
        <?php endif; ?>
        <?php endforeach;
        endif; ?>

	</div>
<?php endif; ?>
