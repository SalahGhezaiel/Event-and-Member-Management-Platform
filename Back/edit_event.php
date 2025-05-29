<?php 
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $query = "UPDATE events SET name='$name', date='$date', location='$location', description='$description' WHERE id=$id";
    mysqli_query($c, $query);

    header("Location: dashboard.php");
    exit();
}

$query = "SELECT * FROM events WHERE id=$id";
$result = mysqli_query($c, $query);
$event = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="icon" href="../Front/images/icon.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right,rgb(122, 255, 92),rgb(122, 255, 92));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input,
        textarea {
            margin-bottom: 15px;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: white;
        }

        input:focus,
        textarea:focus {
            border-color:rgb(122, 255, 92);
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 12px;
            background-color:rgb(122, 255, 92);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:rgb(122, 255, 92);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Event</h2>
        <form method="POST" action="">
            <input type="text" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
            <input type="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
            <input type="text" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
            <textarea name="description" placeholder="Description"><?php echo htmlspecialchars($event['description']); ?></textarea>
            <button type="submit">Update Event</button>
        </form>
    </div>
</body>
</html>
