<!-- about 페이지 -->

<script type = "text/javascript">
	function langsel(lang) {
		var loc = "https://" + "<?=$_SERVER['SERVER_NAME']?>" + "/?act=about&lang=" + lang;
		location.href = loc;
	}
</script>
<?php
	if ((string)$_GET['lang'] == "ko") {
		$about1 = "simshare는 군산대학교 컴퓨터정보통신공학부 학생이 웹개발 과제로 개발한 웹앱입니다.";
		$about2 = "소스코드는 MIT 라이선스로 배포됩니다.";
		$about3 = "200mb 이하 용량의 파일을 simshare 서버에 업로드해두고 일주일 이내 언제든지 다운받을 수 있습니다.";
		$about4 = "파일 업로드시 암호화 / 압축 옵션을 선택할 수 있습니다.";
	} else {
		$about1 = "simshare was developed as part of web programming project at the Kunsan National University.";
		$about2 = "Source code is deployed under the MIT license.";
		$about3 = "You can upload a file with less than 200mb to the simshare server and download it at any time within a week.";
		$about4 = "When uploading a file, you can encrypt or compress your file.";
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
