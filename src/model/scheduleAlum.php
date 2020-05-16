<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

include 'functions.php';

$idGroup = $_POST['id_grupo'];//Aquí se cambiaría por el valor del grupo obtenido de acuerdo al alumno

if($conexion = connectToDB()){
    
    $sql = "select descripcion, sesiones, nombre_profesor, nombre_mate from
    ((((horarios join clases on horarios.id_clase=clases.id_clase)
    join aulas on horarios.id_aula=aulas.id_aula)
    join materias on clases.clv_materia=materias.clv_materia)
    join profesores on clases.clv_profe=profesores.clv_profe) where id_grupo='$idGroup'";
    $result = consultToDB($sql);
    $schedule = getHorarioAlumno($result);

    echo substr($schedule,0,-1);//Se substrae la última coma para poder leer el JSON cuando se pida

    $conexion->close();//Se cierra la conexión por fin
} else {
    echo '<script>alert("No se pudo conectar a la base de datos");</script>';
}

?>