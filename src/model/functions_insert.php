<?php

function connectToDB(){
    $dbInfo = json_decode(file_get_contents("db_info.json"));
    return mysqli_connect($dbInfo->host, $dbInfo->user, $dbInfo->password, $dbInfo->database);
}

function getLastID($table){
    $conexion = connectToDB();
    $sql = '';

    if ($table == 'clases') {
        $sql = "SELECT MAX(id_clase) AS id_clase FROM clases";
    } elseif ($table == 'horarios') {
        $sql = "SELECT MAX(id_horario) AS id_horario FROM horarios";
    }

    $resultado = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_row($resultado)) {
        return trim($row[0]);
    } else {
        return '0';
    }
}

/* Function to create a new key to insert data into the right table */
function createNewId($table){
    $actualId = getLastID($table);

    $aux = substr($actualId, 1); //The letter of the key is subtracted to increase the index
    if($aux==0){
        $aux = 1;
    }else{
        $aux++;
    }

    if (strlen($aux) == 1) {
        $aux = '00' . $aux;
    } elseif (strlen($aux) == 2) {
        $aux = '0' . $aux;
    }

    $newId = ""; //The start of the key is concatenated according to the table
    if ($table == 'clases') {
        $newId = 'C' . $aux;
    } elseif ($table == 'horarios') {
        $newId = 'H' . $aux;
    }
    return $newId;
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