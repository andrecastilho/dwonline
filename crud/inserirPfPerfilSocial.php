<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Perfil Socio Demográfico</p>
        <form method="post" action="inserirPfPerfilSocial.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_social_cpf">Cpf</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_social_cpf" placeholder="Cpf"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_social_id_cbo">Id Cbo</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_social_id_cbo" placeholder="Id Cbo "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_social_renda_estimada">Renda Estimada</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_social_renda_estimada" placeholder="Renda Estimada "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_social_escolaridade">Escolaridade</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_social_escolaridade" placeholder="Escolaridade "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_social_classe_social">Classe Social</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_social_classe_social" placeholder="Classe Social"/>
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

$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_fisica_social`
(`idtb_pessoa_fisica_social`,
`tb_pessoa_fisica_social_cpf`,
`tb_pessoa_fisica_social_id_cbo`,
`tb_pessoa_fisica_social_renda_estimada`,
`tb_pessoa_fisica_social_escolaridade`,
`tb_pessoa_fisica_social_classe_social`,
`tb_pessoa_fisica_social_data`)
VALUES
('',
'" . $_POST['tb_pessoa_fisica_social_cpf'] . "',
'" . $_POST['tb_pessoa_fisica_social_id_cbo'] . "', 
'" . $_POST['tb_pessoa_fisica_social_renda_estimada'] . "',
'" . $_POST['tb_pessoa_fisica_social_escolaridade'] . "',
'" . $_POST['tb_pessoa_fisica_social_classe_social'] . "',
'" . $data . "'
        )";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_fisica_social_cpf'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}











