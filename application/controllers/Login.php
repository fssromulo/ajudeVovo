<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	   		$arrRetornoPessoa = $arrRetornoPessoa[0];

	   			var_dump( $arrRetornoPessoa );
	   			die;

	   		if ( !empty($arrRetornoPessoa) ) {
					$this->session->set_userdata($arrRetornoPessoa);
	   		}

  			}
	   	break;
	   	case 'contratante':  
	   		$arrRetornoPessoa = $this->LoginDB->getLoginContratante( $arrPessoa )->result_array();
				$arrRetornoPessoa = $arrRetornoPessoa[0];

	   			var_dump( $arrRetornoPessoa );
	   			die;

	   		if ( !empty($arrRetornoPessoa) ) {
					$this->session->set_userdata($arrRetornoPessoa);
	   		}

	   	break;
	   	default : 
	   		return $arrRetornoPessoa;
	   	break;
  		}

	   var_dump( $arrRetornoPessoa );
	   die;


   }

}
