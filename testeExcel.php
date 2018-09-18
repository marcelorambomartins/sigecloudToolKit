<?php


	include 'Excel.php';

	$planilha = "planilhas/dream.xls";

	$excel = new Excel();

	$excel->iniciar($planilha);

	//print_r($excel->ultimaLinha);

	echo $excel->ultimaLinha;

?>
