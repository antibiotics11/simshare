<?php
	
	if (file_exists('../../clientfiles'.$_GET['filecode'])) {
?>
	<p> File Successfully Uploaded </p>
	<p> Your File Code <?=$_GET['filecode']?> </p>
<?php
	} /*else {
		echo "
			<script type = 'text/javascript'>
				alert('No uploaded file');
				location.href='../';
			</script>
		";
	} */
?>