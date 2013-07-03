<?php

	function editShow($iddata=0){
		$respuesta= new xajaxResponse();
		
		$result=searchPublication_iddataSQL(0,"",$iddata);
		$idCategory=$result["idcategory"][0];
		$idSubcategory=$result["idsubcategory"][0];                
                
                $_SESSION["edit"]["iddata"]=$iddata;
                
		if($result["Count"]>0){
		    $_SESSION["editar"]=1;


            if (isset($_SESSION["publicaciones"]["authorPRI"])){
                unset($_SESSION["publicaciones"]["authorPRI"]);
            }

            if (isset($_SESSION["publicaciones"]["authorSEC"])){
                unset($_SESSION["publicaciones"]["authorSEC"]);
            }
            
                    
                //$respuesta->alert(print_r($result, true));                    
		
			if(isset($_SESSION["edit"]["authorPRI"])){
		        //Limpiamos los valores de la sesión
		        unset($_SESSION["edit"]["authorPRI"]);
			}
		
			if(isset($_SESSION["edit"]["authorSEC"])){
		        //Limpiamos los valores de la sesión
		        unset($_SESSION["edit"]["authorSEC"]);
			}

                        
		    foreach ($result["data_content"] as $xmldata){
		        $xmlt = simplexml_load_string($xmldata);
		        $titulo=(string)$xmlt->titulo;
                        $titulo=(str_replace("*","'",$titulo));
		        $resumen=(string)$xmlt->resumen;
		        $enlace=(string)$xmlt->enlace;
		        $enlace=(str_replace("*","&",$enlace));
		        $idreference=(string)$xmlt->idreference;
		        $reference_description=(string)$xmlt->reference_description;
		        $reference_details=(string)$xmlt->reference_details;
		        $idtipoPonencia=(string)$xmlt->idtipoPonencia;
		        $tipoPonencia_description=(string)$xmlt->tipoPonencia_description;
		        $prePorNombre=(string)$xmlt->prePorNombre;
		        $prePorApellido=(string)$xmlt->prePorApellido;
                        $prePorApellido=(str_replace("*","'",$prePorApellido));
                        
		        $lugar=(string)$xmlt->lugar;
		        $pais=(string)$xmlt->pais;
		
		        $evento_description=(string)$xmlt->evento_description;
		        $idcategoriaEvento=(string)$xmlt->idcategoriaEvento;
		        $categoriaEvento_description=(string)$xmlt->categoriaEvento_description;
		        $idclaseEvento=(string)$xmlt->idclaseEvento;
		        $claseEvento_description=(string)$xmlt->claseEvento_description;
		
		        //Año para Trimestre y Compendio
                        
                        $year=(string)$xmlt->year;
                        $yearQuarter=(string)$xmlt->yearQuarter;
                        
		        $idquarter=(string)$xmlt->idquarter;
		        $quarter_description=(string)$xmlt->quarter_description;
		        
                        //Año y mes de publicación
                        $year_pub=(string)$xmlt->year_pub;
                        $month_pub=(string)$xmlt->month_pub;
                        $desc_month_pub=(string)$xmlt->desc_month_pub;
                        $day_pub=(string)$xmlt->day_pub;
		
		        $nroBoletin=(string)$xmlt->nroBoletin;
		        $idmagnitud=(string)$xmlt->idmagnitud;
		
		        $idRegion=(string)$xmlt->idRegion;
		        $region_description=(string)$xmlt->region_description;
		        $idDepartamento=(string)$xmlt->idDepartamento;
		        $departamento_description=(string)$xmlt->departamento_description;
		
		
		        $nroCompendio=(string)$xmlt->nroCompendio;
		        
		        
		        $date_ing=(string)$xmlt->date_ing;
		        $date_pub=(string)$xmlt->date_pub;
                        
                        
		        $date_ing_tesis=(string)$xmlt->date_ing;
		        $date_pub_tesis=(string)$xmlt->date_pub;
                        
		        $status=(string)$xmlt->status;
		
		        $tipo_tesis=(string)$xmlt->tipo_tesis;
		        $tipoTesisDescription=(string)$xmlt->tipoTesisDescription;
		        $pais_description=(string)$xmlt->pais_description;
		        $uni_description=(string)$xmlt->uni_description;
		
		        $inst_ext=(string)$xmlt->inst_ext;
		        $areaPRI=(int)$xmlt->areaPRI;
		        $pdf=(string)$xmlt->pdf;
		        $autorPRI=(string)$xmlt->authorPRI->idauthor0;
		        $autorSEC="";
		        if(isset($xmlt->authorSEC)){
		                //Preguntamos si hay mas de un autor secundario
		
		            if(isset($xmlt->authorSEC->idauthor1)){
		                    for($j=0;$j<100;$j++){
		                            eval('if (isset($xmlt->authorSEC->idauthor'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
		                            if($xmlflag){
		                                    eval('$xmlidauthor=$xmlt->authorSEC->idauthor'.$j.';');
		                                    $autorSEC=(string)$xmlidauthor;
		                                    //se inicializa el array para que no de error scalar
		                                    //$_SESSION["edit"]["authorSEC"]=array();
		                                    $_SESSION["edit"]["authorSEC"][$autorSEC]=1;
		
		                            }
		                    }
		
		            }
		            //Solo un autor secundario
		            else{                   
		                    $autorSEC=(string)$xmlt->authorSEC->idauthor0;
		                    $_SESSION["edit"]["authorSEC"][$autorSEC]=1;
		            }
		
		        }
		        else{
		                $autorSEC="";
		        }
		
		////////////////Recupera Permisos/////////////////////
					$permisos="";
					if(isset($xmlt->permisos)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->permisos->idpermission1)){
								eval('if (isset($xmlt->permisos->idpermission1)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlpermisos=$xmlt->permisos->idpermission1;');
		                                                        $permisos=(int)$xmlpermisos;
		                                                        $_SESSION["edit"]["permission"][$permisos]=1;
								}                                           
	
						}
						if(isset($xmlt->permisos->idpermission2)){
								eval('if (isset($xmlt->permisos->idpermission2)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlpermisos=$xmlt->permisos->idpermission2;');
		                                                        $permisos=(int)$xmlpermisos;
		                                                        $_SESSION["edit"]["permission"][$permisos]=1;
								}                                           
		
						}
						if(isset($xmlt->permisos->idpermission3)){
								eval('if (isset($xmlt->permisos->idpermission3)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlpermisos=$xmlt->permisos->idpermission3;');
		                                                        $permisos=(int)$xmlpermisos;
		                                                        $_SESSION["edit"]["permission"][$permisos]=1;
								}                                           
		
						}
						if(isset($xmlt->permisos->idpermission4)){
								eval('if (isset($xmlt->permisos->idpermission4)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlpermisos=$xmlt->permisos->idpermission4;');
		                                                        $permisos=(int)$xmlpermisos;
		                                                        $_SESSION["edit"]["permission"][$permisos]=1;
								}                                           
		
						}
		
					}
					else{
						$permisos="";
					}
		////////////////////////////////////////////////////
		////////////////Recupera Claves/////////////////////
					$claves="";
					if(isset($xmlt->claves)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->claves->idkey1)){
							for($j=1;$j<100;$j++){
								eval('if (isset($xmlt->claves->idkey1)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlclaves=$xmlt->claves->idkey1;');
		                                                        $claves=(int)$xmlclaves;
		                                                        $_SESSION["edit"]["key"][$claves]=1;
								}                                           
							}
		
						}
						if(isset($xmlt->claves->idkey2)){
							for($j=1;$j<100;$j++){
								eval('if (isset($xmlt->claves->idkey2)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlclaves=$xmlt->claves->idkey2;');
		                                                        $claves=(int)$xmlclaves;
		                                                        $_SESSION["edit"]["key"][$claves]=1;
								}                                           
							}
		
						}
						if(isset($xmlt->claves->idkey3)){
							for($j=1;$j<100;$j++){
								eval('if (isset($xmlt->claves->idkey3)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlclaves=$xmlt->claves->idkey3;');
		                                                        $claves=(int)$xmlclaves;
		                                                        $_SESSION["edit"]["key"][$claves]=1;
								}                                           
							}
		
						}
						if(isset($xmlt->claves->idkey4)){
							for($j=1;$j<100;$j++){
								eval('if (isset($xmlt->claves->idkey4)){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlclaves=$xmlt->claves->idkey4;');
		                                                        $claves=(int)$xmlclaves;
		                                                        $_SESSION["edit"]["key"][$claves]=1;
								}                                           
							}
		
						}
		                                
		
					}
					else{
						$claves="";
					}
		////////////////////////////////////////////////////
		
		////////////////Recupera Areas/////////////////////
					$areasSEC="";
					if(isset($xmlt->areasSEC)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->areasSEC->idarea1)){
							for($j=0;$j<100;$j++){
								eval('if (isset($xmlt->areasSEC->idarea'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlareas=$xmlt->areasSEC->idarea'.$j.';');
									$areasSEC=(int)$xmlareas;
									$_SESSION["edit"]["areasSEC"][$areasSEC]=1;
								}
							}
		
						}
						//Solo un autor secundario
		
						else{
							$areasSEC.=(int)$xmlt->areasSEC->idarea0;
							$_SESSION["edit"]["areasSEC"][$areasSEC]=1;
						}
		
		
					}
					else{
						$areasSEC="";
					}
		////////////////////////////////////////////////////
		////////////////Recupera Sub Areas Aeronomia/////////////////////
					$subAreas="";
					if(isset($xmlt->subAreas)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->subAreas->idsubarea1)){
							for($j=0;$j<100;$j++){
								eval('if (isset($xmlt->subAreas->idsubarea'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlsubAreas=$xmlt->subAreas->idsubarea'.$j.';');
									$subAreas=(int)$xmlsubAreas;
									$_SESSION["edit"]["subAreas"][$subAreas]=1;
								}
							}
		
						}
						
		
						else{
							$subAreas.=(int)$xmlt->subAreas->idsubarea0;
							$_SESSION["edit"]["subAreas"][$subAreas]=1;
						}
		
		
					}
					else{
						$subAreas="";
					}
		////////////////////////////////////////////////////
		////////////////Recupera Areas Administrativas/////////////////////
					$areasAdministrativas="";
					if(isset($xmlt->areasAdministrativas)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->areasAdministrativas->idareaAdministrativas1)){
							for($j=0;$j<100;$j++){
								eval('if (isset($xmlt->areasAdministrativas->idareaAdministrativas'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmlareasAdministrativas=$xmlt->areasAdministrativas->idareaAdministrativas'.$j.';');
									$areasAdministrativas=(int)$xmlareasAdministrativas;
									$_SESSION["edit"]["areasAdministrativas"][$areasAdministrativas]=1;
								}
							}
		
						}
						//Solo un autor secundario
		
						else{
							$areasAdministrativas.=(int)$xmlt->areasAdministrativas->idareaAdministrativas0;
							$_SESSION["edit"]["areasAdministrativas"][$areasAdministrativas]=1;
						}
		
		
					}
					else{
						$areasAdministrativas="";
					}
		////////////////////////////////////////////////////
		
		////////////////Recupera Temas/////////////////////
					$theme="";
					if(isset($xmlt->theme)){
						//Preguntamos si hay mas de un autor secundario
		
						if(isset($xmlt->theme->idtheme1)){
							for($j=0;$j<100;$j++){
								eval('if (isset($xmlt->theme->idtheme'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
								if($xmlflag){
									eval('$xmltheme=$xmlt->theme->idtheme'.$j.';');
									$theme=(int)$xmltheme;
									$_SESSION["edit"]["themes"][$theme]=1;
								}
							}
		
						}
						//Solo un tema
		
						else{
							$theme=(int)$xmlt->theme->idtheme0;
							$_SESSION["edit"]["themes"][$theme]=1;
						}
		
		
					}
					else{
						$theme="";
					}
		////////////////////////////////////////////////////
		
		
		    }
		}
	
	    $_SESSION["edit"]["titulo"]=$titulo;
	    $_SESSION["edit"]["resumen"]=$resumen;
	    $_SESSION["edit"]["enlace"]=$enlace;
		if(isset($xmlt->idreference)){
		    $_SESSION["edit"]["idreference"]=$idreference;
		}
	    $_SESSION["edit"]["reference_description"]=$reference_description;
	    $_SESSION["edit"]["reference_details"]=$reference_details;
	
	    $_SESSION["edit"]["idtipoPonencia"]=$idtipoPonencia;
	    $_SESSION["edit"]["tipoPonencia_description"]=$tipoPonencia_description;
	    $_SESSION["edit"]["prePorNombre"]=$prePorNombre;
	    $_SESSION["edit"]["prePorApellido"]=$prePorApellido;
	   
	
	    $_SESSION["edit"]["lugar"]=$lugar;
	    $_SESSION["edit"]["pais"]=$pais;
	
	    $_SESSION["edit"]["evento_description"]=$evento_description;
	    $_SESSION["edit"]["idcategoriaEvento"]=$idcategoriaEvento;
	    $_SESSION["edit"]["categoriaEvento_description"]=$categoriaEvento_description;
	    $_SESSION["edit"]["idclaseEvento"]=$idclaseEvento;
	    $_SESSION["edit"]["claseEvento_description"]=$claseEvento_description;
	
	
	    $_SESSION["edit"]["status"]=$status;
	    $_SESSION["edit"]["date_ing"]=$date_ing;
	    $_SESSION["edit"]["date_pub"]=$date_pub;
                        
	    $_SESSION["edit"]["date_ing_tesis"]=$date_ing_tesis;
	    $_SESSION["edit"]["date_pub_tesis"]=$date_pub_tesis;
            
	    $_SESSION["edit"]["authorPRI"][$autorPRI]=1;
	    $_SESSION["edit"]["areaPRI"][$areaPRI]=1;
	    $_SESSION["edit"]["tipo_tesis"]=$tipo_tesis;
	    $_SESSION["edit"]["tipoTesisDescription"]=$tipoTesisDescription;
	    $_SESSION["edit"]["pais_description"]=$pais_description;
	    $_SESSION["edit"]["uni_description"]=$uni_description;
	    
	    $_SESSION["edit"]["year"]=$year;
            $_SESSION["edit"]["yearQuarter"]=$yearQuarter;            
	    $_SESSION["edit"]["idquarter"]=$idquarter;
	    $_SESSION["edit"]["quarter_description"]=$quarter_description;
	      
            $_SESSION["edit"]["year_pub"]=$year_pub;
            $_SESSION["edit"]["month_pub"]=$month_pub;
            $_SESSION["edit"]["desc_month_pub"]=$desc_month_pub;
            $_SESSION["edit"]["day_pub"]=$day_pub;
            
	    $_SESSION["edit"]["nroBoletin"]=$nroBoletin;
	    $_SESSION["edit"]["idmagnitud"]=$idmagnitud;
	
	    $_SESSION["edit"]["idRegion"]=$idRegion;
	    $_SESSION["edit"]["region_description"]=$region_description;
	    $_SESSION["edit"]["idDepartamento"]=$idDepartamento;
	    $_SESSION["edit"]["departamento_description"]=$departamento_description;
	
	    $_SESSION["edit"]["nroCompendio"]=$nroCompendio;
	
	    $_SESSION["edit"]["inst_ext"]=$inst_ext;
	    
		if(isset($xmlt->pdf)){
		    $_SESSION["edit"]["pdf"]=$pdf;
		}
	
		$xml=$result["data_content"];
	
		switch($idCategory){
		    case 1:
		        $respuesta->script("xajax_formPublicacionShow($iddata,$idSubcategory)");
		        //$respuesta->script("xajax_formSubcategoryShow($idSubcategory)");
		    break;
		    case 2:
		        $respuesta->script("xajax_formPonenciasShow($iddata,$idSubcategory)");
		    break;
		    case 3:
		        $respuesta->script("xajax_formAsuntosAcademicosShow($iddata,$idSubcategory)");
		        //$respuesta->script("xajax_formSubcategoryShow($idSubcategory)");
		    break;
		    case 4:
		        $respuesta->script("xajax_formInformacionInternaShow($iddata,$idSubcategory)");
		        //$respuesta->script("xajax_formSubcategoryShow($idSubcategory)");
		    break;
		    case 5:
		        $respuesta->script("xajax_formGeoSocShow($iddata,$idSubcategory)");
		        //$respuesta->script("xajax_formSubcategoryShow($idSubcategory)");
		    break;
		
		}
		
                //$respuesta->alert(print_r($_SESSION["edit"], true));
		$respuesta->assign('paginator', 'style.display',"none");
		$respuesta->assign('resultSearch', 'style.display',"none");
		
		return $respuesta;
		
	}

