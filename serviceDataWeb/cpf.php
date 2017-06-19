<?php
include("./webService/lib/nusoap.php");

$params = array(
    "login" => $_GET['login'],
    "cnpjEmpresa" => $_GET['cnpjEmpresa'],
    "cpf" => $_GET['cpf'],
);


$params = array('arrConsulta' => $params);

try {

    $client = new SoapClient('http://dwonline.com.br/desenv/serviceDataWeb/webService/index.php?wsdl', array('trace' => 1, 'exceptions' => 1));

    $result = $client->__soapCall('consultaCpf', $params);
} catch (SoapFault $e) {



    $result = array(
        'erro' => $e->faultstring
    );
}
?>
<form action="cpf.php" >
    <div>
        <h2>CPF</h2>
        login :
        <input type="text" name="login"><br>
        cnpj empresa 
        <input type="text" name="cnpjEmpresa"><br>
        cpf:
        <input type="text" name="cpf"><br>

        <button type="submit">Buscar</button>
    </div>
    <?php
    $decodado = json_decode($result);


    for ($i = 0; $i < count($decodado); $i++) {

        echo ">> " . $decodado[$i]->idtb_pessoa_juridica . "<br>";
        echo ">>ANT " . $idtbAnterior . "<br>";


        if ($decodado[$i]->idtb_pessoa_fisica != $idtbAnterior) {

            echo "<br>ID   :" . ($decodado[$i]->idtb_pessoa_juridica) . "<br>";
            echo "CNPJ :" . ($decodado[$i]->tb_pessoa_fisica_cpf) . "<br>";
            echo "Nome :" . ($decodado[$i]->tb_pessoa_fisica_nome ) . "<br>";
        }
            
        echo "Fone :" . ($decodado[$i]->tb_pessoa_fisica_fones_fone ) . "<br><br><br>";
        //}
        $idtbAnterior = $decodado[$i]->idtb_pessoa_fisica;
    }

    echo "<pre>";
    var_dump($decodado);
    echo "</pre>";
    
    echo "<pre>";
    var_dump($decodado['erro']);
    echo "</pre>";
    