<?php
// session_start();
require_once("conexion.php");

function tirarDados()
{
    // Lanzar los dados
    $dado1 = rand(1, 6);
    $dado2 = rand(1, 6);
    // Calcular el total de los dos dados
    $total = $dado1 + $dado2;
    return $total;
}

function obtenerIdUsuario($nickname)
{
    global $db;
    $query = "SELECT id_usuario FROM usuarios WHERE nickname = :nickname";
    $stmt = $db->prepare($query);
    $stmt->execute([':nickname' => $nickname]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['id_usuario'];
    } else {
        return false;
    }
}

function obtenerNumeroJugadas($id_usuario)
{
    global $db;
    $query = "SELECT COUNT(*) AS total_jugadas
    FROM historial_juego 
    WHERE id_usuario = :id_usuario";
    $stmt = $db->prepare($query);
    $stmt->execute([':id_usuario' => $id_usuario]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['total_jugadas'];
    } else {
        return false;
    }
}

function insertarJugada($id_usuario, $jugada)
{
    global $db;
    $query = "INSERT INTO historial_juego (
    id_usuario,

    Saldo_Inicial,
    Apuesta,
    Resultado,
    Saldo_Final) VALUES (
    :id_usuario,

    :Saldo_Inicial,
    :Apuesta,
    :Resultado,
    :Saldo_Final)";
    try {
        $sentenciasql = $db->prepare($query);
        $sentenciasql->bindParam(':id_usuario', $id_usuario);
        //$sentenciasql->bindParam(':fecha_hora', $jugada["hora_jugada"]);
        $sentenciasql->bindParam(':Saldo_Inicial', $jugada["saldo_inicial"]);
        $sentenciasql->bindParam(':Apuesta', $jugada["apuesta"]);
        $sentenciasql->bindParam(':Resultado', $jugada["resultado"]);
        $sentenciasql->bindParam(':Saldo_Final', $jugada["saldo_final"]);
        $sentenciasql->execute();
        // header('Location: index.php');
        //echo "<script>alert('Jugada guardada correctamente');</script>";
        return true;
    } catch (PDOException $e) {
        echo 'Error de inserción en la base de datos: ' . $e->getMessage();
        return false;
    }
}
function contarJugadas($id_usuario)
{
    global $db;
    $query = "SELECT COUNT(*) as total_jugadas FROM historial_juego WHERE id_usuario = :id_usuario";

    try {
        $sentenciasql = $db->prepare($query);
        $sentenciasql->bindParam(':id_usuario', $id_usuario);
        $sentenciasql->execute();

        $resultado = $sentenciasql->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_jugadas'];
    } catch (PDOException $e) {
        echo 'Error al contar las jugadas: ' . $e->getMessage();
        return false;
    }
}


/*
    SELECT COUNT(*) AS total_jugadas
    FROM historial_juego 
    WHERE id_usuario = :id_usuario";
    $stmt = $db->prepare($query);
    $stmt->execute([':id_usuario' => $id_usuario]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['total_jugadas'];
    } else {
        return false;
    }tareas pendientes:
    
    mostrar saldo actual en la página de juego
    menus para navegar entre las páginas
    modulo para enviar correos  con las jugadas.
    actualizar los campos de las tablas segun enunciado

*/