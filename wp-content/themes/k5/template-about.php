<?php
/**
 * Template Name: About
 **/
?>
<?php while (have_posts()) : the_post();
$style = "";
if( $background_color = get_field('background_color') ) :
    $style .= 'background-color:' . $background_color . ';';
endif;
if( $text_color = get_field('text_color') ) :
    $style .= 'color:' . $text_color . ';';
endif;
?>
	<div class="c-about" style="<?= $style; ?>">
	    <div class="c-page-header"<?= get_field('fullwidth_background_color') ? 'style="background-color:' . get_field('fullwidth_background_color') .';"' : ''; ?>>
	        <?php get_template_part('templates/projects/project-header'); ?>
	    </div>
		<?php get_template_part('templates/sidebar'); ?>
        <nav class="c-subnav">
			<?php
            $args = [
                'menu' => 'submenu'
            ];
            wp_nav_menu($args); ?>
		</nav>
        <?php get_template_part('templates/projects/project-grid'); ?>
    </div>
<?php endwhile; ?>
