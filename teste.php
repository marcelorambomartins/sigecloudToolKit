<?php

	include 'CodigoBarras.php';

	$planilha = "planilhas/uzza.xls";
	$codigo = 9920;

	$codebar = CodigoBarras::obterCodeBar($planilha, $codigo);

	echo $codebar;

?>
