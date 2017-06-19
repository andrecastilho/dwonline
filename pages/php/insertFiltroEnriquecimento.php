<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$idtbEnriquecimentoExtracao = $db->anti_injection($_GET['idtbEnriquecimento']);
$nomeCampo = $db->anti_injection($_GET['nomeCampo']);
$desejado = $db->anti_injection($_GET['desejado']);
$obrigatorio = $db->anti_injection($_GET['obrigatorio']);
$filtro = $_GET['filtro'];
$extracao = $db->anti_injection($_GET['extracao']);

$data_array = array('', // idtb_utilizacao_sistema
    $db->anti_injection($idtbEnriquecimentoExtracao),
    $db->anti_injection($nomeCampo),
    $db->anti_injection($desejado),
    $db->anti_injection($obrigatorio),
    $filtro,
);


if ($extracao == 'extracao') {

    $insert = "INSERT INTO `dataWebProducao`.`tb_extracao_filtros`
(`idtb_extracao_filtros`,
`tb_extracao_filtros_idtb_extracao`,
`tb_extracao_filtros_nome_campo`,
`tb_extracao_filtros_desejado`,
`tb_extracao_filtros_obrigatorio`,
`tb_extracao_filtros_filtro`)
VALUES
(?,?,?,?,?,?);";
} else {

    $insert = "INSERT INTO `dataWebProducao`.`tb_enriquecimento_filtros`
(`idtb_enriquecimento_filtros`,
`tb_enriquecimento_filtros_idtb_enriquecimento`,
`tb_enriquecimento_filtros_nome_campo`,
`tb_enriquecimento_filtros_desejado`,
`tb_enriquecimento_filtros_obrigatorio`,
`tb_enriquecimento_filtros_filtro`)
VALUES
(?,?,?,?,?,?);";
}

$query = $db->pdo->prepare($insert);

if (!$query) {

    return false;
}

$check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu

if ($check_exec && $filtro = 'Atualizar') {
    
    if ($extracao == 'extracao') {

        $query = $db->update('tb_extracao', 'idtb_extracao', $idtbEnriquecimentoExtracao, array(
            'tb_extracao_filtro' => '1',
        ));
    } else {
        $query = $db->update('tb_enriquecimento', 'idtb_enriquecimento', $idtbEnriquecimentoExtracao, array(
            'tb_enriquecimento_filtro' => '1',
        ));
    }
    $db->fecharConexao();

    return (var_dump($check_exec));
}


