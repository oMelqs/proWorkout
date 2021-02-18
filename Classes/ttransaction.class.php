
<?php

/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * Gerencia as conexões com o BD por meio do arquivo de confiração.
 * 
 * Foi implementada para ser usada nas transações que envolvem diversos objetos 
 * ADO. Quando a transação envolver apanas um objeto recomenda-se usar a 
 * transação já existente na AdoPdo.
 * 
 * Esta clase foi baseada no exemplo do livro PHP: Programando com Orientação a 
 * Objetos do Pablo Dall'Oglio (p. 208-209).
 * 
 * @date 08/02/2012
 * 
 * @author Elymar Pereira Cabral <elymar.cabral@ifg.edu.br>
 */

require_once '../Classes/tconnection.class.php';

final class TTransaction {

    private static $conexao = null;

    /**
     * Não devem existir instâncias de TTransaction, por isso o construtor foi
     * marcado como private p/ previnir que algum desavisado tente instanciá-la.
     */
    private function __construct() {
        //vazio
    }

    /**
     * Abre uma conexão quando ainda não existir.
     * @param AtributosBdAbstract $atributosBD arquivo da FSW com os atributos 
     * do BD
     * @param String $nomeDoArquivoIni Nome do arquivo ini com os dados do BD
     */
    public static function open() {
        //abre uma conexão e armazena na propriedade estática $conexao
        if (empty(self::$conexao)) {
            try {
                self::$conexao = TConnection::open();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return self::$conexao->beginTransaction();
        }
        return true;
    }

    /**
     * Recupera a conexão.
     * @return type Conexão;
     */
    public static function getConexao() {
        return self::$conexao;
    }

    /**
     * Descarta todas as operações realizadas na transação.
     */
    public static function rollback() {
        if (self::$conexao) {
            $resultado     = self::$conexao->rollback();
            self::$conexao = null;
            return $resultado;
        }
        return true;
    }

    /**
     * Aplica todas as operações realizadas na transação e fecha a conexão com o
     * BD.
     */
    public static function commit() {
        if (self::$conexao) {
            $resultado     = self::$conexao->commit();
            self::$conexao = null;
            return $resultado;
        }
        return true;
    }

    /**
     * Aliás para commit.
     * Aplica todas as operações realizadas na transação e fecha a conexão com o
     * BD.
     */
    public static function close() {
        self::commit();
    }

}
