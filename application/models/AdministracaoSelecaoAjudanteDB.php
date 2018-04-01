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
					       pf.id_pessoa_fisica,
					       epf.descricao as situacao');
		$this->db->from('pessoa_fisica pf');
		$this->db->join('estado_pessoa_fisica epf','epf.id_estado_pessoa_fisica = pf.id_estado_pessoa_fisica', 'inner');
		$this->db->join('prestador p','p.id_pessoa = pf.id_pessoa_fisica', 'inner');
		$this->db->where('epf.id_estado_pessoa_fisica = 3'); // 
		return $query = $this->db->get();
	}

	
	public function atualizarEstado( $arrPessoaAlterar) {

		$id_pessoa_fisica = $arrPessoaAlterar["id_pessoa_fisica"];

		$this->db->update(
			'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O UPDATE
			$arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
			array(
				'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
			)
		);

  	}

  	
	


}