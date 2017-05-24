<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once('data/CRMEntity.php');
require_once('data/Tracker.php');

class cbDesarrollos extends CRMEntity {
	var $db, $log; // Used in class functions of CRMEntity

	var $table_name = 'vtiger_cbdesarrollos';
	var $table_index= 'cbdesarrollosid';
	var $column_fields = Array();

	/** Indicator if this is a custom module or standard module */
	var $IsCustomModule = true;
	var $HasDirectImageField = false;
	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_cbdesarrolloscf', 'cbdesarrollosid');
	// related_tables variable should define the association (relation) between dependent tables
	// FORMAT: related_tablename => Array ( related_tablename_column[, base_tablename, base_tablename_column[, related_module]] )
	// Here base_tablename_column should establish relation with related_tablename_column
	// NOTE: If base_tablename and base_tablename_column are not specified, it will default to modules (table_name, related_tablename_column)
	// Uncomment the line below to support custom field columns on related lists
	// var $related_tables = Array('vtiger_cbdesarrolloscf'=>array('cbdesarrollosid','vtiger_cbdesarrollos', 'cbdesarrollosid', 'cbdesarrollo'));

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_cbdesarrollos', 'vtiger_cbdesarrolloscf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_cbdesarrollos'   => 'cbdesarrollosid',
		'vtiger_cbdesarrolloscf' => 'cbdesarrollosid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename => columnname) */
		// tablename should not have prefix 'vtiger_'
		'cbdesarrollono'=> Array('cbdesarrollos' => 'cbdesarrollono'),
		'referencia'=> Array('cbdesarrollos' => 'referencia'),
		'fechaini'=> Array('cbdesarrollos' => 'fechaini'),
		'fechafin'=> Array('cbdesarrollos' => 'fechafin'),
		'proyecto'=> Array('cbdesarrollos' => 'proyecto'),
		'Assigned To' => Array('crmentity' => 'smownerid')
	);
	var $list_fields_name = Array(
		/* Format: Field Label => fieldname */
		'cbdesarrollono'=> 'cbdesarrollono',
		'referencia'=> 'referencia',
		'fechaini'=> 'fechaini',
		'fechafin'=> 'fechafin',
		'proyecto'=> 'proyecto',
		'Assigned To' => 'assigned_user_id'
	);

	// Make the field link to detail view from list view (Fieldname)
	var $list_link_field = 'desarrollono';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename => columnname) */
		// tablename should not have prefix 'vtiger_'
		'cbdesarrollono'=> Array('cbdesarrollos' => 'cbdesarrollono'),
		'referencia'=> Array('cbdesarrollos' => 'referencia'),
		'fechaini'=> Array('cbdesarrollos' => 'fechaini'),
		'fechafin'=> Array('cbdesarrollos' => 'fechafin'),
		'proyecto'=> Array('cbdesarrollos' => 'proyecto'),
	);
	var $search_fields_name = Array(
		/* Format: Field Label => fieldname */
		'cbdesarrollono'=> 'cbdesarrollono',
		'referencia'=> 'referencia',
		'fechaini'=> 'fechaini',
		'fechafin'=> 'fechafin',
		'proyecto'=> 'proyecto',
	);

	// For Popup window record selection
	var $popup_fields = Array('desarrollono');

	// Placeholder for sort fields - All the fields will be initialized for Sorting through initSortFields
	var $sortby_fields = Array();

	// For Alphabetical search
	var $def_basicsearch_col = 'desarrollono';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'desarrollono';

	// Required Information for enabling Import feature
	var $required_fields = Array('desarrollono'=>1);

	// Callback function list during Importing
	var $special_functions = Array('set_import_assigned_user');

	var $default_order_by = 'desarrollono';
	var $default_sort_order='ASC';
	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('createdtime', 'modifiedtime', 'desarrollono');

	function save_module($module) {
		if ($this->HasDirectImageField) {
			$this->insertIntoAttachment($this->id,$module);
		}
	}

	/**
	 * Invoked when special actions are performed on the module.
	 * @param String Module name
	 * @param String Event Type (module.postinstall, module.disabled, module.enabled, module.preuninstall)
	 */
	function vtlib_handler($modulename, $event_type) {
		if($event_type == 'module.postinstall') {
			// TODO Handle post installation actions
			$this->setModuleSeqNumber('configure', $modulename, 'dvl-', '0000001');

			require_once('vtlib/Vtiger/Module.php');
			$moduleInstance = Vtiger_Module::getInstance('Project');
			$cbdevelModule = Vtiger_Module::getInstance($modulename);
			$moduleInstance->setRelatedList($cbdevelModule, $modulename, Array('ADD'),'get_dependents_list');
			$moduleInstance = Vtiger_Module::getInstance('SalesOrders');
			$moduleInstance->setRelatedList($cbdevelModule, $modulename, Array('ADD','SELECT'),'get_related_list');

		} else if($event_type == 'module.disabled') {
			// TODO Handle actions when this module is disabled.
		} else if($event_type == 'module.enabled') {
			// TODO Handle actions when this module is enabled.
		} else if($event_type == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($event_type == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($event_type == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
		}
	}

	/**
	 * Handle saving related module information.
	 * NOTE: This function has been added to CRMEntity (base class).
	 * You can override the behavior by re-defining it here.
	 */
	// function save_related_module($module, $crmid, $with_module, $with_crmid) { }

	/**
	 * Handle deleting related module information.
	 * NOTE: This function has been added to CRMEntity (base class).
	 * You can override the behavior by re-defining it here.
	 */
	//function delete_related_module($module, $crmid, $with_module, $with_crmid) { }

	/**
	 * Handle getting related list information.
	 * NOTE: This function has been added to CRMEntity (base class).
	 * You can override the behavior by re-defining it here.
	 */
	//function get_related_list($id, $cur_tab_id, $rel_tab_id, $actions=false) { }

	/**
	 * Handle getting dependents list information.
	 * NOTE: This function has been added to CRMEntity (base class).
	 * You can override the behavior by re-defining it here.
	 */
	//function get_dependents_list($id, $cur_tab_id, $rel_tab_id, $actions=false) { }
}
?>
