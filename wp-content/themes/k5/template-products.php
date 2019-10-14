<?php
/**
 * Template Name: All products
 **/
?>

<?php
	// MEDIA
    $media = get_field('media');
    $type = null;
    if(!empty($media)) {
        $format = pathinfo($media['url'], PATHINFO_EXTENSION);
        $type = ($format === 'mp4') ? 'video' : 'image';
    }

	if (!empty($type)): ?>
    <div class="media_placeholder media_placeholder--<?php echo $type; ?>" data-format="<?php echo $format; ?>">
        <?php if ($type === 'video'): ?>
            <video src="<?php echo $media['url']; ?>" loop autoplay playsinline muted></video>
        <?php else: ?>
			<img src="<?php echo $media['url']; ?>" alt="<?php echo $media['alt']; ?>" />
        <?php endif; ?>
        <div class="media_placeholder--close"><span class="hide">Close</span></div>
    </div>
<?php endif; ?>

<?php while (have_posts()) : the_post();
$style = "";
if( $background_color = get_field('background_color') ) :
    $style .= 'background-color:' . $background_color . ';';
endif;
if( $text_color = get_field('text_color') ) :
    $style .= 'color:' . $text_color . ';';
endif;
?>
	<div class="c-project" style="<?= $style; ?>">
	    <div class="c-page-header"<?= get_field('fullwidth_background_color') ? 'style="background-color:' . get_field('fullwidth_background_color') .';"' : ''; ?>>
	        <?php get_template_part('templates/projects/project-header'); ?>
	    </div>
		<?php get_template_part('templates/sidebar'); ?>

	    <?php get_template_part('templates/projects/project-grid'); ?>
	</div>

<?php endwhile; ?>
