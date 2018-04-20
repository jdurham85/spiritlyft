<?php 
session_start();

require_once 'config.php';
include 'core.inc.php';

echo getMemberOnline();
?>