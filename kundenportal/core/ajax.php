<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once 'options.php';
include_once 'Google_search.php';

if ($_REQUEST['init'] == 'google_search') {
	(new Google_search($_REQUEST['text']));
}
?>