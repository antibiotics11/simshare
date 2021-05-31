<?php 
	// 서버에 파일 업로드를 처리하는 php 파일
	
	ini_set('memory_limit','256M');

	// 파일에 부여할 랜덤 코드 생성 함수
	function randstring($length) {  
		$characters  = "0123456789";  
		$characters .= "abcdefghijklmnopqrstuvwxyz";  
		$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
		$characters .= "_";  
		$string_generated = "";  
		$nmr_loops = $length;  
		while ($nmr_loops--) {  
			$string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];  
		}  
		return $string_generated;  
	}
	
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
	
	if (is_uploaded_file($_FILES['clientfile']['tmp_name'])) {
		
		// 기한 만료된 파일 삭제
		include_once './auto_del_file.php';
		autodel();
		
		// 디스크 사용 용량 제한
		$emptyspace = 50000; // 사용가능 용량 => mb 단위
		$chkcommand = shell_exec("du -sh ../../");
		$usedspace = str_replace("M", "", $chkcommand);
		$usedspace = str_replace("../../", "", $usedspace);
		if (((float)$emptyspace - 200) <= (float)$usedspace) {
			$message = "Sorry. No more disk space left.";
			errorpopup($message);
			exit;
		}
		
		// 업로드된 파일 정보 정리
		$tmp_filename = $_FILES['clientfile']['name']; // 파일명
		$file_name = $_FILES['clientfile']['name'];
		$file_size = ($_FILES['clientfile']['size'] / (1024 * 1024)); // 파일 용량 
		$selected_ext = (int)$_POST['compress']; // 압축 여부
		$selected_alg = (int)$_POST['encrypt']; // 암호화 여부
		$fileloc = '../../clientfiles/';
		
		// 파일 확장자 확인
		$file_ext_tmp = explode(".", (string)$file_name);
		$file_ext_tmp = array_reverse($file_ext_tmp);
		$file_ext = $file_ext_tmp[0];
		$file_ext = strtolower($file_ext);
		
		// 용량 200mb 초과시 종료
		if ((int)$file_size > (int)200) {
			$message = "File is too large";
			errorpopup($message);
			exit;
		}
		
		// 암호화 선택시 패스워드 처리
		if ($selected_alg) {
			if ((string)$_POST['passwd'] != (string)$_POST['checksum']) {
				$message = "Password does not match";
				errorpopup($message);
				exit;
			} else {
				// md5 해싱하고 sha256 해싱
				$userpasswd_hased = (string)md5((string)$_POST['passwd']);
				$userpasswd = substr(hash('sha256', (string)$userpasswd_hased, true), 0, 32);
			}
		}
		
		// 에러 발생시 종료
		if ((int)$_FILES['clientfile']['error']) {
			$message = "Error occured. Please try again.";
			errorpopup($message);
			exit;
		}
		
		// 허용되지 않은 확장자면 실행 종료
		include_once './ext_allowed.php';
		if (!in_array($file_ext, $ext_allowed)) {
			$message = $file_ext." files not allowed";
			errorpopup($message);
			exit;
		}
		
		// 파일 랜덤 코드 생성, 중복 방지
		$checkifexist = 1;
		while ($checkifexist) {
			$filecode = randstring(6);
			if (!file_exists($filecode)) {
				unset($checkifexist);
			} else {
				$checkifexist = 1;
			}
		}
		
		// 파일을 clientfiles 디렉터리로 이동
		$filecreated = $fileloc."/".$filecode;
		move_uploaded_file($_FILES['clientfile']['tmp_name'], $filecreated);
		
		// 파일 압축여부 확인
		if ($selected_ext) {
			// 업로드시 압축 사용안함 => 다운로드시 압축해서 사용자에게 제공
			#shell_exec("zip ".$fileloc.$filecode." ".$filecreated);
			#rename ($filecreated.".zip", $filecreated);
			$zipfile = 1;
		} else {
			$zipfile = 0;
		}
		
		// 파일 SHA-256으로 암호화 => openssl
		if ((int)$selected_alg) {
			$file_contents = file_get_contents($filecreated);
			$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
			$content_encrypted = openssl_encrypt($file_contents, 'aes-256-cbc', $userpasswd, OPENSSL_RAW_DATA, $iv);
			$fp = fopen($filecreated, 'r+');
			fwrite($fp, $content_encrypted);
			fclose($fp);
		}
		
		// 파일 정보 db에 저장하고 파라미터로 사용자에게 전달
		$timestamp = strtotime("+1 week");
		$expdate = date("Y-m-d", $timestamp);
		include './db.php';
		$conn = mysqli_connect("$hostname","$dbuserid","$dbpasswd","simshare");
		$encoding = "set names utf8;";
		$set_encoding = mysqli_query($conn, $encoding);
		$upload_sql = "insert into clientfiles values('$filecode','$file_name','$expdate','$userpasswd_hased','$zipfile');";
		$upload_ok = mysqli_query($conn, $upload_sql);

		header('Location: ../../index.php?filecode='.$filecode.'&expdate='.$expdate);
		
	} else {
		// 파일 없으면 종료
		$message = "No uploaded file";
		errorpopup($message);
	}
?>
