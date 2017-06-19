<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';



$db = new TutsupDB();

$idEnriquecimento = $db->anti_injection($_GET['idtbEnriquecimento']);

$query = $db->pdo->exec('UPDATE `dataWebProducao`.`tb_enriquecimento`
SET
tb_enriquecimento_em_procesamento = NULL,
tb_enriquecimento_sem_credito=NULL,
tb_enriquecimento_erro=NULL
 WHERE idtb_enriquecimento = ' . $idEnriquecimento . ''); 

if ($query) {
    echo"Atualizado com sucesso ! Um novo processamento  iniciado automaticamente<br>";
    echo "<input type='button' target='' onclick='javascript:history.back();self.location.reload();' class='btn btn-primary btn-block btn-flat' style='width: 20%;height: 42px; background-color: #FF9233; float: left;margin-top: auto;' value='Voltar'><br>" ;
} else {
    echo "erro--> ".$query;
}

