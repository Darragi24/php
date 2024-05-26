<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $campingId = $_POST['campingId'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $capacite = $_POST['capacite'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    echo $_POST['date'];
    // Include the database connection
    require "connection.php";
    print_r($mysqli->connect_error);
    // Construct the update query
    $query = "
        UPDATE plan_camping 
        SET 
            date='$date', 
            heure='$heure', 
            capacite=$capacite, 
            prix=$prix, 
            description='$description' 
        WHERE 
            campingId=$campingId
    ";

    // Execute the query
    $result = $mysqli->query($query) or die('Error: ' . $query . ' ' . $mysqli->error);

    // Display the result of the modification
    if ($result) {
        echo "<br>Modification made successfully";
    } else {
        echo "<br>Error updating plan";
    }
}
?>