<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeralDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getListaPais( $arrFiltros = null ) { 			
		if ( empty($arrFiltros) ) {
			return $this->db->get(
 				'pais'
 			);	
		}
  	}

	public function getListaEstado( $id_pais = null ) { 					
		$this->db->select('id_estado, descricao');
		$this->db->from('estado');
		$this->db->where('id_pais', $id_pais);
		return $this->db->get();
  	}

	public function getListaCidade( $id_estado = null ) { 					
		$this->db->select('id_cidade, descricao');
		$this->db->from('cidade');
		$this->db->where('id_estado', $id_estado);
		return $this->db->get();
  	}
}
?>