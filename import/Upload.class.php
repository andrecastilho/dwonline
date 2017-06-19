<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */


include_once '../classes/class-TutsupDB.php';

class Upload {

    public $uploadArquivo;
    protected $db;

    function __construct() {

        $this->db = new TutsupDB();
    }

    function Upload($post) {

        $this->uploadArquivo = new Upload();

        session_start();
        $pastaUpload = './' . $_SESSION['userdata']['tb_usuario_cnpj_empresa'] . "/";
        // Pasta onde o arquivo vai ser salvo
        if (file_exists($pastaUpload)) {

            $_UP['pasta'] = $pastaUpload;
        } else {

            $cridou = mkdir("$pastaUpload", 0777); // Cria uma nova pasta dentro do diretório atual
            if (!$cridou) {
                echo "Pasta não criada";
                die("Erro");
            }
            $_UP['pasta'] = $pastaUpload;
        }


// Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 40; // 10Mb
// Array com as extensões permitidas
        //$_UP['extensoes'] = array('csv', 'txt');
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            //die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
            //exit; // Para a execução do script
        }

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
        /*
          $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
          if (array_search($extensao, $_UP['extensoes']) === false) {
          echo "Por favor, envie arquivos com as seguintes extensões: txt,csv";
          exit;
          }
         * 
         */

// Faz a verificação do tamanho do arquivo

        if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
            echo "O arquivo enviado é muito grande, envie arquivos de até 40Mb.";
            exit;
        }


// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
// Primeiro verifica se deve trocar o nome do arquivo

        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()) . '.jpg';
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }

        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo

            echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a><br>';

            $arquivo = $_UP['pasta'] . $nome_final;
            $arquivoCpf = '';
            $arquivoCnpj = '';

            chmod($_UP['pasta'] . $nome_final, 0777);

            $this->uploadArquivo->registraArquivo($arquivo, $arquivoCpf, $arquivoCnpj, $post['descricao']);

            echo "Registrado<br> Arquivo " . $arquivo;
        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            //die(".."); 
            echo "Não foi possível enviar o arquivo, tente novamente";
            die("Erro");
        }
    }

    public function registraArquivo($arquivoEnviado, $arquivoCpf, $arquivoCnpj, $descricao) {

        $data_array = array('',
            $this->db->anti_injection($_SESSION['userdata']['tb_usuario_cnpj_empresa']),
            $this->db->anti_injection($_SESSION['userdata']['tb_usuario_username_email']),
            $this->db->anti_injection($arquivoEnviado),
            $this->db->anti_injection($descricao),
            $this->db->anti_injection($arquivoCpf),
            $this->db->anti_injection($arquivoCnpj),
            time("d/m/Y G:i:s"),
            'desenv');


        $insert = "INSERT INTO `dataWebProducao`.`tb_enriquecimento`
                    (`idtb_enriquecimento`,
                    `tb_enriquecimento_empresa_envio`,
                    `tb_enriquecimento_user_envio`,
                    `tb_enriquecimento_arquivo_enviado`,
                    `tb_enriquecimento_descricao`,
                    `tb_enriquecimento_arquivo_cpf`,
                    `tb_enriquecimento_arquivo_cnpj`,
                    `tb_enriquecimento_data_envio`,
                     `tb_enriquecimento_ambiente`)
                    VALUES
                    (?,?,?,?,?,?,?,?,?)";

        $query = $this->db->pdo->prepare($insert);

        if (!$query) {

            return false;
        }

        $check_exec = $query->execute($data_array);
        // Verifica se a consulta aconteceu
        if (!$check_exec) {

            // Configura o erro
            $error = $query->errorInfo();
            print_r($error);
            $this->error = $error[2];

            // Retorna falso
            return false;
        }
    }

}

?>