<?php
require 'config.php';

// Form to add players
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_player'])) {
    $add_number = $_POST['add_number'];
    $add_position = $_POST['add_position'];
    $add_name = $_POST['add_name'];
    $add_birthdate = $_POST['add_birthdate'];
    $add_goals = $_POST['add_goals'];
    $add_assists = $_POST['add_assists'];
    $add_yellow_cards = $_POST['add_yellow_cards'];
    $add_red_cards = $_POST['add_red_cards'];

    $sql = "INSERT INTO players (number, position, name, birthdate, goals, assists, yellow_cards, red_cards) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Грешка: " . $conn->error;
    } else {
        $stmt->bind_param("isssiiii", $add_number, $add_position, $add_name, $add_birthdate, $add_goals, $add_assists, $add_yellow_cards, $add_red_cards);
        if ($stmt->execute()) {
            echo "<script>showSuccessMessage('Играчът е добавен успешно!');</script>";
        } else {
            echo "Възникна грешка: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Form to edit players
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_player'])) {
    $edit_id = $_POST['edit_id'];
    $edit_number = $_POST['edit_number'];
    $edit_position = $_POST['edit_position'];
    $edit_name = $_POST['edit_name'];
    $edit_birthdate = $_POST['edit_birthdate'];
    $edit_goals = $_POST['edit_goals'];
    $edit_assists = $_POST['edit_assists'];
    $edit_yellow_cards = $_POST['edit_yellow_cards'];
    $edit_red_cards = $_POST['edit_red_cards'];

    $sql = "UPDATE players 
            SET number = ?, position = ?, name = ?, birthdate = ?, goals = ?, assists = ?, yellow_cards = ?, red_cards = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Грешка: " . $conn->error;
    } else {
        $stmt->bind_param("isssiiiii", $edit_number, $edit_position, $edit_name, $edit_birthdate, $edit_goals, $edit_assists, $edit_yellow_cards, $edit_red_cards, $edit_id);

        if ($stmt->execute()) {
            echo "<script>showSuccessMessage('Успешна промяна!');</script>";
        } else {
            echo "Възникна грешка: " . $stmt->error;
        }

        $stmt->close();
    }
}

$sql = "SELECT id, number, position, name, birthdate, goals, assists, yellow_cards, red_cards FROM players";
$result = $conn->query($sql);

$players = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $players[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin players</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="admin_players.css">
    <script src="admin_players.js"></script>
</head>
<body>
<div class="form">
 <form action="admin_panel.php" method="post">
                <button type="submit" class="button">Новини </button>
            </form>
            <form action="admin_login.php" method="post">
                <button type="submit" class="logout-button">Изход</button>
            </form>
        </div>    
    <!-- Form to add players -->
    <div class="container">
        <h2 class="text-center mb-4">Администриране на играчи</h2>
        <form action="admin_players.php" method="post" onsubmit="showSuccessMessage()">
            <h4 class="mb-3">Добавяне на играч</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="add_number">Номер</label>
                    <input type="number" class="form-control" id="add_number" name="add_number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="add_position">Позиция</label>
                    <input type="text" class="form-control" id="add_position" name="add_position" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="add_name">Име</label>
                    <input type="text" class="form-control" id="add_name" name="add_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="add_birthdate">Дата на раждане</label>
                    <input type="date" class="form-control" id="add_birthdate" name="add_birthdate" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="add_goals">Голове</label>
                    <input type="number" class="form-control" id="add_goals" name="add_goals" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="add_assists">Асистенции</label>
                    <input type="number" class="form-control" id="add_assists" name="add_assists" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="add_yellow_cards">Жълти карти</label>
                    <input type="number" class="form-control" id="add_yellow_cards" name="add_yellow_cards" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="add_red_cards">Червени карти</label>
                    <input type="number" class="form-control" id="add_red_cards" name="add_red_cards" required>
                </div>
            </div>
            <button type="submit" name="add_player" class="btn btn-primary">Добави играч</button>
        </form>

        <hr>
        <!-- Table view of players -->
        <h4 class="mt-4 mb-3">Списък с играчи</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Номер</th>
                        <th>Позиция</th>
                        <th>Име</th>
                        <th>Дата на раждане</th>
                        <th>Голове</th>
                        <th>Асистенции</th>
                        <th>Жълти карти</th>
                        <th>Червени карти</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($players as $player) { ?>
                        <tr>
                            <td><?php echo $player['id']; ?></td>
                            <td><?php echo $player['number']; ?></td>
                            <td><?php echo $player['position']; ?></td>
                            <td><?php echo $player['name']; ?></td>
                            <td><?php echo $player['birthdate']; ?></td>
                            <td><?php echo $player['goals']; ?></td>
                            <td><?php echo $player['assists']; ?></td>
                            <td><?php echo $player['yellow_cards']; ?></td>
                            <td><?php echo $player['red_cards']; ?></td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editPlayerModal"
                                        onclick="editPlayer(<?php echo $player['id']; ?>, '<?php echo $player['number']; ?>',
                                        '<?php echo $player['position']; ?>', '<?php echo $player['name']; ?>',
                                        '<?php echo $player['birthdate']; ?>', '<?php echo $player['goals']; ?>',
                                        '<?php echo $player['assists']; ?>', '<?php echo $player['yellow_cards']; ?>',
                                        '<?php echo $player['red_cards']; ?>')">Редактирай</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Form to edit players -->
    <div class="modal fade" id="editPlayerModal" tabindex="-1" role="dialog" aria-labelledby="editPlayerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="admin_players.php" method="post" onsubmit="showSuccessMessage()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPlayerModalLabel">Редактиране на играч</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="edit_id">
                        <div class="form-group">
                            <label for="edit_number">Номер</label>
                            <input type="number" class="form-control" id="edit_number" name="edit_number" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_position">Позиция</label>
                            <input type="text" class="form-control" id="edit_position" name="edit_position" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_name">Име</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_birthdate">Дата на раждане</label>
                            <input type="date" class="form-control" id="edit_birthdate" name="edit_birthdate" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_goals">Голове</label>
                            <input type="number" class="form-control" id="edit_goals" name="edit_goals" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_assists">Асистенции</label>
                            <input type="number" class="form-control" id="edit_assists" name="edit_assists" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_yellow_cards">Жълти карти</label>
                            <input type="number" class="form-control" id="edit_yellow_cards" name="edit_yellow_cards" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_red_cards">Червени карти</label>
                            <input type="number" class="form-control" id="edit_red_cards" name="edit_red_cards" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
                        <button type="submit" name="edit_player" class="btn btn-primary">Запази промените</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="message"></div>

    <script>
        $(document).ready(function() {
            $('#editPlayerModal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
            });
        });
    </script>
</body>
</html>