function categoryResult($sessionidarea=0){
        $resultSql= searchCategorySQL($sessionidarea);

        return $resultSql;
}

function searchAuthorSesionPriResult($idauthor=""){

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

    $strSQL="";

    if(isset($_SESSION["edit"]["authorPRI"])){
        foreach($_SESSION["edit"]["authorPRI"] as $newlist=>$counter){
            if( $counter == 1) {
                /*en la sentencia SQL se utiliza in o notin entonces se necesita
                que los numeros enten entre comillas*/
                $strSQL.="'".$newlist."'";
            }
        }
    }

    else{
        if(isset($_SESSION["tmp"]["authorPRI"])){
            foreach($_SESSION["tmp"]["authorPRI"] as $newlist=>$counter){
                if( $counter == 1) {
                    /*en la sentencia SQL se utiliza in o notin entonces se necesita
                    que los numeros esten entre comillas*/
                    $strSQL.="'".$newlist."'";
                }
            }
        }
    }
    

    $result=searchAuthorSessionSQL($strSQL);

    return $result;
}

	/*************************************************
        Funcion simple javascript sin xajax
	**************************************************/
	function searchAuthorSesionPriShow_sinXajax($idauthor=""){
		    
	    $html="";
	    $result= searchAuthorSesionPriResult($idauthor);
	
		//Verificamos el array es null                
                    if($result["Error"]==2){
                        $html="<table align='center'><tr><td>Añadir autor de la lista.</td></tr></table>";
                    }
                
		if($result["Error"]==0){
		    $query=$result["Query"];
		    $count=$result["Count"];
		    $idauthor = $result["idauthor"];
		    $author_first_name = $result["author_first_name"];
		    $author_second_name = $result["author_second_name"];
		    $author_surname =$result["author_surname"];
                    
                    if(isset($_SESSION["editar"])){
                        if($_SESSION["editar"]==1){
                            $_SESSION["edit"]["authorPRI"]["idauthor"]=$idauthor;
                            $_SESSION["edit"]["authorPRI"]["author_first_name"]=$author_first_name;
                            $_SESSION["edit"]["authorPRI"]["author_second_name"]=$author_second_name;
                            $_SESSION["edit"]["authorPRI"]["author_surname"]=$author_surname;
                        }
                    }
                    else{
		    $_SESSION["tmp"]["authorPRI"]["idauthor"]=$idauthor;
		    $_SESSION["tmp"]["authorPRI"]["author_first_name"]=$author_first_name;
		    $_SESSION["tmp"]["authorPRI"]["author_second_name"]=$author_second_name;
		    $_SESSION["tmp"]["authorPRI"]["author_surname"]=$author_surname;
                    }
                    
		    //$objResponse->script("xajax_arrayAuthor()");
                    
		    $html='<table class="tablacebra-2" cellspacing="0" cellpadding="0" border="0" align="center" width="200px">
					<tr class="cab" style="text-align: left;">';    
		    $html.= "<td width='40px'>Nro</td>";
		    $html.= "<td width='120px'>Nombres</td>";
		    $html.= "<td width='40px'>Borrar</td>";
		    $html.= "</tr>";
		
		
		    for($i=0;$i<$count;$i++){
		            $nro=$i+1;
                            $html.= "<tr class='impar'>";            
		            $html.= "<td>".$nro."</td>";
if(ereg("'",$author_surname[$i])){
    $apellido=explode("'",$author_surname[$i]);
    $antes_caracter=ucfirst($apellido[0]);
    $despues_caracter=ucfirst($apellido[1]);
    $apellido=$antes_caracter."'".$despues_caracter;
}
else{
    $apellido=ucfirst($author_surname[$i]);
}
                            
		            $html.= "<td>".$apellido.", ".ucfirst($author_first_name[$i])."</td>";
		            $html.= "<td><a href='#formulario'><img alt='Eliminar' style='cursor: pointer; border:0;' onclick='xajax_delSearchAuthorSesionPriShow(\"$idauthor[$i]\"); return false;' src='img/userDEL.png' /></a></td>";
		            $html.= "</tr>"; 
		    }
		    
		    $html.= "</table>";
		}

                    /********arrayAuthor*************/
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
    
	$objResponse = new xajaxResponse();
	if (isset($recuperar["authorPRI"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorPRI"])){
                unset($_SESSION["publicaciones"]["authorPRI"]);
            }
                
            $idx=$recuperar["authorPRI"]["idauthor"];
            $i=0;
            foreach($idx as $key => $idauthor){
                $_SESSION["publicaciones"]["authorPRI"]["idauthor$i"]=$idauthor;
                $i++;
            }

            $firstx=$recuperar["authorPRI"]["author_first_name"];
            $i=0;
            foreach($firstx as $key => $author_first_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_first_name$i"]=$author_first_name;
                $i++;
            }

            $secondx=$recuperar["authorPRI"]["author_second_name"];
            $i=0;
            foreach($secondx as $key => $author_second_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_second_name$i"]=$author_second_name;
                $i++;
            }
                
            $surnamex=$recuperar["authorPRI"]["author_surname"];
            $i=0;
            foreach($surnamex as $key => $author_surname_name){
                $author_surname_name=(str_replace("'","*",$author_surname_name));
                $_SESSION["publicaciones"]["authorPRI"]["author_surname$i"]=$author_surname_name;
                $i++;
            }

        }

	if (isset($recuperar["authorSEC"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorSEC"])){
                unset($_SESSION["publicaciones"]["authorSEC"]);
            }


                $idx=$recuperar["authorSEC"]["idauthor"];
                $i=0;
                foreach($idx as $key => $idauthor){
                    $_SESSION["publicaciones"]["authorSEC"]["idauthor$i"]=$idauthor;
                    $i++;
                }
              
                $firstx=$recuperar["authorSEC"]["author_first_name"];
                $i=0;
                foreach($firstx as $key => $author_first_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_first_name$i"]=$author_first_name;
                    $i++;
                }
                
                $secondx=$recuperar["authorSEC"]["author_second_name"];
                $i=0;
                foreach($secondx as $key => $author_second_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_second_name$i"]=$author_second_name;
                    $i++;
                }
                                
                $surnamex=$recuperar["authorSEC"]["author_surname"];
                $i=0;
                foreach($surnamex as $key => $author_surname_name){
                    $author_surname_name=(str_replace("'","*",$author_surname_name));
                    $_SESSION["publicaciones"]["authorSEC"]["author_surname$i"]=$author_surname_name;
                    $i++;
                }
                
        }
            /*****************arrayAuthor**************/                    
                
                //$objResponse->alert(print_r($_SESSION["tmp"], true));
   		
                
	    return $html;
	}

	/*************************************************
	
	**************************************************/
	function searchAuthorSesionPriShow($idauthor=""){
	
	    $objResponse = new xajaxResponse();
	    $html="";
	    $result= searchAuthorSesionPriResult($idauthor);
	
		//Verificamos el array es null
		if($result["Error"]==2){
		    $html="<table align='center'><tr><td>Añadir autor de la lista.</td></tr></table>";
		}

		if($result["Error"]==0){				
		    $query=$result["Query"];
		    $count=$result["Count"];
		    $idauthor = $result["idauthor"];
		    $author_first_name = $result["author_first_name"];
		    $author_second_name = $result["author_second_name"];
		    $author_surname =$result["author_surname"];
                    
                    if(isset($_SESSION["editar"])){
                        if($_SESSION["editar"]==1){
                            $_SESSION["edit"]["authorPRI"]["idauthor"]=$idauthor;
                            $_SESSION["edit"]["authorPRI"]["author_first_name"]=$author_first_name;
                            $_SESSION["edit"]["authorPRI"]["author_second_name"]=$author_second_name;
                            $_SESSION["edit"]["authorPRI"]["author_surname"]=$author_surname;
                        }
                    }
                    else{
		    $_SESSION["tmp"]["authorPRI"]["idauthor"]=$idauthor;
		    $_SESSION["tmp"]["authorPRI"]["author_first_name"]=$author_first_name;
		    $_SESSION["tmp"]["authorPRI"]["author_second_name"]=$author_second_name;
		    $_SESSION["tmp"]["authorPRI"]["author_surname"]=$author_surname;
                    }
                    
		    $objResponse->script("xajax_arrayAuthor()");
		    $html='<table class="tablacebra-2" cellspacing="0" cellpadding="0" border="0" align="center" width="200px">
					<tr class="cab" style="text-align: left;">';    
		    $html.= "<td width='40px'>Nro</td>";
		    $html.= "<td width='120px'>Nombres</td>";
		    $html.= "<td width='40px'>Borrar</td>";
		    $html.= "</tr>";
		
		
		    for($i=0;$i<$count;$i++){
		            $nro=$i+1;
		    		$html.= "<tr class='impar'>";            
		            $html.= "<td>".$nro."</td>";
		            $html.= "<td>".ucfirst($author_surname[$i]).", ".ucfirst($author_first_name[$i])."</td>";
		            $html.= "<td><a href='#formulario'><img alt='Eliminar' style='cursor: pointer; border:0;' onclick='xajax_delSearchAuthorSesionPriShow(\"$idauthor[$i]\"); return false;' src='img/userDEL.png' /></a></td>";
		            $html.= "</tr>"; 
		    }
		    
		    $html.= "</table>";
		}
	
                //$objResponse->alert(print_r($_SESSION["tmp"], true));
   		$objResponse->assign('sesion_authorPRI', 'innerHTML',$html);
                
	    return $objResponse;
	}

/*************************************************

**************************************************/
function searchAuthorSesionSecResult($idauthor=""){

$recuperar="";
$strSQL="";  

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}

/*esta es la menera simplificada*/
    if(isset($recuperar["authorSEC"])){
        //Recorremos el array en busca de los valores que tienen valor 1
        //y lo formateamos a Ejm. $strSQL='A1','B2','C3',
        foreach ( $recuperar["authorSEC"] as $key => $valor ) {
            if( $valor == 1) {
                //en la sentencia SQL se utiliza in o notin entonces se necesita
                //que los numeros enten entre comillas                
                $strSQL.="'".$key."',";
            }
        }
    }
    
    //A Ejm. $strSQL=1,2,3, le quitamos el último caracter que en este caso es una coma ","
    $strSQL = substr($strSQL, 0,-1);

    //para enviarselo a la funcion SQL
    $result=searchAuthorSessionSQL($strSQL);
    
    return $result;
}



	/*************************************************
	
	**************************************************/
	function searchAuthorSesionSecShow_sinXajax($idauthor=""){
	
	    //$objResponse = new xajaxResponse();
	    // Aqui construimos el paginador
	
	    $html="";
	    $result= searchAuthorSesionSecResult($idauthor);
	    
		//Verificamos el array es null
		if($result["Error"]==2){
		    $html="<table align='center'><tr><td>Añadir autor(es) de la lista.</td></tr></table>";
		}
		else{
		    $query=$result["Query"];
		    $count=$result["Count"];
		    $idauthor = $result["idauthor"];
		    $author_first_name = $result["author_first_name"];
		    $author_second_name = $result["author_second_name"];
		    $author_surname =$result["author_surname"];
                    
                    if(isset($_SESSION["editar"])){
                        if($_SESSION["editar"]==1){
                            $_SESSION["edit"]["authorSEC"]["idauthor"]=$idauthor;
                            $_SESSION["edit"]["authorSEC"]["author_first_name"]=$author_first_name;
                            $_SESSION["edit"]["authorSEC"]["author_second_name"]=$author_second_name;
                            $_SESSION["edit"]["authorSEC"]["author_surname"]=$author_surname;
                        }
                    }
                    else{
                            $_SESSION["tmp"]["authorSEC"]["idauthor"]=$idauthor;
                            $_SESSION["tmp"]["authorSEC"]["author_first_name"]=$author_first_name;
                            $_SESSION["tmp"]["authorSEC"]["author_second_name"]=$author_second_name;
                            $_SESSION["tmp"]["authorSEC"]["author_surname"]=$author_surname;
                    }
                    
		    //$objResponse->script("xajax_arrayAuthor()");
		    $html='<table class="tablacebra-2" cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr class="cab" style="text-align: left;">';    
		    $html.= "<td>Nro</td>";
		    $html.= "<td>Nombres</td>";
		    $html.= "<td>Borrar</td>";
		    $html.= "</tr>";
		
		    for($i=0;$i<$count;$i++){
		            $nro=$i+1;
		            $html.= "<tr class='impar'>";
		            $html.= "<td>".$nro."</td>";
 if(ereg("'",$author_surname[$i])){
    $apellido=explode("'",$author_surname[$i]);
    $antes_caracter=ucfirst($apellido[0]);
    $despues_caracter=ucfirst($apellido[1]);
    $apellido=$antes_caracter."'".$despues_caracter;
}
else{
    $apellido=ucfirst($author_surname[$i]);
}
                           
		            $html.= "<td>".$apellido.", ".ucfirst($author_first_name[$i])."</td>";
		
		            $html.= "<td><a href='#formulario'><img alt='selet' style='cursor: pointer; border:0;' onclick='xajax_delSearchAuthorSesionSecShow(\"$idauthor[$i]\"); return false;' src='img/usersDEL.png'/></a></td>";
		            $html.= "</tr>";
		    }
		    $html.= "</table>";
		}
	    //$objResponse->assign('sesion_authorSEC', 'innerHTML',$html);
                
                                    /********arrayAuthor*************/
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
    	
	if (isset($recuperar["authorPRI"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorPRI"])){
                unset($_SESSION["publicaciones"]["authorPRI"]);
            }
                
            $idx=$recuperar["authorPRI"]["idauthor"];
            $i=0;
            foreach($idx as $key => $idauthor){
                $_SESSION["publicaciones"]["authorPRI"]["idauthor$i"]=$idauthor;
                $i++;
            }

            $firstx=$recuperar["authorPRI"]["author_first_name"];
            $i=0;
            foreach($firstx as $key => $author_first_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_first_name$i"]=$author_first_name;
                $i++;
            }

            $secondx=$recuperar["authorPRI"]["author_second_name"];
            $i=0;
            foreach($secondx as $key => $author_second_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_second_name$i"]=$author_second_name;
                $i++;
            }
                
            $surnamex=$recuperar["authorPRI"]["author_surname"];
            $i=0;
            foreach($surnamex as $key => $author_surname_name){
                $author_surname_name=(str_replace("'","*",$author_surname_name));
                $_SESSION["publicaciones"]["authorPRI"]["author_surname$i"]=$author_surname_name;
                $i++;
            }

        }

	if (isset($recuperar["authorSEC"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorSEC"])){
                unset($_SESSION["publicaciones"]["authorSEC"]);
            }


                $idx=$recuperar["authorSEC"]["idauthor"];
                $i=0;
                foreach($idx as $key => $idauthor){
                    $_SESSION["publicaciones"]["authorSEC"]["idauthor$i"]=$idauthor;
                    $i++;
                }
              
                $firstx=$recuperar["authorSEC"]["author_first_name"];
                $i=0;
                foreach($firstx as $key => $author_first_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_first_name$i"]=$author_first_name;
                    $i++;
                }
                
                $secondx=$recuperar["authorSEC"]["author_second_name"];
                $i=0;
                foreach($secondx as $key => $author_second_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_second_name$i"]=$author_second_name;
                    $i++;
                }
                                
                $surnamex=$recuperar["authorSEC"]["author_surname"];
                $i=0;
                foreach($surnamex as $key => $author_surname_name){
                    $author_surname_name=(str_replace("'","*",$author_surname_name));
                    $_SESSION["publicaciones"]["authorSEC"]["author_surname$i"]=$author_surname_name;
                    $i++;
                }
                
        }
            /*****************arrayAuthor**************/                    

	    return $html;
	}

	/*************************************************
	
	**************************************************/
	function searchAuthorSesionSecShow($idauthor=""){
	
	    $objResponse = new xajaxResponse();
	    // Aqui construimos el paginador
	
	    $html="";
	    $result= searchAuthorSesionSecResult($idauthor);
	    
		//Verificamos el array es null
		if($result["Error"]==2){
		    $html="<table align='center'><tr><td>Añadir autor(es) de la lista.</td></tr></table>";
		}
		else{
		    $query=$result["Query"];
		    $count=$result["Count"];
		    $idauthor = $result["idauthor"];
		    $author_first_name = $result["author_first_name"];
		    $author_second_name = $result["author_second_name"];
		    $author_surname =$result["author_surname"];
                    
                    if(isset($_SESSION["editar"])){
                        if($_SESSION["editar"]==1){
                            $_SESSION["edit"]["authorSEC"]["idauthor"]=$idauthor;
                            $_SESSION["edit"]["authorSEC"]["author_first_name"]=$author_first_name;
                            $_SESSION["edit"]["authorSEC"]["author_second_name"]=$author_second_name;
                            $_SESSION["edit"]["authorSEC"]["author_surname"]=$author_surname;
                        }
                    }
                    else{
                            $_SESSION["tmp"]["authorSEC"]["idauthor"]=$idauthor;
                            $_SESSION["tmp"]["authorSEC"]["author_first_name"]=$author_first_name;
                            $_SESSION["tmp"]["authorSEC"]["author_second_name"]=$author_second_name;
                            $_SESSION["tmp"]["authorSEC"]["author_surname"]=$author_surname;
                    }
                    
		    $objResponse->script("xajax_arrayAuthor()");
		    $html='<table class="tablacebra-2" cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr class="cab" style="text-align: left;">';    
		    $html.= "<td>Nro</td>";
		    $html.= "<td>Nombres</td>";
		    $html.= "<td>Borrar</td>";
		    $html.= "</tr>";
		
		    for($i=0;$i<$count;$i++){
		            $nro=$i+1;
		            $html.= "<tr class='impar'>";
		            $html.= "<td>".$nro."</td>";
		            $html.= "<td>".ucfirst($author_surname[$i]).", ".ucfirst($author_first_name[$i])."</td>";
		
		            $html.= "<td><a href='#formulario'><img alt='selet' style='cursor: pointer; border:0;' onclick='xajax_delSearchAuthorSesionSecShow(\"$idauthor[$i]\"); return false;' src='img/usersDEL.png'/></a></td>";
		            $html.= "</tr>";
		    }
		    $html.= "</table>";
		}
	    $objResponse->assign('sesion_authorSEC', 'innerHTML',$html);
	    return $objResponse;
	}

	
	function delSearchAuthorSesionPriResult($idauthor=""){
	
		if(isset($_SESSION["edit"])){
		    if(isset($_SESSION["edit"]["authorPRI"][$idauthor])){
		        unset($_SESSION["edit"]["authorPRI"][$idauthor]);
                        unset($_SESSION["edit"]["authorPRI"]["idauthor"]);
                        unset($_SESSION["edit"]["authorPRI"]["author_first_name"]);
                        unset($_SESSION["edit"]["authorPRI"]["author_second_name"]);
                        unset($_SESSION["edit"]["authorPRI"]["author_surname"]);
		        
		    }
		    return $_SESSION["edit"]["authorPRI"];
		}
		else{
		        unset($_SESSION["tmp"]["authorPRI"][$idauthor]);
                        unset($_SESSION["tmp"]["authorPRI"]["idauthor"]);
                        unset($_SESSION["tmp"]["authorPRI"]["author_first_name"]);
                        unset($_SESSION["tmp"]["authorPRI"]["author_second_name"]);
                        unset($_SESSION["tmp"]["authorPRI"]["author_surname"]);
                        
		        return $_SESSION["tmp"]["authorPRI"];
		
		}
                
	    //unset($_SESSION["autor"]);
	}

function delSearchAuthorSesionPriShow($idauthor=""){
    $objResponse = new xajaxResponse();

            if (isset($_SESSION["publicaciones"]["authorPRI"])){
                unset($_SESSION["publicaciones"]["authorPRI"]);
            }

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }
    
    delSearchAuthorSesionPriResult($idauthor);
    
    $html="";
    if(!isset($recuperar["authorPRI"])){       
        $objResponse->assign('sesion_authorPRI', 'innerHTML',$html);

    }
    else{

    //$objResponse->script("xajax_searchAuthorSesionPriShow()");
    
    $html=searchAuthorSesionPriShow_sinXajax($idauthor);
    $objResponse->assign("sesion_authorPRI","innerHTML",$html);
        
    $objResponse->script("xajax_auxAuthorPriShow(5,1,xajax.getFormValues('autorPRI'))");
    //$objResponse->script("xajax_auxAuthorSecShow(5,1,xajax.getFormValues('autorSEC'))");
    }
    
    //$objResponse->alert(print_r($_SESSION["tmp"], true));
    return $objResponse;
}


function delSearchAuthorSesionSecResult($idauthor=""){

            if (isset($_SESSION["publicaciones"]["authorSEC"])){
                unset($_SESSION["publicaciones"]["authorSEC"]);
            }
    
if(isset($_SESSION["edit"])){
    if(isset($_SESSION["edit"]["authorSEC"][$idauthor])){
        unset($_SESSION["edit"]["authorSEC"][$idauthor]);        
        unset($_SESSION["edit"]["authorSEC"]["idauthor"]);
        unset($_SESSION["edit"]["authorSEC"]["author_first_name"]);
        unset($_SESSION["edit"]["authorSEC"]["author_second_name"]);
        unset($_SESSION["edit"]["authorSEC"]["author_surname"]);
        

    }
    return $_SESSION["edit"]["authorSEC"];
}
else{
        unset($_SESSION["tmp"]["authorSEC"][$idauthor]);
        unset($_SESSION["tmp"]["authorSEC"]["idauthor"]);
        unset($_SESSION["tmp"]["authorSEC"]["author_first_name"]);
        unset($_SESSION["tmp"]["authorSEC"]["author_second_name"]);
        unset($_SESSION["tmp"]["authorSEC"]["author_surname"]);
        
        return $_SESSION["tmp"]["authorSEC"];
        
}

}

function delSearchAuthorSesionSecShow($idauthor=""){
    $objResponse = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }
  
    delSearchAuthorSesionSecResult($idauthor);
    
    $html="";
    if(!isset($recuperar["authorSEC"])){        
        $objResponse->assign('sesion_authorSEC', 'innerHTML',$html);

    }
    else{
        
        //$objResponse->script("xajax_searchAuthorSesionSecShow()");
        
    $html=searchAuthorSesionSecShow_sinXajax($idauthor);
    $objResponse->assign("sesion_authorSEC","innerHTML",$html);
                
        //$objResponse->script("xajax_auxAuthorSecShow(5,1,xajax.getFormValues('autorSEC'))");
        $objResponse->script("xajax_auxAuthorPriShow(5,1,xajax.getFormValues('autorPRI'))");

    }

    //$objResponse->alert(print_r($_SESSION,true));
    return $objResponse;
}

/*********************************************************************************************************

**********************************************************************************************************/
function nuevaReferenciaShow($referencias){
	$respuesta = new xajaxResponse();

        $html="";
        if($referencias=="add"){
            $html="<div style='border-bottom:solid #336699; background-color:#F0F0F0'>";
            $html.="<p><label>Nueva&nbsp;Referencia:&nbsp;<input name='nreferencia' id='nreferencia' type='text' size='16'>&nbsp;
                    <input class='button' onclick='xajax_searchReferenciaShow(xajax.getFormValues(\"referencia\"))' type='button' value='Verificar'></label>
                    <input type='button' value='Cancel' onclick='xajax_nuevaReferenciaShow(1000); xajax_comboReferenciaShow(0,1)' class='button'></p>";
            $html.="<div id='div_abrev'></div></div>";

            $respuesta->Assign("divNuevaRefe","innerHTML",$html);
	}
	elseif($referencias!=0){
            $html="";
            $respuesta->Assign("mensaje","innerHTML",$html);
            $respuesta->Assign("divNuevaRefe","innerHTML",$html);
	}

	return $respuesta;
}



    /*************************************************

    **************************************************/

    function paginatorShow($page,$ipp,$total,$divAutor,$idauthor=""){
        $respuesta = new xajaxResponse();
        $pages = new Paginator;
        $pages->items_total = $total;
        $pages->mid_range = 5; // Number of pages to display. Must be odd and > 3

        if($divAutor=="autorPRI"){
            $divPaginator="paginatorPRI";
            $function="xajax_auxAuthorPriShow";
        }
        elseif($divAutor=="autorSEC"){
            $divPaginator="paginatorSEC";
            $function="xajax_auxAuthorSecShow";
        }
		
        $pages->paginateAuthor($ipp,$page,$function,$divAutor);
        $html="";
        $html.= $pages->display_pages();
        $respuesta->assign($divPaginator,"innerHTML",$html);
        return $respuesta;
    }	


function verificaArchivo($url)
{
        // Fake the browser type
        ini_set('user_agent','MSIE 4\.0b2;');

        $dh = fopen("$url",'r');
        $result = fread($dh,8192);
        return $result;

        

}



    function createJpg($fileName){
            // Funcion que crea la portada de la revista
            //
            //list($idcategory,$idpublication,$item)=explode("-",$idfile);
            $pathFile="./datafiles/pdf/$fileName";
            $documentPdf="./datafiles/pdf/$item.pdf";
            $frontPng="./datafiles/png/$item.png";

            // Borramos la anterior caratula
            exec("rm -rf datafiles/png/$item.png");

            // Borramos el anterior documento
            exec("rm -rf datafiles/pdf/$item.pdf");

            // Creamos la portada
            exec("convert ".$pathFile."[0] ".$frontPng);

            // Renombramos el documento
            exec("mv $pathFile $documentPdf");

            // Una vez creada la portada
            // verificamos si existe en la base de datos

            if(file_exists($frontPng)){
                    $dbh=conx();

                    foreach($dbh->query("SELECT item FROM datafiles WHERE item=$item") as $row) {
                            $rowItem = $row["item"];
                    }

                    if (isset($rowItem)){
                            $sql="UPDATE datafiles SET filename='$item' WHERE item=$item";
                    }
                    else{
                            $sql="INSERT INTO datafiles(item,filename) VALUES ($item,'$item')";
                    }
                    $dbh->query("SET NAMES 'utf8'");
                    $dbh->query($sql);
                    $dbh = null;

                    return true;
            }
            else{
                    return false;
            }
    }



    /*************************************************
    Autor Principal
    **************************************************/

    function auxAuthorPriShow($pageSize,$currentPage,$formSearch="",$idauthor="",$apellidoArray=""){
        $respuesta = new xajaxResponse();
   
        $sAuthor=isset($formSearch["sAuthor"])?$formSearch["sAuthor"]:"";
        if($idauthor!=""){
            if(isset($_SESSION["edit"]["authorPRI"])){
                //Limpiamos los valores de la sesión
                unset($_SESSION["edit"]["authorPRI"]);
                $_SESSION["edit"]["authorPRI"][$idauthor]=1;
            }
            else{
                //Limpiamos los valores de la sesión
                unset($_SESSION["tmp"]["authorPRI"]);		
                $_SESSION["tmp"]["authorPRI"][$idauthor]=1;
            }
                $_SESSION["autor"]=$idauthor;
        }
                    
        $result=searchAuthorPriResult('ALL',$currentPage,$pageSize,$sAuthor);
        if(isset($result["Count"])){
            if($result["Count"]==0){
                $total=0;
            }
            else{
                $total=$result["Count"];
            }
        }
        else{
            $total=0;
        }

        $html="";
        if($idauthor!=""){
            //$respuesta->script("xajax_searchAuthorSesionPriShow(".$idauthor.")");
            $html=searchAuthorSesionPriShow_sinXajax($idauthor);
            $respuesta->Assign("sesion_authorPRI","innerHTML",$html);
        }
        
        $respuesta->script('xajax_searchAuthorPriShow("AUTHOR",'.$currentPage.','.$pageSize.',"'.$sAuthor.'","'.$idauthor.'","'.$apellidoArray.'")');
        $respuesta->script("xajax_paginatorShow($currentPage,$pageSize,$total,'autorPRI')");
        
        //$respuesta->alert(print_r($result["strSQL"],true));
        //$respuesta->alert($total);
        //$respuesta->alert($currentPage);
        $respuesta->Assign("rq_authorPRI","style.display","block");
        $respuesta->Assign("paginatorPRI","style.display","block");
        $respuesta->Assign("div_autor","style.display","none");
        
        //$respuesta->alert(print_r($result, true));
        //$respuesta->alert(print_r($_SESSION["tmp"], true));
        return $respuesta;
    }

	/*************************************************

	**************************************************/
	function searchAuthorPriResult($idSearch,$currentPage,$pageSize,$sAuthor=""){
		$strSQL="";
		$strSQLPRI="";
		$strSQLSEC="";
		
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
		
	    if(isset($recuperar["authorPRI"])){
	
	    //Recorremos el array en busca de los valores que tienen valor 1
	    //y lo formateamos a Ejm. $strSQL=1,2,3,
	
	    foreach($recuperar["authorPRI"] as $newlist=>$counter){
	        if( $counter == 1) {            
	            //$strSQLPRI.=$newlist;
	            $strSQLPRI.="'".$newlist."'";
	        }
	    }
	    
	    $strSQL=$strSQLPRI;
	    //A Ejm. $strSQL=1,2,3, le quitamos el último caracter que en este caso es una coma ","
	    //$strSQL = substr($strSQL, 0,-1);
	    }
		
			//Verificamos el array secundario es null
		if(isset($recuperar["authorSEC"])){
		
		    //Recorremos el array en busca de los valores que tienen valor 1
		    //y lo formateamos a Ejm. $strSQL=1,2,3,
		    foreach ( $recuperar["authorSEC"] as $key => $valor ) {
		        if( $valor == 1) {
		            $strSQLSEC.="'".$key."',";
		            //$strSQLSEC.=$key.",";
		        }
		    }
		
		
		    if($strSQLPRI!=""){
		        $strSQL=$strSQLSEC.$strSQLPRI;
		    }
		    else{
		        //A Ejm. $strSQL=1,2,3, le quitamos el último caracter que en este caso es una coma ","
		        $strSQL = substr($strSQLSEC, 0,-1);
		    }
		}
	    elseif(!isset($recuperar["authorPRI"]) && !isset($recuperar["authorSEC"])){
	        $strSQL="";
	    }
	
	    $result=searchAuthorSQL($idSearch,$currentPage,$pageSize,$sAuthor,$strSQL);
	
	return $result;
	}

	
	/*************************************************
	
	**************************************************/
	function searchAuthorPriShow($idSearch,$currentPage,$pageSize,$sAuthor="",$idauthor=0,$apellidoArray=""){            
	    $objResponse = new xajaxResponse();
            
	    $result= searchAuthorPriResult($idSearch,$currentPage,$pageSize,$sAuthor,$idauthor);
            
            if(isset($_SESSION["edit"])){
                $recuperar=$_SESSION["edit"];
            }
            else{
                if(isset($_SESSION["tmp"])){    
                    $recuperar=$_SESSION["tmp"];
                }
            }
            
            if($result["Error"]==1){
                
                $arrayAutorPRI=isset($recuperar["authorPRI"]["author_surname"])?$recuperar["authorPRI"]["author_surname"]:array();
                $arrayAutorSEC=isset($recuperar["authorSEC"]["author_surname"])?$recuperar["authorSEC"]["author_surname"]:array();
                
                /*
                $arrayAutorPRI=isset($recuperar["authorPRI"]["idauthor"])?$recuperar["authorPRI"]["idauthor"]:array();
                $arrayAutorSEC=isset($recuperar["authorSEC"]["idauthor"])?$recuperar["authorSEC"]["idauthor"]:array();
                */
                $result_array=array_merge_recursive($arrayAutorPRI,$arrayAutorSEC);
                //$sAuthor=$result["sAuthor"];
                //$apellidoArray=strtolower($apellidoArray);
                //$inAutor= in_array($idauthor,$result_array);
                $inAutor= in_array($apellidoArray,$result_array);
                /*******************************/
                //$clave = array_search($sAuthor, $result_array);
                //$objResponse->alert(print_r($result_array, TRUE));
                
                
                
                if($inAutor){
                //if (array_key_exists($clave, $result_array)) {

                    $html="<h5><p>El Autor ha sido asociado a la publicación<br>";
                }
                else{
                    $html="<h5><p>No existe el autor regístrelo como nuevo<br>";
                }

                $html.='<span style="float:left; font-size: 12px"><a href="#" onclick="xajax_mostrarBusquedaAutores(); return false;" class="txt-rojo" id="boton_regreso"><img style="cursor: pointer; border:0;" width="12px" src="img/flecha-atras.jpg">&nbsp;&nbsp;&nbsp;Retornar a la búsqueda</a></span></div><br>';
                //$html.="<br>".$result["Query"];
            }                
            elseif($result["Error"]==2){
                $html="<h5><p>Error SQL</p></h5>";
                $html.="<br>".$result["Query"];
            }
            elseif($result["Error"]==3){
                $html=$result["Msg"];
                $html.="<br>".$result["result_array"][0];
                $html.='<span style="float:left; font-size: 12px"><a href="#" onclick="xajax_mostrarBusquedaAutores(); return false;" class="txt-rojo" id="boton_regreso"><img style="cursor: pointer; border:0;" width="12px" src="img/flecha-atras.jpg">&nbsp;&nbsp;&nbsp;Retornar a la búsqueda</a></span></div><br>';
            }
		
		
		else{
		    $query=$result["Query"];
		
		    $idauthor = $result["idauthor"];
		    $author_first_name = $result["author_first_name"];
		    $author_surname =$result["author_surname"];
		
		    $html="";
                    $html.='<span style="float:left; font-size: 12px;"><a href="#" onclick="xajax_mostrarBusquedaAutores(); return false;" class="txt-rojo" id="boton_regreso" ><img style="cursor: pointer; border:0;" width="12px" src="img/flecha-atras.jpg">&nbsp;&nbsp;&nbsp;Retornar a la búsqueda</a></span></div><br>';
		    $html.= '<table class="tablacebra-2" cellspacing="0" cellpadding="0" border="0" width="380px">';
			$html.= '<tr style="text-align: left;" class="cab">';
		    $html.= "<td width='40px'>Nro</td>";
		    $html.= "<td width='200px'>Nombres</td>";
		    $html.= "<td width='60px'>Principal</td>";
		    $html.= "<td width='60px'>Secundario</td>";
		    $html.= "</tr>";
		
		    for($i=0;$i<$result["Count"];$i++){
		            $nro=$i+1;
                            $html.= "<tr class='impar'>";		            
		            $html.= "<td>".$nro."</td>";
if(ereg("'",$author_surname[$i])){
    $apellido=explode("'",$author_surname[$i]);
    $antes_caracter=ucfirst($apellido[0]);
    $despues_caracter=ucfirst($apellido[1]);
    $apellido=$antes_caracter."'".$despues_caracter;
    
    //cadena que se buscará en el array de sesion de autores
    $apellidoArray=addslashes($antes_caracter."'".$despues_caracter);
}
else{
    $apellido=ucfirst($author_surname[$i]);
    $apellidoArray=$author_surname[$i];
}

		            //$html.= "<td>".ucfirst($author_surname[$i]).", ".ucfirst(substr($author_first_name[$i],0,2))."</td>";
                            $html.= "<td>".$apellido.", ".ucfirst(substr($author_first_name[$i],0,2))."</td>";
                            
		            $html.= "<td><a href=\"#formulario\" style=\"cursor: pointer;\"><img alt=\"autor primario\" style=\"cursor: pointer; border:0;\" onclick=\"xajax_auxAuthorPriShow(5,$currentPage,xajax.getFormValues('autorPRI'),$idauthor[$i],'$apellidoArray'); return false;\" src=\"img/userPRI.png\" /></a></td>";
		            $html.= "<td>
		            <a href=\"#formulario\" style=\"cursor: pointer;\"><img alt=\"autor secundario\" style=\"cursor: pointer;border:0;\" onclick=\"xajax_auxAuthorSecShow(5,$currentPage,xajax.getFormValues('autorPRI'),$idauthor[$i],'$apellidoArray'); return false;\" src=\"img/userSEC.png\" /></a>
		            </td>";
		            $html.= "</tr>";
		    }
		    $html.= "</table>";
		
		}
	
                
	    $objResponse->assign('rq_authorPRI', 'innerHTML',$html);
	    $objResponse->assign('paginatorPRI', 'style.display',"block");
            
	    //$objResponse->alert(print_r($result, TRUE));
            
            
	    return $objResponse;
	}

    /*************************************************
    Autor Secundario
    **************************************************/

    function auxAuthorSecShow($pageSize,$currentPage,$formSearch="",$idauthor="",$apellidoArray=""){
        $respuesta = new xajaxResponse();   

        $sAuthor=isset($formSearch["sAuthor"])?$formSearch["sAuthor"]:"";
        if($idauthor!=""){
            //if(isset($_SESSION["edit"]["authorSEC"])){ //codigo anterior
	    if(isset($_SESSION["edit"])){
                $_SESSION["edit"]["authorSEC"][$idauthor]=1;
            }
            else{
                $_SESSION["tmp"]["authorSEC"][$idauthor]=1;
                //$respuesta->alert(print_r($_SESSION["tmp"], true));
                //$respuesta->alert("idautor esta seteado");
            }
        }

        $result=searchAuthorPriResult('ALL',$currentPage,$pageSize,$sAuthor);
        if(isset($result["Count"])){
            if($result["Count"]==0){
                $total=0;
            }
            else{
                $total=$result["Count"];
            }
        }
        else{
            $total=0;
        }
        
        $html="";
        if($idauthor!=""){
            //$respuesta->script("xajax_searchAuthorSesionSecShow(".$idauthor.")");
            $html=searchAuthorSesionSecShow_sinXajax($idauthor);
            $respuesta->Assign("sesion_authorSEC","innerHTML",$html);
        }
        
        //$respuesta->script("xajax_auxAuthorPriShow(5,$currentPage,xajax.getFormValues('autorPRI'),".$idauthor.",".$apellidoArray.")");
        $respuesta->script('xajax_searchAuthorPriShow("AUTHOR",'.$currentPage.','.$pageSize.',"'.$sAuthor.'","'.$idauthor.'","'.$apellidoArray.'")');
        $respuesta->script("xajax_paginatorShow($currentPage,$pageSize,$total,'autorPRI')");
        
        //$respuesta->alert(print_r($result["strSQL"],true));
        //$respuesta->alert($total);
        //$respuesta->alert($result["Query"]);
        $respuesta->Assign("rq_authorPRI","style.display","block");
        $respuesta->Assign("paginatorPRI","style.display","block");        
        $respuesta->Assign("div_autor","style.display","none");
        
        return $respuesta;
    }

	/*************************************************
	
	**************************************************/
	function searchAuthorSecResult($idSearch,$currentPage,$pageSize,$sAuthor="",$radio=0){
	$strSQL="";
	$strSQLPRI="";
	$strSQLSEC="";
	
	//Verificamos el array principal es null
	if(isset($_SESSION["tmp"]["authorPRI"])){
	
	    //Recorremos el array en busca de los valores que tienen valor 1
	    //y lo formateamos a Ejm. $strSQL=1,2,3,
	    foreach ( $_SESSION["tmp"]["authorPRI"] as $newlist => $valor ) {
	        if( $valor == 1) {
	            $strSQLPRI.="'".$newlist."'";
	            //$strSQLPRI.=$newlist;
	        }
	    }
	}
	
	//Verificamos el array es null
	//if(isset($_SESSION["authorSEC"])){
		if(isset($_SESSION["tmp"]["authorSEC"])){
		    if($_SESSION["tmp"]["authorSEC"]!=""){
		
		        //Recorremos el array en busca de los valores que tienen valor 1
		        //y lo formateamos a Ejm. $strSQL=1,2,3,
		        foreach ( $_SESSION["tmp"]["authorSEC"] as $key => $valor ) {
		            if( $valor == 1) {
		                $strSQLSEC.="'".$key."',";
		                //$strSQLSEC.=$key.",";
		            }
		        }
		
				if($strSQLPRI!=""){
					$strSQL=$strSQLSEC.$strSQLPRI;
				}
				else{
					//A Ejm. $strSQL=1,2,3, le quitamos el último caracter que en este caso es una coma ","
					$strSQL = substr($strSQLSEC, 0,-1);
				}
		
		    }
			else{
		    	$strSQL="";
			}
		}
	    $result=searchAuthorSQL($idSearch,$currentPage,$pageSize,$sAuthor,$radio,$strSQL);
		return $result;
	}

/*************************************************

**************************************************
function searchAuthorSecShow($idSearch,$currentPage,$pageSize,$sAuthor="",$radio=0){
    $objResponse = new xajaxResponse();

    $result= searchAuthorSecResult($idSearch,$currentPage,$pageSize,$sAuthor,$radio);

    if($result["Error"]==1){
        $html="<h5><p>Seleccione un autor de la lista </h5>";
    }
    elseif($result["Error"]==2){
        $html="<h5><p>Error SQL</h5>";
    }

    else{
        $query=$result["Query"];

        $idauthor = $result["idauthor"];
        $author_first_name = $result["author_first_name"];
        $author_surname =$result["author_surname"];

        $html="";
        $html.= "<center><table>";
        $html.= "<th class='top' scope='col'>Nro</th>";
        $html.= "<th class='top' scope='col'>Nombres</th>";
        $html.= "<th class='top' scope='col'>Acci&oacute;n</th>";
        $html.= "</tr>";
        $html.= "<tr>";

        for($i=0;$i<$result["Count"];$i++){
                $nro=$i+1;
                $html.= "<td>".$nro."</td>";
                $html.= "<td>".ucfirst($author_surname[$i]).", ".ucfirst($author_first_name[$i])."</td>";
                $html.= "<td><a href=\"#rq_authorSEC\"><img alt=\"selecionar autor\" style=\"cursor: pointer; border:0;\" onclick=\"xajax_auxAuthorSecShow(5,1,xajax.getFormValues('autorSEC'),$idauthor[$i]);\" src=\"img/iconos/agregar.png\" /></a></td>";
                $html.= "</tr>";
        }
        $html.= "</table></center>";
}

    //$objResponse-alert(print_r($result),true);
    $objResponse->assign('rq_authorSEC', 'innerHTML',$html);
    $objResponse->assign('paginatorSEC', 'style.display',"block");
    return $objResponse;
}
*/
        
/*************************************************

**************************************************/
function searchReferenciaResult($formSearch=""){

    // Verificamos si existe un texto para busqueda
    if(is_array($formSearch)){

            $txt_referencia=$formSearch["nreferencia"];

            if($txt_referencia!=""){
                $result=searchReferenciaSQL($txt_referencia);
            }
            else{
                //texto vacío
                $result["Count"]=3;
            }
    }

    return $result;
}

/*************************************************

**************************************************/
function searchReferenciaShow($formSearch=""){

    $objResponse = new xajaxResponse();

    $result= searchReferenciaResult($formSearch);
    
    $query=isset($result["Query"])?$result["Query"]:"";
    $count=isset($result["Count"])?$result["Count"]:"";
    $error=isset($result["Error"])?$result["Error"]:"";

    if($count==3){
        $html="<div class='error'>Ingrese Referencia</div>";
    }
    elseif($count==0){
        //"No existe referencia"
	$html="<div class='divForm'><label>Abreviatura:   </label> <input type='text' size='14' id='abrev' name='abrev'/></div>
		<p align='center' style='padding-bottom: 6px;'><input type='button' value='Guardar' onclick='xajax_registraReferenciaShow(nreferencia.value, abrev.value)' class='button'/> <input type='button' value='Cancelar' onclick='xajax_ocultar(0)' class='button'/>";
    }
    elseif($count!=0 && $count!=""){
        //texto vacío
        $html="<div class='error'>Existe Referencia</div>";

    }

    $objResponse->assign('div_abrev', 'innerHTML',$html);
    return $objResponse;
}



	function newReferenceRegister($action,$form){
	    $objResponse = new xajaxResponse();
	
		$idsubcategory=$_SESSION["idsubcategory"];
		$idarea=$_SESSION["idarea"];
	    //Check data
	    $resultCheck=newReferenceCheck($form);
	
	    if ($resultCheck["Error"]==1){
	        $objResponse->alert($resultCheck["Msg"]);
	    }
	    else{
	        //Insert data
	        $resultSQL= newReferenceRegisterSQL($action,$form);
	        if ($resultSQL["Error"]==0){
	            $objResponse->alert($resultSQL["Msg"]);
	            $idreferenceultimo=$resultSQL["idreferenceultimo"];
	            $referenceultimo_txt=addslashes($resultSQL["reference_description_ultimo"]);
	
	            //llamo a la funcion que muestra el select de referencia con el ultimo item registrado como valor escogido
	            $objResponse->script("xajax_comboReferenciaShow($idarea,$idsubcategory,$idreferenceultimo,1)");
	            //$objResponse->script("referenciaText1($idreferenceultimo,'$referenceultimo_txt');");
                    $objResponse->script("xajax_registerReference($idreferenceultimo,'$referenceultimo_txt');");
                    
                    $objResponse->assign('nreferencia', 'value','');
	            $objResponse->assign('abrev', 'value','');
	            $objResponse->assign('referencia_txt', 'value',$referenceultimo_txt);
	        }
	        else{
	            $objResponse->alert($resultSQL["Msg"]);
	
	        }
	        
	    }
	
	    return $objResponse;
	}

	function newReferenceCheck($form){
	
	    $check["Error"]=0;
		if($form["nreferencia"]==""){
	            $check["Msg"]="Ingrese un referencia";
	            $check["Error"]=1;
		}
	    return $check;
	}



	function formAuthorShow(){
	    //$respuesta = new xajaxResponse();
	    $html = '<p class="txt-azul">Registro de un nuevo autor</p>
	    <div id="mensaje"> </div>
	        <form id="autor" name="autor">
				<div class="campo-buscador">Primer Nombre:</div>	        
				<div class="contenedor-caja-buscador-1">
					<input type="text" id="pNombre" name="pNombre" size="1" maxlength="1"  class="caja-buscador-3">
				</div>
				<div style="clear:both"></div>
				<div class="campo-buscador">Segundo Nombre:</div>	        
				<div class="contenedor-caja-buscador-1">
					<input type="text" id="sNombre" name="sNombre" size="1" maxlength="1"  class="caja-buscador-3">
				</div>
				<div style="clear:both"></div>				
				<div class="campo-buscador">Apellido Paterno:</div>	        
				<div class="contenedor-caja-buscador-1">
					<input type="text" id="apellido" name="apellido" class="caja-buscador-1">
				</div>
				<div style="clear:both"></div>				
	            <input type="button" class="ui-state-default ui-corner-all" value="Registrar" onClick="xajax_registraAuthorShow(xajax.getFormValues(\'autor\'))"/>
	        </form>';
		    //$respuesta->Assign($divAuthor,"innerHTML",$html);
	    return $html;
	}



	function formEstadisticaShow($idbutton){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    unset($_SESSION["edit"]);
		    unset($_SESSION["publicaciones"]);
		}
	
		// Desde la pagina web del IGP
		if($idbutton==1){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'));";
			$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';
		}
	
		// Desde la pagina web del area
		if($idbutton==2){
			$functionButton="xajax_searchPublicationShow(xajax.getFormValues('formSearch'),'2');";
			$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';
	
		}
		// Desde la pagina web del autor
		if($idbutton==3){
			$functionButton="xajax_searchPublicationShow(xajax.getFormValues('formSearch'),'3');";
			$formAutor='';
		}
	
		$html='<h1 class="block">ESTADÍSTICAS</h1>
		<br>
	
		<div class="contactform">
			<form id="formSearch">
			<fieldset>
				<span><label class="left">Buscar en :</label>
				<select  name="idcategory" id="idcategory" onChange="xajax_comboTipoPublicacionShow(0,this.value); return false;" class="combo">
						<option value="0" selected="selected">- Seleccione-&nbsp;</option>
						<option value="1" >&nbsp;Publicaciones&nbsp;</option>
						<option value="2">&nbsp;Ponencias&nbsp;</option>
						<option value="3">&nbsp;Asuntos Academicos&nbsp;</option>
						<option value="4">&nbsp;Informaci&oacute;n Interna&nbsp;</option></select>
				</span>
				<input class="button" onclick='.$functionButton.' type="button" value="Buscar">
				<!-- Buscar por titulo -->
	
				<div>
					<label class="left">T&iacute;tulo :&nbsp;</label>
					<input id="titulo" name="titulo" type="text" size="30" class="field">
				</div>
	
				<!-- Buscar por autor  -->
				'.$formAutor.'
			</fieldset>
			<fieldset>
				<h3>Opciones avanzadas</h3>
				<div id="optionsSubcategory"></div>
				<div id="moreOptions"></div>
					<!-- Buscar por fecha -->
				<div id="searchDate" style="display:none;">
					<div class="txt-azul">Fechas: </div><span id="divTipoFecha"></span>
					<label></label><span id="divMonth"></span>
					<label></label><span id="divYear"></span>
				</div>
	
			  
			</fieldset>
			</form>
			<div id="resultSearch"></div>
		</div>
		';
	
	    $objResponse->script("xajax_comboMonthShow()");
	    $objResponse->script("xajax_comboYearShow()");
	    $objResponse->Assign("estadisticas","innerHTML","$html");
	    $objResponse->Assign("formulario","style.display","none");
	    $objResponse->Assign("consultas","style.display","none");
	    $objResponse->Assign("estadisticas","style.display","block");
		return $objResponse;
	}


