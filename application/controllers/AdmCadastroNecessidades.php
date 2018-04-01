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

        $this->AdmCadastroNecessidadesDB->inserir_necessidade($dados);

        $this->necessidades_especiais();
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_perfil = isset($dados['id_perfil']) ? $dados['id_perfil'] : null;
        
        unset($dados['id_perfil']);

        $this->AdmCadastroPerfilDB->alterar_perfil($dados, $id_perfil);

        $this->perfil();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_perfil = $dados['id_perfil'];

        $this->AdmCadastroPerfilDB->excluir_perfil(
            $id_perfil
        );

        $this->perfil();
    }
}