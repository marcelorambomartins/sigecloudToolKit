<?php

include 'Constante.php';
include 'Excel.php';
include 'XML.php';

	class ManipulaXLS {

		static function insertCodigoInNome($planilha, $xml){
			$qt = 0;
			$linha = Inicial::LINHA;

			$excel = new Excel();
			$excel->iniciar($planilha);

			for($linha; $linha <= $excel->ultimaLinha; $linha++){
				$celulaCodigo = $excel->obterDado(Coluna::CODIGO_NFE, $linha);
				$celulaNome = $excel->obterDado(Coluna::NOME, $linha);
				$celulaLucroDinheiro = $excel->obterDado(Coluna::LUCRO_DINHEIRO, $linha);

				$codigoINxml = XML::verificaCodigoPlanilhaXML($celulaCodigo,$xml);

				if($codigoINxml){
					$frase = $celulaCodigo . " - " . $celulaNome;
					$excel->inserirDado(Coluna::NOME, $linha, $frase);
					$qt++;
				}
			}

			$excel->salvar($planilha);

			return $qt . " linhas alteradas";

		}//fim da funcao
	}//fim da classe
?>
