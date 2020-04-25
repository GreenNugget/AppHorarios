<?php
include 'functions.php';

$idGroup = "G123";//Aquí se cambiaría por el valor del grupo obtenido de acuerdo al alumno

if($conexion = connectToDB()){

    //Consulta para obtener algunos datos del horario
    $sql = "select nombre_profesor,nombre_mate,hora_inicio,hora_final,dias_impartidos,descripcion from 
    (((((horarios join clases)
    join sesiones)join aulas on aulas.id_aula=sesiones.id_aula)
    join profesores on clases.clv_profe=profesores.clv_profe)
    join materias on clases.clv_materia=materias.clv_materia)
    where id_grupo='$idGroup' AND horarios.id_clase=clases.id_clase AND horarios.id_horario=sesiones.id_horario";
    $result = $conexion->query($sql);
    getHorariosData($result);


    $conexion->close();//Se cierra la conexión por fin
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}

?>