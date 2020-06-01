<?php
/*
*This file receives the information of the new schedules and push it into the database
*In this file we call another one that contains functions that are mandatory to insert the information
*
*@author Naomi G.
*@version 0.5
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

include 'functions_insert.php';

$horariosJSON = $_POST['horarios'];

$isSaved = false;
$conexion = connectToDB();
if ($conexion){
    $horariosDecoded = json_decode($horariosJSON);//we extract the info
    
    foreach ($horariosDecoded->clases as $clases) {
        $group = $horariosDecoded->nombreGrupo;
        $idClass = createNewId('clases', $conexion);
        $idSched = createNewId('horarios', $conexion);
        $clv_Profe = getKey('profesores', $clases->profesor->nombre_profesor, $conexion);
        $clv_Subj = getKey('materias', $clases->materia->nombre_mate, $conexion);
        $clv_classroom = getKey('aulas', $clases->aula->descripcion, $conexion);
        $sesiones = json_encode($clases->sesiones);
        
        $sql_class = "INSERT INTO `clases` (`id_clase`, `clv_profe`, `clv_materia`) VALUES ('$idClass', '$clv_Profe', '$clv_Subj')";
        $resultado = $conexion->query($sql_class);

        if ($resultado) {
            $isSaved = true;
        }
        
        $sql_schedule = "INSERT INTO `horarios` (`id_horario`, `id_grupo`, `id_clase`,`id_aula`, `sesiones`) VALUES ('$idSched', '$group', '$idClass', '$clv_classroom', '$sesiones')";
        $resultado = $conexion->query($sql_schedule);
        
        if (!$resultado) {
            $isSaved = false;
        }

    }
    $conexion->close();
}

if($isSaved = true){
    //We can put a message to tell the admin that the data was saved;
}

?>