<?php

include  'phpexcel/Classes/PHPExcel.php';

Class Excel{

	public $excel;

	function __construct(){}

	 function iniciar($planilha){

		$objReader = new PHPExcel_Reader_Excel5();
		$objPHPExcel = $objReader->load($planilha);
		$objPHPExcel->setActiveSheetIndex(0);
		$this->excel = $objPHPExcel;

	}//fim da funcao

	function getExcel(){
		return $this->excel;
	}

	function salvar($planilha){
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save($planilha);
	}


	function obterDado($coluna, $linha){
		return $this->excel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue(); //obtem
	}//fim da funcao


	function inserirDado($coluna, $linha, $conteudo){
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $conteudo); // insere
	}//fim da funcao


}//fim da classe

?>
