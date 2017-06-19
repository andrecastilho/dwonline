<?php

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class BuscaDocModel {

    /**
     * $form_data
     *
     * Os dados do formulário de envio.
     *
     * @access public
     */
    public $form_data;

    /**
     * $form_msg
     *
     * As mensagens de feedback para o usuário.
     *
     * @access public
     */
    public $form_msg;
    public $option;

    /**
     * $db
     *
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;
    public $qtd_user_utilizado_cnpj;

    /**
     * Construtor
     * 
     * Carrega  o DB.
     *
     * @since 0.1
     * @access public
     */
    public function __construct($db = false) {
        $this->db = $db;


        if ($_SESSION['userdata']['tb_usuario_id_perfil'] == '1') { //SISTEMA DM
            $vendedor = "<div class='form-group has-feedback'>" .
                    "<label for='tb_usuario_e_vendedor'>É vendedor ?</label>" .
                    "<input type='checkbox'  name='tb_usuario_e_vendedor'class='minimal' checked/>" .
                    "</div>";

            $this->option = '         <option value="1">Sistema - DM</option>
                        <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] == '2') {//MASTER DM
            $this->option = '         <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] == '3') {//MASTER DM
            $this->option = '         <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] > '2') {

            $this->option = '<option value="4">Operacional - Empresa</option>';
        }

        //busca quantidade de utuarios utilizados pela empresa
        $db_check_qtd_user_cnpj = $this->db->query(
                'SELECT count(*) as contador FROM tb_usuario where tb_usuario_cnpj_empresa= ?', array($_SESSION['userdata']['tb_empresa_cnpj'])
        );

        // Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_qtd_user_cnpj->fetch();
        // Configura o ID do usuário
        $this->qtd_user_utilizado_cnpj = $fetch_user['contador'];
    }

    /**
     * Valida o formulário de envio
     * 
     * Este método pode inserir ou atualizar dados dependendo do campo de
     * usuário.
     *
     * @since 0.1
     * @access public
     */
    public function validate_register_form() {

        // Configura os dados do formulário
        $this->form_data = array();

        // Verifica se algo foi postado
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {

            $postOk = $_POST;

            // Faz o loop dos dados do post
            foreach ($postOk as $key => $value) {

                // Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;

                // Nós não permitiremos nenhum campos em branco
            }
        }


        // Verifica se o usuário existe
        $db_check_user = $this->db->query(
                'SELECT * FROM `tb_usuario` WHERE `tb_usuario_username_email` = ?', array(
            chk_array($this->form_data, 'tb_usuario_username_email'))
        );

        // Verifica se a consulta foi realizada com sucesso
        if (!$db_check_user) {
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
            //return;
        }

        // Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_user->fetch();

        // Configura o ID do usuário
        $user_id = $fetch_user['tb_usuario_username_email'];


        //Verifica se empresa existe
        $db_check_user_empresa = $this->db->query(
                'SELECT * FROM `tb_empresa` WHERE `tb_empresa_cnpj` = ?', array(
            chk_array($this->form_data, 'tb_usuario_cnpj_empresa'))
        );
        if (!$db_check_user) {
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
            //return;
        }



        $fetch_user_empresa = $db_check_user_empresa->fetch();
        $user_empresa = $fetch_user_empresa['tb_empresa_cnpj'];

        // Cria o hash da senha
        $password = md5($this->form_data['tb_usuario_senha']);



        // Se o ID do usuário não estiver vazio, atualiza os dados
        if (!empty($user_id)) {


            if ($this->form_data['tb_usuario_senha'] != $this->form_data['confirma_password']) {
                $this->form_msg = "Senhas devem ser iguais";
                echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
                //exit();
            } else {
                // Executa a consulta 
                $query = $this->db->update('tb_usuario', 'tb_usuario_username_email', $user_id, array(
                    'tb_usuario_cpf' => chk_array($this->form_data, 'tb_usuario_cpf_tb_usuario'),
                    'tb_usuario_cnpj_empresa' => chk_array($this->form_data, 'tb_usuario_cnpj_empresa'),
                    'tb_usuario_password' => $password,
                    'tb_usuario_nome' => chk_array($this->form_data, 'tb_usuario_nome'),
                    'tb_usuario_id_perfil' => chk_array($this->form_data, 'tb_usuario_id_perfil'),
                    'tb_usuario_username_email' => chk_array($this->form_data, 'tb_usuario_username_email'),
                    'tb_usuario_validade' => chk_array($this->form_data, 'tb_usuario_validade'),
                    'tb_usuario_ativo' => chk_array($this->form_data, 'tb_usuario_ativo'),
                    'tb_usuario_e_vendedor' => chk_array($this->form_data, 'tb_usuario_e_vendedor'),
                ));

                // Verifica se a consulta está OK e configura a mensagem
                if (!$query) {
                    $this->form_msg = '<p class="form_error">Erro ao atualizar.Impossível mudar cnpj .</p>';
                    echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";

                    // Termina
                    //return;
                } else {
                    $this->form_msg = '<p class="form_success">Cadastro atualizado com sucesso .</p>';
                    echo "<div style='text-align:center;' class='alert alert-success' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";

                    // Termina
                    //return;
                }
            }
        }
    }

