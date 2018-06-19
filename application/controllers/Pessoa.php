<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pessoa extends CI_Controller {

		private $perfil;
		private $arrDiretorios;

		public function __construct() {
			parent::__construct();
			$this->load->library('session');
			$this->load->library('ControleAcesso');
			$this->load->helper('url');
			$this->load->helper('removecaracteres');
			$this->load->helper('formatardatas');

			$this->arrDiretorios = $this->controleacesso->getDiretorioArquivos();

			$arrModelsImportar = array(
				'PessoaDB',
				'ContatoDB',
				'EnderecoDB',
				'CartaoCreditoDB',
				'LoginDB',
				'AdmCadastroNecessidadesDB'
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
	   	$arrNecessidade = isset($dados['arrNecessidade']) ? $dados['arrNecessidade'] : null ;
	   	unset( $arrCartaoCredito['is_alterar'] );
	   	unset( $dados['arrPessoa'] );
	   	unset( $dados['arrContatos'] );
	   	unset( $dados['arrEndereco'] );
	   	unset( $dados['cartaoCredito'] );

	   	// Ajusta os valores para salvar no banco
	   	$arrPessoa['cpf']   = removeCaracteres($arrPessoa['cpf']);
	   	$arrEndereco['cep'] = removeCaracteres($arrEndereco['cep']);
	   	$arrPessoa['dt_nascimento'] = formatarDatas($arrPessoa['dt_nascimento'], 'Y-m-d');

   		if ( !$is_alterar ) { 
				
				/*
					CRIA A PESSOA COM O STATUS DE "AGUARDANDO APROVAÇÃO" 
					SE FOR AJUDANTE
				*/
				$arrPessoa['id_estado_pessoa_fisica'] = 3;

				if ( isset($dados['is_ajudante']) == true ) {
					$this->perfil = 'ajudante';
					$arrPessoa['id_perfil'] = 3;
		   	} else if ( isset($dados['is_contratante']) == true ) {
					$this->perfil = 'contratante';
					
					// Se não for ajudante não deve salvar esses dados
					unset($arrPessoa['id_cidade']);
					unset($arrPessoa['id_estado']);
					unset($arrPessoa['nome_mae']);
					unset($arrPessoa['nome_pai']);
					
					$arrPessoa['id_estado_pessoa_fisica'] = 1;
					$arrPessoa['id_perfil'] = 2;
		   	}

				// Salvar pessoa
	      	$cd_pessoa = $this->PessoaDB->inserirPessoa($arrPessoa);

	      	$ds_imagem = '';

	      	// Salva a imagem no servidor e dpois registra o caminho no banco
				if ( !empty($arrDadosImagem['urlFoto']) ) {				
					$ds_imagem = $this->salvarImagemPessoa(
						$arrDadosImagem,
						$cd_pessoa
					);
				}

				$imagem_frente_documento = '';
				$imagem_verso_documento  = '';

				if ( !empty($dados['imagem_frente_documento']) ) {				
					$imagem_frente_documento = $this->salvarImagemDocumentos(
						$dados['imagem_frente_documento'],
						$cd_pessoa,
						'img_frente'
					);
				}

				if ( !empty($dados['imagem_verso_documento']) ) {				
					$imagem_verso_documento = $this->salvarImagemDocumentos(
						$dados['imagem_verso_documento'],
						$cd_pessoa,
						'img_verso'
					);
				}
				
				if ( !empty($ds_imagem) || !empty($imagem_frente_documento) || !empty($imagem_verso_documento) ) {

					$arrPessoaAlterar = array(
						'imagem_pessoa' => $ds_imagem,
						'imagem_frente_documento' => $imagem_frente_documento,
						'imagem_verso_documento' => $imagem_verso_documento
					);

					$this->PessoaDB->alterarPessoa( $arrPessoaAlterar, $cd_pessoa );
				}
				
	      	$arrCondicaoPessoa['id_pessoa_fisica'] = $cd_pessoa;

	      	// Inserir Perfil
	      	$id_perfil = $this->inserirPerfil( $cd_pessoa );

	   		$arrEndereco['id_pessoa'] = $cd_pessoa;

	      	$this->EnderecoDB->inserirEndereco($arrEndereco);

	      	//Inserir Necessidades se for um vovo
				if ( isset($dados['is_contratante']) == true ) {
					$this->inserir_necessidade_contratante($arrNecessidade, $id_perfil);			
				}

	      	
	      	// Salvar dados do cartao da pessoa
	      	if ( !empty($arrCartaoCredito) ) {
		      	$arrCartaoCredito['id_pessoa'] = $cd_pessoa;
		      	
		      	// Ajusta os valores para salvar no banco
		      	$arrCartaoCredito['dt_validade'] = formatarDatas(
		      		$arrCartaoCredito['dt_validade'],
		      		'Y-m-d'
		      	);

		      	$this->CartaoCreditoDB->inserir_cartao($arrCartaoCredito);      		
	      	
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

   			$arrRetornoPessoa['imagem_pessoa'] =	 
   				$this->controleacesso->verificaImagemPessoa($arrRetornoPessoa['imagem_pessoa']);
				
				if ( !empty($this->arrDiretorios) ) {
					$arrRetornoPessoa['DIR_DOCS_PESSOAS']   = $this->arrDiretorios['DIR_DOCS_PESSOAS'];
					$arrRetornoPessoa['DIR_FOTOS_PESSOAS']  = $this->arrDiretorios['DIR_FOTOS_PESSOAS']; 						
				}				

				$this->session->set_userdata($arrRetornoPessoa);
	      	echo $this->perfil;
 			}	
		}
	}
		   
		public function inserirPerfil( $cd_pessoa) {
			$arrPerfil['id_pessoa'] = $cd_pessoa;

			if ($this->perfil == 'ajudante') {
				$arrPerfil['is_ajudante'] = true;
				return $this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
	   		}
	   	
	   		if ( $this->perfil == 'contratante' ) {
				$arrPerfil['is_contratante'] = true;
				return $this->PessoaDB->inserirPerfilPessoa( $arrPerfil );
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
				"id_estado_pessoa_fisica" => 2
			);
			
	   	$listar = $this->PessoaDB->inativarPessoa(
				$this->session->userdata('id_pessoa_fisica'),
				$arrPessoaAlterar
			);
		}

		public function getExtensaoArquivo( $ds_imagem = null) {

			if ( empty($ds_imagem) ) {
				return null;
			}

			// Pega a extensão do arquivo para salva com a extensão correta 
			$pos_inicio = strpos($ds_imagem, '/')+1;
			$pos_fim    = strpos($ds_imagem, ';');
			$extensao   = substr($ds_imagem,$pos_inicio, ($pos_fim - $pos_inicio) );

			return $extensao;
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
				'jpeg', 'jpg', 'png'
			);

			$extensao = $this->getExtensaoArquivo( $ds_imagem );

			// Se não for um extensão permitida, retorna erro!!
			if (!in_array($extensao, $arrExtensaoPermitidas)) {
				echo 'Extensão não aceita! Transfira um arquivo JPG, JPEG ou PNG';    
				die;
			}

			// limpar o buffer de imagem
			
			if (ob_get_length()) {
				ob_clean(); 
			} 

			ob_start();
			if ( $extensao == 'png' ){
				$img_r = imagecreatefrompng($ds_imagem);				
			} else{ 
				$img_r = imagecreatefromjpeg($ds_imagem);				
			}

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

			$ds_pasta_salvar = './includes/imagens/fotos_pessoas/' . $nome_imagem;	

			imagejpeg($dst_r, $ds_pasta_salvar, $img_quality);

			ob_clean(); 

			return $nome_imagem;
		}

		public function salvarImagemDocumentos(
			$ds_imagem = null, 
			$id_pessoa_fisica = null,
			$nm_documento
		) { 

			$extensao = $this->getExtensaoArquivo( $ds_imagem );

			switch ($extensao) {
				case 'jpg':
				case 'jpeg':
					$img = str_replace('data:image/jpeg;base64,', '', $ds_imagem);
				break;
			
				case 'png':
					$img = str_replace('data:image/png;base64,', '', $ds_imagem);
				break;
				
				default:
					return null;
				break;
			}
			// gera um codigo de unico --> uniqid()


			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			// monta o nomed do documento com o codigo da pessoa e se é frente ou verso
			$nome_imagem = $id_pessoa_fisica . '_' . $nm_documento . '.' . $extensao;
			$file = './includes/imagens/documentos_pessoas/' . $nome_imagem; 
			$success = file_put_contents($file, $data);

			return $success ? $nome_imagem : null;
		}

		public function inserir_necessidade_contratante($arrNecessidade = null, $id_perfil) {
			if ( is_null($arrNecessidade) ) {
				return null;
			}

			/*
				arrNecessidade =>
					[0] => [id_necessidade_especial] - 1,  [descricao]  - descricao2
					[1] => [id_necessidade_especial] - 2,  [descricao] - descricao2  
			*/

			foreach ($arrNecessidade as $necessidade) {
				$arrInserirNecessidade = array(
					'necessidade_especial_id_necessidade_especial' => $necessidade['id_necessidade_especial'],
					'contratante_id_contratante' => $id_perfil
				);

				$this->AdmCadastroNecessidadesDB
					->inserir_necessidade_contratante($arrInserirNecessidade);
			}
		}


		/*
			Verifica se já existe o login informado
		*/
	   public function getLoginExistente() {
			(array)$dados = json_decode(file_get_contents("php://input"), true);   		  
			$arrDados = $this->PessoaDB->getLoginExistente($dados['login'])->result_array();
			echo json_encode($arrDados[0]);
	   }


	}