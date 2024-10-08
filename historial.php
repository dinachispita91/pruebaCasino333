<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino Online - Dados</title>
    <link rel="stylesheet" href="style.css"> <!-- Hoja de estilos -->
</head>
<?php

session_start(); // 1. Iniciar sesión para acceder a las variables de sesión.

if (!isset($_SESSION["game_history"])) {
    // 2. Si no hay historial de jugadas, mostramos un mensaje.
    echo "<p>No hay historial de jugadas disponible.</p>";
    exit;
}

// 3. Si hay un historial, mostramos la tabla con las jugadas.
echo "<h1>Historial de Jugadas</h1>";
echo "<table id='tabla-historial' border='1' >
        <tr>
            <th>Número de Jugada</th>
            <th>Hora</th>
            <th>Saldo Inicial</th>
            <th>Apuesta</th>
            <th>Resultado</th>
            <th>Saldo Final</th>
        </tr>";

// 4. Recorremos cada jugada en el historial y mostramos los datos.
foreach ($_SESSION["game_history"] as $jugada) {
    echo "<tr>
            <td>" . htmlspecialchars($jugada["contador_jugada"]) . "</td>
            <td>" . htmlspecialchars($jugada["hora_jugada"]) . "</td>
            <td>" . htmlspecialchars($jugada["saldo_inicial"]) . "</td>
            <td>" . htmlspecialchars($jugada["apuesta"]) . "</td>
            <td>" . ($jugada["resultado"] ? "Ganó" : "Perdió") . "</td>
            <td>" . htmlspecialchars($jugada["saldo_final"]) . "</td>
          </tr>";
}
echo "</table>";
?>
<a href="game.php" class="button">Volver al juego</a>
<a href="recargasaldo.php" class="button">Deposito</a>
<a href="index.php" class="button">Inicio</a>
<a href="login.php" class="button">login</a>
<a href="cerrar_sesion.php" class="button">Salir</a>
</body>