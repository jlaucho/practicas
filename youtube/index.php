<html> 
	<head> 
		<title>PHP YouTube Video Downloader</title> 
	</head> 
	<body> 
		<center> 
			<p> </p> 
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
		URL Video:<br /> 
			<input type="text" name="url" size="40"><br> 
			<input type="submit" value="Descargar"> 
		</form> 
		</center> 
	</body> 
</html> 
Luego creamos el script para la descarga:

<?php 
if (isset($_POST['url']) && strlen($_POST['url']) > 2) { 
$data = file_get_contents($_POST['url']); 
preg_match_all("/player2.swf\?video_id\=(.*)\"/", $data, $m); 
list($id) = explode('"', $m[1][0]); 
header ("Location: http://www.youtube.com/get_video?video_id=".trim($id)); 
exit(); 
} 
?> 