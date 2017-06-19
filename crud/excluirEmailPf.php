<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <div class="register-box-body">
        <p class="login-box-msg">Atualizar PF</p>

        <div class="form-group has-feedback">
            <label for="tb_pessoa_fisica_cpf">CPF</label>
            <input type="text" class="form-control"   id="tb_pessoa_fisica_cpf" name="tb_pessoa_fisica_cpf" placeholder="CPF "/>
            <span class="glyphicon glyphicon-search  form-control-feedback"></span>
        </div>
        <div class="col-xs-2" style="float: right;" >
            <button   id="buscarCrudExcluirEmailPf" class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Buscar</button>
        </div>
        <br>


        <form method="post" action="excluirEmailPf.php" id="meuForm">

            <div id="emails"></div>


        </form>
    </div>
</div>
<!-- jQuery 2.1.3 -->
<script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="../dist/js/functions.js" type="text/javascript"></script>
<script src="dir/funcCrud.js" type="text/javascript"></script>

<?php

if ($_GET['email']) {
    require_once '../../classes/class-TutsupDB.php';

    $db = new TutsupDB();

    $idEmail = $db->anti_injection($_GET['email']);

    $sql = "DELETE FROM tb_pessoa_fisica_email where idtb_pessoa_fisica_email = $idEmail";

//if ($dataAniversario != null) {

    $db_retorno = $db->query($sql);

//$fetch_user = $db_retorno->fetchAll();
//print_r($db->query($sql));

    if ($db_retorno) {

        echo "Cadastro  alterado com sucesso !!";
    }
}
