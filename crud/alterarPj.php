<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <div class="register-box-body">
        <p class="login-box-msg">Atualizar PJ</p>

        <div class="form-group has-feedback">
            <label for="tb_pessoa_juridica_cnpjBusca">CNPJ</label>
            <input type="text" class="form-control"   id="tb_pessoa_juridica_cnpjBusca" name="tb_pessoa_juridica_cnpjBusca" placeholder="CNPJ "/>
            <span class="glyphicon glyphicon-search  form-control-feedback"></span>
        </div>
        <div class="col-xs-2" style="float: right;" >
            <button   id="buscarCrudPj" class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Buscar</button>
        </div>
        <br>
        <hr>
        <form method="post" action="alterarPj.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_cnpj">CNPJ</label>
                <input type="text" class="form-control"   id="tb_pessoa_juridica_cnpj" name="tb_pessoa_juridica_cnpj" placeholder="CNPJ "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_nome">Nome</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_nome" id="tb_pessoa_juridica_nome" placeholder="Nome "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_fantasia">Fantasia</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_fantasia" id="tb_pessoa_juridica_fantasia" placeholder="Fantasia "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_matriz">Matriz</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_matriz" id="tb_pessoa_juridica_matriz" placeholder="M OU F "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_data_nascimento">DATA Abertura </label>
                <input type="date" class=""   name="tb_pessoa_juridica_data_nascimento" id="tb_pessoa_juridica_data_nascimento" placeholder="DATA NASCIMENTO"/>
                <span class="glyphicon glyphicon-calendar  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_qtd_empregados">Qtd. Empregados</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_qtd_empregados" id="tb_pessoa_juridica_qtd_empregados" placeholder="Qtd. Empregados "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_cnae">CNAE</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_cnae" id="tb_pessoa_juridica_cnae" placeholder="CNAE "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_id_natureza">ID Natureza</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_id_natureza" id="tb_pessoa_juridica_id_natureza" placeholder="ID Natureza "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_porte">Porte</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_porte" id="tb_pessoa_juridica_porte" placeholder="Porte "/>
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
<script src="dir/funcCrud.js" type="text/javascript"></script>

<?php
require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$dataAniversario = str_replace('-', '', $_POST['tb_pessoa_juridica_data_nascimento']);

$sql = "UPDATE `dataWebProducao`.`tb_pessoa_juridica`
SET
`tb_pessoa_juridica_nome` = '" . $_POST['tb_pessoa_juridica_nome'] . "',
`tb_pessoa_juridica_fantasia` = '" . $_POST['tb_pessoa_juridica_fantasia'] . "',
`tb_pessoa_juridica_matriz` = '" . $_POST['tb_pessoa_juridica_matriz'] . "',
`tb_pessoa_juridica_data_nascimento` = '" . $dataAniversario . "',
`tb_pessoa_juridica_qtd_empregados` = '" . $_POST['tb_pessoa_juridica_qtd_empregados'] . "',
`tb_pessoa_juridica_cnae` = '" . $_POST['tb_pessoa_juridica_cnae'] . "',
`tb_pessoa_juridica_id_natureza` = '" . $_POST['tb_pessoa_juridica_id_natureza'] . "',
`tb_pessoa_juridica_porte` = '" . $_POST['tb_pessoa_juridica_porte'] . "'
WHERE `tb_pessoa_juridica_cnpj` = '" . $_POST['tb_pessoa_juridica_cnpj'] . "';
";

//if ($dataAniversario != null) {

$db_retorno = $db->query($sql);

//$fetch_user = $db_retorno->fetchAll();
//print_r($db->query($sql));

if ($_POST['tb_pessoa_juridica_nome'] != null) {

    echo "Cadastro  alterado com sucesso !!";
}
//}
