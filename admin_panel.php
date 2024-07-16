<?php
require 'config.php';

// select all news
$sql = "SELECT * FROM news";
$result = $conn->query($sql);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_news_id'])) {
        $edit_news_id = $_POST['edit_news_id'];

        // select news to be edited
        $sql_edit = "SELECT * FROM news WHERE id = ?";
        $stmt_edit = $conn->prepare($sql_edit);
        $stmt_edit->bind_param("i", $edit_news_id);
        $stmt_edit->execute();
        $result_edit = $stmt_edit->get_result();

        if ($result_edit->num_rows > 0) {
            $row_edit = $result_edit->fetch_assoc();
            $edit_title = $row_edit['title'];
            $edit_content = $row_edit['content'];

            // form edit news
            echo '<div id="editNewsModal" class="modal" style="display: block;">';
            echo '<div class="modal-content">';
            echo '<span class="close">&times;</span>';
            echo '<form action="admin_panel.php" method="post">';
            echo '<input type="hidden" name="news_id" value="' . $edit_news_id . '">';
            echo '<label for="edit_title">Заглавие:</label><br>';
            echo '<input type="text" id="edit_title" name="edit_title" value="' . htmlspecialchars($edit_title) . '" required><br>';
            echo '<label for="edit_content">Съдържание:</label><br>';
            echo '<textarea id="edit_content" name="edit_content" rows="4" cols="50" required>' . htmlspecialchars($edit_content) . '</textarea><br><br>';
            echo '<input type="submit" name="update_news" value="Запази промените">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }

        $stmt_edit->close();
    } elseif (isset($_POST['update_news'])) {
        // update news  
        $news_id = $_POST['news_id'];
        $edit_title = $_POST['edit_title'];
        $edit_content = $_POST['edit_content'];

        $sql_update = "UPDATE news SET title = ?, content = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $edit_title, $edit_content, $news_id);

        if ($stmt_update->execute()) {
            $message = "Новината е обновена успешно!";
        } else {
            $message = "Грешка при обновяване на новината.";
        }

        $stmt_update->close();
    } else {
        // add new row
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d H:i:s'); 

        $sql_insert = "INSERT INTO news (title, content, date) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $title, $content, $date);

        if ($stmt_insert->execute()) {
            $message = "Новината е добавена успешно!";
        } else {
            $message = "Грешка при добавяне на новината.";
        }

        $stmt_insert->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-jnurzO4JO1BUbFv2IDyPzBPUxMxzQHnWNa9BhIwHt9Nvs6geKcP4U8OTLlUkMb3v1GJ6kOQ+2uM0zKk2mrhL5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_panel.css">
    <script src="admin_panel.js"></script>
    
</head>

<body>
    <div class="form">
        <form action="admin_players.php" method="post">
            <button type="submit" class="button">Играчи</button>
        </form>

        <form action="admin_login.php" method="post">
            <button type="submit" class="logout-button">Изход</button>
        </form>
    </div>

    <div class="admin-panel">
        <?php
        if (!empty($message)) {
            echo '<div id="message" style="color: green;">' . htmlspecialchars($message) . '</div>';
        }
        ?>
        <h2>Добавяне на новина/статия</h2>
        <form action="admin_panel.php" method="post">
            <label for="title">Заглавие:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="content">Съдържание:</label><br>
            <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Добави">
        </form>

        <h2>Списък с новини и статии</h2>
        <div class="carousel-container">
            <button class="carousel-control carousel-control-left">&lt;</button>
            <button class="carousel-control carousel-control-right">&gt;</button>
            <div class="news-carousel">
                <?php
                // select * from news
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="news-item">';
                        echo '<div class="news-title">' . htmlspecialchars($row['title']) . '</div>';
                        echo '<div class="news-date">' . htmlspecialchars($row['date']) . '</div>';
                        echo '<form action="admin_panel.php" method="post">';
                        echo '<input type="hidden" name="edit_news_id" value="' . $row['id'] . '">';
                        echo '<button type="submit" class="edit-button">Редактирай</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="news-item">Няма налични новини или статии.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
