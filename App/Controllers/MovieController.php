<?php

namespace App\Controllers;

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/App/DB/Connection.php';

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
            $movies = [];
            foreach ($result as $movie) {
                $description = strlen($movie['description']) < 100 ? substr($movie['description'], 0,100) : $movie['description'];
                $movie['description'] = $description;
                $movies[] = $movie;
            }
            return $movies;
        }
    }

    public function getTopMovies() {
        try {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT m.id, m.name, m.img_src, COUNT(rp.movie_id) AS total FROM movies m JOIN reserved_places rp ON m.id=rp.movie_id GROUP BY m.id ORDER BY total DESC LIMIT 5";

            $resource = $conn->query($sql);

            $result = $resource->fetchAll(\PDO::FETCH_ASSOC);

            $dao->closeConnection();
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (empty($result)) {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT * FROM movies ORDER BY id DESC LIMIT 5";

            $resource = $conn->query($sql);

            $result = $resource->fetchAll(\PDO::FETCH_ASSOC);

            $dao->closeConnection();
        }

        return $result;
    }

    public function readSingle($id) {
        try {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT * FROM `movies` WHERE id=" . $id;

            $resource = $conn->query($sql);

            $result = $resource->fetchAll(\PDO::FETCH_ASSOC)[0];

            $sessionsStart = date("Y-m-d", strtotime($result['sessions_start']));
            $sessionsEnd = date("Y-m-d", strtotime($result['sessions_end']));

            $result['sessions_start'] = $sessionsStart;
            $result['sessions_end'] = $sessionsEnd;

            $dao->closeConnection();
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (!empty($result)) {
            return $result;
        }
    }

    public function getReservedPlaces () {
        $movieId = $_POST['movie_id'];
        $sessionDate = $_POST['session_date'];
        $sessionTime = $_POST['session_time'];

        try {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "SELECT * FROM `reserved_places` WHERE movie_id=" . $movieId . " AND session_date='" . $sessionDate . "' AND session_time='" . $sessionTime . "'";

            $resource = $conn->query($sql);

            $result = $resource->fetchAll(\PDO::FETCH_ASSOC);

            $dao->closeConnection();
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (!empty($result)) {
            return $result;
        }

        return [];
    }

    public function reservePlace () {

        $movieId = $_POST['movieId'];
        $sessionDate = $_POST['sessionDate'];
        $sessionTime = $_POST['sessionTime'];
        $place = $_POST['place'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        try {
            $dao = new Connection();

            $conn = $dao->openConnection();

            $sql = "INSERT INTO `reserved_places`(movie_id,session_date,session_time,place,customer_phone,customer_email) VALUES('$movieId','$sessionDate','$sessionTime','$place','$phone','$email')";
            $conn->query($sql);

            $dao->closeConnection();
            $result = 1;
        } catch (\PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }

        if (!empty($result)) {
            return $result;
        }
        return null;
    }

}