function readSessionArea(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

    if(isset($recuperar["areasSEC"])){
        $keys=array_keys($recuperar["areasSEC"]);
        $range="";
        for($i=0;$i<count($keys);$i++){
            $range.=$keys[$i].",";
        }
        $range=substr($range,0, strlen($range)-1);
    }
    else{
        $range="";
    }
    return (string)$range;
}





function otrosTemasShow($range){
	$respuesta = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

    if(strlen($range)>0){
        $titulo="Temas del &aacute;rea de Aeronomia";
        $result=iniAreaResult("range",$range);
        $html="";
        if($result["Error"]==0){
            if($result["Count"]>0){
                for($i=0;$i<count($result["idtheme"]);$i++){
                    $key = $result["idtheme"][$i];
                    if(isset($recuperar["themes"][$key])){
                        $html.="<p><input type=checkbox checked onclick=\"xajax_registerTheme('".$result["idtheme"][$i]."','".$result["theme_description"][$i]."')\"  />&nbsp;".$result["theme_description"][$i]."</p>";
                    }
                    else{
                        $html.="<p><input type=checkbox onclick=\"xajax_registerTheme('".$result["idtheme"][$i]."','".$result["theme_description"][$i]."')\"  />&nbsp;".$result["theme_description"][$i]."</p>";
                    }
				}
			}

        }
        else{
            $html="<font color='red'>No se ha registrado temas para esta área</font>";
        }
	}
	else{
		$html="";
	}

        //$respuesta->alert(print_r($_SESSION, true));
	$respuesta->Assign("otrosTemas","innerHTML",$html);
	return $respuesta;


}



