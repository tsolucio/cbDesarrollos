<?php
// Turn on debugging level
$Vtiger_Utils_Log = true;

require_once('vtlib/Vtiger/Module.php');
require_once('vtlib/Vtiger/Package.php');
require_once('include/events/include.inc');

global $current_user,$adb;
set_time_limit(0);
ini_set('memory_limit','1024M');
$current_user = new Users();
$current_user->retrieveCurrentUserInfoFromFile(Users::getActiveAdminId());
$package = new Vtiger_Package();

//$rdo = $package->importManifest('modules/cbDesarrollos/manifest.xml');

// $result = $adb->query('select accountname
// 	from vtiger_account
// 	inner join vtiger_crmentity on vtiger_account.accountid=vtiger_crmentity.crmid
// 	where vtiger_crmentity.deleted=0
// 	limit 10');
// while ($acc = $adb->fetch_array($result)) {
// 	echo $acc['accountname'].'<br>';
// }

// $result = $adb->pquery("select accountname
// 	from vtiger_account
// 	inner join vtiger_crmentity on vtiger_account.accountid=vtiger_crmentity.crmid
// 	where vtiger_crmentity.deleted=0 and accountname like ?
// 	limit 10",array('%'.$_REQUEST['nombre'].'%'));

// while ($acc = $adb->fetch_array($result)) {
// 	echo $acc['accountname'].'<br>';
// }

$moduleInstance = Vtiger_Module::getInstance('cbDesarrollos');
// $blockInstance = new Vtiger_Block();
// $blockInstance->label = 'LBL_PAYSLIP_INFORMATION';
// $moduleInstance->addBlock($blockInstance);

$blockInstance = Vtiger_Block::getInstance('LBL_PAYSLIP_INFORMATION', $moduleInstance);

// $fieldInstance = new Vtiger_Field();
// $fieldInstance->name = 'payslipname';
// $fieldInstance->table = 'vtiger_cbdesarrollos';
// $fieldInstance->column = 'cbdesarrolloname';
// $fieldInstance->columntype = 'VARCHAR(100)';
// $fieldInstance->uitype = 2;
// $fieldInstance->typeofdata = 'V~M';
// $fieldInstance->sequence = 20;
// $blockInstance->addField($fieldInstance);

// $fieldInstance = new Vtiger_Field();
// $fieldInstance->name = 'cuenta';
// $fieldInstance->table = 'vtiger_cbdesarrollos';
// $fieldInstance->column = 'cuenta';
// $fieldInstance->columntype = 'int(11)';
// $fieldInstance->uitype = 10;
// $fieldInstance->typeofdata = 'V~M';
// $fieldInstance->sequence = 2;
// $blockInstance->addField($fieldInstance);
// $fieldInstance->setRelatedModules(array('Accounts'));


// $fieldInstance = new Vtiger_Field();
// $fieldInstance->name = 'cbpicklist';
// $fieldInstance->table = 'vtiger_cbdesarrollos';
// $fieldInstance->column = 'cbpicklist';
// $fieldInstance->columntype = 'varchar(110)';
// $fieldInstance->uitype = 15;
// $fieldInstance->typeofdata = 'V~O';
// $fieldInstance->sequence = 3;
// $blockInstance->addField($fieldInstance);
// $fieldInstance->setPicklistValues(array('valor1','valor2'));

// $field = Vtiger_Field::getInstance('cbpicklist',$moduleInstance);
// $field->setPicklistValues(array('valor3','valor4'));

// $accountsModule = Vtiger_Module::getInstance('Accounts');
// $moduleInstance->setRelatedList($accountsModule, 'Accounts', Array('ADD','SELECT'),'get_related_list');

//$moduleInstance->addLink('DETAILVIEWBASIC', 'Mi Enlace', 'http://corebos.org');
// $moduleInstance->addLink('DETAILVIEW', 'Añadir Orden Venta',
// 	'index.php?module=SalesOrder&action=EditView&createmode=link&return_module=$MODULE$&return_id=$RECORD$');

$em = new VTEventsManager($adb);
// $event = 'corebos.footer';
// $em->registerHandler($event, 'modules/cbDesarrollos/cbDevelHandler.php', 'cbDevelEventHandler');
// echo "<h4>Event $event registered.</h4>";
// $event = 'corebos.header';
// $em->registerHandler($event, 'modules/cbDesarrollos/cbDevelHandler.php', 'cbDevelEventHandler');
// echo "<h4>Event $event registered.</h4>";
// $event = 'corebos.filter.editview.setObjectValues';
// $em->registerHandler($event, 'modules/cbDesarrollos/cbDevelHandler.php', 'cbDevelEventHandler');
// echo "<h4>Event $event registered.</h4>";

// VTCacheUtils::updateCachedInformation('mivalor', 123456);

// $var = VTCacheUtils::lookupCachedInformation('mivalor');

// var_dump($var);

// list($var,$exists) = VTCacheUtils::lookupCachedInformation('otraclave');
// if ($exists) {
// 	echo $var;
// } else {
// 	var_dump($var);
// }

//coreBOS_Session::init();

//coreBOS_Session::set('mivalor', 123456);

//$var = coreBOS_Session::get('mivalor',654321);

//echo $var;

//coreBOS_Settings::setSetting('mivalor', 123456);

//$var = coreBOS_Settings::getSetting('mivalor', 654321);

//echo $var;

// $module = 'Contacts';
// $queryGenerator = new QueryGenerator($module, $current_user);
// $queryGenerator->setFields(array('id','Accounts.accountname','Accounts.ship_street'));
// $queryGenerator->startGroup();
// $queryGenerator->addCondition('firstname', 'mex', 'e');
// $queryGenerator->addCondition('firstname', 'xem', 'e', QueryGenerator::$OR);
// $queryGenerator->endGroup();

// $queryGenerator->startGroup(QueryGenerator::$AND);
// $queryGenerator->addReferenceModuleFieldCondition('Accounts', 'account_id', 'accountname', 'mex', 'e');
// $queryGenerator->endGroup();

// $query = $queryGenerator->getQuery();
// echo $query;

// include_once 'modules/cbMap/processmap/Validations.php';
// $valmod = 'Accounts';
// $existe = Validations::ValidationsExist($valmod);
// var_dump($existe);
// $validator = new Validations($map)

// include_once 'include/validation/load_validations.php';

// $valores = array(
// 	'email' => '',
// 	'industry' => 'Baning',
// );
// $v = new cbValidator($valores);
// $v->rule('required', 'email');
// $v->rule('contains', 'industry','nkin');
// if($v->validate()) {
// 	echo "Yay! We're all good!";
// } else {
// 	// Errors
// 	var_dump($v->errors());
// }







?>
