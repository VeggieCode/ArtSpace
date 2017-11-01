<?php
?>
<script>
var n = 0;
var h = <?php if(!isset($_GET["h"])){ echo "0";}else{echo "1";} ?>;
function click()
{
	if(n%2 != 0)
	{
		document.getElementById("divper").style.right='-20vw';
		document.getElementById("divbar").style.right='0vw';
		h = 0;
	}
	if(n%2 == 0)
	{
		document.getElementById("divper").style.right='0vw';
		document.getElementById("divbar").style.right='-20vw';
	}
	if(h%2 != 0 && n%2 == 0)
	{
		document.getElementById("divf").style.right='9vw';
	}
	if(h%2 == 0 || n%2 != 0)
	{
		document.getElementById("divf").style.right='-30vw';
	}
}
function div()
{
	n++;
	click();
}
function divf()
{
	h++;
	click();
}
if(h%2 != 0 && n%2 == 0)
{
	document.getElementById("divf").style.right='9vw';
}
if(h%2 == 0 || n%2 != 0)
{
	document.getElementById("divf").style.right='-30vw';
}
</script>