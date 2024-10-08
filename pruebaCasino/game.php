<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino Online - Dados</title>
    <link rel="stylesheet" href="style.css"> <!-- Hoja de estilos -->
</head>

<header>
    <h1>Bienvenid@, <?php echo htmlspecialchars($_SESSION['nickname']); ?></h1>
    <a href="recargasaldo.php" class="button">Deposito</a>
    <a href="index.php" class="button">Inicio</a>
    <a href="historial.php" class="button">Historial de jugadas</a>
</header>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "casino_online");

    // Verificar conexión
    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }

    // Habilitar manejo de sesiones de usuario en PHP
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['juego'])) {
        // Asignar los datos del formulario a la sesión
        $_SESSION['fullname'] = $_POST['fullname']; // nombre
        $_SESSION['nickname'] = $_POST['nickname']; // apodo
        $_SESSION['sexo'] = $_POST['sexo']; // genero
        $_SESSION['birthdate'] = $_POST['birthdate']; // birthdate
        $_SESSION['id_number'] = $_POST['id_number']; // número de identificación
        $_SESSION['initial_balance'] = intval($_POST['initial_balance']); // saldo inicial
        $_SESSION['balance'] = intval($_POST['initial_balance']); // saldo actual
        $_SESSION['hora_inicio'] = date('d-m-Y H:i:s', time());
        $_SESSION['play_count'] = 0;
        $_SESSION['game_history'] = [];
    }

    function tirarDados()
    {
        // Lanzar los dados
        $dado1 = rand(1, 6);
        $dado2 = rand(1, 6);
        // Calcular el total de los dos dados
        $total = $dado1 + $dado2;
        return $total;
    }
    ?>
    <main>
        <h2>Tu saldo inicial: €
            <?php echo isset($_SESSION['initial_balance']) ? htmlspecialchars($_SESSION['initial_balance']) : 0; ?>
        </h2>

        <div id="game-area">
            <h2>Juego de Dados</h2>
            <form action="game.php" method="POST" id="user-form">
                <input type="hidden" name="juego" value="verdadero">
                <input type="number" id="bet" name="bet" placeholder="Apuesta" required min="1"
                    max="<?php echo $_SESSION['balance']; ?>">
                <button type="submit" id="submit-button" name="lanzar">Lanzar Dados</button>
            </form>
            <div id="result">
                <?php
                if (isset($_POST['lanzar'])) {
                    // Validar que el saldo sea mayor que cero
                    if ($_SESSION['balance'] <= 0) {
                        echo "<p>No puedes jugar con saldo insuficiente.</p>";
                        return; // Evita continuar si el saldo es cero o negativo
                    }

                    $_SESSION['play_count']++;
                    $_SESSION['bet'] = intval($_POST['bet']); // Asegúrate de convertir a entero
                    $result = tirarDados();

                    if (isset($result)) {
                        echo "<p>El resultado del lanzamiento es: " . htmlspecialchars($result) . "</p>";
                    }

                    // Guardar la jugada
                    $jugada = array();
                    $jugada["contador_jugada"] = $_SESSION['play_count'];
                    $jugada["hora_jugada"] = date('d-m-Y H:i:s', time());
                    $jugada["saldo_inicial"] = $_SESSION['balance'];
                    $jugada["apuesta"] = $_SESSION['bet'];

                    // Verificar el resultado
                    if ($result === 7 || $result === 11) {
                        $_SESSION['balance'] += $_SESSION['bet']; // Aumenta el saldo
                        $jugada["resultado"] = true;
                        echo "<p>¡Enhorabuena, ganó!</p>";
                    } else {
                        $_SESSION['balance'] -= $_SESSION['bet']; // Disminuye el saldo
                        $jugada["resultado"] = false;
                        echo "<p>Lo lamento, perdió</p>";
                    }

                    $jugada["saldo_final"] = $_SESSION['balance'];
                    $_SESSION["game_history"][$_SESSION['play_count'] - 1] = $jugada;
                    echo "<h2>Saldo actual: " . $_SESSION['balance'] . "</h2>";
                }
                ?>
            </div>
        </div>
    </main>
    <a href="recargasaldo.php" class="button">Deposito</a>
    <a href="index.php" class="button">Inicio</a>
    <a href="historial.php" class="button">Historial de jugadas</a>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('hamburger-menu');
            menu.classList.toggle('active');
        }
    </script>


</body>

</html>