<?php

/**
 * Classe para carregar conteudo de arquivos
 * @author Douglas Oliveira <d.oliveira12@hotmail.com>
 */

namespace App;

class CarregadorConteudoArquivo {
	/**
	 * Carregar conteudo de um aquivo json
	 * @param string $aquivo Caminho do arquivo a ser carregado
	 * @param bool $transformarArray Indica se o conteudo do arquivo json deve ser passado para array ou não
	 * @throws Exception Se o arquivo não for encontrado
	 * @return mixed stdClass | Array
	 */
	public static function carregarJson($arquivo, $transformarArray = true) {
		if (!file_exists($arquivo)) {
			throw new \Exception('Arquivo não encontrado!');
		}

		$conteudoArquivo = file_get_contents($arquivo);
		return json_decode($conteudoArquivo, $transformarArray);
	}
}