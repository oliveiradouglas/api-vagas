function Requisicao(_url, _metodo, _dados, _callbackSucesso, _callbackErro) {
	var url 			= _url;
	var metodo 			= _metodo;
	var dados 			= _dados;
	var callbackSucesso = _callbackSucesso;
	var callbackErro    = _callbackErro;

	this.enviar = function() {
		$.ajax({
			url: url,
			type: metodo,
			data: dados,
			dataType: 'json',
			success: function(retorno) {
				callbackSucesso(retorno);
			},
			error: function(erro) {
				callbackErro(erro);
			}
		});
	}
}