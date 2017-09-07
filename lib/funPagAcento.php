<?
function pagAcento($campo){
	$arrumar = mb_convert_encoding($campo, 'UTF-8', 'ISO-8859-1,ASCII,UTF-8');
	return $arrumar;
}
?>