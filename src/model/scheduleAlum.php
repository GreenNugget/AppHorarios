<?php
include 'functions.php';

$idGroup = "G123";//Aquí se cambiaría por el valor del grupo obtenido de acuerdo al alumno

if($conexion = connectToDB()){

    //Consulta para obtener los datos del horario
    $sql = "select descripcion, sesiones, nombre_profesor, nombre_mate from
    ((((horarios join clases on horarios.id_clase=clases.id_clase)
    join aulas on horarios.id_aula=aulas.id_aula)
    join materias on clases.clv_materia=materias.clv_materia)
    join profesores on clases.clv_profe=profesores.clv_profe) where id_grupo='$idGroup'";
    $result = consultToDB($sql);
    getHorarioAlumno($result);


    $conexion->close();//Se cierra la conexión por fin
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}

?>