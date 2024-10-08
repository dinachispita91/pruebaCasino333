<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Casino Online</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Login de Usuario</h1>
    </header>
    <main>
        <form action="procesoLogin.php" method="POST" id="login-form">
            <input type="text" name="nickname" placeholder="Apodo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>

        </form>
    </main>
</body>

</html>