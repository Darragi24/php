<?php
session_start(); // Start the session if you need to access session variables
require 'connection.php';

// Get the reservation ID from the form data
$reservation_id = $_POST['reservation-id'];

// Prepare the update query
$stmt = $mysqli->prepare("UPDATE reservations SET status = 'annulé' WHERE id = ?");
$stmt->bind_param("i", $reservation_id);
$stmt->execute();

// Check if the query was successful
if ($stmt->affected_rows > 0) {
    header('Location: page_user.php');
    exit;
} else {
    echo "Error cancelling reservation: " . $stmt->error;
    exit;
}
?>