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
}//fim da classe

?>
