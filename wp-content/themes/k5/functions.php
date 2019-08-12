<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/post_types.php', // Post types
  'lib/ajax.php',        // AJAX
  // 'lib/acf.php'
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

function custom_login_logo() {
	echo '<style type="text/css">body.login { background-image: url(https://video-images.vice.com/articles/59f775e48e4e2008860fb7c7/lede/1509484300456-Royale-at-Starbucks-fixed.png); background-size: cover; background-position: center; background-repeat: no-repeat; } #login h1 a { display: none; }</style>';
}
add_action('login_head', 'custom_login_logo');

add_filter( 'show_admin_bar', '__return_false' );

add_action ( 'wp_ajax_submitForm', 'submitAndEmailForm' );
add_action ( 'wp_ajax_nopriv_submitForm', 'submitAndEmailForm' );
