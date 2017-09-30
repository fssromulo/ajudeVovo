<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getLoginAjudante($arrDadosPessoa = null) {
       		
       	if ( empty($arrDadosPessoa) ) {
       		return false;
       	}

       	return $this->db->query("
				SELECT
					pf.id_pessoa_fisica,
					pf.nome,
					pf.imagem_pessoa,
					pf.login
				FROM
					pessoa_fisica pf
				INNER JOIN prestador p ON (
					p.id_pessoa = pf.id_pessoa_fisica
				) 
				WHERE	
					pf.login = '" . $arrDadosPessoa['usuario'] . "'" .
				"	AND pf.senha = '" . $arrDadosPessoa['senha'] . "'"
		   , FALSE);
  	}

	public function getLoginContratante($arrDadosPessoa = null) {
       		
       	if ( empty($arrDadosPessoa) ) {
       		return false;
       	}

       	return $this->db->query("
				SELECT
					pf.id_pessoa_fisica,
					pf.nome,
					pf.imagem_pessoa,
					pf.login
				FROM
					pessoa_fisica pf
				INNER JOIN contratante c ON (
					c.id_pessoa = pf.id_pessoa_fisica
				) 
				WHERE	
					pf.login = '" . $arrDadosPessoa['usuario'] . "'" .
				"	AND pf.senha = '" . $arrDadosPessoa['senha'] . "'"
		   , FALSE);
  	}
}
?>
