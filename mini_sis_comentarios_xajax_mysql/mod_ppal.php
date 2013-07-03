<?php
 
function ms_connect(){
    
      $conex = @mysql_connect('localhost','root','igpmysqlr00t');

      if(is_resource($conex)){
         if(!@mysql_select_db('convenios'))
	    die('Error: no se puede seleccionar la base de datos.');
         else
             return $conex;
      }else
         die('Error: no se puede conectar con la base de datos.');
}

function ms_insert($sIdEmpleado,$sNombre,$sEmail,$sComentario,$sNro_solicitud){
    
   if(empty($sNombre) or empty($sEmail) 
      or empty($sComentario)) return false;
       
   $conex = ms_connect();
   $sSQL  = "INSERT INTO comentarios ";
   $sSQL .= "(idempleado,nombre,email,comentario,nrosolicitud) VALUES ('";
   $sSQL .= mysql_real_escape_string(trim($sIdEmpleado))."','";
   $sSQL .= mysql_real_escape_string(trim($sNombre))."','";
   $sSQL .= mysql_real_escape_string(trim($sEmail))."','";
   $sSQL .= mysql_real_escape_string(trim($sComentario))."','";
   $sSQL .= mysql_real_escape_string(trim($sNro_solicitud))."');";
   
   
           
   //exit($sSQL);
   mysql_query($sSQL,$conex);

   $id = mysql_insert_id($conex);
   ms_close($conex);
   
   return $id ? $id : false;
}

function ms_query($nroSolicitud){

   //$sSQL   = 'SELECT nombre, comentario, idempleado FROM comentarios';
   $sSQL   = 'SELECT                 
                ExtractValue(empleado_data,\'empleado/dni\') dni,
                ExtractValue(empleado_data,\'empleado/name\') empleado_name,
                ExtractValue(empleado_data,\'empleado/surname\') empleado_surname,
                c.comentario,e.idempleado FROM comentarios c, empleado e 
                WHERE c.idempleado=e.idempleado 
                AND c.nrosolicitud='.$nroSolicitud.' ' ;
                
                        
   $conex  = ms_connect();
   $result = mysql_query($sSQL,$conex);

   if(is_resource($result) and  mysql_num_rows($result)>0){
      $data = array();
      while ($row = mysql_fetch_array($result, MYSQL_NUM)){
         $data[] = get_array_filter($row);  
      }

      if (count($data[0])==0){
        $data["count"]=count($data);
      }
      
      mysql_free_result($result);
      ms_close($conex);
      return $data;
      
   }else
      return false;
}
   
function ms_close($conex){
    if(is_resource($conex)) mysql_close($conex);
}   

// filtra el contenido a mostrar
function get_array_filter($quien){
       
   if(is_array($quien)){

      foreach($quien as $id => $sValor){
         $quien[$id] = get_array_filter($sValor);
      }
      return $quien;
      
   }else
      return htmlspecialchars($quien, ENT_QUOTES);
}
   
// valida Email
function no_es_email_valido($sEmail){

   if(empty($sEmail)) return true;
    
   // primero validamos la longuitud
   if ((strlen($sEmail) < 6) or (strlen($sEmail) > 100)) 
     return 'Error: debe tener entre 6 y 100 caracteres.';

  else{
$patron="/^[_a-zA-Z0-9-ñÑ]+(\\.[_a-zA-Z0-9-ñÑ]+)*@+([_a-zA-Z0-9-
]+\\.)*[a-zA-Z0-9-]{2,100}\\.[a-zA-Z]{2,6}$/";
     return (!preg_match($patron,$sEmail) 
      ? 'Error: email incorrecto' : false);
  }
}
 
// validara los campos "nombre y comentarios"
function no_es_valida_cadena($sCadena,$sCampo){

  if(empty($sCadena) or empty($sCampo)) return true;

   if (!es_correcta_cadena($sCadena))
      return 'Error: solo caracteres alfanumericos, espacios, apóstrofe.';

   else{
	$min = $sCampo == 'comentarios' ? 5 : 3;
        $max = $sCampo == 'comentarios' ? 512 : 52;

        if ((strlen($sCadena) < $min) or (strlen($sCadena) > $max))
           return "Error: debe tener entre $min y $max caracteres.";
        else
           return false;
   }
}
 
// se compara el campo de confirmacion
function es_correcta_cadena($sCadena){

   if(empty($sCadena)) return false;
   return preg_match("/^[0-9a-z_ÑÁÉÍÓÚÄËÏÖÜñáéíóüäëïöü.,\'\s]*$/i",$sCadena);
}
?>
