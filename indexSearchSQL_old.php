<?php

	/**************************************************
	Contiene funciones para la busqueda de datos
	
	***************************************************/
	
	
	function searchPublicationSQL($idcategory,$form,$idfrom,$currentPage= '', $pageSize= '', $idarea=0){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		if($idfrom==2){
	        $sql = "SELECT * FROM data d, subcategory s, category c WHERE d.idsubcategory=s.idsubcategory AND s.idcategory=c.idcategory ";
		}
	
		if($idfrom==1){
			$sql = "SELECT * FROM data d, subcategory s, category c WHERE d.idsubcategory=s.idsubcategory and s.idcategory=c.idcategory ";
                        //$sql .=	" and ExtractValue(data_content,'publicaciones/pdf')!="."''";
		}
	
	
		if($idfrom==0){
			$sql = "SELECT * FROM data d, subcategory s, category c WHERE d.idsubcategory=s.idsubcategory AND s.idcategory=c.idcategory and s.idcategory=$idcategory ";
		}
	
		if($idfrom==3){
			$sql = "SELECT * FROM data d, subcategory s, category c WHERE d.idsubcategory=s.idsubcategory and s.idcategory=c.idcategory ";
			$sql .=	" AND  (ExtractValue(data_content,'publicaciones/authorPRI/idauthor0')= "."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor0') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor1') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor2') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor3') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor4') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor5') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor6') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor7') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor8') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor9') ="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor10')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor11')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor12')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor13')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor14')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor15')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor16')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor17')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor18')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor19')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor20')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor21')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor22')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor23')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor24')="."'".$_SESSION["idautor"]."'";
			$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/idauthor25')="."'".$_SESSION["idautor"]."'";
                        
			$sql .= ")";
		}
	
		// TITULO
		// **********************************************************************************************
		if(isset($form["tituloSearch"])){
			if(strlen($form["tituloSearch"])>0){
                                $form["tituloSearch"]=(str_replace("'","*",$form["tituloSearch"]));
				$sql .=	" AND ExtractValue(data_content,'publicaciones/titulo') LIKE '%".$form["tituloSearch"]."%'";
			}
		}
		// AUTOR
		// **********************************************************************************************
		if(isset($form["author"])){
			if(strlen($form["author"])>0){
                                $form["author"]=(str_replace("'","*",$form["author"]));
				$sql .=	" AND ( ExtractValue(data_content,'publicaciones/authorPRI/author_surname0') LIKE '%".$form["author"]."%'";
	
				$sql .=	" OR ExtractValue(data_content,'publicaciones/authorSEC/child::*') LIKE '%".$form["author"]."%') ";
	
			}
		}
		// TIPO DE PUBLICACION
		// **********************************************************************************************
		if(isset($form["idcategory"])){
			if ($form["idcategory"]<>0){
				$sql .=	" AND c.idcategory=".$form["idcategory"];
                                //$sql .=	" OR c.idcategory=5) ";
			}
		}
	
		// SUBCATEGORIA DE PUBLICACION
		// **********************************************************************************************
		
		
		if(isset($form["idsubcategory"])){
			if ($form["idsubcategory"]<>0){
				$sql .=	" AND s.idsubcategory=".$form["idsubcategory"];
			}
		}
		
		if(isset($form["selectTypePublication"])){
			if ($form["selectTypePublication"]<>10){
				$sql .=	" AND s.idsubcategory=".$form["selectTypePublication"];
			}
		}
                
                if(isset($form["selectTypeCategory"])){    
                    if ($form["selectTypeCategory"]<>0){
                        $sql .=	" AND s.idsubcategory=".$form["selectTypeCategory"];        
                    }
                }
                else{
                    if(isset($form["tip_inf"])){
                        if($form["tip_inf"]!=0){
                            $sql .=	" AND s.idsubcategory=".$form["tip_inf"];
                        }

                    }
                    elseif(isset($_SESSION["tip_inf"])){
                        if($_SESSION["tip_inf"]!=0){
                            $sql .=	" AND s.idsubcategory=".$_SESSION["tip_inf"];
                        }

                    }
                }
                if(isset($_SESSION["iddata"])){
                    if($_SESSION["iddata"]!=0){
                        $sql .=	" AND d.iddata=".$_SESSION["iddata"];
                    }

                }

		// TIPO DE FECHA
		// **********************************************************************************************
		if(isset($form["selectTypeDate"])){
			
			// 1: Fecha ingreso
			if ($form["selectTypeDate"]==1 and $form["searchYear"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_ing') LIKE '%".$form["searchYear"]."%'";
			}
	
			if ($form["selectTypeDate"]==1 and $form["searchMonth"]<>0){
				$numberMonth=sprintf("%02d",$form["searchMonth"]);
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_ing') LIKE '%-".$numberMonth."-%'";
	
	 		}
	
			// 2: Fecha de publicacion
			if ($form["selectTypeDate"]==2 and $form["searchYear"]<>0){
				$sql .=	" AND (ExtractValue(data_content,'publicaciones/date_pub') LIKE '%".$form["searchYear"]."%' ";
                                $sql .=	" OR ExtractValue(data_content,'publicaciones/year_pub') LIKE '%".$form["searchYear"]."%') ";
                            
                                //$sql .=	" AND ExtractValue(data_content,'publicaciones/date_pub') LIKE '%".$form["searchYear"]."%'"; 
			}
	
			if ($form["selectTypeDate"]==2 and $form["searchMonth"]<>0){
				$numberMonth=sprintf("%02d",$form["searchMonth"]);
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_pub') LIKE '%-".$numberMonth."-%'";
	
	 		}
	
			// 3: Fecha de presentacion
			if ($form["selectTypeDate"]==3 and $form["searchYear"]<>0){
				$sql .=	" AND (ExtractValue(data_content,'publicaciones/date_pub') LIKE '%".$form["searchYear"]."%' ";
                                $sql .=	" OR ExtractValue(data_content,'publicaciones/year_pub') LIKE '%".$form["searchYear"]."%') ";
			}
	
			if ($form["selectTypeDate"]==3 and $form["searchMonth"]<>0){
				$numberMonth=sprintf("%02d",$form["searchMonth"]);
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_pub') LIKE '%-".$numberMonth."-%'";
	
	 		}
	
			// 4: Fecha de sismo
			if ($form["selectTypeDate"]==4 and $form["searchYear"]<>0){
				$sql .=	" AND (ExtractValue(data_content,'publicaciones/date_pub') LIKE '%".$form["searchYear"]."%' ";
                                $sql .=	" OR ExtractValue(data_content,'publicaciones/year_pub') LIKE '%".$form["searchYear"]."%') ";
			}
	
			if ($form["selectTypeDate"]==4 and $form["searchMonth"]<>0){
				$numberMonth=sprintf("%02d",$form["searchMonth"]);
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_pub') LIKE '%-".$numberMonth."-%'";
	 		}
	
	            $selectTypeAcademicos=isset($form["selectTypeAcademicos"])?$form["selectTypeAcademicos"]:"";
	            $selectTypeCategory=isset($form["selectTypeCategory"])?$form["selectTypeCategory"]:"";
                    $idsubcategory=isset($form["idsubcategory"])?$form["idsubcategory"]:"";
	                        
	            
			if ($idsubcategory==11 and $form["searchYear"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$form["searchYear"]."%'";
			}
                        
			if ($idsubcategory==12 and $form["searchYear"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$form["searchYear"]."%'";
			}

			if ($idsubcategory==13 and $form["searchYear"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$form["searchYear"]."%'";
			}
                        
			if ($selectTypeCategory==7 and $form["searchYear"]<>0){
				//$sql .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$form["searchYear"]."%'";
				$sql .=	" AND ExtractValue(data_content,'publicaciones/year_pub') LIKE '%".$form["searchYear"]."%'";
			}
	                
		}
		else{
			// Para el buscador de la pagina general
			/*if ($_SESSION["idfrom"]==1 and $form["yearDesde"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_pub') LIKE '%".$form["yearDesde"]."%'";
			}	            			
                        /*
			if ($_SESSION["idfrom"]==1 and $form["month"]<>0){
				$numberMonth=sprintf("%02d",$form["month"]);
				$sql .=	" AND ExtractValue(data_content,'publicaciones/date_ing') LIKE '%-".$numberMonth."-%'";
	 		}			
	 		*/
                    if(isset($form["yearDesde"]) or isset($form["yearHasta"])){
			            $selectTypeCategory=isset($form["selectTypeCategory"])?$form["selectTypeCategory"]:0;
                        //Rango de Fechas
			if ($form["yearDesde"]<>0 AND $form["yearHasta"]==0 and $_SESSION["idfrom"]==1 or $_SESSION["idfrom"]==2  or $_SESSION["idfrom"]==3){
				if ($selectTypeCategory==7){
					$sql .=	" AND ExtractValue(data_content,'publicaciones/yearQuarter') >= '".$form["yearDesde"]."' AND ExtractValue(data_content,'publicaciones/yearQuarter') !='' ";
				}
				else{
                                    if ($form["yearDesde"]<>0 ){
				/*
				$sql .=	" AND (ExtractValue(data_content,'publicaciones/date_pub') >= '".$form["yearDesde"]."' AND ExtractValue(data_content,'publicaciones/date_pub') !='' ";
                                $sql .=	" OR ExtractValue(data_content,'publicaciones/year_pub') >= '".$form["yearDesde"]."' AND ExtractValue(data_content,'publicaciones/year_pub') !='') ";
				*/
				
				$sql .= " AND (SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."' ";
                                $sql .= " OR SUBSTR(ExtractValue(data_content,'publicaciones/year_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."') ";
	                        $sql .= " AND (ExtractValue(data_content,'publicaciones/date_pub') !='' ";
                                $sql .= " OR ExtractValue(data_content,'publicaciones/year_pub') !='') ";
				
                                    }
				}
	 		}
                        
			elseif ($form["yearHasta"]<>0 AND $form["yearDesde"]==0 and $_SESSION["idfrom"]==1 or $_SESSION["idfrom"]==2 or $_SESSION["idfrom"]==3 ){
				if ($selectTypeCategory==7){
					$sql .=	" AND ExtractValue(data_content,'publicaciones/yearQuarter') <= '".$form["yearHasta"]."' AND ExtractValue(data_content,'publicaciones/yearQuarter') !='' ";
				}       
				else{
				/*
				$sql .=	" AND (ExtractValue(data_content,'publicaciones/date_pub') <= '".$form["yearHasta"]."' AND ExtractValue(data_content,'publicaciones/date_pub') !='' ";
                                $sql .=	" OR ExtractValue(data_content,'publicaciones/year_pub') <= '".$form["yearHasta"]."' AND ExtractValue(data_content,'publicaciones/year_pub') !='') ";
				*/
				
				$sql .= " AND (SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."' ";
                                $sql .= " OR SUBSTR(ExtractValue(data_content,'publicaciones/year_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."') ";
	                        $sql .= " AND (ExtractValue(data_content,'publicaciones/date_pub') !='' ";
                                $sql .= " OR ExtractValue(data_content,'publicaciones/year_pub') !='') ";
				
				}
	 		}
                        
			elseif ($form["yearDesde"]<>0 and $form["yearHasta"]<>0 and $_SESSION["idfrom"]==1 or $_SESSION["idfrom"]==2 or $_SESSION["idfrom"]==3 ){
				if ($selectTypeCategory==7){
					/*
					$sql .=	" AND ExtractValue(data_content,'publicaciones/year') between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."' ";
		                        $sql .= " AND ExtractValue(data_content,'publicaciones/year') !='' ";
					*/
					$sql .=	" AND ExtractValue(data_content,'publicaciones/year_pub') between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."' ";
		                        $sql .= " AND ExtractValue(data_content,'publicaciones/year_pub') !='' ";

		                        //$sql .= " AND ExtractValue(data_content,'publicaciones/year') !=str_to_date('000-00-00','%Y-%m-%d' ) ";
				}
				else{

					$sql .=	" AND (SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."' ";
                                        $sql .=	" OR SUBSTR(ExtractValue(data_content,'publicaciones/year_pub'),1,4) between '".$form["yearDesde"]."' AND '".$form["yearHasta"]."') ";
		                        $sql .= " AND (ExtractValue(data_content,'publicaciones/date_pub') !='' ";
                                        $sql .= " OR ExtractValue(data_content,'publicaciones/year_pub') !='') ";
		                        //$sql .= " AND ExtractValue(data_content,'publicaciones/date_pub') !=str_to_date('000-00-00','%Y-%m-%d' ) ";
				}
	 		}
                    }	
		}
	
		// REFERENCIA
		// **********************************************************************************************
		if(isset($form["selectReferencia"])){
			if ($form["selectReferencia"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idreference') =".$form["selectReferencia"];
			}
		}
	
		// ESTADO
		// **********************************************************************************************
		if(isset($form["selectStatus"])){
			if ($form["selectStatus"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/status')=".$form["selectStatus"];
			}
		}
	
		// TESIS - TIPO
		// **********************************************************************************************
		if(isset($form["tipoTesis"])){
			if ($form["tipoTesis"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/tipo_tesis')=".$form["tipoTesis"];
			}
		}
	
	
		// TESIS - PAIS
		// **********************************************************************************************
		if(isset($form["pais"])){
			if (strlen($form["pais"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/pais') LIKE '%".$form["pais"]."%'";
			}
		}
	
	
	
		// TESIS - UNIVERSIDAD
		// **********************************************************************************************
		if(isset($form["uni"])){
			if (strlen($form["uni"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/uni') LIKE '%".$form["uni"]."%'";
			}
		}
	
	
		// PONENCIA - TIPO
		// **********************************************************************************************
		if(isset($form["tipoPonencia"])){
			if ($form["tipoPonencia"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idtipoPonencia') =".$form["tipoPonencia"];
			}
		}
	
		// PONENCIA - PRESENTADO POR
		// **********************************************************************************************
		if(isset($form["prePorNombre"])){
			if (strlen($form["prePorNombre"])!=""){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/prePorNombre') LIKE '%".$form["prePorNombre"]."%'";
			}
		}
	
		if(isset($form["prePorApellido"])){
			if (strlen($form["prePorApellido"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/prePorApellido') LIKE '%".$form["prePorApellido"]."%'";
			}
		}
	        
		// PONENCIA - NOMBRE DEL EVENTO
		// **********************************************************************************************
		if(isset($form["evento"])){
			if (strlen($form["evento"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/evento') LIKE '%".$form["evento"]."%'";
			}
		}

		// PONENCIA - CATEGORIA DEL EVENTO
		// **********************************************************************************************
		if(isset($form["selectCategoriaEvento"])){
			if ($form["selectCategoriaEvento"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idcategoriaEvento') = '".$form["selectCategoriaEvento"]."'";
			}
		}

		// PONENCIA - CLASE DEL EVENTO
		// **********************************************************************************************
		if(isset($form["selectClaseEvento"])){
			if ($form["selectClaseEvento"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idclaseEvento') = '".$form["selectClaseEvento"]."'";
			}
		}
                
		// ASUNTOS ACADEMICOS - TIPO
		// **********************************************************************************************
		if(isset($form["selectTypeAcademicos"])){
			if ($form["selectTypeAcademicos"]<>0){
				$sql .=	" AND s.idsubcategory=".$form["selectTypeAcademicos"];
			}
		}

		// Geofisica sociedad - TIPO
		// **********************************************************************************************
		if(isset($form["selectTypeGeofisica"])){
			if ($form["selectTypeGeofisica"]<>0){
				$sql .=	" AND s.idsubcategory=".$form["selectTypeGeofisica"];
			}
		}
                
		// ASUNTOS ACADEMICOS - AREA
		// **********************************************************************************************
		if(isset($form["area"])){
			if (strlen($form["area"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/area') LIKE '%".$form["area"]."%'";
			}
		}
	
		// ASUNTOS ACADEMICOS - AREA
		// **********************************************************************************************
		if(isset($form["area"])){
			if (strlen($form["area"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/area') LIKE '%".$form["area"]."%'";
			}
		}
	
		// ASUNTOS ACADEMICOS - NRO COMPENDIO
		// **********************************************************************************************
	
		if(isset($form["nro_compendio"])){
			if (strlen($form["nro_compendio"])>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/nroCompendio')='".$form["nro_compendio"]."'";
			}
		}
	
	
		// ASUNTOS ACADEMICOS - TRIMESTRE
		// **********************************************************************************************
	
		if(isset($form["trimestre"])){
			if ($form["trimestre"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idquarter')='".$form["trimestre"]."'";
			}
		}
	
	
		// BOLETINES SISMICOS - MAGNITUD
		// **********************************************************************************************
	
		if(isset($form["selectMagnitud"])){
			if ($form["selectMagnitud"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idmagnitud')='".$form["selectMagnitud"]."'";
			}
		}
	
		if(isset($form["selectRegion"])){
			if ($form["selectRegion"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idRegion')='".$form["selectRegion"]."'";
			}
		}
	
		if(isset($form["selectDepartamento"])){
			if ($form["selectDepartamento"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/idDepartamento')='".$form["selectDepartamento"]."'";
			}
		}
	
		// AREA
		// **********************************************************************************************
		if(isset($form["selectAreas"])){
			if ($form["selectAreas"]<>0){
				$sql .=	" AND ExtractValue(data_content,'publicaciones/areaPRI') =".$form["selectAreas"];
	          
			}
		}//viene del gráfico general de áreas
	        else{
	            if (isset($idarea)){
	                if ($idarea<>0){
                            if ($idarea<>9){
	                        $sql .= " AND ExtractValue(data_content,'publicaciones/areaPRI')=".$idarea;
                            }
	                }
	            }
	        }
	        
/******************************************************************/                
	        $order_by="";

                if(isset($form["selectAreas"])){
                    if($form["selectAreas"]==0){
                        $order_by=" ORDER BY s.idsubcategory ";
        		//$order_by.=", ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                        $order_by.=", SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/titulo') ";
                    }
                }
                //Ordenar Publicaciones (publicaciones=1, ponencias=2, inofrmacion interna=4)//
                if(isset($form["idcategory"])){
                    if($form["idcategory"]==2){
        		$order_by=" ORDER BY ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/titulo') ";
                    }
                    
                    elseif($form["idcategory"]==4){
                        $order_by=" ORDER BY s.idsubcategory DESC ";
        		$order_by.=", ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                        $order_by.=", SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/titulo') ";
                    }

                    
                }/*
                if(isset($form["idsubcategory"])){
                    if($form["idsubcategory"]==13){//Informe Trimestral de Geofísica y Sociedad
                        $order_by=" ORDER BY ExtractValue(data_content,'publicaciones/yearQuarter') desc ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/idquarter') desc ";                    
                    }
                }
                */
                //Ordenar Artículos Indexados, Tesis, Otras Publicaciones//
                if(isset($form["selectTypePublication"])){
        		$order_by=" ORDER BY SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/titulo') ";
                }
                if(isset($form["selectTypeGeofisica"])){
                        $order_by=" ORDER BY ExtractValue(data_content,'publicaciones/yearQuarter') desc ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/idquarter') desc ";                                        
                }
                //Ordenar Informes Trimestrales//
                if(isset($form["selectTypeCategory"])){
                    if($form["selectTypeCategory"]==7){
                        $order_by=" ORDER BY ";
                        $order_by.=" ExtractValue(data_content,'publicaciones/areaPRI') asc ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/yearQuarter') desc ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/idquarter') desc ";
                        
                    }
                    elseif($form["selectTypeCategory"]==8){
                        $order_by=" ORDER BY SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                        $order_by.=", ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                        $order_by.=", cast(ExtractValue(data_content,'publicaciones/nroBoletin') as UNSIGNED) desc ";
                        
                    }
                    
                }
                else{

                    if($form["tip_inf"]!=0){
                        if($form["tip_inf"]==7){
                            $order_by=" ORDER BY ";
                            $order_by.=" ExtractValue(data_content,'publicaciones/areaPRI') asc ";
                            $order_by.=", ExtractValue(data_content,'publicaciones/yearQuarter') desc ";
                            $order_by.=", ExtractValue(data_content,'publicaciones/idquarter') desc ";

                        }
                        elseif($form["tip_inf"]==8){
                            $order_by=" ORDER BY SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                            $order_by.=", ExtractValue(data_content,'publicaciones/year_pub') DESC ";
                            $order_by.=", cast(ExtractValue(data_content,'publicaciones/nroBoletin') as UNSIGNED) desc ";

                        }

                    }

                }

                
                
                $sql .= $order_by;                
/****************************************************************/                
		//$sql .=	" ORDER BY SUBSTR(ExtractValue(data_content,'publicaciones/date_pub'),1,4) DESC ";
                //$sql .=	" , ExtractValue(data_content,'publicaciones/year_pub') DESC ";
		//$sql .=	" , ExtractValue(data_content,'publicaciones/titulo')";
	
	
		if($currentPage<>'' and $pageSize<>''){
			$limitIni = ($currentPage-1)*$pageSize;
	        $limitLon = $pageSize;
			$sql .=	" LIMIT $limitIni,$limitLon";
		}
		
	
		$i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["iddata"][$i]= $row["iddata"];
	            $result["data_content"][$i]= $row["data_content"];
	            $result["idcategory"][$i]= $row["idcategory"];
	            $result["idsubcategory"][$i]= $row["idsubcategory"];
	
	            $i++;
	        }
	
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	


	
	
	function templateSQL($idsubcategory){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	    $sql = "SELECT * FROM subcategory WHERE idsubcategory=$idsubcategory and subcategory_enable=1";
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idsubcategory"][$i]= $row["idsubcategory"];
	            $result["subcategory_template"][$i]= $row["subcategory_template"];
	            $i++;
	        }
	
	        if(isset($result["idsubcategory"])){
	            $result["Count"]=count($result["idsubcategory"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	
	function permissionSQL($iddata){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	    $sql = "SELECT * FROM data WHERE iddata=$iddata";
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idsubcategory"][$i]= $row["idsubcategory"];
	            $result["data_content"][$i]= $row["data_content"];
	            $i++;
	        }
	
	        if(isset($result["idsubcategory"])){
	            $result["Count"]=count($result["idsubcategory"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	function downloadSQL($userName){
		
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	    $sql = "SELECT * FROM users WHERE users_name='$userName' and users_type='0'";
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idusers"][$i]= $row["idusers"];
	            $result["users_name"][$i]= $row["users_name"];
	            $result["users_password"][$i]= $row["users_password"];
	            $i++;
	        }
	
	        if(isset($result["idusers"])){
	            $result["Count"]=count($result["idusers"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	
	
	
	}
	

?>
