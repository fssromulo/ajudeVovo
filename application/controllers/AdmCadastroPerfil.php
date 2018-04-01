<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmCadastroPerfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdmCadastroPerfilDB');
    }

    public function index() {
        $arrTitulo = array(
        'titulo_tela' => 'Cadastro&nbsp;de&nbsp;Perfil'
         );

         $this->load->view('AdmCadastroPerfil', $arrTitulo);
    }

    public function perfil() {
        $listar = $this->AdmCadastroPerfilDB->buscar_perfil()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_perfil = isset($dados['id_perfil']) ? $dados['id_perfil'] : null;
        
        unset($dados['id_perfil']);

        $this->AdmCadastroPerfilDB->inserir_perfil($dados);

        $this->perfil();
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