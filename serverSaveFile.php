<?php
if( (isset($_POST['name'])) && isset($_POST['file']) ) {
	file_put_contents('images/'.$_POST['name'],  base64_decode($_POST['file']));
//	file_put_contents('images/'.$_POST['name'],  $_POST['file']);
		echo $_POST['name'];
}

else var_dump($_POST);

//echo 'Contents: '.$_POST['file'];
die;
?>