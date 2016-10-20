<?php

/**
 * Controller responsável por tratar as requisições da API da vagas
 * @author Douglas Oliveira <d.oliveira12@hotmail.com>
 */

use App\Busca;

class VagaController extends CI_Controller {
	/**
	 * Exibe a página principal para consumir a API
	 */
	public function index() {
		$this->load->view('vaga/index');
	}

	/**
	 * Manipula a requisição feita para carregar as vagas da API
	 * @uses App\Busca para aplicar os filtros feito na requisição nas vagas
	 * @uses App\Ordenacao para ordenar os elementos filtrados, obedecendo as regras de ordenação 
	 * fornecidas na requisição
	 * @return json com as vagas filtradas na busca
	 */
	public function buscarVagas() {
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

			$busca = new Busca(App\CarregadorConteudoArquivo::carregarJson('./vagas.json')['docs']);
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

	/**
	 * Prepara o retorno de erro da API
	 * @param int $httpStatus Status de retorno que será setado no header de resposta
	 * @param string $erro Uma descrição do erro
	 * @return json com o erro informado
	 */
	private function prepararRetornoErroApi($httpStatus, $erro) {
		$this->output->set_status_header($httpStatus);
		$this->output->set_output(json_encode([
	    	'status' => false, 
	    	'erro'   => $erro
	    ]));
	}
}