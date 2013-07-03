<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IGP - WEB</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/desplegable.css" rel="stylesheet" type="text/css" />
<link href="css/DDSlider.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="Stylesheet" type="text/css" />	
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.14.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-datepicker-es.js"></script>
<script type="text/javascript" src="js/prueba.js"></script>


{ajax}
</head>

<body onload="xajax_verGrafico();">

<div align="center">

    <div align="center" class="contenedor-centro"><!--div para que se vean los border de los costados-->
	<div class="contenedor-simple">
	  	<div class="columna-izquierda">


			<div id="menuLateral" style="background-color:#EEEEEE; padding: 10px 10px 10px 10px">
				<div class="submenu">»<a href="http://jro.igp.gob.pe/DB_Admin/Biblioteca/Library_main.php" style="color:#000000">Biblioteca en Línea</a></div>
				<div><h3 class="txt-rojo">Categorías:</h3></div>
                                <div><h4 class="txt-rojo">Podrá buscar sobre :</h4></div>
				<div class="submenu">»<a style="color:#000000">Publicaciones<br /> (artículos indexados, tesis y otras publicaciones),</a></div>
                                <div class="submenu">»<a style="color:#000000">Ponencias<br /> (oral y póster)</a></div>
				<div class="submenu">»<a style="color:#000000">Información Interna<br /> (Informes Trimestrales y Reportes técnicos)</a></div>
			</div>



			<div id="loginform" style="background-color:#EEEEEE; padding: 10px 10px 10px 10px">
			 	<form onsubmit="" id="formLogin" name="formLogin" method="post">	  	
					<div style="font-size:14px; padding: 10px 0px 10px 0px">
			            <span class="txt-rojo">Iniciar sesión</span>
		            </div>

		        	<div class="campo-login">Usuario:</div>
		        	<div class="contenedor-caja-login">
		        		<input name="usuario" id="usuario" class="caja-login" type="text"/>
		        	</div>
		            
		            <div class="campo-login">Contraseña:</div>
		            <div class="contenedor-caja-login">
		            	<input name="clave" id="clave" class="caja-login" type="password"/>
		            </div>
		
		            <div style="float:left">
		            	<span>&nbsp</span><input onclick="xajax_downloadLogin(xajax.getFormValues(formLogin));  return false;" name="Iniciar" value="Iniciar" type="button"/>
		            </div>

		            <div style="clear:both"><p></p></div>
		            <div id="mensaje" style="text-align:left;"></div>
		            <div id="error"></div>
                </form>
          </div>
 
  	  </div>
    	<div class="columna-derecha">
			<div id="formulario"></div>
				<div id="consultas"></div>
				<div class="paginacion">
					<div id="paginator" class="wp-pagenavi"></div>
				</div>
		</div>				
    </div>
</div>            
    <div style="clear:both"></div>
</div>

</body>
</html>
