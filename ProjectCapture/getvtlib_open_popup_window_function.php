<?php
	function __hook_getvtlib_open_popup_window_function($fieldname,$basemodule) {
		if ($fieldname=='proyecto' and $basemodule=='cbDesarrollos') {
			return 'projectCaptureOnDesarrollo';
		} else {
			return 'vtlib_open_popup_window';
		}
	}
?>