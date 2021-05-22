// 링크를 클립보드로 복사
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