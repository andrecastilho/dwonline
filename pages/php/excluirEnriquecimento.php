<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$idEnriquecimento = $db->anti_injection($_GET['idtbEnriquecimento']); 

// Verifica se o usuário existe
$db_check_user = $db->query("DELETE FROM tb_enriquecimento WHERE idtb_enriquecimento = :idtb", array(':idtb' => $idEnriquecimento));

// Verifica se a consulta foi realizada com sucesso
if ($db_check_user) {
     echo"Exuido com sucesso !  <br>"; 
    echo "<input type='button' target='' onclick='javascript:history.back();self.location.reload();' class='btn btn-primary btn-block btn-flat' style='width: 20%;height: 42px; background-color: #FF9233; float: left;margin-top: auto;' value='Voltar'><br>" ;
}



