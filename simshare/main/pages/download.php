<!-- 파일 다운로드 페이지 -->

<?php
	// 입력받은 값이 코드인지 링크인지 구분
	if (isset($_POST['filecode'])) {
		if (strpos($_POST['filecode'], "https") !== false) {
			header("Location: ".(string)$_POST['filecode']);
		} else {
			header("Location: ./?download=".(string)$_POST['filecode']);
		}
	}
?>

<div id = "uploadform">
	<div id = "inputpasswd">
	<form action = "./?act=download" method = "POST">
		<br><br>
		<span class = "exp"> <?=$download_exp?> </span>
		<br><br>
		<input type = "text" name = "filecode" placeholder = "File code or Download link" required>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> <?=$download_file?> </button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> <?=$homepage?> </button>
	</form>
	</div>
</div>
