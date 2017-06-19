<?php

/**
 *
 * @author 
 * 
 *
 */
require '../classes/class-TutsupDB.php';

class Crud extends TutsupDB {

    public $conect;

    public function __construct() {

        $this->conect = new TutsupDB();
    }

    function pegarPrimaria($tabela) {

        // $keys = Array ();
        $queryChave = sprintf("SHOW KEYS FROM `%s`", $tabela);
        $resultChave = $this->conect->query($queryChave);

        while ($rowChave = $resultChave->fetchAll()) {
            if ($rowChave ['Key_name'] == 'PRIMARY') {
                $chavePrimaria = $rowChave ['Column_name'];
            }
        }

        return $chavePrimaria;
    }

    public function AntiInjection($param) {
        $param = strip_tags($param); // retirar as tags html

        $param = mysql_escape_string($param); // Retirar todas tags referentes
        // do
        // mysql ex: select, insert,
        // update drop
        // etc...

        return $param;
    }

    public function retornarCamposTabela($tabela) {
        $campos = array();

        $result = mysql_query("SHOW COLUMNS FROM " . $tabela); // descobrir os
        // campos da
        // tabela
        while ($campo = mysql_fetch_assoc($result)) {
            $campos [] = $campo ['Field'];
        }
        unset($campos [0]); // retirar o primeiro campo da lista
        // listar os dados do array
        /*
         * foreach ( $campos as $valores ) { echo $valores . "<br>"; }
         */
        // retorna um array com todos os campos da tabel menos o primeiro(id)
        return $campos;
    }

    public function inserir($table, $array) {
        
        $insert = "INSERT INTO " . $table;

        $columns = $this->retornarCamposTabela($table);
        $data = array();

        foreach ($array as $key => $value) {

            if ($value != "") {
                $data [] = "'" . $value . "'";
            } else {
                $data [] = "NULL";
            }
        }

        $cols = implode(",", $columns);
        $values = implode(",", $data);

        $sql = $insert . " (" . $cols . ") " . " VALUES " . " (" . $values . ") ";
        $this->query($sql);
    }

    public function listar($nomeDaTabela) {

        $chavePrimaria0 = $this->pegarPrimaria($nomeDaTabela);

        $result = $this->conect->query("SHOW COLUMNS FROM " . $nomeDaTabela);

        //print_r($result->fetchAll());
        //die(".");

        $z = 0;
        while ($row = $result->fetchAll()) {

            echo '		<td>';
            $nome = $row[$z] ['Field'];
            $tipo = $row [$z]['Type'];

            echo "<strong>" . $nome . "</strong>";
            $z ++;

            echo '		</td>';
        }

        echo '	</tr>';

        $totalDeCampos = $result->fetchAll(); // total de campos da tabela
        
        

        $lista = $this->conect->query("select * from " . $nomeDaTabela . " LIMIT 100");


        echo "<pre>";
        print_r($lista->fetchAll());
        echo "</pre>";
        
    }

    public function apagar($tabela, $id) {
        $chavePrimaria = $this->pegarPrimaria($tabela);
        echo $chavePrimaria;
        $queryApagar = "DELETE FROM " . $tabela . " where " . $chavePrimaria . " = " . $id;
        $this->query($queryApagar);
    }

   
}
