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
	
	// 파일 업로드 폼
	function uploadchange(file) {
		var el = file.parentNode.parentNode.getElementsByTagName("*");
		for (var i = 0; i < el.length; i++) {
			var node = el[i];
			if (node.className == "file-text") {
				node.innerHTML = file.value;
				break;
			}
		}
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
				<!-- tar.gz 옵션은 현재 사용하지 않지만 추후 업데이트 계획 -->
				<!-- <option value = '2'> To tar.gz </option> -->
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
	<style type = "text/css">
	.box {
  margin: 50px auto;
  width: 500px;
}

.filetype {
  position: relative;
  display: inline-block;
  vertical-align: top;
  *margin-right: 4px;
}

.filetype * {
  vertical-align: middle;
}

.filetype .file-text {
  position: relative;
  width: 350px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  display: inline-block;
  height: 20px;
  background-color: #ecefef;
  margin: 0;
  border: 1px solid #cdd3d4;
  line-height: 20px;
  z-index: 10;
}

.filetype .file-select {
  position: absolute;
  top: 0;
  right: 0;
  width: 80px;
  overflow: hidden;
}

.filetype .file-select .input-file {
  width: 60px;
  filter: alpha(opacity=0);
  opacity: 0;
  height: 20px;
}

.filetype .file-text + .file-btn {
  display: inline-block;
  background-color: #cdd3d4;
  height: 22px;
  line-height: 22px;
  padding: 0 15px;
  color: #fff !important;
  cursor: pointer;
  *margin-left: 4px;
}
</style>
		<div class="box">
		<span class="filetype">
		<span class="file-text"></span>
		<span class="file-btn">찾아보기</span>
		<span class="file-select">
		<input id = "input-file" type = "file" name = "clientfile" onchange="uploadchange(this);">
		</span>
		</span>
		</div>
		<br><br>
		<button class = "btn1" type = "submit"> Upload File to simshare</button>
		<button class = "btn1" type = "button" onclick = "history.go(-1)"> Previous Page </button>
	</div>
	
</form>
</div>