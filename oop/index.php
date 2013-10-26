<!doctype html>
<?php
include 'autoload.php';
?>
<html>
    <head>
        <title>Home work</title>
    </head>
    <body>
        <?php
        $developer = new Developer('Roman Orlovsky', 1, 120, 'portfolio', 'php');
        $developer->giveBonus(10);
        $developer->displayInfo();

        $manager = new Manager('Sergiy Bevz', 1, 200, 3);
        $manager->giveBonus(20);
        $manager->displayInfo();
        ?>
    </body>
</html>