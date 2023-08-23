<?php 

/**
 * 
 */
class Outscraper {
	
	function __construct() {
		$this->apiUrl = 'https://api.app.outscraper.com/';
		$this->apiKey = 'YXV0aDB8NjM3ZTUwMzllYzcyNWIzYTg2OWRkNWE3fGY4Yzk0NjVlZjI';
		
	}

	function profileBalance () {
		$url = $this->apiUrl."profile/balance";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$headers = array(
			"X-API-KEY: ".$this->apiKey,
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$resp = curl_exec($curl);
		curl_close($curl);
		var_dump($resp);
	}


}
