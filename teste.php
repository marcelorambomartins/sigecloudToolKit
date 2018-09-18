<?php
	set_time_limit(0); //seta o limite de tempo
	ini_set('memory_limit', '-1'); //seta o limite de memoria

	include 'CodigoBarras.php';

	$planilha = "planilhas/dream.xls";
	$codigo = 16615;

	$codebar = CodigoBarras::obterCodeBar($planilha, $codigo);

	echo $codebar;

?>
