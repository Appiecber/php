<?php
$host = 'localhost';
$db   = 'poll_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM poll_entries WHERE id=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $naam = $_POST['naam'];
    $keuze = $_POST['keuze'];
    $conn->query("UPDATE poll_entries SET naam='$naam', keuze='$keuze' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bewerk stem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Bewerk jouw stem</h1>
    <form method="POST">
        <input type="text" name="naam" value="<?= htmlspecialchars($row['naam']) ?>" required>
        <select name="keuze" required>
            <option value="PHP" <?= $row['keuze'] == 'PHP' ? 'selected' : '' ?>>PHP</option>
            <option value="Python" <?= $row['keuze'] == 'Python' ? 'selected' : '' ?>>Python</option>
            <option value="JavaScript" <?= $row['keuze'] == 'JavaScript' ? 'selected' : '' ?>>JavaScript</option>
            <option value="Java" <?= $row['keuze'] == 'Java' ? 'selected' : '' ?>>Java</option>
        </select>
        <button type="submit" name="update">Bijwerken</button>
    </form>
</div>
</body>
</html>