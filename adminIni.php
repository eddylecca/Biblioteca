<?php

function ini_TypeTesis(){
    $objResponse = new xajaxResponse;

    $html="<label class='left'>Tipo de Tesis</label>";
    $objResponse->script("xajax_comboTipoTesisShow(0,1)");
    $html.="<label class='left'>Pa&iacute;s:</label><input type='text' id='pais' name='pais' class='field' />
           <label class='left'>Universidad:</label><input type='text' id='uni' name='uni' class='field' />";
    $objResponse->assign('pais', 'innerHTML',$html);

return $objResponse;
}

	function iniEvento($divTitulo){
	    $titulo="Evento";
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		}
	
	    if(isset($recuperar["evento_description"])){
	        $evento_description=$recuperar["evento_description"];
	    }
	    else{
	        $evento_description="";
	    }
	
	    if(isset($recuperar["categoriaEvento_description"])){
	        $categoriaEvento_description=$recuperar["categoriaEvento_description"];
	    }
	    else{
	        $categoriaEvento_description="";
	    }
	
	
	
	    if(isset($recuperar["idcategoriaEvento"])){
	        $id=$recuperar["idcategoriaEvento"];
	    }
	    else{
	        $id=0;
	    }

	    if(isset($recuperar["claseEvento_description"])){
	        $claseEvento_description=$recuperar["claseEvento_description"];
	    }
	    else{
	        $claseEvento_description="";
	    }
            
	    if(isset($recuperar["idclaseEvento"])){
	        $idClase=$recuperar["idclaseEvento"];
	    }
	    else{
	        $idClase=0;
	    }
            
		$html="
	       <div class='campo-buscador'>Nombre del Evento:&nbsp;</div>
	       <div class='contenedor-caja-buscador-1'>
				<input type='text' onchange='xajax_registerNomEvento(this.value); return false;' value='$evento_description' id='evento' name='evento' class='caja-buscador-1'></p>
	       </div>
	       <div style='clear:both'></div>
	       <div class='campo-buscador' id='tit_categoriaEvento'>Categor&iacute;a Evento:</div>
	        <div class='contenedor-combo-buscador-1' id='categoriaEvento'>".comboCategoriaEvento($id)."</div>
	        <input type='hidden' value='$categoriaEvento_description' id='catEvento_txt' name='catEvento_txt' class='field'>
	        <div style='clear:both'></div>
                        
	       <div class='campo-buscador' id='tit_claseEvento'>Clase Evento:</div>
	        <div class='contenedor-combo-buscador-1' id='claseEvento'>".comboClaseEvento($idClase)."</div>
                <input type='hidden' value='$claseEvento_description' id='claseEvento_txt' name='claseEvento_txt' class='field'>
	        <div style='clear:both'></div>
                        
	    </form>";
	
	    
	    $respuesta->Assign("evento","innerHTML",$html);
	
	   // $respuesta->script("xajax_comboCategoriaEvento($id)");
	    
	    $respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('evento','$divTitulo'); return false;\">$titulo</a>");
	    return $respuesta;
	}

	function iniLugarPais($divTitulo){
	    $titulo="Lugar/Pa&iacute;s";
		$respuesta = new xajaxResponse();
		

		
		if(isset($_SESSION["edit"])){
			$recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
			$recuperar=$_SESSION["tmp"];
		}
		
		//$respuesta->alert(print_r($recuperar,true));
				
		
		if(isset($recuperar["lugar"])){
			$lugar=$recuperar["lugar"];
		}
		else{
			$lugar="";
		}
		
		if(isset($recuperar["pais_description"])){
			$pais_description=$recuperar["pais_description"];
		}
		else{
			$pais_description="";
		}
                
	        $html="";
		$html="
		        <div class='campo-buscador'>Lugar:&nbsp;</div>
		        <div class='contenedor-caja-buscador-1'>
		        	<input type='text' onchange='xajax_registerLugar(this.value); return false;' value='$lugar' id='lugar' name='lugar' class='caja-buscador-1'></input>
		       </div>
				<div style='clear:both'></div>		       
				<div class='campo-buscador'>Pa&iacute;s:</div>
 				<div class='contenedor-caja-buscador-1'>
                                    <input type='text' onchange='xajax_registerPais(this.value); return false;' value='$pais_description' id='pais_description' name='pais_description' class='caja-buscador-1'></input>
                                </div>
		       <div style='clear:both'></div>
		    	";
	
	    $respuesta->Assign("lugarPais","innerHTML",$html);
	    $respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('lugarPais','$divTitulo'); return false;\">$titulo</a>");
	    return $respuesta;
	}


	function iniArchivoShow(){
                               
		$html='<form id="formUpload" name="formUpload" method="post" enctype="multipart/form-data" action="librerias/uploadEdit.php" target="iframeUpload">
		            <div id="tituloUpload" name="tituloUpload" style="display:block" class="txt-azul">Carga de Archivo </div>
                            <label id="mensaje" class="txt-rojo">*Luego de elegir el archivo, esperar que se muestre el mensaje.</label>
                            <label id="fileR" for="demo-photoupload" style="display:block">
                                        <input id="fileUpload" name="fileUpload" type="file" class="file" onchange=" javascript: submit(); " />
                            </label>
		            	<input name="ano" type="hidden" value="2011" />
		                <input name="date_in" type="hidden" value="" />
		                <input name="tipoDocumento" type="hidden" value="1" />
		                <input name="tipoPublicacion" type="hidden" value=1 />
		                <input name="action" type="hidden" value="upload" />
		                <br /><iframe name="iframeUpload" style="display:none"></iframe>
		                    <div id="mensajeR"></div>

		        </form>';
                
                if(isset($_SESSION["edit"])){
                    $sesion_iddata=$_SESSION["edit"]["iddata"];
                    $html.="<div class='blue' id='linkUpload' name='linkUpload'> &nbsp; &nbsp; &nbsp; ".downloadLink($sesion_iddata,"admin","form")."</div>";
                    
                    $link=downloadLink($sesion_iddata,"admin","form");
                    
                }
                else{
                    $link="";
                    //$html.= "<br /><br /><a id='linkSubir' name='linkSubir' href='#upload' onclick='xajax_verFile()'><b>Subir Archivo</b></a> ";
                }
		return array($html,$link);
	}


	function iniAuthorPriShow(){
	    $titulo="AUTOR PRINCIPAL";
		//$respuesta = new xajaxResponse();
	
		$html='
		<table width="620px;"><tr><td width="420px;" style="vertical-align: top;">
		<div>
			<p class="txt-azul">B&uacute;squeda de autor</p>
                        
                <div id="div_autor">
	        <form name="autorPRI" id="autorPRI" onsubmit="xajax_auxAuthorPriShow(5,1,xajax.getFormValues(autorPRI)); return false;" >
	            <div class="campo-buscador"><span style="font-size:12px;">Apellido:</span></div>
                        <div class="contenedor-caja-buscador-1">
                            <input type="text" value="" id="sAuthor" name="sAuthor" class="caja-buscador-2" />                            
                            <input type="submit" value="Buscar" class="ui-state-default ui-corner-all" id="boton_buscar" />
                        </div>
	        </form>                
		</div>
		<div id="rq_authorPRI"></div>
		<div class="paginacion">
			<div id="paginatorPRI" class="wp-pagenavi"></div>
		</div>
		</div>
		</td>
		<td style="vertical-align: top;">
		<div>
			<p class="txt-azul">Autor principal</p>	
			<div id="sesion_authorPRI"></div>
		</div>
		<div class="linea-separacion"></div>		
		<div>			
			<p class="txt-azul">Autor secundario</p>
			<div id="sesion_authorSEC"></div>
		</div>
		</td></tr></table>';
                               
		return $html;
	}

