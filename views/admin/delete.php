<?php
include_once '../../App/Controllers/Admin/MovieController.php';
use App\Controllers\Admin\MovieController;

if(isset($_POST["id"])) {
    $id = $_POST['id'];
    $movieController = new MovieController();
    $status = $movieController->delete($id);
    echo $status;
}
