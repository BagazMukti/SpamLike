<?php
/***********************/
/*      BagazMukti     */
/*     bagaz[dot]org   */
/* bagaz@protonmail.ch */
/***********************/
error_reporting(0);
include('config.php');
include('function.php');
$script = $argv[0];
$target = $argv[1];

if(!file_get_contents('https://bagazmukti.github.io')) {
	echo "Error: No internet connection!\nExit!\n";
	exit;
}
if(!checktoken($token) || !checktarget($token, $target)) {
	echo "/********************/
/*  Spam Like 2k18  */
/********************/
Usage: php ".$script." <target>
Error: Invalid token or target!\nExit!";
	exit;
}

$info = getdata($token, $target);
echo "/********************/
/*  Spam Like 2k18  */
/********************/
=[ TARGET INFO ]=
Name: ".$info->name."
Fbid: ".$info->id."
=[ BOT RUNNING ]=\n";

$get = curl("https://graph.facebook.com/".$target."/posts?fields=id,from&limit=".$count."&access_token=" . $token);
$json = json_decode($get);
foreach($json->data as $data) {
	$request = curl("https://graph.facebook.com/". $data->id ."/likes", array("method" => "post", "access_token" => $token));
	$result = json_decode($request);
	if($result == "200") {
		echo "[SUCCESS] ". $data->id ."\n";
	} else {
		echo "[FAILED] ". $data->id ."\n";
	}
	sleep(1);
}
// Say hello to amuri
?>
