<?php

	//include 'XML.php';

	//$xml2 = simplexml_load_file('planilhas/amiguinha.xml');
	/*
	$xml = new SimpleXMLElement('planilhas/amiguinha.xml', 0, true);

	$xml->NFe->infNFe->ide->nNF = '22222';

	$fp = fopen('planilhas/amiguinha.xml', 'w');
	fwrite($fp, $xml);
	fclose($fp);
	*/
	$xml = simplexml_load_file('planilhas/amiguinha.xml');
	$xml->NFe->infNFe->ide->nNF = '22222';
	print_r($xml);


	$fp = fopen('planilhas/meus_links.xml', 'w+');
	fwrite($xml, $fp); // não está salvando
	fclose($fp);

?>
