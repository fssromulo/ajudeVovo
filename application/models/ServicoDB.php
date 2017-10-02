<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicoDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_servicos() {
        return $this->db->get(
            'servico'
        );
    }

    public function get_categorias() {
        return $this->db->get(
            'categoria'
        );
    }

    public function inserir_servico($arrServico) {
        $this->db->insert(
            'servico',
            $arrServico
        );

        return $this->db->insert_id();
    }

    public function alterar_servico($arrServicoAlterar, $id_servico) {
        $this->db->update(
            'servico',
            $arrServicoAlterar,
            array('id_servico' => $id_servico)
        );
    }

    public function excluir_servico($id_servico) {
        $this->db->delete(
            'servico',
            array('id_servico' => $id_servico)
        );
    }

    public function inserir_dia_disponivel($arrDiaDisponivel) {
        $this->db->insert(
            'dia_disponivel',
            $arrDiaDisponivel
        );

        return $this->db->insert_id();
    }

    public function inserir_horario_disponivel($arrHorarioDisponivel) {
        $this->db->insert(
            'horario_disponivel',
            $arrHorarioDisponivel
        );
    }

    public function buscarHorariosServico($id_servico) {
        $this->db->select(
            
        );
    }

    public function get_servicos_cliente() {
        return $this->db->query("
        select	d.descricao ds_categoria, 
                d.imagem_categoria url_img_categoria,
                a.nome nm_prestador, 
                1 qt_estrela, 
                1 qt_servico, 
                RPAD(concat_ws(' - ', c.descricao, c.detalhe), 255, ' ') ds_detalhe, 
                c.valor
        from	pessoa_fisica a,
                prestador b,
                servico c,
                categoria d
        where	a.id_pessoa_fisica = b.id_pessoa
        and		b.id_prestador = c.id_prestador
        and		c.id_categoria = d.id_categoria ", FALSE);
    }
}
?>