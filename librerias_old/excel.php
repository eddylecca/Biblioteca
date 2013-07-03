<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");


require ('dbconnect.php');	

$dbh=conx();
						
$codArea=$_GET["codArea"];
$tipoSubida=$_GET["action"];



?>


<html>
<title>
</title>
<body>
<table><tr><td>Hola</td></tr></table>
</body>
</html>