<?php 
	// 서버에 파일 업로드를 처리하는 php 파일입니다.

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
		
		// 업로드된 파일 정보 정리
		$tmp_filename = $_FILES['clientfile']['name']; // 파일명
		$file_name = $_FILES['clientfile']['name'];
		$file_size = ($_FILES['clientfile']['size'] / (int)1000000); // 파일 용량 
		$file_ext = $_FILES['clientfile']['type']; // 파일 확장자 
		$selected_ext = (int)$_POST['compress']; // 압축 여부
		$selected_alg = (int)$_POST['encrypt']; // 암호화 여부
		$fileloc = '../../clientfiles/';
		
		// 용량 2gb 초과시 종료
		if ((int)$file_size > (int)2000) {
			$message = "File is too large";
			errorpopup($message);
		}
		
		// 암호화 선택시 패스워드 일치하지 않으면 종료
		if ($selected_alg) {
			if ((string)$_POST['passwd'] != (string)$_POST['checksum']) {
				$message = "Password does not match"
				errorpopup($message);
			}
		}
		
		// 에러 발생시 종료
		if ((int)$_FILES['clientfile']['error']) {
			$message = "Error occured. Please try again.";
			errorpopup($message);
		}
		
		// 허용되지 않은 확장자면 실행 종료
		include './ext_allowed.php';
		if (!in_array($file_ext, $ext_allowed)) {
			$message = $file_ext." files not allowed";
			errorpopup($message);
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
		
		$filecreated = $fileloc."/".$filecode;
		move_uploaded_file($_FILES['clientfile']['tmp_name'], $filecreated);
		
		// 파일 압축 => pclzip 라이브러리 활용
		if ((int)$selected_ext) {
			include './pclzip.lib.php';
			$zipfile = new PclZip($filecode);
			$createfile = $zipfile->create($filecreated);
		}
		
		// 파일 암호화 => mcrypt 라이브러리 활용
		if ((int)$selected_alg) {
			$filecontents = file_get_contents($filecreated);
			
			$iv = "16byte 초기값";
			$key = "32byte key";
			$enc = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $filecontents, MCRYPT_MODE_CBC, $iv);
			
				$fp = fopen($dirlist[$i], 'r+');
				fwrite($fp, $encrypted);
				fclose($fp);
		}
		
		// 파일 코드 및 만료일 파라미터로 전달
		$timestamp = strtotime("+1 week");
		$expdate = date("Ymd", $timestamp);
		header('Location: ../../index.php?filecode='.$filecode.'&expdate='.$expdate);
		
	} else {
		
		// 파일 없으면 종료
		$message = "No uploaded file";
		errorpopup($message);
	}
?>
