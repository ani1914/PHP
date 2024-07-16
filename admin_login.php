<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>

<body>
    <div class="container">
        <h2>Администраторски панел</h2>
        <form action="admin_process.php" method="post">
            <label for="username">Потребител:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Парола:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Вход">
        </form>
    </div>
</body>

</html>