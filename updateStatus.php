<?php
require 'connection.php';

// Get the reservation ID and new status from the form data
$reservation_id = $_POST['reservation_id'];
$new_status = $_POST['status'];

// Prepare the update query
$stmt = $mysqli->prepare("UPDATE reservations SET status = ? WHERE id = ?");
$stmt->bind_param("si", $new_status, $reservation_id);
$stmt->execute();

// Check if the query was successful
if ($stmt->affected_rows > 0) {
    header('Location: page_organisation.php');
    exit;
} else {
    echo "Error updating reservation status: " . $stmt->error;
    exit;
}
?>