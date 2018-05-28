<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContratanteDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function getContratante($id_servico_solicitacao) {

			$ds_sql =  ' SELECT  '
				. ' 	pf.id_pessoa_fisica, '
				. ' 	ss.id_servico_solicitacao, '
				. ' 	s.id_servico, '
				. ' 	ct.id_contratante, '
				. ' 	pf.nome, '
				. ' 	pf.cpf, '
				. ' 	DATE_FORMAT(pf.dt_nascimento, "%d/%m/%Y") dt_nascimento,  '
				. ' 	c.descricao cidade, '
				. ' 	e.bairro, '
				. ' 	e.rua, '
				. ' 	e.cep, '
				. ' 	e.numero, '
				. ' 	e.complemento, '
				. ' 	es.uf estado_sigla, '
				. ' 	(SELECT ct.descricao  FROM contato ct WHERE ct.id_pessoa = pf.id_pessoa_fisica AND ct.id_tipo_contato = 3) telefone, '
				. ' 	(SELECT ct.descricao  FROM contato ct WHERE ct.id_pessoa = pf.id_pessoa_fisica AND ct.id_tipo_contato = 4) email	 '
				. ' FROM '
				. '   servico_solicitado ss '
				. '  '
				. ' INNER JOIN servico s on ( '
				. ' 	s.id_servico = ss.id_servico '
				. ' ) '
				. ' INNER JOIN contratante ct on ( '
				. ' 	ct.id_contratante = ss.id_contratante '
				. ' ) '
				. ' INNER join pessoa_fisica pf ON ( '
				. ' 	pf.id_pessoa_fisica = ct.id_pessoa '
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
				. ' 	ss.id_servico_solicitacao = ?';

			$arrCondicao = array(
				$id_servico_solicitacao
			);

       	return $this->db->query(
				$ds_sql,
				$arrCondicao
			);
  	}

	public function getCartaoCreditoById($id_pessoa) {
   	$ds_sql = ' SELECT 
   		cc.id_cartao,
			cc.id_pessoa,
			cc.numero_cartao,
			cc.nome_titular,
			cc.dt_validade,
			cc.codigo_seguranca,
			MONTH(cc.dt_validade) mes_cartao,
			YEAR(cc.dt_validade) ano_cartao

			FROM cartao_credito cc
			WHERE
				cc.id_pessoa = ?';

		$arrCondicao = array(
			$id_pessoa
		);

   	return $this->db->query(
			$ds_sql,
		   $arrCondicao
		);
  	}


}