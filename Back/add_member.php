<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $query = "INSERT INTO members (name, email, phone, role) VALUES ('$name', '$email', '$phone', '$role')";
    mysqli_query($c, $query);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Member</title>
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
            appearance: none;
        }

        input:focus,
        select:focus {
            border-color: #2193b0;
            outline: none;
        }

        select {
            background-image: url("data:image/svg+xml;utf8,<svg fill='%232193b0' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
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
        <h2>Add New Member</h2>
        <form method="POST" action="" onsubmit="addPrefix()">
            <input type="text" name="name" placeholder="Name" pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces." required>
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Member">Member</option>
                <option value="Ambassador">Ambassador</option>
                <option value="President">President</option>
                <option value="Head of communication">Head of Communication</option>
                <option value="Head of marketing">Head of Marketing</option>
                <option value="Head of management">Head of Management</option>
                <option value="HR">HR</option>
            </select>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" id="phone" name="phone" placeholder="Phone (e.g., 12345678)" pattern="\d{8}" title="Phone number must have exactly 8 digits." required>
            <button type="submit">Add Member</button>
        </form>
    </div>

    <script>
        function addPrefix() {
            const phoneInput = document.getElementById('phone');
            const phoneValue = phoneInput.value.trim();

            // Check if the phone number is exactly 8 digits
            if (phoneValue.length === 8 && /^\d{8}$/.test(phoneValue)) {
                phoneInput.value = `+216 ${phoneValue}`;
            } else {
                alert("Phone number must have exactly 8 digits.");
                event.preventDefault(); // Prevent form submission if validation fails
            }
        }
    </script>
</body>
</html>
