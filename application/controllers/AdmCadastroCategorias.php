<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmCadastroCategorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdmCadastroCategoriasDB');
    }

    public function index() {
        $arrTitulo = array(
        'titulo_tela' => 'Cadastro&nbsp;de&nbsp;Categorias'
         );

         $this->load->view('AdmCadastroCategorias', $arrTitulo);
    }

    public function categorias() {
        $listar = $this->AdmCadastroCategoriasDB->buscar_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_categoria']);

        $this->AdmCadastroCategoriasDB->inserir_categoria($dados);

        $this->categorias();
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        
        unset($dados['id_categoria']);

        $this->AdmCadastroCategoriasDB->alterar_categoria($dados, $id_categoria);

        $this->categorias();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_categoria = $dados['id_categoria'];

        $this->AdmCadastroCategoriasDB->excluir_categoria(
            $id_categoria
        );

        $this->categorias();
    }
}