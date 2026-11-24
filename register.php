<?php 
include('register_user.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" &amp;gt;>
    <link href="css/style_login.css" rel="stylesheet" type="text/css" />
    <title>Login </title>
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
        <label for="tab-2" class="tab" >Register</label>
        
        <div class="login-form">
        <form method="post" action="register.php">
            <?php include('errors.php'); ?>
            
            <div class="group">
                <label for="user" class="label">Username</label>
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
            </div>
            
            <div class="group" >
                <label for="pass" class="label">Password</label>
                <input type="password" name="password_1" class="input">
            </div>
            <div class="group">
                <label for="pass" class="label">Confirm password</label>
                <input type="password" name="password_2" class="input">
            </div>
            <div class="group">
                <label for="pass" class="label">Name</label>
                <input type="text" class="input" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="group">
                <label for="pass" class="label">Group</label>
                <input type="text" class="input" name="group" value="<?php echo $group; ?>">
            </div>
            <div class="group">
                <label for="pass" class="label">Email</label>
                <input type="email" class="input" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="group">
                <label for="pass" class="label">Planta</label>
                <select class="input" aria-label="Default select example" name="planta" required>
                                    <?php
                                    require 'conexion.php';
                                    date_default_timezone_set('UTC');
                                    date_default_timezone_set("America/Mexico_City");
                                    $planta = "SELECT *  FROM plant ";
                                    $datosplant = mysqli_query($conexion, $planta);
                                    ?>
                                    

                                    <?php
                                    while ($filaplant = mysqli_fetch_array($datosplant)) { ?>
                                        <option value="<?php echo $filaplant['id']; ?>"><?php echo $filaplant['name']; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
            </div>
            <div class="group">
                <button type="submit" class="button" name="reg_user">Register</button>
            </div>
            <div class="foot-lnk">
                <a href="index.php">Back</a>
                </div>
        </form>
</body>

</html>