<?php

/**
 * Classe
 *
 * @package DataWeb
 * @since 0.1
 */
class ProfileModel {

    public $db;
    public $form_msg;

    /**
     * Construtor
     * 
     * Carrega  o DB.
     *
     * @since 0.1
     * @access public
     */
    public function __construct($db = false) {
        $this->db = new TutsupDB();
    }

    public function atualizaSenhaUser($user) {

        // Verifica se algo foi postado
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {


            $postOk = ($_POST);
            //$postOk = $this->db->anti_injection($_POST);
            // Faz o loop dos dados do post
            foreach ($postOk as $key => $value) {

                // Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            }


            if ($this->form_data['tb_usuario_senha'] == $this->form_data['confirma_password']) {
                // Verifica se o usuário existe
                $db_check_user = $this->db->query("UPDATE `tb_usuario` SET tb_usuario_password = '" . md5($this->form_data['tb_usuario_senha']) . "' WHERE `idtb_usuario` = ?", array($user));

                if (!$db_check_user) {

                    $this->form_msg = "Erro: Entrar em contato com administrador";
                    echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
                } else {

                    $this->form_msg = '<p class="form_success">Cadastro atualizado com sucesso .</p>';
                    echo "<div style='text-align:center;' class='alert alert-success' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
                }
                //var_dump($db_check_user);
            } else {
                $this->form_msg = "Senhas devem ser iguais";
                echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
            }
        } else {
            $this->form_msg = "Digite um CNPJ";
            // Termina se nada foi enviado
            return;
        }
    }

}
