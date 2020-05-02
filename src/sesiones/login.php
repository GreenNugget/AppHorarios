<?php
/*
Archivo que sirve para la validacion de un login
*/
session_start();

//Se llama a la base de datos
require 'database.php';

//recibe el usuario y la contraseña.
$username = $_POST['username'];
$password = $_POST['password'];

//Lectura de la base de datos de la tabla que se necesita.
if (!empty($username) && !empty($password)){
    $record = $conn->prepare('SELECT role, userName, userPassword FROM usuarios WHERE userName = :username');
    $record->bindParam(':username', $username);
    $record->execute();
    $result = $record->fetch(PDO::FETCH_ASSOC);

    $message='';

    if(count($result) > 0 && ($password == $result['userPassword'])){
        $_SESSION['user_id'] = $result['userName'];//la salida es el id de usuario.
        header("Location: /sesiones/index.php");//cambiar a donde se redireccionará una vez ingresado
    }else{
        $message = 'Sus datos no coinsiden';
        echo '<script language="javascript">alert("Sus datos no coinsiden");</script>';
        header("Location: /sesiones/login.html");//redireccionar al front del login 
    }
}else{
    $message = 'Ingrese sus datos';
    echo '<script language="javascript">alert("Ingrese sus datos");</script>';
    header("Location: /sesiones/login.html");//redireccionar al front del login
}
?>