<?php

/**
* Descripción: Clase para evitar ataques csrf
* Autor: Martín Peveri
* Fecha: 31/10/2014
*/
class php_csrf{
	
	//Función que chequea si esta ok el token
	public static function check($origen, $session){

		//Verifico si estan definidas las variables a verificar
		if(isset($origen['csrf_token']) && isset($session['csrf_token'])){
			//Si son iguales retorno true, de lo contrario retorno una excepción
			if($origen['csrf_token'] == $session['csrf_token']){
				return true;
			}else{
				throw new Exception("Error CSRF, no coinciden", 1);
			}
		}else{
			throw new Exception("Error CSRF", 1);
		}
	}

	//Función que genera el token csrf y lo cargo en la session
	public static function generate(){

		if(isset($_SESSION['csrf_token'])){
			$token = $_SESSION['csrf_token'];
		}else{	
			$token = md5(uniqid(rand(), true));
			$_SESSION['csrf_token'] = $token;
		}
		//Retorno el token
		return $token;
	}
	
}

?>