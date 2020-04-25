<?php
include 'functions.php';

$idGroup = "G123";

if($conexion = connectToDB()){
    $idHorario = getSessionsId("G123"); //Obtenemos todas las sesiones relacionadas con el grupo

    $sql = "select nombre_profesor,nombre_mate,hora_inicio,hora_final from 
    (((horarios join clases)
    join profesores on clases.clv_profe=profesores.clv_profe)
    join materias on clases.clv_materia=materias.clv_materia)
    where id_grupo='$idGroup' AND horarios.id_clase=clases.id_clase";

    $result = $conexion->query($sql);

    while ($fila = mysqli_fetch_assoc($result)){
        echo $fila['nombre_profesor'] . "/" . $fila['nombre_mate'] . "/" . $fila['hora_inicio'] . "/" . $fila['hora_final'];
        echo "<br>";
    }

    $conexion->close();
} else {
    echo 'alert("No se pudo conectar a la base de datos");';
}













/*
foreach ($idHorario as $clave => $valor) {
    echo "{$valor}";
}

$i = 1;
foreach ($hola as $clave => $valor) {
    echo $hola['saludo' . $i] . '<br>';
    $i++;
}


*/

?>