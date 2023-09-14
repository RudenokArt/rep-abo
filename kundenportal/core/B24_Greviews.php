<?php 

/**
 * 
 */
class B24_Greviews extends B24_Class {
	
	function taskAddFromSite () {
		global $b24_webhook;
		$api_method = 'greviews.task.addFromSite';

		$url = $b24_webhook.$api_method;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
			'company' => json_encode($_POST['company']),
			'need' => $_POST['need'] ?: [],
			'reasons' => $_POST['reasons'] ?: [],
			'price' => $_POST['price'],
			'amount' => $_POST['amount'],
			'uName' => $_POST['uName'],
			'uPhone' => $_POST['uPhone'],
			'uEmail' => $_POST['uEmail']
		]));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	function taskAdd () {
		global $b24_webhook;
		$api_method = 'greviews.task.add?'; 
		$api_query = http_build_query([
			'query' => $_POST['googleId'],
		]);

		// $json = file_get_contents($b24_webhook.$api_method.$api_query);

		// file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log.json', $json);

		$json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log.json');
		
		return $json;
	}
}

?>