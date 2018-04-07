<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmCadastroNecessidadesDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function buscar_necessidades() {
        return $this->db->get(
            'necessidade_especial'
        );
    }

     
    public function inserir_necessidade($arrNecessidades) {
        $this->db->insert(
            'necessidade_especial',
            $arrNecessidades
        );
    }

    public function alterar_necessidade($arrNecessidades, $id_necessidade_especial) {
        $this->db->update(
            'necessidade_especial',
            $arrNecessidades,
            array('id_necessidade_especial' => $id_necessidade_especial)
        );
    }

    public function excluir_necessidade($id_necessidade_especial) {
        $this->db->delete(
            'necessidade_especial',
            array('id_necessidade_especial' => $id_necessidade_especial)
        );
    }
}
?>