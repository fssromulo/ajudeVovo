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
                    s.ativo = 1
                and 
                    s.id_prestador=" . $id_prestador);
    }

    public function get_servico($id_servico) {
        return $this->db->query(
            "select 
                s.id_servico as id_servico, 
                s.id_categoria as id_categoria, 
                s.descricao as descricao, 
                CONCAT('R$ ',format(s.valor,2,'de_DE')) valor,
                s.detalhe as detalhe,
                s.ativo as ativo
            from 
                servico s
            where 
                s.id_servico=" . $id_servico);
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

    public function inativar_servico($id_servico) {
        $data = array('ativo' => 0);
        $this->db->where('id_servico', $id_servico);
        $this->db->update('servico', $data);
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

    public function servico_pode_ser_inativado($id_servico) {
        $query = $this->db->query(
            "select 
                ss.id_servico
            from 
                servico_solicitado ss
            where
                ss.id_servico =".$id_servico." 
            and 
                ss.id_estado_operacao in(1,2,4,5)"
        );

        return $query->num_rows();
    }

    public function get_servicos_cliente($filter, $order) {
        return $this->db->query("
        select
            s.id_servico id_servico,
            c.descricao ds_categoria, 
            c.imagem_categoria url_img_categoria,
            pf.nome nm_prestador,
            pf.imagem_pessoa imagem_pessoa, 
            obter_avaliacao(id_servico) qt_estrela, 
            obter_quantidade_servicos(id_servico) qt_servico, 
            RPAD(concat_ws(' - ', s.descricao, s.detalhe), 255, ' ') ds_detalhe, 
            s.valor
        from
        	pessoa_fisica pf,
            prestador p,
            servico s,
            categoria c
        where	
            pf.id_pessoa_fisica = p.id_pessoa
        and		
            p.id_prestador = s.id_prestador
        and
            s.ativo = 1
        and
			pf.id_estado_pessoa_fisica = 1
        and		
            s.id_categoria = c.id_categoria 
        and		
            c.id_categoria = coalesce(?, c.id_categoria)
        and		
            RPAD(concat_ws(' - ', s.descricao, s.detalhe), 255, ' ') like lower('%' ? '%') 
        and		
            lower(pf.nome) like lower('%' ? '%') 
        order by
            ".$order."
        ", array(
                $filter['categoria'],
                $filter['descricao'],
                $filter['ajudante'],
            )
        );
    }


    public function atualizar_servico($arrServicoAtualizar) {
        $data = array (
            'id_categoria' => $arrServicoAtualizar['id_categoria'],
            'descricao' => $arrServicoAtualizar['descricao'],
            'valor' => $arrServicoAtualizar['valor'],
            'detalhe' => $arrServicoAtualizar['detalhe']
        );

        $this->db->where('id_servico', $arrServicoAtualizar['id_servico']);
        $this->db->update('servico', $data);
    }
    
    public function buscar_dia_atendimento_servico($id_servico) {
        return $this->db->query(
            "select 
                d.id_dia_disponivel as id_dia_disponivel, 
                d.nr_dia as nr_dia, 
                d.descricao as dia, 
                h.horario_inicio as horario_inicio, 
                h.horario_fim as horario_fim
            from 
                dia_disponivel d
            join 
                horario_disponivel h
            on
                d.id_dia_disponivel = h.id_dia_disponivel
            where 
                d.id_servico=".$id_servico);
    }

    public function excluir_dia_atendimento_editado($id_dia_atendimento) {
        return $this->db->query(
            'delete from dia_disponivel 
            where id_dia_disponivel in ('.$id_dia_atendimento.')'
        );
    }
}
?>