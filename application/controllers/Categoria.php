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
        $listar = $this->CategoriaDB->get_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $is_alterar = $dados['is_alterar'];
        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_categoria']);
        unset($dados['is_alterar']);

        if (!$is_alterar) {
            $this->CategoriaDB->inserir_categoria($dados);
        } else {
            $this->CategoriaDB->alterar_categoria(
                $dados,
                $id_categoria
            );
        }

        $this->getCategorias();
    }

    public function excluir() {
        (array)$dados = json_encode(file_get_contents("php://input"), true);

        $id_categoria = $dados['id_categoria'];

        $this->CategoriaDB->excluir_categoria(
            $dados,
            $id_categoria
        );

        $this->getCategorias();
    }
}