function iniAuthorSecShow(){
    $titulo="AUTOR SECUNDARIO";
	$respuesta = new xajaxResponse();

$html='<br />
<fieldset>
<p><table class="tablecontent"><tr><td>
<!--<div id="sesion_authorSEC"></div>-->
<td>
<div id="rq_authorSEC"></div>
            <div class="paginacion">
                <div id="paginatorSEC" class="wp-pagenavi"></div>
            </div>
</td></tr></table></p>

            <br />
        <form name="autorSEC" id="autorSEC" onsubmit="xajax_auxAuthorSecShow(5,1,xajax.getFormValues(\'autorSEC\')); return false;">
            <p><label class="left">Añadir autor:</label><input type="text" name="sAuthor" id="sAuthor" class="field">
            <input type="submit" value="Buscar" class="ui-state-default ui-corner-all">

            <input type="radio" checked="checked" name="search_by" id="search_by" value="1"><b>Apellidos </b>&nbsp;
            <input type="radio" name="search_by" id="search_by" value="2"><b>Nombre</b><br>

        </p>

        </form>
</fieldset>
';

    //$cadena="xajax_searchAuthorSesionSecShow()";
    //$respuesta->script($cadena);

    $respuesta->Assign("search_authorSEC","innerHTML",$html);
    $respuesta->Assign("titautorSEC","innerHTML","<a href=#1 onclick=\"xajax_fadeappear('search_authorSEC','titautorSEC','$titulo');return false;\">$titulo</a>");

return $respuesta;
}

/*
function iniAuthorShow($divTitulo){
	$respuesta = new xajaxResponse();

    $cadena="xajax_iniAuthorPriShow()";
    $respuesta->script($cadena);
    $cadena="xajax_formAuthorShow('newFormAuthor')";
    $respuesta->script($cadena);

return $respuesta;
}
*/	
	
	function iniReferenciaShow($tipo,$divTitulo){
	    
		//$respuesta = new xajaxResponse();
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];    
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		}		
		
		
	    if(isset($recuperar["reference_description"])){
	        $txt=$recuperar["reference_description"];
	    }
	    else{
	        $txt="";
	    }
		
		if(isset($recuperar["reference_details"])){
			$detalle=$recuperar["reference_details"];
		}
		else{
			$detalle="";
		}	
		
		$html=" 
		    	<form name='formReferencia' id='formReferencia' onSubmit='xajax_registerReference(xajax.getFormValues(\"referencia\")); return false;'>
				<div class='campo-buscador'>Referencia:</div>
				<div class='contenedor-combo-buscador-1' id='registerReference'>
				</div>
				<div style='clear:both'></div>
				
		        <div id='detalle_referencia'></div>
				<!--<input size='16' id='referencia_txt' value='$txt' name='referencia_txt' type='text' >-->
		        
				<div class='campo-buscador'>Detalle Referencia:</div>
				<div class='contenedor-caja-buscador-2' id='registerReference'>
					<input type='text' onchange='xajax_registerReferenceDetails(this.value)' size='16' value='$detalle' id='detalle_referencia' name='detalle_referencia' class='caja-buscador-1'>				
		        	<a href='#' class='tooltip'><img id='tooltip' src='img/tooltip.gif'/><span>En el campo DETALLE DE LA REFERENCIA ingresar los datos de la siguiente manera: Volume number, issue number (in parentheses), pages or citation number and DOI. Ejemplo: 59(12),311-326, doi:10.1029/1999JA900231</span></a>
				</div>
				<div style='clear:both'></div>
				<div class='linea-separacion'></div>				
				</form>	";
		
		$html.='<p class="txt-azul">Ingresar nueva referencia</p>

				<div id="divNuevaRefe">
					<div id="div_abrev"></div>

					<form id="nuevaReferencia" name="nuevaReferencia" onSubmit="xajax_newReferenceRegister(\'INS\',xajax.getFormValues(\'nuevaReferencia\'));  return false;">
						<div class="campo-buscador">Título:</div>
						<div class="contenedor-caja-buscador-1" id="registerReference">
							<input name="nreferencia" id="nreferencia" type="text" size="16" class="caja-buscador-2">
						</div>
						<div style="clear:both"></div>
						<div class="campo-buscador">Abreviatura:</div>
						<div class="contenedor-caja-buscador-1" id="registerReference">
							<input type="text" size="14" id="abrev" name="abrev" class="caja-buscador-2" />
							CAS <a href="http://cassi.cas.org/search.jsp" target="blank" class="tooltip"><img id="tooltip" src="img/tooltip.gif"/><span>Sino se conoce la abreviatura correspondiente a la referencia, puede consultar en CAS Source Index (http://cassi.cas.org/search.jsp).</span></a>						
						</div>
						<div style="clear:both"></div>
						<input type="submit" value="A&ntilde;adir" class="ui-state-default ui-corner-all" />
				</form>
				</div>
				<div id="ref_mensaje"></div>';
		return $html;
	}

	function iniEstadoShow(){
	    $titulo="ESTADO";
		$respuesta = new xajaxResponse();
	    $cadena="xajax_comboEstadoPublicacionShow(0)";
	    $respuesta->script($cadena);
	    $respuesta->Assign("titEstado","innerHTML","<a href=#1 onclick=\"xajax_appearfade('divEstado','titEstado','$titulo')\">$titulo</a>");
		return $respuesta;
	}


	function iniNroCompendioYear($divTitulo){
	    $titulo="Número / A&ntilde;o";
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		}
	
	    if(isset($recuperar["nroCompendio"])){
	        $nroCompendio=$recuperar["nroCompendio"];
	    }
	    else{
	        $nroCompendio="";
	    }
	
	    if(isset($recuperar["yearCompendio"])){
	        $yearCompendio=$recuperar["yearCompendio"];
	    }
	    else{
	        $yearCompendio=0;
	    }

            if(isset($_SESSION["edit"])){
                $respuesta->script("xajax_registerYearCompendio($yearCompendio)");
            }
            
		$html="<form name='form_compendio' id='form_compendio' >
		       	<div class='campo-buscador'>Número de compendio:&nbsp;</div>
		       	<div class='contenedor-campo-buscador'>
		       	<input type='text' size='30' onchange='xajax_registerCompendio(this.value); return false;' value='$nroCompendio' id='nroCompendio' name='nroCompendio' class='caja-buscador-1'></p>
				</div>
				<div style='clear:both'></div>
				<div class='campo-buscador'>Año:&nbsp;</div>
		        <div class='contenedor-combo-buscador' id='divYearRegister'>".comboYearRegisterShow($yearCompendio,"xajax_registerYearCompendio(this.value)")."</div>
				<div style='clear:both'></div>		    
		       </form>";

	    $respuesta->assign("compendio","innerHTML",$html);
		$respuesta->assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('compendio','$divTitulo'); return false;\">$titulo</a>");
		return $respuesta;
	}

	function iniYearQuarter($divTitulo){
	    $titulo="A&ntilde;o / Trimestre";
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
			$recuperar=$_SESSION["edit"];
	    }
		elseif(isset($_SESSION["tmp"])){
			$recuperar=$_SESSION["tmp"];
		}
	
		if(isset($recuperar["idquarter"])){
			$id=$recuperar["idquarter"];
		}
		else{
			$id=0;
		}
	
		if(isset($recuperar["quarter_description"])){
			$quarter_description=$recuperar["quarter_description"];
		}
		else{
			$quarter_description="";
		}
                
                $yearQuarter=0;
		if(isset($recuperar["yearQuarter"])){
                    if($recuperar["yearQuarter"]!=""){
			$yearQuarter=$recuperar["yearQuarter"];
                    }		
		else{
			$yearQuarter=$recuperar["year"];
                    }
                }
	                
                if(isset($_SESSION["edit"])){
                    $respuesta->script("xajax_registerYearQuarter($yearQuarter)");
                }
                
		$html="<form name='formYearQuarter' id='formYearQuarter' >
				<div class='txt-azxul' id='titYear'></div>
				<div class='campo-buscador'>Año</div>				
				<div class='contenedor-combo-buscador-1'>
					<div id='divYearRegister'>".comboYearRegisterShow($yearQuarter,"xajax_registerYearQuarter(this.value)")."</div>
				</div>
				<div style='clear:both'></div>				
				<div class='campo-buscador'>Trimestre</div>
				<div class='contenedor-combo-buscador-1' id='divQuarter'>".comboQuarter($id)."</div>
					<input name='trimestre_txt' type='hidden' id='trimestre_txt' value='$quarter_description' />
				<div style='clear:both'></div>
		    </form>";

		$respuesta->assign("year_quarter","innerHTML",$html);
	    //respuesta->script("xajax_comboYearRegisterShow('$yearQuarter','divYearRegister')");
		//$objResponse->assign('divYearRegister',"innerHTML",);	    
	    //$respuesta->script("xajax_comboQuarter('$id')");
                
		$respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('year_quarter','$divTitulo'); return false;\">$titulo</a>");
		return $respuesta;
	}

