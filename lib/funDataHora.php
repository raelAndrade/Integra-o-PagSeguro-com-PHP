<?
	function datahora($valor){
		$explode = explode(" ", $valor);
		$data = explode ("-", $explode[0]);
		$ano = $data[0];
		$mes = $data[1];
		$dia = $data[2];
		$datahora = $dia."/".$mes."/".$ano." às ".$explode[1];
		return $datahora;
	}

	function diahora($valor){

		$explode = explode(" ", $valor);
		$data = explode ("-", $explode[0]);

		$ano = $data[0];
		$mes = $data[1];
		$dia = $data[2];

		$datahora = $dia."/".$mes."/".$ano." às ".$explode[1];

		if($dia."/".$mes."/".$ano == date('d/m/Y')){
			$datahora = $explode[1];
		}else{
			$datahora = $dia."/".$mes."/".$ano;	
		}
		return $datahora;
	}
?>