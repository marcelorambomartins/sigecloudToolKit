<?php
  include '../xls/ManipulaXLS.php';
  include_once '../XML.php';


  $post = json_decode(file_get_contents("php://input"));
  //print_r($post);

    $xml = simplexml_load_file($post->xml);

      if(function_exists($post->action)){
    		if($post->action == "insertCodigoProduto"){
    			call_user_func($post->action, $post->planilha, $xml);
    		}else if($post->action == "insertNumeroNF"){
    			call_user_func($post->action, $post->planilha, $xml);
        }else if($post->action == "insertQuantProduto"){
          call_user_func($post->action, $post->planilha, $xml);
        }else if($post->action == "insertInfoProduto"){
          call_user_func($post->action, $post->planilha, $xml);
        }else if($post->action == "qtTotalProdutos"){
          call_user_func($post->action, $xml);
    		}else{
    			call_user_func($post->action);
    		}

  	   }else{
  		     echo "<br>funcao nao definida";
  	   }


###################################################################


    function insertCodigoProduto($planilha,$xml){
      echo ManipulaXLS::insertCodigoInNome($planilha,$xml);
    }

    function insertNumeroNF($planilha,$xml){
      echo ManipulaXLS::insertNumeroNF($planilha,$xml);
    }

    function insertQuantProduto($planilha,$xml){
      echo ManipulaXLS::insertQuantInNome($planilha,$xml);
    }

    function insertInfoProduto($planilha,$xml){
      echo ManipulaXLS::insertInfoInNome($planilha,$xml);
    }

    function qtTotalProdutos($xml){
      $qtTotal = XML::obterQuantTotalProduto($xml);
      $frase = "Existe um total de " . $qtTotal . " produtos nesse XML";
      echo $frase;
    }

?>