function subArea($idarea=0){
    
$titulo="Sub &Aacute;reas de ".$_SESSION["area_description"];
	$respuesta = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}

    //$result=iniAreaResult("single",$idarea);
        $desc = array("IDI","Operaciones","Cielo","EI","IT");
	$id = array(1,2,3,4,5);

    $html="";
    
        for($i=0;$i<count($id);$i++){
            $key = $id[$i];
            if(isset($recuperar["subAreas"][$key])){
                $html.="<p><input type=checkbox checked onclick=\"xajax_registerSubAreas('".$id[$i]."','".$desc[$i]."');\" />&nbsp;".$desc[$i]."</p>";
            }
            else{
                $html.="<p><input type=checkbox onclick=\"xajax_registerSubAreas('".$id[$i]."','".$desc[$i]."');\"  />&nbsp;".$desc[$i]."</p>";
            }
        }

    $respuesta->Assign("divSubAreas","innerHTML",$html);
    $respuesta->Assign("titSubAreas","innerHTML",$titulo);

    return $respuesta;
}

function newThemeShow(){

    $respuesta = new xajaxResponse();

    $result=searchOtherAreaSQL();
    $html="";
    if($result["Error"]==0){
        if($result["Count"]>0){
			$cboAreas=new combo();
            $combo=$cboAreas->comboList($result["area_description"],$result["idarea"],"OnChange","","Seleccione el área","0","selectArea",0,"combo-buscador-1");
            
        }
    }
    else{
        $html="Error SQL";
    }

    $html="<form name='newTheme' id='newTheme' onsubmit='xajax_newThemeRegister(\"INS\",xajax.getFormValues(\"newTheme\")); return false;'>";
	$html.="<div class='campo-buscador'>&Aacute;rea:</div>";
	$html.='<div class="contenedor-combo-buscador-1">'.$combo.'</div>';
	$html.='<div style="clear:both"></div>';

	$html.="<div class='campo-buscador'>Nuevo Tema:</div>";
	$html.='<div class="contenedor-caja-buscador-1"><input id="theme_description" name="theme_description" type=text class="caja-buscador-1" /></div>';
	$html.='<div style="clear:both"></div>';	
	$html.="<input class='ui-state-default ui-corner-all' type=submit value='Registrar' /></form> ";
    $respuesta->Assign("titNuevoTema","innerHTML","Ingresar nuevo tema");
	$respuesta->Assign("nuevo_tema_publicacion","innerHTML",$html);

    return $respuesta;
}


