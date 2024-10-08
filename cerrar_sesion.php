<?php
session_start();
unset($_SESSION);
session_destroy();  // Destruir la sesión actual
header("Location: login.php");  // Redirigir al login
exit();