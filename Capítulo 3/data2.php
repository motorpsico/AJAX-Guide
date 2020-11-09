<?php

function imprimirLista() {
    echo "<ul>";
    for($i = 0 ; $i < 10; $i++) {
        echo "<li>Elemento". $i ." </li>";
    }
    echo "</ul>";
}


imprimirLista();

?>

