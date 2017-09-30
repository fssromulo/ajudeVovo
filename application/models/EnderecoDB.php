<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnderecoDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function inserirEndereco($arrEndereco) {
 		$this->db->insert(
 			'endereco',
 			$arrEndereco
 		);
  	}

}
?>
