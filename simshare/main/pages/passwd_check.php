<!-- 암호화된 파일 패스워드 입력 페이지 -->

<!DOCTYPE html>
<html lang = "ko">
<head>
<meta http-equiv = "content-type" content = "text/html" charset = "utf-8">
	<meta name = "title" content = "simshare">
	<meta property = "og:title" content = "simshare">
	<link href = "/webfiles/main.css" rel = "stylesheet" type = "text/css">
	<link href = "/webfiles/images/share.svg" rel = "shortcut icon" >
	<link href = "https://fonts.gstatic.com"  rel = "preconnect">
	<link href = "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel = "stylesheet"> 
</head>
<body>
	<div id = "uploadform" style = "text-align: center;">
	<script type = "text/javascript">
		function alponly(e)  {
			e.value = e.value.replace(/[^\\!-z]/gi,"");
		}
	</script>
	<form action = "../func/download_ok.php?filecode=<?=(string)$_GET['filecode']?>" method = "POST">
		<div id = "inputpasswd">
			<br><br>
			<span class = "exp">
			The file you requested is encrypted. <br>
			Enter your password to download your file. 
			</span>
			<br><br>
			<input type = "password" name = "passwd" id = "passwd" minlength = "4" maxlength = "10" placeholder = "Password" required>
			<br><br>
			<button class = "btn1" type = "submit"> Submit Password </button>
			<button class = "btn1" type = "button" onclick = "history.go(-1)"> Previous Page </button>
		</div>
	</form>
	</div>
</body>
</html>