<?php
session_start();
get_header();
include_once 'core/constants.php';
include_once 'core/B24_Class.php';
include_once 'core/B24_Contact.php';


$B24_CONTACT = new B24_Contact();

include_once 'layout/header.php';


?>