<?php
include_once 'App/Controllers/MovieController.php';

use App\Controllers\MovieController;

$movieController = new MovieController();
$result = $movieController->readData();
$top5 = $movieController->getTopMovies();

?>


<?php if ($top5) { ?>
<div class="col-md-12">
    <div class="row d-flex justify-content-center">
        <h3>Most Popular</h3>
    </div>
    <div class="row">
        <div class="slider w-100">
            <div id="top5" class="carousel slide shadow rounded" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($top5 as $key => $item) { ?>
                        <div class="carousel-item <?php echo $key == 0 ? 'active' : '' ?>">
                            <img src="<?php echo $item['img_src'] ? $item['img_src'] : '../../storage/images/poster-placeholder.png' ?>" alt="<?php echo $item['name'] ?>">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><?php echo $item['name'] ?></h1>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#top5" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#top5" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php if (!$result) { ?>
    <div class="card mb-3 shadow p-3 bg-white rounded">
        <h4>There are no movies yet</h4>
    </div>
<?php } else {
    foreach ($result as $movie) { ?>
        <div class="card mb-3 shadow p-3 bg-white rounded">
            <div class="row no-gutters movie-block">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="<?php echo $movie['img_src'] ? $movie['img_src'] : '../../storage/images/poster-placeholder.png' ?>" class="card-img movie-block-poster" alt="poster">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $movie['name'] ?></h5>
                        <p class="card-text"><?php echo mb_strimwidth($movie['description'], 0, 100, "..."); ?></p>
                        <p class="card-text"><small class="text-muted">Publication date: <?php echo date('m/d/Y', strtotime($movie['created_at'])); ?></small></p>
                    </div>
                </div>
                <div class="col-md-2 justify-content-center align-self-center p-2">
                    <a href="views/user/movie-overview.php?id=<?php echo $movie['id'] ?>" class="btn btn-secondary btn-block" role="button">View</a>
                </div>
            </div>
        </div>
    <?php }
} ?>
