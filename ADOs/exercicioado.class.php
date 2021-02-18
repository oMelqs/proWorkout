<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class ExercicioAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Exercicios");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "exerId = ?";
        return $this->buscaObjetoComPs(array($this->exerId), $where);
    }

    public function alteraObjeto() {

        $arrayDeColunasEValores = array(
            "exerId" => $this->getExerId(),
            "exerNome" => $this->getExerNome(),
            "exerDescricao" => $this->getExerDescricao()
        );

        $where = "exerId = ?";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["exerId"] = $this->getExerId();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {

        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('exerId' => $this->getExerId()));
        return $this->executaPs($query, array($this->getExerId()));
    }

}
