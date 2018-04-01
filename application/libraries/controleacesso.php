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
   

   public function verificaImagemPessoa( $img_pessoa = '' ) { 						
		
		// SETA UMA IMAGEM PADRÃO se vazio
		if ( empty($img_pessoa) ) {			
			$img_pessoa = 'pwa_icons/android-chrome-192x192.png';
			return $img_pessoa;
		}
	
		return 'fotos_pessoas/' . $img_pessoa;	
   }

}