<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListarServico extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ServicoDB');
        $this->load->library('controleacesso');
        $this->load->helper('url');
    }

    public function index() {
        /*Verifica sessão do usuário*/
        if (!$this->controleacesso->isUsuarioLogado()) {
            redirect('/Home/');
        }
        
        $this->load->view('ListarServico');
    }

    public function getServicos() {
        $id_prestador = $this->session->userdata('id_prestador');

        $listar = $this->ServicoDB->get_servicos( $id_prestador )->result_array();

        echo json_encode($listar);
    }

    public function inativarServico() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        // A variável $dados contém somente o id_servico.
        // Por isso pode ser passada direta por parâmetro.
        $this->ServicoDB->inativar_servico($dados);
        
        $this->getServicos();
    }

    public function servicoPodeSerInativado() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        // A variável $dados contém somente o id_servico.
        // Por isso pode ser passada direta por parâmetro.
        $quantidadeRegistrosEncontrados = $this->ServicoDB->servico_pode_ser_inativado($dados);
        echo json_encode($quantidadeRegistrosEncontrados);
    }
}