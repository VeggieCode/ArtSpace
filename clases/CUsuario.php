<?php
	session_start();
	require_once("CConecta.php");
	class CUsuario
	{		
		var $muestracorreo = array();
		var $muestraimg = array();
		var $muestra = array();
		var $posts = array();
		var $var2 = array();
		
		function guardarimg()
		{
			if(isset($_FILES["foto"]) && !empty($_FILES["foto"]))
			{
				$con = new CConecta();
				$con->conexion();
				$_SESSION["imgnombre"] = ''.$_SESSION["nombre"].'_'.$_SESSION["apellidos"].'_'.$_SESSION["tipo"].'_.jpg';
				$updatequery = 'UPDATE usuario SET foto = "'.$_SESSION["imgnombre"].'" WHERE correo = "'.$_SESSION["correo"].'"';
				$_SESSION["foto"] = $_SESSION["imgnombre"];
				if($this->validaArchV($_FILES["foto"]["name"], $_FILES["foto"]["size"], $_FILES["foto"]["tmp_name"]))
				{
					if(!mysqli_query($con->based,$updatequery))
					{
						header("location:index.php?COD=-1");
					}
					if(!file_exists("../FotosPerfil"))
					{
						mkdir("../FotosPerfil", 0777);
					}
					move_uploaded_file($_FILES["foto"]["tmp_name"], "../FotosPerfil/".$_SESSION["imgnombre"]);
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				$con = new CConecta();
				$con->conexion();
				$_SESSION["foto"] = "default.jpg";
				$updatequery = 'UPDATE usuario SET foto = "'.$_SESSION["foto"].'" WHERE correo = "'.$_SESSION["correo"].'"';
				if(mysqli_query($con->based, $updatequery))
				{
					return true;
				}
				else
				{
					die(nel);
				}
			}
		}
		
		function borrarimg()
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'UPDATE usuario SET foto = "default.jpg" WHERE correo = "'.$_SESSION["correo"].'"';
			if(mysqli_query($con->based, $pro))
			{
				$_SESSION["foto"] = "default.jpg";
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function obtener()
		{
			$con = new CConecta();
			$con->conexion();
			$checkcontra = 'SELECT contra AS countcontra FROM usuario WHERE correo = "'.$_SESSION["correo"].'" AND contra = "'.$_SESSION["contra"].'"';
			$checkcorreo = 'SELECT correo AS countcorreo FROM usuario WHERE correo = "'.$_SESSION["correo"].'" AND contra = "'.$_SESSION["contra"].'"';
			$querycorreo = mysqli_query($con->based, $checkcorreo);  $querycontra = mysqli_query($con->based, $checkcontra);
			$muestracorreo = mysqli_fetch_assoc($querycorreo);
			$muestracontra = mysqli_fetch_assoc($querycontra);
			if(empty($muestracorreo["countcorreo"]))
			{
				header("location:../../index.php?error=06");
			}
			if(($muestracorreo["countcorreo"] == $_SESSION["correo"]) && ($muestracontra["countcontra"] == $_SESSION["contra"]))
			{
				$nombre = 'SELECT * FROM usuario WHERE correo = "'.$_SESSION["correo"].'"';
				$con->conexion();
				$nombreSQL = mysqli_query($con->based, $nombre);
				$usuar = mysqli_fetch_assoc($nombreSQL);
				$_SESSION["nombre"] = $usuar["nombre"];
				$_SESSION["apellidos"] = $usuar["apellidos"];
				$_SESSION["tipo"] = $usuar["tipo"];
				$_SESSION["ind"] = $usuar["ind"];
				if(empty($usuar["foto"]))
				{
					$_SESSION["foto"] = "default.jpg";
				}
				else
				{
					$_SESSION["foto"] = $usuar["foto"];
				}
			}
			if(($muestracorreo["countcorreo"] == $_SESSION["correo"]) && ($muestracontra["countcontra"] != $_SESSION["contrasena"]) )
			{
				header("location:../../index.php?error=07");
			}
			else
			{
				header("location:../../index.php?error=-10");
			}
		}
		
		function obtener_ind_aut()
		{
			$con = new CConecta();
			$con->conexion();
			$q = 'SELECT ind FROM usuario WHERE correo = "'.$_SESSION["correo"].'"';
			$q2 = mysqli_query($con->based, $q);
			$q3 = mysqli_fetch_assoc($q2);
			return $q3["ind"];
		}
		
		function obtenercont()
		{
			$con = new CConecta();
			$con->conexion();
			$q = 'SELECT contra FROM usuario WHERE correo = "'.$_SESSION["correo"].'"';
			$q2 = mysqli_query($con->based, $q);
			$q3 = mysqli_fetch_assoc($q2);
			return $q3["contra"];
		}
		
		function obtenercorreo()
		{
			$con = new CConecta();
			$con->conexion();
			$q = 'SELECT correo FROM usuario WHERE contra = "'.$_SESSION["contra"].'"';
			$q2 = mysqli_query($con->based, $q);
			$q3 = mysqli_fetch_assoc($q2);
			return $q3["correo"];
		}
		
		function guardarusu()
		{
			$con = new CConecta();
			$con->conexion();
			$insertar = 'INSERT INTO usuario (nombre, apellidos, fecha, correo, contra, tipo, codigo) VALUES ("'.$_SESSION["nombre"].'", "'.$_SESSION["apellidos"].'", "'.$_SESSION["fecha"].'", "'.$_SESSION["correo"].'", "'.$_SESSION["contra"].'", "'.$_SESSION["tipo"].'", "'.$this->randstring().'")';
			if(!mysqli_query($con->based, $insertar))
			{
				$checkcorreo = 'SELECT COUNT(correo) AS countcorreo FROM usuario WHERE correo = "'.$_SESSION["correo"].'"';
				$querycorreo = mysqli_query($con->based, $checkcorreo);
				$this->muestracorreo = mysqli_fetch_assoc($querycorreo);
				if($this->muestracorreo["countcorreo"] == 1)
				{
					header("Location:../../index.php?error=20");
				}
				if($this->muestracorreo["countcorreo"] == 0)
				{
					header("Location:../../index.php?error=21");
				}
			}
			else
			{
				header("location:index.php");
			}
		}
		
		function guardarcont()
		{
			$con = new CConecta();
			$con->conexion();
			$q = 'UPDATE usuario SET contra = "'.$_SESSION["contra"].'", codigo = "'.$this->randstring().'" WHERE correo = "'.$_SESSION["correo"].'"';
			if(mysqli_query($con->based, $q))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function guardarcorr()
		{
			$con = new CConecta();
			$con->conexion();
			$q = 'UPDATE usuario SET correo = "'.$_SESSION["correo"].'" WHERE ind = "'.$_SESSION["ind"].'"';
			if(mysqli_query($con->based, $q))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validaArchV($nomArch, $tamArch, $tmpArch)
		{//validamos el archivo
			$ext1 = strrev($nomArch);
			$ext2 = strpos($ext1, '.');
			$ext1 = substr($ext1, 0, $ext2);
			$ext1 = strrev($ext1);
			
			if(!empty($tmpArch))
			{
				if($tamArch<=314572800)
				{
					if($ext1=="mp3" || $ext1=="MP3" || $ext1=="wav" || $ext1=="WAV" || $ext1=="jpg" || $ext1=="jpeg" || $ext1=="JPG" || $ext1=="JPEG" || $ext1=="gif" || $ext1=="GIF" || $ext1=="png" || $ext1=="PNG" || $ext1=="mp4" || $ext1=="MP4" || $ext1=="3gp" || $ext1=="3GP" || $ext1=="mov" || $ext1=="MOV" || $ext1=="avi" || $ext1=="AVI")
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		
		function buscar($bus, $tb, $c)
		{
			$con = new CConecta();
			$con->conexion();
			$start = ($c-1)*5;
			if($tb == 1)
			{
				$buscar = 'SELECT * FROM  contenido WHERE LCASE(nombre) LIKE LCASE("%'.$bus.'%")ORDER BY ind_con DESC LIMIT '.$start.', 5';
				if($bussql = mysqli_query($con->based, $buscar))
				{
					$nh = 0;
					while($xha = mysqli_fetch_assoc($bussql))
					{
						$this->muestra[$nh][0] = $xha["nombre"];
						$this->muestra[$nh][1] = $xha["url"];
						$this->muestra[$nh][2] = $xha["cod"];
						$this->muestra[$nh][3] = $xha["ind_con"];
						$this->muestra[$nh][4] = $xha["ind_aut"];
						$this->muestra[$nh][5] = $xha["tipo"];
						$this->muestra[$nh][6] = $xha["estado"];
						$nh++;
					}
				}
			}
			if($tb == 2)
			{
				$busa = 'SELECT ind FROM usuario WHERE LOWER(nombre) LIKE LOWER("%'.$bus.'%") OR LOWER(apellidos) LIKE LOWER("%'.$bus.'%")';
				if($bussql = mysqli_query($con->based, $busa))
				{
					if($busfa = mysqli_fetch_assoc($bussql))
					{
						$xh = 'SELECT * FROM  contenido WHERE ind_aut LIKE "%'.$busfa["ind"].'%" ORDER BY ind_con DESC LIMIT '.$start.', 5';
						if($xhsql = mysqli_query($con->based, $xh))
						{
							$nh = 0;
							while($xha = mysqli_fetch_assoc($xhsql))
							{
								$this->muestra[$nh][0] = $xha["nombre"];
								$this->muestra[$nh][1] = $xha["url"];
								$this->muestra[$nh][2] = $xha["cod"];
								$this->muestra[$nh][3] = $xha["ind_con"];
								$this->muestra[$nh][4] = $xha["ind_aut"];
								$this->muestra[$nh][5] = $xha["tipo"];
								$this->muestra[$nh][6] = $xha["estado"];
								$nh++;
							}
							
						}
						else
						{
							header('Location:index.php?error=102');
						}
					}
					else
					{
						header('Location:index.php?error=102');
					}
				}
				else
				{
					die(NEL);
				}
			}
		}
		
		function toprep($a)
		{
			$con = new CConecta();
			$con->conexion();
			if($a == 1)
			{
				$f = "r";
			}
			if($a == 2)
			{
				$f = "d";
			}
			if($a == 3)
			{
				$f = "c";
			}
			if($a == 4)
			{
				$f = "b";
			}
			$buscar = 'SELECT * FROM rep WHERE tipo = "'.$f.'" ORDER BY rep DESC LIMIT 5';
			if($buscar2 = mysqli_query($con->based, $buscar))
			{
				$n = 0;
				while($buscar3 = mysqli_fetch_assoc($buscar2))
				{
					$this->posts[$n][1] = $buscar3["con"];
					$n++;
				}
				if(empty($buscar3["con"]))
				{
					return false;
				}
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function buscar1($in, $t)
		{
			$con = new CConecta();
			$con->conexion();
			$buscar = 'SELECT * FROM contenido WHERE ind_con = '.$in;
			if($buscarsql = mysqli_query($con->based, $buscar))
			{
				if($buscarsql2 = mysqli_fetch_assoc($buscarsql))
				{
					$this->var2[1] = $buscarsql2["nombre"];
					$this->var2[2] = $buscarsql2["url"];
					$this->var2[3] = $buscarsql2["cod"];
					$this->var2[4] = $buscarsql2["ind_con"];
					$this->var2[5] = $buscarsql2["ind_aut"];
					$this->var2[6] = $buscarsql2["tipo"];
					$this->var2[7] = $buscarsql2["estado"];
					return true;
				}
			}
			else
			{
				return false;
			}
		}
		
		function verrep($cont)
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'SELECT rep FROM rep WHERE con = "'.$cont.'" AND tipo = "r"';
			if($pro2 = mysqli_query($con->based, $pro))
			{
				if($pro3 = mysqli_fetch_assoc($pro2))
				{
					$newrep = $pro3["rep"] + 1;
					$add = 'UPDATE rep SET rep = "'.$newrep.'" WHERE con = "'.$cont.'" AND tipo = "r"';
					if($add2 = mysqli_query($con->based, $add))
					{
						return true;
					}
					else
					{
						header("Location:index.php?no arriba");
					}
				}
				else
				{
					$addnew = 'INSERT INTO rep (con, rep, tipo) VALUES ("'.$cont.'", 1, "r")';
					if($addnew2 = mysqli_query($con->based, $addnew))
					{
						return true;
					}
				}
			}
			else
			{
				header("Location:index.php?id=no abajo");
			}
		}

		function verdes($cont)
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'SELECT rep FROM rep WHERE con = "'.$cont.'" AND tipo = "d"';
			if($pro2 = mysqli_query($con->based, $pro))
			{
				if($pro3 = mysqli_fetch_assoc($pro2))
				{
					$newrep = $pro3["rep"] + 1;
					$add = 'UPDATE rep SET rep = "'.$newrep.'" WHERE con = "'.$cont.'" AND tipo = "d"';
					if($add2 = mysqli_query($con->based, $add))
					{
						return true;
					}
					else
					{
						header("Location:index.php?no arriba");
					}
				}
				else
				{
					$addnew = 'INSERT INTO rep (con, rep, tipo) VALUES ("'.$cont.'", 1, "d")';
					if($addnew2 = mysqli_query($con->based, $addnew))
					{
						return true;
					}
				}
			}
			else
			{
				header("Location:index.php?id=no abajo");
			}
		}

		function verbus($cont)
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'SELECT rep FROM rep WHERE con = "'.$cont.'" AND tipo = "b"';
			if($pro2 = mysqli_query($con->based, $pro))
			{
				if($pro3 = mysqli_fetch_assoc($pro2))
				{
					$newrep = $pro3["rep"] + 1;
					$add = 'UPDATE rep SET rep = "'.$newrep.'" WHERE con = "'.$cont.'" AND tipo = "b"';
					if($add2 = mysqli_query($con->based, $add))
					{
						return true;
					}
					else
					{
						header("Location:index.php?no arriba");
					}
				}
				else
				{
					$addnew = 'INSERT INTO rep (con, rep, tipo) VALUES ("'.$cont.'", 1, "b")';
					if($addnew2 = mysqli_query($con->based, $addnew))
					{
						return true;
					}
				}
			}
			else
			{
				header("Location:index.php?id=no abajo");
			}
		}

		function ver($cont)
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'SELECT rep FROM rep WHERE con = "'.$cont.'" AND tipo = "d"';
			if($pro2 = mysqli_query($con->based, $pro))
			{
				if($pro3 = mysqli_fetch_assoc($pro2))
				{
					$newrep = $pro3["rep"] + 1;
					$add = 'UPDATE rep SET rep = "'.$newrep.'" WHERE con = "'.$cont.'" AND tipo = "d"';
					if($add2 = mysqli_query($con->based, $add))
					{
						return true;
					}
					else
					{
						header("Location:index.php?no arriba");
					}
				}
				else
				{
					$addnew = 'INSERT INTO rep (con, rep, tipo) VALUES ("'.$cont.'", 1, "d")';
					if($addnew2 = mysqli_query($con->based, $addnew))
					{
						return true;
					}
				}
			}
			else
			{
				header("Location:index.php?id=no abajo");
			}
		}

		function visits()
		{
			$con = new CConecta();
			$con->conexion();
			$pro = 'SELECT visitas FROM visitas WHERE visitas <> 0';
			if($pro2 = mysqli_query($con->based, $pro))
			{
				if($pro3 = mysqli_fetch_assoc($pro2))
				{
					$newrep = $pro3["visitas"] + 1;
					$add = 'UPDATE visitas SET visitas = '.$newrep;
					if($add2 = mysqli_query($con->based, $add))
					{
						return true;
					}
					else
					{
						header("Location:index.php?no arriba");
					}
				}
				else
				{
					$addnew = 'INSERT INTO visitas (visitas) VALUES (1)';
					if($addnew2 = mysqli_query($con->based, $addnew))
					{
						return true;
					}
				}
			}
			else
			{
				header("Location:index.php?id=no abajo");
			}
		}
		
		function musics($t, $v)
		{
			$con = new CConecta();
			$con->conexion();
			$start = ($_GET["c"] - 1)*$v;
			/*------------------------------------------------*/
			$cuenta = 'SELECT COUNT(ind_con) AS conts FROM contenido WHERE tipo = 2';
			$cuenta1 = mysqli_query($con->based, $cuenta);
			$this->muestra = mysqli_fetch_assoc($cuenta1);
			/*-----------------------------------------------------*/
			$mostrando = 'SELECT * FROM contenido WHERE tipo = '.$t.' ORDER BY ind_con DESC LIMIT '.$start.', '.$v;
			if($sqlposts = mysqli_query($con->based,$mostrando))
			{
				$n = 0;
				while($posts2 = mysqli_fetch_assoc($sqlposts))
				{
					$this->posts[$n][0] = $posts2["nombre"];
					$this->posts[$n][1] = $posts2["url"];
					$this->posts[$n][2] = $posts2["cod"];
					$this->posts[$n][3] = $posts2["ind_con"];
					$this->posts[$n][4] = $posts2["ind_aut"];
					$this->posts[$n][5] = $posts2["tipo"]; 
					$this->posts[$n][6] = $posts2["estado"];
					$n++;
				}
			}
			else
			{
				die("Nel carnal, error en posts");
			}
		}
		
		function musicaut($t, $a)
		{
			$con = new CConecta();
			$con->conexion();
			if($t == 0)
			{
				$buscar = 'SELECT * FROM contenido WHERE ind_aut = '.$a;
			}
			else
			{
				$buscar = 'SELECT * FROM contenido WHERE tipo = '.$t.' AND ind_aut = '.$a;
			}
			if($buscarsql = mysqli_query($con->based, $buscar))
			{
				$n = 0;
				while($buscar2 = mysqli_fetch_assoc($buscarsql))
				{
					$this->muestra[$n][1] = $buscar2["nombre"];
					$this->muestra[$n][2] = $buscar2["url"];
					$this->muestra[$n][3] = $buscar2["cod"];
					$this->muestra[$n][4] = $buscar2["ind_con"];
					$this->muestra[$n][5] = $buscar2["ind_aut"];
					$this->muestra[$n][6] = $buscar2["tipo"];
					$this->muestra[$n][7] = $buscar2["estado"];
					$n++;
				}
			}
			else
			{
				die("Nel carnal, error en posts");
			}
		}
		
		function aut($id)
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT nombre, apellidos FROM usuario WHERE ind = '.$id.'';
			if($sql2 = mysqli_query($con->based, $sql))
			{
				$var = mysqli_fetch_assoc($sql2);
				$this->var2["nomm"] = ''.$var["nombre"].' '.$var["apellidos"].'';
				echo $this->var2["nomm"];
			}
		}
		
		function top($t)
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT * FROM contenido WHERE tipo = '.$t.' ORDER BY ind_con DESC LIMIT 1';
			if($sql2 = mysqli_query($con->based, $sql))
			{
				if($sql3 = mysqli_fetch_assoc($sql2))
				{
					$this->var2[1] = $sql3["nombre"];
					$this->var2[2] = $sql3["url"];
					$this->var2[3] = $sql3["ind_aut"];
					$this->var2[4] = $sql3["cod"];
					$this->var2[5] = $sql3["ind_con"];
				}
			}
			else
			{
				die("No...");
			}
		}
		
		function topall()
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT * FROM contenido ORDER BY ind_con DESC LIMIT 1';
			if($sql2 = mysqli_query($con->based, $sql))
			{
				if($sql3 = mysqli_fetch_assoc($sql2))
				{
					$this->var2[1] = $sql3["nombre"];
					$this->var2[2] = $sql3["url"];
					$this->var2[3] = $sql3["ind_aut"];
					$this->var2[4] = $sql3["cod"];
					$this->var2[5] = $sql3["tipo"];
					$this->var2[6] = $sql3["ind_con"];
				}
			}
			else
			{
				die("No...");
			}
		}
		
		function randstring()
		{ 
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20); 
		}
		
		function randcolor()
		{
		return substr(str_shuffle("0123456789abcdef"), 0, 6); 
		}
		
		function codcor($cor, $n)
		{
			if($n == 1)
			{
				$hf = "correo";
			}
			if($n == 2)
			{
				$hf = "contra";
			}
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT codigo FROM usuario WHERE '.$hf.' = "'.$cor.'"';
			if($sql2 = mysqli_query($con->based, $sql))
			{
				if($sql3 = mysqli_fetch_assoc($sql2))
				{
					$this->muestra[1] = $sql3["codigo"];
					return true;
				}
			}
			else
			{
				return false;
			}
		}

		function verlista()
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT cont FROM lista WHERE usu = "'.$_SESSION["ind"].'"';
			$sql1 = mysqli_query($con->based, $sql);
			$h = 0;
			while($sql2 = mysqli_fetch_assoc($sql1))
			{
				$this->var2[$h][1] = $sql2["cont"];
				$h++;
			}
			if(empty($sql2[$h][1]))
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		function verlista1($cont)
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT COUNT(cont) AS cant FROM lista WHERE usu = '.$_SESSION["ind"].' AND cont = '.$cont;
			$sql1 = mysqli_query($con->based, $sql);
			$sql2 = mysqli_fetch_assoc($sql1);
			if($sql2["cant"] == 1)
			{
				return true;
			}
			elseif($sql2["cant"] == 0)
			{
				return false;
			}
		}

		function sqlista($cont, $a)
		{
			$con = new CConecta();
			$con->conexion();
			$sqla = 'SELECT COUNT(cont) AS cant FROM lista WHERE usu = '.$_SESSION["ind"].' AND cont = '.$cont;
			$sqla1 = mysqli_query($con->based, $sqla);
			$sqla2 = mysqli_fetch_assoc($sqla1);
			if($sqla2["cant"] == 0 && $a == "s")
			{
				$sql = 'INSERT INTO lista (cont, usu) VALUES ('.$cont.', '.$_SESSION["ind"].')';
				$sql1 = mysqli_query($con->based, $sql);
				return true;
			}
			if($sqla2["cant"] == 1 && $a == "q")
			{
				$sql = 'DELETE FROM lista WHERE cont = '.$cont.' AND usu ='.$_SESSION["ind"];
				$sql1 = mysqli_query($con->based, $sql);
				return true;
			}
			else
			{
				return fale;
			}
		}

		function randmusic()
		{
			$con = new CConecta();
			$con->conexion();
			$sql = 'SELECT COUNT(*) as total FROM contenido';
			$sql1 = mysqli_query($con->based, $sql);
			$sql2 = mysqli_fetch_assoc($sql1);
			$xr = rand(1,$sql2["total"]);
			$sql = 'SELECT * FROM contenido WHERE ind_con = '.$xr;
			$sql1 = mysqli_query($con->based, $sql);
			$sql2 = mysqli_fetch_assoc($sql1);
			$this->muestra[1] = $sql2["nombre"];
			$this->muestra[2] = $sql2["url"];
			$this->muestra[3] = $sql2["cod"];
			$this->muestra[4] = $sql2["ind_con"];
			$this->muestra[5] = $sql2["ind_aut"];
			$this->muestra[6] = $sql2["tipo"];
		}

	}
?>