<?php
$c = mysqli_connect("localhost", "root", "", "student_management",3307);
if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}
?>