function iniRegionDepartamentoFechas($divTitulo){
    	$objResponse = new xajaxResponse();

        if(isset($_SESSION["edit"])){
            $recuperar=$_SESSION["edit"];
        }
        elseif(isset($_SESSION["tmp"])){
            $recuperar=$_SESSION["tmp"];
        }

        if(isset($recuperar["idRegion"])){
            $idRegion=$recuperar["idRegion"];
        }
        else{
            $idRegion=0;
        }

        if(isset($recuperar["region_description"])){
            $region_description=$recuperar["region_description"];
        }
        else{
            $region_description="";
        }

        if(isset($recuperar["idDepartamento"])){
            $idDepartamento=$recuperar["idDepartamento"];
        }
        else{
            $idDepartamento=0;
        }

        if(isset($recuperar["departamento_description"])){
            $departamento_description=$recuperar["departamento_description"];
        }
        else{
            $departamento_description="";
        }

	$link="<a onclick=\"xajax_displaydiv('region_departamento','$divTitulo'); return false;\" href='#'>REGI&Oacute;N / DEPARTAMENTO / FECHAS</a>";
	$objResponse->Assign($divTitulo,"innerHTML",$link);

        $objResponse->script("xajax_comboRegionShow('$idRegion',1)");
/*
        if(isset($_SESSION["tmp"]["idDepartamento"])){
            $idDepartamento=$_SESSION["tmp"]["idDepartamento"];
            $objResponse->script("xajax_comboDepartamentoShow('$idDepartamento',$idRegion',1)");
            //$objResponse->script("xajax_cerrarSesion()");
        }
*/
        
        
        $htmlDates=iniDates();        
        
        $html="
            <form name='reg_dep_fechas' id='reg_dep_fechas' onSubmit='xajax_registerRegDepFechas(xajax.getFormValues(\"reg_dep_fechas\")); return false;'>
            
            <div class='campo-buscador' id='tit_tipoPonencia'>Regi&oacute;n:</div>
            <div class='contenedor-combo-buscador-1' >
                <div id='registerRegionBoletines'></div>
            </div>
            <div style='clear:both'></div>
                                                            
            <div class='campo-buscador' id='tit_tipoPonencia'>Departamento:</div>
            <div class='contenedor-combo-buscador-1' >        
                <div id='registerDepartamentoBoletines'></div>
            </div>             
            <div style='clear:both'></div><br>
            
            <div id='fechas'></div>
            <div style='clear:both'></div>                      

</form>
";
    
    $objResponse->Assign("region_departamento","innerHTML",$html);
    $objResponse->Assign("fechas","innerHTML",$htmlDates);    
    
    
        
        if(isset($recuperar["idDepartamento"])){
            $idDepartamento=$recuperar["idDepartamento"];
            $objResponse->script("xajax_comboDepartamentoShow('$idDepartamento','$idRegion',1)");

        }

return $objResponse;
}




function iniNroMagnitud($divTitulo){
    $titulo="NRO / MAGNITUD";
	$respuesta = new xajaxResponse();

        if(isset($_SESSION["edit"])){
            $recuperar=$_SESSION["edit"];
        }
        elseif(isset($_SESSION["tmp"])){
            $recuperar=$_SESSION["tmp"];
        }

        if(isset($recuperar["nroBoletin"])){
            $nroBoletin=$recuperar["nroBoletin"];
        }
        else{
            $nroBoletin="";
        }

        if(isset($recuperar["magnitud_descrption"])){
            $magnitud_descrption=$recuperar["magnitud_descrption"];
        }
        else{
            $magnitud_descrption="";
        }

        if(isset($recuperar["idmagnitud"])){
            $idmagnitud=$recuperar["idmagnitud"];
        }
        else{
            $idmagnitud=0;
        }

$respuesta->script("xajax_comboMagnitudShow('$idmagnitud',1)");

$html="<form name='boletinMagnitud' id='boletinMagnitud' onSubmit='xajax_registerBoletinMagnitud(xajax.getFormValues(\"boletinMagnitud\")); return false;'>

        <div class='campo-buscador'>Nro Bolet&iacute;n:</div>
        <div class='contenedor-combo-buscador-1' id='registerReference'>
            <input type='text' size='30' class='caja-buscador-2' onchange='xajax_registerBoletin(this.value); return false;' value='$nroBoletin' id='nroBoletin' name='nroBoletin' class='field'>
        </div>
        <div style='clear:both'></div>

        
        <div class='campo-buscador'>Magnitud:</div>
        <div class='contenedor-combo-buscador-1' id='registerReference'>
        <div id='divMagnitud'></div>        
        </div>
       <div style='clear:both'></div>
    </form>
";


        $respuesta->Assign("nro_magnitud","innerHTML",$html);

	$respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('nro_magnitud','$divTitulo'); return false;\">$titulo</a>");

        
        
	return $respuesta;
}

