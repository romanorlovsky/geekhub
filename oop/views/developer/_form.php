<?php if (isset($params_create)): ?>
<form method="post" action="/oop/index.php?r=<?php echo $part_controller ?>/create">
    <?php else: ?>
    <form method="post" action="/oop/index.php?r=<?php echo $part_controller ?>/update&id=<?php echo $part_id; ?>">
        <?php endif; ?>
        <input type="hidden" value="<?php echo $part_id; ?>" name="id">

        <div>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" value="<?php if (isset($part_name)) echo $part_name; ?>">
        </div>
        <div>
            <label for="pay">Pay: </label>
            <input type="text" id="pay" name="pay" value="<?php if (isset($part_pay)) echo $part_pay; ?>">
        </div>
        <div>
            <label for="bonus">Bonus: </label>
            <input type="text" id="bonus" name="bonus" value="<?php if (isset($part_bonus)) echo $part_bonus; ?>">
        </div>
        <div>
            <label for="project">Project: </label>
            <input type="text" id="project" name="project" value="<?php if (isset($part_project)) echo $part_project; ?>">
        </div>
        <div>
            <label for="technologies">Technologies: </label>
            <input type="text" id="technologies" name="technologies" value="<?php if (isset($part_technologies)) echo $part_technologies; ?>">
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
    </form>