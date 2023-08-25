<?php 

/**
 * 
 */
class B24_Greviews extends B24_Class {
	
	function __construct() {

		if (isset($_POST['taskAdd']) and isset($_POST['googleId'])) {
			$this->response = $this->taskAdd();
		}
		
	}

	function taskAdd () {
		global $b24_webhook;
		$api_method = 'greviews.task.add?'; 
		$api_query = http_build_query([
			'query' => $_POST['googleId'],
		]); 
		// $json = file_get_contents($b24_webhook.$api_method.$api_query); 
		// $arr = json_decode( $json, $assoc_array = true );
		return $b24_webhook.$api_method.$api_query;
	}
}

?>