<?php

function connectToDB(){
    return mysqli_connect('localhost', 'root', '', 'schedexproject');
}

/* Function to get the last Id from the schedules tables */
function getLastID($table){
    $conexion = connectToDB();
    $sql='';
    
    if($table=='clases'){
        $sql = "SELECT MAX(id_clase) AS id_clase FROM clases";
    }elseif($table == 'horarios'){
        $sql = "SELECT MAX(id_horario) AS id_horario FROM horarios";
    }

    $resultado = mysqli_query($conexion,$sql);
    if ($row = mysqli_fetch_row($resultado)) {
        return trim($row[0]);
    }else{
        return '0';
    }

}

/* Function to create a new key to insert data into the right table */
function createNewId($table){
    $actualId = getLastID($table);

    $actualId++;

    return $actualId;
}

/* Function to get the key of the profesor, the subject or the classroom based on the name */
function getKey($table,$name){
    $conexion = connectToDB();
    $sql = '';

    if ($table == 'profesores') {
        $sql = "select clv_profe from profesores where nombre_profesor='$name'";
    } elseif ($table == 'materias') {
        $sql = "select clv_materia from materias where nombre_mate='$name'";
    }elseif($table == 'aulas'){
        $sql = "select id_aula from aulas where descripcion='$name'";
    }

    $result = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_row($result)) {
        return trim($row[0]);
    }
}

?>