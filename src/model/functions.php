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

/* Function to get the Id's of the group */
function getSessionsId($idGroup){
    $result = consultToDB("select clv_sesion from (sesiones join horarios on sesiones.id_horario=horarios.id_horario) where id_grupo='$idGroup'");

    $id_session[] = "";
    while ($fila = mysqli_fetch_assoc($result)) {
        $id_session[] = $fila['clv_sesion'];
    }
    unset($id_session[0]);
        
    return $id_session;
}

function getHorarioId($idGroup){
    $result = consultToDB("select id_horario from (horarios join clases) where id_grupo='$idGroup' AND horarios.id_clase=clases.id_clase");

    $idHorarios[] = "";
    while ($fila = mysqli_fetch_assoc($result)) {
        $idHorarios[] = $fila['id_horario'];
    }
    unset($idHorarios[0]);
    
    return $idHorarios;
}

?>