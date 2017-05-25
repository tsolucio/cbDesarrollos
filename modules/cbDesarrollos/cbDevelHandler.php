<?php
/*************************************************************************************************
 * Copyright 2017 JPL TSolucio, S.L. -- This file is a part of TSOLUCIO coreBOS Customizations.
 * Licensed under the vtiger CRM Public License Version 1.1 (the "License"); you may not use this
 * file except in compliance with the License. You can redistribute it and/or modify it
 * under the terms of the License. JPL TSolucio, S.L. reserves all rights not expressly
 * granted by the License. coreBOS distributed by JPL TSolucio S.L. is distributed in
 * the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Unless required by
 * applicable law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT ANY WARRANTIES OR CONDITIONS OF ANY KIND,
 * either express or implied. See the License for the specific language governing
 * permissions and limitations under the License. You may obtain a copy of the License
 * at <http://corebos.org/documentation/doku.php?id=en:devel:vpl11>
 *************************************************************************************************
 *  Version      : 1.0
 *  Author       : JPL TSolucio, S. L.
 *************************************************************************************************/

class cbDevelEventHandler extends VTEventHandler {

	public function handleEvent($handlerType, $entityData) {
		global $currentModule;
		
		//$modulename = $entityData->getModuleName();
		$modulename = $currentModule;
		if ($modulename=='cbDesarrollos') {
			switch ($handlerType) {
				case 'corebos.footer':
					echo "Estoy en el FOOTER cbDevelEH";
					break;
				case 'corebos.header':
					echo "Estoy en el HEADE cbDevelEH";
					break;
			}
		}
	}

	public function handleFilter($handlerType, $parameter) {
		global $currentModule;
		
		//$modulename = $entityData->getModuleName();
		$modulename = $currentModule;
		if ($modulename=='cbDesarrollos') {
			switch ($handlerType) {
				case 'corebos.filter.editview.setObjectValues':
					$parameter->column_fields['referencia'] = 'valor por defecto';
					break;
			}
		}
		return $parameter;
	}


}