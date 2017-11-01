<?php
	require_once("../clases/CUsuario.php");
	$obj = new CUsuario();
	
	if(!isset($_GET["ind"]) || !isset($_GET["t"]))
	{
		header("Location:index.php");
	}
	$obj->buscar1($_GET["ind"], $_GET["t"]);
	$obj->verdes($_GET["ind"]);
	$nombre = $obj->var2[1];
	
	$ruta = "../Contenido/".$obj->var2[2]."_C.mp3";

	if(is_file($ruta))
	{
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$nombre.'.mp3');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($ruta));
		readfile($ruta);
	}
	?>