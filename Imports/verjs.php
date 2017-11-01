<?php
?>
<script>
	var l = <?php if($obj->verlista1($_GET["ic"]) == false){echo "0";}else{echo "1";} ?>;
	function s{
		l++;
		wl();
	}
	function wl{
		if(l%2 == 0)
		{
			getElementById('add').scr= "../Img/plus.png";
		}
		if(l%2 != 0)
		{
			getElementById('add').scr= "../Img/minus.png";
		}
	}
</script>