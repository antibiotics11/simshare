<!-- about 페이지 -->

<script type = "text/javascript">
	function langsel(lang) {
		var loc = "https://" + "<?=$_SERVER['SERVER_NAME']?>" + "/?act=about&lang=" + lang;
		location.href = loc;
	}
</script>
<?php
	if ((string)$_GET['lang'] == "ko") {
		$about1 = "군산대학교 웹개발 과제로 개발되었으며, 현재는 개인 프로젝트로 진행하고 있습니다.";
		$about2 = "";
		$about3 = "최대 200mb 용량의 파일을 업로드하고 공유할 수 있습니다.";
		$about4 = "";
	} else {
		$about1 = "It was initially developed as part of web programming project at the Kunsan National University, but is now being developed as a personal project.";
		$about2 = "";
		$about3 = "You can upload a file up to 200mb, and share it with others.";
		$about4 = "";
	}
?>

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
</div>
