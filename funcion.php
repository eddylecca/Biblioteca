<?php
$result = verificaUsuarioSQL($form_entrada);

$respuesta->alert(print_r($result, true));

function verificaUsuarioSQL($formLogin){

        $usuario=trim($formLogin["usuario"]);
        $clave=trim($formLogin["clave"]);

	$dbh=conx("DB_ITS","wmaster","igpwmaster");
	$dbh->query("SET NAMES 'utf8'");

        $sql="select a.idarea,a.area_description, u.users_name from area a, users u where a.idarea=u.idarea and u.users_name='eddy' and users_password='eddy'";

    $i=0;
    if($dbh->query($sql)){
        foreach($dbh->query($sql) as $row) {
            $result["idarea"][$i]= $row["idarea"];
            $i++;
        }

        if(isset($result["idarea"])){
                for($i=0;$i<count($result["idarea"]);$i++){
                        $result["idarea"]=$result["idarea"][$i];
                        $result["area_description"]=$result["area_description"][$i];
                        $result["users_name"]=$result["users_name"][$i];
                }
                $result["Count"]=count($result["idarea"]);
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

?>
