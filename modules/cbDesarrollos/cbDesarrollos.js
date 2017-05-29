/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

function projectCaptureOnDesarrollo(fromlink,fldname,MODULE,ID) {
	var BasicSearch = '&query=true&search=true&searchtype=BasicSearch&search_field=projectstatus&search_text=initiated';
//	var SpecialSearch = encodeURI(BasicSearch);
	let cuenta = document.getElementById('cuenta');
	if (cuenta.value!=0) {
		BasicSearch = BasicSearch + '&cuenta=' + cuenta.value;
	}
	window.open("index.php?module=Project&action=Popup&html=Popup_picker&form=vtlibPopupView&forfield="+fldname+"&srcmodule="+MODULE+"&forrecord="+ID+BasicSearch,"vtlibui10","width=680,height=602,resizable=0,scrollbars=0,top=150,left=200");
}

function cbDesarrollossetValueFromCapture(recordid,value,target_fieldname) {
	console.log(recordid,value,target_fieldname);
}

function cbdevelEjemplos() {
	fetch('index.php?module=Utilities&action=UtilitiesAjax&file=ExecuteFunctions' +
			'&functiontocall=getFieldValuesFromRecord' +
			'&getFieldValuesFrom=1084' +
			'&getTheseFields=firstname,Accounts.industry,Accounts.email1'
	, {
		credentials: 'same-origin'
	}).then(function(response) {
		return response.text();
	}).then(function(data) {
		console.log(data);
	});

}
