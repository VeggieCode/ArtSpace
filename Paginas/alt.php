<?php
	session_start();
	require_once("../clases/CUsuario.php");
	require_once("../clases/CConecta.php");
		$obj = new CUsuario();
		if($_GET["id"] == 1)
		{
			if((isset($_POST["em"]) && !empty($_POST["em"]))
			&& (isset($_POST["cont"]) && !empty($_POST["cont"])))
			{
				$_SESSION["correo"] = $_POST["em"];
				$_SESSION["contra"] = md5($_POST["cont"]);
				$obj->obtener();
				header('Location:index.php');
			}
			else
			{
				header('Location:../../index.php?error=04');
			}
		}
		if($_GET["id"] == 2)
		{
			if((isset($_POST["nom"])&&!empty($_POST["nom"]))&&
			   (isset($_POST["ap"]) &&!empty($_POST["ap"])) &&
			   (isset($_POST["fech"])&&!empty($_POST["fech"]))&&
			   (isset($_POST["email"])&&!empty($_POST["email"]))&&
			   (isset($_POST["cont1"])&&!empty($_POST["cont1"]))&&
			   (isset($_POST["cont2"])&&!empty($_POST["cont2"]))&&
			   (isset($_POST["tipo"])&&!empty($_POST["tipo"])))
			   {
				   if($_POST["check"] == "on")
				   {
					   if($_POST["cont1"] == $_POST["cont2"])
					   {
						   $_SESSION["nombre"] = $_POST["nom"];
						   $_SESSION["apellidos"] = $_POST["ap"];
						   $_SESSION["fecha"] = $_POST["fech"];
						   $_SESSION["correo"] = $_POST["email"];
						   $_SESSION["contra"] = md5($_POST["cont1"]);
						   $_SESSION["tipo"] = $_POST["tipo"];
						   $obj->guardarusu();
						   $obj->guardarimg();
					   }
					   else
					   {
						   header('Location:registrando.php?error=02');
						}  
				   }
				   else
				   {
					   header('Location:registrando.php?error=03');
				   }
			   }
			   else
			   {
				   header('Location:registrando.php?error=01');
			   }
		}
		if($_GET["id"] == 3)
		{
			if((isset($_POST["nom"]) && !empty($_POST["nom"]))&&
				(isset($_POST["tipo"]) && !empty($_POST["tipo"])) &&
				(!empty($_FILES["arch1"])))
			{
				if(!isset($_POST["folio"]))
				{
					$_POST["folio"] = 0;
				}
				$con = new CConecta();
				$con->conexion();
					if($obj->validaArchV($_FILES["arch1"]["name"], $_FILES["arch1"]["size"], $_FILES["arch1"]["tmp_name"]))
					{
						$urlarchIC = "".$_POST["nom"]."_".$_SESSION["correo"]."_";
						$cod = 1;
						if(!empty($_FILES["imgmu"]) && $obj->validaArchV($_FILES["imgmu"]["name"], $_FILES["imgmu"]["size"], $_FILES["imgmu"]["tmp_name"]))
						{
							$urlarchIU = "".$_POST["nom"]."_".$_SESSION["correo"]."_";
							$cod = 4;
						}
						if(!empty($_FILES["arch2"]) && $obj->validaArchV($_FILES["arch2"]["name"], $_FILES["arch2"]["size"], $_FILES["arch2"]["tmp_name"]))
						{
							$urlarchIM = "".$_POST["nom"]."_".$_SESSION["correo"]."_";
							$cod = 2;
							if(!empty($_FILES["imgmu"]) && $obj->validaArchV($_FILES["imgmu"]["name"], $_FILES["imgmu"]["size"], $_FILES["imgmu"]["tmp_name"]))
							{
								$urlarchIU = "".$_POST["nom"]."_".$_SESSION["correo"]."_";
								$cod = 3;
							}
						}
					}
					switch($_POST["tipo"])
					{
						case 1:{
							$codec = ".png";
							break;
						}
						case 2:{
							$codec = ".mp3";
							break;
						}
						case 3:{
							$codec = ".mp4";
							break;
						}
					}
				if($_POST["est"] == 1 || $_POST["est"] == 2)
				{
					if($_POST["est"] == 1)
					{
						$_POST["folio"] = 0;
					}
					$insert = 'INSERT INTO contenido (nombre, url, cod, ind_aut, tipo, estado, folio) VALUES ("'.$_POST["nom"].'", "'.$urlarchIC.'", '.$cod.', '.$obj->obtener_ind_aut().', '.$_POST["tipo"].', '.$_POST["est"].', '.$_POST["folio"].' )';
					if(!mysqli_query($con->based, $insert))
					{
						die("NEL CARNAL, NO SE PUDO");
					}
					if(!file_exists("../Contenido"))
					{
						mkdir("../Contenido", 0777);
					}
					switch($cod)
					{
						case 1:{
							move_uploaded_file($_FILES["arch1"]["tmp_name"], "../Contenido/".$urlarchIC.'_C'.$codec);
							break;
						}
						case 2:{
							move_uploaded_file($_FILES["arch1"]["tmp_name"], "../Contenido/".$urlarchIC.'_C'.$codec);
							move_uploaded_file($_FILES["arch2"]["tmp_name"], "../Contenido/".$urlarchIM.'_M'.$codec);
							break;
						}
						case 3:{
							move_uploaded_file($_FILES["arch1"]["tmp_name"], "../Contenido/".$urlarchIC.'_C'.$codec);
							move_uploaded_file($_FILES["arch2"]["tmp_name"], "../Contenido/".$urlarchIM.'_M'.$codec);
							move_uploaded_file($_FILES["imgmu"]["tmp_name"], "../Contenido/".$urlarchIU.".png");
							break;
						}
						case 4:{
							move_uploaded_file($_FILES["arch1"]["tmp_name"], "../Contenido/".$urlarchIC.'_C'.$codec);
							move_uploaded_file($_FILES["imgmu"]["tmp_name"], "../Contenido/".$urlarchIU.".png");
							break;
						}
					}
					header("Location:index.php");
				}
			}
			header("Location:index.php?error=m");
		}
		if($_GET["id"] == 4)
		{
			if(!isset($_GET["a"]))
			{
				if(!empty($_FILES["foto"]["name"]))
				{
					if($obj->guardarimg() == true)
					{
						header('Location:index.php');
					}
					else
					{
						header('Location:index.php?error=24');
					}
				}
				else
				{
					header('Location:index.php?error=23');
				}
			}
			else
			{
				if($obj->borrarimg() == true)
				{
					header('Location:index.php');
				}
				else
				{
					header('Location:index.php?error=25');
				}
			}
		}
		if($_GET["id"] == 5)
		{
			if(!empty($_POST["bus"]) && !empty($_POST["r"]))
			{
				header('Location:index.php?id=109&c=1&bus='.$_POST["bus"].'&r='.$_POST["r"]);
			}
			else
			{
				header('Location:index.php?error=101');
			}
		}
		if(!isset($_GET["id"]))
		{
			header('Location:../../index.php?error=2');
		}
		if($_GET["id"] == 6)
		{
			$obj->verrep($_GET["cont"]);
			?>
			?>
			<html>
			<script>
				close();
			</script>
			</html>
			<?php
		}
		if($_GET["id"] == 7)
		{
			if(!empty($_POST["correo"]))
			{
				if($obj->codcor($_POST["correo"], 1) == true)
				{
					$to = $_POST["correo"];
					$_SESSION["correo"] = $_POST["correo"];
					$subject = "RECUPERACIÓN DE CUENTA";
					$txt = '
					<!doctype html/>
					<html>
					<head>
					<body>
				<table width="600px" height="200px" style="border-collapse: collapse;">
				<tr bgcolor="#6f4af7"style="color:white;" align="center"><td>
					PARA SEGUIR LA RECUPERACIÓN DE SU CUENTA DE ArtSpace.com PORFAVOR HAGA CLICK EN EL ENLACE DE AQUÍ ABAJO. 
					</td></tr>
				<tr bgcolor="#4286f4" color="white" align="center"><td>
					<a style="background-color:darkblue;color:white;font-family:verdana;border-radius:5px;text-decoration:none;padding:10px"
					href="http://www.artspace.esy.es/6to/Paginas/alt.php?id=8&c=reccont&cd='.$obj->obtenercont().'&cod='.$obj->muestra[1].'">RECUPERAR CUENTA</a>
					</td></tr>
					</table>
					</body>
					</head>
					</html>
					';
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: ArtSpace.com' . "\r\n";
					mail($to,$subject,$txt,$headers);
					header("Location:../../index.php");
				}
				else
				{
					header("Location:registrando.php?c=contlost&error=11");
				}
			}
			else
			{
				header("Location:registrando.php?c=contlost&error=10");
			}
		}
		if($_GET["id"] == 8)
		{
			if(isset($_GET["c"]) && isset($_GET["cd"]) && isset($_GET["cod"]))
			{
				if($obj->codcor($_GET["cd"], 2) == true)
				{
					if($obj->muestra[1] == $_GET["cod"])
					{
						$_SESSION["contra"] = $_GET["cd"];
						$_SESSION["correo"] = $obj->obtenercorreo();
						$obj->obtener();
						header('Location:perfil.php?id=cont');
					}
					else
					{
						?>
						<!doctype html />
						<html>
						<script>
							alert("Este enlace ya no funciona. Porfavor vuelva a enlace de contraseñas perdidas");
							window.location.assign("index.php");
						</script>
						</html>
						<?php
					}
				}
			}
		}
		if($_GET["id"] == 9)
		{
			if(isset($_POST["cont1"]) && !empty($_POST["cont1"]) &&
			   isset($_POST["cont2"]) && !empty($_POST["cont2"]))
			{
				if($_POST["cont1"] == $_POST["cont2"])
				{
					$_SESSION["contra"] = md5($_POST["cont1"]);
					$obj->guardarcont();
					header("Location:perfil.php?id=cont&error=no");
				}
				else
				{
					header("Location:perfil.php?id=cont&error=3");
				}
			}
			else
			{
				header("Location:perfil.php?id=cont&error=2");
			}
		}
		if($_GET["id"] == 10)
		{
			if(isset($_POST["corr"]) && !empty($_POST["corr"]))
			{
				$_SESSION["correo"] = $_POST["corr"];
				if($obj->guardarcorr() == false)
				{
					die(no);
				}
				header("Location:perfil.php?id=cont&error=no");
			}
			else
			{
				header("Location:perfil.php?id=cont&error=2");
			}
		}
		if($_GET["id"] == 11)
		{
			if($obj->sqlista($_GET["cont"], $_GET["a"]) == false)
			{
				
			}
			else
			{
			?>
			<html>
			<script>
				close();
			</script>
			</html>
			<?php
			}
		}
	
?>