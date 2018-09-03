<?php
#AUTOR: http://marcelorambo.com/


set_time_limit(0); //seta o limite de tempo
ini_set('memory_limit', '-1'); //seta o limite de memoria

// activar Error reporting
error_reporting(E_ALL);

// Incluimos a classe PHPExcel
include 'phpexcel/Classes/PHPExcel.php';
include 'EnumColunas.php';

$planilha = "planilhas/planilhaprodutos_03-09-2018_09-31.xls";


$objReader = new PHPExcel_Reader_Excel5();
$objPHPExcel = $objReader->load($planilha);
$objPHPExcel->setActiveSheetIndex(0);


$coluna = 0; // coluna começa em zero
$linha = 2;	// linha começa em um


define('LAST_LINE', lastLine($linha));
define('START_LINE', 2);

//chamada de funcoes
ajustarPrecoCusto(3);



//salva a planilha
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($planilha);


echo "<br>Planilha Concluida com sucesso!";


///////////////////////////FUNCOES//////////////////////////////////////
function obterDado($coluna, $linha){
	global $objPHPExcel;

	return $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue(); //obtem
}


function inserirDado($coluna, $linha, $conteudo){
	global $objPHPExcel;

	return $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $conteudo); // insere
}


function lastLine($linha){

	$coluna = 15; // coluna das ID

	$celulaAtual = obterDado($coluna, $linha);

	while(!empty($celulaAtual)){
		$linha++;
		$celulaAtual = obterDado($coluna, $linha);
	}

	return $linha - 1;
}

##############################################################################


function ajustarPrecoCusto($numeroDivisoes){
	$linha = START_LINE;

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaLucroDinheiro = obterDado(Coluna::LUCRO_DINHEIRO, $linha);
		$celulaPrecoCusto = obterDado(Coluna::PRECO_CUSTO, $linha);

		if($celulaLucroDinheiro == 0){

			$resultado = $celulaPrecoCusto / $numeroDivisoes ;

			inserirDado(Coluna::PRECO_CUSTO, $linha, $resultado);
		}

	}

	echo "codigo no produto: OK<br>";
}



?>
