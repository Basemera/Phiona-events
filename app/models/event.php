<?php

require '../../database.php';

class Event {
    public $event_name;
    public $description;
    private $db;
    public function __construct() {
    }

    public function addEvent($event_name, $description) {
        $event_name = filter_var($event_name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $db = new DatabaseTranscations();
        $inserted = $db->insert($event_name, $description);
        if ($inserted) {
            return "Successfully inserted";
        } else {
            return "Something went wrong insertion didnot happen";
        }
    }

    public function viewEvents() {
        $db = new DatabaseTranscations();
        $result = $db->select();
        if ($result) {
            return $result;
        } else {
            return "No results returned";
        }
    }

    public function viewEvent($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db = new DatabaseTranscations();
        $result = $db->select($id);
        if ($result) {
            return $result;
        } else {
            return "No results returned";
        }
    }

    public function editEvent($id, $event_name, $description) {
        $event_name = filter_var($event_name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db = new DatabaseTranscations();
        $result = $db->update($event_name, $description, $id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $db = new DatabaseTranscations();
        $result = $db->delete($id);
        if ($result) {
            return "deleted";
        } else {
            return "Something happened event not deleted";
        }
    }
}
?>