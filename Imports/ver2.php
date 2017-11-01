<?php
$obj->buscar1($_GET["ic"], $_GET["t"]);
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
			if($obj->var2[7] == 1)
			{
				header("Location:index.php");
			}
			?>
			<div id="d1">
				<img id="imgg" src="../Contenido/<?php echo $i; ?>" />
				<p id="nom"><?php echo $obj->var2[1]; ?></p>
				<p id="aut"><?php echo $obj->aut($obj->var2[5]); ?></p>
				<p id="ppag">Comprar ahora</p>
				<p id="pcar">Agregar al carrito</p>
				<p id="pcos">Precio por canción:	$15 MXN</p>
				
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="MZX7KJNS6VT32">
				<input type="image" style="position:absolute;top:34%;left:55%;" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
				<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
				</form>
				
				<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="NJKE5W4952K4E">
				<input type="image" style="position:absolute;top:46%;left:55%;" src="https://www.paypalobjects.com/es_XC/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
				<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
				<a id="vlr" href="ver.php?ic=<?php echo $_GET["ic"]; ?>&ia=<?php echo $obj->var2[5]; ?>&t=<?php echo $obj->var2[6]; ?>">Volver</a>
				</form>
				<div id="brp">
					<img id="paypalimg" src="../Img/paypal.png" />
					<p id="bp1">Con PayPal tu dinero e información siempre estarán seguros.</p>
					<a id="ap1" href="https://www.paypal.com" target="blank">Leer más</a>
					<img id="btrj" src="../Img/tarjetas.png" />
				</div>
			</div>