<?php
require "../models/event.php";
session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
} else {
    $_SESSION['count']++;
}
if (isset($_POST['submit'])) {
    $event_name = $_POST['eventName'];
    $description = $_POST['description'];
    $insert = new Event();
    $insert->addEvent($event_name, $description);
    $_SESSION["flash"] = ["type" => "success", "message" => "Event successfully created"];
    header("Location:" . "index.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h1 class="navbar-brand">Events</h1>
    <div>
        <div class="navbar-nav">
            <a href="index.php">View all events</a>
        </div>
    </div>
</nav>

<h2>Create an event </h2>
<form method="post">
    <div class="form-group">
        <label for="eventName">Event name</label>
        <input name="eventName" type="text" class="form-control" id="eventName" placeholder="Enter event name">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control" id="description" placeholder="Enter a description for your event">
    </div>
    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
</form>