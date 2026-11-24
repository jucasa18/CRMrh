
<?php

session_name("autentific");
session_start();

// Inicializar variables
$username = "";
$name = "";
$group = "";
$email = "";
$errors = array();
$day = date("Y-m-d");

// Conexión a la base de datos
$db = mysqli_connect('localhost', 'root', '', 'rh');

if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($db, 'utf8mb4');

// ==========================================
// REGISTRAR USUARIO
// ==========================================

if (isset($_POST['reg_user'])) {

    // Recibir datos del formulario
    $username = trim($_POST['username'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $planta = trim($_POST['planta'] ?? '');

    $password_1 = $_POST['password_1'] ?? '';
    $password_2 = $_POST['password_2'] ?? '';

    // ==========================================
    // VALIDAR FORMULARIO
    // ==========================================

    if (empty($username)) {
        array_push($errors, "Nombre de usuario requerido");
    }

    if (empty($name)) {
        array_push($errors, "Nombre requerido");
    }

    if (empty($email)) {
        array_push($errors, "Correo requerido");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Correo electrónico no válido");
    }

    if (empty($planta)) {
        array_push($errors, "Planta requerida");
    }

    if (empty($password_1)) {
        array_push($errors, "Contraseña requerida");
    }

    if ($password_1 !== $password_2) {
        array_push($errors, "La contraseña no coincide");
    }

    // ==========================================
    // VALIDAR SI EL USUARIO YA EXISTE
    // ==========================================

    $user_check_query = "
        SELECT username, email
        FROM user
        WHERE username = ? OR email = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($db, $user_check_query);

    if (!$stmt) {
        die("Error al preparar consulta: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if ($user) {

        if ($user['username'] === $username) {
            array_push($errors, "El usuario ya existe");
        }

        if ($user['email'] === $email) {
            array_push($errors, "El correo ya existe");
        }
    }

    // ==========================================
    // REGISTRAR SI NO EXISTEN ERRORES
    // ==========================================

    if (count($errors) == 0) {

        // Generar hash seguro de contraseña
        $password = password_hash(
            $password_1,
            PASSWORD_DEFAULT
        );

        // Insertar usuario
        $query = "
            INSERT INTO user
            (
                username,
                email,
                pass,
                name,
                grupo,
                created_at,
                planta_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = mysqli_prepare($db, $query);

        if (!$stmt) {
            die("Error al preparar registro: " . mysqli_error($db));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "sssssss",
            $username,
            $email,
            $password,
            $name,
            $group,
            $day,
            $planta
        );

        $resultado = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        if ($resultado) {

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "ok";

            mysqli_close($db);

            echo "<script>
                alert('Registro exitoso. Proceda a logearse');
                window.location='../index.php';
            </script>";

            exit();

        } else {

            array_push($errors, "Error al registrar el usuario");

        }
    }
}


?>
