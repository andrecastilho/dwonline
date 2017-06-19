<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '/var/www/html/classes/class-TutsupDB.php';

$db = new TutsupDB();

$inseriu = null;

$sql = "SELECT * FROM dataWebProducao.tb_utilizacao_contagem
where tb_utilizacao_contagem_contabilizado is null";

$db_retorno = $db->query($sql);
$fetch = $db_retorno->fetchAll();

for ($cont = 0; $cont < count($fetch); $cont++) {


    for ($i = 0; $i < $fetch[$cont]['tb_utilizacao_contagem_total_enriquecido']; $i++) {


        $insert = "INSERT INTO `dataWebProducao`.`tb_utilizacao_sistema`
          (`idtb_utilizacao_sistema`,
          `tb_utilizacao_sistema_empresa_user`,
          `tb_utilizacao_sistema_idtb_user`,
          `tb_utilizacao_sistema_session_user`,
          `tb_utilizacao_sistema_ip_user`,
          `tb_utilizacao_sistema_busca`,
          `tb_utilizacao_sistema_filtro`,
          `tb_utilizacao_sistema_data_hora`,
          `tb_utilizacao_sistema_HTTP_COOKIE`,
          `tb_utilizacao_sistema_SCRIPT_FILENAME`,
          `tb_utilizacao_sistema_REQUEST_METHOD`,
          `tb_utilizacao_sistema_HTTP_USER_AGENT`,
          `tb_utilizacao_sistema_retorno_ok`)
          VALUES
          ('',
          '" . $fetch[$cont]['tb_utilizacao_contagem_cnpj_empresa'] . "',
          '" . $fetch[$cont]['tb_utilizacao_contagem_idtb_usuario'] . "',
          '',
          '',
          '',
          '" . $fetch[$cont]['tb_utilizacao_contagem_id_enriquecimento'] . "',
          " . time() . ",
          '',
          '',
          '',
          '',
          '')";

        $inseriu = $db->pdo->exec($insert);
    }

    $query = $db->update('tb_utilizacao_contagem', 'tb_utilizacao_contagem_id_enriquecimento', $fetch[$cont]['tb_utilizacao_contagem_id_enriquecimento'], array(
        'tb_utilizacao_contagem_contabilizado' => '1'));

    echo "Atualizando enriquecimento" . $fetch[$cont]['tb_utilizacao_contagem_id_enriquecimento'] . "<br>";
}

if (!$inseriu) {
    echo "--> Nada para atualizar ".date('d-m-y h:m:s');
}