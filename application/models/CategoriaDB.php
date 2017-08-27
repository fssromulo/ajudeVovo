<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_categorias() {
        return $this->db->get(
            'categoria'
        );
    }

    public function inserir_categoria($arrCategoria) {
        $this->db->insert(
            'categoria',
            $arrCategoria
        );
    }

    public function alterar_categoria($arrCategoriaAlterar, $cd_categoria) {
        $this->db->update(
            'categoria',
            $arrCategoriaAlterar,
            array('cd_categoria' => $cd_categoria)
        );
    }

    public function excluir_categoria($cd_categoria) {
        $this->db->delete(
            'categoria',
            array('cd_categoria' => $cd_categoria)
        );
    }
}
?>