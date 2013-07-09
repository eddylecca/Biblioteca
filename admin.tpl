<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BIBLIOTECA - ADMIN</title>


    <!-- Framework CSS -->
    <link href="css/estilos.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="Stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
    
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

  
    
    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>

    <script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
    <link rel="stylesheet" href="css/style_dropdowns.css" type="text/css" media="screen, projection"/>
    
    
    
    <script src="js/jquery.si.js" type="text/javascript"></script>
    <link href="css/jquery.si.css" rel="stylesheet" type="text/css" />
    <!--Estilo del botón-->
    
    
    <script type="text/javascript" src="js/jquery-ui-datepicker-es.js"></script>
    <script type="text/javascript" src="js/prueba.js"></script>
    
    
    <script type="text/javascript" src="js/jquery.gdocsviewer.js"></script>
    
    <script src="js/jquery.jclock_es.js" type="text/javascript"></script>
    
    
    <link rel="stylesheet" href="css/sliding_form.css" type="text/css" media="screen"/>

    
    
    <link href="mini_sis_comentarios_xajax_mysql/css/estilo.css" rel="stylesheet" />
    
    
    
	<!-- SET UP AXUPLOADER  -->
	
        
	<script src="librerias/ax-jquery-multiuploader/examples/jslibs/ajaxupload.js" type="text/javascript"></script>
	
	<link rel="stylesheet" href="librerias/ax-jquery-multiuploader/examples/css/classicTheme/style.css" type="text/css" media="all" />
	<!-- /SET UP AXUPLOADER  -->
	
        <!-- Comentado porque solamente le da estilo al filset del upload>
	<link rel="stylesheet" href="css/upload.css" type="text/css" media="all" />-->



    <script type="text/javascript">
    $(function($) {
      var date = {
        format: '%A %d de %B del %Y' // 12-hour
      }
      $('#jdate').jclock(date);

      var hora = {
        format: '%H:%M:%S'
      }
      $('#jclock').jclock(hora);

    });
    </script>            
  

<script type="text/javascript">
function efectoUpload() {
                xajax.$('boton_guardar').style.display = 'none';
}    

function efectoUpload2(){
    xajax.$('boton_guardar').style.display = 'block';
}

    
function resultadoUpload(estado, file) {
    var link = "<br /><br /><a href='#upload' onclick='javascript: verFile(); return false'><b>Reemplazar Archivo</b></a> ";
    var linkSubir = "<br /><br /><a href='#upload' onclick='javascript: verFile(); return false'><b>Subir Archivo</b></a> ";
    
    if (estado == 0){
        var mensaje = '<font color=green> El Archivo se ha subido correctamente </font>' + link;
        
        /*boton_guardar=document.getElementById("boton_guardar");
        boton_guardar.disabled="true";*/

    }
        
    if (estado == 1){
        var mensaje = "<font color=red>Error ! - El Archivo no llegó al servidor por sobrepasar el tamaño permitido</font>" + linkSubir;
    }
        
    if (estado == 2){
        var mensaje = "<font color=red>Error ! - Solo se permiten Archivos tipo PDF </font>" + linkSubir;
    }
    if (estado == 3)
        var mensaje = "Error ! - No se pudo copiar Archivo. Posible problema de permisos en server" + linkSubir;

    divMensajeR=document.getElementById("mensajeR");
    divMensajeR.style.display="block";
    divMensajeR.innerHTML=mensaje;

    divFileR=document.getElementById("fileR");
    divFileR.style.display="none";
    
    divnoFile=document.getElementById("no_file");
    if(divnoFile){
        divnoFile.style.display="none";
    }
    }


function verFile(){
        divFile=document.getElementById("fileR");
        divFile.style.display="block";

        document.formUpload.fileUpload.value="";
        document.getElementById("fileUpload").value="";

        divMensaje=document.getElementById("mensajeR");
        divMensaje.style.display="none";

}

</script>


