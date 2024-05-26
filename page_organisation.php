<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard - Camping Platform</title>
    <link rel="stylesheet" href="page_organisateur.css">
</head>

<body>
    <h1>Bienvenue!</h1>

    <!-- Navigation menu -->
    <nav>
        <ul>
            <li><a href="#view-plans">voir les Plans</a></li>
            <li><a href="#create-plan">ajouter Plan</a></li>
            <li><a href="#update-plan">metter a jour Plan</a></li>
            <li><a href="#delete-plan">suppimer Plan</a></li>
            <li><a href="#reservations">Reservations</a></li>
        </ul>
    </nav>

    <!-- Main content area -->
    <main>
        <!-- View Plans section -->
        <section id="view-plans">
            <h2>Voir Plans</h2>
            <table id="plans-table">
                <thead>
                    <tr>
                        <th>Camping ID</th>
                        <th>Date</th>
                        <th>heure</th>
                        <th>Capacite</th>
                        <th>Prix</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'connection.php';

                    // Fetch the plans from the database
                    $sql = "SELECT * FROM plan_camping";
                    $result = mysqli_query($mysqli, $sql);

                    // Display each plan in a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['campingId']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['heure']; ?></td>
                            <td><?php echo $row['capacite']; ?></td>
                            <td><?php echo $row['prix']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Create New Plan section -->
        <section id="create-plan">
            <h2>Creer Plan</h2>
            <form action="createPlan.php" method="post">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br>

                <label for="heure">Heure:</label>
                <input type="time" id="heure" name="heure" required><br>

                <label for="capacite">Capacité:</label>
                <input type="number" id="capacite" name="capacite" min="1" max="100" required><br>

                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" min="1" max="1000" required><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

                <input type="submit" value="Create Plan">
            </form>
        </section>

        <!-- Update Plan section -->
        <section id="update-plan" >
            <h2>mettre a jour Plan</h2>
            <form id="update-plan-form" action="updatePlan.php" method="POST">
                <input type="number" id="update-campingId" name="campingId" value="">
                <label for="update-date">Date:</label>
                <input type="date" id="update-date" name="date" required><br>

                <label for="update-heure">Heure:</label>
                <input type="time" id="update-heure" name="heure" required><br>

                <label for="update-capacite">Capacité:</label>
                <input type="number" id="update-capacite" name="capacite" min="1" max="100" required><br>

                <label for="update-prix">Prix:</label>
                <input type="number" id="update-prix" name="prix" min="1" max="1000" required><br>

                <label for="update-description">Description:</label>
                <textarea id="update-description" name="description" rows="4" cols="50" required></textarea><br>

                <button type="submit">Modifier Plan</button>
            </form>
            
        </section>

        <!-- Delete Plan section -->
        <section id="delete-plan">
            <h2>supprimer Plan</h2>
            <form id="delete-plan-form" method="post" action="supprimerPlan.php">
                <label for="delete-campingId"></label>
                <input type="number" id="delete-campingId" name="campingId" value="">
                <button type="submit">Supprimer Plan</button>
            </form>
        </section>

        <!-- Reservations section -->
        <section id="reservations">
        <?php
        // Get the reservations from the database
        $sql = "SELECT * FROM reservations ";
        $result = $mysqli->query($sql);

        // Display the reservations table
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Camping</th>
        <th>Personne</th>
        <th>Number of Places</th>
        <th>Reservation Date</th>
        <th>Reservation Time</th>
        <th>Status</th>
        <th>Actions</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['camping_id'] . "</td>";
        echo "<td>" . $row['personne_id'] . "</td>";
        echo "<td>" . $row['number_of_places'] . "</td>";
        echo "<td>" . $row['reservation_date'] . "</td>";
        echo "<td>" . $row['heure'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>";
        echo "<form method='post' action='updateStatus.php'>";
        echo "<input type='hidden' name='reservation_id' value='" . $row['id'] . "'>";
        echo "<select name='status'>";
        echo "<option value='en attente' " . ($row['status'] == 'en attente' ? "selected" : "") . ">En attente</option>";
        echo "<option value='confirmé' " . ($row['status'] == 'confirmé' ? "selected" : "") . ">Confirmer</option>";
        echo "<option value='refusé' " . ($row['status'] == 'refusé' ? "selected" : "") . ">Refuser</option>";
        echo "</select>";
        echo "<button type='submit'>Update</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        }

        echo "</table>";

        // Close the database connection
        $mysqli->close();
        ?>
            
        </section>
    </main>

    <!-- Add your JavaScript file here for interactivity -->
</body>

</html>