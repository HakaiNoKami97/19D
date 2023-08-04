<?php
/**
* clase para validar datos recibidos en php
*/
class validar
{
	public static function valorInput($valor){
		$explode = explode(':', $valor);
		$last = count($explode);
		$valorInput = trim($explode[$last-1]);
		return $valorInput;
	}
	public static function longitud($valor, $minimo, $maximo){
		$caracteres = strlen( trim($valor) );
		if( $caracteres >= $minimo && $caracteres <= $maximo ){
			return true;
		}else{
			return false;
		}
	}

	public static function requerido($valor){
		$caracteres = strlen( trim($valor) );
		if($caracteres > 0){
			return true;
		}else{
			return false;
		}
	}

	public static function correo($valor){
		$mail = trim($valor);
		if( filter_var($mail, FILTER_VALIDATE_EMAIL) ){
			/*$domain = explode('@', $valor);
			if (checkdnsrr($domain[1])){
				return true;
			}else{
				return false;
			}*/
			return true;
		}else{
			return false;
		}
	}

	public static function letras($valor){
		$patronAlfaNumerico = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
		if( preg_match($patronAlfaNumerico, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function alfanumerico($valor){
		$patronAlfaNumerico = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
		if( preg_match($patronAlfaNumerico, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function direccion($valor){
		$patronDireccion = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙº#.\-\s]+$/";
		if( preg_match($patronDireccion, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function numeros($valor){
		$soloNumero = str_replace(" ", "", $valor);
		if( is_numeric($soloNumero) ){
			$caracteres = strlen($soloNumero);
			if ( $caracteres > 0 && $caracteres < 11 ) {
				return true;
			}else{
				return "no_rango";
			}
		}else{
			return "no_numero";
		}
	}

	public static function password($valor){
		$patronAlfaNumerico = "/^[a-zA-Z0-9]+$/";
		if( preg_match($patronAlfaNumerico, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function patronnumeros($valor){
		$patronNumerico = "/^[0-9]+$/";
		if( preg_match($patronNumerico, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function patronalfanumerico($valor){
		$patronAN = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑŃń,\/.\-\s]+$/";
		if( preg_match($patronAN, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function patronalfanumericocontraseña($valor){
		$patronAN = "/^[a-zA-Z0-9]+$/";
		if( preg_match($patronAN, $valor ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function entero($valor){
		if( filter_var($valor, FILTER_VALIDATE_INT) === 0 || !filter_var($valor, FILTER_VALIDATE_INT) === false ){
			return true;
		}else{
			return false;
		}
	}

	public static function valoresnumericos($valor,$valores){
		$numerosvalidos = explode(",", $valores);
		if(in_array($valor, $numerosvalidos)){
			return true;
		}else{
			return false;
		}
	}

	public static function valorenvalores($valor,$valores){
		$arrayValores = explode(',', $valores);
		if( in_array($valor, $arrayValores) ){
			return true;
		}else{
			return false;
		}
	}

	public static function float($valor,$separadorDecimales){
		if( $valor == "0" || filter_var($valor, FILTER_VALIDATE_FLOAT,array('options' => array('decimal' => $separadorDecimales))) ){
			return true;
		}else{
			return false;
		}
	}

	public static function fecha($fecha,$separador,$formato){
		//fecha->string de la fecha con dia, mes y año en el
		//orden que quiera en formato numerico ej: 17-12-2001, 2001/12/17
		//separador->un caracter unico que separa el dia mes y año
		//para los casos anteriores fue - y /
		//formato el orden en que se da el dia mes año se establece
		//mediante las letras d(dia) m(mes) a(año) para los casos
		//seria dma y amd
		$arryFecha = explode($separador, $fecha);
		if(count($arryFecha) == 3){

			switch ($formato) {
				case 'dma':
					$dia = $arryFecha[0];
					$mes = $arryFecha[1];
					$anio = $arryFecha[2];

					break;
				case 'dam':
					$dia = $arryFecha[0];
					$mes = $arryFecha[2];
					$anio = $arryFecha[1];
					break;
				case 'mad':
					$dia = $arryFecha[2];
					$mes = $arryFecha[0];
					$anio = $arryFecha[1];
					break;
				case 'mda':
					$dia = $arryFecha[1];
					$mes = $arryFecha[0];
					$anio = $arryFecha[2];
					break;
				case 'adm':
					$dia = $arryFecha[1];
					$mes = $arryFecha[2];
					$anio = $arryFecha[0];
					break;
				case 'amd':
					$dia = $arryFecha[2];
					$mes = $arryFecha[1];
					$anio = $arryFecha[0];
					break;
				default:
					# code...
					break;
			}
			if(checkdate($mes, $dia, $anio)){
				return true;
			}else{
				return false;
			}
		}else{
			//var_dump($arryFecha);
			return false;
		}
	}
	//validar ip ipv4
	public static function ip($ip,$tipo){
		switch ($tipo) {
			case 'IPV4':
				$tipoIp = "FILTER_FLAG_IPV4";
				break;
			case 'IPV6':
				$tipoIp = "FILTER_FLAG_IPV6";
				break;
			default:
				$tipoIp = "FILTER_FLAG_IPV4";
				break;
		}
		if(filter_var($ip, FILTER_VALIDATE_IP, $tipoIp)) {
			return true;
		} else {
			return false;
		}
	}
	//validar un numero entre un rango incluyendo los limites del rango
	public static function numeroenrango($numero,$numeroMinimo,$numeroMaximo){
		$boolNumero = self::patronnumeros($numero);
		if( $boolNumero ){
			if( $numero < $numeroMinimo || $numero > $numeroMaximo ){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}
?>