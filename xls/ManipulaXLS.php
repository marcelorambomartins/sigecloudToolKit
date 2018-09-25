<?php

include '../Constante.php';
include '../Excel.php';
include '../XML.php';

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


		static function insertNumeroNF($planilha, $xml){
			$qt = 0;
			$numeroNFxml = XML::obterNumeroNF($xml);
			$linha = Inicial::LINHA;
			$contador = 0;
			$centena = 1;
			$tagNF = "#NF";

			$excel = new Excel();
			$excel->iniciar($planilha);

			for($linha; $linha <= $excel->ultimaLinha; $linha++){
				$celulaCodigo = $excel->obterDado(Coluna::CODIGO_NFE, $linha);
				$celulaNome = $excel->obterDado(Coluna::NOME, $linha);

				$codigoINxml = XML::verificaCodigoPlanilhaXML($celulaCodigo,$xml);

				if($codigoINxml){

					if($contador == 100){
						$contador = 0;
						$centena++;
					}

					$pos = strpos($celulaNome, $tagNF);

					if($pos != false){ // já existe uma NF vinculada ao produto

						$nfNova = " #NF" . $numeroNFxml . "/" . $centena;
						$frase = str_ireplace($nfVelha,$nfNova,$celulaNome);

					}else{ // não existe uma NF vinculada ao produto
						$frase = $celulaNome . " #NF" . $numeroNFxml . "/" . $centena;
					}

					$excel->inserirDado(Coluna::NOME, $linha, $frase);
					$contador++;
					$qt++;
				}
			}//fim do for

			$excel->salvar($planilha);

			return $qt . " linhas alteradas";

		}//fim da funcao



		static function insertQuantInNome($planilha, $xml){
			$qt = 0;
			$linha = Inicial::LINHA;

			$excel = new Excel();
			$excel->iniciar($planilha);

			for($linha; $linha <= $excel->ultimaLinha; $linha++){
				$celulaCodigo = $excel->obterDado(Coluna::CODIGO_NFE, $linha);
				$celulaNome = $excel->obterDado(Coluna::NOME, $linha);

				$quantProduto = XML::obterQuantProduto($celulaCodigo, $xml);

				if($quantProduto){
					$quantProd = intval($quantProduto);

					$frase = $celulaNome . " #QT" . $quantProd;

					$excel->inserirDado(Coluna::NOME, $linha, $frase);
					$qt++;
				}
			}// fim do for

			$excel->salvar($planilha);

			return $qt . " linhas alteradas";

		}//fim da funcao



		static function insertInfoInNome($planilha, $xml){
			$qt = 0;
			$linha = Inicial::LINHA;

			$excel = new Excel();
			$excel->iniciar($planilha);

			for($linha; $linha <= $excel->ultimaLinha; $linha++){
				$celulaCodigo = $excel->obterDado(Coluna::CODIGO_NFE, $linha);
				$celulaNome = $excel->obterDado(Coluna::NOME, $linha);

				$infoProduto = XML::obterInfoProduto($celulaCodigo, $xml);

				if($infoProduto){
					$tamanhoInfo = strlen($infoProduto);

					if($tamanhoInfo > 10){
						$info = substr($infoProduto,0,10);
						$infoProduto = $info;
					}

					$frase = $infoProduto . " - " . $celulaNome;

					$excel->inserirDado(Coluna::NOME, $linha, $frase);
					$qt++;
				}
			}//fim do for

			$excel->salvar($planilha);

			return $qt . " linhas alteradas";

		}//fim da funcao

	}//fim da classe
?>
