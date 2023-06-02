<?php

session_start();

require_once 'database_setup.php';
require_once 'classes/Warrior.php';
require_once 'classes/Mage.php';

if (!isset($_SESSION['characters_id'])) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT * FROM characters WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['characters_id']]);
$charactersData = $stmt->fetch();

if (!$charactersData) {
    die("Votre personnage n'a pas été trouvé.");
}

if ($charactersData['type'] == 'warrior') {
    $character = new Warrior($charactersData['name']);
} else if ($charactersData['type'] == 'mage') {
    $character = new Mage($charactersData['name']);
    if ($charactersData['sleep_until'] !== null) {
        $sleepUntilDateTime = new DateTime($charactersData['sleep_until']);
        $character->setSleepUntil($sleepUntilDateTime);
    }
} else {
    die("La classe de votre personnage n'est pas valide");
}

$character->setLife($charactersData['life']);
$character->setAttack($charactersData['attack']);
$character->setDefense($charactersData['defense']);

$enemy = new Warrior('Lich King');
while ($character->getLife() > 0 && $enemy->getLife() > 0) {
    if (!$character->isSleeping()) {
        echo $character->getName() . " attaque " . $enemy->getName() . "<br>";
        $enemy->setLife($enemy->getLife() - $character->getAttack());
        echo $enemy->getName() . " a maintenant " . $enemy->getLife() . " points de vie<br>";
    } else {
        echo $character->getName() . " est endormi et ne peut pas attaquer<br>";
    }

    if ($enemy->getLife() > 0 && !$enemy->isSleeping()) {
        echo $enemy->getName() . " attaque " . $character->getName() . "<br>";
        $character->setLife($character->getLife() - $enemy->getAttack());
        echo $character->getName() . " a maintenant " . $character->getLife() . " points de vie<br>";
    }

    if ($character instanceof Mage && !$enemy->isSleeping()) {
        if ($character->sleep($enemy)) {
            echo $character->getName() . " a endormi " . $enemy->getName() . "<br>";
        } else {
            echo $character->getName() . " a essayé d'endormir " . $enemy->getName() . " mais a échoué<br>";
        }
    }
}

if ($character->getLife() > 0) {
    echo "Vous avez gagné, ggwp !";
} else {
    echo "Vous avez perdu (la honte).";
}
