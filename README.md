# Instalação

- Necessário php >= 5.6
- Baixar o projeto e colocar no seu servidor local

# API

Para facilitar o uso, foi implementada uma tela simples para simular o cliente da API, basta acessar a home do projeto ex: http://catho.local

Para fazer uma requisição na api de vagas basta chamar por exemplo: http://catho.local/api/v1/vagas

Os atributos disponíveis para filtro são:
- title // faz a busca pelo title da vaga
- description // faz a busca pela description da vaga
- cidade // faz a busca pela cidade da vaga

Para ordenação os seguintes parâmetros são aceitos:
- coluna_ordenacao // informar a coluna que será utilizada na ordenação da busca, as opções disponíveis são: title, description e salario (default)
- direcao_ordenacao // informar qual a direção que os registros devem ser ordenados, as opções disponíveis são: asc ou desc

Exemplos: 

// Busca todas as vagas que possuem 'php' no title
http://catho.local/api/v1/vagas?title=php

// Busca todas as vagas que possuem 'superior completo' na description
http://catho.local/api/v1/vagas?description=superior completo

// Busca todas as vagas da cidade de 'joinville'
http://catho.local/api/v1/vagas?cidade=joinville

//Busca todas as vagas que possuem 'enfermagem' no title e 'técnico' na description
http://catho.local/api/v1/vagas?title=enfermagem&description=técnico

//Busca todas as vagas que possuem 'recepcionista' no title e ordena por salário em ordem 'desc'
http://catho.local/api/v1/vagas?title=recepcionista&direcao_ordenacao=desc

//Busca todas as vagas que possuem 'analista' no title e ordena por title em ordem 'asc'
http://catho.local/api/v1/vagas?title=analista&direcao_ordenacao=asc&coluna_ordenacao=title

# Testes

Os testes foram implementados com o framework PHPUnit, para executa-los basta rodar o comando através do terminal no diretório do projeto:

vendor/bin/phpunit

# Estrutura

- application/src: Ficam as classes principais para a manipulação dos dados da API
- application/controllers: Fica o controller para manipulação das requisições para API
- tests/src: Ficam os testes

# Decisões de implementação

- Deixei as classes o mais genéricas possível porque da maneira que as aplicações crescem, não poderia restringir a utilização delas apenas para a API de vagas, dessa forma facilita a manutenção e caso surja algum outro recurso para ser incluído na API será fácil implementar.

- Utilização do framework CodeIgniter: Por ser leve e facilitar o trabalho com rotas principalmente nesse estágio. Decidi utiliza-lo, por mais que a aplicação seja "simples" penso que caso ela venha a crescer com o tempo, por exemplo se existir uma segunda etapa deste teste, um framework ajudaria muito na organização e na velocidade de desenvolvimento da aplicação.

- Utilização do PHPUnit: Para realizar os testes, por ser o principal framework de testes para PHP, foi a solução que achei mais adequada.

- Comentários no código: Acredito que alguns deles ficaram redundantes porque tento sempre ja deixar claro qual o papel da função na sua assinatura, não havendo a necessidade de comentários, mas coloquei mesmo assim porque foi pedido na descrição do teste.

- Uma tela para consumir a API: Para facilitar os testes desenvolvi uma tela que facilita a chamada dos métodos da API.