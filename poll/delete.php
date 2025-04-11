<?php
$host = 'localhost';
$db   = 'poll_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

$id = $_GET['id'];
$conn->query("DELETE FROM poll_entries WHERE id=$id");

header("Location: index.php");