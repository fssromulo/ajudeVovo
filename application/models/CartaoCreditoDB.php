<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartaoCreditoDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getCartaoCredito() {
 		// return $this->db->get( //this->db->get (tabela) é como se fosse um select * from nome_tabela
 		// 	'cartao_credito'  
 		// );

 		$this->db->select('cartao_credito.*, pessoa_fisica.nome');
		$this->db->from('cartao_credito');
		$this->db->join('pessoa_fisica', 'pessoa_fisica.id_pessoa_fisica = cartao_credito.id_pessoa', 'left');
		return $query = $this->db->get();
  	}

	public function inserir_cartao($arrCartao) {
 		$this->db->insert(
 			'cartao_credito',
 			$arrCartao
 		);
  	}

	public function alterar_cartao( $arrCartaoAlterar, $id_cartao ) {
		$this->db->update(
			'cartao_credito', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrCartaoAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'id_cartao' => $id_cartao // CONDICOES QUE IRÃO NO WHERE 
			)
		);

  	}

	public function excluir_cartao( $id_cartao) {
		$this->db->delete(
			'cartao_credito', // NOME DA TABELA QUE RECEBERÁ O DELETE
			array(
				'id_cartao' => $id_cartao // CONDICOES QUE IRÃO NO WHERE 
			)
		);
  	}
}
?>
