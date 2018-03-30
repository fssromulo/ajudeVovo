<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	private function getCondicao($arrDadosPessoa, $ds_tela ) {
		$ds_condicao_retorno = '';

		if ( $ds_tela == 'login' ) {
			return $ds_condicao_retorno = "  pf.login = '" . $arrDadosPessoa['usuario'] . "'" .
				" AND pf.senha = '" . $arrDadosPessoa['senha'] . "'";
		}

		if ( $ds_tela == 'cadastro_pessoa' ) {
			return $ds_condicao_retorno = "  pf.id_pessoa_fisica = " . $arrDadosPessoa['id_pessoa_fisica'];
		}

		return $ds_condicao_retorno;
	}

	public function getAjudante($arrDadosPessoa = null, $ds_tela) {
       		
       	if ( empty($arrDadosPessoa) ) {
       		return false;
       	}

       	$ds_condicao =  $this->getCondicao($arrDadosPessoa, $ds_tela);

       	return $this->db->query(
				' SELECT ' 
				.'	pf.id_pessoa_fisica, '
				.'	p.id_prestador, '
				.'	pf.nome, '
				.'	pf.imagem_pessoa, '
				.'	pf.id_estado_pessoa_fisica, '
				.'	pf.login '
				.' FROM '
				.'	pessoa_fisica pf '
				.' INNER JOIN prestador p ON ( '
				.'	p.id_pessoa = pf.id_pessoa_fisica '
				.' ) '
				.' WHERE	' . $ds_condicao
		   , FALSE);
  	}

	public function getContratante($arrDadosPessoa = null, $ds_tela) {
       		
       	if ( empty($arrDadosPessoa) ) {
       		return false;
       	}

       	$ds_condicao =  $this->getCondicao($arrDadosPessoa, $ds_tela);

       	return $this->db->query("
				SELECT
					pf.id_pessoa_fisica,
					c.id_contratante,
					pf.nome,
					pf.imagem_pessoa,
					pf.login
				FROM
					pessoa_fisica pf
				INNER JOIN contratante c ON (
					c.id_pessoa = pf.id_pessoa_fisica
				) 
				WHERE " . $ds_condicao 
		   , FALSE);
  	}
}
?>
