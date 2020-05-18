<?php
function connectToDB(){
    $dbInfo = json_decode(file_get_contents("db_info.json"));
    return mysqli_connect($dbInfo->host, $dbInfo->user, $dbInfo->password, $dbInfo->database);
}

/* Function to get the key of the profesor, the subject or the classroom based on the name */
function getKey($table, $name){
    $conexion = connectToDB();
    $sql = '';

    if ($table == 'profesores') {
        $sql = "select clv_profe from profesores where nombre_profesor='$name'";
    } elseif ($table == 'materias') {
        $sql = "select clv_materia from materias where nombre_mate='$name'";
    } elseif ($table == 'aulas') {
        $sql = "select id_aula from aulas where descripcion='$name'";
    }

    $result = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_row($result)) {
        return trim($row[0]);
    }
}

/* Function to get the class id */
function getClassID($profKey,$subjKey){

    $conexion =connectToDB();

    $sql = "select id_clase from clases where clv_profe='$profKey' and clv_materia='$subjKey'";

    $result = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_row($result)) {
        return trim($row[0]);
    }
}

?>