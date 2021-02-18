<?php

require_once '../ADOs/Abstract/bdpdo.class.php';

abstract class AdoPdoAbstract extends BdPdo {

    private $nomeDaTabela = null;
    private $mensagens = null;

    function __construct() {
        $this->mensagens = array();
        parent::__construct();
    }

    function getMensagens() {
        return $this->mensagens;
    }

    function addMensagem($mensagem) {
        $this->mensagens [] = $mensagem;
    }

    /**
     * Monta um objeto do tipo model com os dados informados via parâmetro. O
     * parâmetro deve ser do tipo array e deve conter uma tupla da tabela lida.
     * 
     * @param Arrah $objetoBD Tupla de uma tabela recuperados do banco de dados. 
     * Precisa conter todos os dados recuperados.
     * @return ModelAbstract02 Objeto do tipo model.
     */
//    public function montaObjeto($objetoBD) {
//        // A função get_called_class() busca o nome da classe que extende esta. 
//        // Ou seja, pega o nome do ObjetoAdo (Ex.: RelatorioDeAtividadeAdo).
//        $classeAdo = get_called_class();
//
//        // Agora substitui a palavra ADO por Model no nome da classe. Esse nome será 
//        // utilizado para estanciar a classe Model do objeto desejado. 
//        // (Ex.: RelatorioDeAtividadeAdo vira RelatorioDeAtividadeModel).
//        $classeModel = str_replace("Ado", "Model", $classeAdo);
//
//        // Adiciona uma classe que precisa ser extendida. Método da ExtensionBridgeAbstract.
//        $objetoModel = new $classeModel();
//
//        foreach ($objetoBD as $nomeDaColuna => $valorDaColuna) {
//            $setAtributo = Strings::trocaNomeColunaParaSetAtributo($nomeDaColuna);
//            $objetoModel->$setAtributo($valorDaColuna);
//        }
//
//        return $objetoModel;
//    }
    public function montaObjeto($objetoBD) {
        foreach ($objetoBD as $nomeDaColuna => $valorDaColuna) {
            $setAtributo = "set" . ucfirst($nomeDaColuna);
            $this->$setAtributo($valorDaColuna);
        }
    }

