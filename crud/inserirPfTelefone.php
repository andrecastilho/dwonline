<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar novo Telefone PF</p>
        <form method="post" action="inserirPfTelefone.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_fones_cpf">CPF</label>
                <input type="text" class="form-control"   id="tb_pessoa_fisica_fones_cpf" name="tb_pessoa_fisica_fones_cpf" placeholder="CPF "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_fones_ddd">DDD</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_fones_ddd" placeholder="DDD "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_fones_fone">Fone</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_fones_fone" placeholder="Fone "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_fones_tipo">Tipo</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_fones_tipo" placeholder="Tipo = 1 = Fixo , 2 = Celular "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_fones_operadora">Operadora</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_fones_operadora" placeholder="Operadora"/>
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

$data = date('Ymd');



$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_fisica_fones`
(`idtb_pessoa_fisica_fones`,
`tb_pessoa_fisica_fones_cpf`,
`tb_pessoa_fisica_fones_ddd`,
`tb_pessoa_fisica_fones_fone`,
`tb_pessoa_fisica_fones_tipo`,
`tb_pessoa_fisica_fones_operadora`,
`tb_pessoa_fisica_fones_procon`,
`tb_pessoa_fisica_fones_data`)
VALUES
('',
'" . $_POST['tb_pessoa_fisica_fones_cpf'] . "',
'" . $_POST['tb_pessoa_fisica_fones_ddd'] . "',
'" . $_POST['tb_pessoa_fisica_fones_fone'] . "',
'" . $_POST['tb_pessoa_fisica_fones_tipo'] . "',
'" . $_POST['tb_pessoa_fisica_fones_operadora'] . "',
'" . $_POST['tb_pessoa_fisica_fones_procon'] . "',
'" . $data . "')";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_fisica_fones_cpf'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}





