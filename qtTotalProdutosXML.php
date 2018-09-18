<?php

	include 'XML.php';
	include 'inputDoc.php';

	$qt = XML::obterQuantTotalProduto($xml);
	$nf = XML::obterNumeroNF($xml);

	echo "Existe " . $qt . " produtos na NF: " . $nf;

?>
