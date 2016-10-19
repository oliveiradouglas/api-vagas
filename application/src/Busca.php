<?php

namespace App;

class Busca {
	private $registros;

	public function __construct(array $registros) {
		$this->registros = $registros;
	}

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

	private function contemValor($valorColuna, $valorPesquisado) {
		return (stripos($valorColuna, $valorPesquisado) !== false);
	}
}