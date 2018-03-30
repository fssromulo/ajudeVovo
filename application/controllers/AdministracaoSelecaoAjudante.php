<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministracaoSelecaoAjudante extends CI_Controller {

	//private $id_pessoa;

	public function __construct(){
		parent::__construct();
		// $this->load->model('Pessoa');
		$this->load->model('AdministracaoSelecaoAjudanteDB');
		$this->load->helper('url');	
		$this->id_pessoa = null;
	}

	public function index()
	{
		$this->load->view('AdministracaoSelecaoAjudante');
	}


	public function getBuscaPessoasInativas(){
		(array)$dados = json_decode(file_get_contents("php://input"), true); 

		//$this->id_pessoa = $dados['id_pessoa'];

		/*if ( is_null( $this->id_pessoa ) ) {
			return null;
		}*/

		$listaPessoas = $this->AdministracaoSelecaoAjudanteDB->getBuscaPessoasInativas()->result_array();

		echo json_encode($listaPessoas);
	}

	
	

}