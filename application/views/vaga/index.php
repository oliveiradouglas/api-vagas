<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Catho - backend test</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/sweetalert.css">
	</head>
	<body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="/">
                        Catho - backend test
                    </a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
		        <div class="col-md-offset-3 col-md-6">
		            <div class="panel panel-default">
		                <div class="panel-heading">Pesquisar vagas</div>
		                <div class="panel-body" id="container-pesquisa">                 
	                        <div class="form-group col-md-12">
	                            <label class="col-md-5">Titulo </label>
	                            <div class="col-md-7">
	                                <input class="form-control" type="text" name="title" id="title" tabindex="1" maxlength="100" />
	                            </div>
	                        </div>

	                        <div class="form-group col-md-12">
	                            <label class="col-md-5">Descrição </label>
	                            <div class="col-md-7">
	                                <input class="form-control" type="text" name="description" id="description" tabindex="2" maxlength="100" />
	                            </div>
	                        </div>

							<div class="form-group col-md-12">
	                            <label class="col-md-5">Cidade </label>
	                            <div class="col-md-7">
	                                <input class="form-control" type="text" name="cidade" id="cidade" tabindex="3" maxlength="100" />
	                            </div>
	                        </div>

		                    <div class="form-group col-md-12">
		                        <button type="button" class="btn btn-primary pull-right" tabindex="4" id="bt-pesquisar">
		                        	<span class="glyphicon glyphicon-search"></span>
		                            Pesquisar
		                        </button>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="row">
			    <div class="panel panel-default" style="display: none;" id="container-listagem-vagas">
			    	<div class="panel-heading">
			    		<div class="form-inline">
							<div class="form-group">
								<label for="coluna_ordenacao">Ordenar por:</label>
								<select class="form-control ordenacao" id="coluna_ordenacao" name="coluna_ordenacao">
									<option value="salario" selected>Salário</option>
									<option value="title">Titulo</option>
								</select>
							</div>

					    	<div class="form-group">
								<label for="direcao_ordenacao">Ordem:</label>
								<select class="form-control ordenacao" id="direcao_ordenacao" name="direcao_ordenacao">
									<option value="asc" selected>Crescente</option>
									<option value="desc">Decrescente</option>
								</select>
							</div>
			    		</div>
			    	</div>

			    	<div class="panel-body">
			    	  	<div class="list-group" id="lista-vagas"></div>
			  		</div>
			    </div>
		    </div>
        </div>

        <!-- Box modelo para listagem das vagas -->
    	<div id="modelo-box-vaga" style="display: none;">
	    	<a href="javascript:;" class="list-group-item" style="list-style-type: none;">
		      	<h3 class="list-group-item-heading">$title</h3>
		      	<p class="list-group-item-text">$description</p>
		      	<p class="list-group-item-text">$cidade</p>
		      	<p class="list-group-item-text">R$ $salario</p>
	    	</a>
    	</div>

        <!-- Plugins -->
		<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="/assets/js/number_format.js"></script>
		
		<!-- Aplicação -->
		<script type="text/javascript" src="/assets/js/Alerta.js"></script>
		<script type="text/javascript" src="/assets/js/Requisicao.js"></script>
		<script type="text/javascript" src="/assets/js/ListagemVagas.js"></script>
		<script type="text/javascript" src="/assets/js/scripts.js"></script>
	</body>
</html>