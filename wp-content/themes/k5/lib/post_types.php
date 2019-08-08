<?php

function create_post_type_projects() {
  register_post_type( 'product',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'Product' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'taxonomies' => array('category'),
    )
  );
}
add_action( 'init', 'create_post_type_projects' );
