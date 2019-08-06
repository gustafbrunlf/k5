<?php
    $args = array(
    	'posts_per_page'   => -1,
    	'orderby'          => 'date',
    	'order'            => 'ASC',
    	'post_type'        => 'projects',
    	'post_status'      => 'publish',
    );
    $projects = get_posts( $args );
    if($projects) :
?>
<div class="sidebar">
    <ul class="sidebar__wrapper">
    <?php foreach($projects as $key => $project) :
        $current_page = get_the_id() == $project->ID ? true : false;
        $key++; ?>
        <li class="sidebar__item<?= ( $current_page ) ? ' sidebar__item--active' : ''; ?>">
            <?= !$current_page ? '<a href="' . get_post_permalink($project->ID) . '">' : ''; ?>
                <?php if(get_field('menu_name', $project->ID)) : ?>
                    <?= get_field('menu_name', $project->ID); ?>
                <?php else : ?>
                    P.0<?= $key; ?>
                <?php endif; ?>
            <?= !$current_page ? '</a>' : ''; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
