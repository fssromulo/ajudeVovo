<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ControleAcesso');
        $this->load->model('CategoriaDB');
        $this->load->helper('url');        
    }

    public function index() {
      /*Verifica sessão do usuário*/
      if (!$this->controleacesso->isUsuarioLogado()) {
         redirect('/Home/');
      }

      $this->load->view('Categoria');
    }

    public function categorias() {
        $listar = $this->CategoriaDB->buscar_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_categoria']);

        $this->CategoriaDB->inserir_categoria($dados);

        $this->categorias();
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_categoria']);

        $this->CategoriaDB->alterar_categoria($dados, $id_categoria);

        $this->categorias();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = $dados['id_categoria'];

        $this->CategoriaDB->excluir_categoria(
            $id_categoria
        );

        $this->categorias();
    }
}