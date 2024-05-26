<?php
// submit-plan.php
require_once 'connection.php';

// Get form data
$date = $_POST['date'];
$heure = $_POST['heure'];
$capacite = $_POST['capacite'];
$prix = $_POST['prix'];
$description = $_POST['description'];

// Insert data into database
$sql = "INSERT INTO plan_camping (date, heure, capacite, prix, description) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssss", $date, $heure, $capacite, $prix, $description);
$stmt->execute();

// Check if data was inserted successfully
if ($stmt->affected_rows > 0) {
    echo "Plan added successfully!";
} else {
    echo "Error adding plan: " . $mysqli->error;
}

// Close statement and connection
$stmt->close();
$sql = "SELECT * FROM plan_camping";
$result = mysqli_query($mysqli, $sql);

// Display each plan in a table row
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['campingId'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['heure'] . "</td>";
    echo "<td>" . $row['capacite'] . "</td>";
    echo "<td>" . $row['prix'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "</tr>";
}

$mysqli->close();
?>