<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguro extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}

	public function index() {}

	public function getCartaoFromLibrary(){
		$this->load->library('PagSeguro/pagsegurolib');
		echo $this->pagsegurolib->getDadosCartao();
	}
	

	public function getSessaoPagSeguroFromLibrary(){
		$this->load->library('PagSeguro/pagsegurolib');
		echo  $this->pagsegurolib->getSessaoPagSeguro();	
	}	
}