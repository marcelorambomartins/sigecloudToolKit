<?php
//http://www.devwilliam.com.br/php/aprenda-como-ler-arquivos-xml-com-php


# verificar a possibilidade de refatorar as funções de obter itens do XML

class XML{

	static function obterInfoProduto($codigoProduto,$xml){

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos
			$codXML = $produto->prod->cProd; //captura codigo do produto

			if($codigoProduto == $codXML){
				return $produto->infAdProd; //retorna a informacao adicional do produto
			}

		endforeach;
	}//fim da funcao


	static function obterQuantProduto($codigoProduto,$xml){

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos
			$codXML = $produto->prod->cProd; //captura codigo do produto

			if($codigoProduto == $codXML){
				return $produto->prod->qTrib; //retorna quantidade do produto
			}

		endforeach;
	}//fim da funcao



	static function obterQuantTotalProduto($xml){
		$qtTotal = 0;

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos

			$qtProduto = $produto->prod->qTrib; //retorna quantidade do produto
			$qtTotal += $qtProduto;

		endforeach;

		return $qtTotal; //retorna quantidade total de produtos

	}//fim da funcao


	static function obterNumeroNF($xml){

		return $xml->NFe->infNFe->ide->nNF; //retorna o numero da NF

	}//fim da funcao

	static function salvarXML($xml, $caminho){

		$arquivo = fopen($caminho, 'w+');
		$escreve = fwrite($arquivo, $xml->asXML());   //$xml->asXML()    //converte objeto em XML
		fclose($arquivo);

	}//fim da funcao

	static function obterPrecoCustoProduto($codigoProduto,$xml){

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos
			$codXML = $produto->prod->cProd; //captura codigo do produto

			if($codigoProduto == $codXML){
				return $produto->prod->vUnTrib; //retorna Preco Custo do produto
			}

		endforeach;
	}//fim da funcao


	static function verificaCodigoPlanilhaXML($codigoProduto,$xml){ //verifica se o codigo da planilha está no XML

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos
			$codXML = $produto->prod->cProd; //captura codigo do produto

			if($codigoProduto == $codXML){
				return true; //se encontrou retorna true
			}

		endforeach;
	}//fim da funcao

	static function verificaCodigoDuplicado($xml){

		$linhasXML = obterNumeroLinhas($xml);

		for($i = 0; $i < $linhasXML; $i++){
			$codigo1 = obterCodigoItem($i);

			for($j = $i+1; $j < $linhasXML; $j++){
				$codigo2 = obterCodigoItem($j);

				if($codigo1 == $codigo2){
					//alterar o codigo
				}
			}

		}

	}//fim da funcao

	static function obterNumeroLinhas($xml){
		$numeroLinhas = 0;

		foreach($xml->NFe->infNFe->det as $produto): //percorre todos os produtos
			$numeroLinhas++;
		endforeach;

		return $numeroLinhas;

	}//fim da funcao

	static function obterCodigoItem($xml, $nItem){   //$nItem começa em zero
			return $xml->NFe->infNFe->det[$nItem]->prod->cProd;
	}//fim da funcao

	static function obterNomeItem($xml, $nItem){   //$nItem começa em zero
			return $xml->NFe->infNFe->det[$nItem]->prod->xProd;
	}//fim da funcao

	static function obterTamanhoNomeItem($xml, $nItem){   //$nItem começa em zero
			$tamanho = false;
			$nome = XML::obterNomeItem($xml, $nItem);

			$listaTamanhos = array(' PP',' P',' M',' G',' GG',' G G',' 14');

			foreach ($listaTamanhos as $item) {

				$posicao = strrchr($nome, $item);

				if($posicao != false){
					$tamanho = $posicao;
				}
			}

			return $tamanho;
	}//fim da funcao

}//fim da classe

?>
