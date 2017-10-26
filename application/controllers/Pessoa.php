<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pessoa extends CI_Controller {

		private $perfil;

		public function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('removeCaracteres');
			$this->load->helper('formatarDatas');

			$arrModelsImportar = array(
				'PessoaDB',
				'ContatoDB',
				'EnderecoDB',
				'CartaoCreditoDB'
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

	   	// $dados
	   	$arrPessoa   = $dados['arrPessoa'];
	   	$arrPessoa['senha'] =  md5($arrPessoa['senha']);
	   	$arrEndereco = $dados['arrEndereco'];
	   	$arrContatos = $dados['arrContatos'];
	   	$arrCartaoCredito = $dados['cartaoCredito'];
	   	unset( $arrCartaoCredito['is_alterar'] );

	   	// Ajusta os valores para salvar no banco
	   	$arrPessoa['cpf'] = removeCaracteres($arrPessoa['cpf']);
	   	$arrPessoa['dt_nascimento'] = formatarDatas($arrPessoa['dt_nascimento'], 'Y-m-d');
   	
   		if ( !$is_alterar ) {  			
	      	$cd_pessoa = $this->PessoaDB->inserirPessoa($arrPessoa);

	      	// Inserir Perfil
	      	$this->perfil = $this->inserirPerfil( $dados, $cd_pessoa );

	   		$arrEndereco['id_pessoa'] = $cd_pessoa;

	      	$this->EnderecoDB->inserirEndereco($arrEndereco);
	      	
	      	// Salvar dados do cartao da pessoa
	      	if ( !empty($arrCartaoCredito) ) {
		      	$arrCartaoCredito['id_pessoa'] = $cd_pessoa;
		      	
		      	// Ajusta os valores para salvar no banco
		      	$arrCartaoCredito['dt_validade'] = formatarDatas(
		      		$arrCartaoCredito['dt_validade'],
		      		'Y-m-d'
		      	);

		      	$this->CartaoCreditoDB->inserir_cartao($arrCartaoCredito);      		
	      	}
	      	
	      	foreach ( $arrContatos as $chave => $contato ) {
	   			$contato['id_pessoa'] = $cd_pessoa;

	   			if ( $contato['id_tipo_contato'] != 4 && !empty($contato['descricao']) ) {
	   				$contato['descricao'] = removeCaracteres($contato['descricao']);
	   			}

	      		$this->ContatoDB->inserirContato($contato);
	      	}

	      	echo $this->perfil;
 			}	
		}
		   
		public function inserirPerfil($arrDados, $cd_pessoa) {
			$arrPerfil['id_pessoa'] = $cd_pessoa;

			if ( isset($arrDados['is_ajudante']) == true ) {
				$arrPerfil['is_ajudante'] = true;
				$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
				return 'ajudante';
	   	}
	   	
	   	if ( isset($arrDados['is_contratante']) == true ) {
				$arrPerfil['is_contratante'] = true;
				$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
				return 'contratante';
	   	}
		}
	   
		public function excluir() {
			(array)$dados = json_decode(file_get_contents("php://input"), true);  

			$cd_pessoa = $dados['cd_pessoa'];

	   		$listar = $this->PessoaDB->excluir_pessoa(
				$dados,
				$cd_pessoa 
			);

		}

		public function getPessoas() {
		   $listar = $this->PessoaDB->getPessoasFisica()->result_array();

	     	echo json_encode($listar);
		}
	}