<?php

/* Function to know if the connection to the db was successful */
function connectToDB(){
    return mysqli_connect('localhost', 'root', '', 'schedexproject');
}

/* Function to make a consult to the db*/
function consultToDB($sentence){
    $conexion = connectToDB();
    $sql = $sentence;
    return $conexion->query($sql);
}

function getHorarioAlumno($result){
    $horariosJSON='';
    while ($fila = mysqli_fetch_assoc($result)) {

        $horariosArray = array(
            'profesor' => $fila['nombre_profesor'],
            'materia' => $fila['nombre_mate'],
            'sesiones' => $fila['sesiones'],
            'aula' => $fila['descripcion']
        );

        $auxiliar = json_encode($horariosArray);
        $horariosJSON = $horariosJSON . $auxiliar;
    }
    echo $horariosJSON;
}

function getHorarioProfe($result){
    while ($fila = mysqli_fetch_assoc($result)) {

        $horariosArray = array(
            'materia' => $fila['nombre_mate'],
            'hInicio' => $fila['hora_inicio'],
            'hFinal' => $fila['hora_final'],
            'diasImp' => $fila['dias_impartidos'],
            'aula' => $fila['descripcion']
        );

        $horariosJSON = json_encode($horariosArray);
        echo $horariosJSON; //Luego de esto iría la parte para enviarlo al js para mandarlo a la vista
        echo "<br>";
    }
}

?>