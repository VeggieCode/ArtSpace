<?php
	require_once("clases/CUsuario.php");
	$a = new CUsuario();
	session_start();
	session_unset();
	session_destroy();
	$bg = array();
	$bg[1] = "b1";
	$bg[2] = "b2";
	$bg[3] = "b3";
	
	$a->visits();
	
	$bgran = rand(1,count($bg));
	
	if(isset($_GET["error"]))
	{
		if($_GET["error"] == 1)
		{
		?>
		<script>
			alert("Ha ocurrido un problema \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 04)
		{
		?>
		<script>
			alert("No se han llenado todos los campos \n Porfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 2)
		{
		?>
		<script>
			alert("No se ha iniciado sesión");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 07)
		{
		?>
		<script>
			alert("La contraseña es incorrecta \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 06)
		{
		?>
		<script>
			alert("No se encuentran registros del correo \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == -10)
		{
		?>
		<script>
			alert("Ha ocurrido un error inesperado \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 20)
		{
		?>
		<script>
			alert("El email que intentó registrar ya fue registrado por otro usuario \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
		if($_GET["error"] == 21)
		{
		?>
		<script>
			alert("Ocurrió un error inesperado \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
		}
	}
?>
<!doctype html/ >
<html lang="es-MX">
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="6to/css/acceso.css"/>
		<link rel="shortcut icon" type="image/png" href="6to/Img/ico_min.ico" />
	</head>
	<body>
	<style>
		@font-face{
			font-family:circular;
			src: url(6to/CircularStd-Bold.otf);
		}
		#pacc1{
			font-family:circular;
			font-size:1.3vw;
		}
	</style>
		<img id="fondo" src="6to/Img/<?php echo $bg[$bgran]; ?>.jpg"/>
		<a href="index.php"><img id="headlogo" src="6to/Img/ico_2.png"/></a>
		<div id="divacc">
		<form action="6to/Paginas/alt.php?id=1" method="POST">
			<p id="pacc1">INICIA SESIÓN</p>
			<p id="l1">E-MAIL</p>
			<input type="text" name="em" id="in1"/>
			<p id="l2">CONTRASEÑA</p>
			<input type="password" name="cont" id="in2"/>
			<input type="submit" id="sub" value="INICIAR"/>
		</form>
		<a id="pcontrec" href="6to/Paginas/registrando.php?c=contlost">HE PERDIDO MI CONTRASEÑA</a>
		</div>
		<div id="div02">
		<p id="t1">¿Aún no tienes cuenta?</p>
		<p id="t2">Elige una de las opciones de aquí abajo y comienza publicitarte</p>
		</div>
		<!-.-------------------------------------------------------------------------.->
		<div id="divbot1">
		<a class="a" href="6to/Paginas/registrando.php?id=1"><img id="CDCimg" src="6to/Img/pincel.png"/>
		<pre id="CDCp">Soy creador de contenido<br>   y quiero publicar aquí.</pre></a>
		</div>
		<!-.-------------------------------------------------------------------------.->
		<div id="divbot2">
		<a class="a" href="6to/Paginas/registrando.php?id=2"><img id="Nimg" src="6to/Img/lentes.png"/>
		<pre id="Np">Solo quiero escuchar alguna canción.</pre></a>
		</div>
		<!-.-------------------------------------------------------------------------.->
		<div id="divbot3">
		<a class="a" href="6to/Paginas/registrando.php?id=3"><img id="Dimg" src="6to/Img/disco.png"/>
		<pre id="Dp">Estoy buscando contenido original<br>       y alguien en quien invertir.</pre></a>
		</div>
		<div id="sectdown">
			<p id="psect">Sube tu música y comienza a vender</p>
			<p id="pasect">Desde el momento que creas tu cuenta como creador de contenido, puedes comenzar a subir canciones<br>y venderlas.</p>
			<img id="money" src="6to/Img/upload.png" />
		</div>
		<div id="sect2">
			<p id="psect2">Escucha canciones de otros artistas independientes</p>
			<p id="pasect2">Mira lo que otras personas tienen para ofrecer. Nunca sabes lo que puedes encontrar.</p>
			<img id="play" src="6to/Img/play.png" />
		</div>
		<div id="sect3">
			<p id="psect3">¿Descargas ilegales?</p>
			<p id="pasect3">Todas tus canciones estarán siempre seguras. Nada ni nadie puede robarlas. Te lo garantizamos.</p>
			<img id="secu" src="6to/Img/seguridad.png" />
		</div>
		<div id="sect4">
			<p id="psect4">Muestras gratis</p>
			<p id="pasect4">Puedes escuchar una parte de la canción. Si te gusta, la compras. Si no, pues no.<br>¿Más sencillo que eso?</p>
			<img id="muestras" src="6to/Img/money.png" />
		</div>
		<div id="signup">
			<div id="div03">
			<p id="t1" style="text-shadow: none;">¿Aún no tienes cuenta?</p>
			<p id="t2" style="text-shadow: none;">Elige una de las opciones de aquí abajo y comienza publicitarte</p>
			</div>
			<!-.-------------------------------------------------------------------------.->
			<div id="divbot11">
			<a class="a" href="6to/Paginas/registrando.php?id=1"><img id="CDCimg" src="6to/Img/pincel.png"/>
			<pre id="CDCp">Soy creador de contenido<br>   y quiero publicar aquí.</pre></a>
			</div>
			<!-.-------------------------------------------------------------------------.->
			<div id="divbot21">
			<a class="a" href="6to/Paginas/registrando.php?id=2"><img id="Nimg" src="6to/Img/lentes.png"/>
			<pre id="Np">Solo quiero escuchar alguna canción.</pre></a>
			</div>
			<!-.-------------------------------------------------------------------------.->
			<div id="divbot31">
			<a class="a" href="6to/Paginas/registrando.php?id=3"><img id="Dimg" src="6to/Img/disco.png"/>
			<pre id="Dp">Estoy buscando contenido original<br>       y alguien en quien invertir.</pre></a>
			</div>
		</div>
		<div id="foother">
			<p id="pfoot">© 2016-2017  ArtSpace</p>
		</div>
	</body>
</html>