function iniTitulo($divTitulo){

    $subcategory=$_SESSION["subcategory"];
    if($subcategory=="ponencia"){
        $titulo="T&Iacute;TULO / TIPO";
    }
    else{
        $titulo="T&iacute;tulo";
    }

	$respuesta = new xajaxResponse();

        if(isset($_SESSION["edit"])){
            $recuperar=$_SESSION["edit"];
        }
        elseif(isset($_SESSION["tmp"])){
            $recuperar=$_SESSION["tmp"];
        }

        if(isset($recuperar["titulo"])){
            $tit=$recuperar["titulo"];
        }
        else{
            $tit="";
        }

        if(isset($recuperar["resumen"])){
                $abstract=$recuperar["resumen"];
        }
        else{
                $abstract="";
        }
        
		$html="<form name='tit_res' id='tit_res' >
				<div class='campo-buscador'>Título:&nbsp;</div>
				<div class='contenedor-caja-buscador-1'>
					<input type='text' class='caja-buscador-1' size='30' name='title' id='title' value='$tit' onchange='xajax_registerTitulo(this.value)'>
				</div>
				<div style='clear:both'></div>";

	    if(isset($_SESSION["subcategory"])){
	    	$subcategory=$_SESSION["subcategory"];
	    }	
	    else{
	    	$subcategory="";
	    }	    	
            
            switch($subcategory){
                case "articulos_indexados":
                case "tesis":
                case "otras_publicaciones":
                $html.="<div class='campo-buscador'>Resumen:&nbsp;</div>		
				<div class='contenedor-caja-buscador-1'>
					<textarea class='caja-buscador-1' size='30' name='abstrac' id='abstrac' onchange='xajax_registerResumen(this.value)'>
					$abstract
					</textarea>
				</div>
				<div style='clear:both'></div>	
		    </form>
		    <div id='titres_mensaje'></di>";

                    break;               
            }
                


        $respuesta->Assign("titulo","innerHTML",$html);

	$respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo','$divTitulo'); return false;\">$titulo</a>");
	return $respuesta;
}


	function iniTitulo_Tipo_Presentado($divTitulo){
		$titulo="T&iacute;tulo / Tipo";
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
	
        if(isset($recuperar["titulo"])){
            $tit=$recuperar["titulo"];
        }
        else{
            $tit="";
        }
	
        //Presentado por
        if(isset($recuperar["prePorNombre"])){
            $prePorNombre=$recuperar["prePorNombre"];
        }
        else{
            $prePorNombre="";
        }

        if(isset($recuperar["prePorApellido"])){
            $prePorApellido=$recuperar["prePorApellido"];
        }
        else{
            $prePorApellido="";
        }
        
        if(isset($recuperar["idtipoPonencia"])){
            $tipoPonencia_id=$recuperar["idtipoPonencia"];
        }
        else{
            $tipoPonencia_id=0;
        }

        if(isset($recuperar["tipoPonencia_description"])){
            $tipoPonencia_description=$recuperar["tipoPonencia_description"];
        }
        else{
            $tipoPonencia_description="";
        }
		$tipoPonencia="";
		$tipoPonencia=comboTipoPonencia($tipoPonencia_id);
        
        
		$html="<form name='tit_tipo_prepor' id='tit_tipo_prepor' onSubmit='xajax_registerTitTipo(xajax.getFormValues(\"tit_tipo_prepor\")); return false;'>
       	<div style='clear:both'></div>

       	<div class='campo-buscador' id='tit_tipoPonencia'>Tipo de ponencia</div>
       	<div class='contenedor-combo-buscador-1' id='tipoPonencia'>$tipoPonencia</div>
       	<input type='hidden' value='tipoPonencia_description' id='tipoPonencia_txt' name='tipoPonencia_txt' class='field'>
		<div style='clear:both'></div>
		<div class='campo-buscador'>Título:&nbsp;</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' onchange='xajax_registerTitulo(this.value); return false;' value='$tit' id='title' name='title' class='caja-buscador-1' /></div>
		<div style='clear:both'></div>		
		
       	<div class='txt-azul'>Presentado Por:</div>
       	<div class='campo-buscador'>Nombre:</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' maxlength='1' onchange='xajax_registerPrePorNombre(this.value); return false;' value='$prePorNombre' id='prePorNombre' name='prePorNombre' class='caja-buscador-1'>
       	</div>
		<div style='clear:both'></div>       	
       	<div class='campo-buscador'>Apellido:</div>
       	<div class='contenedor-caja-buscador-1'>       	
       	<input type='text' onchange='xajax_registerPrePorApellido(this.value); return false;' value='$prePorApellido' id='prePorApellido' name='prePorApellido' class='caja-buscador-1'>
		</div>
		<div style='clear:both'></div>		
       	</form>";
	
	    //$respuesta->script("xajax_comboTipoPonencia($tipoPonencia_id)");
	    $respuesta->Assign("titulo_tipo_prepor","innerHTML",$html);
		$respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_tipo_prepor','$divTitulo'); return false;\">$titulo</a>");
		return $respuesta;
	}

	function iniTitulo_Resumen(){
	    
		//$respuesta = new xajaxResponse();
	
		//$objResponse->alert(print_r($_SESSION["tmp_edit"]["titulo"], true));
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
		
		if(isset($recuperar["titulo"])){
			$tit=$recuperar["titulo"];
		}
                else{
			$tit="";
		}
	        
	
		if(isset($recuperar["resumen"])){
			$abstract=$recuperar["resumen"];
		}
		else{
			$abstract="";
		}
	
		if(isset($recuperar["enlace"])){
			$link=$recuperar["enlace"];
	      //$link=substr($recuperar["enlace"], 7);
		}
		else{
			$link="http://";
		}
	        
	        
		$html="<form name='tit_res' id='tit_res' >
				<div class='campo-buscador'>Título:&nbsp;</div>
				<div class='contenedor-caja-buscador-1'>
					<input type='text' class='caja-buscador-1' size='30' name='title' id='title' value=\"$tit\" onchange='xajax_registerTitulo(this.value)'>
				</div>
				<div style='clear:both'></div>
				<div class='campo-buscador'>Resumen:&nbsp;</div>		
				<div class='contenedor-caja-buscador-1'>
					<textarea class='caja-buscador-1' size='30' name='abstrac' id='abstrac' onchange='xajax_registerResumen(this.value)'>
					$abstract
					</textarea>
				</div>
				<div style='clear:both'></div>
				<div class='campo-buscador'>Enlace:&nbsp;</div>
				<div class='contenedor-caja-buscador-1'>
					<input type='text' class='caja-buscador-1' size='30' name='link' id='link' value=\"$link\" onchange='xajax_registerLink(this.value)'>
				</div>
				<div style='clear:both'></div>
		
		    </form>
		    <div id='titres_mensaje'></di>
		";
	
	        //$respuesta->alert(print_r($_SESSION, true));

		
		return $html;
	}

	function iniTitulo_Presentado($divTitulo){
	    $titulo="T&iacute;tulo / Presentado por";
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		}
		
        if(isset($recuperar["titulo"])){
            $tit=$recuperar["titulo"];
        }
        else{
            $tit="";
        }

        if(isset($recuperar["prePorNombre"])){
            $prePorNombre=$recuperar["prePorNombre"];
        }
        else{
            $prePorNombre="";
        }

        if(isset($recuperar["prePorApellido"])){
            $prePorApellido=$recuperar["prePorApellido"];
        }
        else{
            $prePorApellido="";
        }
		
		
		$html="<form name='form_tit_prepor' id='form_tit_prepor' onSubmit='xajax_registerTitPrePor(xajax.getFormValues(\"form_tit_prepor\")); return false;'>
			  <div class='campo-buscador'><div>Título :</div></div>
			  <div class='contenedor-caja-buscador-1'>
			  	<input type='text' size='30' onchange='xajax_registerTitulo(this.value); return false;' value='$tit' id='title' name='title' class='caja-buscador-1'>
				</div>
				<div style='clear: both;'></div>";
		
		$html.="<div class='txt-azul'>Presentado Por:</div>";
		$html.="<div class='campo-buscador'>Nombre:</div>";
		$html.="<div class='contenedor-caja-buscador-1'><input type='text' maxlength='1' onchange='xajax_registerPrePorNombre(this.value); return false;' id='prePorNombre' name='prePorNombre' value='$prePorNombre' class='caja-buscador-2' /> <small>solo la primera letra</small></div>";
		$html.="<div style='clear: both;'></div>";		
		$html.="<div class='campo-buscador'>Apellido:</div>";
		$html.="<div class='contenedor-caja-buscador-1'><input type='text' onchange='xajax_registerPrePorApellido(this.value); return false;' id='prePorApellido' name='prePorApellido' value='$prePorApellido' class='caja-buscador-2' /></div>";
		$html.="<div style='clear: both;'></div>";
		$html.="</form>";
	
	    $respuesta->Assign("titulo_presentado","innerHTML",$html);
	
		$respuesta->Assign($divTitulo,"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_presentado','$divTitulo'); return false;\">$titulo</a>");
		return $respuesta;
	}



