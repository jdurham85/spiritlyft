<?php
session_start();
include 'core.inc.php';
include 'search.inc.php';
$searchInQuery = $_POST['SearchInQuery'];
echo searchinquery1($searchInQuery);
?>