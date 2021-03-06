<?php
/*
*This file is used to extract the information of the schedules for the students
*
*@author Naomi G.
*@version 0.3
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

include 'functions.php';

$matricula = $_POST['matricula'];

if($conexion = connectToDB()){
    $requestGroup = consultToDB("SELECT id_grupo from grupos where matricula='$matricula'");
    $idGroup = mysqli_fetch_assoc($requestGroup)['id_grupo'];
    
    $sql = "select descripcion, sesiones, nombre_profesor, nombre_mate from
    ((((horarios join clases on horarios.id_clase=clases.id_clase)
    join aulas on horarios.id_aula=aulas.id_aula)
    join materias on clases.clv_materia=materias.clv_materia)
    join profesores on clases.clv_profe=profesores.clv_profe) where id_grupo='$idGroup'";
    $result = consultToDB($sql);
    $schedule = getScheduleAlum($result);

    echo "[".substr($schedule,0,-1)."]";//We subtract the last comma so we can read the JSON when is needed

    $conexion->close();
} else {
    echo '<script>alert("No se pudo conectar a la base de datos");</script>';
}

?>