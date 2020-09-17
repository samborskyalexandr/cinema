<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . "/App/Controllers/MovieController.php";

use App\Controllers\MovieController;

if(isset($_POST["movieId"])) {
    $movieController = new MovieController();
    $result = $movieController->reservePlace();

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}