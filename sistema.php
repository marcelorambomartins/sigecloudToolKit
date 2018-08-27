<?php
#AUTOR: http://marcelorambo.com/

#ATUALIZACOES
########################################################################


#versão 2018.03.15
//- acresentado o metodo "insertCategoria"

#versão 2018.04.16
// - acrescentado a validação "SEM GTIN" no metodo codebar

#versão 2018.04.18
// - metodo "insertCategoria" só executa se o campo marca está vazio.

#versao 2018.04.30
// - inserido o metodo "insertSiglaCodigo"

#vesao 2018.07.26
// - inserido o metodo "insertNF"

#versão 2018.08.20
// - refatorado o metodo "codebar" (limitando o codigo de barras para o maximo de 13 caracteres)


#versão 2018.08.27
// - ajuste codebar caso o codigo do produto tenha mais que 13 caracteres



########################################################################

set_time_limit(0); //seta o limite de tempo
ini_set('memory_limit', '-1'); //seta o limite de memoria

// activar Error reporting
error_reporting(E_ALL);

// Incluimos a classe PHPExcel
include  'phpexcel/Classes/PHPExcel.php';

$planilha = "planilhas/planilhaprodutos_27-08-2018_09-36.xls";


$objReader = new PHPExcel_Reader_Excel5();
$objPHPExcel = $objReader->load($planilha);
$objPHPExcel->setActiveSheetIndex(0);


$coluna = 0; // coluna começa em zero
$linha = 2;	// linha começa em um


define('LAST_LINE', lastLine($linha));
define('START_LINE', 2);

//chamada de funcoes
ajustaNome();
insertNF();
insertCategoria();
insertMarca();
insertCfop();
calculaPreco();
codeBar();
//insertSiglaCodigo();
//situacaoTributaria();



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


function insertMarca(){
	$coluna = 1; //coluna da Marca
	$linha = START_LINE;
	$marca = "OGOCHI";
	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaAtual = obterDado($coluna, $linha);

		if($celulaAtual === "---"){
			inserirDado($coluna, $linha, $marca);
		}
	}

	echo "MARCA: OK<br>";

}

function insertCategoria(){
	$colunaCategoria = 0;
	$colunaMarca = 1;
	$linha = START_LINE;
	$categoria = "MAS";


	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaCategoria = obterDado($colunaCategoria, $linha);
		$celulaMarca = obterDado($colunaMarca, $linha);

		if($celulaCategoria === "---" and $celulaMarca === "---"){
			inserirDado($colunaCategoria, $linha, $categoria);
		}
	}

	echo "CATEGORIA: OK<br>";
}

function insertNF(){
	$colunaMarca = 1;
	$colunaNome = 5;            //coluna nome do produto
	$linha = START_LINE;
	$nf = "19970";

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaMarca = obterDado($colunaMarca, $linha);
		$celulaNome = obterDado($colunaNome, $linha);

		$frase = $celulaNome . " #NF" . $nf;

		if($celulaMarca === "---"){
			inserirDado($colunaNome, $linha, $frase);
		}
	}

	echo "Nº NF: OK<br>";
}

function ajustaNome(){
	$coluna = 5; //coluna nome do produto
	$linha = START_LINE;

	$listaPosicoes = vericaNomeDuplo($linha);

	if(!empty($listaPosicoes)){
		foreach ($listaPosicoes	 as $indice => $linha) {
			inserirDado($coluna, $linha, adicionaCodigoNome($linha));
		}
	}

	echo "AJUSTE NO NOME: OK<br>";
}

			function adicionaCodigoNome($linha){
				$colunaNome = 5;
				$colunaCodigo = 3;

				$celulaNome = obterDado($colunaNome, $linha);
				$celulaCodigo = obterDado($colunaCodigo, $linha);

				return $celulaNome . " (" . $celulaCodigo . ").";
			}


			function vericaNomeDuplo($linha){
				$listaPosicoes = array();
				$linha = START_LINE;
				$coluna = 5;

				for($linha; $linha <= LAST_LINE; $linha++){
					for($linha2 = $linha+1; $linha2 <= LAST_LINE; $linha2++){
						$celulaAtual = obterDado($coluna, $linha);
						$celulaSeguinte = obterDado($coluna, $linha2);

						if($celulaAtual == $celulaSeguinte){
							if(!in_array($linha, $listaPosicoes)){ // verifica se aquela posição já exite no array
								$listaPosicoes[] = $linha;
							}
							if(!in_array($linha2, $listaPosicoes)){ // verifica se aquela posição já exite no array
								$listaPosicoes[] = $linha2;
							}
						}
					}
				}

				return $listaPosicoes;
			}


