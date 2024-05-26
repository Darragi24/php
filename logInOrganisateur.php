<?php
// Include the connection.php file
require 'connection.php';

// Process the login form
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve the organizer's information
    $query = "SELECT * FROM organisateur WHERE login = ? AND motDePasse = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the organizer exists
    if ($result->num_rows > 0) {
        // Login successful, redirect to organizer's dashboard
        header("Location: page_organisation.php");
        exit;
    } else {
        // Login failed, display error message
        echo"<p>Invalid username or password</p>";
    }
}

// Close the connection
$mysqli->close();
?>