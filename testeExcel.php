<?php

	include 'xls/ManipulaXLS.php';
	include 'inputFile.php';

	$result = ManipulaXLS::insertCodigoInNome($planilha,$xml);

	echo $result;

?>
