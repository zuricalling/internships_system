<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "", "internships");
$conn->set_charset("utf8");
if ($conn->connect_error) die("Database Connection Failed!");
?>