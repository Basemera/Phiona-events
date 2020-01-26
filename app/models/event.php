<?php

// echo "Hwllo world";

require_once('../../config.php');

class Event {
    public $event_name;
    public $description;
    private $db;
    public function __construct() {
    }

    private function connection() {
        $connection = new PDOConfig();
        if($connection === false){
            echo "ERROR: Could not connect. " . mysqli_connect_error();
        }
        return $connection;
    }

    public function addEvent($event_name, $description) {
        $event_name = filter_var($event_name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO events(event_name, description) VALUES (?, ?)";
        try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);

            $statement->bindParam(1, $event_name, PDO::PARAM_STR);
            $statement->bindParam(2, $description, PDO::PARAM_STR);

            $statement->execute();
            $connection = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function viewEvents() {
        $sql =  "SELECT * FROM events";
        try {
            $connection = $this->connection();
            $statement = $connection->query($sql);
            $result = $statement->fetchAll();
            $connection = null;
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function viewEvent($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $sql = "SELECT * FROM events WHERE id = :id";

        try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $connection = null;

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editEvent($id, $event_name, $description) {
        $event_name = filter_var($event_name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $sql = "UPDATE events set event_name = ?, description = ? WHERE id = ?";
        try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $event_name, PDO::PARAM_STR);
            $statement->bindParam(2, $description, PDO::PARAM_STR);
            $statement->bindParam(3, $id, PDO::PARAM_INT);
            $statement->execute();
            $connection = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteEvent($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $sql = "DELETE FROM events WHERE id = ?";
        try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $connection = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

// $s = new Event();
// $s->addEvent('Burning man', 'funtime');
// $s->viewEvents();
// var_dump($s);

?>