<?php 

/**
 * 
 */
class Google_search {
	
	function __construct($query)	{
		global $googleApiKey;
		$this->apiKey = $googleApiKey;
		$this->query = $query;
		echo $this->mapTextSearch();
	}

	function mapTextSearch () {
		$url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query='
		. urlencode($this->query) . '&key=' . $this->apiKey;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close($curl);

		$data = json_decode($response);

		$return = [];

		if ($data->status === 'OK') {
			foreach ($data->results as $result) {
				$return[$result->place_id] = ['name' => $result->name, 'address' => $result->formatted_address];
			}
		}
		return json_encode($return);
	}

}

?>