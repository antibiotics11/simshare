<!-- 파일 업로드 페이지 -->

<div id = "uploadform">
<script type = "text/javascript">

	// 패스워드 입력창 출력 
	function showinputpasswd(value) {
		if (value == 1) {
			document.getElementById("inputpasswd").style.display = "inline-block";
			$("[name=passwd]").attr("required" , true);
			$("[name=checksum]").attr("required" , true);
		} else {
			document.getElementById("inputpasswd").style.display = "none";
			$("[name=passwd]").attr("required" , false);
			$("[name=checksum]").attr("required" , false);
		}
	}
	
	// 패스워드에 알파벳 및 숫자만 입력
	function alponly(e)  {
		e.value = e.value.replace(/[^\\!-z]/gi,"");
	}
</script>

<form enctype = "multipart/form-data" action = "./main/func/upload_ok.php" method = "POST">
	<div style = "display: block;">
	<table>
	<tr>
		<td> Encrypt File </td>
		<td> Compress File </td>
	</tr>
	<tr>
		<td>
		<select name = "encrypt" onChange="showinputpasswd(this.value)">
			<option value = "0"> None </option>
			<option value = "1"> To AES-256 </option>
		</select>
		</td>
		<td>
		<select name = "compress">
			<option value = "0"> None </option>
			<option value = "1"> To zip </option>
		</select>
		</td>
	</tr>
	</table>
	</div>
	
	<div id = "inputpasswd" style = "display: none;">
		<input type = "password" name = "passwd" minlength = "4" maxlength = "10" placeholder = "Password" required = "required">
		<input type = "checksum" name = "checksum" minlength = "4" maxlength = "10" placeholder = "Enter Password again" required = "required">
	</div>
	
	<div style = "display: block;">
	<input class = "" type = "file" name = "clientfile">
	
	<button class = "btn1" type = "submit"> Upload File to simshare</button>
	</div>
</form>
</div>