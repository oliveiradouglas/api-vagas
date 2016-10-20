<?php

use App\Busca;

class BuscaTest extends PHPUnit_Framework_TestCase {
	private $busca;

	protected function setUp() {
		$this->busca = new Busca(App\CarregadorConteudoArquivo::carregarJson('./vagas.json')['docs']);

		parent::setUp();
	}

	public function testBuscaSemFiltroDeveRetornarTodosOsRegistros() {
		$resultadoBusca = $this->busca->filtrar();
		$this->assertEquals(1200, count($resultadoBusca));
	}

	public function testBuscaPorUmaPropriedade() {
		$resultadoBuscaPorTitle = $this->busca->filtrar(['title' => 'Recepcionista']);
		$this->assertEquals(23, count($resultadoBuscaPorTitle));
		
		$resultadoBuscaPorDescription = $this->busca->filtrar(['description' => '1º ano, 2º ano']);
		$this->assertEquals(6, count($resultadoBuscaPorDescription));
		
		$resultadoBuscaPorCidade = $this->busca->filtrar(['cidade' => 'Joinville']);
		$this->assertEquals(92, count($resultadoBuscaPorCidade));
	}

	public function testBuscaPorIndiceInvalidoDeveLancarOutOfBoundsException() {
		$this->setExpectedException('OutOfBoundsException');
		$this->busca->filtrar(['coluna_invalida' => 'Teste']);
	}

	public function testBuscaPorVariasPropriedades() {
		$resultadoBusca = $this->busca->filtrar([
			'title'       => 'Vendedor', 
			'description' => 'atendimento ao cliente',
			'cidade'      => 'Porto Alegre'
		]);

		$this->assertEquals(3, count($resultadoBusca));
	}
}