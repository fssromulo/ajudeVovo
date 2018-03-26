<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define("CONTRATANTE", "CONTRATANTE" );
define("AJUDANTE", "AJUDANTE" );

class Avaliacao extends CI_Controller {

	protected $CI;
	private $perfil;

	public function __construct(){
		parent::__construct();
		$this->perfil = null;
		$this->CI =& get_instance();
		$this->load->library('session');
		$this->load->library('controleacesso');
		$this->load->model('AvaliacaoDB');	
		$this->load->helper('url');			
	}

	public function index()
	{
      /*Verifica sessão do usuário*/
      if (!$this->controleacesso->isUsuarioLogado()) {
         redirect('/Home/');
      }

		$this->load->view('Avaliacao');
	}

	private function getIdContratanteServico( $id_servico_solicitado = null) {
		if ( is_null($id_servico_solicitado) || is_null($this->perfil) ) {
			return '';
		}

		// Se o Ajudante esta logado, pega os dados do contratante
		// Pois o ajudante avalia o CONTRATANTE E vice-versa
		if ( $this->perfil == AJUDANTE ) {
		
			$this->CI->load->library('contratante');
			$arrContratante = $this
								->CI
								->contratante
								->getContratante($id_servico_solicitado);

			return $arrContratante['id_contratante'];
		}

	}

	public function salvar() {
		(array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
		$id_servico = $dados['id_servico'];
		$id_contratante = $this->session->userdata('id_contratante');
		$id_prestador = $this->session->userdata('id_prestador');


		if ( !empty($id_contratante) ) {
			$this->perfil = CONTRATANTE;
		} else if ( !empty($id_prestador) ) {
			$this->perfil = AJUDANTE;
		}

		unset($dados['id_servico']);

		$this->AvaliacaoDB->inserir_avaliacao($dados);

		$insert_id = $this->db->insert_id();

		$dados['id_avaliacao'] = $insert_id;
		unset($dados['nota']);
		unset($dados['comentario']);

		if ($this->perfil == CONTRATANTE) {
			$dados['id_servico'] = $id_servico;
			$this->AvaliacaoDB->inserir_avaliacao_servico($dados);
		} else if ($this->perfil == AJUDANTE ) {
			$id_contratante = $this->getIdContratanteServico($id_servico);	
			$dados['id_contratante'] = $id_contratante;
			$this->AvaliacaoDB->inserir_avaliacao_contratante($dados);
		}
	}
}
