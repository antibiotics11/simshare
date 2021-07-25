<!DOCTYPE html>

<html lang = "ko">
<head>
	<?php
		// 웹브라우저가 IE일 경우 에러페이지 출력
		/*
		$user_browser = $_SERVER["HTTP_USER_AGENT"];
		if(strpos($user_browser,"MSIE") !== false || strpos($u1,2,ser_browser,"Trident") !== false) {
			if ((string)$_GET["check"] != "y") {
				header("Location: ".__DIR__."/?error=ie&check=y");
			}
		}
		*/
		
		// 브라우저 설정 확인해서 언어 파일 호출
		$client_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
		if ($client_lang == "ko-KR" || $client_lang == "ko") {
			include __DIR__."/webfiles/lang/ko.php";
		} else {
			include __DIR__."/webfiles/lang/en.php";
		}
		
		// 해킹 의심시 접속차단
		if (strlen($_SERVER["QUERY_STRING"] > 140)) {
			exit;
		}
	?>
	<meta http-equiv = "content-type" content = "text/html" charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
	<title><?=$meta_title?></title>
	<meta name = "description" content = "<?=$meta_description?>">
	<meta property = "og:title" content = "<?=$meta_title?>">
	<meta property = "og:description" content = "<?=$meta_description?>">
	<meta property = "og:url" content = "simshare.xyz">
	<meta property = "og:type" content = "website">
	
	<!--
	<script src = "https://code.jquery.com/jquery.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity = "sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin = "anonymous"></script>
	-->
	<link href = "/webfiles/main.css" rel = "stylesheet" type = "text/css">
	<link href = "/webfiles/images/share.svg" rel = "shortcut icon">
	<link href = "https://fonts.gstatic.com"  rel = "preconnect">
	<link href = "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel = "stylesheet"> 
</head>

<body>
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
	
	<div id = "contents">
	<?php
	// act값에 따라 필요한 파일 호출
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
		
		// download값에 따라 요청받은 파일 다운로드
		if (isset($_GET['download'])) {
			header('Location: ./main/func/download_ok.php?filecode='.$_GET['download']);
		}
	?>
	</div>
	
	<div id = "footer">
		<p> 
		<a href = "https://<?=$_SERVER["SERVER_NAME"]?>/?act=about">(c) simshare.xyz 2021, About Project</a>
		</p>
	</div>
</body>
</html>