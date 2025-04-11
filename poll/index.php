<?php
$host = 'localhost';
$db   = 'poll_entries';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $keuze = $_POST['keuze'];
    $conn->query("INSERT INTO poll_entries (naam, keuze) VALUES ('$naam', '$keuze')");
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM poll_entries ORDER BY timestamp DESC");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Poll - Favoriete Taal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Wat is je favoriete programmeertaal?</h1>
    <form method="POST">
        <input type="text" name="naam" placeholder="Jouw naam" required>
        <select name="keuze" required>
            <option value="">-- Kies een taal --</option>
            <option value="PHP">PHP</option>
            <option value="Python">Python</option>
            <option value="JavaScript">JavaScript</option>
            <option value="Java">Java</option>
        </select>
        <button type="submit" name="submit">Stem</button>
    </form>

    <div class="message-container">
        <h2>Resultaten</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="message">
                <h3><?= htmlspecialchars($row['naam']) ?></h3>
                <p>Stem: <?= htmlspecialchars($row['keuze']) ?></p>
                <footer><?= $row['timestamp'] ?></footer>
                <a href="edit.php?id=<?= $row['id'] ?>">✏️ Bewerken</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">🗑️ Verwijder</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>