function situacaoTributaria(){
	$coluna = 7; //coluna do Grupo tributario
	$linha = START_LINE;
	$grupoTributario = "SIMPLES NACIONAL";

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaAtual = obterDado($coluna, $linha);

		if($celulaAtual === "---"){
			inserirDado($coluna, $linha, $grupoTributario);
		}
	}

	echo "GRUPO TRIBUTARIO: OK<br>";

}


function insertCfop(){
	$coluna = 9; //coluna da CFOP
	$linha = START_LINE;
	$cfop = 5102;

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaAtual = obterDado($coluna, $linha);

		if($celulaAtual === "---"){
			inserirDado($coluna, $linha, $cfop);
		}else if($celulaAtual == "6102" or $celulaAtual == "6101" or $celulaAtual == "5101"){
			inserirDado($coluna, $linha, $cfop);
		}
	}

	echo "CFOP: OK<br>";
}


function calculaPreco(){ //calcular o preco
	$coluna = 12; // coluna do preco de custo
	$linha = START_LINE;
	$percentual = 1.06;
	$coef = 1; //nota cheia, meia nota, um terço, um quarto  ---- 0.3 30% de desconto

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaAtual = obterDado($coluna+1, $linha);

		if($celulaAtual == 0){
			$celulaAtual = obterDado($coluna, $linha);

				if($coef == 0.09){ // 9% DE DESCONTO.....
					$celulaCalculada = $celulaAtual / 0.91;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.0975){ // 9.75% DE DESCONTO.....
					$celulaCalculada = $celulaAtual / 0.9025;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.14){ // 15% DE DESCONTO.....
					$celulaCalculada = $celulaAtual / 0.86;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.19){ // 19% DE DESCONTO.....
					$celulaCalculada = $celulaAtual / 0.81;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.2){
					$celulaCalculada = $celulaAtual / 0.8;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.21){
					$celulaCalculada = $celulaAtual / 0.79;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.25){
					$precoVenda = ($celulaAtual * 4) * $percentual + ($celulaAtual * 3);
				}else if($coef == 0.3){
					$celulaCalculada = $celulaAtual / 0.7;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.36){
					$celulaCalculada = $celulaAtual / 0.64;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.33){
					$celulaCalculada = $celulaAtual / 0.67;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.45){
					$celulaCalculada = $celulaAtual / 0.55;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.5){      // MEIA NOTA
					$precoVenda = ($celulaAtual * 2) * $percentual + $celulaAtual;
				}else if($coef == 0.636){
					$celulaCalculada = $celulaAtual / 0.364;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef == 0.8){
					$celulaCalculada = $celulaAtual / 0.2;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else if($coef === "1/3"){ // UM TERCO DO VALOR
					$celulaCalculada = $celulaAtual * 3;
					$precoVenda = ((($percentual + 1) * $celulaCalculada) - $celulaAtual);
				}else{
					$precoVenda = $celulaAtual * $percentual;
				}

			$precoFinal = arredondar($celulaAtual, $precoVenda);
			inserirDado($coluna+1, $linha, $precoFinal);


		}

	}

	echo "PRECO DE VENDA: OK<br>";
}

			function arredondar($precoCusto, $precoVenda){
				$num = $precoCusto + $precoVenda;
				$precoFinal = (ceil($num)-0.10) - $precoCusto;
				return $precoFinal;
			}


