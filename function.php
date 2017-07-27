<?php
/****************/
/* function.php */
/****************/
function curl($url, $post=null) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if($post != null){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$exec = curl_exec($ch);
	curl_close($ch);
	return $exec;
}
function checktoken($token) {
	$get = curl("https://graph.facebook.com/me/?fields=id&access_token=".$token);
	$data = json_decode($get);
	$id = $data->id;
	if($id) {
		return true;
	} else {
		return false;
	}
}
function checktarget($token, $target) {
	$get = curl("https://graph.facebook.com/".$target."/?fields=id&access_token=".$token);
	$data = json_decode($get);
	$id = $data->id;
	if($id) {
		return true;
	} else {
		return false;
	}
}
function getdata($token, $target) {
	$get =	 curl("https://graph.facebook.com/".$target."/?fields=id,name&access_token=".$token);
	return json_decode($get);
}
?>