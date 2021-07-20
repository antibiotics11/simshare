<?php
	// 기한이 만료된 파일을 자동으로 삭제 
	
	function autodel() {
		include './db.php';
		$conn = mysqli_connect("$hostname","$dbuserid","$dbpasswd","simshare");
		$check_sql = "select * from clientfiles";
		$check_result = mysqli_query($conn, $check_sql);
		
		$datetoday = date("Y-m-d");
		$datetoday = strtotime($datetoday);
		
		while ($datelist = mysqli_fetch_array($check_result)) {
			$uploaddate = $datelist['expdate'];
			$uploaddate = strtotime($uploaddate);
			
			if ((int)$datetoday > (int)$uploaddate) {
				unlink('../../clientfiles/'.$datelist['code']);
				$del_sql = "delete from clientfiles where code='".$datelist['code']."';";
				mysqli_query($conn, $del_sql);
			}
		}
		
		return 0;
	}
?>