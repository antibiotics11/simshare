<!-- 파일 관리 페이지 -->

<div id = "manageform">
<script type = "text/javascript" src = "/main/func/alponly.js"></script>

	<div id = "inputpasswd">
	<form action = "./?act=manage" method = "POST">
		<br><br>
		<span class = "exp">
		You can extend the expiration date or delete file.
		</span>
		<br><br>
		<input type = "text" name = "filecode" placeholder = "File code or Download link" required>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> Download File </button>
		<button class = "btn1" type = "button" onclick = "history.go(-1)"> Home Page </button>
	</form>
	</div>
	
	<?php 
		if (!isset($_GET['manage'])) {
			header('Location: https://'.$_SERVER['SERVER_NAME'].'/?act=manage&manage=extend');
		}
	
		if ($_GET['manage'] == "extend") {
			echo "
			<option value = \"ko\"> 한국어 </option>
			<option value = \"en\"> English </option>
			";
		} else if ($_GET['manage'] == "delete") {
			echo "
			<option value = \"en\"> English </option>
			<option value = \"ko\"> 한국어 </option>
			";
		}
	?>
</div>