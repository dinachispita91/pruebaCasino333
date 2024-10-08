<?php
session_start();
require_once("conexion.php");
require_once("funciones.php");
// Verificar si el usuario está autenticado
if (!isset($_SESSION['nickname'])) {
    header("Location: login.php");
    exit();
}
// Verificar si hay saldo disponible
if (isset($_SESSION['bet']) and $_SESSION['bet'] <= 0) {
    echo "No tienes saldo suficiente para seguir jugando.";
    exit();
}
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
    <a href="cerrar_sesion.php" class="button">Salir</a>
</header>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "casino_online");

    // Verificar conexión
    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }
    // Consultar el saldo del usuario
    ?>
    <main>

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
                    // Verificar si existe la clave 'play_count' en $_SESSION
                    $_SESSION['play_count'] = $_SESSION['play_count'] ?? 0;

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

                    $id_usuario = obtenerIdUsuario($_SESSION['nickname']);

                    // Insertar la jugada en la base de datos
                    insertarJugada($id_usuario, $jugada);

                }
                ?>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener el número de jugadas desde PHP (usando la sesión de PHP)
            var playCount = <?php echo isset($_SESSION['play_count']) ? $_SESSION['play_count'] : 0; ?>;
            // Comprobar si es el tercer turno o múltiplo de 3, y si no es el turno 0
            if (playCount % 3 === 0 && playCount !== 0) {
                alert("Recuerda que si no hay diversión no hay juego.");
            }
            //============================================================
            //comprobar que el saldo en positivo si no  mostrar alerta y restringir acceso. 
            // Obtener el saldo desde PHP
            var balance = <?php echo isset($_SESSION['balance']) ? $_SESSION['balance'] : 0; ?>;
            // Referencias al formulario y botón
            var form = document.getElementById('user-form');
            var submitButton = document.getElementById('submit-button');
            var betInput = document.getElementById('bet'); // Campo de apuesta
            // Si el saldo es cero, desactivar el botón y mostrar mensaje
            if (balance <= 0) {
                alert("Saldo insuficiente. Debes depositar más dinero para continuar jugando.");
                submitButton.disabled = true; // Desactiva el botón de enviar
                return; // Evita cualquier otra acción
            }
            // Escuchar el evento de envío del formulario
            form.addEventListener('submit', function (event) {
                var bet = parseFloat(betInput.value); // Obtener el valor de la apuesta
                // Comprobar si la apuesta es mayor que el saldo disponible
                if (bet > balance) {
                    alert("Saldo insuficiente. No puedes apostar más de lo que tienes.");
                    event.preventDefault(); // Evita el envío del formulario si la apuesta excede el saldo
                }
            });
        });
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