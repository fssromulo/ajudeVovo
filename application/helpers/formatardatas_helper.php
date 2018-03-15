<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');
 
if ( !function_exists('formatarDatas')) {
	function formatarDatas(
		$data = null,
		$formato = "Y-m-d	"
	) {
 		$valorRetorno = '';
 			
		if ( is_null($data) ) {
			return $valorRetorno;
		}

		$objData = DateTime::createFromFormat( 'd/m/Y', $data );
		$valorRetorno = $objData->format($formato);

 		return $valorRetorno;
	}
}