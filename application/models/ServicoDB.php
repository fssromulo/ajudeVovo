<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicoDB extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_servicos($id_prestador) {
        return $this->db->query(
			"select 
				s.id_servico as id_servico, 
				s.descricao as descricao, 
			    CONCAT('R$ ',format(s.valor,2,'de_DE')) valor,
				s.detalhe as detalhe, 
				(SELECT COUNT(ss.id_servico) FROM servico_solicitado ss WHERE ss.id_servico=s.id_servico) as solicitacoes
			from 
				servico s
			where 
				s.id_prestador=" . $id_prestador);
    }

    public function get_categorias() {
        return $this->db->query("select id_categoria, descricao from Categoria");
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

    // TO-DO: CARD NO TRELLO
    // public function desativar_servico($id_servico, $ativo) {
    //     $this->db->update(
    //         'servico',
    //         array('id_servico' => $id_servico);
    //     )

    //     $this->db->update(
    //         'pessoa_fisica', // NOME DA TABELA QUE RECEBERÁ O UPDATE
    //         $arrPessoaAlterar, // Array apenas com os dados que vao no SET do UPDATE
    //         array(
    //             'id_pessoa_fisica' => $id_pessoa_fisica // CONDICOES QUE IRÃO NO WHERE 
    //         )
    //     );
    // }

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
        select
            c.id_servico id_servico,
            d.descricao ds_categoria, 
            d.imagem_categoria url_img_categoria,
            a.nome nm_prestador, 
            obter_avaliacao(id_servico) qt_estrela, 
            obter_quantidade_servicos(id_servico) qt_servico, 
            RPAD(concat_ws(' - ', c.descricao, c.detalhe), 255, ' ') ds_detalhe, 
            c.valor
        from
        	pessoa_fisica a,
            prestador b,
            servico c,
            categoria d
        where	
            a.id_pessoa_fisica = b.id_pessoa
        and		
            b.id_prestador = c.id_prestador
        and		
            c.id_categoria = d.id_categoria ", FALSE);
    }
}
?>