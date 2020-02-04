<?php require "../models/event.php";
require "app.php"; ?>

<body>
    <?php
    if (isset($_GET['id'])) {
        $event = new Event();
        $result = $event->viewEvent($_GET['id']);
    } else {
        echo "Something went wrong!";
        exit;
    } ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Showing details for <?php echo $result['event_name']; ?></h5>
            <div class="jumbotron text-center">
                <h6 class="card-subtitle mb-2 text-muted">
                    <strong>Event:</strong> <?php echo $result['event_name']; ?><br>
                </h6>
                <p class="card-text">
                    <strong>Description:</strong> <?php echo $result['description']; ?><br>
                </p>
                <button class="card-link btn btn-primary" onclick="window.location.href = 'edit.php?id=<?php echo $result['id']; ?>'">Edit</button>
                <!-- Button trigger modal -->
                <button type="button" class="card-link btn btn-primary" data-toggle="modal" data-target="#deleteEvent">
                    Delete
                </button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="deleteEventTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventTitle">Delete event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the event <?php echo $result['event_name']; ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button onclick="window.location.href = 'delete.php?id=<?php echo $result['id']; ?>'" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</body>