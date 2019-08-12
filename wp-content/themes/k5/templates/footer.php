<?php if ( get_field('sound', 'option') && !is_page_template('template-checkout.php') ) : ?>
	<audio id="sound" loop autoplay>
		 <source src="<?= get_field('sound', 'option'); ?>" type="audio/mpeg">
	</audio>
<?php endif; ?>

<footer class="footer"></footer>

<?php if(false): ?>
<div class="popup">
	<div class="popup__wrapper" style="background-color: <?= get_field('background-color', 'option'); ?>; color: <?= get_field('text-color', 'option'); ?>;">
		<div class="popup__close"><span class="t-visually-hidden">Close popup</span></div>
		<h4><?= get_field('title', 'option'); ?></h4>
		<div class="popup__email">
		<?php
			if ( $emails = get_field('emails', 'option') ) :
				foreach ($emails as $email) :
					if($email['label']) {
						echo '<p>' . $email['label'] . '</p>';
					}
					echo '<a href="mailto:' . $email['link'] . '">' . $email['link'] . '</a>';
				endforeach;
			endif;

			if( $instagram = get_field('instagram', 'option') ) :
				echo '<a href="' . $instagram . '" target="_blank">Instagram</a>';
			endif;

			if( $facebook = get_field('facebook', 'option') ) :
				echo '<a href="' . $facebook . '" target="_blank">Facebook</a>';
			endif;
		?>
		</div>
		<div class="popup__text">
			<?php the_field('text', 'option'); ?>
		</div>
		<div class="popup__icons">
			<ul>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.97 26.06"><polygon points="0 0 5.91 26.06 25.36 26.06 31.97 0 28.84 0 23.28 22.59 8.69 22.59 3.13 0 0 0"/><path d="M27.74,6.28c-2.15-1.47-5-3.05-5.82-3.06A8,8,0,0,0,19.45,4.5c-1.3.86-2.54,1.66-3.7,1.62a6.15,6.15,0,0,1-3.14-1.66,6.14,6.14,0,0,0-2-1.24c-.91,0-3.8,1.39-5.95,2.75L3.62,4.27c.84-.52,5.1-3.17,7.12-3a6.28,6.28,0,0,1,3.1,1.66,6.12,6.12,0,0,0,2,1.24,6.84,6.84,0,0,0,2.51-1.29C19.6,2,20.78,1.22,21.92,1.22h0c1.8,0,5.76,2.61,6.93,3.41Z" /></svg>
				</li>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.55 26.55"><path d="M26.55,26.55H0V0H26.55ZM2,24.55H24.55V2H2Z" transform="translate(0 0)"/></svg>
				</li>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.28 26.24"><path d="M9.87,0h14a21.2,21.2,0,0,1,3.8,2.07,19.68,19.68,0,0,1,2.07,3.45l5.52,20.72H0V22.78H31.14L26.31,6.56a9.08,9.08,0,0,0-1.16-2.09,10.58,10.58,0,0,0-2.51-1H10.13Z"/></svg>
				</li>
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.57 26.57"><path d="M26.57,26.57H0V0H26.57ZM2,24.57H24.57V2H2Z" transform="translate(0 0)"/><rect x="0.37" y="12.32" width="26.15" height="2" transform="translate(-5.48 13.65) rotate(-45.73)"/><rect x="12.32" y="0.05" width="2" height="26.15" transform="translate(-5.37 13.55) rotate(-45.88)"/></svg>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="form__popup">
	<div class="form__wrapper">
		<div class="form__header">
    		<img src="">
		</div>
		<div class="form__close"></div>
		<?= do_shortcode('[contact-form-7 id="39" title="Customer form"]'); ?>
	</div>
</div>
<?php endif; ?>

<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
