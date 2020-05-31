<?php
/*
*This file is used to extract the information of the schedules for the professors
*@author Naomi G.
*@version 0.3
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

include 'functions.php';

$idProfe = $_POST['clv_profe'];

if ($conexion = connectToDB()){

    $sql= "select nombre_mate, descripcion, sesiones from
    (((horarios join clases on horarios.id_clase=clases.id_clase)
    join materias on clases.clv_materia=materias.clv_materia) 
    join aulas on horarios.id_aula=aulas.id_aula)
    where clv_profe='$idProfe'";
    $result = consultToDB($sql);
    $schedule = getScheduleProf($result);

    echo substr($schedule, 0, -1);

    $conexion->close();
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}

?>