<?php
/*
Este hmt sirve como ejemplo de como seria la validación de los roles de los usuarios
*/
  session_start();

  require 'database.php';   

  //Se valida que el exista una sesion iniciada con un id especifico.
  if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    //Lectura de la base de datos de la tabla que se necesita
    $records = $conn->prepare('SELECT role, userName, userPassword FROM usuarios WHERE userName = :username');
    $records->bindParam(':username', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    //se utilizan los roles para identificar a los diferententes tipos de usuario
    if (count($results) > 0) {
      if($results['role']==2){

        $records = $conn->prepare('SELECT clv_profe, nombre_profesor FROM profesores WHERE clv_profe = :username');
        $records->bindParam(':username', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = $results['nombre_profesor'];

      }elseif($results['role']=3){

        $records = $conn->prepare('SELECT matricula, nombre_alumno FROM alumnos WHERE matricula = :username');
        $records->bindParam(':username', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = $results['nombre_alumno'];

      }elseif($results['role']=1){

        $records = $conn->prepare('SELECT userName FROM usuarios WHERE userName = :username');
        $records->bindParam(':username', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = $results['userName'];
      }
    }
  }
?>

<!DOCTYPE html>
<!--Ejemplo de una vista-->
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user; ?>
      <br>Estas correctamente logeado
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <h1>Please Login</h1>
      <a href="login.html">Login</a>
    <?php endif; ?>
  </body>
</html>