<?php

function create_post_type_projects() {
  register_post_type( 'projects',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
    )
  );
}
add_action( 'init', 'create_post_type_projects' );
