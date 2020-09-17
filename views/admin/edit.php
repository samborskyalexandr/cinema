<?php
include_once '../../App/Controllers/Admin/MovieController.php';

use App\Controllers\Admin\MovieController;

$id = $_GET['id'];

$movieController = new MovieController();
$result = $movieController->readSingle($id);
$name = $result['name'];
$description = $result['description'];
$src = $result['img_src'];
$sessionsStart = $result['sessions_start'];
$sessionsEnd = $result['sessions_end'];

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
    <div class="col-md-12">
        <?php
        if(isset($_POST["id"])) {
            $movieController->edit($_POST);
            $result = $movieController->readSingle($id);

            $name = $result['name'];
            $description = $result['description'];
            $src = $result['img_src'];
            $sessionsStart = $result['sessions_start'];
            $sessionsEnd = $result['sessions_end'];

            echo '<div class="alert alert-success w-100" role="alert">Movie edited successfully</div>';
        }
        ?>
        <div class="row">
            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" class="w-100">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="5"><?php echo $description ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date of sessions start</label>
                        <input id="sessions_start" type="date" name="sessions_start" max=""
                               min="" class="form-control" value="<?php echo $sessionsStart ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of sessions end</label>
                        <input id="sessions_end" type="date" name="sessions_end" min=""
                               max="" class="form-control" value="<?php echo $sessionsEnd?>">
                    </div>
                    <div class="form-group">
                        <label for="poster">Change poster</label>
                        <input name="poster" type="file" class="form-control-file" id="poster">
                        <small id="posterHelp" class="form-text text-muted">*.jpg, *.png</small>
                    </div>
                    <div class="form-group d-none">
                        <input name="oldSrc" type="text" class="form-control" id="oldSrc" value="<?php echo $src ?>" hidden>
                        <input name="id" type="text" class="form-control" id="id" value="<?php echo $id ?>" hidden>
                    </div>
                    <button name="add-movie" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <img src="<?php echo $src ? $src : '../../storage/images/poster-placeholder.png' ?>" class="card-img movie-block-poster movie-block-poster" alt="poster">
            </div>
        </div>
    </div>
</main>
</body>

</html>
