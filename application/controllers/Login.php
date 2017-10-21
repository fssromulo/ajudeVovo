<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
		COMO JOGAR DADOS NA SESSAO DO USUARIO: 
			$this->session->set_userdata($arrComAsInformacoes);
			Exemplo do valor:
				arrComAsInformacoes['NOME_DA_PESSOA'] = "VOVOZONA";

	   COMO PEGAR OS VALORES DA SESSAO:

	   $this->session->userdata('INDICE_DO_ARRAY_DO_EXEMPLO_ANTERIOR');

	   Eexemplo :
			$this->session->userdata('NOME_DA_PESSOA');
		Isso retornaria o nome da pessoa, que seria : "VOVOZONA";

		Para maiores explicacoes: 
			https://codeigniter.com/userguide3/libraries/sessions.html

	*/

	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		$this->load->model('LoginDB');
	}

	public function index() {}

	public function fazerLogin() {
      (array)$arrPessoa = json_decode(file_get_contents("php://input"), true);   

      // codifica a senha
   	$arrPessoa['senha'] =  md5($arrPessoa['senha']);

  		$arrRetornoPessoa = array();
  		switch ($arrPessoa['perfil']) {
  			case 'ajudante':  {
	   		$arrRetornoPessoa = $this->LoginDB->getLoginAjudante( $arrPessoa )->result_array();
				
				// Se achou a pessoa seta os dados dela na sessao
	   		if ( !empty($arrRetornoPessoa) ) {
	   			$arrRetornoPessoa = $arrRetornoPessoa[0];
					$this->session->set_userdata($arrRetornoPessoa);

					echo 'true';
					return;
	   		}

	   		echo 'Erro - usuário não encontrado';
	   		return;

  			}
	   	break;
	   	case 'contratante':  
	   		$arrRetornoPessoa = $this->LoginDB->getLoginContratante( $arrPessoa )->result_array();
				$arrRetornoPessoa = $arrRetornoPessoa[0];

	   			// var_dump( $arrRetornoPessoa );
	   			// die;

	   		if ( !empty($arrRetornoPessoa) ) {
					$this->session->set_userdata($arrRetornoPessoa);
	   		}

	   	break;
	   	default : 
	   		return $arrRetornoPessoa;
	   	break;
  		}

	   // var_dump( $arrRetornoPessoa );
	   // die;


   }

}
