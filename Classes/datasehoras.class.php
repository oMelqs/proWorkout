<?php

/**
 * Este é um Código da Fábrica de Software
 *
 * Coordenador: Elymar Pereira Cabral
 *
 * Data: 08/03/2013
 *
 * Descrição de Datas:
 * Esta classe tem por objetivo atender genericamente todas as necessidades relacionadas
 * a datas como, por exemplo, fazer a checagem das validade de uma data, formatar 
 * datas separadas por '/' ou '-', em formato ano, mês e dia ou dia, mês e ano,
 * ano com doi ou quatro dígitos, etc.
 * 
 * Nem todas as funcionalidades estarão implementadas desde o início, a intenção
 * é complementá-las a medida que se necessitar.
 * 
 * Deve-se pensar no uso dos métodos sem necessidade de instancear a classe.
 *
 * @autor Elymar Pereira Cabral
 * 
 * Modificado em: 21/08/2015
 * 
 * Por: 
 * @autor Cayo Eduardo
 * 
 * Descrição da alteração:
 * Implementou funcionalidades para se trabalhar com datas e horas.
 */
Class DatasEHoras {

    private static $data  = NULL;
    private static $horas = NULL;

    /*
     * Método __construct()
     * O construtor inicia o atributo $data e $horas.
     */

    public function __construct($data = NULL, $horas = NULL) {
        $this->setData($data);
        $this->setHoras($horas);
    }

    /**
     * Método setData
     * Atribui um valor (via parâmetro) ao atribuo $data
     * @param $data = a data a ser guardada. A data deve estar no formato aaaammdd.
     */
    static public function setData($data) {
        self::$data = $data;
    }

    /*
     * Método getData()
     * Retorna o valor da data.
     */

    static public function getData() {
        return self::$data;
    }

    /**
     * Método setHoras
     * Atribui um valor (via parâmetro) ao atribuo $horas
     * @param $horas = a hora a ser guardada. A hora deve estar no formato hh:mm:ss.
     */
    static public function setHoras($horas) {
        self::$horas = $horas;
    }

    /*
     * Método getHoras()
     * Retorna o valor da hora.
     */

    static public function getHoras() {
        return self::$horas;
    }

    /**
     * Método limpaSeparadores()
     * Retira espaços em branco, barras ('/') e traços ('-').
     * @param $data = data que deseja-se limpar.
     */
    static public function limpaSeparadores($data) {
        /*
         * EPC - 17/06/2013
         * Comentei a linha abaixo pq ela não estava retirando o '-';
          return trim($data, "/- ");
         */
        return $data = trim(str_replace('/', '',
                                        trim(str_replace('-', '', $data))));
    }

    /**
     * Verifica se o valor da data é válido.
     * Retorna FALSO para datas inválidas, nulas ou com tamanho menor do que 8
     * caracteres.
     * 
     * @param $data = valor de data a ser checado no formato "aaaammdd" ou "aaaa-mm-dd". 
     *                Pode ser informado ou não. Caso não seja informado usa-se 
     *                o valor do atributo $data da classe.
     * @return boolean True se data Ok ou false se data com erro.
     */
    public static function checaData($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = self::limpaSeparadores($data);

        $dia = substr($data, 6, 2);
        $mes = substr($data, 4, 2);
        $ano = substr($data, 0, 4);
        if (is_numeric($dia) && is_numeric($mes) && is_numeric($ano)) {
            //continua...
        } else {
            return false;
        }
        return checkdate($mes, $dia, $ano);
    }

    /**
     * Verifica se o valor da data é válido. 
     * Retorna FALSO para datas inválidas, nulas ou com tamanho menor do que 8
     * caracteres.
     * Permite definir o formato da data a ser checada.
     * 
     * @param type $data = valor de data a ser checado. A data deve estar no 
     *             formato definido pelo parâmetro $formato. Não obrigatório.
     *             Caso não seja informado usa-se o valor do atributo $data da 
     *             classe.
     * @param type $formato Por default assume 'Y-m-d'. Segue o padrão definido 
     *             pela função DateTime.
     * @return boolean True se data Ok ou false se data com erro.
     */
    public static function checaDataComFormato($data = NULL, $formato = 'Y-m-d') {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }

        $d = DateTime::createFromFormat($formato, $data);

        return $d && $d->format($formato) == $data;
    }

    /**
     * Checa se a data e hora estã ocorretos.
     * 
     * @param type $dataEHora Data e hora no formato "aaaa-mm-dd hh:mm:ss" ou no
     * formato "aaaammdd hh:mm:ss".
     * @return type True se data e horário estão corretos e falso, caso contrário.
     */
    static public function checaDataEHora($dataEHora) {
        $tamanho = 8;
        if (substr($dataEHora, 4, 1) == '-') {
            $tamanho = 10;
        }

        $data = substr($dataEHora, 0, $tamanho);

        $horario = substr($dataEHora, -8);

        return self::checaData($data) && self::checaHora($horario);
    }

    /**
     * Checa se o valor de um horário está correto.
     * @param type $horario Horário a ser conferido no formato "hh:mm:ss".
     * @return boolean True se horário ok ou False se algo errado no valor.
     */
    static public function checaHora($horario = NULL) {
        if (is_null($horario)) {
            $horario = self::$horario;
        }
        if (is_null($horario)) {
            return FALSE;
        }
        if (strlen($horario) < 8) {
            return FALSE;
        }

        $horas    = substr($horario, 0, 2);
        $minutos  = substr($horario, 3, 2);
        $segundos = substr($horario, 6, 2);

        $h = settype($horas, "integer");
        $m = settype($minutos, "integer");
        $s = settype($segundos, "integer");
        if ($h && $m && $s) {
            //valores válidos. Continua.
        } else {
            //valores inválidos.
            return FALSE;
        }


        if ($horas < 0 || $horas > 23) {
            return FALSE;
        }

        if ($minutos < 0 || $minutos > 59) {
            return FALSE;
        }

        if ($segundos < 0 || $segundos > 59) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Método getDataInvertida()
     * Retorna uma data invertida (aaaammdd) com ano, mês e dia sem separadores.
     * 
     * A data a ser invertida pode estar com o separador '/' entre dia, mês e ano.
     *
     * @param $data = valor de data a ser invertido. Pode vir no formato "ddmmaaaa"
     *                ou "dd/mm/aaa". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     * @return boolean Retorna FALSO se não receber a data e nem o atributo da classe estiver iniciado.
     * 
     * Retorna FALSO se data estiver com menos do que 8 caracteres.
     * 
     */
    static public function getDataInvertida($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        }
        if (strlen($data) < 8) {
            return FALSE;
        }
        $data = trim(str_replace('/', '', $data));

        return substr($data, 4, 4) . substr($data, 2, 2) . substr($data, 0, 2);
    }

    /**
     * Inverte uma data e retira as barras retornando num formato 'aaaammdd'. 
     * Se as horas estiverem no final da string, retorna inalterada.
     * @param type $data Data a ser invertida. Não obrigatória. Se não for 
     * informada pega a data atribuída à classe (via atributo)
     * @return boolean Data invertida sem as barras
     */
    static public function getDataEHorasInvertida($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = trim(str_replace('/', '', $data));

        return substr($data, 4, 4) . substr($data, 2, 2) . substr($data, 0, 2) . substr($data,
                                                                                        8);
    }

    /**
     * Método getDataInvertidaComTracos()
     * Retorna uma data invertida (aaaa-mm-dd) com ano, mês e dia separados com traço
     * pronto para gravar no BD.
     * 
     * @param $data = valor de data a ser invertido. Pode vir ou no formato "ddmmaaaa"
     *                ou "dd/mm/aaaa". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     * 
     * @return boolean/data Retorna FALSO se não receber a data e nem o atributo da classe estiver iniciado.
     *              Retorna FALSO se data estiver com menos do que 8 caracteres.
     */
    static public function getDataInvertidaComTracos($data = NULL) {
        $data = self::getDataInvertida($data);

        return substr($data, 0, 4) . '-' . substr($data, 4, 2) . '-' . substr($data,
                                                                              6,
                                                                              2);
    }

    /**
     * Retorna uma data invertida (aaaa-mm-dd) com ano, mês e dia separados com traço
     * pronto para gravar no BD ou null se o valor estiver vazio.
     * 
     * @param $data = valor de data a ser invertido. Pode vir ou no formato "ddmmaaaa"
     *                ou "dd/mm/aaaa". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     * 
     * @return boolean/data Retorna Null se não receber a data e nem o atributo da classe estiver iniciado.
     *              Retorna FALSO se data estiver com menos do que 8 caracteres. 
     *              Retorna uma data no formato do BD se tudo certo com a data.
     */
    static public function getDataInvertidaComTracosOuNull($data = NULL) {
        if (is_null($data)) {
            return null;
        }
        $data = self::getDataInvertida($data);
        if ($data === false) {
            return false;
        }

        return substr($data, 0, 4) . '-' . substr($data, 4, 2) . '-' . substr($data,
                                                                              6,
                                                                              2);
    }

    static public function getDataEHorasInvertidaComTracos($data = NULL) {
        $data = self::getDataEHorasInvertida($data);

        $dataComTracos = substr($data, 0, 4) . '-' . substr($data, 4, 2) . '-' . substr($data,
                                                                                        6,
                                                                                        2);

        $horarioComDoisPontos = null;
        if (strpos($data, ':') === false) { //verifica se o horario esta com : ou nao
            $horario              = substr($data, -6);
            //se nao tem : tem que inclui-los no lugar certo
            $horarioComDoisPontos = substr($horario, 0, 2) . ':' . substr($horario,
                                                                          2, 2) . ':' . substr($horario,
                                                                                               4,
                                                                                               2);
        } else {
            // se veio para ca eh que o horario ja ta com :
            $horarioComDoisPontos = substr($data, -8);
        }

        return $dataComTracos . ' ' . $horarioComDoisPontos;
    }

    /**
     * Recebe um horário sem os ':' e acrescenta os separadores no formato 
     * adequado para o banco de dados. Exemplo (234500 => 23:45:00).
     * 
     * @param type $horario String com o horário sem os ':'
     * @return String Horário no formato de banco de dados (hh:mm:ss);
     */
    static public function getHorasNoFormatoDoBd($horario = NULL) {
        return substr($horario, 0, 2) . ':' . substr($horario, 2, 2) . ':' . substr($horario,
                                                                                    4,
                                                                                    2);
    }

    /**
     * Pega apenas a data de data e horário.
     * 
     * @param type $dataEHorario Data e horas.
     * @return type Data no formato em que estiver, ou seja com traços ou 
     * barras. Não pode vir sem barras e nem traços.
     */
    static public function getDataDeDataEHora($dataEHorario) {
        return substr($dataEHorario, 0, 10);
    }

    /**
     * Pega apenas as horas de data e horário no formato do BD.
     * 
     * @param type $dataEHorario Data e horas no formado de BD
     * @return type Horas no formato hh:mm:ss
     */
    static public function getHorasDeDataEHora($dataEHorario) {
        return substr($dataEHorario, 11);
    }

    /**
     * Método getDataComBarras()
     * Retorna uma data com as barras ("dd/mm/aaaa") .
     *
     * Retorna FALSO se não receber a data e nem o atributo da classe estiver iniciado.
     * 
     * Retorna FALSO se data estiver com menos do que 8 caracteres.
     * 
     * @param $data = valor de data a ser invertido. Deve vir no formato "ddmmaaaa"
     *                ou "dd-mm-aaaa". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     */
    static public function getDataComBarras($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = trim(str_replace('-', '', $data));

        return substr($data, 0, 2) . '/' . substr($data, 2, 2) . '/' . substr($data,
                                                                              4,
                                                                              4);
    }

    static public function getDataEHorasComBarras($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = trim(str_replace('-', '', $data));

        return substr($data, 0, 2) . '/' . substr($data, 2, 2) . '/' . substr($data,
                                                                              4,
                                                                              4) . substr($data,
                                                                                          9);
    }

    /**
     * Método getDataDesinvertida()
     * Retorna uma data não invertida (ddmmaaaa) com dia, mês e ano sem separadores.
     * 
     * A data a ser desinvertida pode estar com o separador '-' entre dia, mês e ano.
     *
     * Retorna FALSO se não receber a data e nem o atributo da classe estiver iniciado.
     * 
     * Retorna FALSO se data estiver com menos do que 8 caracteres.
     * 
     * @param $data = data a ser desinvertida. Pode vir no formato "aaaammdd" ou 
     *                "aaaa-mm-dd". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     */
    static public function getDataDesinvertida($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = trim(str_replace('-', '', $data));

        return substr($data, 6, 2) . substr($data, 4, 2) . substr($data, 0, 4);
    }

    static public function getDataEHorasDesinvertida($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        $data = trim(str_replace('-', '', $data));

        //EPC - 09/06/2017 - ACRESCENTETI ESPAÇO EM BRANCO ENTRE DATA E HORA ABAIXO.
        return substr($data, 6, 2) . substr($data, 4, 2) . substr($data, 0, 4) . ' ' . substr($data,
                                                                                              8);
    }

    /**
     * Retorna uma data não invertida (dd/mm/aaaa) com dia, mês e ano os separadores ("/").
     * 
     * @param type $data Data a ser desinvertida. Pode vir no formato "aaaammdd" ou 
     *                "aaaa-mm-dd". Pode ser informado ou não. Caso não seja informado 
     *                usa-se o valor do atributo $data da classe.
     * @return boolean Retorna NULL se não receber a data e nem o atributo da classe estiver iniciado.
     *                 Retorna FALSO se data estiver com menos do que 8 caracteres.
     *                 Retorna uma data no formato dd/mm/aaaa na ausência de erros no parâmetro informado.
     */
    static public function getDataDesinvertidaComBarras($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return null;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }
        return substr(self::getDataEHorasComBarras(self::getDataEHorasDesinvertida($data)),
                                                                                   0,
                                                                                   10);
    }

    static public function getDataEHorasDesinvertidaComBarras($data = NULL) {
        if (is_null($data)) {
            $data = self::$data;
        }
        if (is_null($data)) {
            return FALSE;
        } else {
            if (strlen($data) < 8) {
                return FALSE;
            }
        }

        return self::getDataEHorasComBarras(self::getDataEHorasDesinvertida($data));
    }

    /**
     * Retorna a data do sistema no formato aaaammdd.
     * 
     * @return data data do sistema no formato aaammdd
     */
    static public function getDataDoSistemaInvertida() {
        //return date('Ymd');

        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("Ymd");
    }

    /**
     * Busta a data e a hora do sistema.
     * 
     * @return type Data e hora do sistema no formato 'aaammdd - hh:mm:ss'
     */
    static public function getDataEHorasDoSistemaInvertida() {
        //return date('Ymd - H:i:s');

        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("Ymd - H:i:s");
    }

    /**
     * Retorna a data do sistema no formato ddmmaaa.
     * 
     * @return data data do sistema no formato ddmmaaaa
     */
    static public function getDataDoSistemaDesinvertida() {
        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("dmY");
    }

    /**
     * Busca a e a hora do sistema no formato 'ddmmaaaa - hh:mm:ss'.
     * @return date Data no formato 'ddmmaaaa - hh:mm:ss'
     */
    static public function getDataEHorasDoSistemaDesinvertida() {
        //return date('dmY - H:i:s');

        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("dmY - H:i:s");
    }

    /**
     * Retorna a data do sistema no formato aaaa-mm-dd.
     * 
     * @return data data do sistema no formato aaaa-mm-dd
     */
    static public function getDataDoSistemaInvertidaComTraco() {
        return self::getDataInvertidaComTracos(self::getDataDoSistemaDesinvertida());
    }

    /**
     * Retorna a data do sistema no formato aaaa-mm-dd - hh:mm:ss.
     * @todo Este código ainda não foi testado 
     * @return Date Data e hora do sistema no formato "aaaa-mm-dd - hh:mm:ss"
     */
    static public function getDataEHorasDoSistemaInvertidaComTraco() {
        return self::getDataEHorasInvertidaComTracos(self::getDataEHorasDoSistemaDesinvertida());
    }

    /**
     * Retorna a data do sistema no formato dd/mm/aaaa.
     * 
     * @return data data do sistema no formato dd/mm/aaaa
     */
    static public function getDataDoSistemaDesinvertidaComBarras() {
        //return self::getDataDesinvertidaComBarras(date('Ymd'));

        return self::getDataDesinvertidaComBarras(self::getDataDoSistemaInvertida());
    }

    /**
     * Retorna a data e horário do sistema no formato "dd/mm/aaaa - hh:mm:ss"
     * @todo Este código ainda não foi testado 
     * @return DateHour Data e horário do sistema no formato "dd/mm/aaa - hh:mm:ss"
     */
    static public function getDataEHorasDoSistemaDesinvertidaComBarras() {
        //return self::getDataEHorasDesinvertidaComBarras(date('Ymd H:i:s'));
        return self::getDataEHorasDesinvertidaComBarras(self::getDataEHorasDoSistemaInvertida());
    }

    /**
     * Retorna o ano do sistema no formato aaaa.
     * 
     * @return data ano do sistema no formato aaaa
     */
    static public function getAnoDoSistema() {
        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("Y");
    }

    /**
     * Retorna o ano do sitema.
     * 
     * @return type Mês do sistema.
     */
    static public function getMesDoSistema() {
        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("m");
    }

    /**
     * Retorna o mês por extenso a partir do número do mês.
     * @param type $mes Número do mês
     * @return string Mês por extenso
     */
    static public function getMesPorExtenso($mes) {
        $meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
        return $meses[$mes];
    }

    /**
     * Busca o dia do sistema.
     * 
     * @return int Dia do sistema.
     */
    static public function getDiaDoSistema() {
        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("d");
    }

    /**
     * Retorna o ano e o horário do sistema no formato "daaaa - hh:mm:ss"
     * 
     * @todo Este código ainda não foi testado 
     * @return type Ano e o horário do sistema no formato "daaaa - hh:mm:ss"
     */
    static public function getAnoEHorasDoSistema() {
        //return date('Y - H:i:s');

        $dataAtual = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        return $dataAtual->format("Y - H:i:s");
    }

    /**
     * Identifica e retorna a quantidade de dias do mês informado via parâmetro.
     * Se for informado o ano, verifica se é bissexto e ajusta a quantidade de 
     * dias do mês de fevereiro.
     * 
     * @param int $mes Mês desejado a se obter a quantidade de dias.
     * @param int $ano Não obrigatório. Se informado verifica se é bissexto e 
     * ajusta a quantidade de dias de fevereiro.
     * @return int Quantidade de dias do mês informado.
     */
    static public function getQuantidadeDeDiasDoMes($mes, $ano = null) {
        $bissexto = false;
        // se o ano foi informado verificar se o ano é bixesto
        if (is_null($ano)) {
            //ano nulo, continua
        } else {
            //ano informado, checa se é bissexto
            $resto = $ano % 4;
            if ($resto === 0) {
                $resto = $ano % 100;
                if ($resto === 0) {
                    $bissexto = false;
                } else {
                    $bissexto = true;
                }
            } else {
                $resto = $ano % 400;
                if ($resto === 0) {
                    $bissexto = true;
                } else {
                    $bissexto = false;
                }
            }
        }

        $meses = array(1 => 30, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
        if ($bissexto) {
            $meses [2] = 29;
        }

        return $meses[$mes];
    }

    /**
     * Identifica o dia da semana de uma data informada, se esta for informada, ou retorna o dia da semana corrente.
     * 
     * @param type $data Data no formato "aaaa-mm-dd"
     * @return type Dia da semana de 0 a 6 ou falso se a data informa for inválida.
     */
    static public function getDiaDaSemana($data = null) {
        $dataAtual = null;
        if (is_null($data)) {
            $dataAtual = new DateTime("now",
                                      new DateTimeZone("America/Sao_Paulo"));
        } else {
            if (self::checaData($data)) {
                $dataAtual = new DateTime($data,
                                          new DateTimeZone("America/Sao_Paulo"));
            } else {
                return false;
            }
        }
        return $dataAtual->format("w");
    }

    /**
     * Adiciona uma quantidade de dias de uma data.
     * 
     * @param integer $dias Quantidade de dias a se subtrair da data. O valor deve ser inteiro.
     * @param type $data Data a ser subtraída no formato aaaa-mm-dd. Se não for informada assume-se a data atual do sistema.
     * @return boolean False se ocorrer erro ou uma data subtraida do número de dias no formato aaa-mm-dd.
     */
    static public function adicionaDiasDaData($dias, $data = null) {
        $dt = null;
        if (is_null($data)) {
            $dt = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        } else {
            if (self::checaData($data)) {
                $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
            } else {
                return false;
            }
        }

        $dt->add(new DateInterval("P{$dias}D"));
        return $dt->format("Y-m-d");
    }

    /**
     * Subtrai uma quantidade de dias de uma data.
     * 
     * @param integer $dias Quantidade de dias a se subtrair da data. O valor deve ser inteiro.
     * @param type $data Data a ser subtraída no formato aaaa-mm-dd. Se não for informada assume-se a data atual do sistema.
     * @return boolean False se ocorrer erro ou uma data subtraida do número de dias no formato aaa-mm-dd.
     */
    static public function subtraiDiasDaData($dias, $data = null) {
        $dt = null;
        if (is_null($data)) {
            $dt = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        } else {
            if (self::checaData($data)) {
                $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
            } else {
                return false;
            }
        }

        $dt->sub(new DateInterval("P{$dias}D"));
        return $dt->format("Y-m-d");
    }

}

?>