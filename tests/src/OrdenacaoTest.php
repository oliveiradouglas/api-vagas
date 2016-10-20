<?php

use App\Ordenacao;

class OrdenacaoTest extends PHPUnit_Framework_TestCase {
	private $ordenacao;

	protected function setUp() {
		$busca = new App\Busca(App\CarregadorConteudoArquivo::carregarJson('./vagas.json')['docs']);

		$this->ordenacao = new Ordenacao(
			$busca->filtrar(['title' => 'Técnico em Enfermagem']),
			'salario'
		);

		parent::setUp();
	}

	public function testOrdenacaoAsc() {
		$arrayOrdenado = $this->ordenacao->ordenar(Ordenacao::ASC);
		$this->assertEquals(1234.45, $arrayOrdenado[0]['salario']);
	}

	public function testOrdenacaoDesc() {
		$arrayOrdenado = $this->ordenacao->ordenar(Ordenacao::DESC);
		$this->assertEquals(1600, $arrayOrdenado[0]['salario']);
	}

	public function testOrdenacaoComDirecaoInvalidaDeveRetornarInvalidArgumentException() {
		$this->setExpectedException('InvalidArgumentException');
		$this->ordenacao->ordenar('direcao_errada');
	}

	public function testOrdenacaoComColunaInvalidaDeveRetornarOutOfBoundsException() {
		$this->setExpectedException('OutOfBoundsException');
		$this->ordenacao->setColunaBase('coluna_errada');
		$this->ordenacao->ordenar('asc');
	}
}