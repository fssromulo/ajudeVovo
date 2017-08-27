<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CategoriaDB');
    }

    public function index() {
        $this->load->view('categoria');
    }

    public function getCategorias() {
        $listar = $this->Categoria->get_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://inout"), true);

        $is_alterar = $dados['is_alterar'];
        $cd_categoria = isset($dados['cd_categoria']) ? $dados['cd_pessoa'] : null;
        unset($dados['cd_categoria']);
        unset($dados['is_alterar']);

        if (!$is_alterar) {
            $this->Categoria->inserir_categoria($dados);
        } else {
            $this->Categoria->alterar_categoria(
                $dados,
                $cd_categoria
            );
        }

        $this->getCategorias();
    }

    public function excluir() {
        (array)$dados = json_encode(file_get_contents("php://input"), true);

        $cd_categoria = $dados['cd_categoria'];

        $listar = $this->Categoria->excluir_categoria(
            $dados,
            $cd_categoria
        );

        $this->getCategorias();
    }
}