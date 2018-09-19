<?php

	include 'XML.php';
	include 'inputFile.php';

	$qt = XML::obterQuantTotalProduto($xml);
	$nf = XML::obterNumeroNF($xml);

	echo "Existe " . $qt . " produtos na NF: " . $nf;

?>
