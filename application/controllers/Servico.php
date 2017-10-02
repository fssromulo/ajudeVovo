<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ServicoDB');
    }

    public function index() {
        $this->load->view('servico');
    }

    public function getServicos() {
        $listar = $this->ServicoDB->get_servicos()->result_array();

        echo json_encode($listar);
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
        $id_prestador = isset($dados['id_prestador']) ? $dados['id_prestador'] : null;
        
        $servico = $this->ServicoDB->inserir_servico($dados);

        echo json_encode($servico);
    }

    public function salvarDiaDisponivel() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = isset($dados['id_servico']) ? $dados['id_servico'] : null;
        $descricao = isset($dados['descricao']) ? $dados['descricao'] : null;
        $nr_dia = isset($dados['nr_dia']) ? $dados['nr_dia'] : null;

        $dia = $this->ServicoDB->inserir_dia_disponivel($dados);

        echo json_encode($dia);
    }

    public function salvarHorarioDisponivel() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);
        
        $id_dia_disponivel = isset($dados['id_dia_disponivel']) ? $dados['id_dia_disponivel'] : null;
        $horarioInicio = isset($dados['horario_inicio']) ? $dados['horario_inicio'] : null;
        $horarioFim = isset($dados['horario_fim']) ? $dados['horario_fim'] : null;

        $this->ServicoDB->inserir_horario_disponivel($dados);

        $this->getServicos();
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

        $id_servico = $dados['id_servico'];

        $this->ServicoDB->excluir_servico(
            $id_servico
        );

        $this->getServicos();
    }

    public function buscarHorariosServico() {
        (array)$dados = json_decode(file_get_contents("php://input"), true);

        $id_servico = $dados['id_servico'];

        (array)$horariosDoServico = $this->ServicoDB->buscarHorariosServico(
            $id_servico
        );

        echo($horariosDoServico);
    }
}