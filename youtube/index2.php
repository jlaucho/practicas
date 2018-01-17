
<html> 
	<head> 
		<title>PHP YouTube Video Downloader</title> 
	</head> 
	<body> 
		<center> 
			<p> </p> 
		<form action="<?=$_SERVER['PHP_SELF']?>" method="GET"> 
		URL Video:<br /> 
			<input type="text" name="v"><br> 
			<input type="submit" value="Descargar"> 
		</form> 
		</center> 
	</body> 
</html> 

<?php 
if (isset($_GET['v'])/* && strlen($_POST['v']) > 2*/) { 
	echo 'Entro en el if';
	if(!empty($_GET['v'])){ 
		echo 'entro en el empty';
		$result = file_get_contents('http://www.youtube.com/watch?v='.$_GET['v']); 
		$r=explode('flashvars="',$result); 
		$r2=explode(';',$r[1]); 
		$c=0; 
		foreach ($r2 as $value) 
		{ 
		   if (preg_match("/^fmt_stream_map=/i", $value)) { 
		       $valor=$c; 
		    } 

		    $c++; 
		} 
		$r3=explode('fmt_stream_map=',$r2[$valor]); 
		$bodytag = str_replace("/", "/", $r3[1]); 
		$r4=explode('|',urldecode($bodytag) ); 
		header('Content-Type: video/x-flv');  
		header("Content-type: application/force-download"); 
		header('Content-Disposition: attachment; filename='.$_GET['v'].'.flv'); 
		readfile(urldecode($r4[1])); 
		exit; 
	} 
}
?> 

