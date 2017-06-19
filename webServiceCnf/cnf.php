<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */

include("./webService/lib/nusoap.php");

$params = array(
    "login" => $_GET['login'],
    "cnpjEmpresa" => $_GET['cnpjEmpresa'],
    "cpf" => $_GET['cpf'],
);

$params = array('arrConsulta' => $params);

try {

    $client = new SoapClient('http://dwonline.com.br/desenv/webServiceCnf/webService/index.php?wsdl', array('trace' => 1, 'exceptions' => 1));

    $result = $client->__soapCall('consultaCnf', $params);
} catch (SoapFault $e) {

    $result = array(
        'erro' => $e->faultstring
    );
}

//print_r(json_decode($result));
//var_dump(($result));
?>

<form action="cnf.php" >
    <div>
        <h2>cpf busca cnf</h2>
        login : Usar 1863597080 - cadastrado para empresa teste
        <input type="text" name="login"><br>
        cnpj empresa - login - 96335712000130
        <input type="text" name="cnpjEmpresa"><br>
        <input type="text" name="cpf"><br>

        <button type="submit">Buscar</button>
    </div>

    <?php
    //print_r($result);

    $decodado = json_decode($result);
    $idtbAnterior = null;


    for ($i = 0; $i < count($decodado); $i++) {

        //echo ">> " . $decodado[$i]->idtb_pessoa_juridica . "<br>";
        //echo ">>ANT " . $idtbAnterior . "<br>";


        if ($decodado[$i]->tb_cnf_nome != $idtbAnterior) {

            //echo "ID   :" . ($decodado[$i]->idtb_pessoa_juridica) . "<br>";
            //echo "CNPJ :" . ($decodado[$i]->tb_pessoa_juridica_cnpj) . "<br>";
            echo "Nome :" . ($decodado[$i]->tb_cnf_nome ) . "<br><br>";
            echo "Data nascimento :" . ($decodado[$i]->tb_cnf_data_nascimento ) . "<br>";
            echo "Data falecimento :" . ($decodado[$i]->tb_cnf_data_falecimento ) . "<br>";
        }

        //for ($a = 0; $a < count($decodado[$i]->tb_pessoa_juridica_fones_fone); $a++) {
        //print_r($decodado[$i]->tb_pessoa_juridica_fones_fone);
        //echo "Fone :".($decodado[$i]->tb_pessoa_juridica_fones_fone ) . "<br><br><br>";
        //}
        $idtbAnterior = $decodado[$i]->tb_cnf_nome;
    }


    echo "<pre>";
    var_dump($decodado);
    echo "</pre>";
    ?>  