<?php
session_start();
require_once 'database_setup.php';
require_once 'classes/Warrior.php';
require_once 'classes/Mage.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $characterType = $_POST["characterType"];
    $characterName = $_POST["characterName"];

    if ($characterType == "warrior") {
        $character = new Warrior($characterName);
    } else if ($characterType == "mage") {
        $character = new Mage($characterName);
    } else {
        die("La classe de votre personnage n'est pas valide");
    }

    $sql = "INSERT INTO characters (name, life, attack, defense, type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$character->getName(), $character->getLife(), $character->getAttack(), $character->getDefense(), $characterType]);
    $_SESSION['characters_id'] = $pdo->lastInsertId();

    header("Location: game.php");
    exit;
}
?>

<form method="POST">
    <label for="characterType">Type de personnage:</label>
    <select id="characterType" name="characterType">
        <option value="warrior">Guerrier</option>
        <option value="mage">Mage</option>
    </select>

    <label for="chracterName">Nom du personnage :</label>
    <input type="text" id="characterName" name="characterName" required>

    <button type="submit">Créer</button>
</form>