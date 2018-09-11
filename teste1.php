<?php

	include 'XML.php';

	$caminho = 'planilhas/amiguinha.xml';
	$xml = simplexml_load_file($caminho);
	$nItem = 10;

	$linhas = XML::obterCodigoItem($xml,$nItem);

	echo $linhas;


?>
