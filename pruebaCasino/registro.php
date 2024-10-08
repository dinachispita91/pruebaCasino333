<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Casino Online</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Registro de Usuario</h1>
    </header>
    <main>
        <form action="procesoRegistro.php" method="POST" id="register-form">
            <input type="text" name="fullname" placeholder="Nombre y Apellidos" required>
            <input type="text" name="nickname" placeholder="Apodo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="id_number" placeholder="Documento de Identidad" required>
            <input type="date" name="birthdate" required>
            <select name="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
            <input type="number" name="initial_balance" placeholder="Saldo Inicial (20-100 euros)" min="20"
                    max="100" required>

            <button type="submit">Registrar</button>
        </form>
    </main>
</body>

</html>