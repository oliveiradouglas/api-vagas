<?php

/**
 * Classe para fazer ordenação de elementos em um array
 * @author Douglas Oliveira <d.oliveira12@hotmail.com>
 */

namespace App;

class Ordenacao {
	/**
	 * Direções possíveis para ordenação
	 */
	const ASC  = 'asc';
	const DESC = 'desc';

	private $arrayParaOrdenar;
	private $colunaBase;

	/**
	 * @param array $arrayParaOrdenar Array que será ordenado
	 * @param string $colunaBase Coluna que será utilizada para ordenação
	 */
	public function __construct(array $arrayParaOrdenar, $colunaBase) {
		$this->arrayParaOrdenar = $arrayParaOrdenar;
		$this->colunaBase       = $colunaBase;
	}

	/**
	 * Atribui um array para servir como base da ordenação
	 * @param array $arrayParaOrdenar
	 */
	public function setArrayParaOrdenar(array $arrayParaOrdenar) {
        $this->arrayParaOrdenar = $arrayParaOrdenar;
    }

    /**
     * Atribui a coluna que será utilizada para ordenação
     * @param string $colunaBase
     */
	public function setColunaBase($colunaBase) {
        $this->colunaBase = $colunaBase;
    }

    /**
     * Ordena os elementos do array utilizando o algoritmo insertion sort
     * @param string $direcaoOrdenacao Qual sentido o array deve ser ordenado
     * @return array Array ordenado
     */
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

	/**
	 * Verifica se a direção da ordenação é valida
	 * @param string $direcaoOrdenacao
	 * @throws InvalidArgumentException Caso a direção da ordenação seja inválida
	 * @return bool
	 */
	private function validarDirecaoOrdenacao($direcaoOrdenacao) {
		if ($direcaoOrdenacao != self::ASC && $direcaoOrdenacao != self::DESC) {
			throw new \InvalidArgumentException('A direção da ordenação não existe!');
		}

		return true;
	}

	/**
	 * Verifica se a coluna utilizada na ordenação existe no registro atual
	 * @param int $indice Indice do registro atual no array para ordenar
	 * @throws OutOfBoundsException caso a coluna base de ordenação não exista no registro
	 * @return bool
	 */
	private function validarColunaParaCompararNaOrdenacao($indice) {
		if (!isset($this->arrayParaOrdenar[$indice][$this->colunaBase]) 
			|| is_array($this->arrayParaOrdenar[$indice][$this->colunaBase])
		) {
			throw new \OutOfBoundsException('A coluna: ' . $this->colunaBase . ' não pode ser usada para ordenação!');
		}

		return true;
	}

	/**
	 * Verifica se o registro deve mudar de posição no array para ficar ordenado
	 * @param array $arrayRetornarOrdenado Array que armazena os elementos ordenados
	 * @param int $j Sub-indice utilizado na ordenação do elemento
	 * @param array $registroAtual Elemento atual que esta sendo ordenado
	 * @param string $direcaoOrdenacao Qual a direção que os elementos devem ser ordenados (asc, desc)
	 * @return bool
	 */
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