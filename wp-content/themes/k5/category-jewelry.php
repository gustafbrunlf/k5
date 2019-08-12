<?php while (have_posts()) : the_post();
$term = get_term( 1, 'category' );
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
            		<video autoplay muted loop>
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
                <?php foreach($grid_item['row'] as $component) : ?>
                    <div class="o-grid__column<?= $grid_item['margin_images'] == 'sm' ? ' o-grid__column--small' : ''; ?>" data-size="<?= $component['width']; ?>">
                        <?php
                        if($prodID = $component['product']) :
                            $link = get_permalink($prodID);
                            $image = get_post_thumbnail_id($prodID);
                            $title = get_field('number', $prodID);
                            $secondary_title = get_field('price', $prodID) . ' SEK';
                        else :
                            $link = $component['image_link'];
                            $image = $component['image'];
                            $title = $component['image_title'];
                            $secondary_title = $component['image_description'];
                        endif; ?>

                        <?php if($title || $image || $component['text_block']) : ?>
                            <?php if($link): ?>
                            <a href="<?= $link; ?>" class="c-project__image">
                            <?php endif; ?>
                                <?php if($title): ?>
                                    <h3 class="c-project__image-title"><?= $title; ?>
                                    <?= $secondary_title ? '<span>' . $secondary_title . '</span>' : ''; ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if($image): ?>
                                    <img src="<?= wp_get_attachment_image_src($image, 'large')[0]; ?>" alt="<?= $title; ?>">
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
                <?php endforeach; ?>
            </div>
        <?php if(!$grid_item['fullwidth_grid']): ?>
        </div>
        <?php endif; ?>
        <?php endforeach;
        endif; ?>

	</div>
<?php endwhile; ?>
