<?php
/**
 * Template Name: All products
 **/
?>
<?php while (have_posts()) : the_post(); ?>

    <?php
    $args = array(
    	'posts_per_page'   => -1,
    	'orderby'          => 'date',
    	'order'            => 'DESC',
    	'post_type'        => 'product',
    	'post_status'      => 'publish',
    );
    $post = get_posts( $args);

    foreach ($post as $key => $value) {
        echo $value->post_title;
    }
    ?>

<?php endwhile; ?>
