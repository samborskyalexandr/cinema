<?php
include_once '../../App/Controllers/Admin/MovieController.php';

use App\Controllers\Admin\MovieController;

$id = $_GET['id'];

$movieController = new MovieController();
$result = $movieController->readSingle($id);
$name = $result['name'];
$description = $result['description'];
$src = $result['img_src'];
$reservedPlacesCount = $result['reserved_places_count'];
?>
<html>
<head>
    <?php require_once "../header.php" ?>
</head>

<body>
<?php require_once "nav.php" ?>

<main class="container main p-5">
    <div class="card p-3">
        <div class="row no-gutters">
            <div class="col-md-4 h-100">
                <img src="<?php echo $src ? $src : '../../storage/images/poster-placeholder.png' ?>" class="card-img" alt="">
                <div class="w-100 mt-1">
                    <b>Reserved places: <?php echo $reservedPlacesCount ?></b>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name ?></h5>
                    <p class="card-text"><?php echo $description ?></p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

</html>
