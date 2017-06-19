<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <div class="register-box-body">
        <p class="login-box-msg">Registrar novo usuário PF</p>
        <form method="post" action="inserirPf.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_usuario_cnpj_empresa">CPF</label>
                <input type="text" class="form-control"   id="tb_pessoa_fisica_cpf" name="tb_pessoa_fisica_cpf" placeholder="CPF "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_usuario_nome">Nome</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_nome" placeholder="Nome "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_cpf_mae">CPF da Mãe</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_cpf_mae" placeholder="Nome "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_nome_mae">Nome da Mãe</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_nome_mae" placeholder="Nome "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_sexo">Sexo</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_sexo" placeholder="M OU F "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_data_nascimento">DATA NASCIMENTO </label>
                <input type="date" class=""   name="tb_pessoa_fisica_data_nascimento" placeholder="DATA NASCIMENTO"/>
                <span class="glyphicon glyphicon-calendar  form-control-feedback"></span>
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

$dataAniversario = str_replace('-', '', $_POST['tb_pessoa_fisica_data_nascimento']);



$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_fisica`
(`idtb_pessoa_fisica`,
`tb_pessoa_fisica_cpf`,
`tb_pessoa_fisica_nome`,
`tb_pessoa_fisica_cpf_mae`,
`tb_pessoa_fisica_nome_mae`,
`tb_pessoa_fisica_sexo`,
`tb_pessoa_fisica_data_nascimento`)

VALUES
('',
'" . $_POST['tb_pessoa_fisica_cpf'] . "',
'" . $_POST['tb_pessoa_fisica_nome'] . "',
'" . $_POST['tb_pessoa_fisica_cpf_mae'] . "',
'" . $_POST['tb_pessoa_fisica_nome_mae'] . "',
'" . $_POST['tb_pessoa_fisica_sexo'] . "',
'" . $dataAniversario . "')";

if ($dataAniversario != null) {
    $db_retorno = $db->query($sql);

    $fetch_user = $db_retorno->fetchAll();

    echo "Cadastrado com sucesso !!";
}



