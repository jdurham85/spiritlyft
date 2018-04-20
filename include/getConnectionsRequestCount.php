<?php 
session_start();
include 'connections.core.inc.php';
echo getConnectionsRequestCount();
?>