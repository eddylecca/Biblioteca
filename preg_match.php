<?php

// El caracter "i" despues del delimitador del patron indica una
// busqueda insensible a mayusculas/minusculas
if (preg_match("/Tavera/i", "Tavera")) {
    echo "Se ha encontrado una coincidencia.";
} else {
    echo "No se ha encontrado una coincidencia.";
}
?>
