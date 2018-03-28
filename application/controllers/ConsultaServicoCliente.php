<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConsultaServicoCliente extends CI_Controller {

	public function __construct(){
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

      $arrTitulo = array(
      	'titulo_tela' => 'Consulta&nbsp;Servico'
      );

		$this->load->view('ConsultaServicoCliente', $arrTitulo);
	}

	public function goToDetail() {
		redirect(('././ajudeVovo/Avaliacao/'));
		die('Redirecionando...');
		$this->load->view('Avaliacao');
	}

	public function getServicosCliente() {
        $listar = $this->ServicoDB->get_servicos_cliente()->result_array();

        echo json_encode($listar);
    }
}
