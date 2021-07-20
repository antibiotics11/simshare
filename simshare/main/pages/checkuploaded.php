<!-- 파일 업로드 성공시 출력되는 페이지 -->

<?php
	// 파일 다운로드 링크 생성
	$userfilelink = "https://".$_SERVER['SERVER_NAME']."/?download=".$_GET['filecode']; 
?>

<script type = "text/javascript">
	function copylink(val) {
		const t = document.createElement("textarea");
		document.body.appendChild(t);
		t.value = val;
		t.select();
		document.execCommand('copy');
		document.body.removeChild(t);
	}

	function copy() {
		copylink('<?=$userfilelink?>');
		alert('Link copied to clipboard');
	}
</script>

<div id = "aboutpage">
	<h2> Successfully uploaded to simshare! </h2>
	<p> 
	Your File Code: <span style = "color: #4caf50"><?=$_GET['filecode']?></span> 
	<br><br>
	Expiry Date: <?=$_GET['expdate']?> 00:00
	<br><br>
	Download Link <br>
	<a href = "<?=$userfilelink?>"> <?=(string)$userfilelink?> </a>
	<br><br><br><br>
	<button onclick="copy()" class = "btn1"> Copy to clipboard </button>
	<button class = "btn1" type = "button" onclick = "location.href='/'"> Home Page </button>
	</p>
</div>