<?php

	require ('../class/ClassCombo.php');
	require ('../class/ClassForm.php');
	require ('../class/ClassPaginado.php');
        require ('../class/ClassPaginator.php');
	require ('../class/dbconnect.php');
	require ('../class/xajax_core/xajax.inc.php');
	$xajax=new xajax();
        //$xajax->configure("debug", true);
	$xajax->configure('javascript URI', '../class/');
 	date_default_timezone_set('America/Lima');

	require("adminIni.php");
	require("adminSearch.php");
	require("adminRegister.php");
	require("adminStatistics.php");
	require("indexSearch.php");

	//Ejecutamos el modelo
	require("adminModel.php");
        
	//include ("graficos/FusionCharts.php");
	//include("graficos/DBConn1.php");

	if(isset($_GET["idarea"])){
		$idarea=$_GET["idarea"];
	}
	else{
		$idarea=0;
	}


	session_start();


	/************************************************************
	Función que Verfica el Login
	************************************************************/
	function inicio(){
		$respuesta = new xajaxResponse();
                    /*
	            $iduser=$_SESSION["idusers"];
                    $respuesta->alert($iduser);
                    */
                $sessionidarea="";
		if(isset($_SESSION["admin"])){
		    if($_SESSION["admin"]!=""){
		    	if($_SESSION["idarea"]==8){
                            $idarea=$_SESSION["idarea"];
                            $respuesta->script("xajax_menuAAShow($idarea)");
		        }
                        /*
                        elseif($_SESSION["idarea"]==12){
                                $respuesta->script("xajax_menuGSShow($idarea)");
                        }
                        */
                        else{
                            $sessionidarea=$_SESSION["idarea"];
		            $cadena="xajax_menuShow($sessionidarea);";
                            $respuesta->script($cadena);               
                        }
                        
                        /*muestra el enlace del formulario modal*/        
                        $respuesta->script("xajax_crea_form('cambiar');");
                        $enlace='<a id="new-clave" href="#" class="blanco" >Cambiar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                                
		    	$respuesta->assign("loginform", "style.display","none");
		    	$respuesta->assign("subcontent1", "style.display","block");
		    }
			else{
		    	$cadena="xajax_formLoginShow();";
		    	$respuesta->script($cadena);
                        
                        $respuesta->script("xajax_crea_form('recuperar');");
                        $enlace='<a id="recuparar-clave" href="#" class="blanco" >Recuperar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                        
		    	$respuesta->assign("subcontent1", "style.display","none");
		    	$respuesta->assign("loginform", "style.display","block");                
                        
                        
                        $html='<table><tr><td style="text-align: center;">';
                        $html.='<img src="img/login.jpg" />';
                        $html.='</td></tr></table>';
                        
                        $respuesta->assign("imghome", "innerHTML", $html);
                        
			}   
		}
		else{
			$cadena="xajax_formLoginShow();";
                        
                        $respuesta->script("xajax_crea_form('recuperar');");
                        $enlace='<a id="recuparar-clave" href="#" class="blanco" >Recuperar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                        
            $respuesta->script($cadena);
            $respuesta->assign("subcontent1", "style.display","none");
            $respuesta->assign("loginform", "style.display","block");                
            

            
		}   
		return $respuesta;
	}	
	
	
	function formLoginShow(){
	    $respuesta = new xajaxResponse();
                /*
		$form= '<form onsubmit="xajax_verificaUsuarioShow(xajax.getFormValues(formLogin)); return false;" id="formLogin" method="post">	  	
		            <div style="font-size:14px; padding: 15px 0 15px 0;">
		            <span class="txt-rojo">Iniciar sesión</span>
		            </div>
		        	<div class="campo-login">Usuario:</div>
		        	<div class="contenedor-caja-login">
		        		<input name="usuario" id="usuario" class="caja-login" type="text"/>
		        	</div>
		            <div style="clear:both"></div>
		            
		            <div class="campo-login">Contraseña:</div>
		            <div class="contenedor-caja-login">
		            	<input name="clave" id="clave" class="caja-login" type="password"/>
		            </div>
		            <div style="clear:both"></div>
		
		            <div style="float:left">
		            	<input name="Iniciar" value="Iniciar" type="submit"/>
		            </div>
		            <div style="clear:both"><p></p></div>
		            <div id="error"></div>
					<div id="mensaje"></div>
               	</form>';
	    */
            $form= '
                <form onsubmit="xajax_verificaUsuarioShow(xajax.getFormValues(formLogin)); return false;" id="formLogin" method="post">                    
                    <span>Usuario:</span>
                    <span><input type="text" id="usuario" name="usuario" class="caja-login"></span>
                    <span class="campo-login">Contraseña:</span>
                    <span><input type="password" id="clave" name="clave" class="caja-login"></span>
                    <span><input type="submit" return false;" name="Login" value="Login"></span>
                    <span>&nbsp;</span>
                    <span id="error"></span>
                </form>                
                ';
                
	    
	    $respuesta->Assign("divformlogin","innerHTML",$form);
	    return $respuesta;
	}

	
	/************************************************************
	Función que Cierra la Sesión
	************************************************************/
	function cerrarSesion(){
		$respuesta = new xajaxResponse();
		$_SESSION["admin"]="";
		$respuesta->redirect("admin.php", 0);	
		$respuesta->Assign("subcontent1","style.display","none");
	    return $respuesta;
	}

	function checkDataForm($form){
	        
	    $check["Error"]=0;
	    if($form["author_name"]==""){
	        $check["Msg"]="Ingrese Nombre";
	        $check["Error"]=1;
	    }
	
	    elseif($form["author_surname"]==""){
	        $check["Msg"]="Ingrese Apellido";
	        $check["Error"]=1;
	    }
	    return $check;
	}

	function verificaUsuarioShow($form_entrada){
        $respuesta = new xajaxResponse();

        //$usuario=$form_entrada["usuario"];
        //$clave=$form_entrada["clave"];

        $result = verificaUsuarioSQL($form_entrada);

        $NroRegistros=$result["Count"];
        switch($NroRegistros){
            case 0:
                $divError="error";
                $respuesta->Assign("error","style.display","block");
				$respuesta->Assign("error","style.color","red");
                $respuesta->assign("error", "innerHTML","Usuario y/o clave incorrectos");
            break;
			case 1:
                                $idusers=$result["idusers"];
				$users_name=$result["users_name"];
				$area_description=$result["area_description"];
				$users_type=$result["users_type"];
				session_unset();
				session_destroy();
				session_start();
                                $_SESSION["idusers"]=$idusers;
				$_SESSION["users_type"]=$users_type;
				$_SESSION["idfrom"]=2;
				$_SESSION["admin"]=$users_name;
				$_SESSION["authorPRI"] = array();
				$_SESSION["authorSEC"] = array();
                        
				if($_SESSION["idusers"]==8){
					$respuesta->script("xajax_menuAAShow($idarea)");
				}/*
                                elseif($_SESSION["idarea"]==12){
					$respuesta->script("xajax_menuGSShow($idarea)");
				}
                                */
				else{
					$respuesta->script("xajax_menuShow()");
				}
                                
                                
                                //$respuesta->alert(print_r($_SESSION, true));
                                
                                //$respuesta->script("xajax_crea_form();");
                                $respuesta->script("xajax_inicio();");
                                $enlace='<a id="new-clave" href="#" class="blanco" >Cambiar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                                $respuesta->assign("menu_d", "innerHTML","$enlace");
                                
				//$respuesta->script("xajax_muestraFormGrafico()");
				$respuesta->Assign("subcontent1","style.display","block");
				//$respuesta->Assign("loginform","style.display","none");
                                $respuesta->Assign("divformlogin","innerHTML","&nbsp");
                                $respuesta->Assign("permiso","style.display","none");
                                $respuesta->Assign("ingreso","style.display","block");
                                
            break;
        }
        
        return $respuesta;
    }


    function recuperarClaveResult($user,$correo){
        
        $result=recuperarClaveSQL($user,$correo);
        
        return $result;
    }
	
    function recuperarClave($user,$correo){
        $respuesta = new xajaxResponse();
        
        $result=recuperarClaveResult($user,$correo);
        $count=$result["Count"];
        
        if($count>0){

                $iduser=$result["idusers"];
                $user=$result["users_name"];
                $correo=$result["users_email"];
                      
                $random=rand();
                $clave_temp=$random;
                                        
                $respuesta->script('xajax_sendemail("'.$iduser.'","'.$user.'","'.$correo.'","'.$clave_temp.'")');
        }
        else{
                $respuesta->alert($result['Msg']);
        }
        //$respuesta->alert($result["Query_select"]);
        //$respuesta->alert($result["Query_update"]);
        //$respuesta->alert($result["Count"]);
        
        return $respuesta;
    }

    function claveTempResult($iduser,$users,$correo,$clave_temp){
        
        $result=cambiarTempClaveSQL($iduser,$users,$correo,$clave_temp);
        
        return $result;
        
    }
    
    function sendemail($iduser="",$user="",$correo="",$clave_temp=""){
        $respuesta = new xajaxResponse();
    
        /*Cambiar la clave por una temporal*/
        $resultTemp=claveTempResult($iduser,$users,$correo,$clave_temp);
        //$respuesta->alert($resultTemp["Query_update"]);
        
                        
                        $connection = @ssh2_connect('mailer.igp.gob.pe', 22);
                        ssh2_auth_password($connection, 'telematica', 'telematica');
                        
                        /*lo envia al span
                        $connection = @ssh2_connect('geo.igp.gob.pe', 22);
                        ssh2_auth_password($connection, 'sismo_responde', 'tavera');
                        */

                        $random=rand();
                        
                        
		if (!$connection){
			$sendEmail["error"]= 1;
			$sendEmail["msg"]= "No se pudo conectar al servidor de correos";
		}
		else{
                        
			$message=  "                                                    
			<h1 style='color:#0D648C;'>INSTITUTO GEOF&Iacute;SICO DEL PER&Uacute;</h1>
		 	<h2>&Aacute;REA DE TELEM&Aacute;TICA</h2>
			<h3>Módulo de Informaci&oacute;n Cient&iacute;fica T&eacute;cnica</h3>
			
			<b>USUARIO</b>
                        <br>
			--------------------------------------------
			<br><br>
			<b>Usuario</b>   : <span style='color:#0D648C;'>".$user."</span><br>
			<b>Correo</b>   : ".$correo."<br>
			<b>Clave</b> : ".$clave_temp."<br>
			
			";
                        
                        $gestor = fopen("tmp/mensaje$random.html", "w");
			fwrite($gestor, utf8_decode($message));
			fclose($gestor);			
                        ssh2_scp_send($connection, "tmp/mensaje$random.html", "mensaje$random.html", 0666);

                        $bash='
                        #!/bin/bash
                        subject="Renovación de contraseña Módulo ITS"
                        #cat mensaje.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" eddy.lecca3@gmail.com
                        #Linea de codigo usada actualmente
                        #cat mensaje'.$random.'.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" eddy.lecca3@gmail.com
                            
                        cat mensaje'.$random.'.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" '.$correo.'
                            
                        ';
                        
                        $gestor = fopen("tmp/mail$random.sh", "w");
			fwrite($gestor, utf8_decode($bash));
			fclose($gestor);			
                        ssh2_scp_send($connection, "tmp/mail$random.sh", "mail$random.sh", 0755);
                        
                        //Ejecutamos el archivo sh creado
                        ssh2_exec($connection, "./mail$random.sh");
                        
                        //Borrar el archivo sh Remotamente y Localmente
                        //ssh2_exec($connection, "rm mail$random.sh");
                        //exec("rm tmp/mail$random.sh");
                        
                        //Borrar el archivo html Remotamente y Localmente
                        //ssh2_exec($connection, "rm mensaje$random.html");
                        //exec("rm tmp/mensaje$random.html");
                        
                        
                        $sendEmail["error"]= 0;
			$sendEmail["msg"]= "Se envió el correo";
                        //$sendEmail["msg"]= "Consulta enviada correctamente";
                        
                }
                
                $respuesta->alert($sendEmail["msg"]);
                
      return $respuesta;
        
    }
    
    function cambiarClaveResult($clave_old,$clave_new,$correo,$idusers){
        
        $result=cambiarClaveSQL($clave_old,$clave_new,$correo,$idusers);
        
        return $result;
    }
	
    function cambiarClave($clave_old,$clave_new,$correo,$idusers){
        $respuesta = new xajaxResponse();
        
        //$respuesta->alert($idusers);
        /*
        
        $respuesta->alert($clave_old);
        $respuesta->alert($clave_new);
        */
        
        $result=cambiarClaveResult($clave_old,$clave_new,$correo,$idusers);
        
        $respuesta->alert($result["Msg"]);
        //$respuesta->alert($result["Query_update"]);
        //$respuesta->alert($result["Count"]);
        
        return $respuesta;
    }
	
	function displaydiv($div,$idtitle) {
	    $objResponse = new xajaxResponse();
	    $array=array("titulo_resumen","titulo_tipo_prepor","author","evento","lugarPais","referencia","tipoTesis_pais_universidad","area_tema","fecha_estado_permisos","archivo","region_departamento","titulo","nro_magnitud","fecha_permisos","year_quarter","areas","compendio","titulo_presentado","areasAdministrativas","institucion_externa");
		$titulos=array("titulo1","titulo2","titulo3","titulo4","titulo5","titulo6","titulo7");
		foreach ($array as $elemento){
			if($elemento==$div){
				$objResponse->assign($elemento,"style.display","block");
				foreach ($titulos as $nombre_titulos){
					if($nombre_titulos==$idtitle){
						$objResponse->script("
							$('body .tab').removeClass('tabactive');
							$('body #".$idtitle."').addClass('tabactive');

							");
						
					}
					else{
						// $objResponse->assign($nombre_titulos,"style.background","#FFFFFF");
						// $objResponse->assign($nombre_titulos,"style.border","none");
	                                        
					}
	                                
				}
	                        
			}
			else{
				$objResponse->assign($elemento,"style.display","none");
			}
	                
		}
	
		$subcategory=$_SESSION["subcategory"];
		switch($subcategory){
	    case "charlas_internas":
			if($div=="areas"){
				$objResponse->assign("areasAdministrativas","style.display","block");
				$objResponse->assign("institucion_externa","style.display","block");
			}
		break;
	
		}
	
	
	
		//    $objResponse->alert(print_r($array, true));
	
	    return $objResponse;
	}

	/******************************************
	Función que muestra un Menú en el Template
	*******************************************
	function menuShow($sessionidarea=0){
		$respuesta= new xajaxResponse();
		//if (isset($_SESSION["admin"]))
		$result=categoryResult($sessionidarea);
		$count=$result["Count"];
		$menu="<div><h3  class='txt-rojo'>Nuevo Ingreso:</h3></div>";

		for($i=0;$i<$count;$i++){
			$desc = ucfirst($result["category_description"][$i]);
			$id = $result["idcategory"][$i];
			$idfrom=isset($_SESSION["idfrom"])?$_SESSION["idfrom"]:0;
			$idarea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:0;
	        $menu.="<div class='submenu'>»<a href='#' class='negro' onClick='xajax_formCategoryShow($id); return false'>$desc</a></div>";
		}
		

		
	    $menu.="<div><h3 class='txt-rojo'>Consultas :</h3>
                    <div class='submenu'>»<a class='negro' href='#'  onclick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); xajax_auxSearchShow(20,1,xajax.getFormValues(\"formSearch\"),\"\",\"0\");'>B&uacute;squeda y Edici&oacute;n</a></div>
                    <div class='submenu'>»<a id='botonshow' class='negro' href='#'  >Estad&iacute;sticas   </a></div>
	            <div class='left-box'><h3 class='txt-rojo'>Salir :</h3></div>
	            <div class='submenu'>»<a href='#' class='negro' onClick='xajax_cerrarSesion(); return false'>Cerrar sesi&oacute;n</a></div>";
		$respuesta->assign("menuLateral", "innerHTML", $menu);
				
		return $respuesta;
	}
	
        
        
	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	function menuShow(){
		$respuesta= new xajaxResponse();
                

                $menu="";
                if($_SESSION["admin"]=="admin"){
                    
                    /*Menú de la nueva plantilla 2012*/
                    switch($_SESSION["users_type"]){
                        case 0: //el segundo parametro es el currentpage al ser cero utiliza el valor del formulario
                            $menu.='<li><a href="#" onclick="xajax_formCategoryShow(2); return false"><img width="12px;" style="vertical-align:middle;" src="img/iconos/salir_16.png" /> Nuevo Libro</a></li>';
                            $menu.="<li><a href='#' onclick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); xajax_auxSearchShow(20,1,xajax.getFormValues(\"formSearch\"),\"\",\"0\");'><img width='12px;' style='vertical-align:middle;' src='img/iconos/search_16.png' /> Consultas</a></li>";
                        //$menu.='<li><a href="index.php" ><img width="12px;" style="vertical-align:middle;" src="img/iconos/home.png" /> Inicio</a></li>';
                        //$menu.='<li><a href="#" onClick="xajax_formDocumentosShow(); return false;"><img width="12px;" style="vertical-align:middle;" src="img/iconos/agregar_16.png" /> Nuevo personal</a></li>';
                        //$menu.='<li><a href="#" onClick="xajax_auxSearchShow(12,0,xajax.getFormValues(\'formSearch\')); return false;"><img width="12px;" style="vertical-align:middle;" src="img/iconos/home.png" /> Inicio</a></li>';
                        //$menu.='<li><a href="#" onClick="xajax_inicio(); return false;"><img width="12px;" style="vertical-align:middle;" src="img/iconos/home.png" /> Inicio</a></li>';
                            
                    }

                    if($_SESSION["users_type"]==0){
                        //$menu.='<li><a href="#" onClick="xajax_formUsuarioShow(); return false;" ><img style="vertical-align:middle;" src="img/iconos/candado_llave_16.png" />Nuevo Usuario</a></li>';
                    }
                    
                                
                    //$menu.='<li><a href="#" onclick="xajax_registerTemp(\'\',\'temp\');"><img style="vertical-align:middle;" src="img/iconos/pdf_16.png" /> Generar PDF</a></li>';
                    //$menu.='<li><span id="enlace_cv"></span></li>';
                    
                    
                    $menu.='<li style="float:right"><a href="#" onclick="xajax_cerrarSesion(); return false"><img width="12px;" style="vertical-align:middle;" src="img/iconos/salir_16.png" /> Cerrar Sesión</a></li>';
                    
                    //$menu.='<li><a>Tu sesión finalizará en:</a></li>';
                    //$menu.='<li><a id="expira_sesion">4:30</a></li>';
                    
                    $respuesta->assign("divformlogin", "style.display", "none");
                    $html='<table><tr><td style="text-align: center;">';
                    $html.='<img src="img/biblioteca.png" />';
                    $html.='</td></tr></table>';
                    
                    $respuesta->assign("imghome", "innerHTML", $html);
                }  
                              
		$respuesta->assign("menu", "innerHTML", $menu);
                
		
		$respuesta->script('
                    $(function(){

                        $("ul.dropdown li").hover(function(){

                            $(this).addClass("hover");
                            $("ul:first",this).css("visibility", "visible");

                        }, function(){

                            $(this).removeClass("hover");
                            $("ul:first",this).css("visibility", "hidden");

                        });


                        $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");

                    });
                    
                ');
		return $respuesta;
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function subcategoryResult($category=0,$idarea=0){
		$resultSql= searchSubCategorySQL($category,"","",$idarea);
		return $resultSql;
	}
	
	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	function menuAAShow($idarea=0){
		$respuesta= new xajaxResponse();
	
		$result=subcategoryResult(3,$idarea);
		$count=$result["Count"];
	       
		$menu="<div><h3  class='txt-rojo'>Nuevo Ingreso:</h3></div>";

		for($i=0;$i<$count;$i++){
			$desc = ucfirst($result["subcategory_description"][$i]);
			$id = $result["idsubcategory"][$i];
			//$idfrom=$_SESSION["idfrom"];
                        $idfrom=isset($_SESSION["idfrom"])?$_SESSION["idfrom"]:0;
			$idarea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:0;
	        $menu.="<div class='submenu'>»<a href='#' class='negro' onClick='xajax_formCategoryShow(3,$id); return false'>$desc</a></div>";
		}
	       
                $menu.="<div><h3 class='txt-rojo'>Consultas :</h3>
                        <div class='submenu'>»<a class='negro' href='#'  onClick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); return false'>B&uacute;squeda</a></div>
                        <div class='submenu'>»<a id='botonshow' class='negro' href='#'  >Estad&iacute;sticas   </a></div>
                        <div class='left-box'><h3 class='txt-rojo'>Salir :</h3></div>
                        <div class='submenu'>»<a href='#' class='negro' onClick='xajax_cerrarSesion(); return false'>Cerrar sesi&oacute;n</a></div>";
		$respuesta->assign("menuLateral", "innerHTML", $menu);
	       
		$respuesta->assign("menuLateral", "innerHTML", $menu);
		return $respuesta;
	}

	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	function menuGSShow($idarea=0){
		$respuesta= new xajaxResponse();
	
		$result=subcategoryResult(5,$idarea);
		$count=$result["Count"];
	       
		$menu="<div><h3  class='txt-rojo'>Nuevo Ingreso:</h3></div>";

		for($i=0;$i<$count;$i++){
			$desc = ucfirst($result["subcategory_description"][$i]);
			$id = $result["idsubcategory"][$i];
			//$idfrom=$_SESSION["idfrom"];
                        $idfrom=isset($_SESSION["idfrom"])?$_SESSION["idfrom"]:0;
			$idarea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:0;
	        $menu.="<div class='submenu'>»<a href='#' class='negro' onClick='xajax_formCategoryShow(5,$id); return false'>$desc</a></div>";
		}
	       
                $menu.="<div><h3 class='txt-rojo'>Consultas :</h3>
                        <div class='submenu'>»<a class='negro' href='#'  onClick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); return false'>B&uacute;squeda</a></div>
                        <div class='submenu'>»<a id='botonshow' class='negro' href='#'  >Estad&iacute;sticas   </a></div>
                        <div class='left-box'><h3 class='txt-rojo'>Salir :</h3></div>
                        <div class='submenu'>»<a href='#' class='negro' onClick='xajax_cerrarSesion(); return false'>Cerrar sesi&oacute;n</a></div>";
		$respuesta->assign("menuLateral", "innerHTML", $menu);
	       
		$respuesta->assign("menuLateral", "innerHTML", $menu);
		return $respuesta;
	}
        
	function formCategoryShow($idcategory,$idSubcategory=0){
	    $respuesta = new xajaxResponse();
		if(isset($_SESSION["editar"])){
			if($_SESSION["editar"]==1){
				unset($_SESSION["edit"]);
				unset($_SESSION["editar"]);
			}
		}
	        
                $respuesta->Assign("consultas","style.display","none");
		$respuesta->Assign("paginator","style.display","none");        
                
                
		switch($idcategory){
		    case 1:
		        $respuesta->script("xajax_formPublicacionShow($idSubcategory)");
		    break;
		    case 2:
		        $_SESSION["tipoDocumento"]="ponencia";
		        $_SESSION["subcategory"]="ponencia";
		
		        $respuesta->script("xajax_formPonenciasShow()");
		    break;
		    case 3:
		        $respuesta->script("xajax_formAsuntosAcademicosShow(0,$idSubcategory)");
		    break;
		    case 4:
		        $respuesta->script("xajax_formInformacionInternaShow(0,7)");
		    break;
		    case 5:
		        $respuesta->script("xajax_formGeoSocShow(0,$idSubcategory)");
		    break;
                
		}
                
                //$respuesta->alert(print_r($_SESSION, true));
	
		return $respuesta;
	}
	
	function formPublicacionShow($iddata=0,$idSubcategory=0,$currentPage){
	
		$objResponse = new xajaxResponse();
		//Borramos las variables de sesion
		
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		    unset($_SESSION["publicaciones"]);
		}
		
		$link="";
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
                        $estilo="display:block";
                        $boton='<span><input class="button" type="button" onclick="xajax_newPublication('.$iddata.',\''.$action.'\',xajax.getFormValues(\'subcategory\'),'.$currentPage.');" value='.$tituloBoton.' /></span>';
                        $tituloGeneral = "Editar publicación";												
		    }
		}
		else{
			$action="INS";
			$tituloBoton="GUARDAR";
			$estilo="display:none";
			$boton="";
			$linkRegresar="";
			$tituloGeneral="Tipo de Material";
			
		}
	
	
		
		
		$html='<h2 class="txt-azul">'.$tituloGeneral.'</h2>
			<div class="contactform">
				<form id="subcategory">
				<p>
				<span id="registerTypePublication"></span>
				<span id="botonRegresar"></span>
				</p>
				</form>
			</div>
			<div style="padding-top:20px;">
	            <span class="tab" id="titulo1"></span>
	            <span class="tab" id="titulo2"></span>
	            <span class="tab" id="titulo3"></span>
	            <span class="tab" id="titulo4"></span>
	            <span class="tab" id="titulo5"></span>
	            <span class="tab" id="titulo6"></span>
	            <span class="tab" id="titulo7"></span>
			</div>
	
	        <div id="idcontactform" class="listado-busqueda" style="'.$estilo.'">

	            <div  id="titulo_resumen"></div><div id="titulo"></div>
	
	            <div id="author" style="display:none">
			        <div id="search_authorPRI"></div>
			        <div class="linea-separacion"></div>
			        <div id="newFormAuthor"></div>
	            </div>
	
	            <div id="referencia" style="display:none"></div>
	        
	            <div id="tipoTesis_pais_universidad" style="display:none"></div>
	
	            <div id="areas" style="display:none">
	                <h1 id="titAreas"></h1>
	                <div id="cont_areas"></div>
	            </div>
	
	            <div id="area_tema" style="display:none">
	                <div class="txt-azul" id="titArea"></div>
	                <div id="area_propietaria"></div>
					<div  class="linea-separacion"></div>	                    

					<div class="txt-azul" id="titOtrasAreas"></div>
	                <div id="otrasAreas"></div>
					
						                
	                <div class="txt-azul" id="titOtrosTemas"></div>
	                <div id="otrosTemas"></div>
					<div  class="linea-separacion"></div>
						                
	                <div class="txt-azul" id="titNuevoTema"></div>
	                <div id="nuevo_tema_publicacion"></div>
	            </div>
	
	
	            <div id="fecha_estado_permisos" style="display:none">
	                <h1 id="titEstado"></h1>
	                <div id="estado"></div>
	                <div class="linea-separacion"></div>
	                
	                <div class="txt-azul" id="titFechas"></div>
	                <div id="fechas"></div>
	                <div class="linea-separacion"></div>
	                
	                <div class="txt-azul" id="titPermisos"></div>
	                <div id="permisos"></div>
	            </div>
	
	            <div id="fecha_permisos" style="display:none">
	                <div class="txt-azul" id="titFechasTesis"></div>
	                <div id="fechasTesis"></div>
	                <div class="linea-separacion"></div>
	                <div class="txt-azul" id="titPermisosTesis"></div>
	                <div id="permisosTesis"></div>
	            </div>
	
	            <div id="archivo" style="display:none"></div>
		</div>
		<div id="botonGuardarEditar"><p>'.$boton.'</p></div>';

	    $objResponse->script("xajax_comboTypeSubcategoryShow($idSubcategory,1)");
            
	    $objResponse->Assign("formulario","style.display","block");
	    $objResponse->Assign("formulario","innerHTML",$html);
	    $objResponse->Assign("resultSearch","style.display","none");
	    $objResponse->Assign("estadisticas", "style.display", "none");        

                if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
                                $objResponse->script("xajax_formSubcategoryShow($idSubcategory)");
                                
				$linkRegresar='<span style="float:right;"><a class="negro" href=# id="boton_actualizar"onclick="xajax_abstractHide(\'formulario\'); xajax_abstractShow(\'consultas\'); xajax_abstractShow(\'resultSearch\'); xajax_abstractShow(\'paginator\');"><img style="cursor: pointer; border:0;" width="20px" src="img/flecha-izq.jpg">&nbsp;&nbsp; Retornar a resultados </a></span>';
				$objResponse->assign("botonRegresar","innerHTML",$linkRegresar);
                                
                                
		    }
		}
		

	    //$objResponse->alert(print_r($_SESSION["edit"], true));
		return $objResponse;
	}
	
	function formPonenciasShow($iddata=0,$idSubcategory=0){
		$objResponse = new xajaxResponse();
		

		//Borramos las variables de sesion
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		    unset($_SESSION["publicaciones"]);
		}
		
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
		        $tituloGeneral="Editar ponencia";
				//$linkRegresar='<span style="float:right;"><a class="negro" href=# onclick="xajax_abstractHide(\'formulario\'); xajax_abstractShow(\'consultas\'); xajax_abstractShow(\'resultSearch\'); xajax_abstractShow(\'paginator\'); return false;"><img style="cursor: pointer; border:0;" width="20px" src="img/flecha-izq.jpg">&nbsp;&nbsp; Retornar a resultados </a></span>';
				//$objResponse->assign("botonRegresar","innerHTML",$linkRegresar);
		    }
		}
		else{
			$action="INS";
                        $tituloBoton="GUARDAR";
                        $tituloGeneral="Ingresar Nuevo Libro";
		}
                
                $objResponse->script("xajax_registerDateIng()");

	    $tipoDocumento="ponencias";
	
	    $_SESSION["tipoDocumento"]="ponencias";
	    $_SESSION["subcategory"]="ponencia";
            $_SESSION["idtypedocument"]=2;
            $_SESSION["idsubcategory"]=0;
	
	    $html='<h2 class="txt-azul">'.$tituloGeneral.'</h2>
	    		<span id="botonRegresar"></span>

				<div style="padding-top:20px;">
		            <span class="tab" id="titulo1"></span>
		            <span class="tab" id="titulo2"></span> 
		            
		            <span class="tab" id="titulo5"></span>
		            <span class="tab" id="titulo6"></span>
		            <span class="tab" id="titulo7"></span>
				</div>
	
	            <div id="idcontactform" class="listado-busqueda">
	                
	                <div  id="titulo_tipo_prepor"></div>
	        
		            <div id="author" style="display:none;">
				        <div id="search_authorPRI"></div>
				        <div class="linea-separacion"></div>
				        <div id="newFormAuthor"></div>
		            </div>
	
	                <div id="referencia" style="display:none"></div>
	
	                
	
	                
	
	            <div id="area_tema" style="display:none">
	                <div class="txt-azul" id="titArea"></div>
	                <div id="area_propietaria"></div>
					<div  class="linea-separacion"></div>	                    

					<div class="txt-azul" id="titOtrasAreas"></div>
	                <div id="otrasAreas"></div>
					<div  class="linea-separacion"></div>
						                
	                <div class="txt-azul" id="titOtrosTemas"></div>
	                <div id="otrosTemas"></div>
					<div  class="linea-separacion"></div>
						                
	                <div class="txt-azul" id="titNuevoTema"></div>
	                <div id="nuevo_tema_publicacion"></div>
	            </div>
	
					<div id="fecha_permisos" style="display:none">
						<div class="txt-azul" id="titFechasTesis"></div>
						<div id="fechasTesis"></div>
						<div  class="linea-separacion"></div>					
						<div class="txt-azul" id="titPermisosTesis"></div>
						<div id="permisosTesis"></div>
					</div>
				<div id="archivo" style="display:none"></div>
			</div>
            <div><p><input class="button" type="button" onclick="xajax_newPonencia('.$iddata.',\''.$action.'\');" value='.$tituloBoton.' /></p></div>
			';

    	//###############################################################
		//PRIMERO COLOCAMOS EL FORMULARIO QUE CONTIENE LAS DEMAS CAPAS
	    $objResponse->assign("formulario","innerHTML","$html");	    
	    
		// Muestra los tabs por default
	    $objResponse->script("xajax_displaydiv('titulo_tipo_prepor','titulo1')");

	    
	    

	    $titulo="T&iacute;tulo / Tipo";
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }
	
        // if(isset($recuperar["titulo"])){
        //     $tit=$recuperar["titulo"];
        // }
        // else{
        //     $tit="";
        // }
	
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
            $prePorApellido="''";
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

		//$urljs = 'js/json/book.json';
		//$urlJson = curl_init($urljs);
		//Agregamos opciones necesarias para leer
		//curl_setopt($urlJson,CURLOPT_RETURNTRANSFER, TRUE);
		// Capturamos la URL
		//$dataJson = curl_exec($urlJson);

		//$jsonbook = '{"1": [{"nombre" : "Juanita Sierra", "edad": 25, "estudios" : "Preparatoria", "caracter": "Linda y atenta"}],"2": "Mapas","3": "Otros"}';
		
		//$abook = json_decode($urljs,true);
		$formatBook ="<select>
						<option></option>
						<option value=1>Libro</option>
						<option value=2>mapas</option>
						<option value=3>otros</option>

					</select>";
        
        
		$html="
       	<div class='clear'></div>  

       	
       	<input type='hidden' value='tipoPonencia_description' id='tipoPonencia_txt' name='tipoPonencia_txt' class='field'>
		<div style='clear:both'></div>
		<div class='campo-buscador'>Título:&nbsp;</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' placeholder='Ingrese titulo aqui' onchange='xajax_registerTitulo(this.value); return false;' value='$tit' id='title' name='title' class='caja-buscador-1' /><div id='titulo_error'></div></div>
                
		<div class='clear'></div>

		<div class='campo-buscador' id='tit_tipoPonencia'>Formato</div>
       	<div class='contenedor-combo-buscador-1' id='tipoPonencia'>$formatBook</div>
       	<div class='clear'></div>
		<div class='campo-buscador'>Codigo ISBN:&nbsp;</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' placeholder='ej. 0385342586' onchange='xajax_registerISBN(this.value); return false;' value='$ISBN' id='ISBN' name='ISBN' class='caja-buscador-1' /><div id='titulo_error'></div></div>
                
		<div class='clear'></div>

		<div class='campo-buscador'>CALL NUMBER</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text'  placeholder='Ingrese CallNumber(codigo de ubicación) aqui' onchange='xajax_registerCallNumber(this.value); return false;' value='$CallNumber' id='CallNumber' name='CallNumber' class='caja-buscador-1' /><div id='call-back-error'></div></div>
                
		<div class='clear'></div>

		<div class='campo-buscador'>Publicación</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' placeholder='ej. Lima,2002 ' onchange='xajax_registerPublication(this.value); return false;' value='$publication' id='publication' name='publication' class='caja-buscador-1' /><div id='publication-error'></div></div>                
		<div class='clear'></div>

		<div class='campo-buscador'>Edición</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' placeholder='ej. 1ra ed' value='$edition' onchange='xajax_registerEdition(this.value); return false;' id='edition' name='edition' class='caja-buscador-1' /><div id='edition-error'></div></div>                
		<div class='clear'></div>

		<div class='campo-buscador'>Temas</div>
       	<div class='contenedor-caja-buscador-1'>
       	<input type='text' placeholder='ej. tema1, tema2' onchange='xajax_registerSubject(this.value); return false;' value='$subject' id='subject' name='publication' class='caja-buscador-1' /><div id='description-error'></div></div>                
		<div class='clear'></div>	

		<div class='campo-buscador'>Descripción</div>
       	<div class='contenedor-caja-buscador-1'>
       	<textarea placeholder='ej. escriba aqui su descripcion' onchange='xajax_registerDescription(this.value); return false;' value='$description' id='description' name='description' class='caja-buscador-1' ></textarea><div id='description-error'></div></div>                
		<div class='clear'></div>	
		
       		
       	";
       	
	    $objResponse->Assign("titulo_tipo_prepor","innerHTML",$html);
		$objResponse->Assign('titulo1',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_tipo_prepor','titulo1'); return false;\">$titulo</a>");
	    
	    
	    
    	//###############################################################
		//PARA EL AUTOR
	    //$objResponse->script("xajax_iniAuthorShow('titulo2')");

    	$objResponse->assign("titulo2","innerHTML","<a href=# onclick=\"xajax_displaydiv('author','titulo2'); return false;\">Autor</a>");
    	$objResponse->script("xajax_searchAuthorSesionPriShow()");
    	$objResponse->script("xajax_searchAuthorSesionSecShow()");

    	
    	$objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
        $objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    
	    
    	
	
    	//###############################################################    		
	    //$objResponse->script("xajax_iniAreaTheme('titulo5')");
	    // AREA Y TEMA
		$link="<a onclick=\"xajax_displaydiv('area_tema','titulo5'); return false;\" href='#'>&Aacute;rea y Tema</a>";
		$objResponse->assign('titulo5',"innerHTML",$link);
	
	        //Temas del area 
	    $objResponse->script("xajax_iniAreaShow('".$_SESSION["idarea"]."')");
	
	        //Asociar a otras areas
	    $objResponse->script("xajax_iniOtrasAreasShow('".$_SESSION["idarea"]."')");
	
	        //Asociar a otros temas
		$range=readSessionArea();
		$objResponse->script("xajax_otrosTemasShow('$range')");
	
	        //Asociar a otros temas
		$objResponse->script("xajax_iniOtrosTemasShow()");
	
	        //Ingresar nuevo tema
		$objResponse->script("xajax_newThemeShow()");	    
	    
    	
		//###############################################################    		
                $objResponse->script("xajax_iniDatePermission('titulo6')");
	    
		

		//###############################################################
		// ARCHIVO			
	    //$objResponse->script("xajax_iniArchivoShow('titulo7')");
	    //$htmlArchivo=iniArchivoShow();            
            //$objResponse->script("xajax_cargaScriptMostrarAutores()");

        list($htmlArchivo,$link)=iniArchivoShow();
        $objResponse->Assign('titulo7',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo7'); return false;\">Imagen</a>");
    	$objResponse->Assign("archivo","innerHTML",$htmlArchivo);
    	
                    if($link!=""){
                        $objResponse->Assign("formUpload","style.display","none");
                        // $objResponse->alert($link);
                    }
        
		$objResponse->Assign("formulario","style.display","block");
		$objResponse->Assign("resultSearch","style.display","none");

		$objResponse->Assign("estadisticas", "style.display", "none");
                $objResponse->script("xajax_cargaScriptDates()");
                
                if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
				$linkRegresar='<span style="float:right;"><a class="negro" href=# id="boton_actualizar"onclick="xajax_abstractHide(\'formulario\'); xajax_abstractShow(\'consultas\'); xajax_abstractShow(\'resultSearch\'); xajax_abstractShow(\'paginator\');"><img style="cursor: pointer; border:0;" width="20px" src="img/flecha-izq.jpg">&nbsp;&nbsp; Retornar a resultados </a></span>';
				$objResponse->assign("botonRegresar","innerHTML",$linkRegresar);
		    }
		}
                
                $objResponse->script('	$(document).ready(function() {
		$("input.file").si();});');
                
                
                $objResponse->script("xajax_carga_archivo()");
                
        // $objResponse->alert(print_r($_SESSION["temp"],TRUE));
        
                $objResponse->assign("imghome", "style.display", "none");
                
		return $objResponse;
	}
	
	
	function formInformacionInternaShow($iddata=0,$idSubcategory=0){
		$objResponse = new xajaxResponse();
		
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		    //unset($_SESSION["publicaciones"]);
		}
		
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
                        $estilo="display:block";
		        $tituloBoton="ACTUALIZAR";
		        $tituloGeneral="Editar información interna";
				$boton='<span><p><input class="button" type="button" onclick="xajax_newInformacionInterna('.$iddata.',\''.$action.'\',xajax.getFormValues(\'subcategory\'));" value='.$tituloBoton.' /></p></span>';
		    }
		}
		else{
                        $estilo="display:none";
		        $action="INS";
		        $tituloBoton="GUARDAR";
		        $tituloGeneral="Ingresar información interna";
		        $boton="";
		}
		
		
		$html='<h2 class="txt-azul">'.$tituloGeneral.'</h2>
	        <div>
	            <form id="subcategory">
	            <span id="registerTypeInfInt"></span>
                    <span id="botonRegresar"></span>
	            </form>
	        </div>
			<div style="padding-top:20px;">
	            <span class="tab" id="titulo1"></span>
	            <span class="tab" id="titulo2"></span>
	            <span class="tab" id="titulo3"></span>
	            <span class="tab" id="titulo4"></span>
	            <span class="tab" id="titulo5"></span>
	            <span class="tab" id="titulo6"></span>
	            <span class="tab" id="titulo7"></span>
			</div>
	
			<div id="idcontactform" class="listado-busqueda" style="'.$estilo.'">

	        	<div  id="titulo"></div>

	        	<div id="author" style="display:none;">
					<div  id="search_authorPRI"></div>
				    <div  class="linea-separacion"></div>
				    <div  id="newFormAuthor"></div>
				</div>	                
	
				<div id="referencia" style="display:none"></div>
	
	
		        <div id="areas" style="display:none">
		            <div class="txt-azul" id="titAreas"></div>
		            <div id="cont_areas"></div>
		            
		            <div class="txt-azul" id="titSubAreas"></div>
		            <div id="divSubAreas"></div>
		        </div>
	
		        <div id="fecha_permisos" style="display:none">
		            <div class="txt-azul" id="titFechasTesis"></div>
		            <div id="fechasTesis"></div>
		            <div class="linea-separacion"></div>
		            <div class="txt-azul" id="titPermisosTesis"></div>
		            <div id="permisosTesis"></div>
		        </div>
	
	        	<div id="region_departamento" style="display:none"></div>
		
	        	<div id="nro_magnitud" style="display:none"></div>
	
	        	<div id="year_quarter" style="display:none"></div>
	
	        	<div id="archivo" style="display:none"></div>
	        </div>
	        <div id="botonGuardarEditar">'.$boton.'</div>';
	
	    $objResponse->script("xajax_comboYearShowRegister(0,'divYearRegister')");
	
	    $cadena="xajax_comboRegionShow(0,1)";
	    $objResponse->script($cadena);
	
	    //$cadena="xajax_comboTypeSubcategoryShow($idSubcategory,4)";
	    $idarea=$_SESSION["idarea"];

	    
	    $objResponse->Assign("formulario","style.display","block");
	    $objResponse->Assign("formulario","innerHTML","$html");
	    $objResponse->Assign("resultSearch","style.display","none");
	    $objResponse->Assign("estadisticas", "style.display", "none");
            $objResponse->script("xajax_comboTypeSubcategoryShow($idSubcategory,4,$idarea)");            
	    
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
                                $objResponse->script("xajax_formSubcategoryShow($idSubcategory)");
                        
				$linkRegresar='<span style="float:right;"><a class="negro" href=# id="boton_actualizar"onclick="xajax_abstractHide(\'formulario\'); xajax_abstractShow(\'consultas\'); xajax_abstractShow(\'resultSearch\'); xajax_abstractShow(\'paginator\');"><img style="cursor: pointer; border:0;" width="20px" src="img/flecha-izq.jpg">&nbsp;&nbsp; Retornar a resultados </a></span>';
				$objResponse->assign("botonRegresar","innerHTML",$linkRegresar);
		    }
		}
            
		if(isset($_SESSION["idarea"])){
		    if($_SESSION["idarea"]==11 or $_SESSION["idarea"]==12 or $_SESSION["idarea"]==13 or $_SESSION["idarea"]==14){
                        $objResponse->script("xajax_formSubcategoryShow($idSubcategory)"); 
                    }
                }
                
                
                
		return $objResponse;
	}
	
	
	
	function formAsuntosAcademicosShow($iddata=0,$idSubcategory=0){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		}
	
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
		    }
		}
		else{
		        $action="INS";
		        $tituloBoton="GUARDAR";
		}
	
		$html='<h2 class="txt-azul">Asuntos Acad&eacute;micos</h2>
				<div style="padding-top:20px;">
		            <span class="tab" id="titulo1"></span>
		            <span class="tab" id="titulo2"></span>
		            <span class="tab" id="titulo3"></span>
		            <span class="tab" id="titulo4"></span>
		            <span class="tab" id="titulo5"></span>
		            <span class="tab" id="titulo6"></span>
		            <span class="tab" id="titulo7"></span>
				</div>
		
		        <div id="idcontactform" class="listado-busqueda" style="display:none">

					<div  id="titulo_presentado"></div>
		
		            <div id="author" style="display:none">
		                    <div  id="search_authorPRI"></div>
		                    <div  id="newFormAuthor"></div>
		            </div>
		
		            <div id="referencia" style="display:none"></div>
		
		            <div id="tipoTesis_pais_universidad" style="display:none">
		                <h1 id="titTipoTesis"></h1>
		                    <label id="labelTipoTesis"></label>
		                    <div id="registerTipoTesis"></div>
		                <h1 id="titPais"></h1>
		                    <div id="pais"></div>
		                <h1 id="titUniversidad"></h1>
		                    <div id="universidad"></div>
		            </div>

					<div style="float:left">
				        <div id="areas" style="display:none">
				            <p style="width:300px" class="txt-azul" id="titAreas"></p>
				            <div style="width:300px" id="cont_areas"></div>
				        </div>
				    
					</div>
					<div style="float:right">				        
				        <div id="areasAdministrativas" style="display:none">
				            <p style="width:300px" class="txt-azul" id="titAreasAdministrativas"></p>
				            <div style="width:300px" id="cont_areasAdministrativas"></div>
				        </div>
					</div>
					<div style="clear:both"></div>
					<div id="institucion_externa" style="display:none">
						<p class="txt-azul" id="tit_inst_ext"></p>
						<div id="cont_inst_ext"></div>
					</div>
					<div id="divform"></div>
		
		            <div id="fecha_permisos" style="display:none">
		                <div class="txt-azul" id="titFechasTesis">Fechas</div>
		                <div id="fechasTesis"></div>
						<div class="linea-separacion"></div>		                
		                <div class="txt-azul" id="titPermisosTesis"></div>
		                <div id="permisosTesis"></div>
		            </div>
					
		            <div id="region_departamento" style="display:none">
		                <h1 id="titRegion"></h1>
		                    <div id="registerRegionBoletines"></div>
		                    <div id="registerDepartamentoBoletines"></div>
		            </div>
		
		            <div id="compendio" style="display:none"></div>
                            
                            <div id="year_quarter" style="display:none"></div>
                            
		            <div id="archivo" style="display:none"></div>
			</div>		            
		    <div>
		            <form id="subcategory">
		                <input name="tipoPublicacion" id="tipoPublicacion" type="hidden" value='.$idSubcategory.'>
		                <p>
		                <span id="registerTypeAsuAca"></span>
		                <span><input class="button" type="button" onclick="xajax_newAsuntosAcademicos('.$iddata.',\''.$action.'\',xajax.getFormValues(\'subcategory\'));" value='.$tituloBoton.' /></span>
		                </p>
		            </form>
		    </div>';


	    $objResponse->Assign("formulario","style.display","block");
	    $objResponse->Assign("formulario","innerHTML","$html");
	    $objResponse->Assign("formSearch","style.display","none");
	    $objResponse->Assign("estadisticas", "style.display", "none");
	    $objResponse->script("xajax_comboRegionShow(0,1)");
            $objResponse->script("xajax_formSubcategoryShow($idSubcategory,1)");
            
                if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
                                $objResponse->script("xajax_formSubcategoryShow($idSubcategory)");
            
                    }
                }
	    
	    
		return $objResponse;
	}


	function formGeoSocShow($iddata=0,$idSubcategory=0){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		}
	
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
		    }
		}
		else{
		        $action="INS";
		        $tituloBoton="GUARDAR";
		}
	
		$html='<h2 class="txt-azul">Geofísica Y Sociedad</h2>
				<div style="padding-top:20px;">
		            <span class="tab" id="titulo1"></span>
		            <span class="tab" id="titulo2"></span>
		            <span class="tab" id="titulo3"></span>
		            <span class="tab" id="titulo4"></span>
		            <span class="tab" id="titulo5"></span>
		            <span class="tab" id="titulo6"></span>
		            <span class="tab" id="titulo7"></span>
				</div>
		
		        <div id="idcontactform" class="listado-busqueda" style="display:none">

					<div  id="titulo_presentado"></div>
		
		            <div id="author" style="display:none">
		                    <div  id="search_authorPRI"></div>
		                    <div  id="newFormAuthor"></div>
		            </div>
		
		            <div id="referencia" style="display:none"></div>
		
		            <div id="tipoTesis_pais_universidad" style="display:none">
		                <h1 id="titTipoTesis"></h1>
		                    <label id="labelTipoTesis"></label>
		                    <div id="registerTipoTesis"></div>
		                <h1 id="titPais"></h1>
		                    <div id="pais"></div>
		                <h1 id="titUniversidad"></h1>
		                    <div id="universidad"></div>
		            </div>

					<div style="float:left">
				        <div id="areas" style="display:none">
				            <p style="width:300px" class="txt-azul" id="titAreas"></p>
				            <div style="width:300px" id="cont_areas"></div>
				        </div>
				    
					</div>
					<div style="float:right">				        
				        <div id="areasAdministrativas" style="display:none">
				            <p style="width:300px" class="txt-azul" id="titAreasAdministrativas"></p>
				            <div style="width:300px" id="cont_areasAdministrativas"></div>
				        </div>
					</div>
					<div style="clear:both"></div>
					<div id="institucion_externa" style="display:none">
						<p class="txt-azul" id="tit_inst_ext"></p>
						<div id="cont_inst_ext"></div>
					</div>
					<div id="divform"></div>
		
		            <div id="fecha_permisos" style="display:none">
		                <div class="txt-azul" id="titFechasTesis">Fechas</div>
		                <div id="fechasTesis"></div>
						<div class="linea-separacion"></div>		                
		                <div class="txt-azul" id="titPermisosTesis"></div>
		                <div id="permisosTesis"></div>
		            </div>
					
		            <div id="region_departamento" style="display:none">
		                <h1 id="titRegion"></h1>
		                    <div id="registerRegionBoletines"></div>
		                    <div id="registerDepartamentoBoletines"></div>
		            </div>
		
		            <div id="compendio" style="display:none"></div>
                            
                            <div id="year_quarter" style="display:none"></div>
                            
		            <div id="archivo" style="display:none"></div>
			</div>		            
		    <div>
		            <form id="subcategory">
		                <input name="tipoPublicacion" id="tipoPublicacion" type="hidden" value='.$idSubcategory.'>
		                <p>
		                <span id="registerTypeGeoSoc"></span>
		                <span><input class="button" type="button" onclick="xajax_newGeofisicaSociedad('.$iddata.',\''.$action.'\',xajax.getFormValues(\'subcategory\'));" value='.$tituloBoton.' /></span>
		                </p>
		            </form>
		    </div>';


	    $objResponse->Assign("formulario","style.display","block");
	    $objResponse->Assign("formulario","innerHTML","$html");
	    $objResponse->Assign("formSearch","style.display","none");
	    $objResponse->Assign("estadisticas", "style.display", "none");
	    $objResponse->script("xajax_comboRegionShow(0,1)");
            $objResponse->script("xajax_formSubcategoryShow($idSubcategory,1)");
            
                if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
                                $objResponse->script("xajax_formSubcategoryShow($idSubcategory)");
            
                    }
                }
	    
	    
		return $objResponse;
	}
        


	function formSubcategoryShow($tipo=1){
		$objResponse = new xajaxResponse();
		$html="";
		$tipoDocumento="";
		$subcategory="";

                if(isset($_SESSION["tmp"])){
                    unset($_SESSION["tmp"]);
                }

		//Limpiar las Capas de Títulos para que no se repitan en otros tipos documentos
		$titulos=array("titulo1","titulo2","titulo3","titulo4","titulo5","titulo6","titulo7");
		foreach ($titulos as $nombre_titulos){
			$objResponse->assign($nombre_titulos,"innerHTML","");
		}
                $objResponse->script("xajax_registerDateIng()");
		
                        //###############################################################
			// FECHA-ESTADO-PERMISOS
                        
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
            
            
                if(isset($_SESSION["edit"])){
                    
                    $objResponse->script("xajax_registerMonthPub($month_pub)");
                    $objResponse->script("xajax_registerYearPub($year_pub)");
                    
                }
         /*****************************************************/                
		
		if($tipo==0){
		    $html="";
                    $funcion="";
		    $_SESSION["subcategory"]="";
                    $_SESSION["idsubcategory"]="";
		    $objResponse->assign("idcontactform","style.display","none");
		}
		else if($tipo==1){   
                        $funcion="newPublication";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="publicaciones";
			$subcategory="articulos_indexados";
			$idsubcategory=1;
                        $idtypedocument=1;

			// PARA EL TITULO
                        //función que muestra la capa por default
			$objResponse->script("xajax_displaydiv('titulo_resumen','titulo1')");
                        
			$objResponse->assign("titulo1","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_resumen','titulo1'); return false;\">T&iacute;tulo / Resumen</a>");		    
                        $objResponse->assign("titulo_resumen","innerHTML",iniTitulo_Resumen());

                        //###############################################################
			//PARA EL AUTOR
                        $objResponse->assign("titulo2","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('author','titulo2'); return false;\">Autor</a>");
                        $objResponse->script("xajax_searchAuthorSesionPriShow()");
                        $objResponse->script("xajax_searchAuthorSesionSecShow()");
                        $objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
			$objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    	
			//###############################################################
                        //REFERENCIA
                        $objResponse->assign("titulo3","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('referencia','titulo3'); return false;\">Referencia</a>");		    

			if(isset($_SESSION["edit"])){
			    $recuperar=$_SESSION["edit"];    
			}
			elseif(isset($_SESSION["tmp"])){
			    $recuperar=$_SESSION["tmp"];
			}
	
                        if(isset($recuperar["idreference"])){
                            $id=$recuperar["idreference"];
                        }
                        else{
                            $id=0;
                        }

                        $objResponse->assign("referencia","innerHTML",iniReferenciaShow($tipo,'titulo3'));
                        $objResponse->script("xajax_comboReferenciaShow(".$_SESSION["idarea"].",$tipo,$id,1)");

                        //###############################################################    		
                        // AREA Y TEMA
			$link="<a onclick=\"xajax_displaydiv('area_tema','titulo4'); return false;\" href='#'>&Aacute;rea y Tema</a>";
			$objResponse->assign('titulo4',"innerHTML",$link);
		
		        //Temas del area 
                        $objResponse->script("xajax_iniAreaShow('".$_SESSION["idarea"]."')");
		
		        //Asociar a otras areas
                        $objResponse->script("xajax_iniOtrasAreasShow('".$_SESSION["idarea"]."')");
		
		        //Asociar a otros temas
			$range=readSessionArea();
			$objResponse->script("xajax_otrosTemasShow('$range')");
		
		        //Asociar a otros temas
			$objResponse->script("xajax_iniOtrosTemasShow()");
		
		        //Ingresar nuevo tema
			$objResponse->script("xajax_newThemeShow()");
    		
                        
		    $link="<a onclick=\"xajax_displaydiv('fecha_estado_permisos','titulo5'); return false;\" href='#'>Fecha/Estado/Permisos</a>";
		    $objResponse->Assign('titulo5',"innerHTML",$link);
		    $htmlStatus=iniStatus();
		    $htmlDates=iniDates();
	            
	            if(isset($_SESSION["edit"])){
	                $objResponse->script("xajax_iniEditPermission('titPermisos','permisos')");   
	            }
	            else{                
	                $objResponse->script("xajax_iniPermission('titPermisos','permisos')");
	            }

			$objResponse->Assign("estado","innerHTML",$htmlStatus);            
			$objResponse->Assign("fechas","innerHTML",$htmlDates);
			$objResponse->Assign("titFechas","innerHTML","Fechas");
			

			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo6',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo6'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);
		
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
                        
                        
		}
		else if($tipo==2){
                    
                        $funcion="newPublication";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="publicaciones";
			$subcategory="tesis";
			$idsubcategory=2;
                        $idtypedocument=1;
			unset($_SESSION["edit"]["idreference"]);
			unset($_SESSION["edit"]["reference_description"]);
			unset($_SESSION["edit"]["reference_details"]);
		
                        //función que muestra la capa por default
                        $objResponse->script("xajax_displaydiv('titulo_resumen','titulo1')");
		
			$objResponse->assign("titulo1","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_resumen','titulo1'); return false;\">T&iacute;tulo / Resumen</a>");		    
                        $objResponse->assign("titulo_resumen","innerHTML",iniTitulo_Resumen());

                        //###############################################################
			//PARA EL AUTOR
                        $objResponse->assign("titulo2","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('author','titulo2'); return false;\">Autor</a>");
                        $objResponse->script("xajax_searchAuthorSesionPriShow()");
                        $objResponse->script("xajax_searchAuthorSesionSecShow()");
                        $objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
			$objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    	
			//###############################################################
                        $objResponse->script("xajax_iniTypeTesisCountryUniversity('titulo3')");
                        $objResponse->script("xajax_iniDatePermission('titulo5')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo6',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo6'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
                
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}
		else if($tipo==3){
                        $funcion="newPublication";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="publicaciones";
			$subcategory="otras_publicaciones";
			$idsubcategory=3;
                        $idtypedocument=1;
                        
                        //función que muestra la capa por default
                        $objResponse->script("xajax_displaydiv('titulo','titulo1')");

                        //$objResponse->script("xajax_iniTitulo('titulo1')");
                        $objResponse->Assign('titulo1',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo','titulo1'); return false;\">Título Resumen</a>");
                        $objResponse->assign("titulo","innerHTML",iniTitulo_Resumen());
		    
                        //###############################################################
			// AUTOR

                        $objResponse->assign("titulo2","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('author','titulo2'); return false;\">Autor</a>");
                        $objResponse->script("xajax_searchAuthorSesionPriShow()");
                        $objResponse->script("xajax_searchAuthorSesionSecShow()");
                        $objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
			$objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    	
			//###############################################################
			// REFERENCIA			
                        $objResponse->assign("titulo3","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('referencia','titulo3'); return false;\">Referencia</a>");		    

			if(isset($_SESSION["edit"])){
			    $recuperar=$_SESSION["edit"];    
			}
			elseif(isset($_SESSION["tmp"])){
			    $recuperar=$_SESSION["tmp"];
			}
	
                        if(isset($recuperar["idreference"])){
                            $id=$recuperar["idreference"];
                        }
                        else{
                            $id=0;
                        }

                        $objResponse->assign("referencia","innerHTML",iniReferenciaShow($tipo,'titulo3'));
                        $objResponse->script("xajax_comboReferenciaShow(".$_SESSION["idarea"].",$tipo,$id,1)");
		    
			//###############################################################
			// AREA					    
		    
                        //###############################################################
			// FECHA-ESTADO-PERMISOS
                        $link="<a onclick=\"xajax_displaydiv('fecha_estado_permisos','titulo4'); return false;\" href='#'>Fecha/Estado/Permisos</a>";
                        $objResponse->Assign('titulo4',"innerHTML",$link);
                        $htmlStatus=iniStatus();
                        $htmlDates=iniDates();
	            
                        if(isset($_SESSION["edit"])){
                            $objResponse->script("xajax_iniEditPermission('titPermisos','permisos')");   
                        }
                        else{                
                            $objResponse->script("xajax_iniPermission('titPermisos','permisos')");
                        }

			$objResponse->Assign("estado","innerHTML",$htmlStatus);            
			$objResponse->Assign("fechas","innerHTML",$htmlDates);
			$objResponse->Assign("titFechas","innerHTML","Fechas");		
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
                        
                        $objResponse->Assign('titulo5',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo5'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
		}

		elseif($tipo==4){
			$tipoDocumento="ponencias";
			$subcategory="ponencia";
			$idsubcategory=4;
                        $idtypedocument=2;
		}

		else if($tipo==6){
                        $funcion="newInformacionInterna";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="informacion_interna";
			$subcategory="reportes_tecnicos";
			$idsubcategory=6;
                        $idtypedocument=3;
		    //función que muestra la capa por default
		    $objResponse->script("xajax_displaydiv('titulo','titulo1')");
		    $objResponse->script("xajax_iniTitulo('titulo1')");
		    
	    	//###############################################################
			// AUTOR
                        $objResponse->assign("titulo2","innerHTML","<a href=#1 onclick=\"xajax_displaydiv('author','titulo2'); return false;\">Autor</a>");
                        $objResponse->script("xajax_searchAuthorSesionPriShow()");
                        $objResponse->script("xajax_searchAuthorSesionSecShow()");
                        $objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
			$objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    	
			//###############################################################		    
                        $objResponse->script("xajax_iniAreas('titulo3')");
		    
			//###############################################################		    
                        $objResponse->script("xajax_iniDatePermission('titulo4')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo5',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo5'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    

                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}

		else if($tipo==7){
                        $funcion="newInformacionInterna";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="informacion_interna";
			$subcategory="informes_trimestrales";
			$idsubcategory=7;
                        $idtypedocument=3;
                        
                        $objResponse->script("xajax_displaydiv('year_quarter','titulo1')");
                        $objResponse->script("xajax_iniYearQuarter('titulo1')");
		    
			//###############################################################		    
                        $objResponse->script("xajax_iniDatePermission('titulo2')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo3',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo3'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
		
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}		
		
		else if($tipo==8){
                        $funcion="newInformacionInterna";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="informacion_interna";
			$subcategory="boletines";
			$idsubcategory=8;
                        $idtypedocument=3;
                        
                        //función que muestra la capa por default
                        $objResponse->script("xajax_displaydiv('nro_magnitud','titulo1')");
                        $objResponse->script("xajax_iniNroMagnitud('titulo1')");
                        $objResponse->script("xajax_iniRegionDepartamentoFechas('titulo2')");

                        //###############################################################
                        // ARCHIVO					
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo3',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo3'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);
                    
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
                    
		}
		
		else if($tipo==11){
                        $funcion="newAsuntosAcademicos";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="asuntos_academicos";
			$subcategory="compendios";
			$idsubcategory=11;
                        $idtypedocument=4;
                        
                        //función que muestra la capa por default
                        $objResponse->script("xajax_displaydiv('compendio','titulo1')");
                        $objResponse->script("xajax_iniNroCompendioYear('titulo1')");
                        $objResponse->script("xajax_iniDatePermission('titulo2')");

			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo3',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo3'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    

                    if($link!=""){
                        $objResponse->Assign("formUpload","style.display","none");
                    }
                
		}
		else if($tipo==12){
                        $funcion="newAsuntosAcademicos";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="asuntos_academicos";
			$subcategory="informes_trimestrales";
			$idsubcategory=12;
                        $idtypedocument=4;
                        
                        $objResponse->script("xajax_displaydiv('year_quarter','titulo1')");
                        $objResponse->script("xajax_iniYearQuarter('titulo1')");
		    
			//###############################################################		    
                        $objResponse->script("xajax_iniDatePermission('titulo2')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo3',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo3'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
		    
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}
		else if($tipo==13){
                        $funcion="newGeofisicaSociedad";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="informacion_interna";
			$subcategory="informes_trimestrales";
			$idsubcategory=13;
                        $idtypedocument=5;
                        
                        $objResponse->script("xajax_displaydiv('year_quarter','titulo1')");
                        $objResponse->script("xajax_iniYearQuarter('titulo1')");
		    
			//###############################################################		    
                        $objResponse->script("xajax_iniDatePermission('titulo2')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo3',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo3'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
		    
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}
		
		else if($tipo==5){
                        $funcion="newAsuntosAcademicos";
			$objResponse->assign("idcontactform","style.display","block");
			$tipoDocumento="asuntos_academicos";
			$subcategory="charlas_internas";
			$idsubcategory=5;
                        $idtypedocument=4;
                        
                        //función que muestra la capa por default
                        $objResponse->script("xajax_displaydiv('titulo_presentado','titulo1')");
                        $objResponse->script("xajax_iniTitulo_Presentado('titulo1')");
                        $objResponse->script("xajax_iniDatePermission('titulo3')");
                        $objResponse->script("xajax_iniAreas('titulo2')");
		    
			//###############################################################
			// ARCHIVO			
                        list($htmlArchivo,$link)=iniArchivoShow();
                    
                        $objResponse->Assign('titulo4',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('archivo','titulo4'); return false;\">Archivo</a>");
                        $objResponse->Assign("archivo","innerHTML",$htmlArchivo);		    
		
                        if($link!=""){
                            $objResponse->Assign("formUpload","style.display","none");
                        }
		}

                
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
				$boton="";
		    }
		}
		else{
			$action="INS";
			$tituloBoton="GUARDAR";
			$boton='<span><p><input class="button" type="button" id="boton_guardar" onclick="xajax_'.$funcion.'(0,\''.$action.'\',xajax.getFormValues(\'subcategory\'));" value='.$tituloBoton.' /></p></span>';
			$objResponse->assign("botonGuardarEditar","innerHTML",$boton);
														
		}
                
		$_SESSION["tipoDocumento"]=$tipoDocumento;
		$_SESSION["subcategory"]=$subcategory;
                
                if(isset($idtypedocument)){
			$_SESSION["idtypedocument"]=$idtypedocument;
		}

		if(isset($idsubcategory)){
			$_SESSION["idsubcategory"]=$idsubcategory;			
		}
                
                $objResponse->script('	$(document).ready(function() {
		$("input.file").si();});');
                
                //$objResponse->alert($boton);
		return $objResponse;
	}
	
	
	
	
	function formConsultaShow($idbutton,$seccion="",$idarea=0){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){                    
		    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
		    unset($_SESSION["publicaciones"]);
		}
                
                //$objResponse->alert($idarea);
		// Desde la pagina web del IGP
		if($idbutton==1){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='<div id="divAuthor">';
			$formAutor.='<div class="campo-buscador">Apellido Autor:&nbsp;</div>';
			$formAutor.='<div class="contenedor-caja-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div>';
			$formAutor.='</div>';
	
		}
	
		// Desde la pagina web del area
		if($idbutton==2){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			// $formAutor='<div id="divAuthor">';
			// $formAutor.='<div class="campo-buscador">Apellido Autor:&nbsp;</div>';
			// $formAutor.='<div class="contenedor-caja-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div>';
			// $formAutor.='</div>';
			
			//$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';

		}
		// Desde la pagina web del autor
		if($idbutton==3){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='';
		}
	
		$fieldhidden='<input id="fieldHidden" name="fieldHidden" type="hidden" value='.$seccion.'>';

		if($idarea==9){
                    $formArea='<div class="campo-buscador">&Aacute;reas:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divArea"></div><div style="clear:both"></div>';
		}                
		if($idarea==8){
			$comboTipoPublicacion='
			<select  name="idsubcategory" id="idsubcategory" onChange="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value); return false;" class="combo-buscador-1">
			    <option value="0" selected="selected">- Seleccione-&nbsp;</option>
			    <option value="5" >&nbsp;Charlas Internas&nbsp;</option>
			    <option value="11">&nbsp;Compendios de estudiantes&nbsp;</option>
                            <option value="12">&nbsp;Informes trimestrales&nbsp;</option>
			</select>';    
		}
		elseif($idarea==11 or $idarea==12  or $idarea==13  or $idarea==14){
			$comboTipoPublicacion='
			<select  name="idsubcategory" id="idsubcategory" onChange="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value); return false;" class="combo-buscador-1">			    
                            <option value="0">&nbsp;Elegir&nbsp;</option>
                            <option value="7">&nbsp;Informes trimestrales&nbsp;</option>
			</select>';    
		}                
		else{
			$comboTipoPublicacion='
			<select  name="idcategory" id="idcategory" class="combo-buscador-1">
			    <option value="0" selected="selected">- Seleccione-&nbsp;</option>
			    <option value="1" >Todos los campos</option>
			    <option value="2">Autor</option>
			    <option value="3">Temas</option>
			    <option value="4">Serie</option>
			    <option value="5">CallNumber</option>
			</select>';
		}
		
		$html='
		<div>
			<div id="divformSearch">
			<h2 class="txt-azul">Buscador </h2>
			<form id="formSearch">
				
                                    '.$formArea.'
				
				<ul class="query_type">
				    
				    <li><input class="query_type" type="radio" id="query_type_1" name="query_type" value="content" onclick="xajax_click_checked(this.value)"> <label for="query_type_1">Que contenga</label></li>
				    <li><input class="query_type" type="radio" id="query_type_2" name="query_type" value="empieza" > <label for="query_type_2">Empieza por</label></li>
				    <li><input class="query_type" type="radio" id="query_type_3" name="query_type" value="exacta" checked> <label for="query_type_3">Exacta</label></li>
				    
				</ul>					
				<div class="clear"></div>
				<div>
                                    
                            <div id="div_tituloSearch" class="contenedor-caja-buscador-1">
                                <input id="tituloSearch" name="tituloSearch" type="text" size="30" class="caja-buscador-1">
                            </div>

                            <div class="contenedor-combo-buscador-1" id="divCategory">
							'.$comboTipoPublicacion.'						
							</div>
				</div>'.$formAutor.'
	                        '.$fieldhidden.'
	            
	            
                                <button id="btn-search">Buscar</button>
				<div style="clear:both;"></div>
				<div id="msj_query_type"> </div>
				<br/>
				<div class="txt-azul"><p>Opciones avanzadas</p></div>
				<div id="optionsSubcategory"></div>
				<div id="moreOptions"></div>

				<div id="searchDate" style="display:none;">
					<div style="clear:both;"></div>
					<div class="campo-buscador">Fechas: </div>
					<div class="contenedor-caja-buscador-2">
						<span id="divTipoFecha"></span>
						<span id="divMonth"></span>
						<span id="divYear"></span>
					</div>
					<div style="clear:both;"></div>	
				</div>

			</form>
			</div>
			<div id="resultSearch" style="display: none;"></div>
		</div>';
	
	    //$objResponse->script("xajax_comboAreaShow()");
	    //$objResponse->script("xajax_comboMonthShow()");
	    //$objResponse->script("xajax_comboYearShow()");
	    
	    
	    $objResponse->Assign("consultas","innerHTML","$html");
	    $objResponse->Assign("formulario","style.display","none");
	    $objResponse->Assign("consultas","style.display","block");
            $objResponse->assign('paginator', 'style.display',"none");
            $objResponse->assign("imghome", "style.display", "none");
            
                $comboArea=comboAreaResult();
		// $objResponse->assign('divArea', 'innerHTML', $comboArea);
		
		$comboMonth=comboMonth(0,'','searchMonth');
		// $objResponse->assign('divMonth', 'innerHTML',$comboMonth);

		$comboYear=comboYear(0,'','searchYear');
		// $objResponse->assign('divYear', 'innerHTML',$comboYear);
                
	    $objResponse->Assign("estadisticas", "style.display", "none");
	    
            		if($idarea==11 or $idarea==12 or $idarea==13 or $idarea==14){
                            $objResponse->assign("div_titulo","innerHTML","");
                            $objResponse->assign("div_tituloSearch","innerHTML","");
                            $objResponse->assign("divAuthor","innerHTML","");
                            
                            
                        }
	    //$objResponse->assign('botonGuardarEditar', 'innerHTML',$comboYear);
	    $objResponse->script('
	    	

	   		$("input:radio[name=query_type]").click(function(){
	   			
	   			if ($(this).attr("checked", "checked")) {
	   				
	   				var cc = $("input:radio[name=query_type]:checked").val();
	   				if (cc=="content") {
	   					msjdes = "Buscará la palabra o frase que esté contenido en todo registro";
	   				}
	   				else if (cc=="empieza") {
	   					msjdes = "Buscará la palabra o frase que empieza por";
	   				}
	   				else if (cc=="exacta") {
	   					msjdes = "Buscará la palabra o ofrase exacta";
	   				}
	   				else{
	   					msjdes == "debe elgir una opcion";
	   				}

	   				$("#msj_query_type").html(msjdes);
	   			}
	   		})    
	    	
	    	   	
	    	
                
                $( "#btn-search" ).button({
                    icons: {
                        primary: "ui-icon-search"
                    }            
                })
                .click(function() {                                    
                                    xajax_auxSearchShow(20,1,xajax.getFormValues(formSearch)); return false;
                })  
                               


                
                
                
	    	

		');
		return $objResponse;
	}
function click_checked(){
		$objResponse = new xajaxResponse();

		$objResponse->assign("divdestino","innerHTML","");
		return $objResponse;
	}
	
function crea_form($accion){
    $respuesta = new xajaxResponse();
    
    $iduser=$_SESSION["idusers"];
    
    switch($accion){
        case "cambiar":
        
        $html='                        
        <div id="clave-form" title="Cambiar Clave">
        <p class="validateTips">Todos los campos son requeridos</p>
	<form id="myform">
	<fieldset>
		<label for="name">Clave actual</label>
		<input type="password" name="password_old" id="password_old" class="text ui-widget-content ui-corner-all" />
                
		<label for="name">Ingrese su nueva clave</label>
		<input type="password" name="password_new" id="password_new" class="text ui-widget-content ui-corner-all" />

		<label for="name">Reingrese su nueva clave </label>
		<input type="password" name="repasswordnew" id="repasswordnew" class="text ui-widget-content ui-corner-all" />

                <p class="validateTips_correo">La siguiente dirección de correo que ingrese se utilizará en caso usted olvide la contraseña</p>
		<label for="name">Ingrese su E-mail </label>
		<input type="text" name="correo" id="correo" class="text ui-widget-content ui-corner-all" />

	</fieldset>
	</form>
        </div>




        ';

        $respuesta->assign("form","innerHTML",$html);
        
        $respuesta->script('
	$(function() {






		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		

		var password_old = $( "#password_old" ),
                    password_new = $( "#password_new" ),
                    repasswordnew = $( "#repasswordnew" ),
                    correo = $( "#correo" ),
                    
                    allFields = $( [] ).add( password_old ).add( repasswordnew ).add( password_new ).add( correo ),
                    tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Longitud de " + n + " debe estar entre " +
					min + " y " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		function equal_pass( o, n ) {
			if ( o.val() != n.val() ) {
				n.addClass( "ui-state-error" );
				updateTips( "El nuevo password no coincide con el ingresado anteriormente." );
				return false;
			} else {
				return true;
			}
		}



   /********Dialogo Clave****************/
   /*
   Las dimensiones puedes obviarse solo sí el contenido en pequeño
    height: 700,
    width: 700,
    */
		$( "#clave-form" ).dialog({
			autoOpen: false,
			modal: true,
                        resizable: false,
                        /*position: "top",*/
			buttons: {
				"Aceptar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
                                        
					bValid = bValid && checkLength( password_old, "password", 5, 16 );                                        
                                        bValid = bValid && checkLength( password_new, "password", 5, 16 );
                                        bValid = bValid && checkLength( repasswordnew, "password", 5, 16 );
                                        bValid = bValid && equal_pass( password_new, repasswordnew );
                                        bValid = bValid && checkLength( correo, "email", 6, 80 );
                                        
                                        bValid = bValid && checkRegexp( password_old, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					bValid = bValid && checkRegexp( repasswordnew, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
                                        bValid = bValid && checkRegexp( password_new, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
                                                                                
                                                                                
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                                        /*bValid = bValid && checkRegexp( correo, /^((([a-z]|\d|[!#\$%&\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );*/
					/*bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );*/
                                        
                                            bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );
                                        /*Para que acepte un correo parecido a eddy.leccca@yahoo.com.pe*/
                                        /*bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );*/
                                        

                                        
					if ( bValid ) {
                                                
                                                /*show(name.val());*/
                                                /*xajax_insertElement(\'instrument_type\',name.val());*/
                                                xajax_cambiarClave(password_old.val(),password_new.val(),correo.val(),'.$iduser.');
                                                /*
						$( "#users tbody" ).append( "<tr>" +
							"<td>" + name.val() + "</td>" + 
							"<td>" + email.val() + "</td>" + 
							"<td>" + password.val() + "</td>" +
						"</tr>" ); 
                                                */
						$( this ).dialog( "close" );
					}
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
    /***************************************/

    /**********Asignar a los divs el efecto*************/
		$( "#new-clave" )                       
			.click(function() {
				$( "#clave-form" ).dialog( "open" );
			});
                        

	});

    function show(val){
            alert(val);
        }
        ');
    break;

    case "recuperar":
        
        $html='                        
        <div id="recuparar-form" title="Recuperar Clave">
        <p class="validateTips">Todos los campos son requeridos</p>
	<form id="myform">
	<fieldset>
		<label for="name">Ingrese su Usuario</label>
		<input type="text" name="user" id="user" class="text ui-widget-content ui-corner-all" />
                
		<label for="name">Ingrese su Correo</label>
		<input type="text" name="correo" id="correo" class="text ui-widget-content ui-corner-all" />


	</fieldset>
	</form>
        </div>




        ';

        $respuesta->assign("form","innerHTML",$html);
        
        $respuesta->script('
	$(function() {






		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		

		var user = $( "#user" ),
                    correo = $( "#correo" ),
                    
                    allFields = $( [] ).add( user ).add( correo ),
                    tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Longitud de " + n + " debe estar entre " +
					min + " y " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		function equal_pass( o, n ) {
			if ( o.val() != n.val() ) {
				n.addClass( "ui-state-error" );
				updateTips( "El nuevo password no coincide con el ingresado anteriormente." );
				return false;
			} else {
				return true;
			}
		}



   /********Dialogo Clave****************/
   /*
    Las dimensiones puedes obviarse solo sí el contenido en pequeño
    height: 700,
    width: 700,
    */
		$( "#recuparar-form" ).dialog({
			autoOpen: false,
			modal: true,
                        resizable: false,
                        /*position: "top",*/
			buttons: {
				"Aceptar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
                                        
					bValid = bValid && checkLength( user, "username", 3, 16 );                                        
                                        bValid = bValid && checkLength( correo, "email", 6, 80 );
                                        
                                        bValid = bValid && checkRegexp( user, /^[a-z]([0-9a-z_])+$/i, "Usuario puede concistir  a-z, 0-9, comenzar con una letra." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/                                       
                                        bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );
                                        

                                        
					if ( bValid ) {
                                                
                                                /*show(name.val());*/
                                                /*xajax_insertElement(\'instrument_type\',name.val());*/
                                                /*xajax_cambiarClave(password_old.val(),password_new.val(),correo.val(),'.$iduser.');*/
                                                xajax_recuperarClave(user.val(),correo.val());
                                                /*
						$( "#users tbody" ).append( "<tr>" +
							"<td>" + name.val() + "</td>" + 
							"<td>" + email.val() + "</td>" + 
							"<td>" + password.val() + "</td>" +
						"</tr>" ); 
                                                */
						$( this ).dialog( "close" );
					}
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
    /***************************************/

    /**********Asignar a los divs el efecto*************/
		$( "#recuparar-clave" )                       
			.click(function() {
				$( "#recuparar-form" ).dialog( "open" );
			});
                        

	});

    function show(val){
            alert(val);
        }
        ');
    break;

    }

        
	/*        
	$respuesta->script('
	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});;

	    $(document).ready(function(){
	    $("#myform").validate({
	    rules: {
	    
	    repassword_old: {
	        equalTo: "#password_old"
	    }
	    }
	    });
	    });
	');
	*/
    return $respuesta;        
}
	
	

function carga_archivo(){
    $respuesta = new xajaxResponse();
    
    
    $html='
            <table class="options">
            <thead>
                    <tr>
                            <!--<th>Subir cargo</th>-->
                            <!--<th>Listado de Archivos Cargados</th>-->
                    </tr>
            </thead>
            <tbody>
                    <tr>
                            <td>
                                    <div id="demo1" style="width:500px"></div>
                                    <!--<div id="report" style="overflow:auto;width:300px;height:200px;"></div>-->

                            </td>
                            <!--
                            <td>
                                <table>
                                  <tr>
                                    <td id="lista_archivos" class="infsub">
                                    </td>
                                  </tr>
                                </table>
                            </td>
                            -->
                    </tr>
            </tbody>
            </table>

    ';
    
    $respuesta->assign("carga_archivo", "innerHTML", $html);
    
    $respuesta->script('
			$("#demo1").ajaxupload({
				url:"librerias/ax-jquery-multiuploader/examples/upload.php",
                                allowExt:["png","gif","jpg","zip"],
				remotePath:"uploaded/",
                                finish:function(files)
                                    {
                                        alert("Todas las archivos han sido cargados");
                                        //var conteo=files.length 
                                        //alert(files);
                                        //xajax_lista_archivos();
                                        
                                    },
                                success:function(fileName)
                                    {
                                        
                                        texto = fileName.split(".");
                                        name=texto[0];
                                        //alert(name);

                                        //$("#report").append("<p>"+fileName+" uploaded.</p>");
                                        //$("#report").append("<input class=\'filesupload\' type=\'text\' name=\'"+name+"\' id=\'"+name+"\' value=\'"+fileName+"\'></input>");
                                        xajax_save_files(fileName);
                                    }
			});
        
    ');
    
    return $respuesta;
}    


function save_files($namefile){
    $respuesta = new xajaxResponse();

    $texto = explode('.',$namefile);
    $name=$texto[0];
    
    $str_name=(str_replace(" ","-",$name));
    
        $_SESSION["files"]["file-".$str_name]=$namefile;
        
    //$respuesta->alert(print_r($_SESSION, true));
    
    return $respuesta;
}



function delete_file($namefile){
    $respuesta = new xajaxResponse;
    
    //$respuesta->alert($namefile);
        
    $pos = array_search($namefile,$_SESSION["files"]);
    
    unset($_SESSION["files"][$pos]);
    //$respuesta->alert(print_r($_SESSION, true));
    
    
    $dir="librerias/ax-jquery-multiuploader/examples/uploaded/";
    if (is_file($dir.$namefile)) {
      if ( unlink($dir.$namefile) ){
        $respuesta->assign($namefile, "value", "");
      }
     }

     
    $texto = explode('.',$namefile);
    $name=$texto[0];
     
    /*
     //Eliminar el input creado para el archivo cargado
     $respuesta->script("
        $('#$name').remove();
     ");
    */
    
    return $respuesta;
}

	/*******************************************************************
	Registrar las Funciones
	*******************************************************************/
	
	$xajax->registerFunction('subArea');
	$xajax->registerFunction('registerSubAreas');
	$xajax->registerFunction('menuAAShow');
	$xajax->registerFunction('formCategoryShow');
	$xajax->registerFunction('detalleGraficosEstadisticos');
	$xajax->registerFunction('graficosEstadisticos');
	$xajax->registerFunction('muestraFormGrafico');
	
	/*******Seccion Asuntos Academicos**********/
	$xajax->registerFunction('registerDepartamento');
	$xajax->registerFunction('registerRegion');
	$xajax->registerFunction('registerMagnitud');
	$xajax->registerFunction('registerBoletin');
	$xajax->registerFunction('registerQuarter');
        $xajax->registerFunction('registerYear');
        $xajax->registerFunction('registerYearQuarter');        
        $xajax->registerFunction('registerYearPub');
        $xajax->registerFunction('registerMonthPub');        
        $xajax->registerFunction('registerDayPub');
        $xajax->registerFunction('registerDateIng');
	$xajax->registerFunction('registerCompendio');
	$xajax->registerFunction('registerAreaAdministrativa');
	$xajax->registerFunction('iniAreasAdministrativasShow');
	$xajax->registerFunction('registerTitPrePor');
	$xajax->registerFunction('registerInst_Ext');
	$xajax->registerFunction('iniInstitucionExterna');
	$xajax->registerFunction('iniAreasAdministrativasShow');
	$xajax->registerFunction('iniTitulo_Presentado');
	$xajax->registerFunction('registerCompendioYear');
	$xajax->registerFunction('iniNroCompendioYear');
	$xajax->registerFunction('formAsuntosAcademicosShow');
        $xajax->registerFunction('formGeoSocShow');
        
	$xajax->registerFunction('comboTipoAsuntosAcademicosShow');
	$xajax->registerFunction('newAsuntosAcademicos');
        $xajax->registerFunction('newGeofisicaSociedad');
        
	/*******Seccion Asuntos Academicos**********/
	
	
	
	/*******Seccion Informacion Interna**********/
	
	$xajax->registerFunction('iniAreas');
	$xajax->registerFunction('registerYearQuarter');
	$xajax->registerFunction('comboYearRegisterShow');
	$xajax->registerFunction('comboQuarter');
	$xajax->registerFunction('iniYearQuarter');
	$xajax->registerFunction('registerBoletinMagnitud');
	$xajax->registerFunction('iniNroMagnitud');
	$xajax->registerFunction('comboMagnitudShow');
	$xajax->registerFunction('registerRegDepFechas');
	$xajax->registerFunction('registerTitulo');
	$xajax->registerFunction('iniTitulo');
	$xajax->registerFunction('newInformacionInterna');
	$xajax->registerFunction('comboDepartamentoShow');
	$xajax->registerFunction('iniRegionDepartamentoFechas');
	$xajax->registerFunction('comboRegionShow');
	$xajax->registerFunction('comboTipoInformacionInternaShow');
	$xajax->registerFunction('formInformacionInternaShow');
	/*******Seccion Informacion Interna**********/
	
	
	/*******Seccion Ponencias********************/
	$xajax->registerFunction('registerCatEvento');
	$xajax->registerFunction('registerNomEvento');
	$xajax->registerFunction('registerLugar');
	$xajax->registerFunction('registerPais');
	$xajax->registerFunction('registerPrePorNombre');
	$xajax->registerFunction('registerPrePorApellido');
	$xajax->registerFunction('registerTipoPonencia');
	$xajax->registerFunction('comboCategoriaEvento');
	$xajax->registerFunction('comboTipoPonencia');
	$xajax->registerFunction('iniEvento');
	$xajax->registerFunction('iniLugarPais');
	$xajax->registerFunction('iniTitulo_Tipo_Presentado');
	$xajax->registerFunction('formPonenciasShow');
	/*******Seccion Ponencias********************/
	
	/*******Sección Publicaciones****************/
	
        $xajax->registerFunction('iniEditPermission');
	$xajax->registerFunction('registerLink');
	$xajax->registerFunction('registerUniversidad');
	$xajax->registerFunction('registerPais');
	$xajax->registerFunction('registerTipoTesis');
	$xajax->registerFunction('registerReferenceDetails');
	$xajax->registerFunction('registerResumen');
	$xajax->registerFunction('iniTypeTesisCountryUniversity');
	$xajax->registerFunction('registerTipoPaisUni');
	
	
	$xajax->registerFunction('arrayAuthor');
	$xajax->registerFunction('newPublication');
	$xajax->registerFunction('newPonencia');
	
	$xajax->registerFunction('displaydiv');
	$xajax->registerFunction('comboTypeSubcategoryShow');
	$xajax->registerFunction('registerComboTipoPublicacionShow');
	
	
	
	//Registramos funciones para formularios y selects
	
	$xajax->registerFunction('formConsultaShow');
	$xajax->registerFunction('newReferenceRegister');
	$xajax->registerFunction('comboTipoTesisShow');
	$xajax->registerFunction('seccionShow');
	$xajax->registerFunction('comboTipoFechasShow');
	$xajax->registerFunction('iniTitulo_Tipo_Presentado');
	$xajax->registerFunction('registerLugarPais');
	$xajax->registerFunction('registerEventoTipo');
        $xajax->registerFunction('registerClaseEvento');
	
	// Registramos funciones para las fechas, el estado y los permisos 
	// ------------------------------------------------------------------
	$xajax->registerFunction('iniDateStatusPermission');
	$xajax->registerFunction('iniStatus');
	$xajax->registerFunction('iniDates');
	$xajax->registerFunction('iniPermission');
	$xajax->registerFunction('iniDatePermission');
	$xajax->registerFunction('registerPermission');
	$xajax->registerFunction('registerPermissionKey');
	$xajax->registerFunction('registerStatus');
	$xajax->registerFunction('registerDateIng');
	$xajax->registerFunction('registerDatePub');
        $xajax->registerFunction('registerYearCompendio');
	
	// Registramos funciones para areas asociadas y temas
	// ------------------------------------------------------------------
	
	$xajax->registerFunction('iniAreaTheme');
	$xajax->registerFunction('iniOtrosTemasShow');
	$xajax->registerFunction('iniAreas');
	$xajax->registerFunction('newThemeRegister');
	$xajax->registerFunction('newThemeInsert');
	$xajax->registerFunction('newThemeShow');
	$xajax->registerFunction('otrosTemasShow');
	$xajax->registerFunction('registerTheme');
	$xajax->registerFunction('registerArea');
	$xajax->registerFunction('iniOtrasAreasShow');
	$xajax->registerFunction('iniAreaShow');
	
	
	
	
	$xajax->registerFunction('iniArchivoShow');
	$xajax->registerFunction('guardarSesiones');
	
	/*Registrar las sesiones*/
	$xajax->registerFunction('registerTitRes');
	$xajax->registerFunction('registerTitTipo');
	$xajax->registerFunction('registerReference');
	
	$xajax->registerFunction('iniAuthorShow');
	$xajax->registerFunction('auxAuthorPriShow');
	$xajax->registerFunction('auxAuthorSecShow');
	
	$xajax->registerFunction('searchAuthorPriResult');
	$xajax->registerFunction('searchAuthorPriShow');
	
	$xajax->registerFunction('iniTitulo_Resumen');
	$xajax->registerFunction('iniTitulo_ResumenShow');
	$xajax->registerFunction('iniEstadoShow');
	$xajax->registerFunction('iniReferenciaShow');
	$xajax->registerFunction('iniAuthorPriShow');
	$xajax->registerFunction('iniAuthorSecShow');
	$xajax->registerFunction('iniAreaShow');
	
	$xajax->registerFunction('paginatorShow');
	
	$xajax->registerFunction('registraReferenciaShow');
	$xajax->registerFunction('registraReferenciaResult');
	
	$xajax->registerFunction('formAuthorShow');
	
	$xajax->registerFunction('registraAuthorResult');
	$xajax->registerFunction('registraAuthorShow');
	
	$xajax->registerFunction('inicio');
	$xajax->registerFunction('cerrarSesion');
	
	$xajax->registerFunction('searchReferenciaShow');
	$xajax->registerFunction('searchReferenciaResult');
	
	/*************Registrar Funciones de Autores****************/
	$xajax->registerFunction('searchAuthorSesionPriShow');
	$xajax->registerFunction('searchAuthorSesionPriResult');
	
	$xajax->registerFunction('searchAuthorSesionSecShow');
	$xajax->registerFunction('searchAuthorSesionSecResult');
	
	$xajax->registerFunction('delSearchAuthorSesionPriShow');
	$xajax->registerFunction('delSearchAuthorSesionPriResult');
	
	$xajax->registerFunction('delSearchAuthorSesionSecShow');
	$xajax->registerFunction('delSearchAuthorSesionSecResult');
	
	$xajax->registerFunction('searchAuthorPriShow');
	$xajax->registerFunction('searchAuthorPriResult');
	
	$xajax->registerFunction('searchAuthorSecShow');
	$xajax->registerFunction('searchAuthorSecResult');
	/*************Registrar Funciones de Autores****************/
	
	
	$xajax->registerFunction('busquedaReferenciaShow');
	$xajax->registerFunction('nuevaReferenciaShow');
	
	
	$xajax->registerFunction('editShow');
	$xajax->registerFunction('formSubcategoryShow');
	$xajax->registerFunction('formPublicacionShow');
	$xajax->registerFunction('formEstadisticaShow');
	
	$xajax->registerFunction('comboReferenciaShow');
	$xajax->registerFunction('comboEstadoPublicacionShow');
	$xajax->registerFunction('comboTipoPublicacionShow');
	
	$xajax->registerFunction('menuShow');
        $xajax->registerFunction('menuGSShow');
        
	$xajax->registerFunction('formLoginShow');
	$xajax->registerFunction('verificaUsuarioShow');
	
	$xajax->registerFunction('cargaScriptDates');
        $xajax->registerFunction('cargaScriptReferencia');
        $xajax->registerFunction('obtenerIdDescripcion');
        $xajax->registerFunction('cargaScriptMostrarAutores');
        $xajax->registerFunction('cargaScriptOcultarAutores');
        $xajax->registerFunction('mostrarBusquedaAutores');
        $xajax->registerFunction('ocultarBusquedaAutores');
        $xajax->registerFunction('verFile');
        $xajax->registerFunction('cambiarClave');        
        $xajax->registerFunction('crea_form');        
        $xajax->registerFunction('recuperarClave');        
        $xajax->registerFunction('sendemail');

    $xajax->registerFunction('registerISBN');
    $xajax->registerFunction('registerCallNumber');
    $xajax->registerFunction('registerPublication');
    $xajax->registerFunction('registerEdition');
    $xajax->registerFunction('registerSubject');
    $xajax->registerFunction('registerDescription');
    $xajax->registerFunction('click_checked');
    $xajax->registerFunction('carga_archivo');
    $xajax->registerFunction('save_files');
    $xajax->registerFunction('delete_file');


	$xajax->processRequest();	
	
	
	//Mostramos la pagina
	require("adminView.php");

?>
