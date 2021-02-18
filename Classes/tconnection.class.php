<?php

/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * Gerencia as conexões com o BD por meio do arquivo de confiração.
 * 
 * Foi implementada para ser usada nas transações que envolvem diversos objetos 
 * ADO. Mas, pode ser utilizada sempre que necessário uma conexão à parte da 
 * ADO.
 * 
 * Esta clase foi baseada no exemplo do livro PHP: Programando com Orientação a 
 * Objetos do Pablo Dall'Oglio (p. 202-203).
 * 
 * @date 08/02/2012
 * 
 * @author Elymar Pereira Cabral <elymar.cabral@ifg.edu.br>
 */
final class TConnection {

    /**
     * Não devem existir instâncias de TConnection, por isso o construtor foi
     * marcado como private p/ previnir que algum desavisado tente instanciá-la.
     */
    private function __construct() {
        //vazio
    }

    public static function open() {
        //inicia variáveis locais da conexão
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $confUTF8 = "charset=utf8";

        //recupera valores do BD
        $bdNome = "MinhaPousada";

        //recupera as informações do arquivo
        $host = "localhost";
        $usuario = "root";
        $senha = "@Aristeu123";

        $conexao = new PDO("mysql:host={$host};dbname={$bdNome};{$confUTF8}", $usuario, $senha, $options);

        //determina lançamento de exceções na ocorrência de erros
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conexao;
    }

}
