<?php 
	session_start();
	if(!isset($_SESSION["nombre"]))
	{
		header("Location:../../index.php.php");
	}
?>
<!doctype html/>
<html>
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/subir.css"/>
		<link rel="shortcut icon" type="image/png" href="../Img/ico_min.ico" />
		<style>
		@font-face{
			font-family:circular;
			src: url(../CircularStd-Bold.otf);
		}
		</style>
	</head>
	<body>
		<img id="fondo" src="../Img/bs1.jpg"/>
		<a href="index.php"><img id="headlogo" src="../Img/ico_2.png"/></a>
		<p id="p1">ANTES DE EMPEZAR</p>
		<p id="pre1">Antes de subir tu contenido y comenzar a publicitarte debes saber algunas cosas.<br>
		Necesitarás tu archivo <span style="color:orange;">original</span> que deseas publicar y una <span style="color:lightgreen;">versión de muestra</span>.<br>
		Considera que la versión de muestra será la que los usuarios normales podrán ver,<br>
		esto con fines de anti-piratirería (piensa que mientras más muestres, más probabilidades<br>
		hay de que roben tu contenido).<br>
		Si lo deseas, puedes NO subir una versión de muestra. En ese caso se publicará la versión completa,<br>
		existiendo el riesgo de que pueda ser robada.<br>
		Las técnicas para subir versiones de muestra pueden ser desde recortar archivos de audio, colocar etiquetas<br>
		en imágenes, reducir la resolución de tu vídeo, etc.<br>
		Si deseas que tu contenido se venda dentro de la página, debes registrar el folio del acta comprobante de<br>
		los derechos de autor.</p>
		
		<p id="p2">AHORA SI ESTAMOS LISTOS</p>
		<form method="POST" action="alt.php?id=3" enctype="multipart/form-data">
			<p id="l1" class="l">NOMBRA TU OBRA</p>
			<input type="text" id="nom" name="nom" class="in" placeholder="       SIN EXTENSIONES COMO '.JPG'"/>

			<p id="l2" class="l">EL ARCHIVO QUE SUBIRÁS ES:</p>
			<select id="tipo" name="tipo" class="in">
				<option value=2>AUDIO</option>
			</select>
			
			<p id="l3" class="l">SUBE LA VERSIÓN COMPLETA<br>(OBLIGATORIO)</p>
			<input type="file" id="arch1" name="arch1" class="in"/>
			
			<p id="l4" class="l">SUBE LA VERSIÓN DE MUESTRA<br>(OPCIONAL)</p>
			<input type="file" id="arch2" name="arch2" class="in"/>
			
			<p id="l5" class="l">SUBE UNA IMAGEN DE MUESTRA<br>(OPCIONAL)</p>
			<input type="file" id="imgmu" name="imgmu" class="in"/>
			
			<p id="l6" class="l">¿CÓMO DEBEMOS TRATAR A TU OBRA?</p>
			<input type="radio" id="ra1" name="est" value=1 class="in" checked><p id="rap1"class="l">DESEO DISTRIBUIR MI OBRA DE FORMA GRATUITA</p>
			<input type="radio" id="ra2" name="est" value=2 class="in"><p id="rap2"class="l" >DESEO VENDER MI OBRA</p>

			<p id="l7" class="l">FOLIO DE REGISTRO<br>(EN CASO DE QUE DESEES VENDER LA OBRA)</p>
			<input type="text" id="folio" name="folio" class="in"/>
			
			<input type="submit" id="sub" value="SUBIR" class="in"/>
		</form>
	</body>
</html>