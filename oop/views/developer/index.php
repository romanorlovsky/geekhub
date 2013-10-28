<div class="<?= $view_controller ?>">
    <h1>Developers</h1>
    <?php if(isset($view_update)): ?>
        <p>Developer update successfully</p>
    <?php endif; ?>
    <?php if (isset($view_remove)): ?>
        <?php if ($view_remove): ?>
            <p>Developer remove successfully</p>
        <?php else: ?>
            <p>Developer remove error</p>
        <?php endif; ?>
    <?php endif; ?>
    <ul class="<?= $view_controller ?>-list">
        <?php if (!empty($view_list)): ?>
            <?php foreach ($view_list as $item): ?>
                <li>
                    <span><?= $item['name']; ?></span>
                    <a href="/oop/index.php?r=<?= $view_controller ?>/update&id=<?= $item['id'] ?>">Edit</a>
                    <a href="/oop/index.php?r=<?= $view_controller ?>/remove&id=<?= $item['id'] ?>" onclick="if(!confirm('Are you sure?')) return false;">Remove</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>