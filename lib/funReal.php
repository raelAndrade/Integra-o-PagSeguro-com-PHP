<?
	//Função Converte Moeda Internacional para Real
	function Real($valor){
		$valor_real = number_format($valor, 2, ',', '.');
		return $valor_real;
	}
?>