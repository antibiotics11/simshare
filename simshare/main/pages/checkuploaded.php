<!-- 파일 업로드 성공시 출력되는 페이지 -->

<?php
	// 파일 다운로드 링크 생성
	$userfilelink = "https://".$_SERVER['SERVER_NAME']."/?download=".$_GET['filecode']; 
?>

<script type = "text/javascript">
	// 링크를 클립보드로 복사
	{
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
	}
</script>

<div id = "aboutpage">
	<h2> File successfully uploaded to simshare! </h2>
	<p> 
	Your File Code: <span style = "color: #4caf50"><?=$_GET['filecode']?></span> 
	<br><br>
	File Download Link <br>
	<a href = "<?=$userfilelink?>"> <?=(string)$userfilelink?> </a> <br>
	<button onclick="copy()" class = "btn1"> Copy link to clipboard </button>
	<br><br>
	File Expiration Date: <?=$_GET['expdate']?> 00:00
	</p>
</div>