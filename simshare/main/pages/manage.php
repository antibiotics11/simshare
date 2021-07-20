<!-- 파일 관리 페이지 -->

<div id = "uploadform">
	<form action = "./main/func/manage_confirm.php" method = "POST">
	<?php 
		if (!isset($_GET['manage']) || $_GET['manage'] != "delete") {
	?>
		<br><br>
		<span class = "exp">
		The expiry date can be extended up to 3 times. 
		</span>
		<br><br>
		<div id = "inputpasswd">
			<input type = "text" name = "filecode" placeholder = "File code" required>
		</div>
		<br><br><br>
		<button class = "btn1" type = "submit"> Extend </button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> Home Page </button>
		<br><br><br>
		<div id = "deletefile">
			<a href = "./?act=manage&manage=delete">
			Want to delete file?
			</a>
		</div>
	<?php 
		} else if ($_GET['manage'] == "delete") {
	?>
		<br><br>
		<span class = "exp">
		Deleting file permanently removes your file from the simshare server. 
		<br><br>
		This cannot be undone. please be certain.
		</span>
		<br><br>
		<div id = "inputpasswd">
			<input type = "text" name = "filecode" placeholder = "File code" required>
			<br><br>
			<input type = "password" name = "passwd" id = "passwd" minlength = "4" maxlength = "10" placeholder = "Password" required>
			<input type = "password" name = "checksum" id = "checksum" minlength = "4" maxlength = "10" placeholder = "Reenter Password" required>
		</div>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> Delete </button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> Home Page </button>
	<?php
		}
	?>
	</form>
</div>