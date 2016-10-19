<?php

namespace App;

class Ordenacao {
	const ASC  = 'asc';
	const DESC = 'desc';

	private $arrayParaOrdenar;
	private $colunaBase;

	public function __construct(array $arrayParaOrdenar, $colunaBase) {
		$this->arrayParaOrdenar = $arrayParaOrdenar;
		$this->colunaBase       = $colunaBase;
	}

	public function setArrayParaOrdenar(array $arrayParaOrdenar) {
        $this->arrayParaOrdenar = $arrayParaOrdenar;
    }

	public function setColunaBase($colunaBase) {
        $this->colunaBase = $colunaBase;
    }

	public function getColunaBase() {
        return $this->colunaBase;
    }

	public function ordenar($direcaoOrdenacao) {
		$this->validarDirecaoOrdenacao($direcaoOrdenacao);
		
		$tamanhoArrayOrdenar = count($this->arrayParaOrdenar);
		if ($tamanhoArrayOrdenar) {
			$this->validarColunaParaCompararNaOrdenacao(0);
		}

		$arrayRetornarOrdenado = $this->arrayParaOrdenar;
        for ($i = 1; $i < $tamanhoArrayOrdenar; $i++) {
        	$this->validarColunaParaCompararNaOrdenacao($i);

            $registroAtual = $arrayRetornarOrdenado[$i];
            $j = $i;
            
            while($this->atendeCondicaoParaTrocaDePosicao($arrayRetornarOrdenado, $j, $registroAtual, $direcaoOrdenacao)) {
                $arrayRetornarOrdenado[$j] = $arrayRetornarOrdenado[$j-1];
                $j--;
            }
            
            $arrayRetornarOrdenado[$j] = $registroAtual;
        }

        return $arrayRetornarOrdenado;
	}

	private function validarDirecaoOrdenacao($direcaoOrdenacao) {
		if ($direcaoOrdenacao != self::ASC && $direcaoOrdenacao != self::DESC) {
			throw new \InvalidArgumentException('A direção da ordenação não existe!');
		}

		return true;
	}

	private function validarColunaParaCompararNaOrdenacao($indice) {
		if (!isset($this->arrayParaOrdenar[$indice][$this->colunaBase]) 
			|| is_array($this->arrayParaOrdenar[$indice][$this->colunaBase])
		) {
			throw new \OutOfBoundsException('A coluna: ' . $this->colunaBase . ' não pode ser usada para ordenação!');
		}

		return true;
	}

	private function atendeCondicaoParaTrocaDePosicao(
		array $arrayRetornarOrdenado, 
		$j, 
		array $registroAtual,
		$direcaoOrdenacao
	) {
		if ($direcaoOrdenacao == self::ASC) {
			return ($j > 0 && $arrayRetornarOrdenado[$j-1][$this->colunaBase] > $registroAtual[$this->colunaBase]);
		}

		return ($j > 0 && $arrayRetornarOrdenado[$j-1][$this->colunaBase] < $registroAtual[$this->colunaBase]);
	}
}