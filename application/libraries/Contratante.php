<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratante {

	protected $CI;

	// No construtor das classes "libraries" istanciamos o core do CODEIGNITER
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->model('ContratanteDB');
	}

	public function getContratante( $id_servico_solicitacao ) {
		$arrDados = $this->CI->ContratanteDB->getContratante( $id_servico_solicitacao )->result_array();
		return $arrDados[0];
   }
   
	public function getCartaoCreditoById( $id_contratante ) {
		$arrDados = $this->CI->ContratanteDB->getCartaoCreditoById( $id_contratante )->result_array();
		return $arrDados[0];
   }

}
