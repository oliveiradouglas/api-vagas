function ListagemVagas() {
	this.montarListagem = function(vagas) {
		var listagemVagas = '';

		$.each(vagas, function(i, vaga) {
			var boxVaga = carregarModeloBoxVaga();
			boxVaga = boxVaga
						.replace('$title', vaga.title)
						.replace('$description', vaga.description)
						.replace('$cidade', vaga.cidade.join(', '))
						.replace('$salario', number_format(vaga.salario, 2, ',', '.'));

			listagemVagas += boxVaga;
		});

		$('#lista-vagas').html(listagemVagas);
	}

	var carregarModeloBoxVaga = function() {
		return $('#modelo-box-vaga').html();
	}
}