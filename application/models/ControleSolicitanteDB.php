<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleSolicitanteDB extends CI_Model {

	public function __construct() {
	  parent::__construct();
	}

	public function getDadosServico($id_contratante) {

		$this->db->select('
			s.descricao as servico,
			c.descricao as categoria, 
			pf.nome as ajudante,
			TIME_FORMAT(f.horario_inicio,"%H:%i") as horario_inicio, 
			TIME_FORMAT(f.horario_fim,"%H:%i") as horario_fim,			
			DATE_FORMAT(f.dia_solicitacao, "%d/%m/%Y") as dia,
			e.descricao as situacao,
			f.id_estado_operacao,
			f.id_servico_solicitacao,
			s.id_servico,
			s.ativo,
			pf.imagem_pessoa '
		);

		$this->db->distinct();
		$this->db->from(' servico_solicitado f');
		$this->db->join(' servico s','s.id_servico = f.id_servico');
		$this->db->join('categoria c', 'c.id_categoria = s.id_categoria');
		$this->db->join('prestador p', 'p.id_prestador = s.id_prestador');
		$this->db->join('pessoa_fisica pf', 'pf.id_pessoa_fisica = p.id_pessoa');
		$this->db->join('estado_operacao e', 'e.id_estado_operacao = f.id_estado_operacao');
		$this->db->where('f.id_contratante = ' . $id_contratante);
		return $query = $this->db->get();
	}
}