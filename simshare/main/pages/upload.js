// upload 페이지 js 스크립트

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
	
// 업로드 파일 이름 출력
function showfilename(filepath) {
	document.getElementById('filename').value = filepath;
}