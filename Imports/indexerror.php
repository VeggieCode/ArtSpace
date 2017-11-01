<?php
if(isset($_GET["error"]))
{
	if($_GET["error"] == 1)
	{
		?>
		<script>
			alert("Ha ocurrido un problema \nPorfavor vuelva a intentarlo");
			window.location.assign("../../index.php");
		</script>
		<?php
	}
	if($_GET["error"] == 101)
	{
		?>
		<script>
			alert("La búsqueda está vacía \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
	if($_GET["error"] == 102)
	{
		?>
		<script>
			alert("No se encontraron resultados \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
	if($_GET["error"] == 23)
	{
		?>
		<script>
			alert("No se subió ninguna imagen \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
	if($_GET["error"] == 24)
	{
		?>
		<script>
			alert("La imagen no es válida \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
	if($_GET["error"] == 25)
	{
		?>
		<script>
			alert("Ocurrió un error desconocido \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
	if($_GET["error"] == "m")
	{
		?>
		<script>
			alert("Ocurrió un error desconocido \nPorfavor vuelva a intentarlo");
			window.location.assign("index.php");
		</script>
		<?php
	}
}
?>