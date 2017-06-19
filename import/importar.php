<?php

include ("Upload.class.php");
$upload = new Upload();
$upload->Upload($_POST);
header("location:../importa-arquivo/?importado=1");
?> 