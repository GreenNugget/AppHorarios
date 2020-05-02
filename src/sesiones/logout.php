<?php
/*
Este archivo sirve para deslogear.
*/

session_start();

session_unset();

session_destroy();

header('Location: /sesiones');

?>