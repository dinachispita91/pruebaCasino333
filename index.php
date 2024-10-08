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
        <!-- footer.php -->
        <footer>
            <button onclick="toggleMode()" id="toggle-button">Diurno</button>
        </footer>
    </header>
    <main>
        <form action="procesoLogin.php" method="POST" id="login-form">
            <input type="text" name="nickname" placeholder="Apodo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>

        </form>
        <nav>
            <a class="button" href="registro.php">Registro</a>
            <a href="index.php" class="button">Inicio</a>


        </nav>
    </main>
    <footer>
        <p>&copy; 2024 Casino Online</p>
    </footer>

    <script>
        // Función para alternar entre modo diurno y nocturno
        function toggleMode() {
            const body = document.body;
            body.classList.toggle('diurno');
            const isDiurno = body.classList.contains('diurno');
            document.getElementById('toggle-button').textContent = isDiurno ? 'Nocturno' : 'Diurno';
        }
    </script>
</body>

</html>