<div class="<?php echo $view_controller ?>">
    <h1>Developers</h1>
    <?php if (isset($view_update)): ?>
        <p>Developer update successfully</p>
    <?php endif; ?>
    <?php if (isset($view_remove)): ?>
        <?php if ($view_remove): ?>
            <p>Developer remove successfully</p>
        <?php else: ?>
            <p>Developer remove error</p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($view_create)): ?>
        <p>Developer create successfully</p>
    <?php endif; ?>
    <ul class="<?php echo $view_controller ?>-list">
        <?php if (!empty($view_list)): ?>
            <?php foreach ($view_list as $item): ?>
                <li>
                    <span><?php echo $item['name']; ?></span>
                    <a href="/oop/index.php?r=<?php echo $view_controller ?>/update&id=<?php echo $item['id'] ?>">Edit</a>
                    <a href="/oop/index.php?r=<?php echo $view_controller ?>/delete&id=<?php echo $item['id'] ?>" onclick="if(!confirm('Are you sure?')) return false;">Remove</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <a href="/oop/index.php?r=<?php echo $view_controller ?>/create">Create</a>
</div>