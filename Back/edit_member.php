<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $query = "UPDATE members SET name='$name', email='$email', phone='$phone', role='$role' WHERE id=$id";
    mysqli_query($c, $query);

    header("Location: dashboard.php");
    exit();
}

$query = "SELECT * FROM members WHERE id=$id";
$result = mysqli_query($c, $query);
$member = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <link rel="icon" href="../Front/images/icon.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #6dd5ed, #2193b0);
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
        select {
            margin-bottom: 15px;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: white;
        }

        input:focus,
        select:focus {
            border-color: #2193b0;
            outline: none;
        }

        button {
            padding: 12px;
            background-color: #2193b0;
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #176e86;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Member</h2>
        <form method="POST" action="">
            <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($member['phone']); ?>">

            <select name="role" required>
                <option value="" disabled>Select Role</option>
                <?php
                $roles = [
                    "member",
                    "ambassador",
                    "president",
                    "head of communication",
                    "head of marketing",
                    "head of management",
                    "HR"
                ];
                foreach ($roles as $role) {
                    $selected = ($member['role'] === $role) ? 'selected' : '';
                    echo "<option value=\"$role\" $selected>" . ucfirst($role) . "</option>";
                }
                ?>
            </select>

            <button type="submit">Update Member</button>
        </form>
    </div>
</body>
</html>
