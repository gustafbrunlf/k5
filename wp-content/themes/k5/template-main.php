<?php
/**
 * Template Name: Main
 **/
?>
<?php 
global $iteration; 
$iteration = 1;
?>
<?php while (have_posts()) : the_post(); ?>

<div class="block__wrapper">
	<?php while ( have_rows('block') ) : the_row(); ?>
		<div class="block__container<?= ( $iteration == 1 ) ? ' block__container--active' : ''; ?>" data-block="<?= $iteration; ?>">
			<?php 
				if(get_sub_field('content')) : while(has_sub_field("content")) : 

					get_template_part('templates/sections/section', get_row_layout());
		
				endwhile; endif;

				$iteration++;
			?>
		</div>
	<?php endwhile; ?>
</div>

<?php $blocks = get_field('block'); ?>

<div class="sidebar">
	<ul class="sidebar__wrapper">
	<?php foreach($blocks as $key => $block) : ?>
		<?php $key++; ?>
		<li data-block="<?= $key; ?>" class="sidebar__item<?= ( $key == 1 ) ? ' sidebar__item--active' : ''; ?>">0<?= $key; ?></li>
	<?php endforeach; ?>
	</ul>
</div>

<?php endwhile; ?>