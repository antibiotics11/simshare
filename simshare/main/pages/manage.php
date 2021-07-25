<!-- 파일 관리 페이지 -->

<div id = "uploadform">
	<form action = "./main/func/manage_confirm.php" method = "POST">
	<?php 
		if (!isset($_GET['manage']) || $_GET['manage'] != "delete") {
	?>
		<br><br>
		<span class = "exp">
		<?=$extend_exp?>
		</span>
		<br><br>
		<div id = "inputpasswd">
			<input type = "text" name = "filecode" placeholder = "File code" required>
		</div>
		<br><br><br>
		<button class = "btn1" type = "submit"> <?=$extend?> </button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> <?=$homepage?> </button>
		<br><br><br>
		<div id = "deletefile">
			<a href = "./?act=manage&manage=delete">
			<?=$delete_file?>
			</a>
		</div>
	<?php 
		} else if ($_GET['manage'] == "delete") {
	?>
		<br><br>
		<span class = "exp">
		<?=$del_exp1?>
		<br><br>
		<?=$del_exp2?>
		</span>
		<br><br>
		<div id = "inputpasswd">
			<input type = "text" name = "filecode" placeholder = "File code" required>
			<input type = "password" name = "passwd" id = "passwd" minlength = "4" maxlength = "10" placeholder = "Password" required>
		</div>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> <?=$del_ok?> </button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> <?=$homepage?> </button>
	<?php
		}
	?>
	</form>
</div>