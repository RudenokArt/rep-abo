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
		$result = json_decode($response, true);
		return $result['result'];
	}

	function relationsAdd () {
		global $b24_webhook;
		$api_method = 'grewiewscontacts.relations_add?'; 
		$api_query = http_build_query([
			'greviews_id' => $_POST['greviews_id'],
			'contact_id' => $_POST['contact_id'],
		]);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		return $json;
	}

	function dealsList ($filter, $order, $pageN) {
		global $b24_webhook;
		$arr_query = [
			'filter' => $filter,
			'select' => ['TITLE', 'STAGE_ID', 'DATE_CREATE', 'UF_DEAL_GREVIEWS_FIELD'],
			'order' => $order,
			'start' => $pageN * 50,
		];
		$api_method = 'crm.deal.list.json?';
		$api_query = http_build_query($arr_query);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);

		return $json;
	}

	function stageList () {
		global $b24_webhook;
		global $dealCategoryId;
		$arr_query = [
			'id' => $dealCategoryId,
			
		];
		$api_method = 'crm.dealcategory.stage.list?';
		$api_query = http_build_query($arr_query);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		return $json;
	}

	function relationsList ($contact_id, $check_date=false) {
		global $b24_webhook;
		$arr_query = [
			'contact' => $contact_id,
		];
		if ($check_date) {
			$arr_query['check_date'] = $check_date;
		}
		$api_method = 'grewiewscontacts.relations_list?';
		$api_query = http_build_query($arr_query);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		return $json;
	}


	function taskList ($ids) {
		global $b24_webhook;
		$api_method = 'grewiewscontacts.tasks_list?';
		$api_query = http_build_query([
			'ids' => $ids,
		]);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		return $json;
	}

	function taskGet ($id) {
		global $b24_webhook;
		$api_method = 'grewiewscontacts.task_get?';
		$api_query = http_build_query([
			'id' => $id,
		]);
		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		return $json;
	}

	function taskAdd () {
		global $b24_webhook;
		$api_method = 'greviews.task.add?'; 
		$api_query = http_build_query([
			'query' => $_POST['googleId'],
		]);

		$json = file_get_contents($b24_webhook.$api_method.$api_query);
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log.json', $json);

		// $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log.json');
		
		return $json;
	}
}

// UF_DEAL_GREVIEWS_FIELD