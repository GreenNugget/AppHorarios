<?php
/*
*This file contains all the functions that are necessary to insert the information of the schedules
* in the database
*
*@author Naomi G.
*@version 0.5
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
*This function recovers the last id from the database that was saved
*@param $table the name of the table (clases or horarios) from whichh we need the id
*@return the last id, as a string
*@version 0.3
*/
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

/*
*Function to create a new key to insert data into the right table 
*@param $table the name of the table for which the id will be created
*@return the new id, as a string
*@version 0.3
*/
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

/*
*Function to get the key of the profesor, the subject or the classroom based on the name
*
*@param $table the name of the table from which we want the key
*@param $name the name of the object from which we need the key
*@return the key of the object, as a string
*@version 0.2
*/
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