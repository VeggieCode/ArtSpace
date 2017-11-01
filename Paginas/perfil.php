<?php
	require_once("../clases/CUsuario.php");
	$obj = new CUsuario();
	//session_start();
	$bgran = rand(1,10);
	if(empty($_SESSION["nombre"]) && $_GET["id"] != "cont")
	{
		header('Location:../../index.php?error=2');
	}
	if(isset($_GET["error"]) && $_GET["error"] == "no")
	{
	?>
	<script>
		alert("Los cambios se efectuaron exitosamente");
		window.location.assign("index.php");
	</script>
	<?php
	}
	if(isset($_GET["error"]) && $_GET["error"] == 2)
	{
	?>
	<script>
		alert("No se llenaron los campos \nPorfavor vuelva a intentarlo");
		window.location.assign("perfil.php?id=<?php echo $_GET["id"]; ?>");
	</script>
	<?php
	}
	if(isset($_GET["error"]) && $_GET["error"] == 3)
	{
	?>
	<script>
		alert("Las contraseñas no coinciden \nPorfavor vuelva a intentarlo");
		window.location.assign("perfil.php?id=cont");
	</script>
	<?php
	}
	
?>
<!doctype html />
<html>
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/perfil.css"/>
		<link rel="shortcut icon" type="image/png" href="../Img/ico_min.ico" />
		<style>
		@font-face{
			font-family:circular;
			src: url(../CircularStd-Bold.otf);
		}
		<?php
			if(!isset($_GET["h"]))
			{
				?>
		#headlogo{
			left:45%;
		}
				<?php
			}
		?>
		#dt2
		{
			background:linear-gradient(#<?php echo $color1 = $obj->randcolor(); ?> 0%, #<?php echo $obj->randcolor(); ?> 49%, #<?php echo $color1; ?> 100%);
		}
		#dmain
		{
			border:4px solid #<?php echo $color1; ?>;
		}
		</style>
	</head>
	<body>
		<img id="fondo" src="../Img/bi<?php echo $bgran; ?>.jpg"/>
		<a href="index.php"><img id="headlogo" src="../Img/ico_2.png"/></a>
		<?php
		if($_GET["id"] == 2)
		{
			?>
				<div id="dmain">
				<div id="dname">
					<p id="pname"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellidos"]; ?></p>
					<img src="../FotosPerfil/<?php echo $_SESSION["foto"];?>" id="fper" onclick="location='index.php?h=0'"/>
					<input type="button" id="bcont" onclick="location='perfil.php?id=cont'" value="CAMBIAR CONTRASEÑA" />
					<input type="button" id="bcorr" onclick="location='perfil.php?id=corr'" value="CAMBIAR CORREO" />
				</div>
				<!---------------------------------------------------------------------------------------------------->
				<div id="dt2">
					<input type="button" id="bwish" onclick="location='perfil.php?id=wl'" value="MI LISTA DE DESEOS" />
				</div>
				<!---------------------------------------------------------------------------------------------------->
				<hr id="hrv">
				<div id="dti">
					<p id="pti">TU CONTENIDO</p>
				</div>
				<div id="divcont">
				<?php
				$obj->musicaut(0, $_SESSION["ind"]);
				foreach($obj->muestra as $muestra)
				{
					if($muestra[3] <= 2)
				{
					$i = "mdefault.png";
				}
				else
				{
					$i = $muestra[2].'.png';
				}
				if($muestra[4] != $_GET["ic"])
				{
					?>
					<a href="ver.php?ic=<?php echo $muestra[4];?>&ia=<?php echo $muestra[5];?>&t=<?php echo $_GET["t"]; ?>" id="a1"><div id="m1">
					<img id="imgm" src="../Contenido/<?php echo $i; ?>"/>
					<p id="pls"><?php echo $muestra[1]; ?></p>
					<p id="pln"><?php echo $obj->aut($muestra[5]); ?></p>
					</div></a>
					<?php
				}
				}
				?>
				</div>
				</div>
			<?php
		}
		if($_GET["id"] == "cont")
		{
			?>
			<div id="dmain" style="border:4px solid white;">
			<p id="p1c">CAMBIAR CONTRASEÑA</p>
			<form method="POST" action="alt.php?id=9" enctype="multipart/form-data">
				<p id="pcont">Nueva contraseña:</p>
				<input type="password" id="incont" name="cont1">
				<p id="pcont2">Repetir contraseña:</p>
				<input type="password" id="incont2" name="cont2">
				<input type="submit" id="subcont" value="GUARDAR">
				</form>
			</div>
			<?php
		}
		if($_GET["id"] == "corr")
		{
			?>
			<div id="dmain" style="border:4px solid white;">
			<p id="p1c">CAMBIAR CORREO</p>
			<form method="POST" action="alt.php?id=10" enctype="multipart/form-data">
				<p id="pcont">Nuevo correo:</p>
				<input type="text" id="incorr" name="corr">
				<input type="submit" id="subcont" value="GUARDAR">
				</form>
			</div>
			<?php
		}
		if($_GET["id"] == "wl")
		{
			?>
			<div id="dmain" style="border:4px solid white;">
			<div id="dname">
					<p id="pname"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellidos"]; ?></p>
					<img src="../FotosPerfil/<?php echo $_SESSION["foto"];?>" id="fper" onclick="location='index.php?h=0'"/>
					<input type="button" id="bcont" onclick="location='perfil.php?id=cont'" value="CAMBIAR CONTRASEÑA" />
					<input type="button" id="bcorr" onclick="location='perfil.php?id=corr'" value="CAMBIAR CORREO" />
				</div>
				<div id="dti">
					<p id="pti">TU LISTA DE DESEOS</p>
				</div>
			<div id="divcont">
			<?php
			$obj->verlista();
			foreach($obj->var2 as $m)
			{
				$obj->buscar1($m[1], 2);
				if($obj->var2[3] <= 2)
				{
					$i = "mdefault.png";
				}
				else
				{
					$i = $obj->var2[2].'.png';
				}

				?>
				<a href="ver.php?ic=<?php echo $obj->var2[4];?>&ia=<?php echo $obj->var2[5];?>&t=2" id="a1"><div id="m1">
					<img id="imgm" src="../Contenido/<?php echo $i; ?>"/>
					<p id="pls"><?php echo $obj->var2[1]; ?></p>
					<p id="pln"><?php echo $obj->aut($obj->var2[5]); ?></p>
					</div></a>
				<?php
			}
			?>
			</div>
			</div>
			<?php
		}
		?>
	</body>
</html>