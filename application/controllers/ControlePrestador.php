<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlePrestador extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('PrestadorDB');
		$this->load->library('ControleAcesso');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index() {
      /*Verifica sessão do usuário*/
      if (!$this->controleacesso->isUsuarioLogado()) {
         redirect('/Home/');
      }

      $arrTitulo = array(
      	'titulo_tela' => 'Serviços&nbsp;solicitados'
      );
      		
		$this->load->view('ControlePrestador', $arrTitulo );
	}

	public function buscaServicos() {
		$listaServicosSolicitados = $this->PrestadorDB->getDadosServicosSolicitados(
			$this->session->userdata('id_prestador')
		)->result_array();

		echo json_encode($listaServicosSolicitados);
	}	
	
	public function obterSePodeExcluir() {
		$obterSePodeExcluir = $this->PrestadorDB->obterSePodeExcluir(
			$this->session->userdata('id_prestador')
		)->result_array();

		echo json_encode($obterSePodeExcluir);
	}

	public function getPrestadores() {
		$listar = $this->PrestadorDB->getPrestadores()->result_array();
		echo json_encode($listar);
	}	


	/*
		Função que atualiza o status da solicitacao caso o PRESTADOR aceite ou não 
	*/
	public function atualizarEstado() {
		(array)$dados = json_decode(file_get_contents("php://input"), true);   
	 	$this->load->library('PagSeguro/pagsegurolib');

	 	$sn_pag_seguro = array_key_exists('tokenCartaoVovo', $dados);

	 	if ( $sn_pag_seguro ) {
			$tokenCartaoVovo = $dados['tokenCartaoVovo'];
			unset($dados['tokenCartaoVovo']);		 		
	 	}

	 	if ( $sn_pag_seguro ) {
			$arrIntegraPagSeguro = array(
				'id_servico_solicitacao'	 => $dados['id_servico_solicitacao'],
				'tokenCartaoVovo' 	    => $tokenCartaoVovo
			);
			
			$this->pagsegurolib->realizaPagamentoPagSeguro( $arrIntegraPagSeguro );		
		}

	}
}