<?php

date_default_timezone_set('America/Lima');
        
$nameFile = $_GET["nf"];
$logfile = fopen("data/".$_GET["nf"].".log","a");
$today = date("Y/m/d H:i:s ");
fwrite($logfile, $today.$nameFile."\n");
fclose($logfile);

//Los archivos se ubican segun la subcategoria
if($_GET["sub"]==1){
	$path="data/publicaciones/articulos_indexados/";
}
if($_GET["sub"]==2){
	$path="data/publicaciones/tesis/";
}
if($_GET["sub"]==3){
	$path="data/publicaciones/otras_publicaciones/";
}

if($_GET["sub"]==4){
	$path="data/ponencias/";
}
if($_GET["sub"]==5){
	$path="data/asuntos_academicos/charlas_internas/";
}
if($_GET["sub"]==6){
	$path="data/informacion_interna/reportes_tecnicos/";
}
if($_GET["sub"]==7){
	$path="data/informacion_interna/informes_trimestrales/";
}
if($_GET["sub"]==8){
	$path="data/informacion_interna/boletines/";
}
if($_GET["sub"]==11){
	$path="data/asuntos_academicos/compendios/";
}
if($_GET["sub"]==12){
	$path="data/asuntos_academicos/informes_trimestrales/";
}



if(file_exists($path.$nameFile)){

	$handle= fopen($path.$nameFile,"r");
	$content = stream_get_contents($handle);
	fclose($handle);
	header( "Content-Type: application/octet-stream");
	header( "Content-Disposition: attachment; filename=".$nameFile."");
	print($content);
}
else{
	print("No se encuentra el archivo");
        header("refresh:1; URL=admin.php");
}



?>
