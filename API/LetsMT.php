<?php

function translateWithLetsMT($textToTranslate){
	
	$textToTranslate = urlencode($textToTranslate);

	//API stuff
	global $LetsMTusername, $LetsMTpassword, $LetsMTSystemID;
	 
	$context = stream_context_create(array(
		'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("$LetsMTusername:$LetsMTpassword")
		)
	));
	$LetsMTURL = "https://www.letsmt.eu/ws/service.svc/json/Translate?systemID=$LetsMTSystemID&text=$textToTranslate";
	$json = file_get_contents($LetsMTURL, false, $context);
	$response = json_decode($json);

	return $response;
}