// validate_register_form

    /**
     * Obtém os dados do formulário
     * 
     * Obtém os dados para usuários registrados
     *
     * @since 0.1
     * @access public
     */
    public function get_register_form($user_id = false) {

        // O ID de usuário que vamos pesquisar
        $s_user_id = false;

        // Verifica se você enviou algum ID para o método
        if (!empty($user_id)) {
            $s_user_id = (int) $user_id;
        }

        // Verifica se existe um ID de usuário
        if (empty($s_user_id)) {
            return;
        }

        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `tb_usuario` WHERE `user_id` = ?', array($s_user_id));

        // Verifica a consulta
        if (!$query) {
            $this->form_msg = '<p class="form_error">Usuário não existe.</p>';
            return;
        }

        // Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

        // Verifica se os dados da consulta estão vazios
        if (empty($fetch_userdata)) {
            $this->form_msg = '<p class="form_error">User do not exists.</p>';
            return;
        }

        // Configura os dados do formulário
        foreach ($fetch_userdata as $key => $value) {
            $this->form_data[$key] = $value;
        }

        // Por questões de segurança, a senha só poderá ser atualizada
        $this->form_data['user_password'] = null;

        // Remove a serialização das permissões
        $this->form_data['user_permissions'] = unserialize($this->form_data['user_permissions']);

        // Separa as permissões por vírgula
        $this->form_data['user_permissions'] = implode(',', $this->form_data['user_permissions']);
    }

// get_register_form

    /**
     * Apaga usuários
     * 
     * @since 0.1
     * @access public
     */
    public function del_user($parametros = array()) {

        // O ID do usuário
        $user_id = null;

        // Verifica se existe o parâmetro "del" na URL
        if (chk_array($parametros, 0) == 'del') {

            // Mostra uma mensagem de confirmação
            echo '<p class="alert">Tem certeza que deseja apagar este valor?</p>';
            echo '<p><a href="' . $_SERVER['REQUEST_URI'] . '/confirma">Sim</a> | 
			<a href="' . HOME_URI . '/user-register">Não</a> </p>';

            // Verifica se o valor do parâmetro é um número
            if (
                    is_numeric(chk_array($parametros, 1)) && chk_array($parametros, 2) == 'confirma'
            ) {
                // Configura o ID do usuário a ser apagado
                $user_id = chk_array($parametros, 1);
            }
        }

        // Verifica se o ID não está vazio
        if (!empty($user_id)) {

            // O ID precisa ser inteiro
            $user_id = (int) $user_id;

            // Deleta o usuário
            $query = $this->db->delete('tb_usuario', 'user_id', $user_id);

            // Redireciona para a página de registros
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/user-register/">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
            return;
        }
    }

// del_user

    /**
     * Obtém a lista de usuários
     * 
     * @since 0.1
     * @access public
     */
    public function get_user_list() {

        // Simplesmente seleciona os dados na base de dados 
        $query = $this->db->query('SELECT * FROM `tb_usuario` ORDER BY user_id DESC');

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Preenche a tabela com os dados do usuário
        return $query->fetchAll();
    }

    
}
