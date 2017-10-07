<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListarServico extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('ServicoDB');
    }

    public function index() {
        $this->load->view('listarServico');
    }

    // public function getServicos() {
    //     $listar = $this->ServicoDB->get_servicos()->result_array();

    //     echo json_encode($listar);
    // }
}