function codeBar(){
															//EAN-13
	$colunaCodeBar = 6;
	$colunaCodigo = 3;
	$linha = START_LINE;
	$CNPJ = 18650225000159; // 8 primeiros numero base, os 4 proximos numero das filiais e os dois ultimos digito verificador.

	for($linha; $linha <= LAST_LINE; $linha++){
		$celulaCodeBar = obterDado($colunaCodeBar, $linha);
		$celulaCodigo = obterDado($colunaCodigo, $linha);

		if($celulaCodeBar === "---" OR $celulaCodeBar === "SEM GTIN"){

			if(!ctype_alnum($celulaCodigo)){ //verifica se tem caracter especial e retira
				$codigoAlfanumerico = retiraCaracterEspecial($celulaCodigo);
			}else{
				$codigoAlfanumerico = $celulaCodigo;
			}


			if(!ctype_digit($codigoAlfanumerico)){   // verifica se tem letra e substitui por 0 (zero)
				$conteudo = retiraLetras($codigoAlfanumerico);
			}else{
				$conteudo = $codigoAlfanumerico;
			}

			$tamanhoCodeBar = 13;
			$tamanhoCodigo = strlen($conteudo);
			$tamanhoLivre = $tamanhoCodeBar - $tamanhoCodigo;

			if($tamanhoLivre == 0){
				$codebar = $conteudo;  // caso o codigo do produto tenha 13 caracteres
			}else if($tamanhoLivre > 0){
				$codebar = substr($CNPJ,0,$tamanhoLivre) . $conteudo;  // se positivo
			}else{
				$posInicio = abs($tamanhoLivre); // deixa o numero possitivo
				$codebar = substr($conteudo,0,$tamanhoCodeBar) 		// se negativo
			}



			/*
			if($tamanhoCodigo <= 3){
				$codebar = substr($CNPJ,0,10) . $conteudo;
			}else if($tamanhoCodigo <= 5){
				$codebar = substr($CNPJ,0,8) . $conteudo;
			}else if($tamanhoCodigo >= 8){
				$codebar = substr($CNPJ,0,5) . $conteudo;
			}else{
				$codebar = $conteudo;
			}
			*/

			inserirDado($colunaCodeBar, $linha, $codebar);
		}
	}
}


function retiraCaracterEspecial($dadosCelula){


	$listaCaracteres = array(' ','.','-','!','/');

	foreach ($listaCaracteres as $item) {

		$resultado = str_replace($item,'',$dadosCelula);

	}


	if($resultado != $dadosCelula){
		return $resultado;
	}else{
		return $dadosCelula;
	}

}

function retiraLetras($dadosCelula){

	$listaCaracteres = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z');

		foreach ($listaCaracteres as $item) {

			if($item == 'P'){
				$resultado = str_ireplace($item,'1',$dadosCelula);
			}else if($item == 'M'){
				$resultado = str_ireplace($item,'2',$dadosCelula);
			}else if($item == 'G'){
				$resultado = str_ireplace($item,'3',$dadosCelula);
			}else{
				$resultado = str_ireplace($item,'0',$dadosCelula);  // replace, case insensivel, não diferencia maiuscula de minuscula
			}


			if($resultado != $dadosCelula){
			return $resultado;
		}
	}

	if($resultado == $dadosCelula){
		return $dadosCelula;
	}

}

function insertSiglaCodigo(){
$linha = START_LINE;
$colunaMarca = 1;
$colunaCodigo = 3;
$colunaGTrib = 7;

for($linha; $linha <= LAST_LINE; $linha++){
		$celulaCodigo = obterDado($colunaCodigo, $linha);
		$celulaMarca = obterDado($colunaMarca, $linha);
		$celulaGTrib = obterDado($colunaGTrib, $linha);

		if($celulaGTrib === "---"){
			inserirDado($colunaCodigo, $linha, insereSigla($celulaCodigo, $celulaMarca));
		}
}

	echo "SILGA: OK<br>";
}


function juntaCodigoSigla($marca, $codigo, $posicaoInicio, $posicaoFinal, $execucao){

	$sigla = substr($marca, $posicaoInicio,$posicaoFinal);

	if($execucao == 1){
		$code = $codigo . "." . $sigla;
	}else{
		$code = $codigo . $sigla;
	}



	return $code;
}





function descobrePosicaoCaracter($texto){           //DESCOBRE A POSICAO DE UM CARACTER
	$listaCaracteres = array(' ');

	foreach ($listaCaracteres as $item) {

		$posicao = strrpos($texto, $item);

		if($posicao != false){  //false = nome simples  ,    true = nome composto
			return $posicao+1;
		}
	}
}


function insereSigla($codigo, $marca){
	$posicaoInicio = 0;
	$posicaoFinal = 1;

	$posicao = descobrePosicaoCaracter($marca);

	if($posicao	== null){
		$codigo = juntaCodigoSigla($marca, $codigo, $posicaoInicio, $posicaoFinal,1);

	}else{
		$codigo = juntaCodigoSigla($marca, $codigo, $posicaoInicio, $posicaoFinal,1);
		$codigo = juntaCodigoSigla($marca, $codigo, $posicao, $posicaoFinal,2);
	}


	return $codigo;

}


?>
