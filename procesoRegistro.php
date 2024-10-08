<?php
session_start();
require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <button onclick="toggleMode()" id="toggle-button">Diurno</button>
    </header>

</body>

</html>
<?php
// Obtener datos del formulario
$fullname = $_POST['fullname'];
$nickname = $_POST['nickname'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$id_number = $_POST['id_number'];
$birthdate = $_POST['birthdate'];
$sexo = $_POST['sexo'];
$initial_balance = $_POST['initial_balance'];
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO usuarios (fullname, nickname, password, id_number, birthdate, sexo, initial_balance, created_at)  
        VALUES (:fullname, :nickname, :password, :id_number, :birthdate, :sexo, :initial_balance, :created_at)";


try {
    $sentenciasql = $db->prepare($sql);
    $sentenciasql->bindParam(':fullname', $fullname);
    $sentenciasql->bindParam(':nickname', $nickname);
    $sentenciasql->bindParam(':password', $password);
    $sentenciasql->bindParam(':sexo', $sexo);
    $sentenciasql->bindParam(':birthdate', $birthdate);
    $sentenciasql->bindParam(':id_number', $id_number);
    $sentenciasql->bindParam(':created_at', $created_at);
    $sentenciasql->bindParam(':initial_balance', $initial_balance);
    $sentenciasql->execute();

    $_SESSION['nickname'] = $nickname;  // Asegúrate de guardar el apodo
    header('Location: index.php');
    // echo 'Registro guardado correctamente<br>';
} catch (PDOException $e) {
    echo 'Error de inserción en la base de datos: ' . $e->getMessage();
}
?>