<style>
	#project-label {
		display: block;
		font-weight: bold;
		margin-bottom: 1em;
	}
	#foto_empleado {
		float: left;
		height: 100px;
		width: 100px;
                /*display: none;*/
                /*top:302.09088134765625px; left: 1030.9090576171875px;*/
	}
	#project-description {
		margin: 0;
		padding: 0;
	}

        #nombre_empleado {
		color: #366599;
                font-weight: bold;
	}
        #cargo_empleado {
		color: #6F8FB2;
                font-weight: bold;
                margin-bottom: 1em;
                height: 160px;
	}
        #sede_empleado {
		color: #6F8FB2;
                font-weight: bold;
                margin-bottom: 1em;
	}

        #nombre_institucion {
		color: #366599;
                font-weight: bold;
	}


        #oficina_empleado {
		color: #6F8FB2;
                font-weight: bold;
	}
        
	</style>
        
        
<style>
	div.positionable {
		width: 100px;
		height: 100px;
		position: absolute;
		display: block;
		right: 0;
		bottom: 0;
		/*background-color: #bcd5e6;*/
		text-align: center;
                
	}
	div.positionable2 {
		width: 100px;
		height: 100px;
		position: absolute;
		display: block;
		right: 0;
		bottom: 0;
		/*background-color: #bcd5e6;*/
		text-align: center;
	}
        
</style>


  
  
	<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#dialog1,#dialog2" ).dialog({
			autoOpen: false,
			show: "fade",
			hide: "fade",
                        height: 200,
                        width: 300
                        /*modal: true*/
		});

		$( "#opener1" ).click(function() {
			$( "#dialog1" ).dialog( "open" );
			return false;
		});
                


		$( "#opener2" ).click(function() {
			$( "#dialog2" ).dialog( "open" );
			return false;
		});

	});
	</script>
  
  
  
<style type="text/css">
/* Style the second URL with a red border */
#test-gdocsviewer {
	border: 5px red solid;
	padding: 20px;
	width: 750px;
	background: #ccc;
	text-align: center;
}
/* Style all gdocsviewer containers */
.gdocsviewer {
	margin:10px;
}
</style>

  {ajax}
</head>

<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->

<body onload="xajax_inicio(); ">
    
<div id="form" name="form"></div>

<!--
<div class="demo">

<div id="dialog-form" title="Create new user">
	<p class="validateTips">All form fields are required.</p>

	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

</div><!-- End demo -->
    
    
    
    <div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
            <div class="container" style="margin: 0 auto;">

	    	<div id="header" class="cabecera">
	    		<div class="span-9" style="text-align:center; padding-bottom: 6px;"><br><img src="img/logo-minan-igp_2012.png"></div>
			
	    		<div class="span-11">&nbsp;</div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>
				
                        <div class="span-24">
                                <ul id="menu" class="dropdown"></ul>
		
			</div>
                        <div id="saludo"></div>
                        <div class="span-24">
                            <div class="slideshow">
                                <div style="display: block;">
                                        <hr class="space">
                                        <div class="span-24">
                                            <div class="txt-blanco-30" style="text-align: center;">Biblioteca Virtual IGP</div>                                            
                                        </div>
                                </div>
                            </div>
	        	</div>
                </div>
                    
                <div id="divformlogin" name="formlogin" style="background-color:#EEEEEE; text-align:right; border-bottom: 1px solid #BBBBBB; /*border-top: 2px solid #BBBBBB;*/">

                </div>
	
	      <hr class="space">
              
	      <div class="span-22 last">
    
                    <div class="columna-derecha">
                                <hr class="space">
                                <div id="imghome"></div>
                        
                            <div id="formulario"></div>
                            <div id="consultas"></div>        
                            <div class="paginacion">
                            <div id="paginator" class="wp-pagenavi"></div>
                        </div>
                    </div>
                    <div class="span-24 contenedor-pie">
                          <br>
                          <p>Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte | Central Telefónica: 317-2300 |
                          <a class="mostaza" href="#">Contacto</a>| Escríbenos a: <a class="mostaza" href="mailto:web@igp.gob.pe">web@igp.gob.pe</a>
                          </p>
                    </div>
              </div>
          </div>
</div>
</body>
</html>
