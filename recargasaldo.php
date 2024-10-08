<?php
require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino Online - Dados</title>
    <link rel="stylesheet" href="style.css"> <!-- Hoja de estilos -->
</head>

<body>
    <header id="posicionHeader">
        <h1>Casino Online - Juego de Dados</h1>
        <button onclick="toggleMode()" id="toggle-button">Diurno</button>
        <nav>
            <a href="index.php" class="button">Inicio</a>
            <a href="historial.php" class="button">Historial de jugadas</a>
            <a href="cerrar_sesion.php" class="button">Salir</a>
            <a href="recargasaldo.php" class="button">Deposito</a>
        </nav>
    </header>

    <main>
        <div id="user-info">
            <h2>Recargar saldo 👇👇👇👇</h2>
            <form action="game.php" method="POST" name="user-form" id="user-form" onsubmit="return validateAge()">

                <input type="number" name="initial_balance" placeholder="Saldo Inicial (20-100 euros)" min="20"
                    max="100" required>
                <button id="boton" type="submit">Iniciar juego</button>
                <button id="boton" type="reset">Limpiar</button>
            </form>
        </div>
    </main>
    <script>
        // Función para alternar entre modo diurno y nocturno
        function toggleMode() {
            const body = document.body;
            body.classList.toggle('diurno');
            const isDiurno = body.classList.contains('diurno');
            document.getElementById('toggle-button').textContent = isDiurno ? 'Nocturno' : 'Diurno';
        }
    </script>