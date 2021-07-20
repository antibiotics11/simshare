<!-- 파일 업로드 페이지 -->

<div id = "uploadform">
<?php ?>
<script type = "text/javascript" src = "/main/func/alponly.js"></script>
<script type = "text/javascript" src = "/main/pages/upload.js"></script>
<br><br>

<form enctype = "multipart/form-data" action = "./main/func/upload_ok.php" method = "POST">
	
	<!-- 파일 업로드 옵션 선택 -->
	<div style = "display: block;">
		<table>
		<tr>
			<td class = "exp"> Encrypt File &nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name = "encrypt" onChange="showinputpasswd(this.value)">
				<option value = "0"> None </option>
				<option value = "1"> To AES-256 </option>
				<option value = "2"> To SHA-512 </option>
			</select> 
			</td>
		</tr>
		<tr>
			<td class = "exp"> Compress File &nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name = "compress">
				<option value = "0"> None </option>
				<option value = "1"> To zip </option>
				<option value = "2"> To 7zip </option>
				<option value = "3"> To tar </option>
			</select>
			</td>
		</tr>
		</table>
	</div>
	
	<!-- 암호화 옵션 선택시 패스워드 입력창 -->
	<div id = "inputpasswd" style = "display: none;">
		<br><br>
		<span class = "exp">
		Create a password to encrypt your file.
		</span>
		<br><br>
		<input type = "password" name = "passwd" id = "passwd" minlength = "4" maxlength = "10" placeholder = "Password">
		<input type = "password" name = "checksum" id = "checksum" minlength = "4" maxlength = "10" placeholder = "Reenter Password">
	</div>
	
	<!-- 파일 업로드 -->
	<div style = "display: block;">
		<br><br> 
		<input type = "text" id = "filename" class = "filepathbox" placeholder = " File Path" readonly>
		&nbsp;&nbsp;
		<label class = "btn2"> Browse File
			<input type = "file" class = "inputfile" name = "clientfile" onchange = "showfilename(this.value)" style = "display: none;" required>
		</label>
		<br><br><br><br>
		<button class = "btn1" type = "submit"> Upload to simshare</button>
		<button class = "btn1" type = "button" onclick = "history.go(-1)"> Home Page </button>
	</div>
	
</form>
</div>