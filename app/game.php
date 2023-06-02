<?php

require_once 'database.php';
require_once 'classes/Guerrier.php';
require_once 'classes/Mage.php';

$sql = "SELECT * FROM characters WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['characters_id']]);
$charactersData = $stmt->fetch();

if ($charactersData['type'] == 'warrior') {
    $character = new Warrior($charactersData['name']);
} else if ($charactersData['type'] == 'mage') {
    $character = new Mage($charactersData['name']);
} else {
    die("La classe de votre personnage n'est pas valide");
}

$character->setLife($characterData['life']);
$character->setAttack($characterData['attack']);
$character->setDefense($charactersData['defense']);

$enemy = new Warrior('Enemy');
while ($character->getLife() > 0 && $enemy->getLife() > 0) {
    echo $character->getName() . " attaque " . $enemy->getName() . "<br>";
    $enemy->setLife($enemy->getLife() - $character->getAttack());
    echo $enemy->getName() . " a maintenant " . $enemy->getLife() . " points de vie<br>";
    if ($enemy->getLife() > 0) {
        echo $enemy->getName() . " attaque " . $character->getName() . "<br>";
        $character->setLife($character->getLife() - $enemy->getAttack());
        echo $character->getName() . " a maintenant " . $character->getLife() . " points de vie<br>";
    }
}

if ($character->getLife() > 0) {
    echo "Vous avez gagné !";
} else {
    echo "Vous avez perdu.";
}