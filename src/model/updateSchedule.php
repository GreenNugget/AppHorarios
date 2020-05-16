<?php
include 'functions_update.php';

$horariosJSON = file_get_contents("info.json");

$isUpdated = false;
$conexion = connectToDB();
if ($conexion){
    $horariosDecoded = json_decode($horariosJSON);

    foreach ($horariosDecoded->clases as $clases) {
        $group = $horariosDecoded->nombreGrupo;
        $clv_Profe = getKey('profesores', $clases->profesor->nombre_profesor);
        $clv_Subj = getKey('materias', $clases->materia->nombre_mate);
        $clv_classroom = getKey('aulas', $clases->aula->descripcion);
        $sesiones = json_encode($clases->sesiones); 

        $classId = getClassID($clv_Profe,$clv_Subj);

        $sql = "UPDATE `horarios` SET `sesiones`='$sesiones' WHERE `id_clase`='$classId'";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            $isUpdated = true;
        }
    }
    $conexion->close();
}

if($isUpdated){
    echo "Se logró";
}

?>