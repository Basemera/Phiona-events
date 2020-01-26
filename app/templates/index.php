<?php
require "../models/event.php";
?>
<body>
    <?php require "app.php"; ?>
    <div class="jumbotron">
        <?php
        $s = new Event();
        $result = $s->viewEvents();
        foreach ($result as $row) :
        ?>
            <div class="list-group">
                <a href="view.php?id=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action">
                    <?php echo $row['event_name']; ?> <br />
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>