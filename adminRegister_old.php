<?php

	function registerArea($idarea){
	    $respuesta = new xajaxResponse();
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["areasSEC"][$idarea])){
		        unset($_SESSION["edit"]["areasSEC"][$idarea]);
		
		        $range=readSessionArea();
		        $script="xajax_otrosTemasShow('$range')";
		        $respuesta->script($script);
		
		    }
		    else{
		        $_SESSION["edit"]["areasSEC"][$idarea]=1;
		        $range=readSessionArea();
		        $script="xajax_otrosTemasShow('$range')";
		        $respuesta->script($script);
		    }
		}
		else{
		    if(isset($_SESSION["tmp"]["areasSEC"][$idarea])){
		        unset($_SESSION["tmp"]["areasSEC"][$idarea]);
		
		        $range=readSessionArea();
		        $script="xajax_otrosTemasShow('$range')";
		        $respuesta->script($script);
		
		    }
		    else{
		        $_SESSION["tmp"]["areasSEC"][$idarea]=1;
		        $range=readSessionArea();
		        $script="xajax_otrosTemasShow('$range')";
		        $respuesta->script($script);
		    }
		}
	    //$respuesta->alert(print_r($_SESSION, true));
	    return $respuesta;
	}


	function registerTheme($idtheme,$theme_description){
	    $respuesta = new xajaxResponse();
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["themes"][$idtheme])){
		        unset($_SESSION["edit"]["themes"][$idtheme]);
		    }
		    else{
		        $_SESSION["edit"]["themes"][$idtheme]=1;
		    }
		
		
		    if(isset($_SESSION["edit"]["themes_description"][$idtheme])){
		        unset($_SESSION["edit"]["themes_description"][$idtheme]);
		    }
		    else{
		        $_SESSION["edit"]["themes_description"][$idtheme]=$theme_description;
		    }
		}
		else{
		    if(isset($_SESSION["tmp"]["themes"][$idtheme])){
		        unset($_SESSION["tmp"]["themes"][$idtheme]);
		    }
		    else{
		        $_SESSION["tmp"]["themes"][$idtheme]=1;
		    }
		
		
		    if(isset($_SESSION["tmp"]["themes_description"][$idtheme])){
		        unset($_SESSION["tmp"]["themes_description"][$idtheme]);
		    }
		    else{
		        $_SESSION["tmp"]["themes_description"][$idtheme]=$theme_description;
		    }
		}
	    //$respuesta->alert(print_r($_SESSION["tmp"]["themes"], true));
	    return $respuesta;
	}




	function registerAreaAdministrativa($idarea){
	    $respuesta = new xajaxResponse();
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["areasAdministrativas"][$idarea])){
		        unset($_SESSION["edit"]["areasAdministrativas"][$idarea]);
		
		    }
		    else{
		        $_SESSION["edit"]["areasAdministrativas"][$idarea]=1;
		       
		    }
		}
		else{    
		    if(isset($_SESSION["tmp"]["areasAdministrativas"][$idarea])){
		        unset($_SESSION["tmp"]["areasAdministrativas"][$idarea]);
		    }
		    else{
		        $_SESSION["tmp"]["areasAdministrativas"][$idarea]=1;
		    }
		}
	    //$respuesta->alert(print_r($_SESSION["edit"], TRUE));
	    return $respuesta;
	}


	function registerBoletin($nroBoletin){
	    $respuesta = new xajaxResponse();
	
	    if($nroBoletin==""){
	        $respuesta->alert("Ingrese Nro Boletín");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["nroBoletin"]=$nroBoletin;
	        }
	        else{
	            $_SESSION["tmp"]["nroBoletin"]=$nroBoletin;
	        }
	
	    }
	
            //$respuesta->alert(print_r($_SESSION["tmp"], TRUE));
	    return $respuesta;
	}

	function registerMagnitud($idmagnitud){
	    $respuesta = new xajaxResponse();
	
	    if($idmagnitud==0){
	        $respuesta->alert("Ingrese la Magnitud");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["idmagnitud"]=$idmagnitud;
	        }
	        else{
	            $_SESSION["tmp"]["idmagnitud"]=$idmagnitud;
	        }
	    }
	
            //$respuesta->alert(print_r($_SESSION["tmp"], TRUE));
	    return $respuesta;
	}


	function registerLink($enlace){
	    $respuesta = new xajaxResponse();
	
	
	    if($enlace==""){
	        $respuesta->alert("Ingrese Link");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["enlace"]=$enlace;
	
	        }
	        else{
	
	            $_SESSION["tmp"]["enlace"]=$enlace;
	        }
	
	        }
	    return $respuesta;
	}

	function registerLugar($lugar){
	    $respuesta = new xajaxResponse();
	
	    if($lugar==""){
	        $respuesta->alert("Ingrese Lugar");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["lugar"]=$lugar;
	        }
	        else{
	
	            $_SESSION["tmp"]["lugar"]=$lugar;
	        }
		}
	
	    return $respuesta;
	}



	function registerNomEvento($evento_description){
	    $respuesta = new xajaxResponse();
	
	    if($evento_description==""){
	        $respuesta->alert("Ingrese Nombre del Evento");
	    }
	    else{
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){
	                $_SESSION["edit"]["evento_description"]=$evento_description;
	            }
	        }
	        else{
	            $_SESSION["tmp"]["evento_description"]=$evento_description;
	        }
	
	
	        }
	    return $respuesta;
	}

	function registerCatEvento($categoriaEvento_id,$categoriaEvento_description){
	    $respuesta = new xajaxResponse();
	    
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
            
	    if($categoriaEvento_id==0){
	        $respuesta->alert("Necesita seleccionar la categoría del evento");
                $recuperar["idcategoriaEvento"]=0;
                $recuperar["categoriaEvento_description"]="";
	    }
	    else{
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){
	                $_SESSION["edit"]["idcategoriaEvento"]=$categoriaEvento_id;
	                $_SESSION["edit"]["categoriaEvento_description"]=$categoriaEvento_description;
	            }
	        }
	        else{
	            $_SESSION["tmp"]["idcategoriaEvento"]=$categoriaEvento_id;
	            $_SESSION["tmp"]["categoriaEvento_description"]=$categoriaEvento_description;
	        }
	
		}
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

	function registerClaseEvento($claseEvento_id,$claseEvento_description){
	    $respuesta = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
            
	    if($claseEvento_id==0){
	        $respuesta->alert("Necesita seleccionar la clase del evento");
                $_SESSION["edit"]["idclaseEvento"]=0;
                $_SESSION["edit"]["claseEvento_description"]="";                
	    }
	    else{
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){
	                $_SESSION["edit"]["idclaseEvento"]=$claseEvento_id;
	                $_SESSION["edit"]["claseEvento_description"]=$claseEvento_description;
	            }
	        }
	        else{
	            $_SESSION["tmp"]["idclaseEvento"]=$claseEvento_id;
	            $_SESSION["tmp"]["claseEvento_description"]=$claseEvento_description;
	        }
	
            }
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

