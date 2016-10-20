function Alerta() {
    this.exibir = function(mensagem, tipo, opcoesExtra) {
    	var opcoesSwal = $.extend({
        	title: mensagem,
            type: tipo,
            html: true
        }, (opcoesExtra || {}));

        swal(opcoesSwal);
    }
}