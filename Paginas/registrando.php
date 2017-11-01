<?php
	session_start();
	session_unset();
	session_destroy();
	if($_GET["id"] == 1)
	{
		$usu = "creador de contenido (CDC)";
		$img = "pincel";
	}
	if($_GET["id"] == 2)
	{
		$usu = "espectador normal";
		$img = "lentes";
	}
	if($_GET["id"] == 3)
	{
		$usu = "agente/productor/inversionista (AE)";
		$img = "disco";
	}
	if(isset($_GET["id"])&& ($_GET["id"] < 1 || $_GET["id"] > 3))
	{
		header('Location:../../index.php?error=1');
	}
	if(isset($_GET["error"]) && $_GET["error"] == 01)
	{
		?>
		<script>
			alert("No se llenaron todos los campos");
			window.location.assign("../../index.php");
		</script>
		<?php
	}
	if(isset($_GET["error"]) && $_GET["error"] == 02)
	{
		?>
		<script>
			alert("Las contraseñas no coiciden");
			window.location.assign("../../index.php");
		</script>
		<?php
	}
	if(isset($_GET["error"]) && $_GET["error"] == 03)
	{
		?>
		<script>
			alert("No se indicó que se aceptaron las politicas de ArtSpace");
			window.location.assign("../../index.php");
		</script>
		<?php
	}
?>
<!doctype html/ >
<html lang="es-MX">
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/registrando.css"/>
		<link rel="shortcut icon" type="image/png" href="../Img/ico_min.ico" />
		<style>
		@font-face{
			font-family:circular;
			src: url(../CircularStd-Bold.otf);
		}
		</style>
	</head>
	<body>
		<img id="fondo" src="../Img/b2.jpg"/>
		<a href="../../index.php"><img id="headlogo" src="../Img/ico_2.png"/></a>
		<?php
		if(!isset($_GET["c"]))
		{
		?>
		<p id="t1">BIENVENIDO</p>
		<div id="div1">
		<pre id="pre1">Estas a punto de crear una cuenta como <?php echo $usu; ?>.
Si deseas continuar te pedimos porfavor que leas las <a class="ap" href="">políticas de ArtSpace</a>.
Solo entonces podrás continuar sí estás de acuerdo con todo lo establecido en las políticas.
De lo contrario, lo mejor sería que no crearas una cuenta aquí.
Para cualquier duda o aclaración siempre puedes comunicarte al siguiente correo: artspace@gmail.com</pre>
		</div>
		<?php
			if($_GET["id"]==1)
			{
				$url = "";
			}
		?>
		<p id="p1">Primero lo primero</p>
		<form method="POST" action="alt.php?id=2" enctype="multipart/form-data">
			<p id="l1" class="l">NOMBRE(S)</p>
			<input type="text" name="nom" id="nom" class="in"/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l2" class="l">APELLIDOS</p>
			<input type="text" name="ap" id="ap" class="in"/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l3" class="l">FECHA DE NAC.</p>
			<input type="date" name="fech" id="fe" class="in"/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l4" class="l">E-MAIL</p>
			<input type="text" name="email" id="email" class="in"/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l5" class="l">CONTRASEÑA</p>
			<input type="password" name="cont1" id="cont1" class="in" placeholder="          AL MENOS 8 CARACTERES"/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l6" class="l">CONFIRMAR</p>
			<input type="password" name="cont2" id="cont2" class="in" placeholder="            REPETIR CONTRASEÑA "/>
			<!------------------------------------------------------------------------------------------------->
			<p id="l8" class="l">HE LEÍDO Y COMPRENDIDO LAS<br> <a class="ap" href="">POLÍTICAS DE ArtSpace</a> Y<br> ESTOY DE ACUERDO CON ELLAS</p>
			<input type="checkbox" name="check" id="check" class="in"/>
			<!------------------------------------------------------------------------------------------------->
			<input type="number" name="tipo" style="display:none;" value="<?php echo $_GET["id"]; ?>"/>
			<!------------------------------------------------------------------------------------------------->
			<input type="submit" id="sub" value="REGISTRAR"/>
		</form>
		<img id="usulogo" src="../Img/<?php echo $img ;?>.png"/>
		<?php
		}
		if(isset($_GET["c"]) && $_GET["c"] == "true")
		{
			?>
		<p id="pcor">REDACTAR CORREO</p>
			<?php
		}
		if(isset($_GET["c"]) && $_GET["c"] == "contlost")
		{
			if(isset($_GET["error"]) && $_GET["error"] == 10)
			{
				?>
				<script>
					alert("No se llenó el campo \nVuelva a intentarlo.");
					window.location.assing("registrando.php?c=contlost");
				</script>
				<?php
			}
			if(isset($_GET["error"]) && $_GET["error"] == 11)
			{
				?>
				<script>
					alert("No se encontraron registros de el correo introducido \nVuelva a intentarlo.");
					window.location.assing("registrando.php?c=contlost");
				</script>
				<?php
			}
			?>
		<p id="pcont1">EN CASO DE QUE HAYA PERDIDO SU CONTRASEÑA...</p>
		<form action="alt.php?id=7" method="POST">
		<p id="p1">PORFAVOR INGRESE LA DIRECCIÓN DE CORREO ELECTRONICO<br>
				   CON LA CUAL SE REGISTRÓ.</p>
		<input type="text" id="correo1" name="correo" placeholder="Alguien@ejemplo.com"/>
		<input type="submit" id="submit2" value="ENVIAR"/>
		</form>
			<?php
		}
		if(isset($_GET["c"]) && $_GET["c"] == "recont" && isset($_GET["mail"]) && isset($_GET["cod"]))
		{
			
		}
		else
		{
			//header("location:../../index.php");
		}
		?>
	</body>
</html>