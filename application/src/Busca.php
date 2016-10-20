<?php

/**
 * Classe para fazer busca de elementos em um array
 * @author Douglas Oliveira <d.oliveira12@hotmail.com>
 */

namespace App;

class Busca {
	private $registros;

	/**
	 * @param array $registros Array que será utilizado como base para aplicar os filtros de busca
	 * @return void
	 */
	public function __construct(array $registros) {
		$this->registros = $registros;
	}

	/**
	 * Faz a busca dos registros que atedem ao filtro informado
	 * @param array $filtros Regras para selecionar os elementos que serão retornados da busca
	 * @return array
	 */
	public function filtrar(array $filtros = []) {
		if (empty($filtros)) {
			return $this->registros;
		}

		$resultado = [];
		foreach ($this->registros as $registro) {
			if ($this->verificarRegistroAtendeTodosFiltros($filtros, $registro)) {
				$resultado[] = $registro;
			}
		}

		return $resultado;
	}

	/**
	 * Faz um loop em todos os filtros para validar se o registro atende a todos
	 * @param array $filtros Array com os filtros para validação
	 * @param array $registro Registro a ser verificado
	 * @throws OutOfBoundsException caso alguma coluna dos filtros informados não exista no registro 
	 * ou o filtro esta vazio
	 * @return bool Retorna true caso o registro atenda a todos os filtros e false caso não atenda
	 */
	private function verificarRegistroAtendeTodosFiltros(array $filtros, array $registro) {
		foreach ($filtros as $coluna => $valorPesquisado) {
			if (!isset($registro[$coluna]) || empty($valorPesquisado)) {
				throw new \OutOfBoundsException('Erro ao aplicar filtro, campo: ' . $coluna . ' esta fora do padrão!');
			}

			if (!$this->verificarRegistroAtendeAoFiltro($registro[$coluna], $valorPesquisado)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Faz a verificação se o registro atende a um filtro especifico
	 * @param mixed $valorColuna Valor da coluna filtrada no registro
	 * @param mixed $valorPesquisado Valor que esta sendo pesquisado
	 * @return bool
	 */
	private function verificarRegistroAtendeAoFiltro($valorColuna, $valorPesquisado) {
		if (is_array($valorColuna)) {
			foreach ($valorColuna as $valorColunaArray) {
				if ($this->contemValor($valorColunaArray, $valorPesquisado)) {
					return true;
				}
			}

			return false;
		}

		return $this->contemValor($valorColuna, $valorPesquisado);
	}

	/**
	 * Verifica se o valor pesquisado existe na coluna do registro
	 * @param mixed $valorColuna
	 * @param mixed $valorPesquisado
	 * @return bool
	 */
	private function contemValor($valorColuna, $valorPesquisado) {
		return (stripos($valorColuna, $valorPesquisado) !== false);
	}
}