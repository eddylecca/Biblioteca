<?php

date_default_timezone_set('America/Lima');

    session_start();

        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
            @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
            unset($_SESSION['tmp']['ruta_pdf_temporal']);
        }

$tipo = substr($_FILES['fileUpload']['type'], -3);

//  Definimos Directorio donde se guarda el archivo
$dir = '../tmpUpload/';
//$codPublicacionesEdit=$_POST['codPublicaciones'];
$date_in=$_POST['date_in'];

$ano=$_POST['ano'];

//if($_SESSION["tipoDocumento"]!=4){
    $tipoDocumento=str_replace("_","",$_SESSION["tipoDocumento"]);
    $subcategory=str_replace("_","",$_SESSION["subcategory"]);
/*}
else{
    $tipoDocumento="ponencia";
    $subcategory="ponencia";

}
*/
    
$codArea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";

$idtypedocument=isset($_SESSION["idtypedocument"])?$_SESSION["idtypedocument"]:0;
$idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;

$nro=1;
$fecha=date("Y-m-d");
$hora=date("H:i:s");
$strtotime=strtotime ("now");
    $codigo="IGP-".$codArea."-".$idtypedocument."-".$idsubcategory."-".$strtotime;
//$archivoUpload=$fecha."_".$hora."_".$codigo.".pdf";
$archivoUpload=$codigo.".pdf";
//$archivoPortada=$fecha."_".$hora."_".$codigo;


       $destino=$dir.$archivoUpload;


//  Intentamos Subir Archivo
//  (1) Comprovamos que existe el nombre temporal del archivo
if ($_FILES['fileUpload']['tmp_name']!="") {
    
        //  (2) - Comprobamos de que archivo se trata 
     if ($tipo == 'jpg' or $tipo == 'png') {
             //echo '<script>alert("Hola")</script>';
             //echo '<script>parent.efectoUpload();</script>';
        //  (3) Por ultimo se intenta copiar el archivo al servidor.
        if (!copy($_FILES['fileUpload']['tmp_name'],$destino)){
                echo '<script> alert("Error al Subir el Archivo");</script>';
            }
        else{
                    
/******Convierte la primera pagina del pdf en una imágen png*****/
//exec("convert ".$destino."[0] ".$dir.$archivoPortada.".png");
/****************************************************************/
                    
                    
                    if(is_uploaded_file($_FILES['fileUpload']['tmp_name'])){
                        sleep(3);
                        echo '<script>parent.resultadoUpload(0, "'.$archivoUpload.'");</script>';        
                        //echo '<script>parent.efectoUpload2();</script>';
                        //echo '<script>alert("Hola")</script>';
                    }
                            //echo '<script>parent.document.getElementById("boton_guardar").innerHTML="<font color=green>Se terminó de subir</font>";</script>';

        }
    }
     else{
        //El Archivo que se intenta subir NO ES del tipo PDF.       
                echo '<script>parent.resultadoUpload(2, "'.$archivoUpload.'");</script>';
                
         }
}
else {
    //echo '<script> alert("El Archivo no ha llegado al Servidor.");</script>';
    echo '<script>parent.resultadoUpload(1, "'.$archivoUpload.'");</script>';
}

echo '<p>Nombre Temporal: '.$_FILES['fileUpload']['tmp_name'].'</p>';
echo '<p>Nombre en el Server: '.$archivoUpload;
echo '<p>Tipo de Archivo: '.$_FILES['fileUpload']['type'];

if(isset($_SESSION["edit"])){
    $_SESSION["edit"]["pdf_upload"]=$archivoUpload;

    $_SESSION["edit"]["ruta_pdf_temporal"]="tmpUpload/".$archivoUpload;
}
elseif(isset($_SESSION["tmp"])){
    $_SESSION["tmp"]["pdf"]=$archivoUpload;

    $_SESSION["tmp"]["ruta_pdf_temporal"]="tmpUpload/".$archivoUpload;
}
/*
echo '<p>Codigo: '.$_POST['codPublicaciones'];
echo '<p>Date: '.$date_in;
echo '<p>Tipo Documento: '.$_POST['tipoDocumento'];
echo '<p>Tipo Publicacion: '.$_POST['tipoPublicacion'];
*/
//echo '<p>'.$queryBDa;
echo '<p>'.$destino;
echo '<br>';
echo '<p>';
print_r($_SESSION);

echo '<p>';


//createJpg($archivoUpload);
?>
