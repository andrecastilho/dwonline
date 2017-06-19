<?php
include("./webService/lib/nusoap.php");

$params = array(
    "cnpj" => $_GET['cnpj'],
    "cnpj1" => $_GET['cnpj1'],
    "cnpj2" => $_GET['cnpj2'],
);

$params = array('arrConsulta' => $params);

try {

    $client = new SoapClient('http://54.94.199.133/dataWeb/serviceDataWeb/webService/index.php?wsdl', array('trace' => 1, 'exceptions' => 1));

    $result = $client->__soapCall('consulta', $params);
} catch (SoapFault $e) {



    $result = array(
        'erro' => $e->faultstring
    );
}

//print_r(json_decode($result));
//var_dump(($result));
?>

<form action="cnpj.php" >
    <div>
        <h2>CNPJ</h2>
        <input type="text" name="cnpj"><br>
        <input type="text" name="cnpj1"><br>
        <input type="text" name="cnpj2"><br>
        <button type="submit">Buscar</button>
    </div>

    <?php
    $decodado = json_decode($result);


    for ($i = 0; $i < count($decodado); $i++) {

        //echo ">> " . $decodado[$i]->idtb_pessoa_juridica . "<br>";
        //echo ">>ANT " . $idtbAnterior . "<br>";


        if ($decodado[$i]->idtb_pessoa_juridica != $idtbAnterior) {

            echo "ID   :" . ($decodado[$i]->idtb_pessoa_juridica) . "<br>";
            echo "CNPJ :" . ($decodado[$i]->tb_pessoa_juridica_cnpj) . "<br>";
            echo "Nome :" . ($decodado[$i]->tb_pessoa_juridica_nome ) . "<br><br><br>";
        }

        //for ($a = 0; $a < count($decodado[$i]->tb_pessoa_juridica_fones_fone); $a++) {
        //print_r($decodado[$i]->tb_pessoa_juridica_fones_fone);

        echo "Fone :".($decodado[$i]->tb_pessoa_juridica_fones_fone ) . "<br><br><br>";
        //}
        $idtbAnterior = $decodado[$i]->idtb_pessoa_juridica;
    }

    echo "<pre>";
    var_dump($decodado);
    echo "</pre>";
    ?>