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
            <a href="registro.php">Registro</a>
            <a href="login.php">Login</a>
            <!-- <a href="game.php">Jugar</a>
            <a href="history.php">Informe de Uso</a>
            <a href="logout.php">Salir</a> -->
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