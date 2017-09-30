<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		// $this->load->model('Pessoa');
		
	}

	public function index()
	{
		$this->load->view('home');
	}



	/*
	  Função que recebe os dados da View e salva no banco de dados
	  Esta função chama o metodo da model inserir_pessoa 
	  que insere novas pesssoas no banco e alterar_pessoa que altera um registro
	*/

	public function salvar() {
      (array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
   	$is_alterar = $dados['is_alterar'];
   	$cd_pessoa = isset($dados['cd_pessoa']) ? $dados['cd_pessoa'] : null;
   	unset( $dados['cd_pessoa'] );
   	unset( $dados['is_alterar'] );
	
   	if ( !$is_alterar ) {  			
      	$this->Pessoa->inserir_pessoa($dados);
   	}

   	if ( $is_alterar ) {
      	$this->Pessoa->alterar_pessoa(
      		$dados,
      		$cd_pessoa
      	);
   	}
      
      $this->getPessoas();
   }
   
	public function excluir()
	{
		(array)$dados = json_decode(file_get_contents("php://input"), true);  

		$cd_pessoa = $dados['cd_pessoa'];

	   $listar = $this->Pessoa->excluir_pessoa(
			$dados,
			$cd_pessoa 
		);

     	$this->getPessoas();
	}

	public function getPessoas()
	{
	   $listar = $this->Pessoa->get_pessoas()->result_array();

     	echo json_encode($listar);
	}

}
