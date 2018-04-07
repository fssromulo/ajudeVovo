<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmCadastroPerfilDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function buscar_perfil() {
        return $this->db->get(
            'perfil'
        );
    }

     
    public function inserir_perfil($arrPerfil) {
        $this->db->insert(
            'perfil',
            $arrPerfil
        );
    }

    public function alterar_perfil($arrPerfilAlterar, $id_perfil) {
        $this->db->update(
            'perfil',
            $arrPerfilAlterar,
            array('id_perfil' => $id_perfil)
        );
    }

    public function excluir_perfil($id_perfil) {
        $this->db->delete(
            'perfil',
            array('id_perfil' => $id_perfil)
        );
    }
}
?>