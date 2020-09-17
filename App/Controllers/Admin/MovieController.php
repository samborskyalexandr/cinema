<?php

namespace App\Controllers\Admin;

include_once '../../App/DB/Connection.php';

use App\DB\Connection;

class MovieController
{
    public function readData() {
        try {

            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT * FROM movies ORDER BY id DESC";

            $resource = $conn->query($sql);

            $result = $resource->fetchAll(\PDO::FETCH_ASSOC);

            $dao->closeConnection();
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (!empty($result)) {
            return $result;
        }
    }

    public function readSingle($id) {
        try {

            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT * FROM `movies` WHERE id=" . $id;
            $resource = $conn->query($sql);
            $result = $resource->fetchAll(\PDO::FETCH_ASSOC)[0];

            $sql = "SELECT COUNT(*) as count FROM reserved_places WHERE movie_id=" . $id;
            $resource = $conn->query($sql);
            $reservedPlacesCount = $resource->fetchAll(\PDO::FETCH_ASSOC)[0]['count'];

            $sessionsStart = date("Y-m-d", strtotime($result['sessions_start']));
            $sessionsEnd = date("Y-m-d", strtotime($result['sessions_end']));

            $result['sessions_start'] = $sessionsStart;
            $result['sessions_end'] = $sessionsEnd;
            $result['reserved_places_count'] = $reservedPlacesCount;

            $dao->closeConnection();
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (!empty($result)) {
            return $result;
        }
    }

    public function add() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sessionsStart = $_POST['sessions_start'];
        $sessionsEnd = $_POST['sessions_end'];

        if (!is_dir('../../storage/images')) {
            mkdir('../../storage/images');
        }
        $upload_file = null;
        if (strlen($_FILES['poster']['name']) > 0) {
            $upload_dir = '../../storage/images/';
            $image_name = $_FILES['poster']['name'];
            $upload_file = $upload_dir . $image_name;
            move_uploaded_file($_FILES['poster']['tmp_name'], $upload_file);
        }
        $dao = new Connection();

        $conn = $dao->openConnection();

        $sql = "INSERT INTO movies(name,description,img_src,sessions_start,sessions_end) VALUES('$name','$description','$upload_file','$sessionsStart','$sessionsEnd')";
        $conn->query($sql);
        $id = $conn->lastInsertId();
        $dao->closeConnection();

        return $this->readSingle($id);
    }

    public function edit() {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sessionsStart = $_POST['sessions_start'];
        $sessionsEnd = $_POST['sessions_end'];

        if (!is_dir('../../storage/images')) {
            mkdir('../../storage/images');
        }
        $currentMovie = $this->readSingle($id);
        $upload_file = $currentMovie["img_src"];

        if (strlen($_FILES['poster']['name']) > 0) {
            $upload_dir = '../../storage/images/';
            $image_name = $_FILES['poster']['name'];
            $upload_file = $upload_dir . $image_name;
            move_uploaded_file($_FILES['poster']['tmp_name'], $upload_file);
        }

        $dao = new Connection();

        $conn = $dao->openConnection();

        $sql = "UPDATE movies SET name='$name',description='$description',img_src='$upload_file',sessions_start='$sessionsStart',sessions_end='$sessionsEnd' WHERE id=$id";
        $conn->query($sql);
        $dao->closeConnection();

    }

    public function delete($id) {
        try {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "DELETE FROM `movies` WHERE `movies`.`id` = " . $id;

            $conn->query($sql);
            $dao->closeConnection();
            return 1;
        } catch (\PDOException $e) {
            return 0;
        }

    }

}