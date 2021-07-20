<?php
	
	include_once "./db.php";
	
	$conn = mysqli_connect("$hostname","$dbuserid","$dbpasswd","simshare");
	$encoding = "set names utf8;";
	mysqli_query($conn, $encoding);
	
	function errorpopup($message) {
		echo "
		<script type = 'text/javascript'>
			alert('".(string)$message."');
			window.location.href = '../';
		</script>
		";
		return 0;
	}
	
	// 파일코드, 인덱스 받아서 db 레코드 리턴
	function getdbrecord($filecode, $requested) {
		global $hostname;
		global $dbuserid;
		global $dbpasswd;
		global $conn;
		$check_sql = "select * from clientfiles where code='$filecode';";
		$check_result = mysqli_query($conn, $check_sql);
		while ($fileinfo = mysqli_fetch_array($check_result)) {
			if (array_key_exists($requested, $fileinfo)) {
				return $fileinfo[$requested];
				break;
			} 
		}
	}
	
	// 파일 연장
	function extendfile($filecode) {
		global $conn;
		if (getdbrecord($filecode, "renew")) {
			$expdate_old = getdbrecord($filecode, "expdate");
			$extend_num = getdbrecord($filecode, "renew");
			$timestamp = strtotime($expdate_old." +1 week");
			$expdate_new = date("Y-m-d", $timestamp);
			$extend_sql = "update clientfiles set expdate='$expdate_new' where code='$filecode';";
			$extend_num -= 1;
			$num_sql = "update clientfiles set renew='$extend_num' where code='$filecode';";
			mysqli_query($conn, $extend_sql);
			mysqli_query($conn, $num_sql);
			
			$message = "Successfully extended! Expiry date: ".$expdate_new;
			echo "
			<script type = 'text/javascript'>
				alert('".(string)$message."');
				location.href = '/';
			</script>
			";
		} else {
			$message = "This file cannot be extended any longer. ";
			errorpopup($message);
			exit;
		}
		
		return 0;
	}
	
	// 파일 삭제
	function deletefile($filecode, $passwd) {
		global $conn;
		$userpasswd = getdbrecord($filecode, "passwd");
		if (!password_verify((string)$passwd, $userpasswd)) {
			$message = "Incorrect Password";
			errorpopup($message);
			exit;
		}
		$del_sql = "delete from clientfiles where code='$filecode';";
		mysqli_query($conn, $del_sql);
		unlink('../../clientfiles/'.$filecode);
		
		$message = "File successfully removed.";
		echo "
		<script type = 'text/javascript'>
			alert('".(string)$message."');
			location.href = '/';
		</script>
		";
		
		return 0;
	}
	
	// 파일 없으면 종료
	$filecreated = "../../clientfiles/".$_POST['filecode'];
	if (isset($_POST['filecode'])) {
		if (!file_exists($filecreated)) {
			$message = "No matching file found";
			errorpopup($message);
			exit;
		}
	}
	
	$filecode = $_POST['filecode'];
	
	if (isset($_POST['passwd'])) {
		deletefile($filecode, $_POST['passwd']);
	} else {
		extendfile($filecode);
	}
?>