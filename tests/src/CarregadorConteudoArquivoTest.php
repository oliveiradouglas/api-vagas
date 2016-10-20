<?php

use App\CarregadorConteudoArquivo;

class CarregadorConteudoArquivoTest extends PHPUnit_Framework_TestCase {
	public function testCarregarJsonDeveRetornarStdClass() {
		$conteudoArquivo = CarregadorConteudoArquivo::carregarJson('./vagas.json', false);
		$this->assertInstanceOf('stdClass', $conteudoArquivo);
	}

	public function testCarregarJsonDeveRetornarArray() {
		$conteudoArquivo = CarregadorConteudoArquivo::carregarJson('./vagas.json');
		$this->assertInternalType('array', $conteudoArquivo);
	}

	public function testCarregarJsonComArquivoInexistenteDeveLancarException() {
		$this->setExpectedException('Exception');
		CarregadorConteudoArquivo::carregarJson('nao_existe.json');
	}
}