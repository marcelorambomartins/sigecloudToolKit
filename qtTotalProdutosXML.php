<?php

	include 'XML.php';

	$xml = simplexml_load_file('planilhas/rikam.xml');

	$qt = XML::obterQuantTotalProduto($xml);

	echo $qt;

?>