function iniTypeTesisCountryUniversity(){
	$objResponse = new xajaxResponse();

        if(isset($_SESSION["edit"])){
            $recuperar=$_SESSION["edit"];
        }
        elseif(isset($_SESSION["tmp"])){
            $recuperar=$_SESSION["tmp"];
        }

        if(isset($recuperar["tipo_tesis"])){
            $id=$recuperar["tipo_tesis"];
        }
        else{
            $id=0;
        }

        if(isset($recuperar["tipoTesisDescription"])){
            $tipoTesisDescription=$recuperar["tipoTesisDescription"];
        }
        else{
            $tipoTesisDescription="";
        }

        if(isset($recuperar["pais_description"])){
            $pais_description=$recuperar["pais_description"];
        }
        else{
            $pais_description="";
        }

        if(isset($recuperar["uni_description"])){
            $uni_description=$recuperar["uni_description"];
        }
        else{
            $uni_description="";
        }

	$link="<a onclick=\"xajax_displaydiv('tipoTesis_pais_universidad','titulo3'); return false;\" href='#'>Tipo / Pa&iacute;s / Universidad</a>";
	$objResponse->Assign("titulo3","innerHTML",$link);

        $html="<form id='formTipoPaisUni' name='formTipoPaisUni' onSubmit='xajax_registerTipoPaisUni(xajax.getFormValues(\"formTipoPaisUni\")); return false;'>
                <div id='labelTipoTesis'></div>
                <div  class='contenedor-combo-buscador-1' id='registerTipoTesis'></div>
				<div style='clear:both'></div>                
                <input type='hidden' id='tipoTesisDescription' name='tipoTesisDescription' class='field' value='$tipoTesisDescription'>

				<div id='pais'></div>

				<div id='universidad'></div>
                </form>";

        $htmlTipoTesis="<div class='campo-buscador'>Tipo de Tesis</div>";
        $objResponse->script("xajax_comboTipoTesisShow('$id',1)");

    $htmlPais="<div class='campo-buscador' >Pa&iacute;s:</div>";
    $htmlPais.="<div class='contenedor-caja-buscador-1'>";
    $htmlPais.="<input type='text' onchange='xajax_registerPais(this.value)' id='pais_description' name='pais_description' class='caja-buscador-1' value='$pais_description' />";
    $htmlPais.="</div>";
    $htmlPais.="<div style='clear:both'></div>";
    $htmlUni="<div class='campo-buscador' >Universidad:</div>";
    $htmlUni.="<div class='contenedor-caja-buscador-1'>";
    $htmlUni.="<input type='text' onchange='xajax_registerUniversidad(this.value)' id='uni_description' name='uni_description' class='caja-buscador-1' value='$uni_description'/>";
    $htmlUni.="</div>";
    $htmlUni.="<div style='clear:both'></div>";

    $objResponse->assign('tipoTesis_pais_universidad', 'innerHTML',$html);
    $objResponse->assign('labelTipoTesis', 'innerHTML',$htmlTipoTesis);
    $objResponse->assign('pais', 'innerHTML',$htmlPais);
    $objResponse->assign('universidad', 'innerHTML',$htmlUni);


    return $objResponse;
}



