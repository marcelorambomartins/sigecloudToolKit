<?php

	include 'XML.php';
	include 'inputDoc.php';

	$linhasXML = XML::obterNumeroLinhas($xml);

	for($i = 0; $i < $linhasXML; $i++){
		$nome = XML::obterNomeItem($xml, $i);
		$codXML = XML::obterCodigoItem($xml, $i);
		$tamanho = XML::obterTamanhoNomeItem($xml, $i);
		//$codXML1 = substr($codXML, 0, -2);   // remover string no final da linha
		$newCode = $codXML . $tamanho ;

		$xml->NFe->infNFe->det[$i]->prod->cProd = $newCode;
	}

	XML::salvarXML($xml, $caminho);


	/* // codigo pra substitir valores
	for($i = 0; $i < $linhasXML; $i++){
		$nome = XML::obterNomeItem($xml, $i);

		$newNome = str_ireplace('G G','GG',$nome);

		$xml->NFe->infNFe->det[$i]->prod->xProd = $newNome;
	}

	XML::salvarXML($xml, $caminho);
	*/

?>
