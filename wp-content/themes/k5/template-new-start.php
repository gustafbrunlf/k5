<?php
/**
 * Template Name: Start 2.0
 **/
?>
<?php while (have_posts()) : the_post();
$project = get_field('project');

global $post;
$post = get_post( $project->ID, OBJECT );
setup_postdata( $post );

$style = "";
if( $background_color = get_field('background_color') ) :
    $style .= 'background-color:' . $background_color . ';';
endif;
if( $text_color = get_field('text_color') ) :
    $style .= 'color:' . $text_color . ';';
endif;
?>
<div class="c-project" style="<?= $style; ?>">
    <div class="c-project__header"<?= get_field('fullwidth_background_color') ? 'style="background-color:' . get_field('fullwidth_background_color') .';"' : ''; ?>>
        <?php get_template_part('templates/projects/project-header'); ?>
    </div>

    <?php get_template_part('templates/sidebar'); ?>

    <div class="o-width-limiter">
        <h2 class="c-project__subheader"><?= get_the_title(); ?></h2>
        <?= the_content(); ?>
    </div>

    <?php get_template_part('templates/projects/project-grid'); ?>
</div>
<?php wp_reset_postdata();
endwhile; ?>
