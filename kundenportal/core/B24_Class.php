<?php

/**
 * 
 */
class B24_Class {
	
	function __construct() {
		global $b24_webhook;
		$this->webhook = $b24_webhook;
		
	}

	function restApiRequest ($method, $filter=[], $select=[], $order=[]) { 
		$query = http_build_query([
			'filter' => $filter,
			'select' => $select,
			'order' => $order,
		]); 
		$json = file_get_contents($this->webhook.$method.'?'.$query); 
		return json_decode($json, true); 
	}
}

?>