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
		
		// 기한 만료된 파일 삭제
		include_once './auto_del_file.php';
		autodel();
		
		// 업로드된 파일 정보 정리
		$tmp_filename = $_FILES['clientfile']['name']; // 파일명
		$file_name = $_FILES['clientfile']['name'];
		$file_size = ($_FILES['clientfile']['size'] / (int)1000000); // 파일 용량 
		$selected_ext = (int)$_POST['compress']; // 압축 여부
		$selected_alg = (int)$_POST['encrypt']; // 암호화 여부
		$fileloc = '../../clientfiles/';
		
		// 파일 확장자 확인
		$file_ext_tmp = explode(".", (string)$file_name);
		$file_ext_tmp = array_reverse($file_ext_tmp);
		$file_ext = $file_ext_tmp[0];
		$file_ext = strtolower($file_ext);
		
		// 용량 2gb 초과시 종료
		if ((int)$file_size > (int)2000) {
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
				$userpasswd = base64_encode((string)md5((string)$_POST['passwd']));
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
		
		// 파일 압축 => zip
		if ((int)$selected_ext) {
			shell_exec("zip -r ".$fileloc.$filecode." ".$filecreated);
			rename ($filecreated.".zip", $filecreated);
		}
		
		// 파일 암호화 => mcrypt 라이브러리 활용
		if ((int)$selected_alg) {
			$filecontents = file_get_contents($filecreated);
			
			#$iv = "16byte 초기값";
			#$key = "32byte key";
			#$enc = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $filecontents, MCRYPT_MODE_CBC, $iv);

		}
		
		// 파일 코드 및 만료일 db에 저장하고 파라미터로 사용자에게 전달
		
		$timestamp = strtotime("+1 week");
		$expdate = date("Y-m-d", $timestamp);
		
		include './db.php';
		$conn = mysqli_connect("$hostname","$dbuserid","$dbpasswd","simshare");
		$upload_sql = "insert into clientfiles values('$filecode','$expdate','$userpasswd');";
		$upload_ok = mysqli_query($conn, $upload_sql);

		header('Location: ../../index.php?filecode='.$filecode.'&expdate='.$expdate);
		
	} else {
		
		// 파일 없으면 종료
		$message = "No uploaded file";
		errorpopup($message);
	}
?>
