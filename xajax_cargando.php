<?php
require ('../class/xajax_core/xajax.inc.php');

function funcion_lenta()
{
sleep(3);

$objResponse = new xajaxResponse();
$objResponse->Assign("capa_actualiza","innerHTML","Finalizado");

return $objResponse;
}

$xajax = new xajax();
$xajax->register(XAJAX_FUNCTION, 'funcion_lenta');
$xajax->processRequest();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Ejemplo de mostrar un aviso de carga de la página</title>
<?php
$xajax->printJavascript("../class/");
?>
   <script type="text/javascript">
   <!--
   function muestra_cargando(){
      xajax.dom.create("capa_actualiza","div", "cargando");
      xajax.$('cargando').innerHTML='<img src="img/loading.gif" alt="cargando..." width="16" height="16" border="0">';
   }
   function oculta_cargando(){
      alert("cargado");
   }
   
   xajax.callback.global.onResponseDelay = muestra_cargando;
   xajax.callback.global.onComplete = oculta_cargando;
   // --></script>
</head>

<body>

<div id="capa_actualiza">
<a href="javascript:void(xajax_funcion_lenta())">Llamar con ajax a una función que tarda en cargar</a>!
</div>

</body>
</html> 
