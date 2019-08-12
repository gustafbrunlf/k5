<?php
/**
 * Template Name: All products
 **/
?>
<?php while (have_posts()) : the_post();
$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'product',
	'post_status'      => 'publish',
);
$post = get_posts( $args);

foreach ($post as $key => $value) {
    //echo $value->post_title;
}

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

	    <?php //get_template_part('templates/projects/project-grid'); ?>
	</div>

<?php endwhile; ?>
