<?php

	/**************************************************
	Contiene funciones que modelan el ingreso de datos
	
	***************************************************/
	
	function searchCategorySQL($sessionidarea=0){
	
            $and="";
            if(isset($sessionidarea)){
                if($sessionidarea==11 or $sessionidarea==12 or $sessionidarea==13 or $sessionidarea==14){
                    $and=" and idcategory=4";
                }
                
            }
            
            
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	    $sql = "SELECT * FROM category WHERE category_enable=1 ".$and;
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idcategory"][$i]= $row["idcategory"];
	            $result["category_description"][$i]= $row["category_description"];
	            $i++;
	        }
	
	        if(isset($result["idcategory"])){
	            $result["Count"]=count($result["idcategory"]);
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

	
	function newReferenceRegisterSQL($action, $form){
		$result["Count"]="";
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		$idarea=$_SESSION["idarea"];
                $subcategory=$_SESSION["subcategory"];
                $idsubcategory=$_SESSION["idsubcategory"];
	                
	    $reference=addslashes(trim($form["nreferencia"]));
	    $abrev=$form["abrev"];
	
	    /******Verificar si existe referencia******/
	    $campo='where reference_description like "'.$reference.'" ';
            $campo.=" and idsubcategory='$idsubcategory' and idarea=$idarea and reference_enable=1";
	    $sql="select * from reference ".$campo;
	
	    $i=0;
	    if($dbh->query($sql)){
	
	        foreach($dbh->query($sql) as $row) {
	            $result["idreference"][$i]= $row["idreference"];
	            $i++;
	        }
	
	        if(isset($result["idreference"])){
	                for($i=0;$i<count($result["idreference"]);$i++){
	                        $result["idreference"]=$result["idreference"][$i];
	                }
	                $result["Count"]=count($result["idreference"]);                
	        }
			$idarea=$_SESSION["idarea"];
			$subcategory=$_SESSION["subcategory"];
			$idsubcategory=$_SESSION["idsubcategory"];
	
			if($result["Count"]==""){
			    if ($action=="INS"){
			        $sql="insert into reference(idsubcategory,idarea,reference_description,reference_abrev,reference_enable)
			        values ($idsubcategory,$idarea,'$reference','$abrev',1)";
			    }
			
			    if($dbh->query($sql)){
			        $result["Error"]=0;
			        $result["Msg"]="Se registro correctamente";
			        //$result["sql"]=$sql;
			    }
			    else{
			        $result["Error"]=1;
			        $result["Msg"]="No se ejecuto el insert";
			        //$result["sql"]=$sql;
			    }
			
			/************/
			
		        foreach($dbh->query("SELECT * FROM reference order by idreference desc limit 1") as $row) {
		            $result["idreferenceultimo"][0]= $row["idreference"];
		            $result["reference_description_ultimo"][0]= $row["reference_description"];
		
		        }
		        if(isset($result["idreferenceultimo"])){
		                        $result["idreferenceultimo"]=$result["idreferenceultimo"][0];
		                        $result["reference_description_ultimo"]=$result["reference_description_ultimo"][0];
		
		        }
			
			/************/
		        $dbh = null;
		        $result["Query"]=$sql;
			
		   }
		    else{
		        $result["Error"]=1;
		        $result["Msg"]="Existe Referencia";
		    }
		}
		else{
		    $result["Error"]=1;
		    $result["Msg"]="No se ejecuto el select de verificación";
		}
		
		return $result;
	
	}
	
	function registerReferenciaSQL($action, $form){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		$referencia=$form["referencia"];
		$abrev=$form["abrev"];
	
        if ($action=="INS"){

            $sql="insert into reference(idsubcategory,idarea,reference_description,reference_abrev,reference_enable)";
            $sql.="values (1,1,'$referencia','$abrev',1)";
        }
	
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	    return $result;
	
	}
	
	function registraReferenciaSQL($referencia="",$abrev=""){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
        $sql="insert into reference(idsubcategory,idarea,reference_description,reference_abrev,reference_enable)
        values (1,1,'$referencia','$abrev',1)";

        if($dbh->query($sql)){
            $result["Error"]=0;
        }
        else{
            $result["Error"]=1;
        }

/************/
         
        foreach($dbh->query("SELECT * FROM reference order by idreference desc limit 1") as $row) {
            $result["idreferenceultimo"][0]= $row["idreference"];
            $result["reference_description_ultimo"][0]= $row["reference_description"];
            
        }

        if(isset($result["idreferenceultimo"])){
			$result["idreferenceultimo"]=$result["idreferenceultimo"][0];
			$result["reference_description_ultimo"]=$result["reference_description_ultimo"][0];
                        
        }
/************/

        $dbh = null;
        $result["Query"]=$sql;
	
	        
	    return $result;
	
	
	}
	
	function searchAuthorSessionSQL($strSQL=""){
	
		$dbh=conx("biblioteca_virtual","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	
		//$sAuthor vale Ejm. 1,2,3
		//se lo pasamos al sql
		//ORDER BY field = ordenar los id's deacuerdo como estan definidos en IN
		        //Ejm. IN (571,1) devuelve el listado de la consulta en ese orden
		        //$sql = "select * from author ";
		        //$sql.= "where idauthor in ($strSQL)";
	
		if($strSQL!=""){
		        $sql = "select * from author ";
		        //$sql.= "where idauthor in ('$strSQL')";
		        $sql.= "where idauthor in ($strSQL) ORDER BY field(idauthor, $strSQL)";
		        $i=0;
		
			if($dbh->query($sql)){
			        foreach($dbh->query($sql) as $row) {
			            $result["idauthor"][$i]= $row["idauthor"];
			            $result["author_name"][$i]= $row["author_name"];
			            $result["author_surname"][$i]= $row["author_surname"];
			            $i++;
			        }   
			                if(isset($result["idauthor"])){
			                    $result["Error"]=0;
			                    $result["Query"]=$sql;
			                    $result["Count"]=count($result["idauthor"]);
			
			                }
			                else{
			                    $result["Error"]=1;
			                    //$result["Count"]=count($result["idauthor"]);
			                    $result["Count"]=0;
			                }
			}
		}
	    else{
	        $result["Error"]=2;
	        //$result["Query"]=$sql;
	    }
	
	    $dbh = null;
	
	    return $result;
	}
	
	function searchAuthorSQL($idSearch,$currentPage,$pageSize,$sAuthor="",$strSQL=""){
		$notin=" where author_enabled=1 ";
		$notin2=" and author_enabled=1 ";
	    if($strSQL!=""){
	        $notin= " where idauthor not in ($strSQL) and author_enabled=1 ";
	        $notin2= " and idauthor not in ($strSQL) and author_enabled=1 ";
	    }
	    $dbh=conx("biblioteca_virtual","wmaster","igpwmaster");
	    $dbh->query("SET NAMES 'utf8'");
	
		if($idSearch=="AUTHOR"){
		    $limitIni = ($currentPage-1)*$pageSize;
		    $limitLon = $pageSize;
		
		    if($sAuthor==""){
		        $sql="select * from author $notin order by author_surname LIMIT $limitIni,$limitLon";
		    }
		    else{
		        $campo=' where author_surname like "'.$sAuthor.'%" '.$notin2.' LIMIT '.$limitIni.','.$limitLon.' ';
		        $sql="select * from author ".$campo;
		    }
		}
	
		if($idSearch=="ALL"){
		
		    if($sAuthor==""){        
		        $sql="select * from author $notin ";
		    }
		    else{
		        $campo="where author_surname like '$sAuthor%' $notin2 ";
		        $sql="select * from author ".$campo;
		    }
		}
	
	    $i=0;
	    if($dbh->query($sql)){
	
	        foreach($dbh->query($sql) as $row) {
	            $result["idauthor"][$i]= $row["idauthor"];
	            $result["author_name"][$i]= $row["author_name"];
	            $result["author_surname"][$i]= $row["author_surname"];
	            $i++;
	        }
	                if(isset($result["idauthor"])){
	                    $result["Error"]=0;
	                    $result["Query"]=$sql;
	                    $result["Count"]=count($result["idauthor"]);
	
	                }
	                else{
                            
                            $result["Error"]=1;
                            $result["sAuthor"]=$sAuthor;
                            /*
                            if($inAutor){
	                    $result["Error"]=3;
                            $result["Msg"]="<h5><p>El Autor ha sido asociado a la publicación";
                            $result["result_array"]=$result_array;
                            }
                            elseif($inAutor==""){
	                    $result["Error"]=1;
                            $result["Msg"]="<h5><p>No existe el autor registrelo como nuevo";
                            }
                            */
                        
	                }
	    }
	    else{
	        $result["Error"]=2;
	        $result["Query"]=$sql;
	    }
	
	    $dbh = null;
	    $result["strSQL"]=$strSQL;
            $result["Query"]=$sql;
	    return $result;
	}

	
	function searchReferenciaSQL($txt_referencia=""){
	
	    $dbh=conx("DB_ITS","wmaster","igpwmaster");
            $dbh->query("SET NAMES 'utf8'");
	    /******Verificar si existe referencia******/
	
	    $campo="where reference_description like '".$txt_referencia."' ";
	    $sql="select * from reference ".$campo;
	
	    $i=0;
	    if($dbh->query($sql)){
	
	        foreach($dbh->query($sql) as $row) {
	            $result["idreference"][$i]= $row["idreference"];
	            $i++;
	        }
	
	        if(isset($result["idreference"])){
	                for($i=0;$i<count($result["idreference"]);$i++){
	                        $result["idreference"]=$result["idreference"][$i];
	                }
	                $result["Count"]=count($result["idreference"]);
	                $result["Error"]=1;
	        }
	        else{
	                $result["Error"]=0;
	                    $result["Count"]=0;
	        }
	    }
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	function registraAuthorSQL($form_entrada){
	
		$dbh=conx("biblioteca_virtual","wmaster","igpwmaster");
                $dbh->query("SET NAMES 'utf8'");
                
	        $author_name=$form_entrada["author_name"];
	        $author_surname=$form_entrada["author_surname"];
                
	    /******Verificar si existe autor******/
	    $campo=' where author_name = "'.$author_name.'" and author_surname = "'.$author_surname.'"  ';
	    $sql='select * from author '.$campo;
	
	    $i=0;
	    if($dbh->query($sql)){
	          
	        foreach($dbh->query($sql) as $row) {
	            $result["idauthor"][$i]= $row["idauthor"];
	            $i++;
	        }
	
	        if(isset($result["idauthor"])){
	                for($i=0;$i<count($result["idauthor"]);$i++){
	                        $result["idauthor"]=$result["idauthor"][$i];
	                }
	                $result["Count"]=count($result["idauthor"]);                
	        }
	
	        else{
	                $result["Count"]=0;
	        }
	
	    
		    if($result["Count"]==0){
		        $sql='insert into author(author_name,author_surname,author_enabled)
		        values ("'.$author_name.'","'.$author_surname.'",1)';
		
		        $dbh->query($sql);
		
				/************/
		        foreach($dbh->query("SELECT * FROM author order by idauthor desc limit 1") as $row) {
		            $result["idauthorultimo"][0]= $row["idauthor"];
		            $i++;
		        }
		
		        if(isset($result["idauthorultimo"])){
		                        $result["idauthorultimo"]=$result["idauthorultimo"][0];
		        }
				/************/
		        
		        $dbh = null;
		        $result["Error"]="registrado";
		        $result["Msg"]="Registrado Correctamente";
		        $result["author_surname"]=$author_surname;
		  	}
			else{
		        //$result["Error"]=3;
		        $result["Error"]="existe";
                        $result["Msg"]="Existe Autor";
		
		    }
	
	
	    }
	    else{
	        $result["Error"]=4;
                $result["Msg"]="Error en la consulta de existencia";
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	    
	    return $result;
	
	
	}
	
	function searchPublication_iddataSQL($idcategory,$searchText,$iddata=0){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	        if($iddata!=0){
	            $sql = "SELECT * FROM book b WHERE idbook=$iddata";
	        }
	        else{
	            $sql = "SELECT * FROM data d, subcategory s WHERE d.idsubcategory=s.idsubcategory";
	            $sql .=	" AND s.idcategory=$idcategory  AND d.data_content like '%$searchText%'";
	        }
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idbook"][$i]= $row["idbook"];
	            $result["book_data"][$i]= $row["book_data"];         
	
	            $i++;
	        }
	
	        if(isset($result["idbook"])){
	            $result["Count"]=count($result["idbook"]);
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
	
	function verificaUsuarioSQL($formLogin){
	
	        $usuario=trim($formLogin["usuario"]);
	        $clave=md5(trim($formLogin["clave"]));
	
		$dbh=conx("biblioteca_virtual","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	        //$sql="select a.idarea,a.area_description, u.idusers, u.users_name, u.users_type from area a, users u where a.idarea=u.idarea and u.users_name='$usuario' and users_password='$clave' and users_type='1'";
                $sql="select idusers, users_name, users_type from users u where u.users_name='$usuario' and users_password='$clave' and users_state='1'";
                
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {	            
                    $result["idusers"][$i]=$row["idusers"];
	            $result["users_name"][$i]=$row["users_name"];
	            $result["users_type"][$i]=$row["users_type"];
	            $i++;
	        }
	
	        if(isset($result["idusers"])){
	                for($i=0;$i<count($result["idusers"]);$i++){
                                $result["idusers"]=$result["idusers"][$i];
	                        $result["users_name"]=$result["users_name"][$i];
	                        $result["users_type"]=$result["users_type"][$i];
	                }
	                $result["Count"]=count($result["idusers"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	    }
	else{
	    $result["Error"]=1;
	    $result["Msg"]="No se ejecuto el select";
	    
	}
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	                return $result;
	
	}
	

	/**************************************************
	
	***************************************************/       
	function recuperarClaveSQL($user,$correo){
	
                /*
	        $usuario=trim($formLogin["usuario"]);
	        $clave_old=md5(trim($clave_old));
                $clave_new=md5(trim($clave_new));
                */
            
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	        //$sqlSelect="select a.idarea,a.area_description, u.idusers, u.users_name, u.users_type from area a, users u where a.idarea=u.idarea and u.users_name='$usuario' and users_password='$clave' and users_type='1'";
                $sqlSelect="select * from users where users_name='$user' and users_email='$correo' and users_type='1'";
                
                $i=0;
                $result="";
                if($dbh->query($sqlSelect)){
                    foreach($dbh->query($sqlSelect) as $row) {
                        $result["idusers"][$i]= $row["idusers"];
                        $result["users_name"][$i]=$row["users_name"];
                        $result["users_email"][$i]=$row["users_email"];
                        $result["users_type"][$i]=$row["users_type"];
                        
                    }
                    
	        if(isset($result["idusers"])){
                    $result["Msg"]="se ejecuto select";
	                for($i=0;$i<count($result["idusers"]);$i++){
	                        $result["idusers"]=$result["idusers"][$i];
	                        $result["users_name"]=$result["users_name"][$i];
                                $result["users_email"]=$result["users_email"][$i];
	                        $result["users_type"]=$result["users_type"][$i];                                
                        }
                        $result["Count"]=count($result["idusers"]);
                }
	        else{
	            $result["Count"]=0;                    
	        }
                
                
                if($result["Count"]>0){
                    /*
                    $sqlUpdate="update users set users_password='$clave_new', users_email='$correo' where idusers=$iduser ";

                    if($dbh->query($sqlUpdate)){
                    */
                        $mensaje="Usuario y Correo coinciden";

                        $result["Error"]=0;
                        $result["Msg"]=$mensaje;
                        
                    /*}
                    else{
                        $result["Error"]=1;
                        $result["Msg"]="No se pudo realizar la consulta";
                    }*/
                }
                else{
                    $result["Error"]=1;
                    $result["Msg"]="Usuario y Correo no coinciden";
                }
                
	    }
	else{
	    $result["Error"]=1;
	    $result["Msg"]="No se ejecuto el select";
	    
	}
                
	    $dbh = null;
	    $result["Query_select"]=$sqlSelect;
            //$result["Query_update"]=$sqlUpdate;
	
            return $result;
	
	}

        
        
        
	/**************************************************
	
	***************************************************/              
        function cambiarTempClaveSQL($iduser,$user,$correo,$clave_temp){
            
                $dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                
                $clave_temp=md5(trim($clave_temp));
                
                $sqlUpdate="update users set users_password='$clave_temp', users_email='$correo' where idusers=$iduser ";
                
                if($dbh->query($sqlUpdate)){

                    $mensaje="Se ha asignado una clave nueva";

                    $result["Error"]=0;
                    $result["Msg"]=$mensaje;
                }
                else{
                    $result["Error"]=1;
                    $result["Msg"]="No se pudo realizar la actualización";
                }
                
                $dbh = null;
                $result["Query_update"]=$sqlUpdate;
                return $result;
        }
        
	/**************************************************
	
	***************************************************/       
	function cambiarClaveSQL($clave_old,$clave_new,$correo,$iduser){
	
	        //$usuario=trim($formLogin["usuario"]);
	        $clave_old=md5(trim($clave_old));
                $clave_new=md5(trim($clave_new));
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	        //$sqlSelect="select a.idarea,a.area_description, u.idusers, u.users_name, u.users_type from area a, users u where a.idarea=u.idarea and u.users_name='$usuario' and users_password='$clave' and users_type='1'";
                $sqlSelect="select * from users where idusers='$iduser' and users_password='$clave_old' and users_type='1'";
                
                $i=0;
                if($dbh->query($sqlSelect)){
                    foreach($dbh->query($sqlSelect) as $row) {
                        $result["idusers"][$i]= $row["idusers"];
                    }
                    
	        if(isset($result["idusers"])){
                    //$result["Msg"]="se ejecuto select";
	                for($i=0;$i<count($result["idusers"]);$i++){
	                        $result["idusers"]=$result["idusers"][$i];
                        }
                        $result["Count"]=count($result["idusers"]);
                }
	        else{
	            $result["Count"]=0;                    
	        }
                
                
                if($result["Count"]>0){
                    $sqlUpdate="update users set users_password='$clave_new', users_email='$correo' where idusers=$iduser ";

                    if($dbh->query($sqlUpdate)){

                        $mensaje="Clave cambiada correctamente";

                        $result["Error"]=0;
                        $result["Msg"]=$mensaje;
                    }
                    else{
                        $result["Error"]=1;
                        $result["Msg"]="No se pudo realizar la consulta";
                    }
                }
                else{
                    $result["Msg"]="Clave Incorrecta";
                }
                
	    }
	else{
	    $result["Error"]=1;
	    $result["Msg"]="No se ejecuto el select";
	    
	}
                
	    $dbh = null;
	    $result["Query_select"]=$sqlSelect;
            $result["Query_update"]=$sqlUpdate;
	
            return $result;
	
	}
	
	/**************************************************
	
	***************************************************/
	function registerThemeSQL($action, $form){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	    $idarea=$form["selectArea"];
	    $theme_description=$form["theme_description"];
	
	    if ($action=="INS"){
	        $sql="INSERT INTO theme(idarea,theme_description)";
	        $sql.=" VALUES($idarea,'$theme_description')";
	    }
	
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	    return $result;
	
	}
	
	
	function searchThemeSQL($type,$idarea){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
	
	    if($type=="single"){
	        $sql = "SELECT * FROM theme WHERE idarea=$idarea";
	    }
	
	    if($type=="range"){
	        $sql = "SELECT * FROM theme WHERE idarea IN ($idarea)";
	    }
	
	    $i=0;
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idtheme"][$i]= $row["idtheme"];
	            $result["theme_description"][$i]= $row["theme_description"];
	            $i++;
	        }
	
	        if(isset($result["idtheme"])){
	            $result["Count"]=count($result["idtheme"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    if($result["Count"]!=0){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	function searchOtherAreaSQL($idarea=""){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		if ($idarea==""){
			$sql = "SELECT * FROM area where area_enable=1";
		}
		else{
			$sql = "SELECT * FROM area WHERE idarea<>$idarea and area_enable=1";
		}
	    
	    $i=0;
	
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idarea"][$i]= $row["idarea"];
	            $result["area_description"][$i]= $row["area_description"];
	            $i++;
	        }
	        $result["Count"]=count($result["idarea"]);
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	function searchStatus($idstatus=0){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		if ($idstatus==0){
			$sql = "SELECT * FROM status";
		}
		else{
			$sql = "SELECT * FROM status WHERE idstatus=$idstatus";
		}
	
	    $i=0;
	
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idstatus"][$i]= $row["idstatus"];
	            $result["status_description"][$i]= $row["status_description"];
	            $i++;
	        }
	        $result["Count"]=count($result["idstatus"]);
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	
	function searchPermission($idpermission=""){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		if ($idpermission==""){
			$sql = "SELECT * FROM permission WHERE permission_enable=1";
		}
		else{
			$sql = "SELECT * FROM permission WHERE permission_enable=1 AND idpermission=$idpermission ";
		}
	
	    $i=0;
	
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idpermission"][$i]= $row["idpermission"];
	            $result["permission_description"][$i]= $row["permission_description"];
	            $i++;
	        }
	        $result["Count"]=count($result["idpermission"]);
	        $result["Error"]=0;
	
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
	
	    return $result;
	}
	
	function newPublicationSQL($action,$iddata=0,$idsubcategory,$xml){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                
                switch ($idsubcategory) {
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
                
	    if ($action=="INS"){
	        $sql="INSERT INTO data(idsubcategory,data_content)";
	        $sql.=" VALUES($idsubcategory,'$xml')";
                $mensaje=$desc_subcategory." guardado correctamente";
	    }
	
	    if ($action=="UPD"){
	        $sql="UPDATE data SET idsubcategory=$idsubcategory";
	        $sql.=", data_content='$xml'";
	        $sql.="WHERE iddata=$iddata";
                $mensaje=$desc_subcategory." actualizado correctamente";
	    }
		
	    if($dbh->query($sql)){
	        $result["Error"]=0;
                $result["Msg"]=$mensaje;
	    }
	    else{
	        $result["Error"]=1;
                $result["Msg"]="No se pudo realizar la consulta";
	    }
	
	    $dbh = null;
            
	    $result["Query"]=$sql;
            
            
            
	    return $result;
	
	}
	
	function newPonenciaSQL($action,$iddata=0,$idsubcategory,$xml){
		$dbh=conx("biblioteca_virtual","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                
/********************************************************
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idsubcategory =4";   
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
            

if($result["Count"]>=1){
    $result["existe"]=1;
    $result["Msg"]="Existe";
}
else{
/*******************************************************/
	    if ($action=="INS"){
	        $sql="INSERT INTO book(book_data, book_enabled)";
	        $sql.=" VALUES('$xml',1)";
	    }
	
	    if ($action=="UPD"){
	        $sql="UPDATE data SET";
	        $sql.="book_data='$xml'";
	        $sql.="WHERE iddata=$iddata";
	    }
		
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	        $result["Msg"]="error";
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
            
	    $result["Query"]=$sql;
            
            //$result["Query1"]=$sql1;
//}            
	    return $result;
	
	}

    function newInformacionInternaSQL($action,$iddata=0,$idsubcategory,$xml){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                $desc_subcategory="";
        if($idsubcategory==6){
                $desc_subcategory="Reporte Técnico";
            $result["Count"]=0;
            $sql1="";
            $result["existe"]=0;
                
        }
        elseif($idsubcategory==7){
                $desc_subcategory="Informe Trimestral";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $yearQuarter=isset($recuperar["yearQuarter"])?$recuperar["yearQuarter"]:"";
                $idquarter=isset($recuperar["idquarter"])?$recuperar["idquarter"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                
                /********************************************************/
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=7 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($yearQuarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/yearQuarter') LIKE '%".$yearQuarter."%'";
                }
                
                if($idquarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idquarter')='".$idquarter."'";
                }
                
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        elseif($idsubcategory==8){
                $desc_subcategory="Boletín Sísmico";                
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $nroBoletin=isset($recuperar["nroBoletin"])?$recuperar["nroBoletin"]:"";
                $year_pub=isset($recuperar["year_pub"])?$recuperar["year_pub"]:"";
                
                $idRegion=isset($recuperar["idRegion"])?$recuperar["idRegion"]:"";
                $idDepartamento=isset($recuperar["idDepartamento"])?$recuperar["idDepartamento"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                $idmagnitud=isset($recuperar["idmagnitud"])?$recuperar["idmagnitud"]:"";
                 
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=8 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;

                
                if($nroBoletin!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/nroBoletin') ='".$nroBoletin."'";
                }
                
                if($year_pub!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/year_pub') ='".$year_pub."'";
                }
                
                
                /*
                if($idRegion!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idRegion') ='".$idRegion."'";
                }
                
                if($idDepartamento!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idDepartamento')='".$idDepartamento."'";
                }
                
                if($idmagnitud!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idmagnitud')='".$idmagnitud."'";
                }
                  */  
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        else{
            $result["Count"]=0;
            $sql1="";
            $result["existe"]=0;
        }


/*        
if($result["Count"]>=1){
    $result["existe"]=1;
    $result["Msg"]="El $desc_subcategory ya existe";
    $result["Query1"]=$sql1;
}
else{
            $result["existe"]=0;

	    if ($action=="INS"){
	        $sql="INSERT INTO data(idsubcategory,data_content)";
	        $sql.=" VALUES($idsubcategory,'$xml')";
	    }
	
	    if ($action=="UPD"){
	        $sql="UPDATE data SET idsubcategory=$idsubcategory";
	        $sql.=", data_content='$xml'";
	        $sql.="WHERE iddata=$iddata";
	    }
		
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
}
*/
        
/************/
if ($action=="INS"){
    $msg="";
    $sql="";
    if(isset($result["Count"])){
        if($result["Count"]>=1){            
            $mensaje="El $desc_subcategory ya existe";
            $result["Error"]=1;
            $result["Query1"]=$sql1;
        }
        else {
            $result["Error"]=0;
            $sql="INSERT INTO data(idsubcategory,data_content)";
            $sql.=" VALUES($idsubcategory,'$xml')";
            $mensaje="El $desc_subcategory ha sido guardado correctamente";
        }
    }
}

if ($action=="UPD"){
    $msg="";
    $sql="";  
    /*if(isset($result["Count"])){
        if($result["Count"]>=1){
            $msg="El $desc_subcategory ya existe";
            $result["Error"]=1;
            $result["Query1"]=$sql1;
        }
        else { */
    $sql="UPDATE data SET idsubcategory=$idsubcategory";
    $sql.=", data_content='$xml'";
    $sql.="WHERE iddata=$iddata";
    
    $mensaje="El $desc_subcategory ha sido actualizado correctamente";    
//}
//    }
    
    }
	    if($dbh->query($sql)){
	        $result["Error"]=0;
                $result["Msg"]=$mensaje;
	    }
	    else{
	        $result["Error"]=1;
                $result["Msg"]=$mensaje;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;

/***********/

	    return $result;
	
	}
        
    function newGeofisicaSociedadSQL($action,$iddata=0,$idsubcategory,$xml){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                $desc_subcategory="";
        if($idsubcategory==7){
                $desc_subcategory="Informe Trimestral";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $yearQuarter=isset($recuperar["year"])?$recuperar["year"]:"";
                $idquarter=isset($recuperar["idquarter"])?$recuperar["idquarter"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=7 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($yearQuarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$yearQuarter."%'";
                }
                
                if($idquarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idquarter')='".$idquarter."'";
                }
                
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        elseif($idsubcategory==13){
                $desc_subcategory="Informe Trimestral";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $yearQuarter=isset($recuperar["year"])?$recuperar["year"]:"";
                $idquarter=isset($recuperar["idquarter"])?$recuperar["idquarter"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =5 AND s.idsubcategory=13 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($yearQuarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$yearQuarter."%'";
                }
                
                if($idquarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idquarter')='".$idquarter."'";
                }
                
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }        
        elseif($idsubcategory==8){
                $desc_subcategory="Boletínes Sísmicos";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $idRegion=isset($recuperar["idRegion"])?$recuperar["idRegion"]:"";
                $idDepartamento=isset($recuperar["idDepartamento"])?$recuperar["idDepartamento"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                $idmagnitud=isset($recuperar["idmagnitud"])?$recuperar["idmagnitud"]:"";
                 
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=8 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($idRegion!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idRegion') ='".$idRegion."'";
                }
                
                if($idDepartamento!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idDepartamento')='".$idDepartamento."'";
                }
                
                if($idmagnitud!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idmagnitud')='".$idmagnitud."'";
                }
                    
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        else{
            $result["Count"]=0;
            $sql1="";
            $result["existe"]=0;
        }


/*        
if($result["Count"]>=1){
    $result["existe"]=1;
    $result["Msg"]="El $desc_subcategory ya existe";
    $result["Query1"]=$sql1;
}
else{
            $result["existe"]=0;

	    if ($action=="INS"){
	        $sql="INSERT INTO data(idsubcategory,data_content)";
	        $sql.=" VALUES($idsubcategory,'$xml')";
	    }
	
	    if ($action=="UPD"){
	        $sql="UPDATE data SET idsubcategory=$idsubcategory";
	        $sql.=", data_content='$xml'";
	        $sql.="WHERE iddata=$iddata";
	    }
		
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
}
*/
        
/************/
if ($action=="INS"){
    $msg="";
    $sql="";
    if(isset($result["Count"])){
        if($result["Count"]>=1){            
            $msg="El $desc_subcategory ya existe";
            $result["Error"]=1;
            $result["Query1"]=$sql1;
        }
        else {
            $result["Error"]=0;
            $sql="INSERT INTO data(idsubcategory,data_content)";
            $sql.=" VALUES($idsubcategory,'$xml')";
            $msg="El $desc_subcategory ha sido guardado correctamente";
        }
    }
}

if ($action=="UPD"){
    $sql="UPDATE data SET idsubcategory=$idsubcategory";
    $sql.=", data_content='$xml'";
    $sql.="WHERE iddata=$iddata";
    
    $msg="El $desc_subcategory ha sido actualizado correctamente";    
}

	    if($dbh->query($sql)){
	        $result["Error"]=0;
                $result["Msg"]=$msg;
	    }
	    else{
	        $result["Error"]=1;
                $result["Msg"]=$msg;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;

/***********/

	    return $result;
	
	}
	

    function newAsuntosAcademicosSQL($action,$iddata=0,$idsubcategory,$xml){
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
                $desc_subcategory="";
        if($idsubcategory==7){
                $desc_subcategory="Informe Trimestral";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $yearQuarter=isset($recuperar["year"])?$recuperar["year"]:"";
                $idquarter=isset($recuperar["idquarter"])?$recuperar["idquarter"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=7 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($yearQuarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/year') LIKE '%".$yearQuarter."%'";
                }
                
                if($idquarter!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idquarter')='".$idquarter."'";
                }
                
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        elseif($idsubcategory==8){
                $desc_subcategory="Boletínes Sísmicos";
                if(isset($_SESSION["edit"])){
                    $recuperar=$_SESSION["edit"];
                }
                elseif(isset($_SESSION["tmp"])){
                    $recuperar=$_SESSION["tmp"];
                }
                
                $idRegion=isset($recuperar["idRegion"])?$recuperar["idRegion"]:"";
                $idDepartamento=isset($recuperar["idDepartamento"])?$recuperar["idDepartamento"]:"";
                $areaPRI=isset($_SESSION["idarea"])?$_SESSION["idarea"]:"";
                $idmagnitud=isset($recuperar["idmagnitud"])?$recuperar["idmagnitud"]:"";
                 
                /********************************************************/                
                $sql1="SELECT * FROM data d, subcategory s, category c
                        WHERE d.idsubcategory = s.idsubcategory
                        AND s.idcategory = c.idcategory
                        AND s.idcategory =4 AND s.idsubcategory=8 
                        AND ExtractValue(data_content,'publicaciones/areaPRI')=".$areaPRI ;
                
                if($idRegion!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idRegion') ='".$idRegion."'";
                }
                
                if($idDepartamento!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idDepartamento')='".$idDepartamento."'";
                }
                
                if($idmagnitud!=""){
                    $sql1 .=	" AND ExtractValue(data_content,'publicaciones/idmagnitud')='".$idmagnitud."'";
                }
                    
                $i=0;
	    if($dbh->query($sql1)){
	        foreach($dbh->query($sql1) as $row) {
	            $result["iddata"][$i]= $row["iddata"];	
	            $i++;
	        }
                
	        if(isset($result["iddata"])){
	            $result["Count"]=count($result["iddata"]);
	        }
	        else{
	            $result["Count"]=0;
	        }
	               
	        $result["Error1"]=0;
	    }
	    else{
	        $result["Error1"]=1;
	    }
            
        }
        else{
            $result["Count"]=0;
            $sql1="";
            $result["existe"]=0;
        }


/*        
if($result["Count"]>=1){
    $result["existe"]=1;
    $result["Msg"]="El $desc_subcategory ya existe";
    $result["Query1"]=$sql1;
}
else{
            $result["existe"]=0;

	    if ($action=="INS"){
	        $sql="INSERT INTO data(idsubcategory,data_content)";
	        $sql.=" VALUES($idsubcategory,'$xml')";
	    }
	
	    if ($action=="UPD"){
	        $sql="UPDATE data SET idsubcategory=$idsubcategory";
	        $sql.=", data_content='$xml'";
	        $sql.="WHERE iddata=$iddata";
	    }
		
	    if($dbh->query($sql)){
	        $result["Error"]=0;
	    }
	    else{
	        $result["Error"]=1;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;
}
*/
        
/************/
if ($action=="INS"){
    $msg="";
    $sql="";
    if(isset($result["Count"])){
        if($result["Count"]>=1){            
            $msg="El $desc_subcategory ya existe";
            $result["Error"]=1;
            $result["Query1"]=$sql1;
        }
        else {
            $result["Error"]=0;
            $sql="INSERT INTO data(idsubcategory,data_content)";
            $sql.=" VALUES($idsubcategory,'$xml')";
            $msg="El $desc_subcategory ha sido guardado correctamente";
        }
    }
}

if ($action=="UPD"){
    $sql="UPDATE data SET idsubcategory=$idsubcategory";
    $sql.=", data_content='$xml'";
    $sql.="WHERE iddata=$iddata";
    
    $msg="El $desc_subcategory ha sido actualizado correctamente";    
}

	    if($dbh->query($sql)){
	        $result["Error"]=0;
                $result["Msg"]=$msg;
	    }
	    else{
	        $result["Error"]=1;
                $result["Msg"]=$msg;
	    }
	
	    $dbh = null;
	    $result["Query"]=$sql;

/***********/

	    return $result;
	
	}
        
	function searchAreasAdministrativasSQL($idarea=""){
	
		$dbh=conx("DB_ITS","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
	
		
	        $sql = "SELECT * FROM areasAdministrativas";
		
	
	    $i=0;
	
	    if($dbh->query($sql)){
	        foreach($dbh->query($sql) as $row) {
	            $result["idareaAdministrativa"][$i]= $row["idareaAdministrativa"];
	            $result["areaAdministrativa_description"][$i]= $row["areaAdministrativa_description"];
	            $i++;
	        }
	        $result["Count"]=count($result["idareaAdministrativa"]);
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
