<?php
    require_once('../../config.php');

    class DatabaseTranscations extends PDOStatement {
        private $connection;

        public function __construct()
        {
        }

        private function connection() {
            $connection = new PDOConfig();
            if($connection === false){
                echo "ERROR: Could not connect. " . mysqli_connect_error();
            }
            return $connection;
        }

        public function insert($event_name, $description) {
            $sql = "INSERT INTO events(event_name, description) VALUES (?, ?)";
        try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);

            $statement->bindParam(1, $event_name, PDO::PARAM_STR);
            $statement->bindParam(2, $description, PDO::PARAM_STR);

            $statement->execute();
            $connection = null;
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        }

        public function select($id = null) {
            if (isset($id)) {
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
                return false;
            }
            } else {
                $sql =  "SELECT * FROM events";
                try {
                    $connection = $this->connection();
                    $statement = $connection->query($sql);
                    $result = $statement->fetchAll();
                    $connection = null;
                    return $result;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
            }
        }

        public function update($event_name, $description, $id) {
            $sql = "UPDATE events set event_name = ?, description = ? WHERE id = ?";
            try {
                $connection = $this->connection();
                $statement = $connection->prepare($sql);
                $statement->bindParam(1, $event_name, PDO::PARAM_STR);
                $statement->bindParam(2, $description, PDO::PARAM_STR);
                $statement->bindParam(3, $id, PDO::PARAM_INT);
                $statement->execute();
                $connection = null;
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
        }
        }

        public function delete($id) {
            $sql = "DELETE FROM events WHERE id = ?";
            try {
                $connection = $this->connection();
                $statement = $connection->prepare($sql);
                $statement->bindParam(1, $id, PDO::PARAM_INT);
                $statement->execute();
                $connection = null;
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
