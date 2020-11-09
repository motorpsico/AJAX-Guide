<?php

$data = $_POST["data"];

$data = substr($data , mb_strlen($data, 'utf8') - 1);

echo "Enviaste el valor de " . $data;

?>