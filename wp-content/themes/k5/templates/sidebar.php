<?php
    $categories = get_categories();
    if($categories) :
?>
<div class="sidebar">
    <ul class="sidebar__wrapper">
        <li class="sidebar__item">
            <a href="<?= get_home_url(); ?>">Kultur5</a>
        </li>
    <?php foreach($categories as $key => $category) :
        $current_page = get_the_id() == $category->term_id && is_tax() ? true : false;
        $key++; ?>
        <li class="sidebar__item<?= ( $current_page ) ? ' sidebar__item--active' : ''; ?>">
            <?= !$current_page ? '<a href="' . get_category_link($category->term_id) . '">' : ''; ?>
                <?php if($current_page) : ?>
                    Kultur5 / <?= $key; ?> / <?= $category->name; ?>
                <?php else : ?>
                    Kultur5 / <?= $key; ?>
                <?php endif; ?>
            <?= !$current_page ? '</a>' : ''; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
