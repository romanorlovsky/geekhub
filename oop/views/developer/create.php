[<a href="/oop/index.php?r=<?php echo $view_controller ?>/index">Back</a>]
<div class="<?php echo $view_controller ?>">
    <?php if (empty($view_create)): ?>
        <h1>Not found</h1>
    <?php else: ?>
        <h1>Create developer</h1>
        <?php if (isset($view_errors)): ?>
            <?php if (is_array($view_errors)): ?>
                <?php foreach ($view_errors as $view_error): ?>
                    <p class="error"><?php echo $view_error ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="error"><?php echo $view_errors ?></p>
            <?php endif; ?>
        <?php endif; ?>
        <?php $this->renderPartial('form', $view_create, array('create' => true)); ?>
    <?php endif; ?>
</div>