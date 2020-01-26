<?php require "app.php";
require "../models/event.php";

if (isset($_GET['id'])) {
    $event = new Event();
    $result = $event->viewEvent($_GET['id']);
    $_SESSION['id'] = $_GET['id'];
} else {
    echo "Something went wrong!";
    exit;
}

if (isset($_POST['submit'])) {
    $event_name = $_POST['eventName'];
    $description = $_POST['description'];
    $update = new Event();
    $update->editEvent($_SESSION['id'], $event_name, $description);
    $_SESSION["flash"] = ["type" => "success", "message" => "Event successfully updated"];
    header("Location:" . "index.php");
}
?>

<h2>Update an event </h2>
<form method="post">
    <div class="form-group">
        <label for="eventName">Event name</label>
        <input name="eventName" type="text" class="form-control" value=<?php echo $result['event_name'] ?> id="eventName" placeholder="Enter event name">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control" id="description" value=<?php echo $result['description'] ?> placeholder="Enter a description for your event">
    </div>
    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
</form>