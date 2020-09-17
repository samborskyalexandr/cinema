<?php if (!$result) { ?>
    <div class="card mb-3 shadow p-3 bg-white rounded">
        <h4>There are no movies yet</h4>
    </div>
<?php } else {
    foreach ($result as $movie) { ?>
    <div id="<?php echo $movie['id'] ?>" class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-2 d-flex align-items-center">
                <img src="<?php echo $movie['img_src'] ? $movie['img_src'] : '../../storage/images/poster-placeholder.png' ?>" class="card-img movie-block-poster movie-block-poster" alt="poster">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $movie['name'] ?></h5>
                    <p class="card-text"><?php echo mb_strimwidth($movie['description'], 0, 100, "..."); ?></p>
                    <p class="card-text"><small class="text-muted">Publication date: <?php echo date('m/d/Y', strtotime($movie['created_at'])); ?></small></p>
                    <p class="card-text"><small class="text-muted">Sessions start date: <?php echo date('m/d/Y', strtotime($movie['sessions_start'])); ?></small></p>
                    <p class="card-text"><small class="text-muted">Sessions end date: <?php echo date('m/d/Y', strtotime($movie['sessions_end'])); ?></small></p>
                </div>
            </div>
            <div class="col-md-1 row justify-content-center align-self-center">
                <a href="movie-overview.php?id=<?php echo $movie['id'] ?>" class="btn btn-secondary btn-block" role="button">View</a>
                <a href="edit.php?id=<?php echo $movie['id'] ?>" class="btn btn-info btn-block" role="button">Edit</a>
                <a href="javascript:void(0);" id="<?php echo $movie['id'] ?>" class="btn btn-danger btn-block btn-delete" role="button">Delete</a>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>
