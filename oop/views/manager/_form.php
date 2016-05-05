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
            <label for="projects">Projects: </label>
            <input type="text" id="projects" name="projects" value="<?php if (isset($part_projects)) echo $part_projects; ?>">
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
    </form>