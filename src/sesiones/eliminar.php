<?php

session_start();

require 'database.php';

//Se piden los datos a utilizar
$id_materia = $_POST['clv_materia'];
$id_profesor = $_POST['clv_profe'];
$id_grupo = $_POST['id_grupo'];
$sesion = $_POST['sesion'];

//llama una sesion y se verifica si son iguales
function verificarSesion($sesion, $id_grupo, $id_clase){
    global $conn;
    $record = $conn->prepare('SELECT sesiones FROM horarios WHERE id_grupo = :id_grupo AND id_clase = :id_clase');
    $record->bindParam(':id_grupo', $id_grupo);
    $record->bindParam(':id_clase', $id_clase);
    $record->execute();
    $result = $record->fetch(PDO::FETCH_ASSOC);
    if($sesion == $result['sesiones']){
        return false;
    }else{
        return true;
    }
}

//se obtiene la clase
function obtenerClase($id_profesor, $id_materia){
    global $conn;
    if(!empty($id_profesor) && !empty($id_materia)){
        $record = $conn->prepare('SELECT id_clase FROM clases WHERE clv_materia = :id_materia AND clv_profe = :id_profesor');
        $record->bindParam(':id_materia', $id_materia);
        $record->bindParam(':id_profesor', $id_profesor);
        $record->execute();
        $result = $record->fetch(PDO::FETCH_ASSOC);
        $id_clase = $result['id_clase'];
        return $id_clase;
    }
    return null;
}

//funcion para eliminar una horario completo
function eliminarHorario($id_grupo, $id_materia, $id_profesor){

    global $conn;
    $eliminarClase = false;//es booleano
    $id_clase = obtenerClase($id_profesor, $id_materia);
    
    if($id_clase!=null){
        $record = $conn->prepare('SELECT id_grupo FROM horarios WHERE id_clase = :id_clase');
        $record->bindParam(':id_clase', $id_clase);
        $record->execute();
        $result = $record->fetchAll(PDO::FETCH_COLUMN);

        if(count(array_unique($result))==1){
            $eliminarClase = true;
        }

        $record = $conn->prepare('DELETE FROM horarios WHERE id_grupo = :id_grupo AND id_clase = :id_clase');
        $record->bindParam(':id_grupo', $id_grupo);
        $record->bindParam(':id_clase', $id_clase);
        $record->execute();

        if($eliminarClase){
            $record = $conn->prepare('DELETE FROM clases WHERE id_clase =:id_clase');
            $record->bindParam(':id_clase', $id_clase);
            $record->execute();
        }
        //header("Location: /sesiones/frontelimina.html");//redireccionar al front del login (cambiar)
    }
}

//se actualiza la sesion
function eliminarSesion($id_grupo, $id_materia, $id_profesor, $sesion){
    global $conn;
    $id_clase = obtenerClase($id_profesor, $id_materia);
    if(verificarSesion($sesion, $id_grupo, $id_clase)){
        $record = $conn->prepare('UPDATE horarios SET sesiones=:sesion WHERE id_grupo = :id_grupo AND id_clase = :id_clase');
        $record->bindParam(':sesion', $sesion);
        $record->bindParam(':id_grupo', $id_grupo);
        $record->bindParam(':id_clase', $id_clase);
        $record->execute();  
    }

}

eliminarHorario($id_grupo, $id_materia, $id_profesor);

eliminarSesion($id_grupo, $id_materia, $id_profesor, $sesion);



?>