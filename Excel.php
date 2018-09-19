<?php
set_time_limit(0); //seta o limite de tempo
ini_set('memory_limit', '-1'); //seta o limite de memoria

include  'phpexcel/Classes/PHPExcel.php';

Class Excel{

	public $excel;
	public $ultimaLinha;

	function __construct(){}

	 function iniciar($planilha){

		$objReader = new PHPExcel_Reader_Excel5();
		$objPHPExcel = $objReader->load($planilha);
		$objPHPExcel->setActiveSheetIndex(0);
		$this->excel = $objPHPExcel;
		$this->lastLine();

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


	function lastLine(){

		$coluna = 0; // coluna das ID
		$linha = 2;

		$celulaAtual = $this->obterDado($coluna, $linha);

		while(!empty($celulaAtual)){
			$linha++;
			$celulaAtual = $this->obterDado($coluna, $linha);
		}

		$this->ultimaLinha = $linha - 1;
	}

}//fim da classe

?>
