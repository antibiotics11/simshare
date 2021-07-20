<!-- 파일 다운로드 페이지 -->

<?php
	// 입력받은 값이 코드인지 링크인지 구분
	if (isset($_POST['filecode'])) {
		if (strpos($_POST['filecode'], "https") !== false) {
			header('Location: '.$_POST['filecode']);
		} else {
			header('Location: ./?download='.$_POST['filecode']);
		}
	}
?>

<div id = "uploadform">
	<div id = "inputpasswd">
	<form action = "./?act=download" method = "POST">
		<br><br>
		<span class = "exp">
		Enter Your file code or download link.
		</span>
		<br><br>
		<input type = "text" name = "filecode" placeholder = "File code or Download link" required>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> Download File </button>
		<button class = "btn1" type = "button" onclick = "history.go(-1)"> Home Page </button>
	</form>
	</div>
</div>
