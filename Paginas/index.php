<?php
	//session_start();
	require_once("../clases/CUsuario.php");
	$obj = new CUsuario();
	$bgran = rand(1,10);
	
	if(empty($_SESSION["nombre"]))
	{
		header('Location:../../index.php?error=2');
	}
	
	include("../Imports/indexerror.php");
	
	switch($_SESSION["tipo"])
	{
		case 1:{
			$ico = "pincel.png";
			break;
		}
		case 2:{
			$ico = "lentes.png";
			break;
		}
		case 3:{
			$ico = "disco.png";
			break;
		}
	}
?>
<!doctype html/ >
<html lang="es-MX">
	<head>
		<title>ArtSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/index.css"/>
		<link rel="shortcut icon" type="image/png" href="../Img/ico_min.ico" />
		<style>
		@font-face{
			font-family:circular;
			src: url(../CircularStd-Bold.otf);
		}
		<?php
			if(!isset($_GET["id"]))
			{
				?>
		#headlogo{
			left:42%;
		}
				<?php
			}
		?>
		</style>
		<?php
		include("../Imports/indexjs.php");
		include("../Imports/play.php");
		?>
	</head>
	<body>
		<img id="fondo" src="../Img/bi<?php echo $bgran; ?>.jpg"/>
		<a href="index.php"><img id="headlogo" src="../Img/ico_2.png"/></a>
		<?php
		include("../Imports/indexbars.php");
		?>
		<?php
		$obj->top(2);
		if(!isset($_GET["id"]))
		{
			if(!is_file("../Contenido/".$obj->var2[2].".png"))
			{
				$foto = "mdefault.png";
			}
			else
			{
				$foto = $obj->var2[2].'.png';
			}
			?>
			<div id="divm"><!------------------------------------------------------------------------------------>
				<p id="pm">MÚSICA</p>
				<img id="mm" class="pointer" src="../Contenido/<?php  echo $foto; ?>" onclick="location='ver.php?ic=<?php echo $obj->var2[5]; ?>'"/>
				<p id="not"><?php echo $obj->var2[1]; ?></p>
				<p id="not2"><?php $obj->aut($obj->var2[3]); ?></p>
				<a id="mlink" href="index.php?id=1&c=1">VER TODO</a>
			</div>
			<?php
			$obj->randmusic();
			if(!is_file("../Contenido/".$obj->muestra[2].".png"))
			{
				$foto = "mdefault.png";
			}
			else
			{
				$foto = $obj->muestra[2].'.png';
			}
			?>
			<div id="divm2" style="left:50vw;"><!------------------------------------------------------------------------------------>
				<p id="pmd">TAL VEZ TE INTERESE...</p>
				<img id="mm" class="pointer" src="../Contenido/<?php  echo $foto; ?>" onclick="location='ver.php?ic=<?php echo $obj->muestra[4]; ?>'"/>
				<p id="not"><?php echo $obj->muestra[1]; ?></p>
				<p id="not2"><?php $obj->aut($obj->muestra[5]); ?></p>
				<a id="mlink" href="ver.php?ic=<?php echo $obj->muestra[4]; ?>">VER</a>
			</div>
			<?php
		}
		if(isset($_GET["id"])&&$_GET["id"] == 1)
		{
			$obj->musics(2,5);
			foreach($obj->posts as $song)
			{
			if($song[2] == 1)
			{
				$can = $song[1].'_C.mp3';
				$foto = "mdefault.png";
			}
			if($song[2] == 2)
			{
				$can = $song[1].'_M.mp3';
				$foto = "mdefault.png";
			}
			if($song[2] == 3)
			{
				$can = $song[1].'_M.mp3';
				$foto = $song[1].'.png';
				if(!is_file("../Contenido/".$foto))
				{
					$foto = "mdefault.png";
				}
			}
			if($song[2] == 4)
			{
				$can = $song[1].'_C.mp3';
				$foto = $song[1].'.png';
				if(!is_file("../Contenido/".$foto))
				{
					$foto = "mdefault.png";
				}
			}
			?>
			<div id="bm">
				<a id="aid" href="ver.php?ic=<?php echo $song[3];?>&ia=<?php echo $song[4]; ?>&t=<?php echo $song[5]; ?>"><img id="contfoto" src="../Contenido/<?php echo $foto; ?>"/>
				<p id="contnom"><?php echo $song[0]; ?></p>
				<p id="autnom"><?php echo $obj->aut($song[4]); ?></p></a>
				<a onclick='window.open("alt.php?id=6&cont=<?php echo $song[3]; ?>", "_blank", "", "true")'>
				<img class="cursor" id="play" src="../Img/play.png" onclick="playM(<?php echo $song[3]; ?>);"/>
				</a>
				</a>
				<img class="cursor" id="pause" src="../Img/pause.png" onclick="pauseM(<?php echo $song[3]; ?>)"/>
				<img class="cursor" id="replay" src="../Img/re.png" onclick="replayM(<?php echo $song[3]; ?>)"/>
				<audio id="<?php echo $song[3]; ?>">
					<source src="../Contenido/<?php echo $can; ?>" type="audio/mpeg">
					Tu explorador no soporta los archivos de audio.
				</audio>
				<?php
				if($song[6] == 2)
				{
				?>
				<p id="pav">VERSIÓN DE MUESTRA</p>
				<?php
				}
				?>
			</div>
			<?php
			}
		}
		if(isset($_GET["id"])&&$_GET["id"] == 2)
		{
			$obj->musics(1,20);
			foreach($obj->posts as $song)
			{
				if($song[2] <= 2)
				{
					$foto = $song[1].'_C.png';
				}
				if($song[2] >= 3)
				{
					$foto = $song[1].'.png';
				}
				?>
			<div id="bi">
				<a id="aid" href="ver.php?ic=<?php echo $song[3];?>&ia=<?php echo $song[4]; ?>&t=<?php echo $song[5]; ?>"><img id="contfoto1" src="../Contenido/<?php echo $foto; ?>"/>
				<p id="contnom1"><?php echo $song[0]; ?></p>
				<p id="autnom1"><?php echo $obj->aut($song[4]); ?></p></a>
			</div>
			<?php
			}
		}
		if(isset($_GET["id"]) && $_GET["id"] == 3)
		{
			if($obj->toprep($_GET["a"]) == false)
			{
				?>
			<p id="vacio">No se encontraron resultados</p>
				<?php
			}
			foreach($obj->posts as $top)
			{
				$obj->buscar1($top[1], 2);
				if($obj->var2[3] == 1)
				{
					$can = $obj->var2[2].'_C.mp3';
					$foto = "mdefault.png";
				}
				if($obj->var2[3] == 2)
				{
					$can = $obj->var2[2].'_M.mp3';
					$foto = "mdefault.png";
				}
				if($obj->var2[3] == 3)
				{
					$can = $obj->var2[2].'_M.mp3';
					$foto = $obj->var2[2].'.png';
					if(!is_file("../Contenido/".$foto))
				{
					$foto = "mdefault.png";
				}
				}
				if($obj->var2[3] == 4)
				{
					$can = $obj->var2[2].'_C.mp3';
					$foto = $obj->var2[2].'.png';
					if(!is_file("../Contenido/".$foto))
					{
						$foto = "mdefault.png";
					}
				}
				?>
				<div id="bm">
					<a id="aid" href="ver.php?ic=<?php echo $obj->var2[4];?>&ia=<?php echo $obj->var2[5]; ?>&t=<?php echo $obj->var2[6]; ?>"><img id="contfoto" src="../Contenido/<?php echo $foto; ?>"/>
					<p id="contnom"><?php echo $obj->var2[1]; ?></p>
					<p id="autnom"><?php echo $obj->aut($obj->var2[5]); ?></p></a>
					<a onclick='window.open("alt.php?id=6&cont=<?php echo $obj->var2[4]; ?>&a=1", "_blank", "", "true")'>
					<img class="cursor" id="play" src="../Img/play.png" onclick="playM(<?php echo $obj->var2[4]; ?>);"/>
					</a>
					</a>
					<img class="cursor" id="pause" src="../Img/pause.png" onclick="pauseM(<?php echo $obj->var2[4]; ?>)"/>
					<img class="cursor" id="replay" src="../Img/re.png" onclick="replayM(<?php echo $obj->var2[4]; ?>)"/>
					<audio id="<?php echo $obj->var2[4]; ?>">
						<source src="../Contenido/<?php echo $can; ?>" type="audio/mpeg">
						Tu explorador no soporta los archivos de audio.
					</audio>
					<?php
					if($obj->var2[7] == 2)
					{
					?>
					<p id="pav">VERSIÓN DE MUESTRA</p>
					<?php
					}
					?>
				</div>
			<?php
			}
					
		}
		if(isset($_GET["id"]) && $_GET["id"] == 109)
		{
			$obj->buscar($_GET["bus"],$_GET["r"],$_GET["c"]);
			foreach($obj->muestra as $contt)
			{

				if($contt[5] == 2)
				{
					if($contt[2] == 1)
					{
						$can = $contt[1].'_C.mp3';
						$foto = "mdefault.png";
					}
					if($contt[2] == 2)
					{
						$can = $contt[1].'_M.mp3';
						$foto = "mdefault.png";
					}
					if($contt[2] == 3)
					{
						$can = $contt[1].'_M.mp3';
						$foto = $contt[1].'.png';
						if(!is_file("../Contenido/".$foto))
						{
							$foto = "mdefault.png";
						}
					}
					if($contt[2] == 4)
					{
						$can = $contt[1].'_C.mp3';
						$foto = $contt[1].'.png';
						if(!is_file("../Contenido/".$foto))
						{
							$foto = "mdefault.png";
						}
					}
					$obj->verbus($contt[3]);
			?>
					<div id="bm">
						<a id="aid" href="ver.php?ic=<?php echo $contt[3];?>&ia=<?php echo $contt[4]; ?>&t=<?php echo $contt[5]; ?>"><img id="contfoto" src="../Contenido/<?php echo $foto; ?>"/>
						<p id="contnom"><?php echo $contt[0]; ?></p>
						<p id="autnom"><?php echo $obj->aut($contt[4]); ?></p></a>
						<a onclick='window.open("alt.php?id=6&cont=<?php echo $contt[3]; ?>", "_blank", "", "true")'>
						<img class="cursor" id="play" src="../Img/play.png" onclick="playM(<?php echo $contt[3]; ?>);"/>
						</a>
						</a>
						<img class="cursor" id="pause" src="../Img/pause.png" onclick="pauseM(<?php echo $contt[3]; ?>)"/>
						<img class="cursor" id="replay" src="../Img/re.png" onclick="replayM(<?php echo $contt[3]; ?>)"/>
						<audio id="<?php echo $contt[3]; ?>">
							<source src="../Contenido/<?php echo $can; ?>" type="audio/mpeg">
							Tu explorador no soporta los archivos de audio.
						</audio>
						<?php
						if($contt[6] == 2)
						{
						?>
						<p id="pav">VERSIÓN DE MUESTRA</p>
						<?php
						}
						?>
					</div>
			<?php
				}
			}
		}
		?>
	</body>
</html>