<?php
  include '..xls/ManipulaXLS.php';
  include 'inputFile.php';

  $post = json_decode(file_get_contents("php://input"));
    echo "aqui";

    /*
  	$action = $post->action;

      if(function_exists($action)){

    		if($action == "insertCodigoProduto"){
    			call_user_func($action);
    		}else if($action == "escalonador"){
    			call_user_func($action,$post->status);
    		}else{
    			call_user_func($action);
    		}

  	}else{
  		echo "<br>funcao nao definida";
  	}

    function insertCodigoProduto(){
      ManipulaXLS::insertCodigoInNome($planilha,$xml);
    }

    */

?>
