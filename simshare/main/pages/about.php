<!-- about 페이지 -->
<script type = "text/javascript">
	function langsel(lang) {
		var loc = "https://" + "<?=$_SERVER['SERVER_NAME']?>" + "/?act=about&lang=" + lang;
		location.href = loc;
	}
</script>

<div id = "aboutpage">
	<h2> About simshare </h2>
	<p> 
	<?=$about1?><br>
	<?=$about2?>
	</p>
	
	<h2> How to use </h2>
	<p> 
	<?=$about3?><br>
	<?=$about4?>
	<a href = "https://<?=$_SERVER["SERVER_NAME"]?>/?act=manual"> User Manual </a>
	</p>

	<h2> Contact </h2>
	<p> [Send Email]&nbsp;
	<a href = "mailto:abx@abx.pe.kr"> abx@abx.pe.kr </a>
	</p>
	<p> [Visit GitHub]&nbsp;
	<a href = "https://github.com/antibiotics11"> https://github.com/antibiotics11 </a>
	</p>

</div>
