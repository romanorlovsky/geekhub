<div class="<?= $view_controller ?>">
    <h1>Managers</h1>
    <ul class="<?= $view_controller ?>-list">
        <?php if (!empty($view_list)): ?>
            <?php foreach ($view_list as $item): ?>
                <li>
                    <span><?= $item['name']; ?></span>
                    <a href="/oop/index.php?r=<?= $view_controller ?>/edit&id=<?= $item['id'] ?>">Edit</a>
                    <a href="/oop/index.php?r=<?= $view_controller ?>/remove&id=<?= $item['id'] ?>">Remove</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>