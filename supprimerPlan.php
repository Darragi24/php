<?php
require 'connection.php';

if (isset($_POST['campingId'])) {
    $campingId = $_POST['campingId'];

    // Check if the camping ID exists in the database
    $sql = "SELECT * FROM plan_camping WHERE campingId = '$campingId'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Delete the plan
        $sql = "DELETE FROM plan_camping WHERE campingId = '$campingId'";
        $result = mysqli_query($mysqli, $sql);

        if ($result) {
            echo "Plan deleted successfully!";
        } else {
            echo "Error deleting plan: " . mysqli_error($mysqli);
        }
    } else {
        echo "Camping ID not found in the database.";
    }
}

$mysqli->close();
?>