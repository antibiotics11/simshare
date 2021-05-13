<!DOCTYPE html>

<html lang = "ko">
<head>
	<meta http-equiv = "content-type" content = "text/html" charset = "utf-8">
	<meta name = "title" content = "simshare">
	<!--<meta name = "viewport" content = "width=device-width, initial-scale=1.0">-->
	<meta property = "og:title" content = "simshare">
	
	<link href = "/webfiles/main.css" rel = "stylesheet" type = "text/css">
	<link href = "/webfiles/images/share.svg" rel = "shortcut icon" >
	<link href = "https://fonts.gstatic.com"  rel = "preconnect">
	<link href = "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel = "stylesheet"> 
	<?php
		// 웹브라우저가 IE일 경우 에러페이지 출력
		$userbrowser = $_SERVER["HTTP_USER_AGENT"];
		if(strpos($userbrowser,"MSIE") !== false || strpos($userbrowser,"Trident") !== false) {
			if ((string)$_GET['check'] != 'y') {
				header('Location: ./?error=ie&check=y');
			}
		}
	?>
</head>

<body>

	<!-- 헤더 영역 -->
	<div id = "header">
		<table style = "width: 20%;">
		<tr>
			<td style = "width: 5%;">
			<div class = "simshare_icon">
				<img src = "/webfiles/images/share.png" alt = "logo">
			</div>
			</td>
			<td style = "width: 15%;">
			<div class = "simshare_title">
				<h1> 
				<a href = "/">
				sim<span style = "color: #4caf50;">share</span>
				</a> 
				</h1>
			</div>
			</td>
		</tr>
		</table>
	</div>
	
	<!-- 콘텐츠 영역 -->
	<div id = "contents">
	<?php
		// act값에 따라 필요한 파일 호출
		{
			if (isset($_GET['act'])) {
				require_once './main/pages/'.$_GET['act'].'.php';
			} else if (isset($_GET['filecode']) || isset($_GET['expdate'])) {
				require_once './main/pages/checkuploaded.php';
			} else if (isset($_GET['error'])) {
				if (file_exists('./main/errors/'.$_GET['error'].'.html')) {
					require_once './main/errors/'.$_GET['error'].'.html';
				} else {
					require_once './main/errors/404.html';
				}
			} else {
				require_once './main/pages/select_action.html';
			}
		}
		
		// download값에 따라 요청받은 파일 다운로드
		if (isset($_GET['download'])) {
			header('Location: ./main/func/download_ok.php?filecode='.$_GET['download']);
		}
	?>
	</div>
	
	<!-- 푸터 영역 -->
	<div id = "footer">
		<p> 
		<a href = "https://www.kunsan.ac.kr">Kunsan National University 2021</a>
		</p>
	</div>
</body>
</html>