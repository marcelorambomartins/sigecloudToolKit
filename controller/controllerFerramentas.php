<?php
  include '../xls/ManipulaXLS.php';
  include '../inputFile.php';

  $post = json_decode(file_get_contents("php://input"));
    print_r($post);


      if(function_exists($post->action)){

    		if($post->action == "insertCodigoProduto"){
    			call_user_func($post->action, $planilha, $xml);
    		}else if($post->action == "insertNumeroNF"){
    			call_user_func($post->action, $planilha, $xml);
        }else if($post->action == "insertQuantProduto"){
          call_user_func($post->action, $planilha, $xml);
    		}else{
    			call_user_func($post->action);
    		}

  	}else{
  		echo "<br>funcao nao definida";
  	}

    function insertCodigoProduto($planilha,$xml){
      echo ManipulaXLS::insertCodigoInNome($planilha,$xml);
    }

    function insertNumeroNF($planilha,$xml){
      echo ManipulaXLS::insertNumeroNF($planilha,$xml);
    }

    function insertQuantProduto($planilha,$xml){
      echo ManipulaXLS::insertQuantInNome($planilha,$xml);
    }





?>
