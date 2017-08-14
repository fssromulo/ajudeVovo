<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_pessoas() {
 		return $this->db->get(
 			'pessoas'
 		);
  	}

	public function inserir_pessoa($arrPessoa) {
 		$this->db->insert(
 			'pessoas',
 			$arrPessoa
 		);
  	}

	public function alterar_pessoa( $arrPessoaAlterar, $cd_pessoa ) {
		$this->db->update(
			'pessoas', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'cd_pessoa' => $cd_pessoa // CONDICOES QUE IRÃO NO WHERE 
			)
		);
  	}

	public function excluir_pessoa( $cd_pessoa ) {
		$this->db->delete(
			'pessoas', // NOME DA TABELA QUE RECEBERÁ O DELETE
			array(
				'cd_pessoa' => $cd_pessoa // CONDICOES QUE IRÃO NO WHERE 
			)
		);
  	}


}
?>