<?php
	global $iteration;

	$style = "";
	if( $background_color = get_sub_field('background-color') ) :
		$style .= 'background-color:' . $background_color . ';';
	endif;
	if( $text_color = get_sub_field('text-color') ) :
		$style .= 'color:' . $text_color . ';';
	endif;
?>
<section class="block" style="<?= $style; ?>">
	<div class="content__container">
		
		<?php if( $siteinfo = get_sub_field('siteinfo') ) : ?>
			<div class="siteinfo">
				<p><?= 0 . $iteration; ?></p>
				<?= $siteinfo; ?>
			</div>
		<?php endif; ?>

		<div class="content__row">
			<?php if( $column_one = get_sub_field('pictures-column-one') ) : ?>
				<div class="content__col">
					<?php 
						foreach ($column_one as $value) {
							echo '<div class="content__wrapper' . (( $value['padding'] ) ? ' content__wrapper--padding' : '') . '">';
							if( $value['slider'] && $value['use_slider'] ) {
								echo '<div class="slider-wrapper">';
								foreach ($value['slider'] as $slide) {
									echo '<div class="slide-item"><img src="' . wp_get_attachment_image_src($slide['slider-image'], 'large')[0] . '"></div>';
								}
								echo '</div>';
							} else {
								echo '<img src="' . wp_get_attachment_image_src($value['image'], 'large')[0] . '">';
							}
							echo '<p>' . $value['bylinetext'] . '</p>';
							echo '</div>';
						}
					?>
				</div>
			<?php endif; ?>

			<?php if( $column_two = get_sub_field('pictures-column-two') ) : ?>
				<div class="content__col">
					<?php 
						foreach ($column_two as $value) {
							echo '<div class="content__wrapper' .  (( $value['padding'] ) ? ' content__wrapper--padding' : '') . '">';
								if( $value['slider'] && $value['use_slider'] ) {
									echo '<div class="slider-wrapper">';
									foreach ($value['slider'] as $slide) {
										echo '<div class="slide-item"><img src="' . wp_get_attachment_image_src($slide['slider-image'], 'large')[0] . '"></div>';
									}
									echo '</div>';
								} else {
									echo '<img src="' . wp_get_attachment_image_src($value['image'], 'large')[0] . '">';
								}
								echo '<p>' . $value['bylinetext'] . '</p>';
							echo '</div>';
						}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
