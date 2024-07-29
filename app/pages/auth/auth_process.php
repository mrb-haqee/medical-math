<?php

session_start();

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . "/helper/helper.php");

use function Helper\{feedback};

// Check apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] === "signup") {
        parse_str($_POST['data'], $data);
        $email = $data['email'];
        $username = $data['username'];
        $password = $data['password'];

        try {
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password]);

            $_SESSION['email'] = $email;
            $_SESSION['sapa'] = 'sapaoi';
            $_SESSION['login'] = "Berhasil Login!";
            echo feedback('sukses', "Berhasil Login!");
        } catch (PDOException $e) {
            echo feedback('error', "Error: " . $e->getMessage());
        }
    } else if ($_POST["action"] === "singin") {
        parse_str($_POST['data'], $data);
        $email = $data['email'];
        $password = $data['password'];

        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                echo feedback('error', "Email tidak ditemukan!");
            } else if ($password !== $user['password']) {
                echo feedback('error', "Password Salah!");
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['sapa'] = 'sapaoi';
                $_SESSION['login'] = "Berhasil Login!";
                echo feedback('sukses', "Berhasil Login!");
            }
        } catch (PDOException $e) {
            echo feedback('error', "Error: " . $e->getMessage());
        }
    }
}
