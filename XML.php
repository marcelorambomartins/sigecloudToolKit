<?php
//http://www.devwilliam.com.br/php/aprenda-como-ler-arquivos-xml-com-php


# verificar a possibilidade de refatorar as funções de obter itens do XML

Class XML{

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

}//fim da classe

?>
