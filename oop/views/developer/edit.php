[<a href="/oop/index.php?r=developer/index">Back</a>]
<div class="<?= $view_controller ?>">
    <?php if (empty($view_edit)): ?>
        <h1>Not found</h1>
    <?php else: ?>
        <h1>Edit developer "<?= $view_edit['name']; ?>"</h1>
        <?php if (isset($view_error)): ?>
            <p class="error"><?= $view_error ?></p>
        <?php endif; ?>
        <form method="post" action="/oop/index.php?r=developer/update&id=<?= $view_edit['id']; ?>">
            <input type="hidden" value="<?= $view_edit['id']; ?>" name="id">

            <div>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name" value="<?= $view_edit['name']; ?>">
            </div>
            <div>
                <label for="pay">Pay: </label>
                <input type="text" id="pay" name="pay" value="<?= $view_edit['pay']; ?>">
            </div>
            <div>
                <label for="bonus">Bonus: </label>
                <input type="text" id="bonus" name="bonus" value="<?= $view_edit['bonus']; ?>">
            </div>
            <div>
                <label for="project">Project: </label>
                <input type="text" id="project" name="project" value="<?= $view_edit['project']; ?>">
            </div>
            <div>
                <label for="technologies">Technologies: </label>
                <input type="text" id="technologies" name="technologies" value="<?= $view_edit['technologies']; ?>">
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>
    <?php endif; ?>
</div>