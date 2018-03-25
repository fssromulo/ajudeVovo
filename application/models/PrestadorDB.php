<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrestadorDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPrestador($id_servico) {

   	$ds_sql = ' SELECT ' 
			. ' 	pf.id_pessoa_fisica, '
			. ' 	ss.id_servico_solicitacao, '
			. ' 	pf.nome, '
			. ' 	pf.cpf, '
			. ' 	DATE_FORMAT(pf.dt_nascimento,"%d/%m/%Y") dt_nascimento,  '
			. ' 	FORMAT(ROUND(s.valor, 2),2) valor, '
			. ' 	s.descricao descricao_servico, '
			. ' 	c.descricao cidade, '
			. ' 	e.bairro, '
			. ' 	e.rua, '
			. ' 	e.cep, '
			. ' 	e.numero, '
			. ' 	e.complemento, '
			. ' 	es.uf estado_sigla, '
			. ' 	(SELECT get_telefone(pf.id_pessoa_fisica)) telefone, '
			. ' 	( SELECT ct.descricao  FROM contato ct WHERE ct.id_pessoa = pf.id_pessoa_fisica AND ct.id_tipo_contato = 4 ) email '
			. ' FROM '
			. '   servico_solicitado ss '
			. ' INNER JOIN servico s ON ( '
			. ' 	s.id_servico = ss.id_servico '
			. ' ) '
			. ' INNER JOIN prestador p on ( '
			. ' 	p.id_prestador = s.id_prestador '
			. ' ) '
			. ' INNER JOIN pessoa_fisica pf ON ( '
			. ' 	pf.id_pessoa_fisica = p.id_pessoa '
			. ' ) '
			. ' LEFT Join endereco e ON ( '
			. ' 	e.id_pessoa = pf.id_pessoa_fisica '
			. ' ) '
			. ' LEFT JOIN cidade c ON ( '
			. ' 	c.id_cidade = e.id_cidade '
			. ' ) '
			. ' LEFT JOIN estado es ON ( '
			. ' 	c.id_estado = es.id_estado '
			. ' ) '
			. ' WHERE '
			. ' 	s.id_servico = ?';

			$arrCondicao = array(
				$id_servico
			);

   	return $this->db->query(
			$ds_sql,
		   $arrCondicao
		);
  	}

	public function obterSePodeExcluir($id_prestador) {
		return $this->db->query("
			select 
				obter_se_pode_excluir(?) pode
			from 
				dual
			",
			array(
				$id_prestador
			)
		);
	}

	  
	public function getDadosServicosSolicitados($id_prestador) {
		return $this->db->query("
			select
				ss.id_servico_solicitacao,
				s.id_servico,
				pf.nome,
				pf.imagem_pessoa,
				s.descricao,
				s.ativo,
				DATE_FORMAT(ss.dia_solicitacao, '%d/%m/%Y') dia_solicitacao,
				TIME_FORMAT(ss.horario_inicio,'%H:%i') as horario_inicio, 
				TIME_FORMAT(ss.horario_fim,'%H:%i') as horario_fim,		
				eo.id_estado_operacao,
				eo.descricao ds_estado_atual
			FROM
				pessoa_fisica pf,
				contratante c,
				servico_solicitado ss,
				servico s,
				estado_operacao eo
			WHERE	
				pf.id_pessoa_fisica = c.id_pessoa
			AND 
				ss.id_contratante = c.id_contratante
			AND
				ss.id_estado_operacao = eo.id_estado_operacao
			AND		
				ss.id_servico = s.id_servico
		  	AND
				s.id_prestador = ? 
			",
			array(
				$id_prestador
			)
		);
	}

	public function atualizarEstado($params) {
		
		$id_servico = $params["id_servico"];

		$this->db->update(
			'servico_solicitado', 
			$params, 
			array(
				'id_servico' => $id_servico
			)
		);
	}

}