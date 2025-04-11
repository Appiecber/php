<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gastenboek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM berichten ORDER BY datum DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastenboek</title>
   
</head>
<body>
    <h1>Welkom in het gastenboek!</h1>

    <h2>Nieuw bericht toevoegen</h2>
    <form method="POST" action="create.php">
        <label for="naam">Naam:</label>
        <input type="text" name="naam" required><br><br>
        <label for="bericht">Bericht:</label>
        <textarea name="bericht" required></textarea><br><br>
        <button type="submit">Bericht toevoegen</button>
    </form>

    <h2>Berichten:</h2>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?php echo $row['naam']; ?></strong> (<?php echo $row['datum']; ?>):<br>
                <?php echo nl2br($row['bericht']); ?>
                <br><a href="delete.php?id=<?php echo $row['id']; ?>">Verwijder</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php $conn->close(); ?>
</body>
</html>
