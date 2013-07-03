<?php
	require ('../class/dbconnect.php');
	require ('../class/xajax_core/xajax.inc.php');
	$xajax=new xajax();	
	$xajax->configure('javascript URI', '../class/');
 	date_default_timezone_set('America/Lima');
        
    $nameFile = $_GET["nf"];
    $today = date("Y/m/d H:i:s ");
    
    /*
    $logfile = fopen("/datos/its/".$_GET["nf"].".log","a");
    fwrite($logfile, $today.$nameFile."\n");
    fclose($logfile);
    */
    function pasaValor(){
        $objResponse = new xajaxResponse();
        $objResponse->alert("$nameFile - ".$_GET["sub"]);
        return $objResponse;
    }

    $xajax->registerFunction('pasaValor');    
    $xajax->printJavascript();
    
    echo "<html><body onload='xajax_pasaValor();'></body></html>";
    

/*    
    //Los archivos se ubican segun la subcategoria
    if($_GET["sub"]==1){
        $path="/datos/its/publicaciones/articulos_indexados/";
    }
    if($_GET["sub"]==2){
        $path="/datos/its/publicaciones/tesis/";
    }
    if($_GET["sub"]==3){
        $path="/datos/its/publicaciones/otras_publicaciones/";
    }

    if($_GET["sub"]==4){
        $path="/datos/its/ponencias/";
    }
    if($_GET["sub"]==5){
        $path="/datos/its/asuntos_academicos/charlas_internas/";
    }
    if($_GET["sub"]==6){
        $path="/datos/its/informacion_interna/reportes_tecnicos/";
    }
    if($_GET["sub"]==7){
        $path="/datos/its/informacion_interna/informes_trimestrales/";
    }
    if($_GET["sub"]==8){
        $path="/datos/its/informacion_interna/boletines/";
    }
    if($_GET["sub"]==11){
        $path="/datos/its/asuntos_academicos/compendios/";
    }



    if(file_exists($path.$nameFile)){

        $handle= fopen($path.$nameFile,"r");
        $content = stream_get_contents($handle);
        fclose($handle);
        header( "Content-Type: application/octet-stream");
        header( "Content-Disposition: attachment; filename=".$nameFile."");
        print($content);
    }
*/
?>
