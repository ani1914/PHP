<?php
require 'config.php';
$sql = "SELECT * FROM players";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Играчи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="players.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Левски София</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="news.php">Новини</a>
                </li>
                <li class="nav-item">
                    <form action="logout.php" method="post" class="form-inline">
                        <button type="submit" class="btn btn-danger">Изход</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Играчи</h1>
        <div class="card-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<img src="logo11.jpg" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<div class="card-content">';
                    echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
                    echo '<p>Номер: ' . htmlspecialchars($row['number']) . '</p>';
                    echo '<p>Позиция: ' . htmlspecialchars($row['position']) . '</p>';
                    echo '<p>Рожден ден: ' . htmlspecialchars($row['birthdate']) . '</p>';
                    echo '<p>Голове: ' . htmlspecialchars($row['goals']) . '</p>';
                    echo '<p>Асистенции: ' . htmlspecialchars($row['assists']) . '</p>';
                    echo '<p>Жълти карти: ' . htmlspecialchars($row['yellow_cards']) . '</p>';
                    echo '<p>Червени карти: ' . htmlspecialchars($row['red_cards']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Няма налични играчи в момента.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>