<!DOCTYPE html>

<html lang = "ko">
<head>
	<meta http-equiv = "content-type" content = "text/html" charset = "utf-8">
	<meta name = "title" content = "simshare">
	<!--<meta name = "viewport" content = "width=device-width, initial-scale=1.0">-->
	<meta property = "og:title" content = "simshare">
	
	<link href = "./webfiles/main.css" rel = "stylesheet" type = "text/css">
	<link href = "./webfiles/images/share.svg" rel = "shortcut icon" >
	<link href = "https://fonts.gstatic.com"  rel = "preconnect">
	<link href = "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel = "stylesheet"> 
</head>

<body>

	<!-- 헤더 영역 -->
	<div id = "header">
		<table style = "width: 20%;">
		<tr>
			<td style = "width: 5%;">
			<div class = "simshare_icon">
				<img src = "./webfiles/images/share.png" alt = "logo">
			</div>
			</td>
			<td style = "width: 15%;">
			<div class = "simshare_title">
				<h1> 
				<a href = "./">
				sim<span style = "color: #4caf50;">share</span>
				</a> 
				</h1>
			</div>
			</td>
		</tr>
		</table>
	</div>
	
	<!-- 콘텐츠 영역: 파라미터로 파일 호출 -->
	<div id = "contents">
	<?php
		if (isset($_GET['act'])) {
			require_once __DIR__ . '/main/pages/'.$_GET['act'].'.php';
		} else if (isset($_GET['filecode']) || isset($_GET['expdate'])) {
			require_once __DIR__ . '/main/pages/checkuploaded.php';
		} else if (isset($_GET['error'])) {
			require_once __DIR__ . '/main/errors/'.$_GET['error'].'.html';
		} else {
			require_once __DIR__ . '/main/pages/select_action.html';
		}
	?>
	</div>
	
	<!-- 푸터: 군산대학교 -->
	<div id = "footer">
		<p> 
		<a href = "https://www.kunsan.ac.kr">Kunsan National University 2021</a>
		</p>
	</div>
</body>
</html>