function newThemeRegister($action,$form){
    $objResponse = new xajaxResponse();
    //Check data
    $resultCheck=newThemeCheck($form);

    if ($resultCheck["Error"]==1){
        $objResponse->alert($resultCheck["Msg"]);
    }
    else{
        //Insert data
        $result= registerThemeSQL($action,$form);
        if($action=="INS"){
		    if($result["Error"]==0){
                        $objResponse->alert("Registro ingresado correctamente");
                        $range=readSessionArea();
                        //$script="xajax_otrosTemasShow('$range')";
                        $area=$_SESSION['idarea'];
                        $script="xajax_iniAreaShow($area)";
                        $objResponse->script($script);
                        //$objResponse->alert($range);
                        //$objResponse->Assign("nuevo_tema_publicacion","innerHTML",'');

                    }
                    else{
                        $objResponse->alert("Error: NewThemeRegister");
                    }
        }

    }

    return $objResponse;
}


function newThemeCheck($form){

    $check["Error"]=0;
	if($form["selectArea"]==0){
        $check["Msg"]="Seleccione al menos un área";
        $check["Error"]=1;
    }
	elseif(strlen(trim($form["theme_description"]))==0){
        $check["Msg"]="Debe escribir un tema";
        $check["Error"]=1;
	}
    return $check;
}





