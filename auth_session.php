<?php
require('register_user.php');
// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        // Consulta preparada busca usuario e id, y checa que este activo
        $query = "SELECT * FROM user WHERE email = ? AND is_active = 1 LIMIT 1";
        $stmt = mysqli_prepare($db, $query);
        if (!$stmt) {
            die("Error al preparar la consulta: " . mysqli_error($db));
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
        if ($row) {
            $passwordValida = false;
            // Verificar contraseña con password_hash
            if (password_verify($password, $row['pass'])) {
                $passwordValida = true;
                // Actualizar hash si es necesario
                if (password_needs_rehash($row['pass'], PASSWORD_DEFAULT)) {
                    $nuevoHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = mysqli_prepare(
                        $db,
                        "UPDATE user SET pass = ? WHERE id = ?"
                    );
                    mysqli_stmt_bind_param(
                        $update,
                        "si",
                        $nuevoHash,
                        $row['id']
                    );
                    mysqli_stmt_execute($update);
                    mysqli_stmt_close($update);
                }

            } 
            // Compatibilidad temporal con contraseñas antiguas MD5
            elseif (
                preg_match('/^[a-f0-9]{32}$/i', $row['pass']) &&
                hash_equals(strtolower($row['pass']), md5($password))
            ) {
                $passwordValida = true;
                // Convertir automáticamente MD5 a password_hash
                $nuevoHash = password_hash($password, PASSWORD_DEFAULT);
                $update = mysqli_prepare(
                    $db,
                    "UPDATE user SET pass = ? WHERE id = ?"
                );
                mysqli_stmt_bind_param(
                    $update,
                    "si",
                    $nuevoHash,
                    $row['id']
                );
                mysqli_stmt_execute($update);
                mysqli_stmt_close($update);
            }
            if ($passwordValida) {
                // Datos de sesión
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['activo'] = $row['is_active'];
                $_SESSION['tipo'] = $row['tipo'];
               mysqli_stmt_close($stmt);
                header('Location: empleados.php');
                exit();

            } else {
                array_push($errors, "Wrong username/password combination");
                mysqli_stmt_close($stmt);
                echo '<script>
                    alert("Los datos son incorrectos, vuelve a intentarlo");
                    window.location="../index.php";
                </script>';
                exit();
            }

        } else {
            array_push($errors, "Wrong username/password combination");
            mysqli_stmt_close($stmt);
            echo '<script>
                alert("Los datos son incorrectos, vuelve a intentarlo");
                window.location="../index.php";
            </script>';
            exit();
        }
    }
}
