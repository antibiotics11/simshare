<?php
	// 사용자 요청시 파일 다운로드를 처리하는 php 파일
	
	ini_set('memory_limit','256M');
	
	// 에러 출력 함수
	function errorpopup($message) {
		echo "
		<script type = 'text/javascript'>
			alert('".(string)$message."');
			window.location.href = '../';
		</script>
		";
		return 0;
	}
	
	// 기한 만료된 파일 삭제
	include_once './auto_del_file.php';
	autodel();
	
	// 파일 없으면 종료
	$filecreated = "../../clientfiles/".$_GET['filecode'];
	if (isset($_GET['filecode'])) {
		if (!file_exists($filecreated)) {
			$message = "No matching file found";
			errorpopup($message);
			exit;
		}
	}
	
	$filecode = $_GET['filecode'];
	
	// db 접속해서 파일 암호화여부, 압축여부 확인
	include './db.php';
	$conn = mysqli_connect("$hostname","$dbuserid","$dbpasswd","simshare");
	$encoding = "set names utf8;";
	$set_encoding = mysqli_query($conn, $encoding);
	$check_sql = "select * from clientfiles where code='$filecode';";
	$check_result = mysqli_query($conn, $check_sql);
	while ($fileinfo = mysqli_fetch_array($check_result)) {
		if (!empty($fileinfo['passwd'])) {
			$userpasswd = $fileinfo['passwd'];
			$encrypted = True;
		} 
		$zipfile = (int)$fileinfo['zip'];
		$ori_filename = $fileinfo['filename'];
		$ori_filename = preg_replace("/\s+/","%",$ori_filename);
	}
	
	// 임시 디렉터리로 파일 복사
	copy($filecreated, "../../tmpfiles/".$filecode);
	$filecreated = "../../tmpfiles/".$filecode;
	
	// 패스워드 확인 후 임시 디렉터리 파일 복호화
	
	if (isset($encrypted)) {
		if (!isset($_POST['passwd'])) {
			header('Location: ../pages/passwd_check.php?filecode='.$filecode);
		}
		$checkpasswd_hased = (string)md5((string)$_POST['passwd']);
		$checkpasswd = substr(hash('sha256', (string)$checkpasswd_hased, true), 0, 32);
		if ((string)$checkpasswd_hased != (string)$userpasswd) {
			$message = "Incorrect Password";
			errorpopup($message);
			exit;
		}
		$file_contents = file_get_contents($filecreated);
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
		$content_decrypted = openssl_decrypt($file_contents, 'aes-256-cbc', (string)$checkpasswd, OPENSSL_RAW_DATA, $iv);
		$fp = fopen($filecreated, 'r+');
		fwrite($fp, $content_decrypted);
		fclose($fp);
	}
	
	$filedownload = "../../tmpfiles/".$ori_filename;
	rename($filecreated, $filedownload);
	
	// 압축여부 확인하고 압축해서 제공
	if ($zipfile) {
		copy($filedownload, "./".$ori_filename);
		shell_exec("zip ./".$filecode." ./".$ori_filename);
		unlink($filedownload);
		copy("./".$filecode.".zip", "../../tmpfiles/".$filecode.".zip");
		unlink("./".$ori_filename);
		unlink("./".$filecode.".zip");
		$filedownload = "../../tmpfiles/".$filecode.".zip";
	}
	
	// 임시 디렉터리 파일 다운로드
	header("Content-Type:application/octet-stream");
	header("Content-Disposition:attachment;filename=".iconv('UTF-8', 'CP949', str_replace("../../tmpfiles/", "", $filedownload))."");
	header("Content-Transfer-Encoding:binary");
	header("Content-Length:".filesize($filedownload));
	header("Cache-Control:cache,must-revalidate");
	header("Pragma:no-cache");
	header("Expires:0");
	ob_clean();
	flush();
	readfile($filedownload);
	
	// 임시 디렉터리 파일 삭제
	unlink($filedownload);
?>
