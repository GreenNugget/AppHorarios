<?php
/*
*This file is used to consult the information from the schedules of the users
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
*Function to make a consult to the database
*@param $sentence of the consult
*@return the mysql result
*@version 0.2
*/
function consultToDB($sentence){
    $conexion = connectToDB();
    $sql = $sentence;
    return $conexion->query($sql);
}

/* 
*Function to get the schedule of the student
*@param $result the mysql result
*@return the schedule of the student according to his group, in JSON format
*@version 0.3
*/
function getScheduleAlum($result){
    $horariosJSON='';
    while ($fila = mysqli_fetch_assoc($result)) {

        $horariosArray = array(
            'profesor' => $fila['nombre_profesor'],
            'materia' => $fila['nombre_mate'],
            'sesiones' => $fila['sesiones'],
            'aula' => $fila['descripcion']
        );

        $auxiliar = json_encode($horariosArray);
        $horariosJSON = $horariosJSON . $auxiliar . ",";
    }
    return $horariosJSON;
}

/* 
*Function to get the schedule of the professor
*@param $result the mysql result
*@return the schedule of the professor according to his id, in JSON format
*@version 0.3
*/
function getScheduleProf($result){
    $horariosJSON = '';
    while ($fila = mysqli_fetch_assoc($result)) {

        $horariosArray = array(
            'materia' => $fila['nombre_mate'],
            'sesiones' => $fila['sesiones'],
            'aula' => $fila['descripcion']
        );

        $auxiliar = json_encode($horariosArray);
        $horariosJSON = $horariosJSON . $auxiliar . ",";
    }
    return $horariosJSON;
}

?>