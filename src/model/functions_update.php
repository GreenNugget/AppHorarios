<?php
/*
*This file contains all the functions that are necessary to update the information of the schedules
*
*@author Naomi
*@version 0.4
*/

/* 
*This function execute the connection to the databse
*
*@return boolean True if the connection was successful and False if it wasn't
*@version 0.1
*/
function connectToDB(){
    $dbInfo = json_decode(file_get_contents("db_info.json"));
    return mysqli_connect($dbInfo->host, $dbInfo->user, $dbInfo->password, $dbInfo->database);
}

/*
*Function to get the key of the profesor, the subject or the classroom based on the name
*@param $table the name of the table from which we want the key
*@param $name the name of the object from which we need the key
*@return the key of the object, as a string
*@version 0.2
*/
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

/* Function to get the class id 
*@param $profKey key of the professor from which we need the class
*@param $subjKey key of the subject from which we need the class
*@return the id of the class, as a string
*@version 0.4
*/
function getClassID($profKey,$subjKey){
    $conexion =connectToDB();
    $sql = "select id_clase from clases where clv_profe='$profKey' and clv_materia='$subjKey'";
    $result = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_row($result)) {
        return trim($row[0]);
    }
}

?>