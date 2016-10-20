var alerta = new Alerta();

$('#bt-pesquisar').click(function() {
	enviarRequisicaoBuscarVagas();
});

$('.ordenacao').change(function() {
	enviarRequisicaoBuscarVagas();
});

$('#container-pesquisa').on('keypress', function (e) {
    if (e.keyCode == 13) {
        enviarRequisicaoBuscarVagas();
    }
});

function enviarRequisicaoBuscarVagas() {
	var requisicao = new Requisicao(
		montarUrlBuscarVagas(), 
		'GET', 
		{}, 
		function(retorno){
			swal.close();
			if (retorno.vagas.length == 0) {
				$('#lista-vagas').html('Nenhuma vaga encontrada!');
				return;
			}

			var listagemVagas = new ListagemVagas();
			listagemVagas.montarListagem(retorno.vagas);
		}, 
		function(erro){
			alerta.exibir('Erro ao buscar as vagas!', 'error');
		}
	);

	$('#lista-vagas').empty();
	alerta.exibir('Carregando...', 'info', {showConfirmButton: false});
	$('#container-listagem-vagas').fadeIn();
	
	requisicao.enviar();
}

function montarUrlBuscarVagas() {
	var filtros = new Array();
	$('#container-pesquisa input, .ordenacao').each(function() {
		if ($(this).val() != '') {
			filtros.push($(this).attr('name') + '=' + $(this).val());
		}
	});

	return '/api/v1/vagas?' + filtros.join('&');
}