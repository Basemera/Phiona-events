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

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
</head>

<body>
    

    <div class="jumbotron">
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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">


                    <div class="navbar-nav">
                        <a href="index.php">View all events</a><br>
                    </div>
            </nav>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>