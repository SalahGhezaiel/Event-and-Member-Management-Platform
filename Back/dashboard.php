<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

include("config.php");

// Fetch members
$members_query = "SELECT * FROM members";
$members_result = mysqli_query($c, $members_query);

// Fetch events
$events_query = "SELECT * FROM events";
$events_result = mysqli_query($c, $events_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../Front/images/icon.png" type="image/png">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0" style="color: red;">Members & Events</h2>
            <div>
                <a href="add_member.php" class="btn btn-primary me-2">Add Member</a>
                <a href="add_event.php" class="btn btn-success me-2">Add Event</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <h3 class="mb-3">Members</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($member = mysqli_fetch_assoc($members_result)) { ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php echo $member['phone']; ?></td>
                            <td><?php echo $member['role']; ?></td>
                            <td>
                                <a href="edit_member.php?id=<?php echo $member['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="confirm_delete_member.php?id=<?php echo $member['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h3 class="mt-5 mb-3">Events</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($event = mysqli_fetch_assoc($events_result)) { ?>
                        <tr>
                            <td><?php echo $event['id']; ?></td>
                            <td><?php echo $event['name']; ?></td>
                            <td><?php echo $event['date']; ?></td>
                            <td><?php echo $event['location']; ?></td>
                            <td><?php echo $event['description']; ?></td>
                            <td>
                                <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="confirm_delete_event.php?id=<?php echo $event['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>