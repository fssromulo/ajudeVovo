<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleSolicitante extends CI_Controller {

	private $id_contratante;

	public function __construct(){
		parent::__construct();
		$this->load->model('ControleSolicitanteDB');
		$this->id_contratante=2;		
	}

	public function index() {
		$this->load->view('ControleSolicitante');
	}

	public function buscaServico(){
		$listaDetalheServico = $this->ControleSolicitanteDB->getDadosServico($this->id_contratante)->result_array();

		echo json_encode($listaDetalheServico);
	}	
}