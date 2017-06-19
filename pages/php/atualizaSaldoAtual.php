<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$filtro = "update tb_credito_atual as ca

left join tb_empresa em on

    em.tb_empresa_cnpj = ca.tb_credito_atual_cnpj
set
    ca.tb_credito_atual_saldo = em.tb_empresa_qtd_contratada
                                        ";
try {
    $db_retorno = $db->query($filtro);
} catch (PDOException $e) {
    echo $e->getMessage();
}

