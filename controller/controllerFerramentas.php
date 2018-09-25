<?php
  include '../xls/ManipulaXLS.php';
  include '../inputFile.php';

  $post = json_decode(file_get_contents("php://input"));
    print_r($post);


      if(function_exists($post->action)){

    		if($post->action == "insertCodigoProduto"){
    			call_user_func($post->action);
    		}else if($post->action == "escalonador"){
    			call_user_func($post->action,$post->status);
    		}else{
    			call_user_func($post->action);
    		}

  	}else{
  		echo "<br>funcao nao definida";
  	}

    function insertCodigoProduto(){
      global $xml;
      global $planilha;

      ManipulaXLS::insertCodigoInNome($planilha,$xml);
      echo "ok";
    }



?>
