<?php
/**
 * Verifica chaves de arrays
 *
 * Verifica se a chave existe no array e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
 *
 * @param array  $array O array
 * @param string $key   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array ( $array, $key ) {
    //print_r($array);
	// Verifica se a chave existe no array
	if ( isset( $array[ $key ] ) && ! empty( $array[ $key ] ) ) {
		// Retorna o valor da chave
		return $array[ $key ];
	}
	
	// Retorna nulo por padrão
	return null;
} // chk_array

/**
 * Função para carregar automaticamente todas as classes padrão
 * Ver: http://php.net/manual/pt_BR/function.autoload.php.
 * Nossas classes estão na pasta classes/.
 * O nome do arquivo deverá ser class-NomeDaClasse.php.
 * Por exemplo: para a classe DataWeb, o arquivo vai chamar class-DataWeb.php
 */
function __autoload($class_name) {
	$file = ABSPATH . '/classes/class-' . $class_name . '.php';
	
	if ( ! file_exists( $file ) ) {
		require_once ABSPATH . '/includes/404.php';
		return;
	}
	
	// Inclui o arquivo da classe
    require_once $file;
} // __autoload
