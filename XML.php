<?php
//http://www.devwilliam.com.br/php/aprenda-como-ler-arquivos-xml-com-php

Class XML{

	static function obterInfoProduto($codigoProduto,$xml){

		foreach($xml->NFe->infNFe->det as $produto):
			$codXML = $produto->prod->cProd;

			if($codigoProduto == $codXML){
				return $produto->infAdProd;
			}

		endforeach;
	}//fim da funcao


	static function obterQuantProduto($codigoProduto,$xml){

		foreach($xml->NFe->infNFe->det as $produto):
			$codXML = $produto->prod->cProd; //captura codigo do produto

			if($codigoProduto == $codXML){
				return $produto->prod->qTrib; //retorna quantidade do produto
			}

		endforeach;
	}//fim da funcao
}//fim da classe

?>