/**************************************************
Funcion que muestra un combo
***************************************************/
function registerComboTipoPublicacionShow($dbid=0,$seccion=0){
$objResponse = new xajaxResponse();

switch($seccion){
    case 1:
    $iniCombo="Elige";
    $divCombo="registerTypePublication";
    $funcion="xajax_formSubcategoryShow(this.value)";
    break;
    case 2:
    $iniCombo="Elige Tipo Publicaci&oacute;n";
    $divCombo="searchTypePublication";
    //$funcion="xajax_comboReferenciaShow(this.value,0,2),xajax_comboEstadoPublicacionShow(0,2)";
    $funcion="xajax_seccionShow(this.value)";
    break;
    case 3:
    $iniCombo="";
    $divCombo="";
    $funcion="";
    break;
}

	$desc = array("Art&iacute;culos Indexados","Otras Publicaciones","Tesis");
	$id = array("1","3","2");

        if($dbid!=0){
                /*buscar la posición de la variable $tipo recuperada
                para mostrarla como valor inicial del combo*/
                $pos = array_search($dbid,$id);
                $pos=$pos+1;
        }
        else{
                $pos=0;
        }

	if (is_array($desc) and is_array($id)){
		$cboPubRef=new combo();
		$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","tipoPublicacion",$pos);
		$objResponse->assign($divCombo, 'innerHTML',$comboPubRef);
	}
	else{
		$objResponse->assign($divCombo, 'innerHTML', 'No data available');
	}

return $objResponse;
}
	

	function registerCompendio($nroCompendio){
	    $respuesta = new xajaxResponse();
	
	    if($nroCompendio==0){
	        $respuesta->alert("Ingrese Número Compendio");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["nroCompendio"]=$nroCompendio;
	
	        }
	        else{
	            $_SESSION["tmp"]["nroCompendio"]=$nroCompendio;
	        }
	
		}
    	return $respuesta;
	}

	function registerDayPub($day_pub){
	    $respuesta = new xajaxResponse();
	
	    if($day_pub==0){
	        $respuesta->alert("Ingrese día de publicación");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["day_pub"]=$day_pub;
	
	        }
	        else{
	            $_SESSION["tmp"]["day_pub"]=$day_pub;
	        }
            }
                
                //$respuesta->alert(print_r($_SESSION["edit"], true));
	    return $respuesta;
	}
        
	function registerYearPub($year_pub){
	    $respuesta = new xajaxResponse();
	
	    if($year_pub==0){
	        $respuesta->alert("Ingrese Año de Publicación");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["year_pub"]=$year_pub;
	
	        }
	        else{
	            $_SESSION["tmp"]["year_pub"]=$year_pub;
	        }
            }
                
                //$respuesta->alert(print_r($_SESSION["edit"], true));
	    return $respuesta;
	}

	function registerMonthPub($month_pub,$desc_month_pub=""){
	    $respuesta = new xajaxResponse();
	
            if(isset($_SESSION["edit"])){
                $recuperar=$_SESSION["edit"];
            }
            elseif(isset($_SESSION["tmp"])){
                $recuperar=$_SESSION["tmp"];
            }
            
	    if($month_pub==0){
	        //$respuesta->alert("Ingrese mes");
                if(isset($_SESSION["edit"])){
                    $_SESSION["edit"]["month_pub"]=0;
                    $_SESSION["edit"]["desc_month_pub"]="";
                }
                else{
                    $_SESSION["tmp"]["month_pub"]=0;
                    $_SESSION["tmp"]["desc_month_pub"]="";

                }
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["month_pub"]=$month_pub;
                    $_SESSION["edit"]["desc_month_pub"]=$desc_month_pub;
	
	        }
	        else{
	            $_SESSION["tmp"]["month_pub"]=$month_pub;
                    $_SESSION["tmp"]["desc_month_pub"]=$desc_month_pub;
	        }
            }
                
                //$respuesta->alert(print_r($_SESSION["edit"], true));
                //$respuesta->alert($month_pub);
	    return $respuesta;
	}

	function registerYearQuarter($yearQuarter){
	    $respuesta = new xajaxResponse();
	
	    if($yearQuarter==0){
	        $respuesta->alert("Ingrese Año de trimestre");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["yearQuarter"]=$yearQuarter;
	
	        }
	        else{
	            $_SESSION["tmp"]["yearQuarter"]=$yearQuarter;
	        }
		}
                
                //$respuesta->alert(print_r($_SESSION["edit"], true));
	    return $respuesta;
	}

	function registerYearCompendio($yearCompendio){
	    $respuesta = new xajaxResponse();
	
	    if($yearCompendio==0){
	        $respuesta->alert("Ingrese Año de Compendio");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["yearCompendio"]=$yearCompendio;
	
	        }
	        else{
	            $_SESSION["tmp"]["yearCompendio"]=$yearCompendio;
	        }
		}
                
                $respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}
        
	function registerYear($year){
	    $respuesta = new xajaxResponse();
	
	    if($year==0){
	        $respuesta->alert("Ingrese Año");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["year"]=$year;
	
	        }
	        else{
	            $_SESSION["tmp"]["year"]=$year;
	        }
		}
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

	function registerReferenceDetails($reference_details){
	    $respuesta = new xajaxResponse();
	
	    if($reference_details==""){
	        $respuesta->alert("Ingrese Detalle de la Referencia");
	    }
	    else{
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){
	                $_SESSION["edit"]["reference_details"]=$reference_details;
	            }
	        }
	        else{
	                $_SESSION["tmp"]["reference_details"]=$reference_details;
	        }
		}
	    return $respuesta;
	}

	function registerReference($referencia_id,$reference_description){
	    $respuesta = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
            
	    if($referencia_id==0){
	        $respuesta->alert("Necesita seleccionar una referencia");
                $recuperar["idcategoriaEvento"]=0;
                $recuperar["categoriaEvento_description"]="";
                
	    }
	    else{
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){                
	                $_SESSION["edit"]["idreference"]=$referencia_id;
                        $reference_description=addslashes($reference_description);
	                $_SESSION["edit"]["reference_description"]=$reference_description;
	                }
	        }
	        else{
	                $_SESSION["tmp"]["idreference"]=$referencia_id;
                        $reference_description=addslashes($reference_description);
	                $_SESSION["tmp"]["reference_description"]=$reference_description;
	        }
	
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
		}
	
	    
	    return $respuesta;
	}



	function registerResumen($resumen){
	    $respuesta = new xajaxResponse();
	
	    if($resumen==""){
	        //$respuesta->alert("Ingrese Resumen");
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["resumen"]="";
	        }
	        else{
	            $_SESSION["tmp"]["resumen"]="";
	        }
	        
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["resumen"]=$resumen;
	        }
	        else{
	            $_SESSION["tmp"]["resumen"]=$resumen;
	        }
	        
	    }
	
            //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

	function registerTitRes($form){
	    $respuesta = new xajaxResponse();
	
	
	    $title=addslashes($form["title"]);
	    $abstract=addslashes($form["abstrac"]);
	
	    if($title==""){
	        $respuesta->alert("Ingrese Título");
	    }
	    elseif($abstract==""){
	        $respuesta->alert("Ingrese Resumen");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["titulo"]=$title;
	            $_SESSION["edit"]["resumen"]=$abstract;
	        }
	        else{
	            $_SESSION["tmp"]["titulo"]=$title;
	            $_SESSION["tmp"]["resumen"]=$abstract;
	        }
	        $respuesta->alert("Título y Resumen guardados correctamente");
	    }
            
            //$respuesta->alert(print_r($_SESSION["edit"]["titulo"], true));
	    return $respuesta;
	}

	function registerTipoPonencia($tipoPonencia_id,$tipoPonencia_txt){
	    $respuesta = new xajaxResponse();
	    
	    if($tipoPonencia_id==0){
	        $respuesta->alert("Seleccione Tipo Ponencia");
	    }   
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["idtipoPonencia"]=$tipoPonencia_id;
	            $_SESSION["edit"]["tipoPonencia_description"]=$tipoPonencia_txt;           
	        }
	        else{
	            $_SESSION["tmp"]["idtipoPonencia"]=$tipoPonencia_id;
	            $_SESSION["tmp"]["tipoPonencia_description"]=$tipoPonencia_txt;         
	        }
		}
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
                
	    return $respuesta;
	}

	function registerPrePorNombre($prePorNombre){
	    $respuesta = new xajaxResponse();
	
	    if($prePorNombre==""){
	        $respuesta->alert("Ingrese Nombre del presentador");
	    } 
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["prePorNombre"]=$prePorNombre;           
	        }
	        else{
	            $_SESSION["tmp"]["prePorNombre"]=$prePorNombre;           
	        }
		}
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

	function registerPrePorApellido($prePorApellido){
	    $respuesta = new xajaxResponse();
	
	    if($prePorApellido==""){
	        $respuesta->alert("Ingrese apellido del presentador");
	    } 
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["prePorApellido"]=$prePorApellido;           
	        }
	        else{
	            $_SESSION["tmp"]["prePorApellido"]=$prePorApellido;           
	        }
	
		}
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}


	function registerInst_Ext($inst_ext){
	    $respuesta = new xajaxResponse();
	
	    //$inst_ext=$form["inst_ext"];
	
	    if($inst_ext==""){
	        $respuesta->alert("Ingrese institución externa");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["inst_ext"]=$inst_ext;
	        }
	        else{
	            $_SESSION["tmp"]["inst_ext"]=$inst_ext;
	            
	        }        
	    }
            
            //$respuesta->alert(print_r($_SESSION["tmp"], TRUE));

	    return $respuesta;
	}

	function registerTitPrePor($form){
	    $respuesta = new xajaxResponse();
	
	    $title=addslashes($form["title"]);
	    $prePorNombre=$form["prePorNombre"];
	    $prePorApellido=$form["prePorApellido"];
	
	    if($title==""){
	        $respuesta->alert("Ingrese Título");
	    }
	    elseif($prePorNombre==""){
	        $respuesta->alert("Ingrese nombre del presentado");
	    }
	    elseif($prePorApellido==""){
	        $respuesta->alert("Ingrese Apellido del Presentado");
	    }    
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["titulo"]=$title;
	            $_SESSION["edit"]["prePorNombre"]=$prePorNombre;            
	            $_SESSION["edit"]["prePorApellido"]=$prePorApellido;
	        }
	        else{
	            $_SESSION["tmp"]["titulo"]=$title;
	            $_SESSION["tmp"]["prePorNombre"]=$prePorNombre;
	            $_SESSION["tmp"]["prePorApellido"]=$prePorApellido;
	
	        }
	
	        $respuesta->alert("Titulo y presentado por guardados correctamente");
	
	        }
	
	    
        
	    return $respuesta;
	}

	function registerTipoTesis($idtipoTesis,$tipoTesisDescription){
	    $respuesta = new xajaxResponse();
	    if($idtipoTesis==0){
	        $respuesta->alert("Seleccione Tipo de tesis");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["tipo_tesis"]=$idtipoTesis;
	            $_SESSION["edit"]["tipoTesisDescription"]=$tipoTesisDescription;
	        }
	        else{
	            $_SESSION["tmp"]["tipo_tesis"]=$idtipoTesis;
	            $_SESSION["tmp"]["tipoTesisDescription"]=$tipoTesisDescription;
	        }
	
	    }
            
            //$respuesta->alert(print_r($_SESSION["edit"]["tipo_tesis"], true));
	    return $respuesta;
	
	}

	function registerPais($pais_description){
	    $respuesta = new xajaxResponse();
	      
	    if($pais_description==""){
	        $respuesta->alert("Ingrese país");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["pais_description"]=$pais_description;
	        }
	        else{
	            $_SESSION["tmp"]["pais_description"]=$pais_description;
	        }
	    }
            
            //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	
	}

	function registerUniversidad($pais_description){
	    $respuesta = new xajaxResponse();
	      
	    if($pais_description==""){
	        $respuesta->alert("Ingrese universidad");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["uni_description"]=$pais_description;
	        }
	        else{
	            $_SESSION["tmp"]["uni_description"]=$pais_description;
	        }
	
	    }
	    return $respuesta;
	
	}



	function registerRegion($region_id,$region_description){
	    $respuesta = new xajaxResponse();
	
	    if($region_id==0){
	        $respuesta->alert("Seleccione región");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["idRegion"]=$region_id;
	            $_SESSION["edit"]["region_description"]=$region_description;
	        }
	        else{
	            $_SESSION["tmp"]["idRegion"]=$region_id;
	            $_SESSION["tmp"]["region_description"]=$region_description;
	        }
	
		}
                
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	
	}

	function registerDepartamento($departamento_id,$departamento_description){
	    $respuesta = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
            
	    if($departamento_id==0){
	        $respuesta->alert("Seleccione departamento");
                $recuperar["idDepartamento"]=0;
                $recuperar["departamento_description"]="";
                
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["idDepartamento"]=$departamento_id;
	            $_SESSION["edit"]["departamento_description"]=$departamento_description;
	        }
	        else{
	
	            $_SESSION["tmp"]["idDepartamento"]=$departamento_id;
	            $_SESSION["tmp"]["departamento_description"]=$departamento_description;
	        }
	
		}
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}



	function registerQuarter($idquarter,$quarter_description){
	    $respuesta = new xajaxResponse();
	    if($idquarter==0){
	        $respuesta->alert("Seleccione trimestre");
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["quarter_description"]=$quarter_description;
	            $_SESSION["edit"]["idquarter"]=$idquarter;
	
	        }
	        else{
	            $_SESSION["tmp"]["quarter_description"]=$quarter_description;
	            $_SESSION["tmp"]["idquarter"]=$idquarter;
	        }
	    }
            
            //$respuesta->alert(print_r($_SESSION["tmp"], true));
	    return $respuesta;
	}

	
	function registerDateIng(){
            $respuesta = new xajaxResponse();
             $fecha=date("Y-m-d");
	     if(isset($_SESSION["edit"]["date_ing"])){
	         unset($_SESSION["edit"]["date_ing"]);
	         $_SESSION["edit"]["date_ing"]=$fecha;
	     }
	     else{
		$_SESSION["tmp"]["date_ing"]=$fecha;
	     }
	
             //$respuesta->alert(print_r($_SESSION["tmp"], true));
             return $respuesta;
	}

	function registerDatePub($value){
	
	     if(isset($_SESSION["edit"]["date_pub"])){
	         unset($_SESSION["edit"]["date_pub"]);
	         $_SESSION["edit"]["date_pub"]=$value;
	     }
	     else{
	         $_SESSION["tmp"]["date_pub"]=$value;
	     }
	}



	function registerPermission($idpermission){
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["permission"][$idpermission])){
		        unset($_SESSION["edit"]["permission"][$idpermission]);
		    }
		    else{
		        $_SESSION["edit"]["permission"][$idpermission]=1;
		    }
		}
		else{
		    if(isset($_SESSION["tmp"]["permission"][$idpermission])){
		        unset($_SESSION["tmp"]["permission"][$idpermission]);
		    }
		    else{
		        $_SESSION["tmp"]["permission"][$idpermission]=1;
		    }
		}
	    //echo print_r($_SESSION);
	}

	function registerPermissionKey($idclave){
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["key"][$idclave])){
		        unset($_SESSION["edit"]["key"][$idclave]);
		    }
		    else{
		        $_SESSION["edit"]["key"][$idclave]=1;
		    }
		}
		else{
		    if(isset($_SESSION["tmp"]["key"][$idclave])){
		        unset($_SESSION["tmp"]["key"][$idclave]);
		    }
		    else{
		        $_SESSION["tmp"]["key"][$idclave]=1;
		    }
		}
	    //echo print_r($_SESSION["edit"]);
	}

	function registerStatus($idstatus){
	    
	     if(isset($_SESSION["edit"]["status"])){
	         unset($_SESSION["edit"]["status"]);
	         $_SESSION["edit"]["status"]=$idstatus;
	     }
	     else{
	        $_SESSION["tmp"]["status"]=$idstatus;
	     }
	
             //echo print_r($_SESSION["tmp"]);
	}


	function registerSubAreas($idarea){
	    $respuesta = new xajaxResponse();
	
		if(isset($_SESSION["editar"])){
		    if(isset($_SESSION["edit"]["subAreas"][$idarea])){
		        unset($_SESSION["edit"]["subAreas"][$idarea]);
		    }
		    else{
		        $_SESSION["edit"]["subAreas"][$idarea]=1;
		    }
		}
		else{    
		    if(isset($_SESSION["tmp"]["subAreas"][$idarea])){
		        unset($_SESSION["tmp"]["subAreas"][$idarea]);
		    }
		    else{
		        $_SESSION["tmp"]["subAreas"][$idarea]=1;
		    }
		}
		//    $respuesta->alert(print_r($_SESSION["tmp"], TRUE));
	    return $respuesta;
	}

	function registerTitulo($title){
	    $respuesta = new xajaxResponse();
            
           
	    if($title==""){
	        $respuesta->alert("Ingrese título");                
	    }
	    else{
	        if(isset($_SESSION["edit"])){
	            $_SESSION["edit"]["titulo"]=addslashes($title);
	        }
	        else{
	            $_SESSION["tmp"]["titulo"]=addslashes($title);
	        }
	        
	    }

            //$respuesta->alert(print_r($_SESSION["tmp"], TRUE));
	    return $respuesta;
	}


	function registraAuthorResult($form_entrada){
	    $resultCheck=checkDataForm($form_entrada);
	    if ($resultCheck["Error"]==1){
	            $result["Msg"]=$resultCheck["Msg"];
	            $result["Error"]="completar";
	    }
	
	    else{
/*                
	        $pNombre=strtolower($form_entrada["pNombre"]);
	        $sNombre=strtolower($form_entrada["sNombre"]);                
	        $apellido=strtolower($form_entrada["apellido"]);
*/

	        $pNombre=$form_entrada["pNombre"];
	        $sNombre=$form_entrada["sNombre"];                
	        $apellido=$form_entrada["apellido"];

/*                if(ereg("'",$form_entrada["apellido"])){
                    $apellido=explode("'",$form_entrada["apellido"]);
                    $antes_caracter=ucfirst($apellido[0]);
                    $despues_caracter=$apellido[1];
                    $apellido=$antes_caracter."'".$despues_caracter;
                }
                else{
                    $apellido=strtolower($form_entrada["apellido"]);
                }
*/                
	        $result=registraAuthorSQL($pNombre,$sNombre,$apellido);
	    }
	
		return $result;   
	}

	function registraAuthorShow($form_entrada=""){
		$respuesta = new xajaxResponse();
		$result=registraAuthorResult($form_entrada);
		$error=isset($result["Error"])?$result["Error"]:"";
		 
		switch($error){
		case "completar":
		    $respuesta->alert($result["Msg"]);
		break;
		case "existe":
		    $respuesta->alert($result["Msg"]);
		    $respuesta->assign('pNombre', 'value','');
		    $respuesta->assign('sNombre', 'value','');
		    $respuesta->assign('apellido', 'value','');
		
		break;
		case "registrado":   
		    $respuesta->alert($result["Msg"]);
                    //$respuesta->alert($error);
		            $apellido=$result["apellido"];
		            $respuesta->assign('sAuthor', 'value',$apellido);
		            $respuesta->assign('pNombre', 'value','');
		            $respuesta->assign('sNombre', 'value','');
		            $respuesta->assign('apellido', 'value','');
		
		$respuesta->script("xajax_auxAuthorPriShow(5,1,xajax.getFormValues('autorPRI'))");
		
		break;
                case 4:
                    $respuesta->alert($result["Msg"]);
		break;
		}
		
		return $respuesta;
	}


	function registraReferenciaResult($referencia="",$abrev=""){
    	$result=registraReferenciaSQL($referencia,$abrev);
    	return $result;
	}

	function registraReferenciaShow($referencia="",$abrev=""){
	    $respuesta = new xajaxResponse();
	    $result=registraReferenciaResult($referencia,$abrev);
	    $idreferenceultimo=$result["idreferenceultimo"];
	    $referenceultimo_txt=$result["reference_description_ultimo"];
	    $detalleReferenceultimo_txt=$result["reference_description_ultimo"];
	
	    $cadena="xajax_comboReferenciaShow($idreferenceultimo,1)";
	    $respuesta->script($cadena);
	
	        if(isset($_SESSION["editar"])){
	            if($_SESSION["editar"]==1){
	                $_SESSION["edit"]["idreference"]=$idreferenceultimo;
	                $_SESSION["edit"]["reference_description"]=$referenceultimo_txt;
	                $_SESSION["edit"]["reference_details"]=$detalleReferenceultimo_txt;
	            }
	        }
	        else{
	            if($_SESSION["tmp"]){
	                $_SESSION["tmp"]["idreference"]=$referencia_id;
	                $_SESSION["tmp"]["reference_description"]=$referenceultimo_txt;
	                $_SESSION["tmp"]["reference_details"]=$detalleReferenceultimo_txt;
	
	            }
	        }

	    $respuesta->assign("divNuevaRefe", "innerHTML", "");
	    return $respuesta;
	}


?>
