<?php

	$caminho = 'planilhas/amiguinha.xml';
	$xml = simplexml_load_file($caminho);
	$xml->NFe->infNFe->ide->nNF = '22222';

	$arquivo = fopen($caminho, 'w+');
	$escreve = fwrite($arquivo, $xml->asXML());
	fclose($arquivo);

?>
