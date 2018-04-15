<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PessoaDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPessoasFisica() {
 		return $this->db->get(
 			'pessoa_fisica'
 		);
  	}

	public function inserirPessoa($arrPessoa) {
 		$this->db->insert(
 			'pessoa_fisica',
 			$arrPessoa
 		);

 		return $this->db->insert_id();
  	}

	public function alterarPessoa( $arrPessoaAlterar, $id_pessoa_fisica ) {
		$this->db->update(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
			)
		);

  	}

	public function excluirPessoa( $id_pessoa_fisica ) {
		$this->db->delete(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O DELETE
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
			)
		);
  	}

	public function inserirPerfilPessoa($arrDados) {
 		
 		if (isset($arrDados['is_contratante']) == true) {
 			unset($arrDados['is_contratante']);
	 		$this->db->insert(
	 			'contratante',
	 			$arrDados
	 		);
	 	} 		

 		if (isset($arrDados['is_ajudante']) == true) {
 			unset($arrDados['is_ajudante']);
	 		$this->db->insert(
	 			'prestador',
	 			$arrDados
	 		);
	 	}
	 	
	 	return $this->db->insert_id();
  	}

	public function inativarPessoa($id_pessoa_fisica, $arrPessoaAlterar) {
		$this->db->update(
			'pessoa_fisica', 
			$arrPessoaAlterar, 
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica 
			)
		);
	}
}
?>
