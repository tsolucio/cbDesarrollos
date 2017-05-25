<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once('Smarty_setup.php');

global $mod_strings, $app_strings, $currentModule, $current_user, $theme, $log;

$smarty = new vtigerCRM_Smarty();

require_once 'modules/Vtiger/DetailView.php';


$smarty->assign('HelloWorld','Hola Mundo');

$result = $adb->query('select accountname
	from vtiger_account
	inner join vtiger_crmentity on vtiger_account.accountid=vtiger_crmentity.crmid
	where vtiger_crmentity.deleted=0
	limit 10');
$accounts = array();
while ($acc = $adb->fetch_array($result)) {
	$accounts[] = $acc['accountname'];
}

$smarty->assign('Cuentas',$accounts);

ob_start();
include 'modules/Dashboard/HomepageDB.php';
$cbdevelblock = ob_get_clean();
$smarty->assign("cbdevelblock",$cbdevelblock);

$smarty->display('DetailView.tpl');
?>
