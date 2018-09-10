<?php
#AUTOR: http://marcelorambo.com/


set_time_limit(0); //seta o limite de tempo
ini_set('memory_limit', '-1'); //seta o limite de memoria

// activar Error reporting
error_reporting(E_ALL);

// Incluimos a classe PHPExcel
include 'phpexcel/Classes/PHPExcel.php';
include 'XML.php';
include 'EnumColunas.php';
include 'inputDoc.php';


$objReader = new PHPExcel_Reader_Excel5();
$objPHPExcel = $objReader->load($planilha);
$objPHPExcel->setActiveSheetIndex(0);


$coluna = 0; // coluna começa em zero
$linha = 2;	// linha começa em um


define('LAST_LINE', lastLine($linha));
define('START_LINE', 2);

//chamada de funcoes
insertNumeroNF($xml);

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


function insertNumeroNF($xml){
		$numeroNFxml = XML::obterNumeroNF($xml);
		$linha = START_LINE;
		$contador = 0;
		$centena = 1;
		$tagNF = "#NF";


		for($linha; $linha <= LAST_LINE; $linha++){
			$celulaCodigo = obterDado(Coluna::CODIGO_NFE, $linha);
			$celulaNome = obterDado(Coluna::NOME, $linha);

			$codigoINxml = XML::verificaCodigoPlanilhaXML($celulaCodigo,$xml);

			if($codigoINxml){

				if($contador == 100){
					$contador = 0;
					$centena++;
				}

				$pos = strpos($celulaNome, $tagNF);

				if($pos != false){ // já existe uma NF vinculada ao produto

					$nfNova = " #NF" . $numeroNFxml . "/" . $centena;
					$frase = str_ireplace($nfVelha,$nfNova,$celulaNome);

				}else{ // não existe uma NF vinculada ao produto
					$frase = $celulaNome . " #NF" . $numeroNFxml . "/" . $centena;
				}

				inserirDado(Coluna::NOME, $linha, $frase);
				$contador++;
			}

		}

		echo "Nº NF: OK<br>";
}



?>
