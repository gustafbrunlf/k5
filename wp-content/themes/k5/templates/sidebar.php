<?php
    $args = [
        'orderby'   => 'name',
        'order'     => 'ASC',
    ];
    $categories = get_categories($args);

    if($categories) :
?>
<div class="c-sidebar">
    <ul class="c-sidebar__wrapper">
        <li class="c-sidebar__item">
            <a href="<?= get_home_url(); ?>">Kultur5</a>
        </li>
    <?php foreach($categories as $key => $category) :
        if(isset($wp_query->query['category_name'])) {
            $current_page = $wp_query->query['category_name'] === $category->slug && is_category() ? true : false;
        } else {
            $current_page = false;
        }
        $key++; ?>
        <li class="c-sidebar__item<?= ( $current_page ) ? ' c-sidebar__item--active' : ''; ?>">
            <?= !$current_page ? '<a href="' . get_category_link($category->term_id) . '">' : ''; ?>
                <?php if($current_page) : ?>
                    Kultur5 / <?= $key; ?> / <?= $category->name; ?>
                <?php else : ?>
                    Kultur5 / <?= $key; ?><span> / <?= $category->name; ?></span>
                <?php endif; ?>
            <?= !$current_page ? '</a>' : ''; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
