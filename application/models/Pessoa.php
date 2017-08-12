<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function salvar_pessoa($arrPessoa) {
		$arrPessoa = $arrPessoa[0];

 		$this->db->insert(
 			'pessoas',
 			$arrPessoa
 		);
  	}

	public function get_pessoas() {
 		return $this->db->get(
 			'pessoas'
 		);
  	}

}
?>