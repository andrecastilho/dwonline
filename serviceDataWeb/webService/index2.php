<?php

$xmlinput = '  
 <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/ 
 envelope/" xmlns:ns1="urn::robTest"> 
 <SOAP-ENV:Header> 
 <ns1:AuthenticationInfo> 
 <username>MYLOGINID</username> 
 <password>MYPASSWORD</password> 
 </ns1:AuthenticationInfo> 
 </SOAP-ENV:Header> 
 <SOAP-ENV:Body> 
 <ns1:GetTestList>false</ns1:GetTestList> 
 </SOAP-ENV:Body> 
 </SOAP-ENV:Envelope> 
 EOXML';

function AuthenticationInfo($authinfo) {
    if ($authinfo->username != "MYLOGINID") {
        return new SoapFault("F998", "Invalid USername");
    } else if ($authinfo->password != "MYPASSWORD") {
        return new SoapFault("F999", "Invalid Password");
    }
    /* Return value here would be used to add header to response */
}

function GetTestList($getAll) {
    return $getAll;
}

$server = new SoapServer('http://54.94.199.133/dataWeb/serviceDataWeb/webService/teste.php?wsdl');

$server->addFunction("GetTestList");
$server->addFunction("AuthenticationInfo");
$server->handle($xmlinput);
