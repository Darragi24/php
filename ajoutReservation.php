<?php
session_start(); // Start the session
require 'connection.php';

// Get the form data
$camping_id = isset($_GET['camping_id']) ? (int)$_GET['camping_id'] : 0;
$personne_id = isset($_SESSION['personne_id']) ? (int)$_SESSION['personne_id'] : 0;
$number_of_places = $_GET['number_of_people'];
$reservation_date = date("Y-m-d"); // Get the current date
$reservation_time = date("H:i:s"); // Get the current time

// Debugging statement: print out the values of the variables
echo "Camping ID: $camping_id, Personne ID: $personne_id, Number of Places: $number_of_places, Reservation Date: $reservation_date, Reservation Time: $reservation_time<br>";

// Insert the reservation into the database
$sql = "INSERT INTO reservations (camping_id, personne_id, number_of_places, reservation_date, heure, status) 
        VALUES (?, ?, ?, ?, ?, 'en attente')";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiiss", $camping_id, $personne_id, $number_of_places, $reservation_date, $reservation_time);
// Debugging statement: print out the $stmt object to check if it is prepared correctly
print_r($stmt);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
} else {
    echo "Reservation inserted successfully!";
}

// Close the database connection
$mysqli->close();

// Redirect back to the user page
header("Location: page_user.php");
exit;
?>