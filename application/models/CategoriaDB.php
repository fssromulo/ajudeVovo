<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function buscar_categorias() {
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

    public function alterar_categoria($arrCategoriaAlterar, $id_categoria) {
        $this->db->update(
            'categoria',
            $arrCategoriaAlterar,
            array('id_categoria' => $id_categoria)
        );
    }

    public function excluir_categoria($id_categoria) {
        $this->db->delete(
            'categoria',
            array('id_categoria' => $id_categoria)
        );
    }
}
?>