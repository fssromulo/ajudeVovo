<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjudeVovoDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPessoasVovo() {
 		return $this->db->get(
 			'pessoa_fisica'
 		);
  	}

	public function inserir_pessoa($arrPessoa) {
 		$this->db->insert(
 			'pessoa_fisica',
 			$arrPessoa
 		);
  	}

	public function alterar_pessoa( $arrPessoaAlterar, $id_pessoa_fisica ) {
		$this->db->update(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
			)
		);

  	}

	public function excluir_pessoa( $id_pessoa_fisica ) {
		$this->db->delete(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O DELETE
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
			)
		);
  	}
}
?>
