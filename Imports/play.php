<?php
?>
<script>
function playM(s)
{
	var M = document.getElementById(s);
	M.play();
}
function pauseM(s)
{
	var M = document.getElementById(s);
	M.pause();
}
function replayM(s)
{
	var M = document.getElementById(s);
	M.load();
}
</script>