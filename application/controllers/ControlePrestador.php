<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlePrestador extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('PrestadorDB');
		$this->load->library('session');
	}

	public function index() {
		$this->load->view('ControlePrestador');
	}

	public function buscaServicos() {
		$listaServicosSolicitados = $this->PrestadorDB->getDadosServicosSolicitados(
			$this->session->userdata('id_prestador')
		)->result_array();

		echo json_encode($listaServicosSolicitados);
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

		$this->PrestadorDB->atualizarEstado($dados);
		
	 	if ( $sn_pag_seguro ) {
			$arrIntegraPagSeguro = array(
				'id_servico'			 => $dados['id_servico'],
				'tokenCartaoVovo' 	 => $tokenCartaoVovo
			);
			
			$this->pagsegurolib->realizaPagamentoPagSeguro( $arrIntegraPagSeguro );		
		}

	}
}