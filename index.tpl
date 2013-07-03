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
<div class="cabecera-perfil" align="center">
	<div class="contenedor-logotipo"><a href="http://www.igp.gob.pe" target="_blank"><img src="img/logo-minan-igp_2012.png" alt="Instituto Geofísico del Perú" border="0" title="Instituto Geofísico del Perú" /></a></div>
	
    
    <div id="contenido">
    	<div class="contenido-cabecera" ><img src="img/002b.gif" /></div>
            
            	<div class="menu">
				<div id="menu_i"></div>	<div id="menu_d"></div><div style="clear:both;"></div>
                                
<!-- Fecha y Hora JQuery-->                                
<div style="float:right;" id="jclock"></div>
<div style="float:right;" >&nbsp;&nbsp;&nbsp;</div>
<div style="float:right;" id="jdate"></div>
<!-- Fecha y Hora JQuery-->                                
                                
           		</div>

        <div class="contenido-cabecera"><img src="img/003b.gif" /></div>
    </div>
    <div class="contenedor-simple"><img src="img/005b.jpg" /></div>
	<div class="banner-aplicaciones">
        <div>
        	<div class="banner-solo-texto">
                <div><span class="txt-blanco-30">M&oacute;dulo de informaci&oacute;n cient&iacute;fica t&eacute;cnica</span></div>
            </div>
		</div>
  </div>
    
       
</div>

<div class="contenedor-centro" align="center">
	<div class="contenedor-simple">
	  	<div class="columna-izquierda">
			<div id="loginform">
			 	<form onsubmit="" id="formLogin" name="formLogin" method="post">	  	
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
		            	<input onclick="xajax_downloadLogin(xajax.getFormValues(formLogin));  return false;" name="Iniciar" value="Iniciar" type="button"/>
		            </div>
		            <div style="clear:both"><p></p></div>
		            <div id="error"></div>
		            <div id="mensaje"></div>
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
    <div style="clear:both"></div>
</div>


<div class="contenedor-pie" align="center">Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte  |  Central Telefónica: 317-2300  |  <a href="#" class="mostaza">Contacto</a> | Escríbenos a: <a href="mailto:web@igp.gob.pe" class="mostaza">web@igp.gob.pe</a></div>

</body>
</html>
