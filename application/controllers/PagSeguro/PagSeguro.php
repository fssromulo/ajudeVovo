<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguro extends CI_Controller {

	private $email_pagseguro;
	private $token_pagamento;

	public function __construct(){
		parent::__construct();
		// $this->load->model('AjudeVovoDB');
		$this->email_pagseguro = 'fssromulo@gmail.com';
		$this->token_pagamento = '3482CDBFBE824205BD6843E721C46248';
	}

	public function index()
	{
		// $this->load->view('ajudeVovo');
	}

	// Metodo que inicia a transação com o pagSeguro
	public function getSessaoPagSeguro()
	{

		$url_sanbox = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email='
			. $this->email_pagseguro
			. '&token='
			. $this->token_pagamento;

		$curl = curl_init($url_sanbox);

		// vamos ignorar o certificado de sergurança utilizando o parâmetro abaixo. -- fazemos isso pq estamos em abiente de testes(sandbox)
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		// Informa que esta requisição terá quer ter um retorno
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Vamos avisar ao cURL que esses dados será enviado via POST
		curl_setopt($curl, CURLOPT_POST, true);

		//O PagSeguro só irá aceitar a versão 1.1 do HTTP, logo devemos especificar isso tambem.
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

		$xml_resposta = curl_exec($curl);

		curl_close($curl);

		$xml_resposta = simplexml_load_string($xml_resposta);

		echo($xml_resposta->id);
	}

	// Metodo que envia os dados da compra do servico para o PAGSEGUROO
	public function realizaPagamentoPagSeguro() {
		(array)$arrDadosPagSeguro = json_decode(file_get_contents("php://input"), true);   


		// $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/';
		$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';		

		$identificador_teste = date('d/m/Y H:i:s');

		$data['email'] = $this->email_pagseguro;
		$data['token'] = $this->token_pagamento;
		$data['currency'] = 'BRL';
		$data['itemId1'] = '1';



		$data['paymentMethod'] = 'creditCard';
		$data['creditCardToken'] = $arrDadosPagSeguro['tokenDoCartao'];
		
		$data['creditCardHolderName'] = 'Romulo fernando teste pagVOVO';
		$data['creditCardHolderCPF'] = '08550724904';
		$data['credicreditCardHolderBirthDatetCardToken'] = '05/12/1997';

		$data['creditCardHolderAreaCode'] = '47';
		$data['creditCardHolderPhone'] = '991725457';

		$data['itemDescription1'] = 'SERVICO DE TESTE AJUDE O VOVO';
		$data['itemAmount1'] = 100.55;
		$data['itemQuantity1'] = 1;
		$data['itemWeight1'] = 0;
		$data['reference'] = 666;
		$data['senderName'] = 'ROMULO Comprador de testes';
		$data['senderAreaCode'] = '47';
		$data['senderPhone'] = '991725457';
		$data['senderEmail'] = 'c50891760423331506798@sandbox.pagseguro.com.br';
		$data['shippingType'] = '1';
		$data['shippingAddressStreet'] = 'Av. Brig. Faria Lima';
		$data['shippingAddressNumber'] = '33';
		$data['shippingAddressComplement'] = 'Casa';
		$data['shippingAddressDistrict'] = 'Fidelis';
		$data['shippingAddressPostalCode'] = '89060112';
		$data['shippingAddressCity'] = 'Santa Caterina';
		$data['shippingAddressState'] = 'SC';
		$data['shippingAddressCountry'] = 'BRA';

		$data['senderCPF'] = '08550724904';
				
		$data['installmentQuantity'] = 1;
		$data['installmentValue'] = 100.55;


		$data['billingAddressStreet']= 'Av. PagSeguro';
		$data['billingAddressNumber']= '9999';
		$data['billingAddressComplement']= '99o andar';
		$data['billingAddressDistrict']= 'Jardim Internet';
		$data['billingAddressPostalCode']= '99999999';
		$data['billingAddressCity']= 'Cidade Exemplo';
		$data['billingAddressState']= 'SP';
		$data['billingAddressCountry']= 'ATA';

		$data = http_build_query($data);


		$curl = curl_init($url);

		
		// $headers = array();
		// $headers[] = 'Accept: application/xml';	
		// $headers[] = 'Content-Type: application/xml; charset=ISO-8859-1';
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		$xml_resposta = curl_exec($curl);

		print_r($xml_resposta);die;
		if ( $xml_resposta == 'Unauthorized' ) {
			//VALIDAr se a requisicao nao for aceita

			print_r(json_encode($xml_resposta));
			print_r('erro --- Unauthorized ---');

			// header('Location: erro.php?tipo=autenticacao');
			exit;//Mantenha essa linha
		}

		curl_close($curl);

		$xml_resposta = simplexml_load_string($xml_resposta);

		echo('xml_resposta');
		echo($xml_resposta);

	}
}