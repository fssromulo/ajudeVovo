<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('controleacesso');
        $this->load->model('ServicoDB');
        $this->load->helper('url');
    }

    public function index() {
        /*Verifica sessão do usuário*/
        if (!$this->controleacesso->isUsuarioLogado()) {
            redirect('/Home/');
        }

        $dados = $this->input->get('id_servico', true);

        $arrDados = array(
            "id_servico" => !empty($dados) ? $dados : "", 
            'titulo_tela' => 'Cadastro&nbsp;de&nbsp;Serviços'
        );

        $this->load->view('Servico', $arrDados);
    }

    public function editarServico()  {
        $dados = $this->input->get('id_servico', true);

        $arrDados = array(
            "id_servico" => $dados
        );

        $this->load->view('Servico', $arrDados);
    }

    public function getServicoParaEdicao() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $servico = $this->ServicoDB->get_servico($dados)->result_array();

        echo json_encode($servico[0]);
    }

    public function getCategorias() {
        $listar = $this->ServicoDB->get_categorias()->result_array();

        echo json_encode($listar);
    }

    public function salvar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;
        $descricao = isset($dados['descricao']) ? $dados['descricao'] : null;
        $valor = isset($dados['valor']) ? $dados['valor'] : null;
        $detalhe  = isset($dados['detalhe']) ? $dados['detalhe'] : null;
        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;
        $dados['id_prestador'] = $this->session->userdata('id_prestador');
        
        $listaAtendimento = isset($dados['listaAtendimento']) ? $dados['listaAtendimento'] : null;
        unset($dados['listaAtendimento']);

        $servico = $this->ServicoDB->inserir_servico($dados);

        $this->salvarDiaDisponivel($servico, $listaAtendimento);

    }

    public function salvarDiaDisponivel($id_servico, $listaAtendimento) {
        foreach ($listaAtendimento as $chave1 => $value) {
           $arrDiasDisponiveis = array(
                'id_servico' => $id_servico,
                'nr_dia' => $value['nr_dia'],
                'descricao' => $value['dia']
            );

            $dia = $this->ServicoDB->inserir_dia_disponivel($arrDiasDisponiveis);
            
            $arrHorariosDisponiveis = array(
                'id_dia_disponivel' => $dia ,
                'horario_inicio' => $value['horario_inicio'], 
                'horario_fim' => $value['horario_fim']
            );

            $this->salvarHorarioDisponivel($arrHorariosDisponiveis);
        }
    }

    public function salvarHorarioDisponivel($arrHorariosDisponiveis) {
        
        $this->ServicoDB->inserir_horario_disponivel($arrHorariosDisponiveis);
    }

    public function alterar() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);
        
        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;
        $descricao = isset($dados['descricao']) ? $dados['descricao'] : null;
        $valor = isset($dados['valor']) ? $dados['valor'] : null;
        $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : null;

        $this->ServicoDB->alterar_servico($dados, $id_servico);

        $this->getServicos();
    }

    public function excluir() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;

        $this->ServicoDB->excluir_servico(
            $id_servico
        );

        $this->getServicos();
    }
}