    /**
     * Este métedo lê uma linha de um  determinado objeto.
     * @param type $resultado
     * @return boolean
     */
    function leObjeto() {
        $objetoBD = $this->leTabelaBD();
        if ($objetoBD) {
            $this->montaObjeto($objetoBD);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Realiza consultas chamadas pelos métodos de busca generalizando o que é comum a esses.
     * @param string $where    string com a chave para consulta. Tem que ser informada 
     *                          pois não assume nenhum valor default. 
     * @param string $orderBy  string com a estrutura order by a ser concatenada à string 
     *                          do select. Se não for informado assume null que é o mesmo 
     *                          que não ordernar.
     * @return boolean|int      Retorna FALSE qndo encontra erro ou 0 para consulta vazia 
     *                          (quantidade de linhas = 0)
     */
    //EU REFATOREI O NOME DO MÉTODO DE consulta para executaConsulta.
//    function executaConsulta($where, $orderBy = NULL) {
//        return $this->consultaObjeto($where, $orderBy);
//    }

    /**
     * @todo APAGAR ESTE MÉTODO QUANDO ATUALIZAR O SARA.
     * @param type $where
     * @param type $orderBy
     * @return type
     */
    public function consultaObjeto($where = '1', $orderBy = NULL) {
        return $this->executaConsulta($where, $orderBy);
    }

    /**
     * Implementa a consulta a tabelas como o método consultaObjeto() usando a 
     * parametrização dos valores para maior segurança, por isso exige um array 
     * com os valores para substituição no Prepare. Necessita do nome da tabela 
     * no atributo de classe $nomeDaTabela (use o método setNomeDaTabela).
     * 
     * @param type $arrayDeValoresParaPs Array com os valores a serem 
     *             substituídos pelo Prepare (PS). Têm que estar na ordem 
     *             identificada pelo ? na clásula where.
     * @param type $where String com a expressão lógica para ser montada após a
     *             cláusula where do select com ? no lugar dos valores. Não obrigatória.
     * @param type $orderBy Instrução order by completa. Não obrigatória.
     * @return int|boolean Retorna true para execução ok, false para 
     *         erro/exceção e 0 para consulta vazia.
     * @throws ExcecaoNaClasseAdo Lança essa exceção quando o nome da tabela não 
     *         está identificado no atributo da classe.
     */
    public function consultaObjetoComPs($arrayDeValoresParaPs, $where = 1, $orderBy = NULL) {

        if (is_null($this->getNomeDaTabela())) {

            throw new ExcecaoNaClasseAdo("Voc&ecirc; deve identificar o nome da tabela para usar esta classe. Utilize o setNomeDaTabela.");
        }

        $query = "select * from {$this->nomeDaTabela} where {$where} {$orderBy} ";

        $executou = parent::executaPs($query, $arrayDeValoresParaPs);
        if ($executou) {
            if (parent::qtdeLinhas() === 0) {
                return 0;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Aquele que implementar esta classe deve implementar os métodos para inserir,
     * alterar e excluir no banco de dados.
     */
    //abstract function consultaObjeto($where = '1', $orderBy = NULL);

    function insereObjeto() {
        return $this->executaInsersaoParametrizada();
    }

    abstract function buscaObjeto();

    abstract function alteraObjeto();

    abstract function excluiObjeto();

    /**
     * Implementa a consulta a tabelas como o método consultaObjetoPs() usando a 
     * parametrização dos valores para maior segurança, por isso exige um array 
     * com os valores para substituição no Prepare. Necessita do nome da tabela 
     * no atributo de classe $nomeDaTabela (use o método setNomeDaTabela).
     * 
     * Pode lançar a exceção ExcecaoNaClasseAdo porque chama o método 
     * consultaComPs() que lança essa exceção quando o nome da tabela não 
     * está identificado no atributo da classe.
     * 
     * Retorna o a tupla recuperada em forma de objeto do tipo Model.
     * 
     * @param type $arrayDeValoresParaPs Array com os valores a serem 
     *             substituídos pelo Prepare (PS). Têm que estar na ordem 
     *             identificada pelo ? na clásula where.
     * @param type $where String com a expressão lógica para ser montada após a
     *             cláusula where do select com ? no lugar dos valores. Não 
     *             obrigatória.
     * @param type $orderBy Instrução order by completa. Não obrigatória.
     * @return int|boolean|Objeto Retorna true para execução ok, false para 
     *         erro/exceção, 0 para consulta vazia ou objeto do tipo model da 
     *         tupla encontrada.
     */
    public function buscaObjetoComPs($arrayDeValoresParaPs, $where, $orderBy = NULL) {
        try {
            $consultou = $this->consultaObjetoComPs($arrayDeValoresParaPs, $where, $orderBy);
        } catch (ExcecaoNaClasseAdo $e) {
            throw $e;
        }

        if ($consultou) {
            return $this->leObjeto();
        } else {
            return $consultou;
        }
    }

    /**
     * Implementa a consulta a tabelas como o método consultaObjetoPs() usando a 
     * parametrização dos valores para maior segurança.
     * 
     * Pode lançar a exceção ExcecaoNaClasseAdo porque chama o método 
     * consultaComPs() que lança essa exceção quando o nome da tabela não 
     * está identificado no atributo da classe.
     * 
     * Retorna um array com os cada tupla recuperada em forma de objeto do tipo
     * Model.
     * 
     * @param type $arrayDeValoresParaPs Array com os valores a serem 
     *             substituídos pelo Prepare (PS). Têm que estar na ordem 
     *             identificada pelo ? na clásula where.
     * @param type $where String com a expressão lógica para ser montada após a
     *             cláusula where do select com ? no lugar dos valores. Não 
     *             obrigatória.
     * @param type $orderBy Instrução order by completa. Não obrigatória.
     * @return int|boolean|Objeto Retorna true para execução ok, false para 
     *         erro/exceção, 0 para consulta vazia ou array com cada tupola 
     *         recuperada em forma de objetos do tipo Model.
     * @throws ExcecaoNaClasseAdo Lança essa exceção quando a cláusula where foi
     *         definida e o array de valores está nulo.
     */
    function buscaArrayObjetoComPs($arrayDeValoresParaPs = null, $where = '1', $orderBy = NULL) {
        //Quando se monta o where deve-se montar obrigatoriamente o array de valores também.
        if (is_null($arrayDeValoresParaPs)) {
            //qando o $arrayDeValoresParaPs vier nulo, apenas troca p/ um array 
            //vazio para parametrizar a consultaComPs() corretamente que exige um array.
            $arrayDeValoresParaPs = array();
            if ($where == '1') {
                //se o array veio nulo e o where tá == 1, ok.
            } else {
                //tá errado se o array não veio nulo e o where não tá == 1.
                throw new ExcecaoNaClasseAdo("Para sele&ccedil;&otilde;es de linhas com cl&aacute;usula where informe o array com os valores para substitui&ccedil;&atilde;o.");
            }
        }
        $arrayObjeto = array(); //variável array a ser alimentada;

        $resultado = $this->consultaObjetoComPs($arrayDeValoresParaPs, $where, $orderBy);
        if ($resultado) {
            //continua
        } else if ($resultado === 0) {
            $this->setMensagem("Nada foi encontrado com a chave de consulta.");
            return 0;
        } else {
            return FALSE;
        }

        while (($objeto = $this->leObjeto()) !== FALSE) {
            /*
             * É necessário clonar o objeto, pois o objeto é uma referência a este mesmo.
             * Ao se clonar, cria-se uma cópia. Sem clonar o array conteria em cada uma
             * das suas posições a mesma referência, o que geraria múltiplas ocorrência
             * de um único objeto. No entanto o que se pretende com este método é que 
             * se tenha em cada ocorrência um objeto que represente cada uma das tuplas
             * selecinadas na tabela representada.
             */

            $arrayObjeto [] = clone ($this);
        }
        return $arrayObjeto;
    }

    /**
     * Método para montar Insert para a execução com Prepared Statement
     * onde os valores serão referenciados por ?
     * @param String $tabela
     * @param array $colunasValores
     * @return String $query
     */
    function montaInsertDoObjetoPS($tabela, array $colunasValores) {
        $primeiraColuna = true;
        $colunas = " (";
        $valores = " values (";
        $param = "?";

        foreach ($colunasValores as $nomeDaColuna => $valorDaColuna) {
            if ($primeiraColuna) {
                $primeiraColuna = false;
            } else {
                $colunas .= ", ";
                $valores .= ", ";
            }

            $colunas .= "`{$nomeDaColuna}`";
            $valores .= "({$param})";
        }
        $colunas .= ") ";
        $valores .= ") ";

        $query = "insert into {$tabela} " . $colunas . $valores;

        return $query;
    }

    /**
     * Este método montará uma query com os dados do Objeto model para inserção.
     * @param ModelAbstract02 $objetoModel
     * @return String Uma <br>query<br> para inserção
     */
    protected function montaQueryInsersao(ModelAbstract02 $objetoModel) {
        $arrayColunasValores = $this->montaArrayDeDadosDaTabela($objetoModel);
        return $this->montaInsertDoObjetoPS($this->getNomeDaTabela(), $arrayColunasValores);
    }

    /**
     * Monta um array com a query parametrizada de insersão e com os dados a 
     * serem substituídos. O array retornado pode ser executado diretamente no 
     * método BandoDeDados::executaArrayDePsComTransacaoParaMultiobjetos (Array $arrayPsEParametros).
     * 
     * @return Array Array com a query na primeira posição e outro array com as colunas e valores na segunda posição.
     */
    public function montaInsersaoParametrizada() {
        $arrayColunasValores = $this->getArrayDeDadosDaClasse();
        $scQueryDados = new stdClass();
        $scQueryDados->query = $this->montaInsertDoObjetoPS($this->getNomeDaTabela(), $arrayColunasValores);
        $scQueryDados->arrayColunasValores = $this->getArrayDeDadosDaClasse();
        return $scQueryDados;
    }

    public function executaInsersaoParametrizada() {
        $scQueryDados = $this->montaInsersaoParametrizada();

        return $this->executaPs($scQueryDados->query, $scQueryDados->arrayColunasValores);
    }

    /**
     * Monta a string da query Update com o nome da tabela, as colunas e os 
     * parametros em ? para serem substituidos dentro do executePS
     * 
     * @param type $tabela Nome da Tabela
     * @param array $arrayDeColunasEValores 
     *                     Array no formato ("nome_da_coluna" => "valor_da_coluna").
     *                     Se alguma coluna for nula use NULL sem aspas
     *                     para o seu valor.
     * @param type $where  Critério para fazer a atualização.
     * @return string      Query de update.
     */
    function montaUpdateDoObjetoPS($tabela, array $arrayDeColunasEValores, $where) {
        $colunasEValores = NULL;
        $contadorIteracoes = 0;
        $numeroDeColunas = count($arrayDeColunasEValores);
        $param = '?';

        foreach ($arrayDeColunasEValores as $nomeDaColuna => $valorDaColuna) {
            $colunasEValores .= "`{$nomeDaColuna}` = ";

            $colunasEValores .= " ({$param})";

            $contadorIteracoes++;

            if ($contadorIteracoes < $numeroDeColunas) {
                $colunasEValores .= ", ";
            }
        }

        $query = "update {$tabela} set " . $colunasEValores . " where $where";

        return $query;
    }

    function montaDeleteUsandoAndDoObjetoPS(array $arrayDeColunasEValores) {
        $where = NULL;
        $contadorIteracoes = 0;
        $numeroDeColunas = count($arrayDeColunasEValores);
        $param = '?';

        foreach ($arrayDeColunasEValores as $nomeDaColuna => $valorDaColuna) {
            $where .= "`{$nomeDaColuna}` = ";
            $where .= " {$param}";

            $contadorIteracoes++;

            if ($contadorIteracoes < $numeroDeColunas) {
                $where .= " AND ";
            }
        }

        $query = "DELETE FROM {$this->getNomeDaTabela()} WHERE $where";

        return $query;
    }

    function getNomeDaTabela() {
        return $this->nomeDaTabela;
    }

    function setNomeDaTabela($nomeDaTabela) {
        $this->nomeDaTabela = $nomeDaTabela;
    }

    /**
     * @deprecated since version 1.2.0
     * @param type $query
     * @param type $arrayDeParametros
     * @return boolean|int
     */
    protected function executaETrataQueryComPs($query, $arrayDeParametros = null) {
        try {
            $consultou = parent::executaPs($query, $arrayDeParametros);
        } catch (PDOException $e) {
            parent::setMensagem("Erro: " . $e->getMessage());
            return false;
        }

        if ($consultou) {
            if (parent::qtdeLinhas($consultou) == 0) {
                return 0;
            }
        } else {
            $this->setMensagem("Erro na consulta: " . parent::getBdError());
            return FALSE;
        }

        return true;
    }

}
