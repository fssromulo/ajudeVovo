<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalheServicoDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getListaDiaHorarioServico($id_servico) {
 		// return $this->db->get( //this->db->get (tabela) é como se fosse um select * from nome_tabela
 		// 	'cartao_credito'  
 		// );

 		$this->db->select('d.descricao as dia, d.nr_dia, h.horario_inicio, h.horario_fim');
		$this->db->from('servico s');
		$this->db->join('dia_disponivel d','d.id_servico = s.id_servico', 'left');
		$this->db->join('horario_disponivel h', 'h.id_dia_disponivel = d.id_dia_disponivel', 'left');
		$this->db->where('s.id_servico = '.$id_servico);
		return $query = $this->db->get();
	}


	public function getDetalheServico($id_servico) {
 		$this->db->select('s.descricao, c.descricao as categoria');
		$this->db->from('servico s');
		$this->db->join('categoria c','c.id_categoria = s.id_categoria', 'inner');
		$this->db->where('s.id_servico = '.$id_servico);
		return $query = $this->db->get();
	}

	public function inserirSolicitacao($arrDadosSolicitacao) {
 		$this->db->insert(
 			'servico_solicitado',
 			$arrDadosSolicitacao
 		);
  	}


 }
