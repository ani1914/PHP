<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Username: $username<br>";
    echo "Password: $password<br>";

    //check status
    $sql = "SELECT * FROM users WHERE username=? AND role='admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows >0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = true;
            header("Location: admin_panel.php");
            exit();
        } else {
            header("Location: admin_login.php?error=wrong_password");
            exit();
        }
    } else {
        header("Location: admin_login.php?error=not_admin");
        exit();
    }
} else {
    header("Location: admin_login.php?error=error2013");
    exit();
}

$conn->close();
?>
