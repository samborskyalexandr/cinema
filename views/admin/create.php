<?php
use App\Controllers\Admin\MovieController;
?>
<html>
<head>
    <?php require_once "../header.php" ?>
</head>

<body>
<?php require_once "nav.php" ?>

<main class="container main pt-5 mb-5">
    <div class="col-md-12">
        <?php
        $today = date("Y-m-d");
        if (isset($_POST["add"])) {
            include_once '../../App/Controllers/Admin/MovieController.php';
            $movieController = new MovieController();
            $result = $movieController->add($_POST);

            $name = $result['name'];
            $description = $result['description'];
            $src = $result['img_src'];

            echo '<div class="alert alert-success w-100" role="alert">Movie added successfully</div>';
        }
        ?>
        <div class="row">
            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo $_POST['name']?>" placeholder="Enter movie's name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Enter movie's description" required><?php echo $_POST['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date of sessions start</label>
                        <input id="sessions_start" type="date" name="sessions_start" min="<?php echo $today ?>"
                               max="" class="form-control" value="<?php echo $_POST['sessions_start']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Date of sessions end</label>
                        <input id="sessions_end" type="date" name="sessions_end" min="<?php echo $today ?>"
                               max="" class="form-control" value="<?php echo $_POST['sessions_end']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="poster">Poster</label>
                        <input name="poster" type="file" class="form-control-file" id="poster">
                        <small id="posterHelp" class="form-text text-muted">*.jpg, *.png</small>
                    </div>
                    <button id="add-btn" name="add" type="submit" class="btn btn-primary">Add</button>
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
