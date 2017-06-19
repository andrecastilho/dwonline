<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <div class="register-box-body">
        <p class="login-box-msg">Registrar novo Endereço PF</p>
        <form method="post" action="inserirPfEndereco.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_cpf">CPF</label>
                <input type="text" class="form-control"   id="tb_pessoa_fisica_cpf" name="tb_pessoa_fisica_end_cpf" placeholder="CPF "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_end">Endereço</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_end_end" placeholder="Endereço "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_num">Numero</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_end_num" placeholder="Numero "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_compl">Complemento</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_end_compl" placeholder="Complemento "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_bairro">Bairro</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_end_bairro" placeholder="Bairro "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_cidade">Cidade </label>
                <input type="text" class="form-control"    name="tb_pessoa_fisica_end_cidade" placeholder="Cidade"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_uf">Uf </label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_end_uf" placeholder="Uf"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_end_cep">Cep </label>
                <input type="text" class="form-control"    name="tb_pessoa_fisica_end_cep" placeholder="Cep"/>
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



$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_fisica_end`
(`idtb_pessoa_fisica_end`,
`tb_pessoa_fisica_end_cpf`,
`tb_pessoa_fisica_end_end`,
`tb_pessoa_fisica_end_num`,
`tb_pessoa_fisica_end_compl`,
`tb_pessoa_fisica_end_bairro`,
`tb_pessoa_fisica_end_cidade`,
`tb_pessoa_fisica_end_uf`,
`tb_pessoa_fisica_end_cep`,
`tb_pessoa_fisica_end_data`)
VALUES
('',
'" . $_POST['tb_pessoa_fisica_end_cpf'] . "',
'" . $_POST['tb_pessoa_fisica_end_end'] . "',
'" . $_POST['tb_pessoa_fisica_end_num'] . "',
'" . $_POST['tb_pessoa_fisica_end_compl'] . "',
'" . $_POST['tb_pessoa_fisica_end_bairro'] . "',
'" . $_POST['tb_pessoa_fisica_end_cidade'] . "',
'" . $_POST['tb_pessoa_fisica_end_uf'] . "',
'" . $_POST['tb_pessoa_fisica_end_cep'] . "',
'" . $data . "')";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_fisica_end_cpf'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}





