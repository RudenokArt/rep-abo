<?php 

/**
 * 
 */
class B24_Contact extends B24_Class {
	
	function __construct() {
		parent::__construct();
	}

	function login ($login, $password) {
		$arr = $this->restApiRequest('crm.contact.list', [
			'UF_USER_LOGIN' => $login,
			'UF_USER_PASSWORD' => $password,
		], ['*', 'UF_*']);
		if ($arr['total']) {
			$_SESSION['B24']['CONTACT'] = $arr['result'][0];
		}
		return $arr;
	}

	function logout() {
		
	}

}

?>