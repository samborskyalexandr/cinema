<?php
include_once '../../App/Controllers/Admin/MovieController.php';

use App\Controllers\Admin\MovieController;

$movieController = new MovieController();
$result = $movieController->readData();
?>
<html>
<head>
    <?php require_once "../header.php" ?>
</head>

<body>
    <?php
        include_once '..\..\App\DB\Connection.php';
        require_once "nav.php"
    ?>

    <main class="container main pt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <?php require_once "list.php" ?>
            </div>
        </div>
    </main>
</body>

</html>




