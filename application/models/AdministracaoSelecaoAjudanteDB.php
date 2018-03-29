<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministracaoSelecaoAjudanteDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    
	public function getBuscaPessoasInativas() {
 		$this->db->select('pf.nome, 
 						   pf.dt_nascimento, 
 						   pf.cpf, 
 						   pf.sexo,
		 				   pf.imagem_pessoa,
		 				   pf.nome_pai,
		 				   pf.nome_mae,
		 				   pf.imagem_frente_documento,
		 				   pf.imagem_verso_documento,
		 				   pf.ativo,
		 				   pf.id_pessoa_fisica');
		$this->db->from('pessoa_fisica pf');
		// $this->db->join('cidade c','c.id_cidade = pf.id_cidade', 'inner');
		// $this->db->join('estado e','e.id_estado = pf.id_estado', 'inner');
		$this->db->where('pf.ativo <> 1'); // 
		return $query = $this->db->get();
	}

	public function alterar( $arrPessoaAlterar, $id_pessoa ) {
		$this->db->update(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'id_pessoa' => $id_pessoa // CONDICOES QUE IRÃO NO WHERE 
			)
		);

  	}

	


}