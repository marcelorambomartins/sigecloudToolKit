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
    <script type="text/javascript" src="ferramentas.js"></script>
  </head>
  <body class="container">
    <div class="jumbotron">
      <h2 class="display-4">Ferramentas</h2>
    </div>
    <div class="row"> <!--Row dos inputDoc-->
      <p>Aqui vai os inputDoc</p>
    </div><!--Fim da Col-->
    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular XML</h3>
		        </div>
		        <div class="panel-body">
              <p>
                <button onclick="ferramenta('qtTotalProduto')" type="button" class="btn btn-primary">Exibir Quantidade Total de Produtos no XML</button>
              </p>
            </div>
        </div>
      </div><!--Fim da Col-->
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular XLS</h3>
		        </div>
		        <div class="panel-body">
              <p>
                <button onclick="ferramenta('insertCodigoProduto')" type="button" class="btn btn-primary">Inserir Codigo na Descrição do Produto</button>
              </p>
            </div>
        </div>
      </div><!--Fim da Col-->
      <div class="col-sm-4">
        <div class="panel panel-default text-center">
		        <div class="panel-heading">
		          <h3>Manipular XML e XLS</h3>
		        </div>
		        <div class="panel-body">
              <p>
                <button onclick="ferramenta('insertNumeroNF')" type="button" class="btn btn-primary">Adicionar Numero da NF</button>
              </p>
              <p>
              <button onclick="ferramenta('insertQuantProduto')" type="button" class="btn btn-primary">Adicionar Quantidade de Produtos</button>
              </p>
              <p>
                <button onclick="ferramenta('insertInfoProduto')" type="button" class="btn btn-primary">Inserir a Informação Adicional do Produto</button>
              </p>
            </div>
        </div>
      </div><!--Fim da Col-->
    </div><!--Fim da Row-->
  </body>
</html>