function URLopen($url)
{
        // Fake the browser type
        ini_set('user_agent','MSIE 4\.0b2;');

        $dh = fopen("$url",'r');
        $result = fread($dh,8192);
        return $result;
}

function newPublication($iddata=0,$action,$form){
    $objResponse = new xajaxResponse();
    
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){    
        $recuperar=$_SESSION["tmp"];
}
        
        $resumen=isset($recuperar["resumen"])?$recuperar["resumen"]:"";
        $link=isset($recuperar["enlace"])?$recuperar["enlace"]:"";        
        $link=(str_replace("&","*",$link));
        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";
        
        if($_SESSION["subcategory"]=="tesis"){
            $idtipoTesis=isset($recuperar["tipo_tesis"])?$recuperar["tipo_tesis"]:"";
            $tipoTesisDescription=isset($recuperar["tipoTesisDescription"])?$recuperar["tipoTesisDescription"]:"";
            $pais_description=isset($recuperar["pais_description"])?$recuperar["pais_description"]:"";
            $uni_description=isset($recuperar["uni_description"])?$recuperar["uni_description"]:"";
        }
        
        $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];

/********************Validar*********************************************************/
$idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;               
$resultCheck=validarPublicaciones($idsubcategory,$areaPRI);

if ($resultCheck["Error"]==1){
        $objResponse->alert($resultCheck["Msg"]);
        $objResponse->script($resultCheck["funcion"]);
}
/*****************************************************************************/
else{
        $_SESSION["publicaciones"]["areaPRI"]=$areaPRI;
        $_SESSION["publicaciones"]["date_ing"]=$date_ing;
        //$_SESSION["publicaciones"]["date_pub"]=$resultCheck["date_pub"];
        $_SESSION["publicaciones"]["month_pub"]=$resultCheck["month_pub"];
        $_SESSION["publicaciones"]["year_pub"]=$resultCheck["year_pub"];
       
                /*Titulo Resumen*/
        $_SESSION["publicaciones"]["titulo"]=$resultCheck["titulo"];
        
        switch ($idsubcategory) {
        case 1:
            $_SESSION["publicaciones"]["resumen"]=$resumen;
            $_SESSION["publicaciones"]["enlace"]=$link;
            /*Referencia*/       
            $_SESSION["publicaciones"]["idreference"]=$resultCheck["idreference"];
            $_SESSION["publicaciones"]["reference_description"]=$resultCheck["reference_description"];
            $_SESSION["publicaciones"]["reference_details"]=$resultCheck["reference_details"];
            /************/
            
            $_SESSION["publicaciones"]["status"]=$resultCheck["status"];
        break;
        case 2:
            $_SESSION["publicaciones"]["resumen"]=$resumen;
            $_SESSION["publicaciones"]["enlace"]=$link;
            $_SESSION["publicaciones"]["tipo_tesis"]=$idtipoTesis;
            $_SESSION["publicaciones"]["tipoTesisDescription"]=$tipoTesisDescription;
            $_SESSION["publicaciones"]["pais_description"]=$pais_description;
            $_SESSION["publicaciones"]["uni_description"]=$uni_description;
        break;
        case 3:           
            $_SESSION["publicaciones"]["resumen"]=$resumen;
            $_SESSION["publicaciones"]["enlace"]=$link;
            
            /*Referencia*/       
            $_SESSION["publicaciones"]["idreference"]=$resultCheck["idreference"];
            $_SESSION["publicaciones"]["reference_description"]=$resultCheck["reference_description"];
            //$_SESSION["publicaciones"]["reference_details"]=$resultCheck["reference_details"];
            /************/
            
            $_SESSION["publicaciones"]["status"]=$resultCheck["status"];
        break;
        }

        /**Editar**/
if(isset($_SESSION['edit'])){

    if(isset($_SESSION['edit']['pdf_upload'])){
        $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:$_SESSION['edit']['pdf_upload'];
        $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;
        
        //Reemplazar el Archivo//
        //Si se sube un nuevo archivo borrar el archivo anterior
        if (isset($_SESSION['edit']['pdf'])){//si parametro pdf del xml existe
            
                if($_SESSION['edit']['pdf']!=""){//si parametro pdf del xml no está vacío
                    
                    $ruta="data/$tipoDocumento/$subcategory/".$_SESSION['edit']['pdf'];
                    if(is_file($ruta)){
                        exec("rm -rf ".$ruta);            
                    }            
            }
        }
        //Reemplazar el Archivo//
        
        
        if (copy($_SESSION['edit']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['edit']['ruta_pdf_temporal']);
                unset($_SESSION['edit']['ruta_pdf_temporal']);
        }
        else{
                $objResponse->alert("No se pudo subir el archivo");
            }
    }
}
else{
//$objResponse->alert("edit no esta seteado");
        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
         $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
         $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

            if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
                unset($_SESSION['tmp']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}
        

		arrayTheme();
		arrayAreas();
		arrayPermission();
                arrayPermissionKey();

if(isset($_SESSION['edit']['pdf'])){
    if($_SESSION['edit']['pdf']!=""){
        $_SESSION["publicaciones"]["pdf"]=$_SESSION['edit']['pdf'];
    }
}
                
		$xml= arrayToXml($_SESSION["publicaciones"],"publicaciones");
		$result=newPublicationSQL($action,$iddata,$form["tipoPublicacion"] ,$xml);
                $sql=$result["Query"];
                
                $tipoPublicacion=$form["tipoPublicacion"];
                /*
                switch ($tipoPublicacion) {
                    case 1:
                        $desc_subcategory="Artículos Indexados";
                    break;
                    case 2:
                        $desc_subcategory="Tesis";
                    break;                
                    case 3:
                        $desc_subcategory="Otras Publicaciones";
                    break;
                
                }
                */
                
		//$objResponse->alert($desc_subcategory." guardado satisfactoriamente");
                $objResponse->alert($result["Msg"]);
                //$objResponse->alert($sql);
                
                if ($action=="INS"){
		    $objResponse->script("xajax_formPublicacionShow(0,$tipoPublicacion)");
		    $objResponse->script("xajax_formSubcategoryShow($tipoPublicacion)");
                }
                elseif ($action=="UPD"){
                    $objResponse->script("xajax_abstractHide('formulario'); xajax_abstractShow('consultas'); xajax_abstractShow('resultSearch'); xajax_abstractShow('paginator');");
                }
                
                //$objResponse->alert($subcategory);
		//Borramos las variables de sesion
                if(isset($_SESSION["editar"])){
                    unset($_SESSION["editar"]);
                }
                
                if(isset($_SESSION["edit"])){
                    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
                }
                
                if(isset($_SESSION["tmp"])){
                    unset($_SESSION["tmp"]);
                }
                
                if(isset($_SESSION["publicaciones"])){
                    unset($_SESSION["publicaciones"]);
                }

    }
	return $objResponse;
}


function newAsuntosAcademicos($iddata=0,$action,$form){
	$objResponse = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
else{
    $recuperar=$_SESSION["tmp"];
}

        $prePorNombre=isset($recuperar["prePorNombre"])?$recuperar["prePorNombre"]:"";
        $prePorApellido=isset($recuperar["prePorApellido"])?$recuperar["prePorApellido"]:"";
        $inst_ext=isset($recuperar["inst_ext"])?$recuperar["inst_ext"]:"";
        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";
        
        $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";        
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];

		/***************/        
/********************Validar*********************************************************/
        $idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;
        $resultCheck=validarAsuntosAcademicos($idsubcategory,$areaPRI);
        
