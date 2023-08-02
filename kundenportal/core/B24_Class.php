<?php

/**
 * 
 */
class B24_Class {
	
	function __construct() {
		global $b24_webhook;
		$this->webhook = $b24_webhook;
	}

	function restApiRequest ($method, $query) { 
		$json = file_get_contents($this->webhook.$method.'?'.$query); 
		return json_decode($json, true); 
	}
}

?>