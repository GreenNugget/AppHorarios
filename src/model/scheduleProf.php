<?php
include 'functions.php';

$idProfe = "P00001";

if ($conexion = connectToDB()){

    $sql= "select nombre_mate,hora_inicio,hora_final,dias_impartidos,descripcion from
    ((((clases join horarios on clases.id_clase=horarios.id_clase)
    join sesiones on sesiones.id_horario=horarios.id_horario)
    join aulas on aulas.id_aula=sesiones.id_aula) 
    join materias on clases.clv_materia=materias.clv_materia)
    where clv_profe='$idProfe' AND clases.clv_profe='$idProfe'";
    $result = consultToDB($sql);
    getHorarioProfe($result);

    $conexion->close();
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}

?>