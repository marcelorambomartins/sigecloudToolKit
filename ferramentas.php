<?php

?>

<html>
  <head>
    <title>KIT FERRAMENTAS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script type="text/javascript" src="ferramentas.js"></script>
  </head>
  <body ng-app="myapp" ng-controller="mainController" class="container">
    <div class="jumbotron">
      <h2 class="display-2">Ferramentas</h2>
    </div>
    <div class="row"> <!--Row dos inputDoc-->
      <div class="col-sm-4">
          <label>XML</label>
          <input type="file" name="inputXML" id="inputXML" required="required">
      </div>
      <div class="col-sm-4">
        <label>XLS</label>
          <input type="file" name="inputXLS" id="inputXLS" required="required">
      </div>
      <div class="col-sm-4">
        <!--
        <label>DOC</label>
          <input type="file" name="inputDOC" id="inputDOC" required="required">

        <button type=button ng-click="validaExcel()" class="btn btn-success">Validar Excel</button>
        -->
      </div>
      <hr><hr><hr>
      <div id="result" class="alert alert-success text-center" ng-show="dados.result">
        <p>{{dados.result}}</p>
      </div>
      <div id="erro" class="alert alert-danger text-center" ng-show="dados.erro">
        <p>{{dados.erro}}</p>
      </div>
    </div><!--Fim da Col-->
    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular XML</h3>
		        </div>
		        <div class="panel-body">
              <p>
                <button ng-click="validacao('qtTotalProdutos')" type="button" class="btn btn-primary">Exibir Quantidade Total de Produtos no XML</button>
              </p>
            </div>
        </div>
      </div><!--Fim da Col-->
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular Excel</h3>
		        </div>
		        <div class="panel-body">
              <!--Aqui vai os botoes-->
              <a href="#inputPreencherPlanilha">
              <button ng-click="showme=true" type="button" class="btn btn-primary">Preencher Planilha</button>
              </a>
            </div>
        </div>
      </div><!--Fim da Col-->
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular XML e Excel</h3>
		        </div>
		        <div class="panel-body">
              <p>
                <button ng-click="validacao('insertCodigoProduto')" type="button" class="btn btn-primary" title="Adiciona o código do produto na frete da descrição do produto">
                  Inserir Codigo na Descrição do Produto
                </button>
              </p>
              <p>
                <button ng-click="validacao('insertNumeroNF')" type="button" class="btn btn-primary" title="Adiciona o número da Nota Fiscal no final da descrição do produto">
                  Adicionar Numero da NF
                </button>
              </p>
              <p>
              <button ng-click="validacao('insertQuantProduto')" type="button" class="btn btn-primary" title="Adiciona o Número de produtos no final da descrição do produto">
                Adicionar Quantidade de Produtos
              </button>
              </p>
              <p>
                <button ng-click="validacao('insertInfoProduto')" type="button" class="btn btn-primary" title="Adiciona Informação Adicional do Produtono no final da descrição do produto">
                  Inserir a Informação Adicional do Produto
                </button>
              </p>
            </div>
        </div>
      </div><!--Fim da Col-->
    </div><!--Fim da Row-->
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <div id="inputPreencherPlanilha" ng-show="showme"><!--Row dos inputPreencherPlanilha-->
          <div class="panel panel-default">
            <div class="panel-body">
              <p id="inputCategria">
                <label>Categoria</label>
                <input type="text" class="form-control" placeholder="insira uma Categoria existente no sistema"></input>
              </p>
              <p id="inputMarca">
                <label>Marca</label>
                <input type="text" class="form-control" placeholder="insira uma Marca existente no sistema"></input>
              </p>
              <p id="inputGruproTributario">
                <label>Grupo Tributário</label>
                <input type="text" class="form-control" placeholder="insira um Grupo Tributário existente no sistema"></input>
              </p>
              <p id="inputCFOP">
                <label>CFOP</label>
                <input type="text" class="form-control" placeholder="insira um CFOP existente no sistema"></input>
              </p>
              <p id="inputPercentualLucro">
                <label>Percentual Lucro</label>
                <input type="text" class="form-control" placeholder="insira um Percentual de Lucro"></input>
              </p>
              <p id="inputCoeficiente">
                <label>Coeficiente</label>
                <input type="text" class="form-control" placeholder="insira um coeficiente adicional"></input>
              </p>
              <p class="cnk-arredondar">
                <input type="checkbox" id="cnk-arredondar-090" checked>
                <label>Arredondar com 0,90?</label>
              </p>
              <p>
              <button type="button" onclick="alert('Função Ainda não implementada')" class="btn btn-primary">Preencher Planilha</button>
              </p>
            </div>
          </div>
        </div><!--fim da div input-->
      </div>
      <div class="col-sm-4"></div>
    </div><!--Fim da Row-->

  </body>
</html>
