<?php
require 'config.php';
$users = [
    [
        'username' => 'admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'email' => 'admin@example.com',
        'role' => 'admin'
    ],
    [
        'username' => 'user1',
        'password' => password_hash('user123', PASSWORD_DEFAULT),
        'email' => 'user1@example.com',
        'role' => 'user'
    ],
    [
        'username' => 'user2',
        'password' => password_hash('user456', PASSWORD_DEFAULT),
        'email' => 'user2@example.com',
        'role' => 'user'
    ]
];

foreach ($users as $user) {
    $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $user['username'], $user['password'], $user['email'], $user['role']);
    $stmt->execute();
}

echo "Данните бяха успешно вмъкнати.";

$conn->close();
?>
