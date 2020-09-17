<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . "/App/Controllers/MovieController.php";

use App\Controllers\MovieController;

$id = $_GET['id'];

$movieController = new MovieController();
$result = $movieController->readSingle($id);
$name = $result['name'];
$description = $result['description'];
$src = $result['img_src'];
$sessionsEnd = $result['sessions_end'];
$today = date("Y-m-d");

?>
<html>
<head>
    <?php require_once $path . "/views/header.php" ?>
</head>

<body>
<?php require_once $path . "/views/user/nav.php" ?>
<?php require_once "reserve-place-form-modal.php" ?>

<main class="container main pt-5 mb-5 pb-5">
    <div class="card">
        <div class="row no-gutters p-3">
            <div class="col-md-4 h-100">
                <div class="w-100">
                    <img src="<?php echo $src ? $src : '../../storage/images/poster-placeholder.png' ?>" class="card-img movie-block-poster" alt="">
                </div>
                <div class="w-100 pt-2">
                    <h4>Select Session</h4>
                </div>
                <div class="form-group">
                    <label>Date of sessions start</label>
                    <input id="sessions_date" data-movie-id="<?php echo $id ?>" type="date" name="sessions_date" max="<?php echo $sessionsEnd ?>"
                           min="<?php echo $today ?>" class="form-control" value="">
                </div>
                <div class="d-flex row justify-content-around p-2">
                    <div class="session-time" data-time="10">10-00</div>
                    <div class="session-time" data-time="12">12-00</div>
                    <div class="session-time" data-time="14">14-00</div>
                    <div class="session-time" data-time="16">16-00</div>
                    <div class="session-time" data-time="18">18-00</div>
                    <div class="session-time" data-time="20">20-00</div>
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
    <div class="card mt-2">
        <div class="card-header">
            The layout of the seats in the cinema hall. Please select date/time of session and choose free place.
        </div>
        <?php require_once "cinema-places.php" ?>
    </div>
</main>
</body>

</html>
