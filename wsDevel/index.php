<?php
include_once 'WSClient.php';

$cbconn = new Vtiger_WSClient('http://localhost/coreBOSwork');

var_dump($cbconn->_servicetoken);

$challenge = $cbconn->__doChallenge('admin');

var_dump($cbconn->_servicetoken);

$rdo = $cbconn->doLogin('admin', 'admin', true); // 'cdYTBpiMR9RfGgO'

var_dump($rdo);

$consulta = $cbconn->doQuery('select firstname,lastname,assigned_user_id from Contacts limit 10');

foreach ($consulta as $cto) {
	var_dump($cto);
}