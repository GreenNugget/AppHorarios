<?php
function connectToDB(){
    return mysqli_connect('localhost', 'root', '', 'schedexproject');
}

function getTableID(){
    
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

?>