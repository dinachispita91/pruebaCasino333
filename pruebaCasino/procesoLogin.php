<?php
session_start();
require_once("conexion.php");

if (!$db) {
    die("Conexión fallida");
}

$nickname = $_POST['nickname'];
$password = $_POST['password'];

// Consulta para obtener la contraseña y el saldo del usuario
$query = "SELECT password, initial_balance FROM usuarios WHERE nickname = :nickname";
$stmt = $db->prepare($query);
$stmt->execute([':nickname' => $nickname]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Verifica la contraseña usando password_verify
    if (password_verify($password, $result['password'])) {
        $_SESSION['nickname'] = $nickname;
        $_SESSION['balance'] = $result['initial_balance']; // Almacena el saldo en la sesión
        header('Location: game.php');
        exit;
    } else {
        echo "Contraseña incorrecta";
        header('Location: login.php');
        exit;
    }
} else {
    echo "Usuario no encontrado";
    header('Location: login.php');
    exit;
}
