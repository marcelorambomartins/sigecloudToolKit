<?php
#AUTOR: http://marcelorambo.com/


set_time_limit(0); //seta o limite de tempo
ini_set('memory_limit', '-1'); //seta o limite de memoria

// activar Error reporting
error_reporting(E_ALL);

// Incluimos a classe PHPExcel
include 'Constante.php';
include 'inputFile.php';
include 'Excel.php';


$excel = new Excel();
$excel->iniciar($planilha);


define('LAST_LINE', $excel->ultimaLinha);
define('START_LINE', 2);

//chamada de funcoes
insertCodigoNome($excel);


$excel->salvar($planilha);

##############################################################################


function insertCodigoNome($excel){
	$colunaCodigo = 3;			//coluna do codigo do produto
	$colunaNome = 5;            //coluna nome do produto
	$linha = START_LINE;

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaCodigo = $excel->obterDado($colunaCodigo, $linha);
		$celulaNome = $excel->obterDado($colunaNome, $linha);
		$celulaLucroDinheiro = $excel->obterDado(Coluna::LUCRO_DINHEIRO, $linha);

		if($celulaLucroDinheiro == 0){

			$frase = $celulaCodigo . " - " . $celulaNome;

			$excel->inserirDado($colunaNome, $linha, $frase);
		}

	}

	echo "codigo no produto: OK<br>";
}



?>
