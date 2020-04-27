<?php
include 'functions_insert.php';

//Logic to recover all the info (JSON format)

//Then we are supposed to have all the data that is required to fill the table in the db, like this:
$day = 'Lunes';
$group = 'G789';
$classroom = 'C5';
$start_hour = '01:30';
$finish_hour = '03:00';
$profesor_name = 'Luis Mario Góngora León';
$subject_name = 'Bases de datos';

//We need some keys to add rows to the tables, so we search them
$idClass= createNewId('clases');
$idSched = createNewId('horarios');
$idSession = createNewId('sesiones');
$clv_Profe = getKey('profesores',$profesor_name);
$clv_Subj = getKey('materias',$subject_name);
$clv_classroom = getKey('aulas',$classroom);

$conexion = connectToDB();
if($conexion){
    $sql_class = "INSERT INTO `clases` (`id_clase`, `clv_profe`, `clv_materia`, `hora_inicio`, `hora_final`) VALUES ('$idClass', '$clv_Profe', '$clv_Subj', '$start_hour', '$finish_hour')";
    $resultado = $conexion->query($sql_class);

    if ($resultado) {
        echo "SE GUARDÓ LA CLASE";
    }

    $sql_schedule = "INSERT INTO `horarios` (`id_horario`, `id_grupo`, `id_clase`) VALUES ('$idSched', '$group', '$idClass')";
    $resultado = $conexion->query($sql_schedule);

    if ($resultado) {
        echo "SE GUARDÓ EL HORARIO";
    }

    $sql_session = "INSERT INTO `sesiones` (`clv_sesion`, `id_aula`, `id_horario`, `dias_impartidos`) VALUES ('$idSession', '$clv_classroom', '$idSched', '$day')";
    $resultado = $conexion->query($sql_session);

    if ($resultado) {
        echo "SE GUARDÓ LA SESIÓN";
    }

    $conexion->close();
}

?>