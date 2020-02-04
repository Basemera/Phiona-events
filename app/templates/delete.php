<?php
require "../models/event.php";
require "app.php";

if (isset($_GET['id'])) {
    $event = new Event();
    $result = $event->deleteEvent($_GET['id']);
    $_SESSION["delete"] = ["type" => "danger", "message" => "Event successfully deleted"];
    header("Location:" . "index.php");
} else {
    echo "Something went wrong!";
    exit;
}
