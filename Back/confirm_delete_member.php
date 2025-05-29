<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

// Fetch the member's details
$query = "SELECT * FROM members WHERE id=$id";
$result = mysqli_query($c, $query);
$member = mysqli_fetch_assoc($result);

if (!$member) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If confirmed, delete the member
    $delete_query = "DELETE FROM members WHERE id=$id";
    mysqli_query($c, $delete_query);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Delete Member</title>
    <link rel="icon" href="../Front/images/icon.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ee9ca7, #ffdde1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h2 {
            color: #d9534f;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        button, .cancel-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background-color: #d9534f;
            color: white;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c9302c;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this member?</p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($member['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($member['email']); ?></p>

        <form method="POST" action="">
            <div class="button-group">
                <button type="submit">Yes, Delete</button>
                <a href="dashboard.php" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
