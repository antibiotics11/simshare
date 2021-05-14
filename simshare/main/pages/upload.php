<!-- 파일 업로드 페이지 -->

<div id = "uploadform">
<!-- 스크립트 -->
<?php ?>
<script type = "text/javascript">

	// 패스워드 입력창 출력 
	function showinputpasswd(value) {
		if (value == 1) {
			document.getElementById("inputpasswd").style.display = "inline";
			document.getElementById("passwd").setAttribute("required", true);
			document.getElementById("checksum").setAttribute("required", true);
		} else {
			document.getElementById("inputpasswd").style.display = "none";
			document.getElementById("passwd").removeAttribute("required");
			document.getElementById("checksum").removeAttribute("required");
		}
	}
	
	// 패스워드에 알파벳 및 숫자만 입력
	function alponly(e)  {
		e.value = e.value.replace(/[^\\!-z]/gi,"");
	}
	
	// 업로드 파일 이름 출력
	function showfilename(filepath) {
		document.getElementById('filename').value = filepath;
	}

</script>
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
			</select> 
			</td>
		</tr>
		<tr>
			<td class = "exp"> Compress File &nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name = "compress">
				<option value = "0"> None </option>
				<option value = "1"> To zip </option>
			</select>
			</td>
		</tr>
		</table>
	</div>
	
	<!-- 암호화 옵션 선택시 패스워드 입력창 -->
	<div id = "inputpasswd" style = "display: none;">
		<br><br>
		<span class = "exp">
		Create a password to encrypt your file with the AES-256 algorithm.
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
		<button class = "btn1" type = "submit"> Upload File to simshare</button>
		<button class = "btn1" type = "button" onclick = "history.go(-1)"> Previous Page </button>
	</div>
	
</form>
</div>