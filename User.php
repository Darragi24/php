<?php
require "connection.php";

$attributes = ['motDePasse', 'login', 'firstname', 'lastname', 'numero', 'email', 'sexe', 'age'];
$values = [];

foreach ($attributes as $attribute) {
    if (isset($_GET[$attribute]) && !empty($_GET[$attribute])) {
        $values[$attribute] = $_GET[$attribute];
    } else {
        echo "No value entered for $attribute<br>";
        exit;
    }
}

$query = "INSERT INTO personne (motDePasse, login, prenom, nom, numero, email, sexe, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param(
        "sssssssi",
        $values['motDePasse'],
        $values['login'],
        $values['firstname'],
        $values['lastname'],
        $values['numero'],
        $values['email'],
        $values['sexe'],
        $values['age']
    );

    if ($stmt->execute()) {
        echo "<br>Insertion made successfully<br><br>";
    } else {
        echo "<br>Error: " . $stmt->error . "<br><br>";
    }

    $stmt->close();
} else {
    echo "<br>Error preparing statement: " . $mysqli->error . "<br><br>";
}

$mysqli->close();
?>