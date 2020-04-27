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
    }elseif($table == 'sesiones'){
        $sql = "SELECT MAX(clv_sesion) AS clv_sesion FROM sesiones";
    }

    $resultado = mysqli_query($conexion,$sql);
    if ($row = mysqli_fetch_row($resultado)) {
        return trim($row[0]);
    }else{
        if ($table == 'clases') {
            return 'C001';
        } elseif ($table == 'horarios') {
            return 'H001';
        } elseif ($table == 'sesiones') {
            return 'S001';
        }
    }

}

/* Function to create a new key to insert data into the right table */
function createNewId($table){
    $actualId = getLastID($table);
    /*This is just a trial
    echo "<br>";
    echo "EL ACTUAL ID DE " . $table . " ES: " . $actualId;
    echo "<br>";*/
    $aux = substr($actualId,1);//The letter of the key is subtracted to increase the index
    $aux++;//the index is increased
    if(strlen($aux)==1){
        $aux = '00' . $aux;
    }elseif(strlen($aux)==2){
        $aux = '0' . $aux;
    }

    $newId = "";//The start of the key is concatenated according to the table
    if ($table == 'clases') {
        $newId = 'C' . $aux;
    } elseif ($table == 'horarios') {
        $newId = 'H' . $aux;
    } elseif ($table == 'sesiones') {
        $newId = 'S' . $aux;
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