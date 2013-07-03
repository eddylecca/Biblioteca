<?php

$cadena="hay casas bonitas en Madrid"; 
$busqueda="n"; 
preg_match_all ("/[\s]*[\S]*".$busqueda."[\S]*[\s]/",$cadena,$salida); 
foreach ($salida[0] as $resultado){ 
    echo $resultado; 
} 
?>
