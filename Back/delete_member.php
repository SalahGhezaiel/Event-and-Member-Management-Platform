<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$query = "DELETE FROM members WHERE id=$id";
mysqli_query($c, $query);

header("Location: dashboard.php");
exit();
?>