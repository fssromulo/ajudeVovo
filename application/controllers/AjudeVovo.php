<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjudeVovo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AjudeVovoDB');
		
	}

	public function index()
	{
		$this->load->view('ajudeVovo');
	}

	/*
	  Função que recebe os dados da View e salva no banco de dados
	  Esta função chama o metodo da model inserir_pessoa 
	  que insere novas pesssoas no banco e alterar_pessoa que altera um registro
	*/

	public function salvar() {
      (array)$dados = json_decode(file_get_contents("php://input"), true); 


      // JOGAMOS OS VALORES DO ARRAY NAS VARIAVEIS, POIS VAMOS TIRAR ESSES VALORES DO ARRAY
   	$is_alterar = $dados['is_alterar'];
   	$id_pessoa_fisica = isset($dados['id_pessoa_fisica']) ? $dados['id_pessoa_fisica'] : null;

   	// Unset tira um valor do array, no caso, estou tirando os valores que nao serão salvos em banco
   	unset( $dados['id_pessoa_fisica'] );
   	unset( $dados['is_alterar'] );

   	// Se nao esta alterando, então FAZ O INSERT
   	if ( !$is_alterar ) {  			
	    	$this->AjudeVovoDB->inserir_pessoa($dados);
   	}

		// Se esta alterando, então FAZ O UPDATE
   	if ( $is_alterar ) {
      	$this->AjudeVovoDB->alterar_pessoa(
      		$dados,
      		$id_pessoa_fisica
      	);
   	}
      // CHAME O METODO QUE FAZ O SELECT NA TABELA DE PESSOAS PARA ATUALIZAR A LISTA
      $this->getPessoasVovo();
   }
   
	public function excluir()
	{
		(array)$dados = json_decode(file_get_contents("php://input"), true);  
		
		$id_pessoa_fisica = $dados['id_pessoa_fisica'];

	   $this->AjudeVovoDB->excluir_pessoa(
			$id_pessoa_fisica 
		);

     	$this->getPessoasVovo();
	}

	public function getPessoasVovo()
	{
	   $listar = $this->AjudeVovoDB->getPessoasVovo()->result_array();

     	echo json_encode($listar);
	}

}
