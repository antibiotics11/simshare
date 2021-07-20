<!-- 파일 업로드 페이지 -->

<div id = "uploadform">
<?php ?>
<script type = "text/javascript" src = "/main/func/alponly.js"></script>
<script type = "text/javascript">
	// 패스워드 입력창 출력 
	function showinputpasswd(value) {
		if (value == 1 || value == 2) {
			document.getElementById("inputpasswd").style.display = "inline";
			document.getElementById("passwd").setAttribute("required", true);
			document.getElementById("checksum").setAttribute("required", true);
		} else {
			if (confirm("Selecting this option may allow third parties to access your files. \nDo you still want to proceed? ")) {
				document.getElementById("inputpasswd").style.display = "none";
				document.getElementById("passwd").removeAttribute("required");
				document.getElementById("checksum").removeAttribute("required");
			} else {
				document.getElementById("encrypt").value = 1;
			}
		}
	}
		
	// 업로드 파일 이름 출력
	function showfilename() {
		var filename = document.getElementById('inputfile').files[0].name;
		document.getElementById('filename').value = filename;
	}
	
	// 파일 업로드 진행상황
	/*
	function progress() {
		$(function() {
			var percent = $('.percent');
			$('form').ajaxForm({
				beforeSend: function() {
					var percentVal = '0%';
					percent.html(percentVal);
				}, uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					percent.html(percentVal);
				}, complete: function() {
					$('form').attr('action', './main/func/upload_ok.php');
					$('form').unbind('submit').submit();
				}
			});
		});
	}
	*/
</script>
<br><br>

<form enctype = "multipart/form-data" action = "./main/func/upload_ok.php" method = "POST">
	
	<!-- 파일 업로드 옵션 선택 -->
	<div style = "display: block;">
		<table>
		<tr>
			<td class = "exp"> Encrypt File &nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name = "encrypt" id = "encrypt" onChange="showinputpasswd(this.value)">
				<option value = "1"> To AES-256 </option>
				<!-- <option value = "2"> To RSA </option> -->
				<option value = "0"> None (Not Recommended)</option>
			</select> 
			</td>
		</tr>
		<tr>
			<td class = "exp"> Compress File &nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name = "compress">
				<option value = "1"> To zip </option>
				<option value = "2"> To bzip2 </option>
				<option value = "3"> To gzip </option>
				<option value = "0"> None </option>
			</select>
			</td>
		</tr>
		</table>
	</div>
	
	<!-- 암호화 옵션 선택시 패스워드 입력창 -->
	<div id = "inputpasswd" style = "display: inline;">
		<br><br>
		<span class = "exp">
		Create a password to encrypt your file.
		</span>
		<br><br>
		<input type = "password" name = "passwd" id = "passwd" minlength = "4" maxlength = "10" placeholder = "Password" required>
		<input type = "password" name = "checksum" id = "checksum" minlength = "4" maxlength = "10" placeholder = "Reenter Password" required>
	</div>
	
	<!-- 파일 업로드 -->
	<div style = "display: block;">
		<br><br> 
		<input type = "text" id = "filename" class = "filepathbox" placeholder = " File Name" readonly>
		&nbsp;&nbsp;
		<label class = "btn2"> Browse File

			<input type = "file" class = "inputfile" id = "inputfile" name = "clientfile" onchange = "showfilename()" style = "display: none;" required>
		</label>
		<br><br>
		<!--
		<div class = "progress">
			<span style = "color: #4caf50;"> Uploading... 
			<div class = "percent" style = "display: inline;">0%</div>
			<span>
		</div>
		-->
		<br><br>
		<button class = "btn1" type = "submit" onclick = "progress()"> Upload to simshare</button>
		<button class = "btn1" type = "button" onclick = "location.href='/'"> Home Page </button>
	</div>
	
</form>
</div>