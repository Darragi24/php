<?php
session_start(); // Start the session if you need to access session variables
require 'connection.php';

// Query the camping_plan table with error handling
$sql = "SELECT * FROM plan_camping";
$result = $mysqli->query($sql);

if (!$result) {
    // Handle errors, for example:
    die("Query failed: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camping Plans</title>
    <link rel="stylesheet" href="page_user.css">
</head>
<body>
    <div class="container">
        <h1>Les camping disponibles</h1>
        <table>
            <tr>
                <th>Camping ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Capacite</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['campingId']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['heure']) . "</td>";
                echo "<td>" . htmlspecialchars($row['capacite']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>
                      <form action='ajoutReservation.php' method='get'>
                        <input type='hidden' name='camping_id' value='" . htmlspecialchars($row['campingId']) . "'>
                        <label for='number_of_people'>Nombre de personnes:</label>
                        <input type='number' name='number_of_people' id='number_of_people' min='1' max='" . htmlspecialchars($row['capacite']) . "' required>
                        <button type='submit' class='btn btn-primary'>Reserver</button>
                      </form>
                    </td>";
                echo "</tr>";
            }
            $result->free(); // Free the result set
            ?>
        </table>
        <section id="reservations">
    <h2>Mes Réservations</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Camping ID</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nombre de personnes</th>
            <th>Statut</th>
        </tr>
        <?php
        // Query to retrieve the user's reservations
        $sql = "SELECT r.id, c.campingId, r.reservation_date, r.heure, r.number_of_places, r.status 
                FROM reservations r 
                JOIN plan_camping c ON r.camping_id = c.campingId 
                WHERE r.personne_id = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $_SESSION['personne_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['campingId'] . "</td>";
            echo "<td>" . $row['reservation_date'] . "</td>";
            echo "<td>" . $row['heure'] . "</td>";
            echo "<td>" . $row['number_of_places'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</section>
<section id="cancel-reservation">
    <h2>Annuler réservation</h2>
    <form method="post" action="cancelReservation.php">
        <label for="reservation-id">ID de réservation:</label>
        <input type="text" name="reservation-id" id="reservation-id" required>
        <button type="submit">Annuler</button>
    </form>
</section>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>