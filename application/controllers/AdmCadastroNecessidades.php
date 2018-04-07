<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmCadastroNecessidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdmCadastroNecessidadesDB');
    }

    public function index() {
        $arrTitulo = array(
        'titulo_tela' => 'Cadastro&nbsp;de&nbsp;Necessidades&nbsp;Especiais'
         );

         $this->load->view('AdmCadastroNecessidades', $arrTitulo);
    }

    public function necessidades_especiais() {
        $listar = $this->AdmCadastroNecessidadesDB->buscar_necessidades()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_necessidade_especial = isset($dados['id_necessidade_especial']) ? $dados['id_necessidade_especial'] : null;
        
        unset($dados['id_necessidade_especial']);

        var_dump($dados);
        
        $this->AdmCadastroNecessidadesDB->inserir_necessidade($dados);

        $this->necessidades_especiais();
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_necessidade_especial = isset($dados['id_necessidade_especial']) ? $dados['id_necessidade_especial'] : null;
        
        unset($dados['id_necessidade_especial']);

        $this->AdmCadastroNecessidadesDB->alterar_necessidade($dados, $id_necessidade_especial);

        $this->necessidades_especiais();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_necessidade_especial = $dados['id_necessidade_especial'];

        $this->AdmCadastroNecessidadesDB->excluir_necessidade(
            $id_necessidade_especial
        );

        $this->necessidades_especiais();
    }
}