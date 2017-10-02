<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConsultaServicoCliente extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('ServicoDB');		
	}

	public function index() {

		$this->load->view('ConsultaServicoCliente');
	}

	public function goToDetail() {
		redirect(('././ajudeVovo/Avaliacao/'));
		die('Redirecionando...');
		$this->load->view('Avaliacao');
	}

	public function getServicosCliente() {
        $listar = $this->ServicoDB->get_servicos_cliente()->result_array();

        echo json_encode($listar);
    }
}
