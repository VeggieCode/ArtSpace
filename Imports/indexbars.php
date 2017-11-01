<div id="divper">

			<img id="foto" src="../FotosPerfil/<?php echo $_SESSION["foto"]; ?>" onclick="divf()" />
			<p id="nom" style="font-family:circular;" ><?php echo $_SESSION["nombre"]; ?><br><?php echo $_SESSION["apellidos"]; ?></p>
			<?php
			if(isset($_GET["id"]) && !isset($_GET["bus"]) && isset($_GET["c"]))
			{
				?>
				<button class="pointer" id="at" onclick="location='index.php?id=<?php echo $_GET["id"]; ?>&c=<?php echo $_GET["c"]+1; ?>'">ATRAS</button>
				<button class="pointer" id="ad" <?php if($_GET["c"]>=2){?>onclick="location='index.php?id=<?php echo $_GET["id"]; ?>&c=<?php echo $_GET["c"]-1; ?>'"<?php }?>>ADELANTE</button>
				<?php
			}
			if(isset($_GET["id"]) && isset($_GET["bus"]) && isset($_GET["c"]))
			{
				?>
				<button class="pointer" id="at" onclick="location='index.php?id=<?php echo $_GET["id"]; ?>&c=<?php echo $_GET["c"]+1; ?>&bus=<?php echo $_GET["bus"]; ?>&r=<?php echo $_GET["r"]; ?>'">ATRAS</button>
				<button class="pointer" id="ad" <?php if($_GET["c"]>=2){?>onclick="location='index.php?id=<?php echo $_GET["id"]; ?>&c=<?php echo $_GET["c"]-1; ?>&bus=<?php echo $_GET["bus"]; ?>&r=<?php echo $_GET["r"]; ?>'"<?php }?>>ADELANTE</button>
				<?php
			}
			?>
				<button class="pointer" id="busbut" onclick="div()">BUSCAR</button>
				<button class="pointer" id="mybut" onclick="location='perfil.php?id=2'">MI PERFIL</button>
			<?php
			if($_SESSION["tipo"] == 1)
			{
				?>
				<button class="pointer" id="butsub" onclick="location='subir.php'">SUBIR CONTENIDO</button>
				<?php
			}
			?>
			<button class="pointer" id="sal" onclick="location='../../index.php'">SALIR</button>
			<img id="ico" src="../Img/<?php echo $ico; ?>"/>
		</div>
		<div id="divbar">
			<img class="pointer" id="equis" src="../Img/x.png" onclick="div()"/>
			<p id="pbus">BUSCAR</p>
			<form method="POST" action="alt.php?id=5" enctype="multipart/form-data">
				<input type="search" id="bus" name="bus"/>
				<input type="radio" id="r1" name="r" value=1 checked><p id="rp1">POR NOMBRE</p>
				<input type="radio" id="r2" name="r" value=2><p id="rp2">POR AUTOR</p>
				<img class="pointer" id="lupa" src="../Img/lupa.png" onclick="submit()"/>
			</form>
			<hr id="hr"/>
			<p id="ptoptr">TOPs</p>
			<input type="button" id="buttop" class="cursor" onclick="location='index.php?id=3&a=1'" value="REPRODUCCIONES"/>
			<input type="button" id="butdes" class="cursor" onclick="location='index.php?id=3&a=2'" value="DESCARGAS"/>
			<input type="button" id="butcom" class="cursor" onclick="location='index.php?id=3&a=3'" value="COMPRAS"/>
			<input type="button" id="butbuss" class="cursor" onclick="location='index.php?id=3&a=4'" value="BUSQUEDAS"/>
			<hr id="hr2"/>
			<p id="pl">VER ÚLTIMO</p>
			<?php
				$obj->topall();
				if($obj->var2[4] <= 2)
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
			?>
			<a href="ver.php?ic=<?php echo $obj->var2[6];?>&ia=<?php echo $obj->var2[3];?>&t=<?php echo $obj->var2[5]; ?>">
			<img id="imgdivbar" src="../Contenido/<?php echo $i; ?>"/>
			<p id="nomimgdivbar"><?php echo $obj->var2[1]; ?></p>
			<p id="autimgdivbar"><?php $obj->aut($obj->var2[3]); ?></p>
			</a>
		</div>
		<div id="divf">
			<p id="pf1">CAMBIAR FOTO DE PEFIL</p>
			<form method="POST" action="alt.php?id=4" enctype="multipart/form-data">
				<input type="file" id="in" name="foto" />
				<input type="button" id="borimg" value="BORRAR" onclick="location='alt.php?id=4&a=2'" />
				<input type="submit" id="sub" value="GUARDAR" />
			</form>
		</div>