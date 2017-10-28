<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestador {

	protected $CI;

	// No construtor das classes "libraries" istanciamos o core do CODEIGNITER
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->model('PrestadorDB');
	}

	public function getPrestador( $id_servico_solicitacao ) {
		$arrDados = $this->CI->PrestadorDB->getPrestador( $id_servico_solicitacao )->result_array();
		return $arrDados[0];
   }

}
