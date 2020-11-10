<?php

$data = $_POST["data"];

$data = substr($data , mb_strlen($data, 'utf8') - 1);

for($j = 0; $j < 99999999 ; $j++) {
}

echo "Enviaste el valor de " . $data;

?>