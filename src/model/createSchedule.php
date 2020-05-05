<?php
include 'functions_insert.php';

//we receive a JSON format
$horariosJSON = file_get_contents("a.json");

$conexion = connectToDB();
if ($conexion){
    $horariosDecoded = json_decode($horariosJSON);
    
    foreach ($horariosDecoded->clases as $mydata) {
        $group = $horariosDecoded->nombreGrupo;
        $idClass = createNewId('clases');
        $idSched = createNewId('horarios');
        $clv_Profe = getKey('profesores', $mydata->profesor->nombre_profesor); //nombre del prof
        $clv_Subj = getKey('materias', $mydata->materia->nombre_mate); //nombre de la materia
        $clv_classroom = getKey('aulas', $mydata->aula->descripcion); //nombre del aula
        $sesiones = json_encode($mydata->sesiones); //JSON de las sesiones
        
        $sql_class = "INSERT INTO `clases` (`id_clase`, `clv_profe`, `clv_materia`) VALUES ('$idClass', '$clv_Profe', '$clv_Subj')";
        $resultado = $conexion->query($sql_class);

        if ($resultado) {
            echo "SE GUARDÓ LA CLASE<br>";
        }
        
        $sql_schedule = "INSERT INTO `horarios` (`id_horario`, `id_grupo`, `id_clase`,`id_aula`, `sesiones`) VALUES ('$idSched', '$group', '$idClass', '$clv_classroom', '$sesiones')";
        $resultado = $conexion->query($sql_schedule);
        
        if ($resultado) {
            echo "<br>SE GUARDÓ EL HORARIO";
        }

    }
    $conexion->close();
}

?>