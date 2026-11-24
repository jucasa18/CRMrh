
<?php
session_name("autentific");
session_start();

require 'conexion.php';

// Obtener datos
$id = (int)($_POST['id'] ?? 0);

$name = trim($_POST['name'] ?? '');
$numEmpleado = trim($_POST['numEmpleado'] ?? '');
$email = trim($_POST['email'] ?? '');
$tipo = trim($_POST['tipo'] ?? '');
$planta = trim($_POST['planta'] ?? '');
$password_1 = $_POST['password'] ?? '';

$created_at = date('Y-m-d H:i:s');

// Validar datos
if ($id <= 0 || empty($name) || empty($email)) {
    die("Faltan datos obligatorios.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}

// Generar contraseña segura
$password = password_hash($password_1, PASSWORD_DEFAULT);

if ($password === false) {
    die("No fue posible generar la contraseña.");
}

// Iniciar transacción
mysqli_begin_transaction($conexion);

try {

    // Actualizar usuario
    $sql = "UPDATE user
            SET name = ?,
                numEmpleado = ?,
                email = ?,
                tipo = ?,
                planta = ?,
                created_at = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssi",
        $name,
        $numEmpleado,
        $email,
        $tipo,
        $planta,
        $created_at,
        $id
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error al actualizar el usuario.");
    }

    mysqli_stmt_close($stmt);

    // Registrar historial
    $sql2 = "INSERT INTO histuser
             VALUES ('', ?, ?, ?, ?, ?, '1', '', ?, ?, ?, ?)";

    $stmt2 = mysqli_prepare($conexion, $sql2);

    $idSesion = $_SESSION['id'];

    mysqli_stmt_bind_param(
        $stmt2,
        "iisssssss",
        $idSesion,
        $id,
        $name,
        $email,
        $password,
        $planta,
        $tipo,
        $numEmpleado,
        $created_at
    );

    if (!mysqli_stmt_execute($stmt2)) {
        throw new Exception("Error al guardar el historial.");
    }

    mysqli_stmt_close($stmt2);

    // Confirmar cambios
    mysqli_commit($conexion);

    echo "<script>
        alert('Datos actualizados correctamente');
        window.location='edit_user.php?id=$id';
    </script>";

} catch (Exception $e) {

    mysqli_rollback($conexion);

    echo "<script>
        alert('Algo salió mal: " . addslashes($e->getMessage()) . "');
        window.location='edit_user.php?id=$id';
    </script>";
}

// No cerrar aquí la conexión si otros archivos incluidos todavía la necesitan.
?>

