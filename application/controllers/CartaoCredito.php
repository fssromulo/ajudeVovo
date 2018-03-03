<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CartaoCredito extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('CartaoCreditoDB');	
	}

	public function index()
	{
		$this->load->view('CartaoCredito');
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
   	$id_cartao = isset($dados['id_cartao']) ? $dados['id_cartao'] : null;

   	// Unset tira um valor do array, no caso, estou tirando os valores que nao serão salvos em banco
   	unset( $dados['id_cartao'] );
   	unset( $dados['is_alterar'] );

   	// Se nao esta alterando, então FAZ O INSERT
   	if ( !$is_alterar ) {  			
	    	$this->CartaoCreditoDB->inserir_cartao($dados); //chama a funçao do model que vai fazer o insert
   	}

		// Se esta alterando, então FAZ O UPDATE
   	if ( $is_alterar ) {
      	$this->CartaoCreditoDB->alterar_cartao(
      		$dados,
      		$id_cartao
      	);
   	}
      // CHAME O METODO QUE FAZ O SELECT NA TABELA DE PESSOAS PARA ATUALIZAR A LISTA
      $this->getCartaoCredito();
   }
   
	public function excluir()
	{
		(array)$dados = json_decode(file_get_contents("php://input"), true);  
		
		$id_cartao = $dados['id_cartao'];

	   $this->CartaoCreditoDB->excluir_cartao(
			$id_cartao 
		);

     	$this->getCartaoCredito();
	}

	public function getCartaoCredito()
	{
	   $listar = $this->CartaoCreditoDB->getCartaoCredito()->result_array();

	   
     	echo json_encode($listar);
	}

}
