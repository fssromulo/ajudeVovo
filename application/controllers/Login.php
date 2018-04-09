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

	private $arrDiretorios;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ControleAcesso');
		$this->load->helper('url');	

		$this->load->model('LoginDB');

		$this->arrDiretorios = $this->controleacesso->getDiretorioArquivos();
	}

	public function index() {}

	public function fazerLogin() {
      (array)$arrPessoa = json_decode(file_get_contents("php://input"), true);   

      // codifica a senha
   	$arrPessoa['senha'] =  md5($arrPessoa['senha']);

  		$arrRetornoPessoa = array();
  		switch ($arrPessoa['perfil']) {
  			case 'ajudante':  {
	   		$arrRetornoPessoa = $this->LoginDB->getAjudante( $arrPessoa, 'login' )->result_array();
				
				// Se achou a pessoa seta os dados dela na sessao
	   		if ( !empty($arrRetornoPessoa) ) {
				$arrRetornoPessoa = $arrRetornoPessoa[0];

				switch ($arrRetornoPessoa['id_estado_pessoa_fisica']) {
					case 1: { //Ativo

						// Trata para apresentar uma no menu da pessoa
						$arrRetornoPessoa['imagem_pessoa'] =
							$this->controleacesso->verificaImagemPessoa($arrRetornoPessoa['imagem_pessoa']);

	 					if ( !empty($this->arrDiretorios) ) {
							$arrRetornoPessoa['DIR_DOCS_PESSOAS']   = $this->arrDiretorios['DIR_DOCS_PESSOAS'];
							$arrRetornoPessoa['DIR_FOTOS_PESSOAS']  = $this->arrDiretorios['DIR_FOTOS_PESSOAS']; 						
	 					}					 					 						
						$this->session->set_userdata($arrRetornoPessoa);

						echo 'true';
						return;
					}
					case 2: { //Inativo
						echo 'Usuário inativado!';
						return;
					}
					case 3: { //Aguardando Aprovação
						echo 'Usuário ainda não aprovado!';
						return;
					}
				}
	   		}

	   		echo 'Usuário não encontrado!';
	   		return;

  			}
	   	break;
	   	case 'contratante':  
	   		$arrRetornoPessoa = $this->LoginDB->getContratante( $arrPessoa, 'login' )->result_array();

	   		if ( !empty($arrRetornoPessoa) ) {
					$arrRetornoPessoa = $arrRetornoPessoa[0];

					// Trata para apresentar uma no menu da pessoa
					$arrRetornoPessoa['imagem_pessoa'] =
						$this->controleacesso->verificaImagemPessoa($arrRetornoPessoa['imagem_pessoa']);
 				
 					if ( !empty($this->arrDiretorios) ) {
						$arrRetornoPessoa['DIR_DOCS_PESSOAS']   = $this->arrDiretorios['DIR_DOCS_PESSOAS'];
						$arrRetornoPessoa['DIR_FOTOS_PESSOAS']  = $this->arrDiretorios['DIR_FOTOS_PESSOAS']; 						
 					}


					$this->session->set_userdata($arrRetornoPessoa);

					echo 'true';
					return;
	   		}

	   		echo 'Usuário não encontrado!';
	   		return;

	   	break;
	   	default : 
	   		return $arrRetornoPessoa;
	   	break;
  		}
   }

   public function sairSistema() {
   	$this->controleacesso->encerrarSessao();
   	redirect('/Home/', 'location');
   }

}
