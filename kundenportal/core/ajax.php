<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once 'options.php';
include_once 'B24_Class.php';
include_once 'Google_search.php';
include_once 'B24_Greviews.php';

if ($_GET['test']) {
	echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/log.json");
}

if ($_REQUEST['init'] == 'google_search') {
	(new Google_search($_REQUEST['text']));
}

if (isset($_REQUEST['taskAdd']) and isset($_REQUEST['googleId'])) {
	echo (new B24_Greviews())->taskAdd();
}

if (isset($_REQUEST['taskAddFromSite'])) {
	echo (new B24_Greviews())->taskAddFromSite();
}

if (isset($_REQUEST['relationsAdd'])) {
	echo (new B24_Greviews())->relationsAdd();
}

?>