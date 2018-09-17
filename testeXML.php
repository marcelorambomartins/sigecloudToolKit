<?php
	include 'XML.php';

	$caminho = 'planilhas/amiguinha.xml';
	$xml = simplexml_load_file($caminho);
	$linhasXML = XML::obterNumeroLinhas($xml);


	for($i = 0; $i < $linhasXML; $i++){
		$nome = XML::obterNomeItem($xml, $i);
		$codXML = XML::obterCodigoItem($xml, $i);
		$tamanho = XML::obterTamanhoNomeItem($xml, $i);
		$codXML1 = substr($codXML, 0, -2);
		$newCode = $codXML1 . $tamanho ;

		$xml->NFe->infNFe->det[$i]->prod->cProd = $newCode;
	}

	XML::salvarXML($xml, $caminho);


	/*
	for($i = 0; $i < $linhasXML; $i++){
		$nome = XML::obterNomeItem($xml, $i);

		$newNome = str_ireplace('G G','GG',$nome);

		$xml->NFe->infNFe->det[$i]->prod->xProd = $newNome;
	}

	XML::salvarXML($xml, $caminho);
	*/

?>