if ($resultCheck["Error"]==1){
            
        $objResponse->alert($resultCheck["Msg"]);
        $objResponse->script($resultCheck["funcion"]);
}        
/*****************************************************************************/        
else{            
    $_SESSION["publicaciones"]["areaPRI"]=$areaPRI;
    $_SESSION["publicaciones"]["date_ing"]=$date_ing;
    //$_SESSION["publicaciones"]["date_pub"]=$resultCheck["date_pub"];
    $_SESSION["publicaciones"]["month_pub"]=$resultCheck["month_pub"];
    $_SESSION["publicaciones"]["year_pub"]=$resultCheck["year_pub"];
    
    switch ($idsubcategory) {
        case 5:           
            $_SESSION["publicaciones"]["titulo"]=$resultCheck["titulo"];
            $_SESSION["publicaciones"]["prePorNombre"]=$prePorNombre;
            $_SESSION["publicaciones"]["prePorApellido"]=$prePorApellido;
            $_SESSION["publicaciones"]["inst_ext"]=$inst_ext;
        break;
        case 11:
            $_SESSION["publicaciones"]["yearCompendio"]=$resultCheck["yearCompendio"];
            $_SESSION["publicaciones"]["nroCompendio"]=$resultCheck["nroCompendio"];
        break;    
        case 12:
            $_SESSION["publicaciones"]["year"]=$resultCheck["year"];
            $_SESSION["publicaciones"]["quarter_description"]=$resultCheck["quarter_description"];
            $_SESSION["publicaciones"]["idquarter"]=$resultCheck["idquarter"];            
        break;    
    
    }
    
                /********************/
        
 

        $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
        $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

if(isset($_SESSION['edit'])){

        if(isset($_SESSION['edit']['pdf_upload'])){
        $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:$_SESSION['edit']['pdf_upload'];
        $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

//Reemplazar el Archivo//
        //Si se sube un nuevo archivo borrar el archivo anterior
        if (isset($_SESSION['edit']['pdf'])){//si parametro pdf del xml existe
            
            if($_SESSION['edit']['pdf']!=""){//si parametro pdf del xml no está vacío
        
                $ruta="data/$tipoDocumento/$subcategory/".$_SESSION['edit']['pdf'];
                if(is_file($ruta)){           
                    exec("rm -rf ".$ruta);            
                }            
            }
        }
//Reemplazar el Archivo//

            
            if (copy($_SESSION['edit']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['edit']['ruta_pdf_temporal']);
                unset($_SESSION['edit']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}
else{
//$objResponse->alert("edit no esta seteado");
        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){

            if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
                unset($_SESSION['tmp']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}

/*
                $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
                $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

		if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
                    	if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){

					$_SESSION["publicaciones"]["pdf"]=$archivoUpload;

					@unlink($_SESSION['tmp']['ruta_pdf_temporal']);
					unset($_SESSION['tmp']['ruta_pdf_temporal']);
			}
			else{
					$objResponse->alert("No se pudo subir el archivo");
			}
		}
*/
		/*************************/

		arrayTheme();
		arrayAreas();
                arrayAreasAdministrativas();
		arrayPermission();
                arrayPermissionKey();

if(isset($_SESSION['edit']['pdf'])){
    if($_SESSION['edit']['pdf']!=""){
        $_SESSION["publicaciones"]["pdf"]=$_SESSION['edit']['pdf'];
    }
}
                
		$xml= arrayToXml($_SESSION["publicaciones"],"publicaciones");
		//newPublicationSQL('INS',$form["tipoPublicacion"],$xml);
                $result=newAsuntosAcademicosSQL($action,$iddata,$form["tipoPublicacion"] ,$xml);
                $sql=$result["Query"];
                //$objResponse->alert($sql);
                //$objResponse->alert($xml);

                //$objResponse->alert(print_r($recuperar, true));
                /*
                switch ($form["tipoPublicacion"]) {
                    case 5:
                        $desc_subcategory="Conferencias Científicas";
                    break;
                    case 11:
                        $desc_subcategory="Compendios de Estudiantes";
                    break;
                    case 12:
                        $desc_subcategory="Informes Trimestrales";
                    break;
                
                }
                */
		//$objResponse->alert($desc_subcategory." guardado satisfactoriamente");
                $objResponse->alert($result["Msg"]);
                $tipoPublicacion=$form["tipoPublicacion"];
		$objResponse->script("xajax_formCategoryShow(3,$tipoPublicacion)");

		//Borramos las variables de sesion
                if(isset($_SESSION["tmp"])){
                    unset($_SESSION["tmp"]);
                }
                if(isset($_SESSION["edit"])){
                    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
                }
                if(isset($_SESSION["publicaciones"])){
                    unset($_SESSION["publicaciones"]);
                }
}
	return $objResponse;
}

function newGeofisicaSociedad($iddata=0,$action,$form){
	$objResponse = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
else{
    $recuperar=$_SESSION["tmp"];
}

        $prePorNombre=isset($recuperar["prePorNombre"])?$recuperar["prePorNombre"]:"";
        $prePorApellido=isset($recuperar["prePorApellido"])?$recuperar["prePorApellido"]:"";
        $inst_ext=isset($recuperar["inst_ext"])?$recuperar["inst_ext"]:"";
        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";
        
        $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";        
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];

		/***************/        
/********************Validar*********************************************************/
        $idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;
        $resultCheck=validarGeofisicaSociedad($idsubcategory,$areaPRI);
        
if ($resultCheck["Error"]==1){
            
        $objResponse->alert($resultCheck["Msg"]);
        $objResponse->script($resultCheck["funcion"]);
}        
/*****************************************************************************/        
else{            
    $_SESSION["publicaciones"]["areaPRI"]=$areaPRI;
    $_SESSION["publicaciones"]["date_ing"]=$date_ing;
    //$_SESSION["publicaciones"]["date_pub"]=$resultCheck["date_pub"];
    $_SESSION["publicaciones"]["month_pub"]=$resultCheck["month_pub"];
    $_SESSION["publicaciones"]["year_pub"]=$resultCheck["year_pub"];
    
    switch ($idsubcategory) {
        case 5:           
            $_SESSION["publicaciones"]["titulo"]=$resultCheck["titulo"];
            $_SESSION["publicaciones"]["prePorNombre"]=$prePorNombre;
            $_SESSION["publicaciones"]["prePorApellido"]=$prePorApellido;
            $_SESSION["publicaciones"]["inst_ext"]=$inst_ext;
        break;
        case 11:
            $_SESSION["publicaciones"]["yearCompendio"]=$resultCheck["yearCompendio"];
            $_SESSION["publicaciones"]["nroCompendio"]=$resultCheck["nroCompendio"];
        break;    
        case 12:
            $_SESSION["publicaciones"]["year"]=$resultCheck["year"];
            $_SESSION["publicaciones"]["quarter_description"]=$resultCheck["quarter_description"];
            $_SESSION["publicaciones"]["idquarter"]=$resultCheck["idquarter"];            
        break;    
        case 13:
            /*
            $_SESSION["publicaciones"]["year"]=$resultCheck["year"];
            $_SESSION["publicaciones"]["quarter_description"]=$resultCheck["quarter_description"];
            $_SESSION["publicaciones"]["idquarter"]=$resultCheck["idquarter"];            
            */
            $_SESSION["publicaciones"]["yearQuarter"]=$resultCheck["yearQuarter"];
            $_SESSION["publicaciones"]["quarter_description"]=$resultCheck["quarter_description"];
            $_SESSION["publicaciones"]["idquarter"]=$resultCheck["idquarter"];
            
        break;    
    
    }
    
                /********************/
        
 

        $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
        $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

if(isset($_SESSION['edit'])){

        if(isset($_SESSION['edit']['pdf_upload'])){
        $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:$_SESSION['edit']['pdf_upload'];
        $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

//Reemplazar el Archivo//
        //Si se sube un nuevo archivo borrar el archivo anterior
        if (isset($_SESSION['edit']['pdf'])){//si parametro pdf del xml existe
            
            if($_SESSION['edit']['pdf']!=""){//si parametro pdf del xml no está vacío
        
                $ruta="data/$tipoDocumento/$subcategory/".$_SESSION['edit']['pdf'];
                if(is_file($ruta)){           
                    exec("rm -rf ".$ruta);            
                }            
            }
        }
//Reemplazar el Archivo//

            
            if (copy($_SESSION['edit']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['edit']['ruta_pdf_temporal']);
                unset($_SESSION['edit']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}
else{
//$objResponse->alert("edit no esta seteado");
        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
                        
            //$objResponse->alert(print_r($destino, true));
            
            if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
                unset($_SESSION['tmp']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}

/*
                $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
                $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

		if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
                    	if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){

					$_SESSION["publicaciones"]["pdf"]=$archivoUpload;

					@unlink($_SESSION['tmp']['ruta_pdf_temporal']);
					unset($_SESSION['tmp']['ruta_pdf_temporal']);
			}
			else{
					$objResponse->alert("No se pudo subir el archivo");
			}
		}
*/
		/*************************/

		arrayTheme();
		arrayAreas();
                arrayAreasAdministrativas();
		arrayPermission();
                arrayPermissionKey();

if(isset($_SESSION['edit']['pdf'])){
    if($_SESSION['edit']['pdf']!=""){
        $_SESSION["publicaciones"]["pdf"]=$_SESSION['edit']['pdf'];
    }
}
                
		$xml= arrayToXml($_SESSION["publicaciones"],"publicaciones");
		//newPublicationSQL('INS',$form["tipoPublicacion"],$xml);
                $result=newGeofisicaSociedadSQL($action,$iddata,$form["tipoPublicacion"] ,$xml);
                $sql=$result["Query"];
                //$objResponse->alert($sql);
                //$objResponse->alert($xml);
                //$objResponse->alert($idsubcategory);
                

                //$objResponse->alert(print_r($_SESSION["publicaciones"], true));
                //$objResponse->alert(print_r($recuperar, true));
                
                /*
                switch ($form["tipoPublicacion"]) {
                    case 5:
                        $desc_subcategory="Conferencias Científicas";
                    break;
                    case 11:
                        $desc_subcategory="Compendios de Estudiantes";
                    break;
                    case 12:
                        $desc_subcategory="Informes Trimestrales";
                    break;
                
                }
                */
		//$objResponse->alert($desc_subcategory." guardado satisfactoriamente");
                $objResponse->alert($result["Msg"]);
                $tipoPublicacion=$form["tipoPublicacion"];
		$objResponse->script("xajax_formCategoryShow(5,$tipoPublicacion)");

		//Borramos las variables de sesion
                if(isset($_SESSION["tmp"])){
                    unset($_SESSION["tmp"]);
                }
                if(isset($_SESSION["edit"])){
                    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
                }
                if(isset($_SESSION["publicaciones"])){
                    unset($_SESSION["publicaciones"]);
                }
}
	return $objResponse;
}

function newInformacionInterna($iddata=0,$action,$form){
	$objResponse = new xajaxResponse();

if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}

        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";    
        
        $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
        $subAareas=isset($_SESSION["subAreas"])?$_SESSION["subAreas"]:"";
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];
        
/********************Validar*********************************************************/
        
        $idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;
        $resultCheck=validarInformacionInterna($idsubcategory,$areaPRI);

if ($resultCheck["Error"]==1){
        $objResponse->alert($resultCheck["Msg"]);
        $objResponse->script($resultCheck["funcion"]);
}        
                        
/*****************************************************************************/        
else{
        $_SESSION["publicaciones"]["areaPRI"]=$areaPRI;
        $_SESSION["publicaciones"]["date_ing"]=$date_ing;
        
        $_SESSION["publicaciones"]["month_pub"]=$resultCheck["month_pub"];
        $_SESSION["publicaciones"]["desc_month_pub"]=$resultCheck["desc_month_pub"];
        $_SESSION["publicaciones"]["year_pub"]=$resultCheck["year_pub"];
        
        
            
    switch ($idsubcategory) {
        case 6:           
            $_SESSION["publicaciones"]["titulo"]=$resultCheck["titulo"];
            
        break;
        case 7:            
            $_SESSION["publicaciones"]["yearQuarter"]=$resultCheck["yearQuarter"];
            $_SESSION["publicaciones"]["quarter_description"]=$resultCheck["quarter_description"];
            $_SESSION["publicaciones"]["idquarter"]=$resultCheck["idquarter"];
            
        break;
        case 8:         
            $_SESSION["publicaciones"]["day_pub"]=$resultCheck["day_pub"];
            $_SESSION["publicaciones"]["nroBoletin"]=$resultCheck["nroBoletin"];
            $_SESSION["publicaciones"]["idmagnitud"]=$resultCheck["idmagnitud"];

            $_SESSION["publicaciones"]["idRegion"]=$resultCheck["idRegion"];
            $_SESSION["publicaciones"]["region_description"]=$resultCheck["region_description"];
            $_SESSION["publicaciones"]["idDepartamento"]=$resultCheck["idDepartamento"];
            $_SESSION["publicaciones"]["departamento_description"]=$resultCheck["departamento_description"];
            
        break;
    
        }
        
        
    if(isset($_SESSION['edit'])){

        if(isset($_SESSION['edit']['pdf_upload'])){//si se cargó un archivo
            $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:$_SESSION['edit']['pdf_upload'];
            $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;

//Reemplazar el Archivo//
        //Si se sube un nuevo archivo borrar el archivo anterior
        if (isset($_SESSION['edit']['pdf'])){//si parametro pdf del xml existe
            
            if($_SESSION['edit']['pdf']!=""){//si parametro pdf del xml no está vacío
                
                $ruta="data/$tipoDocumento/$subcategory/".$_SESSION['edit']['pdf'];
                    if(is_file($ruta)){
                        exec("rm -rf ".$ruta);
                        //$objResponse->alert("se borró el archivo");    
                    }
                    /*
                    else{
                        $objResponse->alert("no se borró el archivo<br>".$ruta);
                    }
                    */
            }
        }
//Reemplazar el Archivo//

            if (copy($_SESSION['edit']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['edit']['ruta_pdf_temporal']);
                unset($_SESSION['edit']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
        
}
else{
//$objResponse->alert("edit no esta seteado");
        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
             $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
             $destino="data/$tipoDocumento/$subcategory/".$archivoUpload;
            
            if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){
                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
                @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
                unset($_SESSION['tmp']['ruta_pdf_temporal']);
            }
            else{
                $objResponse->alert("No se pudo subir el archivo");
            }
        }
}

		arrayTheme();
		arrayAreas();
                arraySubAreas();
		arrayPermission();
                arrayPermissionKey();


if(isset($_SESSION['edit']['pdf'])){
    if($_SESSION['edit']['pdf']!=""){
        $_SESSION["publicaciones"]["pdf"]=$_SESSION['edit']['pdf'];
    }
}
                
		$xml= arrayToXml($_SESSION["publicaciones"],"publicaciones");
		//newPublicationSQL('INS',$form["tipoPublicacion"] ,$xml);
		$newInformacionInternaSQL=newInformacionInternaSQL($action,$iddata,$form["tipoPublicacion"] ,$xml);
                
                if ($newInformacionInternaSQL["Error"]==1){
		//$objResponse->alert($xml);
                //$objResponse->alert($xml);
                //$objResponse->alert($newInformacionInternaSQL["Query1"]);
                    $objResponse->alert($newInformacionInternaSQL["Msg"]);
                }
                else{
                /*
                switch ($form["tipoPublicacion"]) {
                    case 6:
                        $desc_subcategory="Reportes Técnicos";
                    break;
                    case 7:
                        $desc_subcategory="Informes Trimestrales";
                    break;
                    case 8:
                        $desc_subcategory="Boletínes Sísmicos";
                    break;                 

                }
                 */
                    
		//$objResponse->alert($desc_subcategory." guardado satisfactoriamente");
                $objResponse->alert($newInformacionInternaSQL["Msg"]);
                
                if ($action=="INS"){
		  $objResponse->script("xajax_formCategoryShow(4)");
                }
                elseif ($action=="UPD"){
                    $objResponse->script("xajax_abstractHide('formulario'); xajax_abstractShow('consultas'); xajax_abstractShow('resultSearch'); xajax_abstractShow('paginator');");
                }
                
		//Borramos las variables de sesion
                if(isset($_SESSION["tmp"])){
                    unset($_SESSION["tmp"]);
                }
                if(isset($_SESSION["edit"])){
                    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
                }
                if(isset($_SESSION["publicaciones"])){
                    unset($_SESSION["publicaciones"]);
                }
                }
        }
	return $objResponse;
}

function newPonencia($iddata=0,$action){
        $objResponse = new xajaxResponse();
	
	
        if(isset($_SESSION["edit"])){
            $recuperar=$_SESSION["edit"];
        }
        else{
            $recuperar=$_SESSION["tmp"];
        }

        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";
        
        $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";        
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];
        $tipoDocumento=$_SESSION["tipoDocumento"];
        $subcategory=$_SESSION["subcategory"];
        
/********************Validar*********************************************************/
$idsubcategory=isset($_SESSION["idsubcategory"])?$_SESSION["idsubcategory"]:0;               
$resultCheck=validarPonencias($idsubcategory,$areaPRI);

if ($resultCheck["Error"]==1){
        $objResponse->alert($resultCheck["Msg"]);
        $objResponse->script($resultCheck["funcion"]);
}
/*****************************************************************************/        
else{
        $_SESSION["publicaciones"]["areaPRI"]=$areaPRI;
        $_SESSION["publicaciones"]["date_ing"]=$date_ing;
        $_SESSION["publicaciones"]["month_pub"]=$resultCheck["month_pub"];
        $_SESSION["publicaciones"]["year_pub"]=$resultCheck["year_pub"];
        
        $_SESSION["publicaciones"]["titulo"]=$resultCheck["titulo"];
        $_SESSION["publicaciones"]["idtipoPonencia"]=$resultCheck["idtipoPonencia"];
        $_SESSION["publicaciones"]["tipoPonencia_description"]=$resultCheck["tipoPonencia_description"];
        
        $_SESSION["publicaciones"]["prePorNombre"]=$resultCheck["prePorNombre"];
        $_SESSION["publicaciones"]["prePorApellido"]=$resultCheck["prePorApellido"];
        
        
        $_SESSION["publicaciones"]["lugar"]=$resultCheck["lugar"];
        $_SESSION["publicaciones"]["pais_description"]=$resultCheck["pais_description"];
        
        $_SESSION["publicaciones"]["evento_description"]=$resultCheck["evento_description"];
        $_SESSION["publicaciones"]["idcategoriaEvento"]=$resultCheck["idcategoriaEvento"];
        $_SESSION["publicaciones"]["categoriaEvento_description"]=$resultCheck["categoriaEvento_description"];
        $_SESSION["publicaciones"]["idclaseEvento"]=$resultCheck["idclaseEvento"];
        $_SESSION["publicaciones"]["claseEvento_description"]=$resultCheck["claseEvento_description"];
        
        //$_SESSION["publicaciones"]["date_ing"]=$resultCheck["date_ing"];
        //$_SESSION["publicaciones"]["date_pub"]=$resultCheck["date_pub"];

        $tipoDocumento=$_SESSION["tipoDocumento"];

        if(isset($_SESSION['edit'])){
		
            if(isset($_SESSION['edit']['pdf_upload'])){
                
                $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:$_SESSION['edit']['pdf_upload'];
                $destino="data/$tipoDocumento/".$archivoUpload;
                
//Reemplazar el Archivo//
        //Si se sube un nuevo archivo borrar el archivo anterior
        if (isset($_SESSION['edit']['pdf'])){//si parametro pdf del xml existe
            
            if($_SESSION['edit']['pdf']!=""){//si parametro pdf del xml no está vacío
                
                $ruta="data/$tipoDocumento/".$_SESSION['edit']['pdf'];
                if(is_file($ruta)){           
                    exec("rm -rf ".$ruta);            
                }            
            }
        }
//Reemplazar el Archivo//

	
                    if (copy($_SESSION['edit']['ruta_pdf_temporal'],$destino)){
	                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
	                @unlink($_SESSION['edit']['ruta_pdf_temporal']);
	                unset($_SESSION['edit']['ruta_pdf_temporal']);
	            }
	            else{
	                $objResponse->alert("No se pudo subir el archivo");
	            }
            }
        }
        else{
		
	        if(isset($_SESSION['tmp']['ruta_pdf_temporal'])){
                    $archivoUpload=isset($recuperar["pdf"])?$recuperar["pdf"]:"";
                    $destino="data/$tipoDocumento/".$archivoUpload;

	            if (copy($_SESSION['tmp']['ruta_pdf_temporal'],$destino)){
	                $_SESSION["publicaciones"]["pdf"]=$archivoUpload;
	                @unlink($_SESSION['tmp']['ruta_pdf_temporal']);
	                unset($_SESSION['tmp']['ruta_pdf_temporal']);
	            }
	            else{
	                $objResponse->alert("No se pudo subir el archivo");
	            }
	        }
            }
            
		arrayTheme();
		arrayAreas();
		arrayPermission();
		arrayPermissionKey();
                
if(isset($_SESSION['edit']['pdf'])){
    if($_SESSION['edit']['pdf']!=""){
        $_SESSION["publicaciones"]["pdf"]=$_SESSION['edit']['pdf'];
    }
}
                
		$xml= arrayToXml($_SESSION["publicaciones"],"publicaciones");
		$newPonenciaSQL=newPonenciaSQL($action,$iddata,4,$xml);
                
                if ($newPonenciaSQL["Error"]==1){
                    //$objResponse->alert(print_r($newPublicationSQL,true));
                    //$objResponse->alert($newPublicationSQL["Count"]);
                    //$objResponse->alert($newPonenciaSQL["Msg"]);
                }
                else{
                    //$objResponse->alert($xml);
                    $objResponse->alert("Ponencia guardado satisfactoriamente");
                    $objResponse->script("xajax_formPonenciasShow()");


                    //Borramos las variables de sesion
                    if (isset($_SESSION["tmp"])){
                            unset($_SESSION["tmp"]);
                    }

                    if (isset($_SESSION["edit"])){
                            unset($_SESSION["edit"]);
                            unset($_SESSION["editar"]);
                    }
                    if(isset($_SESSION["publicaciones"])){
                            unset($_SESSION["publicaciones"]);
                    }
                }
                
                }
	return $objResponse;
}


/******************************************/
function arrayToXml($array,$lastkey='root'){

	$buffer="";
    $buffer.="<".$lastkey.">";
    if (!is_array($array)){
		$buffer.=$array;}
    else{
        foreach($array as $key=>$value){
            if (is_array($value)){
                if ( is_numeric(key($value))){
                    foreach($value as $bkey=>$bvalue){
                        $buffer.=arrayToXml($bvalue,$key);
                    }
                }
                else{
                    $buffer.=arrayToXml($value,$key);
                }
            }
            else{
                    $buffer.=arrayToXml($value,$key);
            }
        }
    }
    $buffer.="</".$lastkey.">\n";
    return $buffer;
}

function arrayAuthor(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
}
    
	$objResponse = new xajaxResponse();
	if (isset($recuperar["authorPRI"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorPRI"])){
                unset($_SESSION["publicaciones"]["authorPRI"]);
            }
                
            $idx=$recuperar["authorPRI"]["idauthor"];
            $i=0;
            foreach($idx as $key => $idauthor){
                $_SESSION["publicaciones"]["authorPRI"]["idauthor$i"]=$idauthor;
                $i++;
            }

            $firstx=$recuperar["authorPRI"]["author_first_name"];
            $i=0;
            foreach($firstx as $key => $author_first_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_first_name$i"]=$author_first_name;
                $i++;
            }

            $secondx=$recuperar["authorPRI"]["author_second_name"];
            $i=0;
            foreach($secondx as $key => $author_second_name){
                $_SESSION["publicaciones"]["authorPRI"]["author_second_name$i"]=$author_second_name;
                $i++;
            }
                
            $surnamex=$recuperar["authorPRI"]["author_surname"];
            $i=0;
            foreach($surnamex as $key => $author_surname_name){
                $author_surname_name=(str_replace("'","*",$author_surname_name));
                $_SESSION["publicaciones"]["authorPRI"]["author_surname$i"]=$author_surname_name;
                $i++;
            }

        }

	if (isset($recuperar["authorSEC"]["idauthor"])){
            if (isset($_SESSION["publicaciones"]["authorSEC"])){
                unset($_SESSION["publicaciones"]["authorSEC"]);
            }


                $idx=$recuperar["authorSEC"]["idauthor"];
                $i=0;
                foreach($idx as $key => $idauthor){
                    $_SESSION["publicaciones"]["authorSEC"]["idauthor$i"]=$idauthor;
                    $i++;
                }
              
                $firstx=$recuperar["authorSEC"]["author_first_name"];
                $i=0;
                foreach($firstx as $key => $author_first_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_first_name$i"]=$author_first_name;
                    $i++;
                }
                
                $secondx=$recuperar["authorSEC"]["author_second_name"];
                $i=0;
                foreach($secondx as $key => $author_second_name){
                    $_SESSION["publicaciones"]["authorSEC"]["author_second_name$i"]=$author_second_name;
                    $i++;
                }
                                
                $surnamex=$recuperar["authorSEC"]["author_surname"];
                $i=0;
                foreach($surnamex as $key => $author_surname_name){
                    $author_surname_name=(str_replace("'","*",$author_surname_name));
                    $_SESSION["publicaciones"]["authorSEC"]["author_surname$i"]=$author_surname_name;
                    $i++;
                }
                
        }

	return $recuperar;
}

function arrayTheme(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["themes"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["theme"])){
			unset($_SESSION["publicaciones"]["theme"]);
		}


		foreach($recuperar["themes"] as $key=>$value){
			$_SESSION["publicaciones"]["theme"]["idtheme$i"]=$key;
                        $_SESSION["publicaciones"]["theme"]["theme_description$i"]=$value;
			$i++;
		}
/*
		$i=0;
		foreach($recuperar["theme_description"] as $key=>$value){
			$_SESSION["publicaciones"]["theme"]["theme_description$i"]=$value;
			$i++;
		}
*/

	}
        
}

function arraySubAreas(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["subAreas"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["subAreas"])){
			unset($_SESSION["publicaciones"]["subAreas"]);
		}

		foreach($recuperar["subAreas"] as $key=>$value){
			$_SESSION["publicaciones"]["subAreas"]["idsubarea$i"]=$key;
			$i++;
		}

	}
}


