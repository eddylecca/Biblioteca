<?php

// incluimos la clase
require_once("xajax/xajax_core/xajax.inc.php");
 
// incluimos las funciones generales
require_once("mod_ppal.php");

// creamos una instancia al objeto XAJAX:
$xajax = new xajax();

// valida el campo pasado por parametro
function form_manage($form,$sCampo){
    
   // obtenemos el valor del campo
   $sValorCampo = trim($form["txt_$sCampo"]);
   $sMsj        = '';//inicializamos

   // iniciamos las validaciones ***
   if (empty($sValorCampo))// si el campo está vacio
      $sMsj = ' éste campo es obligatorio.';

   elseif ($sCampo == 'nombre' or $sCampo == 'comentarios')
         $sMsj = no_es_valida_cadena($sValorCampo,$sCampo);
      
   elseif ($sCampo == 'email')
         $sMsj = no_es_email_valido($sValorCampo);

   // asignamos el valor que determinara la imagen 
   // y el mensaje a mostrar por campo
   $sImg = ($sMsj===false ? 'correcto' : 'incorrecto');
 
   // asignamos el mensaje por campo..
   $sHTMLMsj = "<img border='0' src='imagenes/$sImg.png' />"
               .($sImg == 'incorrecto' ? $sMsj : '');
 
   // creamos una nueva instancia para generar
   // la respuesta con ajax (xajaxResponse).
   $objRespuesta = new xajaxResponse();
   
   // mostraremos la cantidad de caracteres del txt_comentarios
   if(!empty($form['txt_comentarios']))
       $objRespuesta->assign('total_caracteres','innerHTML'
               ,strlen(trim($form['txt_comentarios'])));
   else
       $objRespuesta->assign('total_caracteres','innerHTML', '0');
   //---------------------------------------------------------------------------
   
   // actualizamos los div
   $objRespuesta->assign("error_$sCampo",'innerHTML', $sHTMLMsj);

   // retornamos el objeto
   return $objRespuesta;
}

function form_process($form){

   // creamos una nueva instancia para generar la respuesta con ajax
   $objRespuesta = new xajaxResponse();
 
   // si los campos no estan correctos 
   if (no_es_valida_cadena($form['txt_nombre'],'nombre') or
       no_es_email_valido($form['txt_email']) or
       no_es_valida_cadena($form['txt_comentarios'],'comentarios')){

      $objRespuesta->alert('¡El formulario debe estar perfectamente validado!');
      
   }else{
       
       if (ms_insert($form['txt_nombre'],$form['txt_email']
               ,$form['txt_web'],$form['txt_comentarios'])){
         
               //
               $objRespuesta->alert('¡tu comentario ha sido agregado!');
               $objRespuesta->redirect('index.php');
      }else
          $objRespuesta->alert('¡el comentario no pudo ser agregado!');
      
      // limpiamos los campos -------------------------------------
      $ArrayCampos = array('nombre','email','web','comentarios'); 
      foreach($ArrayCampos as $sValor){
         $objRespuesta
            ->clear("txt_$sValor",'value')
            ->clear("error_$sValor",'innerHTML');
      }
   }
   return $objRespuesta;
}

function html_comentarios(){
    
    $arrComentarios = ms_query();
    if(is_array($arrComentarios)){
       $c=1;
       foreach($arrComentarios as $arrComentario){
          // $arrComentario[0] => nombre
          // $arrComentario[1] => comentario
          echo '<div id="comment_box"><div class="numero">'.$c++
            .'</div><div class="avatar_default"></div>
            <div class="autor"><b>'.$arrComentario[0]
            .'</b> dijo ..</div>
            <div class="contenido">'.$arrComentario[1]
            .'</div></div>';
       }
    }else
        echo '<div class="highlight">No se encontraron comentarios..</div>';
}

$xajax->registerFunction('form_manage');  // gestiona las validaciones del formulario
$xajax->registerFunction('form_process'); // procesa los datos del formulario

// le indicamos al objeto xajax que procese la peticion / el pedido
$xajax -> processRequest();

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="css/estilo.css" rel="stylesheet" />
  <title>XAJAX-MySQL: mini sistema de comentarios</title>
  <?php 
    //se le dice que incluya el JavaScript generado desde XAJAX
    $xajax->printJavascript('xajax/'); 
  ?>
</head>
<body>
  <div id='main'>

   <div id="tablon"><?php echo html_comentarios(); ?></div>
   <div id='clear'></div>

   <div id="comment_area">
     <h3>Deja un comentario</h3>
     <p class='nota'>Tu Email NO será publicado. Los campos marcados con asteriscos 
     (<span class="requerido">*</span>) son obligatoríos.</p>
     
     <form action='javascript:void(null);' method="post" 
           id="form_comment" name="form_comment" 
     onsubmit="xajax_form_process(xajax.getFormValues('form_comment'))">
				
       <p class='campo'>Nombre: <span class="requerido">*</span> 
         <input tabindex='1' id="txt_nombre" name="txt_nombre" size="29" 
                type="text" maxlenght="20" 
         onkeyup="xajax_form_manage(xajax.getFormValues('form_comment'),'nombre')"
         onblur="xajax_form_manage(xajax.getFormValues('form_comment'),'nombre')" /> 
         <span class="error" id='error_nombre'></span>
       </p>

       <p class='campo'>Email: <span class="requerido">*</span> 
         <input tabindex='2' id="txt_email" name="txt_email" size="30" 
                 type="text" value='@' maxlenght="100" 
         onkeyup="xajax_form_manage(xajax.getFormValues('form_comment'),'email')"
         onblur="xajax_form_manage(xajax.getFormValues('form_comment'),'email')" />
         <span class="error" id="error_email"></span>
       </p>

       <p class='campo'>Web:
         <input tabindex='3' id="txt_web" name="txt_web" 
           value="http://" size="32" maxlenght="100" type="text" />
       </p>

       <p class='campo'>Comentario: <span class="requerido">*</span> 
           <span class="error" id="error_comentarios"></span></p>
       <p class='campo'>
          <textarea tabindex='4' class='estilotextarea' id="txt_comentarios" 
                    name="txt_comentarios" 
          onkeyup="xajax_form_manage(xajax.getFormValues('form_comment'),'comentarios')"
          onblur="xajax_form_manage(xajax.getFormValues('form_comment'),'comentarios')" />
          </textarea>
          <span class="total_caracteres" id="total_caracteres">0</span>
       </p>

       <p class='submit'>
           <input tabindex='5' name="submit" id="submit" 
               value="Publicar comentario" type="submit" />
       </p>
     </form>
   </div>
 </div>
</body>
</html>