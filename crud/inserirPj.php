<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Pj</p>
        <form method="post" action="inserirPj.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_cnpj">CNPJ</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_cnpj" placeholder="CNPJ "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_nome">Nome Empresa</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_nome" placeholder="Nome Empresa"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_fantasia">Fantasia  Empresa</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_fantasia" placeholder="Fantasia Empresa"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_matriz">Matriz</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_matriz" placeholder="Matriz =M  ou Filial= F"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_data_nascimento">Data abertura</label>
                <input type="date" class="form-control"   name="tb_pessoa_juridica_data_nascimento" placeholder="Data abertura"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_qtd_empregados">Qtd. Empregados</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_qtd_empregados" placeholder="Qtd. Empregados"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_id_natureza">Id Natureza</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_id_natureza" placeholder="Id Natureza"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_cnae">Cnae</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_cnae" placeholder="Cnae"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_porte">Porte</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_porte" placeholder="Porte"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="col-xs-2">
                <button   type="submit" class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">ENVIAR</button>
            </div>

        </form>
    </div>
</div>

<!-- jQuery 2.1.3 -->
<script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="../dist/js/functions.js" type="text/javascript"></script>

<?php
require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();
$data = str_replace("-", "", $_POST['tb_pessoa_juridica_data_nascimento']);

$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_juridica`
(`idtb_pessoa_juridica`,
`tb_pessoa_juridica_cnpj`,
`tb_pessoa_juridica_nome`,
`tb_pessoa_juridica_fantasia`,
`tb_pessoa_juridica_matriz`,
`tb_pessoa_juridica_data_nascimento`,
`tb_pessoa_juridica_qtd_empregados`,
`tb_pessoa_juridica_cnae`,
`tb_pessoa_juridica_id_natureza`,
`tb_pessoa_juridica_porte`)
VALUES
('',
'" . $_POST['tb_pessoa_juridica_cnpj'] . "',
'" . $_POST['tb_pessoa_juridica_nome'] . "',
'" . $_POST['tb_pessoa_juridica_fantasia'] . "',
'" . $_POST['tb_pessoa_juridica_matriz'] . "',
'" . $data . "',
'" . $_POST['tb_pessoa_juridica_qtd_empregados'] . "',
'" . $_POST['tb_pessoa_juridica_cnae'] . "',
'" . $_POST['tb_pessoa_juridica_id_natureza'] . "',
'" . $_POST['tb_pessoa_juridica_porte'] . "')";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_juridica_cnpj'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}





