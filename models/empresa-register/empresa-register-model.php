<?php

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class EmpresaRegisterModel {

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

    /**
     * $db
     *
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;

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


            $postOk = ($_POST);
            //$postOk = $this->db->anti_injection($_POST);
            
            // Faz o loop dos dados do post
            foreach ($postOk as $key => $value) {

                // Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            }
        } else {
            $this->form_msg = "Digite um CNPJ";
            // Termina se nada foi enviado
            return;
        }

        // Verifica se o usuário existe
        $db_check_user = $this->db->query(
                'SELECT * FROM `tb_empresa` WHERE `tb_empresa_cnpj` = ?', array(
            chk_array($this->form_data, 'tb_empresa_cnpj_envio')
                )
        );

        $fetch_user = $db_check_user->fetch();
        // Verifica se a consulta foi realizada com sucesso
        // Obtém os dados da base de dados MySQL
        // Configura o ID do usuário
        $empresa_id = $fetch_user['tb_empresa_cnpj'];


        if (!empty($this->form_msg)) {
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
            return;
        }

        // Se o ID do usuário não estiver vazio, atualiza os dados
        if (!empty($empresa_id)) {

            $this->form_msg = "<p class='form_error'>Empresa já Cadastrada</p>";
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";
            //exit();
            /*
              $query = $this->db->update('tb_empresa', 'tb_empresa', $empresa_id, array(
              'user_password' => $password,
              'user_name' => chk_array( $this->form_data, 'user_name'),
              'user_session_id' => md5(time()),
              'user_permissions' => $permissions,
              ));

              // Verifica se a consulta está OK e configura a mensagem
              if ( ! $query ) {
              $this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

              // Termina
              return;
              } else {
              $this->form_msg = '<p class="form_success">User successfully updated.</p>';

              // Termina
              return;
              }
             * 
             */
            // Se o ID do usuário estiver vazio, insere os dados
        } else {


            // Executa a consulta 
            $query = $this->db->insert('tb_empresa', array(
                'tb_empresa_cnpj' => chk_array($this->form_data, 'tb_empresa_cnpj_envio'),
                'tb_empresa_matriz' => chk_array($this->form_data, 'tb_empresa_matriz'),
                'tb_empresa_nome' => chk_array($this->form_data, 'tb_empresa_nome'),
                'tb_empresa_fantasia' => chk_array($this->form_data, 'tb_empresa_fantasia'),
                'tb_empresa_numero_empregados' => chk_array($this->form_data, 'tb_empresa_numero_empregados'),
                'tb_empresa_endereco' => chk_array($this->form_data, 'tb_empresa_endereco'),
                'tb_empresa_numero' => chk_array($this->form_data, 'tb_empresa_numero'),
                'tb_empresa_complemento' => chk_array($this->form_data, 'tb_empresa_complemento'),
                'tb_empresa_cep' => chk_array($this->form_data, 'tb_empresa_cep'),
                'tb_empresa_bairro' => chk_array($this->form_data, 'tb_empresa_bairro'),
                'tb_empresa_cidade' => chk_array($this->form_data, 'tb_empresa_cidade'),
                'tb_empresa_uf' => chk_array($this->form_data, 'tb_empresa_uf'),
                'tb_empresa_id_vendedor' => chk_array($this->form_data, 'tb_empresa_id_vendedor'),
                'tb_empresa_data_cadastro' => date('d/m/Y'),
                'tb_empresa_webservice' => chk_array($this->form_data, 'webservice'),
                'tb_empresa_online' => chk_array($this->form_data, 'online'),
                'tb_empresa_enriquecimento' => chk_array($this->form_data, 'enriquecimento'),
                'tb_empresa_valor_pacote' => chk_array($this->form_data, 'tb_empresa_valor_pacote'),
                'tb_empresa_qtd_contratada' => chk_array($this->form_data, 'tb_empresa_qtd_contratada'),
                'tb_empresa_valor_unitario' => chk_array($this->form_data, 'tb_empresa_valor_unitario'),
                'tb_empresa_qtd_usuarios' => chk_array($this->form_data, 'tb_empresa_qtd_usuarios'),
                'tb_empresa_unitario_execedente' => chk_array($this->form_data, 'tb_empresa_unitario_execedente'),
                'tb_empresa_permite_excedente' => chk_array($this->form_data, 'tb_empresa_permite_excedente'),
                'tb_empresa_codigo_web_service' => chk_array($this->form_data, 'codigo_web_service'),
                
                
            ));
            
            // atualiza tabela de saldo atual
            
             $query = $this->db->insert('tb_credito_atual', array(
                'tb_credito_atual_cnpj' => chk_array($this->form_data, 'tb_empresa_cnpj_envio'),
                'tb_credito_atual_saldo' => str_replace(",",".",chk_array($this->form_data, 'tb_empresa_valor_pacote')),
            ));
             
                $query = $this->db->insert('tb_credito_custo_empresa_produtos', array(
                'tb_credito_custo_empresa_produtos_cnpj' => str_replace(",",".",chk_array($this->form_data, 'tb_empresa_cnpj_envio')),
                'tb_credito_custo_empresa_produtos_web_service' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_web_service')),
                'tb_credito_custo_empresa_produtos_online' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_online')),
                'tb_credito_custo_empresa_produtos_enriquecimento' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_enriquecimento')),
                'tb_credito_custo_empresa_produtos_cnf_simples' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_cnf_simples')),
                    'tb_credito_custo_empresa_produtos_cnf_detalhado' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_cnf_detalhado')),
                    'tb_credito_custo_empresa_produtos_extracao' => str_replace(",",".",chk_array($this->form_data, 'tb_credito_custo_empresa_produtos_extracao')),
                    'tb_credito_custo_empresa_produtos_data' => time(),
            ));
        
          

            // Verifica se a consulta está OK e configura a mensagem
            //print_r($query);
            //die(">>");
            if (!$query) {
                $this->form_msg = '<p class="form_error">Erro interno. Cadastro não efetuado.</p>Erro = ' . $query;
                echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
              <span class='sr-only'>Error:</span>
              $this->form_msg
              </div>";

                // Termina
                //return;
            } else {
                $this->form_msg = '<p class="form_success">Cadastro efetuado com sucesso.</p>';
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
        $query = $this->db->query('SELECT * FROM `tb_empresa` WHERE `tb_empresa_cnpj` = ?', array($s_user_id));


        // Verifica a consulta
        if (!$query) {
            $this->form_msg = '<p class="form_error">Empresa não existe.</p>';
            return;
        }

        // Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

        // Verifica se os dados da consulta estão vazios
        if (empty($fetch_userdata)) {
            $this->form_msg = '<p class="form_error">Empresa não existe.</p>';
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
            $query = $this->db->delete('tb_usuario', 'tb_usuario_cpf', $user_id);

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
        $query = $this->db->query('SELECT * FROM `tb_usuario` ORDER BY tb_usuario_cpf DESC');

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Preenche a tabela com os dados do usuário
        return $query->fetchAll();
    }

// get_user_list
}
