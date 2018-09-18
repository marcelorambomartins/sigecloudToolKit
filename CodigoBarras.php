<?php
#AUTOR: http://marcelorambo.com/

// Incluimos a classe PHPExcel
include 'phpexcel/Classes/PHPExcel.php';

	class CodigoBarras{

		static function obterCodeBar($planilhaCodeBar, $codigo){

			CodigoBarras::inicializar($planilhaCodeBar);
			//$valor = CodigoBarras::obterDado(0, 2);
			//return $valor;

		}//fim da funcao


		static function inicializar($planilhaCodeBar){

	 		$objReader = new PHPExcel_Reader_Excel5();
	 		$objPHPExcel = $objReader->load($planilhaCodeBar);
	 		$objPHPExcel->setActiveSheetIndex(0);

	 		define('LAST_LINE', CodigoBarras::lastLine(2, $objPHPExcel));
	 		define('START_LINE', 2);

			echo LAST_LINE;


	 	}// fim da funcao

		static function obterDado($coluna, $linha, $objPHPExcel){

			return '1';
			//global $objPHPExcel;

			//return $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue(); //obtem
		}


		static function inserirDado($coluna, $linha, $conteudo, $objPHPExcel){
			global $objPHPExcel;

			return $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $conteudo); // insere
		}


		static function lastLine($linha, $objPHPExcel){

			$coluna = 0; // coluna dos code de barras

			$celulaAtual = CodigoBarras::obterDado($coluna, $linha, $objPHPExcel);

			while(!empty($celulaAtual)){
				$linha++;
				$celulaAtual = CodigoBarras::obterDado($coluna, $linha, $objPHPExcel);
			}

			return $linha - 1;
		}

	}// fim da classe




?>
