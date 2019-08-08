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
	    <div class="c-project__header"<?= get_field('fullwidth_background_color', 'category_' . $term->term_id) ? 'style="background-color:' . get_field('fullwidth_background_color', 'category_' . $term->term_id) .';"' : ''; ?>>
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
            <div class="c-project__header-content<?= $video ? ' c-project__header-content--video' : ''; ?>"<?= $style && !$video ? ' style="' . $style . '"' : ''; ?>>
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
            	<h1 class="c-project__header-title" style="color:<?= $color; ?>"><?= $title; ?></h1>
            </div>
	    </div>
		<?php get_template_part('templates/sidebar'); ?>

	    <?php //get_template_part('templates/projects/project-grid'); ?>
	</div>
<?php endwhile; ?>
