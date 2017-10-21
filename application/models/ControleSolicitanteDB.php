<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleSolicitanteDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getDadosServico() {
 		// return $this->db->get( //this->db->get (tabela) é como se fosse um select * from nome_tabela
 		// 	'cartao_credito'  
 		// );

 		$this->db->select('d.descricao as dia, d.nr_dia, h.horario_inicio, h.horario_fim');
		$this->db->from('operacao_financeira f');
		$this->db->join(' servico s','s.id_servico = f.id_servico');
		$this->db->join('categoria g', 'h.id_dia_disponivel = d.id_dia_disponivel', 'left');
		$this->db->where('s.id_servico = '.$id_servico);
		return $query = $this->db->get();
	}

select s.descricao, 
	    c.descricao, 
		 pf.nome, 
		 f.horario_inicio, 
		 f.horario_fim, 
		 f.`data`
from operacao_financeira f
inner join servico s 
on s.id_servico = f.id_servico
inner join categoria c
on c.id_categoria = s.id_categoria
inner join prestador p
on p.id_prestador = s.id_prestador
inner join pessoa_fisica pf
on pf.id_pessoa_fisica = p.id_pessoa
where f.id_contratante = 1


	
 }
