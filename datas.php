<?php
/* Igor Mateus França Diniz Lovi */

// ***** FUNÇÕES AUXILIARES *****
// Soma os dias dos anos
function somaDiasDosAnos($ano) {
	$totalDias	= 0;

	for($int = 1; $int < $ano; $int++) {
		if(anoBissexto($int)) {
			$diasASomar = 366;
		} else {
			$diasASomar = 365;
		}
		$totalDias += $diasASomar;
	}

	return $totalDias;
}

// Verifica se o ano é bissexto
function anoBissexto($ano) {
	if($ano % 4 == 0 && $ano % 100 != 0 || $ano % 400 == 0) {
		return true;
	} else {
		return false;
	}
}

/**
* Calcula o numero de dias entre 2 datas.
* As datas passadas sempre serao validas e a primeira data sempre sera menor que a segunda data.
* @param string $dataInicial No formato YYYY-MM-DD
* @param string $dataFinal No formato YYYY-MM-DD
* @return int O numero de dias entre as datas
**/
function calculaDias($dataInicial, $dataFinal) {
	$totalDiasDataInicial = 0;
	$totalDiasDataFinal = 0;
	$diasPorMes = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

	// Separa o ano, mes e dia das datas
	list($anoDataInicial, $mesDataInicial, $diaDataInicial) = explode("-", $dataInicial);
	list($anoDataFinal, $mesDataFinal, $diaDataFinal) = explode("-", $dataFinal);

	$totalDiasDataInicial = $diaDataInicial;
	$totalDiasDataFinal = $diaDataFinal;	

	// Soma dos dias do mês do input, se for um ano bissexto, soma 1 para compensar o mês de fevereiro que foi definido como 28 dias padrão
	for($int = 0; $int < $mesDataInicial - 1; $int++) {
		$totalDiasDataInicial += $diasPorMes[$int];
	}

	if($mesDataInicial > 2) {
		if(anoBissexto($anoDataInicial)) {
			$totalDiasDataInicial++;
		}
	}

	for($int = 0; $int < $mesDataFinal - 1; $int++) {
		$totalDiasDataFinal += $diasPorMes[$int];
	}

	if($mesDataFinal > 2) {
		if(anoBissexto($anoDataFinal)) {
			$totalDiasDataFinal++;
		}
	}

	$totalDiasDataInicial += somaDiasDosAnos($anoDataInicial);
	$totalDiasDataFinal += somaDiasDosAnos($anoDataFinal);

	return $totalDiasDataFinal - $totalDiasDataInicial;
}

/***** Teste 01 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-01-02";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("01", $resultadoEsperado, $resultado);

/***** Teste 02 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-01";
$resultadoEsperado = 31;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("02", $resultadoEsperado, $resultado);

/***** Teste 03 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-02";
$resultadoEsperado = 32;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("03", $resultadoEsperado, $resultado);

/***** Teste 04 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-28";
$resultadoEsperado = 58;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("04", $resultadoEsperado, $resultado);

/***** Teste 05 *****/
$dataInicial = "2018-01-15";
$dataFinal = "2018-03-15";
$resultadoEsperado = 59;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("05", $resultadoEsperado, $resultado);

/***** Teste 06 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2019-01-01";
$resultadoEsperado = 365;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("06", $resultadoEsperado, $resultado);

/***** Teste 07 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2020-01-01";
$resultadoEsperado = 730;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("07", $resultadoEsperado, $resultado);

/***** Teste 08 *****/
$dataInicial = "2018-12-31";
$dataFinal = "2019-01-01";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("08", $resultadoEsperado, $resultado);

/***** Teste 09 *****/
$dataInicial = "2018-05-31";
$dataFinal = "2018-06-01";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("09", $resultadoEsperado, $resultado);

/***** Teste 10 *****/
$dataInicial = "2018-05-31";
$dataFinal = "2019-06-01";
$resultadoEsperado = 366;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("10", $resultadoEsperado, $resultado);

/***** Teste 11 *****/
$dataInicial = "2016-02-01";
$dataFinal = "2016-03-01";
$resultadoEsperado = 29;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("11", $resultadoEsperado, $resultado);

/***** Teste 12 *****/
$dataInicial = "2016-01-01";
$dataFinal = "2016-03-01";
$resultadoEsperado = 60;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("12", $resultadoEsperado, $resultado);

/***** Teste 13 *****/
$dataInicial = "1981-09-21";
$dataFinal = "2009-02-12";
$resultadoEsperado = 10006;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("13", $resultadoEsperado, $resultado);

/***** Teste 14 *****/
$dataInicial = "1981-07-31";
$dataFinal = "2009-02-12";
$resultadoEsperado = 10058;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("14", $resultadoEsperado, $resultado);

/***** Teste 15 *****/
$dataInicial = "2004-03-01";
$dataFinal = "2009-02-12";
$resultadoEsperado = 1809;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("15", $resultadoEsperado, $resultado);

/***** Teste 16 *****/
$dataInicial = "2004-03-01";
$dataFinal = "2009-02-12";
$resultadoEsperado = 1809;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("16", $resultadoEsperado, $resultado);

/***** Teste 17 *****/
$dataInicial = "1900-02-01";
$dataFinal = "1900-03-01";
$resultadoEsperado = 28;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("17", $resultadoEsperado, $resultado);

/***** Teste 18 *****/
$dataInicial = "1899-01-01";
$dataFinal = "1901-01-01";
$resultadoEsperado = 730;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("18", $resultadoEsperado, $resultado);

/***** Teste 19 *****/
$dataInicial = "2000-02-01";
$dataFinal = "2000-03-01";
$resultadoEsperado = 29;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("19", $resultadoEsperado, $resultado);

/***** Teste 20 *****/
$dataInicial = "1999-01-01";
$dataFinal = "2001-01-01";
$resultadoEsperado = 731;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("20", $resultadoEsperado, $resultado);


function verificaResultado($nTeste, $resultadoEsperado, $resultado) {
	if(intval($resultadoEsperado) == intval($resultado)) {
		echo "Teste $nTeste passou.\n";
	} else {
		echo "Teste $nTeste NAO passou (Resultado esperado = $resultadoEsperado, Resultado obtido = $resultado).\n";
	}
}

?>