<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pessoa extends CI_Controller {

		private $perfil;

		public function __construct() {
			parent::__construct();
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->helper('removecaracteres');
			$this->load->helper('formatardatas');

			$arrModelsImportar = array(
				'PessoaDB',
				'ContatoDB',
				'EnderecoDB',
				'CartaoCreditoDB',
				'LoginDB'
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
				'Pessoa',
				$arrDados
			);			
		}

		public function salvar() {
			(array)$dados = json_decode(file_get_contents("php://input"), true);   

	   	$is_alterar = $dados['is_alterar'];
	   	$cd_pessoa  = isset($dados['cd_pessoa']) ? $dados['cd_pessoa'] : null;

	   	$arrDadosImagem =  $dados['arrDadosImagem'];

	   	unset( $dados['cd_pessoa'] );
	   	unset( $dados['is_alterar'] );
	   	unset( $dados['arrDadosImagem'] );

	   	// $dados
	   	$arrPessoa   = $dados['arrPessoa'];
	   	$arrPessoa['senha'] =  md5($arrPessoa['senha']);
	   	$arrEndereco = $dados['arrEndereco'];
	   	$arrContatos = $dados['arrContatos'];
	   	$arrCartaoCredito = $dados['cartaoCredito'];
	   	unset( $arrCartaoCredito['is_alterar'] );

	   	// Ajusta os valores para salvar no banco
	   	$arrPessoa['cpf']   = removeCaracteres($arrPessoa['cpf']);
	   	$arrEndereco['cep'] = removeCaracteres($arrEndereco['cep']);
	   	$arrPessoa['dt_nascimento'] = formatarDatas($arrPessoa['dt_nascimento'], 'Y-m-d');
   	
   		if ( !$is_alterar ) { 
				// Perfil inativo por padrão
				$arrPessoa['ativo'] = 0;

				if ( isset($dados['is_ajudante']) == true ) {
					$this->perfil = 'ajudante';
					$arrPessoa['id_perfil'] = 3;
		   	} else if ( isset($dados['is_contratante']) == true ) {
					$this->perfil = 'contratante';
					$arrPessoa['ativo'] = 1;
					$arrPessoa['id_perfil'] = 2;
		   	}

				// Salvar pessoa
	      	$cd_pessoa = $this->PessoaDB->inserirPessoa($arrPessoa);

	      	// Salva a imagem no servidor e dpois registra o caminho no banco
				$ds_imagem = $this->salvarImagemPessoa(
					$arrDadosImagem,
					$cd_pessoa
				);

				if ( !empty($ds_imagem)) {

					$arrPessoaAlterar = array(
						'imagem_pessoa' => $ds_imagem
					);

					$this->PessoaDB->alterarPessoa( $arrPessoaAlterar, $cd_pessoa );
				}

	      	$arrCondicaoPessoa['id_pessoa_fisica'] = $cd_pessoa;

	      	// Inserir Perfil
	      	$this->inserirPerfil( $cd_pessoa );

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

	      	if ( $this->perfil == 'ajudante') {
	    	 		$arrRetornoPessoa = $this->LoginDB->getAjudante(
	    	 			$arrCondicaoPessoa,
	    	 			'cadastro_pessoa'
	    	 		)->result_array();
	      	} else {
	    	 		$arrRetornoPessoa = $this->LoginDB->getContratante(
	    	 			$arrCondicaoPessoa,
	    	 			'cadastro_pessoa'
	    	 		)->result_array();	      		
	      	}
	      	
   			$arrRetornoPessoa = $arrRetornoPessoa[0];
				$this->session->set_userdata($arrRetornoPessoa);

	      	echo $this->perfil;
 			}	
		}
		   
		public function inserirPerfil( $cd_pessoa) {
			$arrPerfil['id_pessoa'] = $cd_pessoa;

			if ($this->perfil == 'ajudante') {
				$arrPerfil['is_ajudante'] = true;
				$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
	   	}
	   	
	   	if ( $this->perfil == 'contratante' ) {
				$arrPerfil['is_contratante'] = true;
				$this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
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

		public function inativarPessoa() {
			$arrPessoaAlterar = array(
				"ativo" => 0
			);
			
	   	$listar = $this->PessoaDB->inativarPessoa(
				$this->session->userdata('id_pessoa_fisica'),
				$arrPessoaAlterar
			);
		}

		public function salvarImagemPessoa(
			$arrDadosImagem,
			$id_pessoa_fisica
		) {

			$targ_w = $targ_h = 150;
			$img_quality = 120;

			$extensao = '';  
			$nome_imagem = '';
			$ds_imagem = $arrDadosImagem['urlFoto'];

			$arrExtensaoPermitidas = array(
				'jpeg', 'jpg'
			);

			// Pega a extensão do arquivo para salva com a extensão correta 
			$pos_inicio = strpos($ds_imagem, '/')+1;
			$pos_fim    = strpos($ds_imagem, ';');
			$extensao   = substr($ds_imagem,$pos_inicio, ($pos_fim - $pos_inicio) );

			// Se não for um extensão permitida, retorna erro!!
			if (!in_array($extensao, $arrExtensaoPermitidas)) {
				echo 'Extensão não aceita! Transfira um arquivo jpeg ou jpg';    
				die;
			}

			// limpar o buffer de imagem
			ob_clean(); 
			ob_start();
			$img_r = imagecreatefromjpeg($ds_imagem);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

			imagecopyresampled(
				$dst_r,
				$img_r,
				0,
				0,
				$arrDadosImagem['x'],
				$arrDadosImagem['y'],
				$targ_w,
				$targ_h,
				$arrDadosImagem['w'],
				$arrDadosImagem['h']
			);

			$nome_imagem =  $id_pessoa_fisica .  '.' . $extensao ;

			$ds_pasta_salvar = './includes/imagens/fotos_pessoas/'. $nome_imagem; 

			imagejpeg($dst_r, $ds_pasta_salvar, $img_quality);

			ob_clean(); 

			return $nome_imagem;
		}
	}