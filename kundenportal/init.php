<?php
session_start();
get_header();
include_once 'core/options.php';
include_once 'core/B24_Class.php';
include_once 'core/B24_Contact.php';
include_once 'core/Outscraper.php';
include_once 'core/B24_Greviews.php';


$B24_CONTACT = new B24_Contact();


include_once 'layout/header.php';


?>

<!-- <pre><?php //print_r((new Outscraper())->profileBalance()); ?></pre> -->