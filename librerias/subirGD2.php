<?php
function redimensionar($type, $img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
{
$defecto = 'img/defecto.jpg';
if(file_exists($img_original)) {
// crear imagen desde original
$type=strtolower($type);
switch($type)
{
case 'jpeg': $img = ImageCreateFromJPEG($img_original); break;
case 'jpg': $img = ImageCreateFromJPEG($img_original); break;
case 'png': $img = ImageCreateFromPNG($img_original); break;
case 'gif': $img = ImageCreateFromGIF($img_original); break;
case 'wbmp': $img = ImageCreateFromWBMP($img_original); break;
default: $img = ImageCreateFromJPEG($defecto); break;
}
} else {
$img = ImageCreateFromJPEG($defecto);
}
if(!empty($img)) {
$new_w_R = ImageSX($img);
$new_h_R = ImageSY($img);
//$img_nueva_altura = 50;
// se calcula la relación alto/ancho
$aspect_ratio = $new_h_R/$new_w_R;
$aspect_ratio2 = $new_w_R/$new_h_R;
if ($new_w_R >= $new_h_R){
// se ajusta al nuevo tamaño
$img_nueva_altura = abs($img_nueva_anchura * $aspect_ratio);
}
else{$img_nueva_anchura = abs($img_nueva_altura * $aspect_ratio2);}
// crear imagen nueva

$thumb = ImageCreateTrueColor($img_nueva_anchura,$img_nueva_altura);
// redimensionar imagen original copiandola en la imagen. La imagen se reajustará al nuevo tamaño
ImageCopyResampled($thumb,$img,0,0,0,0,$img_nueva_anchura,
$img_nueva_altura,ImageSX($img),ImageSY($img));
// guardar la imagen redimensionada donde indica $img_nueva
ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
}
}

//inseción de imagen
//$fileName = $max."_".$_FILES['userfile']['name'];
$extension = explode(".",$_FILES['userfile']['name']);
//$fileName = $extension[0].".".$extension[1];
$fileName = $referencia.".".$extension[1];
$tmpName = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
//echo $tmpName;
$uploaddir = "../upload/fotos/";
$uploadfile = $uploaddir . $fileName ;

if (move_uploaded_file($tmpName, $uploadfile)) {
chmod($uploadfile, 0644);
//echo "File is valid, and was successfully uploaded.\n";
//redimensionar
$source=$uploadfile; // archivo de origen
$dest=$uploaddir.$referencia."th.".$extension[1]; // archivo de destino
$dest2=$uploaddir.$referencia.".".$extension[1]; // archivo de destino
// echo "nuevoarchivo ".$dest;
/* $img_nueva_anchura=120;
$img_nueva_altura=120;
$img_nueva_calidad=100;*/
//redimensionar_jpeg($source,$dest,$img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad);
// Ejemplo
redimensionar("jpg",$source,$dest,120,120,95);
redimensionar("jpg",$source,$dest2,500,500,95);
//finredimensionar
} else {
// echo "Possible file upload attack!\n";
//echo 'Here is some more debugging info:';
//print_r($_FILES);
}
?>
