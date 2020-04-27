<?php
include 'functions_insert.php';

$idClass= createNewId('clases');
$idHorar = createNewId('horarios');
$idSession = createNewId('sesiones');

/*This is just a trialx2
echo "<br>";
echo "<br> FINALES:";
echo "<br>";
echo $idClass;
echo "<br>";
echo $idHorar;
echo "<br>";
echo $idSession;*/
/*
$conexion = connectToDB();
if($conexion){
    $sql = "INSERT INTO `usuarios` (`role`, `userName`, `userPassword`) VALUES ('1', 'prueba', 'pruebita1')";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo "SE GUARDÓ TODO BRO";
    }
    $conexion->close();
}*/

?>