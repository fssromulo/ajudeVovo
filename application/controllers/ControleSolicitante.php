<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleSolicitante extends CI_Controller {

	private $id_contratante;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('ControleSolicitanteDB');	
	}

	public function index() {
		$this->load->view('ControleSolicitante');
	}

	public function buscaServico(){
		$listaDetalheServico = $this->ControleSolicitanteDB->
			getDadosServico($this->session->userdata('id_contratante'))->result_array();

		echo json_encode($listaDetalheServico);
	}
}