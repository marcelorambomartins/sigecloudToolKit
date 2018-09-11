<?php
#AUTOR: http://marcelorambo.com/

// Incluimos a classe PHPExcel
include 'phpexcel/Classes/PHPExcel.php';

	class CodigoBarras{

		static function obterCodeBar($planilhaCodeBar, $codigo){

			return inicializar($planilhaCodeBar);
			//$valor = obterDado(0, 2);
			//return $valor;

		}//fim da funcao


		function inicializar($planilhaCodeBar){

			return "inicializar";

			/*
	 		$objReader = new PHPExcel_Reader_Excel5();
	 		$objPHPExcel = $objReader->load($planilhaCodeBar);
	 		$objPHPExcel->setActiveSheetIndex(0);


	 		$coluna = 0; // coluna começa em zero
	 		$linha = 2;	// linha começa em um


	 		define('LAST_LINE', lastLine($linha));
	 		define('START_LINE', 2);
			*/

	 	}// fim da funcao

		function obterDado($coluna, $linha){
			global $objPHPExcel;

			return $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue(); //obtem
		}


		function inserirDado($coluna, $linha, $conteudo){
			global $objPHPExcel;

			return $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $conteudo); // insere
		}


		function lastLine($linha){

			$coluna = 0; // coluna dos code de barras

			$celulaAtual = obterDado($coluna, $linha);

			while(!empty($celulaAtual)){
				$linha++;
				$celulaAtual = obterDado($coluna, $linha);
			}

			return $linha - 1;
		}

	}// fim da classe









##############################################################################


function insertCodigoNome(){
	$colunaCodigo = 3;			//coluna do codigo do produto
	$colunaNome = 5;            //coluna nome do produto
	$linha = START_LINE;

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaCodigo = obterDado($colunaCodigo, $linha);
		$celulaNome = obterDado($colunaNome, $linha);
		$celulaLucroDinheiro = obterDado(Coluna::LUCRO_DINHEIRO, $linha);

		if($celulaLucroDinheiro == 0){

			$frase = $celulaCodigo . " - " . $celulaNome;

			inserirDado($colunaNome, $linha, $frase);
		}

	}

	echo "codigo no produto: OK<br>";
}



?>
