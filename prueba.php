<?php

//incluímos la clase ajax
//require ('./xajax/xajax_core/xajaxPluginManager.inc.php');
require ('../class/xajax_core/xajax.inc.php');
$xajax = new xajax();
$xajax->configure('javascript URI', '../class/');


//instanciamos el objeto de la clase xajax

/*
class prototypeui extends xajaxResponsePlugin
{
    var $sCallName = "prototypeui";
    
    function fade($id) {
        $this->objResponse->script("new Effect.Fade($id);");
    }
    function appear($id) {
        $this->objResponse->script("new Effect.Appear($id)");
    }
}



$pluginManager = &xajaxPluginManager::getInstance();
//$pluginManager->registerResponsePlugin(new scriptaculous());
$pluginManager->registerPlugin(new prototypeui());

function si_no($entrada){
   if ($entrada=="true"){
       $salida = "Marcado";
   }else{
       $salida = "No marcado";
   }

   //instanciamos el objeto para generar la respuesta con ajax
   $respuesta = new xajaxResponse();
   //escribimos en la capa con id="respuesta" el texto que aparece en $salida
   $respuesta->addAssign("respuesta","innerHTML",$salida);

   //tenemos que devolver la instanciación del objeto xajaxResponse
   return $respuesta;
}

function pruebaplugins() {
    $objResponse = new xajaxResponse();
 
    //PHP4 or PHP5 Plugin Syntax
    $objResponse->plugin("scriptaculous", "fade", "prueba");
 
    return $objResponse;
}
*/
function appear() {
    $objResponse = new xajaxResponse();
	$script='$(function() {
		// run the currently selected effect
		function runEffect() {
			// get effect type from 
			var selectedEffect = $( "#effectTypes" ).val();

			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect === "scale" ) {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}

			// run the effect
			$( "#effect" ).show( selectedEffect, options, 500, callback );
		};

		//callback function to bring a hidden box back
		function callback() {
			setTimeout(function() {
				$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
			}, 1000 );
		};

		// set effect from select menu value
		$( "#button" ).click(function() {
			//runEffect();
			//return false;
			alert("Hola");
		});

		$( "#effect" ).hide();
	});';
    $objResponse->script($script);

    return $objResponse;
}



//asociamos la función creada anteriormente al objeto xajax
//$xajax->registerFunction("si_no");
//$xajax->registerFunction("pruebaplugins");
$xajax->registerFunction("appear");
//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();








?>




<html>
<head>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="Stylesheet" />	
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.14.custom.min.js"></script>
   
   <?php
  $xajax->printJavascript();
   ?>

<style>
	.toggler { width: 500px; height: 200px; }
	#button { padding: .5em 1em; text-decoration: none; }
	#effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
	#effect h3 { margin: 0; padding: 0.4em; text-align: center; }
	</style>	

<body onload='xajax_appear();'>
Hola
<div class="demo">

<div class="toggler">
	<div id="effect" class="ui-widget-content ui-corner-all">
		<h3 class="ui-widget-header ui-corner-all">Show</h3>
		<p>
			Etiam libero neque, luctus a, eleifend nec, semper at, lorem. Sed pede. Nulla lorem metus, adipiscing ut, luctus sed, hendrerit vitae, mi.
		</p>
	</div>
</div>

<select name="effects" id="effectTypes">
	<option value="blind">Blind</option>
	<option value="bounce">Bounce</option>
	<option value="clip">Clip</option>
	<option value="drop">Drop</option>
	<option value="explode">Explode</option>
	<option value="fold">Fold</option>
	<option value="highlight">Highlight</option>
	<option value="puff">Puff</option>
	<option value="pulsate">Pulsate</option>
	<option value="scale">Scale</option>
	<option value="shake">Shake</option>
	<option value="size">Size</option>
	<option value="slide">Slide</option>
</select>

<a href="#" id="button" class="ui-state-default ui-corner-all">Run Effect</a>

</div><!-- End demo -->



<div style="display: none;" class="demo-description">
<p>Click the button above to preview the effect.</p>
</div><!-- End demo-description -->
</body>


</html> 
