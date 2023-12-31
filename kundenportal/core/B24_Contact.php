<?php 

/**
 * 
 */
class B24_Contact extends B24_Class {
	
	function __construct() {
		parent::__construct();

		$this->alert = [
			'visible' => false,
			'color' => 'light',
			'text' => '',
		];

		if (
			isset($_POST['PASSWORD_RECOVERY'])
			and
			!empty($_POST['PASSWORD_RECOVERY'])
		) {
			$this->debug = $this->passwordRecovery($_POST['PASSWORD_RECOVERY']);
		}

		if (
			isset($_POST['UF_USER_PASSWORD'])
			and
			isset($_POST['UF_USER_LOGIN'])
			and
			!empty($_POST['UF_USER_PASSWORD'])
			and
			!empty($_POST['UF_USER_LOGIN'])
		) {
			$this->login($_POST['UF_USER_LOGIN'], $_POST['UF_USER_PASSWORD']);
		}

		if (isset($_POST['contact_logout']) and $_POST['contact_logout'] == 'Y') {
			unset($_SESSION['B24']['CONTACT']);
		}

		if ($_SESSION['B24']['CONTACT']) {
			if (isset($_POST['contact_update']) and $_POST['contact_update'] == 'Y') {
				$this->contactUpdate($_SESSION['B24']['CONTACT'], $_POST);
			}
			$this->data = $this->contactGet($_SESSION['B24']['CONTACT']);
		}

	}

	function passwordRecovery ($email) {
		$query = http_build_query([
			'filter' => ['EMAIL' => $email,],
			'select' => ['ID', 'UF_USER_PASSWORD', 'UF_USER_LOGIN',],
		]); 
		$response = $this->restApiRequest('crm.contact.list', $query);
		if (!$response['result']) {
			$this->alert = [
				'visible' => true,
				'color' => 'danger',
				'text' => 'Der Benutzer mit dieser E-Mail wurde nicht in der Datenbank gefunden!',
			];
		} else {
			if (
				mail(
					$email,
					'Password recovery',
					'login: '.$response['result'][0]['UF_USER_LOGIN'].' password: '.$response['result'][0]['UF_USER_PASSWORD']
				)
			) {
				$this->alert = [
					'visible' => true,
					'color' => 'success',
					'text' => 'Login und Passwort wurden an die angegebene E-Mail gesendet.
					Wenn Sie keine E-Mail erhalten haben, überprüfen Sie Ihren Spam-Ordner.',
				];
			}			
		}
		return $response['result'];
	}

	function contactUpdate ($id, $fields) {
		$query = http_build_query([
			'id' => $id,
			'fields' => $fields,
		]); 
		$response = $this->restApiRequest('crm.contact.update', $query);
		return $response;
	}

	function contactGet ($id) {
		$query = http_build_query([
			'id' => $id,
		]); 
		$response = $this->restApiRequest('crm.contact.get', $query);
		return $response['result'];
	}

	function login ($login, $password) {
		$query = http_build_query([
			'filter' => [
				'UF_USER_LOGIN' => $login,
				'UF_USER_PASSWORD' => $password,
			],
			'select' => ['UF_USER_LOGIN', 'UF_USER_PASSWORD', 'ID'],
		]); 
		$arr = $this->restApiRequest('crm.contact.list', $query);
		if ($arr['total']) {
			$_SESSION['B24']['CONTACT'] = $arr['result'][0]['ID'];
		} else {
			$this->alert = [
				'visible' => true,
				'color' => 'danger',
				'text' => 'Falscher Login oder Passwort!',
			];
		}
	}

}

?>