function arrayAreasAdministrativas(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["areasAdministrativas"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["areaAdministrativas"])){
			unset($_SESSION["publicaciones"]["areaAdministrativas"]);
		}

		foreach($recuperar["areasAdministrativas"] as $key=>$value){
			$_SESSION["publicaciones"]["areasAdministrativas"]["idareaAdministrativas$i"]=$key;
			$i++;
		}

	}
}

function arrayAreas(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["areasSEC"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["areasSEC"])){
			unset($_SESSION["publicaciones"]["areasSEC"]);
		}

		foreach($recuperar["areasSEC"] as $key=>$value){
			$_SESSION["publicaciones"]["areasSEC"]["idarea$i"]=$key;
			$i++;
		}

	}
}


function arrayPermission(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["permission"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["permisos"])){
			unset($_SESSION["publicaciones"]["permisos"]);
		}

		foreach($recuperar["permission"] as $key=>$value){
			$_SESSION["publicaciones"]["permisos"]["idpermission$key"]=$key;
			$i++;
		}

	}
}

function arrayPermissionKey(){
if(isset($_SESSION["edit"])){
    $recuperar=$_SESSION["edit"];
}
elseif(isset($_SESSION["tmp"])){
    $recuperar=$_SESSION["tmp"];
 }

	if (isset($recuperar["key"])){
		$i=0;

		if(isset($_SESSION["publicaciones"]["claves"])){
			unset($_SESSION["publicaciones"]["claves"]);
		}

		foreach($recuperar["key"] as $key=>$value){
			$_SESSION["publicaciones"]["claves"]["idkey$key"]=$key;
			$i++;
		}

	}
}

function arrayStatus(){

    if (isset($_SESSION["edit"]["status"])){
        $_SESSION["publicaciones"]["status"]=$_SESSION["edit"]["status"];

    }

}




?>
