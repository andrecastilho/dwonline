<?php

echo "<br><pre>
      
< ? php
$ params = array('login' => $ _GET['login'],'cnpjEmpresa' => $ _GET['cnpjEmpresa'],  'cpf' => $ _GET['cpf'],);

$ params = array('arrConsulta' => $ params);

try {

    $ client = new SoapClient('http://dwonline.com.br/desenv/serviceDataWeb/webService/index.php?wsdl', array('trace' => 1, 'exceptions' => 1));

    $ result = $ client->__soapCall('consultaCpf', $ params);
    
} catch (SoapFault $ e) {



    $ result = array(
        'erro' => $ e->faultstring
    );
}
?></pre>";
