<?php
session_start();

$_SESSION['loc_root'] = "http://".rtrim($_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'],'index.php/')."/";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" >
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Drag & Drop One Step Uploader</title>
<!-- Bootstrap -->
<link href="bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png" href="../../favicon.png"/>
<link href="style.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
<script>
function hide() {
	document.getElementById("message").style.display="none";
	document.getElementById("cover").style.display="none";
}
function show() {
	document.getElementById("message").style.display="block";
	document.getElementById("cover").style.display="block";
	
}
</script>
<div align="center">
<br><br><br><br>
</div>
<div id="message"><h1 style="text-align:center">File Upload</h1><hr>
	<p style="text-align:center;font-size:22px">Select Multiple files using Drag & Drop, or use the standard File Chooser provided with your browser.</p>
	<p style="text-align:center">This script uses Php, Javascript & JQuery/AJAX to simplify file uploads by reducing the process to a single step.</p>
	<p style="text-align:center">Once dropped or selected, the files are transferred to the server. Files from multiple locations on your PC can be selected and uploaded.</p>
	<p style="text-align:center">For files that exceed 500Kb, see:  <a href="slice.php"> Slice & Send - File Upload-by-Slice demo</a></p>
	<p style="text-align:center">Click X above to continue</p>
	<a  onClick="hide();" class="cancel">&times;</a>
</div>
<div id="cover" >
</div>
<div class="mainscreen">
			<div class="col-md-12 " style="text-align:left;padding:10px;">
				<div class="col-md-2">
					<a href="../../#work">
						<i class="fa fa-arrow-left"></i>
							Home</a>
				</div>
				
				<div class="col-md-2"><a href="../sales_tool/">Sales Tool</a></div>
				<div class="col-md-2"><a href="../gr/">CMS</a></div>
				<div class="col-md-5"><a href="../slice">Upload Slice</a></div>
				<div class="col-md-1">
					<a href="" onclick="show();">
						<i class="fa fa-lightbulb-o"></i>
						Info
					</a>
				</div>	
			</div>
<div style="text-align:center">
	<h1 style="color:grey">	Drag & Drop - Multiple File Uploader</h1>
	<div class="row" style="text-align:left">
		<div class="col-md-1">
			Sent....
		</div>
		<div class="col-md-10">
			<div id="progress_bar">
				<div id="percent" class="percent">0%</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
	<div class="row" style="text-align:left">
		<div class="col-md-1">Saved...</div>
		<div class="col-md-10">
			<div id="progress_bar2">
				<div id="percent2" class="percent2">0%</div>
			</div>
		</div>
		<div class="col-md-5" id="insert"></div>
	</div>
	<div class="row">
		<div style="margin:50px;border:1px solid; padding:20px;">
			<div class="row" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">drop your files here or use the selector
				<div id="list" ></div>
			</div>
		</div>
	</div>
	<input type="file" id="selectImage" name="selectImage[]" multiple>
</div>
</div>
<script>
var loc_root =<?php echo '"'.$_SESSION['loc_root'].'"';?>;		
</script>
<script src="uploader.js"></script>

</body>