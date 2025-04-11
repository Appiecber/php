<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gastenboek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $bericht = $_POST['bericht'];

    $sql = "INSERT INTO berichten (naam, bericht) VALUES ('$naam', '$bericht')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
