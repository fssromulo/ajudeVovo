<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleAcesso {

	protected $CI;

	// No construtor das classes "libraries" instanciamos o core do CODEIGNITER
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();

		$this->CI->load->library('session');
		$this->CI->load->helper('url');
	}

	/**
		Verifica se tem codigo de pessoa setado na sessão
	*/ 
	public function isUsuarioLogado() {
 		
		if ( empty($this->CI->session->userdata('id_pessoa_fisica')) ) {
			// Destrói a sessão para garantir que nenhum dado ficar na proxima sessão
			// $this->CI->session->sess_destroy();
			return false;
		}

		return true;
   }

   public function encerrarSessao() {
   	$this->CI->session->sess_destroy();
   }
   
   public function getDiretorioArquivos(){ 
   	$arrDiretorios = array();

   	// Pega a URL BASE DO SISTEMA para usar na sessão
   	// Assim se precisarmos usar a url de qualquer diretorio(Imagens) estará na sessao
		$base_url = $this->CI->config->base_url();

		$arrDiretorios = array(
			'DIR_DOCS_PESSOAS'   => $base_url . 'includes/imagens/documentos_pessoas/', 
			'DIR_FOTOS_PESSOAS'  => $base_url . 'includes/imagens/fotos_pessoas/'
		);

   	return $arrDiretorios;
   }

   public function verificaImagemPessoa( $img_pessoa = '' ) { 						
		// SETA UMA IMAGEM PADRÃO se vazio
		if ( empty($img_pessoa) ) {			
			$img_pessoa = 'ajudevovo_padrao.png';
		}
		return $img_pessoa;	
   }

}