<?php
include 'functions.php';

$idProfe = "P00004";

if ($conexion = connectToDB()){

    $sql= "select nombre_mate, descripcion, sesiones from
    (((horarios join clases on horarios.id_clase=clases.id_clase)
    join materias on clases.clv_materia=materias.clv_materia) 
    join aulas on horarios.id_aula=aulas.id_aula)
    where clv_profe='$idProfe'";
    $result = consultToDB($sql);
    $schedule = getHorarioProfe($result);

    echo substr($schedule, 0, -1);

    $conexion->close();
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}

?>