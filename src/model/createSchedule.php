<?php
include 'functions_insert.php';

//we receive a JSON format
$horariosJSON = '{
  "nombreGrupo": "A003",
  "clases": [
    {
      "profesor": {
        "nombre_profesor": "Juan Francisco Garcilazo Ortiz"
      },
      "materia": {
        "nombre_mate": "Construcción de Software",
        "hrs_semana": 4.5
      },
      "aula": {
        "descripcion": "Laboratorio 1"
      },
      "horarios": [
        {
          "dia": "Lunes",
          "inicio": 6,
          "final": 8
        },
        {
          "dia": "Martes",
          "inicio": 7,
          "final": 9
        }
      ]
    },
    {
      "profesor": {
        "nombre_profesor": "Maria Diodora Kantun Chim"
      },
      "materia": {
        "nombre_mate": "Aseguramiento de la calidad de Software",
        "hrs_semana": 4.5
      },
      "aula": {
        "descripcion": "CC8"
      },
      "horarios": [
        {
          "dia": "Jueves",
          "inicio": "7:00",
          "final": 8.5
        }
      ]
    }
  ]
}';


$horariosDecoded = json_decode($horariosJSON);
$counter = 1;
foreach ($horariosDecoded->clases as $mydata) {
    echo "HORARIO " . "$counter" . "<br>";
    echo $mydata->profesor->nombre_profesor . "<br>";
    echo $mydata->materia->nombre_mate . "<br>";
    echo $mydata->aula->descripcion . "<br>";
    foreach ($mydata->horarios as $values) {
        echo $values->dia . "<br> ";
        echo $values->inicio . "<br> ";
        echo $values->final . "<br> ";
    }
    echo "-------------------------------------";
    $counter++;
}


/*
//We need some keys to add rows to the tables, so we search them
$idClass= createNewId('clases');
$idSched = createNewId('horarios');
$idSession = createNewId('sesiones');
$clv_Profe = getKey('profesores',$profesor_name);
$clv_Subj = getKey('materias',$subject_name);
$clv_classroom = getKey('aulas',$classroom);

$conexion = connectToDB();
if($conexion){
    $sql_class = "INSERT INTO `clases` (`id_clase`, `clv_profe`, `clv_materia`, `hora_inicio`, `hora_final`) VALUES ('$idClass', '$clv_Profe', '$clv_Subj', '$start_hour', '$finish_hour')";
    $resultado = $conexion->query($sql_class);

    if ($resultado) {
        echo "SE GUARDÓ LA CLASE";
    }

    $sql_schedule = "INSERT INTO `horarios` (`id_horario`, `id_grupo`, `id_clase`) VALUES ('$idSched', '$group', '$idClass')";
    $resultado = $conexion->query($sql_schedule);

    if ($resultado) {
        echo "SE GUARDÓ EL HORARIO";
    }

    $sql_session = "INSERT INTO `sesiones` (`clv_sesion`, `id_aula`, `id_horario`, `dias_impartidos`) VALUES ('$idSession', '$clv_classroom', '$idSched', '$day')";
    $resultado = $conexion->query($sql_session);

    if ($resultado) {
        echo "SE GUARDÓ LA SESIÓN";
    }

    $conexion->close();
}*/

?>