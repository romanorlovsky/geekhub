<form method="post" action="/oop/index.php?r=<?= $part_controller ?>/update&id=<?= $part_id; ?>">
    <input type="hidden" value="<?= $part_id; ?>" name="id">

    <div>
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" value="<?= $part_name; ?>">
    </div>
    <div>
        <label for="pay">Pay: </label>
        <input type="text" id="pay" name="pay" value="<?= $part_pay; ?>">
    </div>
    <div>
        <label for="bonus">Bonus: </label>
        <input type="text" id="bonus" name="bonus" value="<?= $part_bonus; ?>">
    </div>
    <div>
        <label for="project">Project: </label>
        <input type="text" id="project" name="project" value="<?= $part_project; ?>">
    </div>
    <div>
        <label for="technologies">Technologies: </label>
        <input type="text" id="technologies" name="technologies" value="<?= $part_technologies; ?>">
    </div>
    <div>
        <input type="submit" value="Save">
    </div>
</form>