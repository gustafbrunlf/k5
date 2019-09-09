<?php
    $args = [
        'orderby'   => 'name',
        'order'     => 'DESC',
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
        $current_page = get_the_id() === $category->term_id && is_category() ? true : false;
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
