<?php

use App\Busca;

class VagaController extends CI_Controller {
	public function buscarVagas() {
		$vagasJson          = file_get_contents('./vagas.json');
		$registrosParaBusca = json_decode($vagasJson, true)['docs'];

		$parametrosGet = $_GET;
		$this->output->set_content_type('application/json');
		try {
			$colunaBaseOrdenacao = 'salario';
			if (isset($parametrosGet['coluna_ordenacao'])) {
				$colunaBaseOrdenacao = $parametrosGet['coluna_ordenacao'];
				unset($parametrosGet['coluna_ordenacao']);
			}

			$direcaoOrdenacao = '';
			if (isset($parametrosGet['direcao_ordenacao'])) {
				$direcaoOrdenacao = strtolower($parametrosGet['direcao_ordenacao']);
				unset($parametrosGet['direcao_ordenacao']);
			}

			$busca = new Busca($registrosParaBusca);
			$resultadoBusca = $busca->filtrar($parametrosGet);
			
			if (!empty($direcaoOrdenacao)) {
				$ordenacao = new App\Ordenacao($resultadoBusca, $colunaBaseOrdenacao);
				$resultadoBusca = $ordenacao->ordenar($direcaoOrdenacao);
			}
			
			$respostaApi = ['status' => true, 'vagas'  => $resultadoBusca];
		    $this->output->set_output(json_encode($respostaApi));
		} catch (OutOfBoundsException $oobe) {
			$this->prepararRetornoErroApi(422, $oobe->getMessage());
		} catch (InvalidArgumentException $iae) {
			$this->prepararRetornoErroApi(422, $iae->getMessage());
		} catch (Exception $e) {
			$this->prepararRetornoErroApi(500, 'Erro interno do servidor!');
		}
	}

	private function prepararRetornoErroApi($httpStatus, $erro) {
		$this->output->set_status_header($httpStatus);
		$this->output->set_output(json_encode([
	    	'status' => false, 
	    	'erro'   => $erro
	    ]));
	}
}