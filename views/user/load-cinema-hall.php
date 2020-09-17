<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . "/App/Controllers/MovieController.php";

use App\Controllers\MovieController;

$movieController = new MovieController();
$result = $movieController->getReservedPlaces();

echo json_encode($result);

