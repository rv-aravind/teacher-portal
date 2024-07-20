<?php
require_once 'config/database.php';

function authenticate($username, $password) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => md5($password)]);
    return $stmt->fetch();
}

?>
