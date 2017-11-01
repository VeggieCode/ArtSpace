<?php
	require_once("../clases/CUsuario.php");
	$obj = new CUsuario();
	$bgran = rand(1,10);
	if(empty($_SESSION["nombre"]))
	{
		header('Location:../../index.php?error=2');
	}
	if(empty($_GET["ic"]))
	{
		header('Location:../../index.php?error=2');
	}
	include("../Imports/play.php");
	include("../Imports/verjs.php");
?>
<!doctype html/>
<html>
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/ver.css"/>
		<link rel="shortcut icon" type="image/png" href="../Img/ico_min.ico" />
		<style>
		@font-face{
			font-family:circular;
			src: url(../CircularStd-Bold.otf);
		}
		</style>
	</head>
	<body>
		<img id="fondo" src="../Img/bi<?php echo $bgran; ?>.jpg"/>
		<a href="index.php"><img id="headlogo" src="../Img/ico_2.png"/></a>
		<?php
		if(!isset($_GET["c"]))
		{
		?>
		<div id="d1">
		<?php if($obj->buscar1($_GET["ic"], $_GET["t"]) == false)
		{
			?>
			<script>
			location.assign("ver.php?ic=<?php echo $_GET["ic"]-1; ?>&ia=<?php echo $_GET["ia"]; ?>&t=<?php echo $_GET["t"]; ?>");
			</script>
			<?php
		}	
		$xbv = $obj->var2[4];		
			if($obj->var2[3] <= 2)
			{
				$i = $obj->var2[2].'_C.png';
				if(!is_file("../Contenido/".$i))
				{
					$i = "mdefault.png";
				}
			}
			else
			{
				$i = $obj->var2[2].'.png';
				if(!is_file("../Contenido/".$i))
				{
					$i = "mdefault.png";
				}
			}
			if($obj->var2[3] == 1)
			{
				$can = $obj->var2[2].'_C.mp3';
			}
			if($obj->var2[3] == 2)
			{
				$can = $obj->var2[2].'_M.mp3';
			}
			if($obj->var2[3] == 3)
			{
				$can = $obj->var2[2].'_M.mp3';
			}
			if($obj->var2[3] == 4)
			{
				$can = $obj->var2[2].'_C.mp3';
			}
			$obj->verrep($obj->var2[4]);
		?>
		<img id="imgg" src="../Contenido/<?php echo $i; ?>" />
		<p id="nom"><?php echo $obj->var2[1]; ?></p>
		<p id="aut"><?php echo $obj->aut($obj->var2[5]); ?></p>
		<img id="play" src="../Img/play.png" onclick="playM(<?php echo $obj->var2[4]; ?>)"/>
		<img id="pause" src="../Img/pause.png" onclick="pauseM(<?php echo $obj->var2[4]; ?>)"/>
		<img id="replay" src="../Img/re.png" onclick="replayM(<?php echo $obj->var2[4]; ?>)"/>

		<a onclick='window.open("alt.php?id=11&cont=<?php echo $xbv; ?>&a=<?php if($obj->verlista1($_GET["ic"]) == false){echo "s";}else{echo "q";} ?>", "_blank", "", "true")'>
		<img id="add" src="../Img/<?php if($obj->verlista1($_GET["ic"]) == false){echo "plus.png";}else{echo "minus.png";}?>" onclick="s()"/>
		</a>
		<?php
		if($obj->var2[7] == 1)
		{
			?>
			<img id="download" src="../Img/download.png" onclick="location='dd.php?ind=<?php echo $obj->var2[4]; ?>&t=<?php echo $obj->var2[6]; ?>'"/>
			<?php
		}
		if($obj->var2[7] == 2)
		{
			?>
			<img id="buy" src="../Img/money.png" onclick="location='ver.php?ic=<?php echo $obj->var2[4]; ?>&t=<?php echo $obj->var2[6]; ?>&c=true'"/>
			<?php
		}
		?>
		<audio id="<?php echo $obj->var2[4]; ?>">
			<source src="../Contenido/<?php echo $can; ?>" type="audio/mpeg">
			Tu explorador no soporta los archivos de audio.
		</audio>
		<?php
			if($obj->var2[7] == 2)
			{
				?>
		<p id="adv">ÉSTA ES UNA VERSIÓN DE MUESTRA.<br>PARA ESCUCHAR LA CANCIÓN COMPLETA,<br>FAVOR DE <a href="ver.php?ic=<?php echo $obj->var2[4]; ?>&t=<?php echo $obj->var2[6]; ?>&c=true" id="a2">COMPRAR EL ARTÍCULO</a></p>
				<?php
			}
		?>
		<hr id="hrv"/>
		<div id="dmm">
		<?php $obj->musicaut($_GET["t"], $obj->var2[5]);
			foreach($obj->muestra as $muestra)
			{
				if($muestra[3] == 1)
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
		if(isset($_GET["c"]) && $_GET["c"] == "true")
		{
			include("../Imports/ver2.php");
		}
		?>
	</body>
	<script type="text/javascript">
			var mu = document.getElementById("<?php echo $obj->var2[4]; ?>");
			mu.autoplay = true;
			mu.load();
			mu.onended = function()
			{
			window.location.assign("ver.php?ic=<?php echo $_GET["ic"]+1; ?>&ia=<?php echo $_GET["ia"]; ?>&t=<?php echo $_GET["t"]; ?>");
			};
	</script>
</html>