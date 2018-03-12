<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');
 
if ( !function_exists('removeCaracteres')) {
	function removeCaracteres($valor = null){ 
 		$valorRetorno = '';

 		if ( is_null($valor) ) {
 			return $valorRetorno;
 		}

 		$arrCaracteresRetirar = array(
 			'/',
 			'(',
 			')',
 			'.',
 			'-'
 		);

 		$valorRetorno = str_replace($arrCaracteresRetirar, '', $valor);

 		return $valorRetorno;
	}
}