function iniAreaResult($type,$idarea){
    $resultSql= searchThemeSQL($type,$idarea);
return $resultSql;
}

	function iniAreaShow($idarea){
	
	    if(isset($_SESSION["subcategory"])){
	    	$subcategory=$_SESSION["subcategory"];
	    }	
	    else{
	    	$subcategory="";
	    }	    	
            
            switch($subcategory){
                case "articulos_indexados":
                case "tesis":
                case "charlas_internas":
                case "otras_publicaciones":                        
                    $tipo_txt="publicaci&oacute;n";
                    break;               
                case "ponencia":
                    $tipo_txt="ponencia";
                    break;
                case "boletines":
                    $tipo_txt="Informaci&oacute;n interna";
                    break;
            }
            
        $session_area_description=isset($_SESSION["area_description"])?$_SESSION["area_description"]:"sin &aacute;rea";    
	$titulo="Asociar la $tipo_txt a un tema del &aacute;rea de ".$session_area_description;
		$respuesta = new xajaxResponse();
	
	if(isset($_SESSION["edit"])){
	    $recuperar=$_SESSION["edit"];
	}
	elseif(isset($_SESSION["tmp"])){
	    $recuperar=$_SESSION["tmp"];
	 }
	
	    $result=iniAreaResult("single",$idarea);
	    $html="";
	    if($result["Error"]==0){
	
	        for($i=0;$i<count($result["idtheme"]);$i++){
	            $key = $result["idtheme"][$i];
	            if(isset($recuperar["themes"][$key])){
	                $html.="<p><input type=checkbox checked onclick=\"xajax_registerTheme('".$result["idtheme"][$i]."','".$result["theme_description"][$i]."');\" />&nbsp;".$result["theme_description"][$i]."</p>";
	            }
	            else{
	                $html.="<p><input type=checkbox onclick=\"xajax_registerTheme('".$result["idtheme"][$i]."','".$result["theme_description"][$i]."');\"  />&nbsp;".$result["theme_description"][$i]."</p>";
	            }
	        }
	
	    }
	    else{
	        $html="<font color='red'>No se ha registrado temas para esta &aacute;rea</font>";
	    }
	
	    $respuesta->Assign("area_propietaria","innerHTML",$html);
	    $respuesta->Assign("titArea","innerHTML",$titulo);
	
	    return $respuesta;
	}

	function iniOtrasAreasResult($idarea){
	    $resultSql= searchOtherAreaSQL($idarea);
	return $resultSql;
	}

	function iniAreasAdministrativasResult($idarea){
	    $resultSql= searchAreasAdministrativasSQL($idarea);
	return $resultSql;
	}

	function iniAreasAdministrativasShow($idarea){
	
		$respuesta = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
		
		        $subcategory=$_SESSION["subcategory"];
		
		$divTitulo="";
		$titulo="";
		$divContenido="";
		
		switch ($subcategory) {
		    case "charlas_internas":
		    $divTitulo="titAreasAdministrativas";
		    $divContenido="cont_areasAdministrativas";
		    $titulo="&Aacute;reas de Administrativas";
		    break;
		}
	
	    $result=iniAreasAdministrativasResult($idarea);
	
	    $id=$result["idareaAdministrativa"];
	    $desc=$result["areaAdministrativa_description"];
	    $html="";
	    if($result["Error"]==0){
	
	        if($result["Count"]>0){
	            for($i=0;$i<count($id);$i++){
	                $key = $id[$i];
	                if(isset($recuperar["areasAdministrativas"][$key])){
	                    $html.="<p><input type=checkbox checked onclick=\"xajax_registerAreaAdministrativa('".$id[$i]."')\"  value=".$id[$i]."  />&nbsp;".$desc[$i]."</p>";
	                }
	                else{
	                    $html.="<p><input type=checkbox  onclick=\"xajax_registerAreaAdministrativa('".$id[$i]."')\"  value=".$id[$i]."  />&nbsp;".$desc[$i]."</p>";
	                }
	            }
	        }
	    }
	    else{
	        $html="Error SQL";
	    }
	    $respuesta->Assign("$divContenido","innerHTML",$html);
	    $respuesta->Assign("$divTitulo","innerHTML",$titulo);
	    return $respuesta;
	}


	function iniOtrasAreasShow($idarea){
	    
		$respuesta = new xajaxResponse();
		//$subcategory=$_SESSION["subcategory"];

	    if(isset($_SESSION["subcategory"])){
	    	$subcategory=$_SESSION["subcategory"];
	    }	
	    else{
	    	$subcategory="";
	    }	    	
            
            switch($subcategory){
                case "articulos_indexados":
                case "tesis":
                case "charlas_internas":
                case "otras_publicaciones":                        
                    $tipo_txt="publicaci&oacute;n";
                    break;               
                case "ponencia":
                    $tipo_txt="ponencia";
                    break;
                case "boletines":
                    $tipo_txt="Informaci&oacute;n interna";
                    break;
            }
                
		switch ($subcategory) {
		    case "otras_publicaciones":
		    case "tesis":
		    case "charlas_internas":
		    case "informes_trimestrales":
		    case "reportes_tecnicos":
		    $divTitulo="titAreas";
		    $divContenido="cont_areas";
		    $titulo="Asociar el reporte t&eacute;cnico al(las) &aacute;rea(s) de investigaci&oacute;n de: ";
		    break;
		
		    default : 
		    $divTitulo="titOtrasAreas";
		    $divContenido="otrasAreas";
		    $titulo="¿Necesita asociar la $tipo_txt a otra(s) &aacute;rea(s)?";
		    break;
		}
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
	
	    $result=iniOtrasAreasResult($idarea);
	    $html="";
	    if($result["Error"]==0){
	
	        if($result["Count"]>0){
	            for($i=0;$i<count($result["idarea"]);$i++){
	                $key = $result["idarea"][$i];
	                if(isset($recuperar["areasSEC"][$key])){
	                    $html.="<p><input type=checkbox checked onclick=\"xajax_registerArea('".$result["idarea"][$i]."')\"  value=".$result["idarea"][$i]."  />&nbsp;".$result["area_description"][$i]."</p>";
	                }
	                else{
	                    $html.="<p><input type=checkbox  onclick=\"xajax_registerArea('".$result["idarea"][$i]."')\"  value=".$result["idarea"][$i]."  />&nbsp;".$result["area_description"][$i]."</p>";
	                }
	            }
	        }
	
	    }
	    else{
	        $html="Error SQL";
	    }
	    
	    $respuesta->Assign("$divContenido","innerHTML",$html);
	    $respuesta->Assign("$divTitulo","innerHTML",$titulo);
	    return $respuesta;
	}


	
	function iniAreas($divTitulo){
		$objResponse = new xajaxResponse();
		$link="<a onclick=\"xajax_displaydiv('areas','$divTitulo'); return false;\" href='#'>&Aacute;rea</a>";
		$objResponse->Assign($divTitulo,"innerHTML",$link);
	
		if($_SESSION["idarea"]==1){
		    $objResponse->script("xajax_subArea()");
		}
		else{
		    $cadena="xajax_iniOtrasAreasShow('".$_SESSION["idarea"]."')";
		    $objResponse->script($cadena);
		}
	
	    $cadena="xajax_iniAreasAdministrativasShow('".$_SESSION["idarea"]."')";
	    $objResponse->script($cadena);
	
		$subcategory=$_SESSION["subcategory"];
	
		switch($subcategory){
		    case "charlas_internas":
		        $cadena="xajax_iniInstitucionExterna('tit_inst_ext','cont_inst_ext')";
		        $objResponse->script($cadena);
		    break;
		
		}
	    return $objResponse;
	}

	
	/*
function iniAreaTheme($divTitulo){
	$objResponse = new xajaxResponse();

	$link="<a onclick=\"xajax_displaydiv('area_tema','$divTitulo'); return false;\" href='#'>&Aacute;REA Y TEMA</a>";
	$objResponse->Assign($divTitulo,"innerHTML",$link);

        //Temas del area de Aeronomia
    $cadena="xajax_iniAreaShow('".$_SESSION["idarea"]."')";
    $objResponse->script($cadena);

        //Asociar a otras areas
    $cadena="xajax_iniOtrasAreasShow('".$_SESSION["idarea"]."')";
    $objResponse->script($cadena);


        //Asociar a otros temas
	$range=readSessionArea();
    $script="xajax_otrosTemasShow('$range')";
	$objResponse->script($script);

        //Asociar a otros temas
	$script="xajax_iniOtrosTemasShow()";
	$objResponse->script($script);

        //Ingresar nuevo tema
	$script="xajax_newThemeShow()";
	$objResponse->script($script);

    return $objResponse;
}
*/

	function iniDatePermission($divTitulo){
	    $objResponse = new xajaxResponse();
	
	    $link="<a onclick=\"xajax_displaydiv('fecha_permisos','$divTitulo'); return false;\" href='#'>Fecha / Permisos</a>";
	    $objResponse->assign($divTitulo,"innerHTML",$link);
	
	    //$objResponse->script("xajax_iniDates('titFechasTesis','fechasTesis')");
            
		$htmlDates=iniDatesTesis();
		$objResponse->assign("fechasTesis","innerHTML",$htmlDates);	    

/****************************************************/                
	    if(isset($_SESSION["edit"])){
	        $recuperar=$_SESSION["edit"];
	    }
	    elseif(isset($_SESSION["tmp"])){
	        $recuperar=$_SESSION["tmp"];
	    }

            
            $month_pub=0;
            $year_pub=0;           
	    if(isset($recuperar["month_pub"])){
                if($recuperar["month_pub"]!=""){
                    $month_pub=$recuperar["month_pub"];
                }
	    else{
                $month_date_pub=substr($recuperar["date_pub_tesis"],-5,2);
	        $month_pub=$month_date_pub;
                }

	    }
	
	    if(isset($recuperar["year_pub"])){
                if($recuperar["year_pub"]!=""){
                    $year_pub=$recuperar["year_pub"];
                }	    
	    else{
                $year_date_pub=substr($recuperar["date_pub_tesis"],0,4);
	        $year_pub=$year_date_pub;
                }

	    }
            
                if(isset($_SESSION["edit"])){
                    $objResponse->script("xajax_registerMonthPub($month_pub)");
                    $objResponse->script("xajax_registerYearPub($year_pub)");
                    
                }
/*****************************************************/                
                //$objResponse->script("xajax_cargaScriptDates()");
	    
	    //$objResponse->script("xajax_iniPermission('titPermisosTesis','permisosTesis')");
          
            if(isset($_SESSION["edit"])){
                $objResponse->script("xajax_iniEditPermission('titPermisosTesis','permisosTesis')");   
            }
            else{                
                $objResponse->script("xajax_iniPermission('titPermisosTesis','permisosTesis')");
                
            }
            

	    return $objResponse;
	}
	
	/*
	function iniDateStatusPermission($divTitulo){
	    $objResponse = new xajaxResponse();
	
	    $link="<a onclick=\"xajax_displaydiv('fecha_estado_permisos','$divTitulo'); return false;\" href='#'>FECHA/ESTADO/PERMISOS</a>";
	    $objResponse->Assign($divTitulo,"innerHTML",$link);
	
	    //$objResponse->script("xajax_iniStatus()");
	    $htmlStatus=iniStatus();
	    //$objResponse->script("xajax_iniDates('titFechas','fechas')");
	    $htmlDates=iniDates('titFechas','fechas');
	    
	    
            //$objResponse->script("xajax_iniPermission('titPermisosTesis','permisosTesis')");
            
            if(isset($_SESSION["edit"])){
                $objResponse->script("xajax_iniEditPermission('titPermisos','permisos')");   
            }
            else{                
                $objResponse->script("xajax_iniPermission('titPermisos','permisos')");
                
            }

		            
		$objResponse->Assign("estado","innerHTML",$htmlStatus);            
		//$respuesta->Assign("titEstado","innerHTML","Estado");

		$objResponse->Assign("fechas","innerHTML",$htmlDates);
		$objResponse->Assign("titFechas","innerHTML","Fechas");		
		
	    return $objResponse;
	}
*/


	function iniStatus(){

		$result=searchStatus();
	    $html="";
		$combo="";
	
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
	
	    if($result["Error"]==0){
	        if($result["Count"]>0){
	            $selectIdx=0;
	            
	            if(isset($recuperar["status"])){
	                $selectIdx=$recuperar["status"];
	            }
	
	            $cboAreas=new combo();
	            $combo=$cboAreas->comboList($result["status_description"],$result["idstatus"],"OnChange","xajax_registerStatus(this.value)","Seleccione el estado","0","selectStatus",$selectIdx,"combo-buscador-1");
	        }
	        else{
	             $combo="No hay registros";
	        }
	    }
	    else{
	        $html="Error SQL";
	    }
		$html="<div class='txt-azul'>Seleccione el estado:</div><div>$combo</div>";

	    return $html;
	}

	function iniDates(){
	
	    if(isset($_SESSION["edit"])){
	        $recuperar=$_SESSION["edit"];
	    }
	    elseif(isset($_SESSION["tmp"])){
	        $recuperar=$_SESSION["tmp"];
	    }
            
	    if(isset($recuperar["date_ing"])){
	        $date_ing=$recuperar["date_ing"];
	    }
	    else{
	        $date_ing=date("d/m/Y");
	    }
            
            $month_pub=0;
            $year_pub=0;
            $day_pub=0;

	    if(isset($recuperar["day_pub"])){
                if($recuperar["day_pub"]!=""){
                    $day_pub=$recuperar["day_pub"];
                }
	    
	    else{
                $day_date_pub=substr($recuperar["date_pub"],-8,2);
	        $day_pub=$day_date_pub;
                }
            }
            
	    if(isset($recuperar["month_pub"])){
                if($recuperar["month_pub"]!=""){
                    $month_pub=$recuperar["month_pub"];
                    $desc_month_pub=$recuperar["desc_month_pub"];
                }
                else{
                    $month_date_pub=substr($recuperar["date_pub"],-5,2);
                    $month_pub=$month_date_pub;
                }
            }
            
	    if(isset($recuperar["year_pub"])){
                if($recuperar["year_pub"]!=""){
                    $year_pub=$recuperar["year_pub"];
                }
	    
	    else{
                $year_date_pub=substr($recuperar["date_pub"],0,4);
	        $year_pub=$year_date_pub;
                }
            }
	    
	    if(isset($_SESSION["subcategory"])){
	    	$subcategory=$_SESSION["subcategory"];
	    }	
	    else{
	    	$subcategory="";
	    }	    	

	    $funcion="";
            $comboDay_pub="";
		switch($subcategory){
		    case "ponencia":
		    case "charlas_internas":
		        $fecha_txt="Fecha de Presentaci&oacute;n:";
		        break;
		    case "boletines":
		        $fecha_txt="Fecha de Sismo :";
                        $comboDay_pub=comboDay($day_pub,'xajax_registerDayPub(this.value)');
		        break;
		    default:
		        $fecha_txt="Fecha de publicaci&oacute;n:";
		        break;
		}
                
		//$comboMonth_pub=comboMonth($month_pub,'xajax_registerMonthPub(this.value)');
                $comboMonth_pub=comboMonth($month_pub,'xajax_obtenerIdDescripcion("month","registerMonthPub")');
		$comboYear_pub=comboYear($year_pub,'xajax_registerYearPub(this.value)');
                
                
                
		$html='<div class="campo-buscador">Fecha de ingreso:</div>';
		$html.='<div class="contenedor-caja-buscador-1">';
		$html.="<input type='text' class='caja-buscador-4' name='date_ing' id='date_ing' READONLY value='$date_ing' />";
		$html.='</div>';
		$html.='<div style="clear:both"></div>';
		//$html.='<div class="campo-buscador">'.$fecha_txt."</div>";
		//$html.='<div class="contenedor-caja-buscador-1">';
		//$html.="<input type='text' onchange='xajax_registerDatePub(this.value)' class='caja-buscador-2' name='date_pub' id='date_pub' READONLY size='5' value='$date_pub' />";
                
                    //$html.='<div id="divMonth" class="caja-buscador-2">www</div>';
                    //$html.='<div id="divYear" class="caja-buscador-2">www</div>';
                
                $html.='<div id="registerDate" style="display:block;">
                            <div style="clear:both;"></div>
                            <div class="campo-buscador">'.$fecha_txt.' </div>
                            <div class="contenedor-caja-buscador-1">
                                
                                <span>'.$comboDay_pub.'</span>
                                <span>'.$comboMonth_pub.'</span>
                                <span>'.$comboYear_pub.'</span>
                            </div>
                        <div style="clear:both;"></div>	
                        </div>';
                
		$html.='</div>';
		$html.='<div style="clear:both"></div>';
                
                
                //xajax_comboMonthShow();
                
	    return $html;
	}

	function iniDatesTesis(){
	
	    if(isset($_SESSION["edit"])){
	        $recuperar=$_SESSION["edit"];
	    }
	    elseif(isset($_SESSION["tmp"])){
	        $recuperar=$_SESSION["tmp"];
	    }
	
	    if(isset($recuperar["date_ing"])){
	        $date_ing=$recuperar["date_ing"];
	    }
	    else{	        
                $date_ing=date("d/m/Y");
	    }
	
	    if(isset($recuperar["date_pub"])){
	        $date_pub_tesis=$recuperar["date_pub"];
	    }
	    else{
	        $date_pub_tesis="";
	    }

            $month_pub=0;
            $year_pub=0;           
	    if(isset($recuperar["month_pub"])){
                if($recuperar["month_pub"]!=""){
                    $month_pub=$recuperar["month_pub"];
                }
	    else{
                $month_date_pub=substr($recuperar["date_pub"],-5,2);
	        $month_pub=$month_date_pub;
                }

	    }
	
	    if(isset($recuperar["year_pub"])){
                if($recuperar["year_pub"]!=""){
                    $year_pub=$recuperar["year_pub"];
                }	    
	    else{
                $year_date_pub=substr($recuperar["date_pub"],0,4);
	        $year_pub=$year_date_pub;
                }

	    }
            
	    
	    if(isset($_SESSION["subcategory"])){
	    	$subcategory=$_SESSION["subcategory"];
	    }	
	    else{
	    	$subcategory="";
	    }	    	

	    $funcion="";
		switch($subcategory){
		    case "ponencia":
                        $fecha_txt="Fecha de evento:";
                        break;
		    case "charlas_internas":
		        $fecha_txt="Fecha de Presentaci&oacute;n:";
		        break;
		    case "boletines":
		        $fecha_txt="Fecha de Sismo :";
		        break;
		    default:
		        $fecha_txt="Fecha de publicaci&oacute;n:";
		        break;
		}

                $comboMonth=comboMonth($month_pub,'xajax_obtenerIdDescripcion("month","registerMonthPub")');
		$comboYear=comboYear($year_pub,'xajax_registerYearPub(this.value)');
    
		$html='<div class="campo-buscador">Fecha de ingreso:</div>';
		$html.='<div class="contenedor-caja-buscador-1">';
		$html.="<input type='text' class='caja-buscador-4' name='date_ing' id='date_ing' READONLY value='$date_ing' />";
		$html.='</div>';
		$html.='<div style="clear:both"></div>';
                
                $html.='<div id="registerDate" style="display:block;">
                            <div style="clear:both;"></div>
                            <div class="campo-buscador">'.$fecha_txt.' </div>
                            <div class="contenedor-caja-buscador-1">
                                
                                <span>'.$comboMonth.'</span>
                                <span>'.$comboYear.'</span>
                            </div>
                        <div style="clear:both;"></div>	
                        </div>';
                
		$html.='</div>';
		$html.='<div style="clear:both"></div>';
	    return $html;
	}
        
	function iniEditPermission($tit_div,$cont_div){
	    $respuesta = new xajaxResponse();
	                                      
	    if(isset($_SESSION["edit"])){
	        $recuperar=$_SESSION["edit"];
	    }
	    elseif(isset($_SESSION["tmp"])){
	        $recuperar=$_SESSION["tmp"];
	    }
	
	    $result=searchPermission();
	    $html="";
		$checkbox="";
	    if($result["Error"]==0){
	        if($result["Count"]>0){
	
	            // El primer registro es el que determina si esta protegido con clave
	            if(isset($recuperar["permission"][1])){
	                    $checked="checked";
	            }
	            else{
	                    $checked="";
	            }
	
	            if(isset($recuperar["key"][1])){
	                    $checkedkey="checked";
	            }
	            else{
	                    $checkedkey="";
	            }
	            
                    $checkbox.="<div class='campo-buscador'>";
	            $checkbox.="<input $checked type=checkbox onclick=\"xajax_registerPermission('".$result["idpermission"][0]."' )\"  />&nbsp;".$result["permission_description"][0]."";
                    $checkbox.="</div>";                
                    $checkbox.="<div class='campo-buscador'>";
	            $checkbox.="<input $checkedkey type=checkbox onclick=\"xajax_registerPermissionKey('1')\"  />&nbsp; Clave</p>";
                    $checkbox.="</div>";
	            $checkbox.='<div style="clear:both"></div>';
                    $checkbox.="<p style='font-weight: bold;'>Permitir descarga desde las p&aacute;ginas web:</p>";
                    
	            // Los demas registros son las opciones de descarga
	            for($i=1;$i<$result["Count"];$i++){
	                    
	                    $key=$result["idpermission"][$i];
	                    if(isset($recuperar["permission"][$key])){
	                            $checked="checked";
	                    }
	                    else{
	                            $checked="";
	                    }
	
	                    
	                    if(isset($recuperar["key"][$key])){
	                            $checkedkey="checked";
	                    }
	                    else{
	                            $checkedkey="";
	                    }
	                    
	                    $clave=$i+1;
                            $checkbox.="<div class='campo-buscador'>";
	                    $checkbox.="<input $checked type=checkbox onclick=\"xajax_registerPermission('".$result["idpermission"][$i]."' )\"  />&nbsp;".$result["permission_description"][$i]."";
                            $checkbox.="</div>";                            
                            $checkbox.="<div class='campo-buscador'>";
	                    $checkbox.="<input $checkedkey type=checkbox onclick=\"xajax_registerPermissionKey('$clave')\"  />&nbsp; Clave";
                            $checkbox.="</div>";
                            $checkbox.='<div style="clear:both"></div>';
	            }
	        }
			else{
				$checkbox="No hay registros";
			}
	    }
	    else{
	        $checkbox="Error SQL";
	    }
	
		$html="<fieldset>".$checkbox."</fieldset>";
		$respuesta->Assign("$cont_div","innerHTML",$html);
		$respuesta->Assign("$tit_div","innerHTML","Permisos de descarga");
	    return $respuesta;
	}
        
	function iniPermission($tit_div,$cont_div){
	    $respuesta = new xajaxResponse();
	    
            
            registerPermission(1);
	    registerPermission(2);
            /*
            //if(isset($_SESSION["idsubcategory"])){
            //if($_SESSION["idsubcategory"]!=7){*/
                registerPermission(3);
                //registerPermission(4);
            //}}
            
                /*
            //if(isset($_SESSION["idsubcategory"])){
            //if($_SESSION["idsubcategory"]!=7){*/
                registerPermissionKey(1);
                registerPermissionKey(2);
                //registerPermissionKey(4);
            //}}
            
            $checked="";
            //if(isset($_SESSION["idsubcategory"])){
            //if($_SESSION["idsubcategory"]!=7){
                $checked="checked";
            //}}
            
	    $html="";
		$checkbox="";
		$checkbox.="<div class='campo-buscador'>";
		$checkbox.="<input checked type=checkbox onclick=\"xajax_registerPermission('1')\"  />&nbsp;IGP";
		$checkbox.="</div>";                
		$checkbox.="<div class='campo-buscador'><input $checked type=checkbox onclick=\"xajax_registerPermissionKey('1')\"  />&nbsp; Clave</p>";
		$checkbox.="</div>";
		$checkbox.='<div style="clear:both"></div>';
		$checkbox.="<p style='font-weight: bold;'>Permitir descarga desde las p&aacute;ginas web:</p>";

		$checkbox.="<div class='campo-buscador'><input checked type=checkbox onclick=\"xajax_registerPermission('2')\"  />&nbsp;Area</span>";
		$checkbox.="</div>";
		$checkbox.="<div class='campo-buscador'><input $checked type=checkbox onclick=\"xajax_registerPermissionKey('1')\"  />&nbsp; Clave";
		$checkbox.="</div>";
		$checkbox.='<div style="clear:both"></div>';
		$checkbox.="<div class='campo-buscador'><input $checked type=checkbox onclick=\"xajax_registerPermission('3')\"  />&nbsp;Autor";
		$checkbox.="</div>";
		$checkbox.="<div class='campo-buscador'><input type=checkbox onclick=\"xajax_registerPermissionKey('3')\"  />&nbsp; Clave";
		$checkbox.="</div>";
		$checkbox.='<div style="clear:both"></div>';                
		$checkbox.="<div class='campo-buscador'><input type=checkbox onclick=\"xajax_registerPermission('4')\"  />&nbsp;Transparencia";
		$checkbox.="</div>";
		$checkbox.="<div class='campo-buscador'><input type=checkbox onclick=\"xajax_registerPermissionKey('4')\"  />&nbsp; Clave";                
		$checkbox.="</div>";
		$checkbox.='<div style="clear:both"></div>';
            
		$html=$checkbox;
		$respuesta->Assign("$cont_div","innerHTML",$html);
		$respuesta->Assign("$tit_div","innerHTML","Permisos de descarga");
                
	    return $respuesta;
	    
	}


	function iniInstitucionExterna($tit_div,$cont_div){
	
		$respuesta = new xajaxResponse();
		$subcategory=$_SESSION["subcategory"];
	
		switch($subcategory){    
		    case "charlas_internas":
		        $fecha_txt="Fecha de Presentaci&oacute;n :";
		        break;
		}
	
		if(isset($_SESSION["edit"])){
			$recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
			$recuperar=$_SESSION["tmp"];
		}
	
		if(isset($recuperar["inst_ext"])){
			$inst_ext=$recuperar["inst_ext"];
		}
		else{
			$inst_ext="";
		}

		$html ="<form name='form_inst_ext' id='form_inst_ext' >";
		$html.="<input type='text' class='field' onchange='xajax_registerInst_Ext(this.value); return false;' value='$inst_ext' name='inst_ext' id='inst_ext'>";
		//$html.="<input class='button' type='submit' value='Guardar'  />";
		$html.="</form>";
		$respuesta->Assign("$cont_div","innerHTML",$html);
		$respuesta->Assign("$tit_div","innerHTML","Instituci&oacute;n Externa");
	
	    return $respuesta;
	}


function iniOtrosTemasShow(){
	$respuesta = new xajaxResponse();
    $titulo="Asociar a otros temas (debe de haber seleccionado por lo menos un área)";
	$respuesta->Assign("titOtrosTemas","innerHTML",$titulo);
	return $respuesta;
}
	

?>