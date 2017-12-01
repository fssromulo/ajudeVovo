<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AvaliacaoDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function inserir_avaliacao($arrAvaliacao) {
 		$this->db->insert(
 			'avaliacao',
 			$arrAvaliacao
 		);
  	}

	  
	public function inserir_avaliacao_servico($arrAvaliacao) {
 		$this->db->insert(
 			'servico_avaliacao',
 			$arrAvaliacao
 		);
  	}
	  
	public function inserir_avaliacao_contratante($arrAvaliacao) {
 		$this->db->insert(
 			'contratante_avaliacao',
 			$arrAvaliacao
 		);
  	}
}
?>