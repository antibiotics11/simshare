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
	</p>

	<h2> Contact </h2>
	<p> [Send Email]&nbsp;
	<a href = "mailto:abx@abx.pe.kr"> abx@abx.pe.kr </a>
	</p>
	<p> [Visit GitHub]&nbsp;
	<a href = "https://github.com/antibiotics11"> https://github.com/antibiotics11 </a>
	</p>
	<!--
	* 브라우저 언어 설정을 사용함
	<span style = "color: #4caf50;"> <b>Select Language</b> </span>&nbsp;
	<select id = "langsel" name = "select" onchange = "langsel(this.value)">
<?php 
	if ((string)$_GET['lang'] == "ko") {
		echo "
		<option value = \"ko\"> 한국어 </option>
		<option value = \"en\"> English </option>
		";
	} else {
		echo "
		<option value = \"en\"> English </option>
		<option value = \"ko\"> 한국어 </option>
		";
	}
?>
	</select>
	-->
</div>
