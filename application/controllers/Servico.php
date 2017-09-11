<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ServicoDB');
    }

    public function index() {
        $this->load->view('servico');
    }

    public function getServicos() {
        $listar = $this->ServicoDB->get_servicos()->result_array();

        echo json_encode($listar);
    }

    public function getCategorias() {
        $listar = $this->ServicoDB->get_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;
        $descricao = isset($dados['descricao']) ? $dados['descricao'] : null;
        $valor = isset($dados['valor']) ? $dados['valor'] : null;
        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        // $id_prestador = isset($dados['id_prestador']) ? $dados['id_prestador'] : null;
        
        unset($dados['id_servico']);
        unset($dados['descricao']);
        unset($dados['valor']);
        unset($dados['id_categoria']);
        // unset($dados['id_prestador']);

        $this->ServicoDB->inserir_servico($dados);        
    
        $this->getServicos();
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);
        
        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;
        $descricao = isset($dados['descricao']) ? $dados['descricao'] : null;
        $valor = isset($dados['valor']) ? $dados['valor'] : null;
        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_servico']);
        unset($dados['descricao']);
        unset($dados['valor']);
        unset($dados['id_categoria']);

        $this->ServicoDB->alterar_servico($dados, $id_servico);

        $this->getServicos();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = $dados['id_servico'];

        $this->ServicoDB->excluir_servico(
            $id_servico
        );

        $this->getServicos();
    }
}