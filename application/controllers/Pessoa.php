<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');

		$arrModelsImportar = array(
			'PessoaDB',
			'ContatoDB',
			'EnderecoDB'
		);

		foreach ( $arrModelsImportar as $chave => $modelImportar ) {
			$this->load->model($modelImportar);
		}
	}

	public function index() {
		$contratante = $this->input->get('contratante', TRUE);
		$ajudante = $this->input->get('ajudante', TRUE);

		$arrDados = array();

		if ( !isset($contratante) && !isset($ajudante)) {
			redirect('./Home/');
			die('Redirecionando...');
		}
		
		$arrDados = array(
			"contratante" => isset($contratante) ? 1 : 0,
			"ajudante"    => isset($ajudante) ? 1 : 0
		);

		$this->load->view(
			'pessoa',
			$arrDados
		);			
	}

	public function salvar() {
      (array)$dados = json_decode(file_get_contents("php://input"), true);   

   	$is_alterar = $dados['is_alterar'];
   	$cd_pessoa = isset($dados['cd_pessoa']) ? $dados['cd_pessoa'] : null;
   	unset( $dados['cd_pessoa'] );
   	unset( $dados['is_alterar'] );

   	$arrPessoa   = $dados['arrPessoa'];
   	$arrPessoa['senha'] =  md5($arrPessoa['senha']);
   	$arrEndereco = $dados['arrEndereco'];
   	$arrContatos = $dados['arrContatos'];



   	if ( !$is_alterar ) {  			
      	$cd_pessoa = $this->PessoaDB->inserirPessoa($arrPessoa);

      	// Inserir Perfil
      	$this->inserirPerfil( $dados, $cd_pessoa );

   		$arrEndereco['id_pessoa'] = $cd_pessoa;

      	$this->EnderecoDB->inserirEndereco($arrEndereco);
      	
      	foreach ( $arrContatos as $chave => $contato ) {
   			$contato['id_pessoa'] = $cd_pessoa;
      		$this->ContatoDB->inserirContato($contato);
      	}
     }

   	if ( $is_alterar ) {
      	$this->PessoaDB->alterar_pessoa(
      		$arrPessoa,
      		$cd_pessoa
      	);
   	}
   }
   
	public function inserirPerfil($arrDados, $cd_pessoa)
	{

		$arrPerfil['id_pessoa'] = $cd_pessoa;
		if ( isset($arrDados['is_ajudante']) == true ) {
			$arrPerfil['is_ajudante'] = true;
			$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
			return;
   	}
   	
   	if ( isset($arrDados['is_contratante']) == true ) {
			$arrPerfil['is_contratante'] = true;
			$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
			return;
   	}

	}
   
	public function excluir()
	{
		(array)$dados = json_decode(file_get_contents("php://input"), true);  

		$cd_pessoa = $dados['cd_pessoa'];

	   $listar = $this->PessoaDB->excluir_pessoa(
			$dados,
			$cd_pessoa 
		);

	}

	public function getPessoas()
	{
	   $listar = $this->PessoaDB->getPessoasFisica()->result_array();

     	echo json_encode($listar);
	}

}
