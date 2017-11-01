<?php
	class CConecta
	{
		var $host;
		var $user;
		var $pw;
		var $nombreBD;
		var $based;
		
		function CConecta()
		{
			$this->host = "localhost";
			$this->user = "root";
			$this->pw = "";
			$this->nombreBD = "artspace";
		}
		
		function conexion()
		{
			if($db = mysqli_connect($this->host, $this->user, $this-> pw))
			{
				if(mysqli_select_db($db, $this->nombreBD))
				{
					$this->based = $db;
					//mysqli_query ("SET NAMES 'utf8'");
					return $this->based;
				}
				else
				{
					die('Base de datos inexistente');
				}
			}
			else
			{
				die('No hay conexion');
			}
		}
	}
?>