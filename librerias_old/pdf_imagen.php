<?php
$im = new imagick('file.pdf[0]'); //Donde [0] es la página principal
$im->setImageFormat( "jpg" );
header( "Content-Type: image/jpeg" );
echo $im;
?> 