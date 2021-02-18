<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class MatriculaAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Matriculas");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "matriId = ?";
        return $this->buscaObjetoComPs(array($this->matriId), $where);
    }

    public function alteraObjeto() {

        $arrayDeColunasEValores = array(
            "matriId" => $this->getMatriId(),
            "matriDataInicial" => $this->getMatriDataIncial(),
            "matriDataUltimoPgto" => $this->getMatriDataUltimoPgto(),
            "matriTppld" => $this->getMatrTppld()
        );

        $where = "matriId = ?";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["matriId"] = $this->getMatriId();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {

        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('matriId' => $this->getMatriId()));
        return $this->executaPs($query, array($this->getMatriId()));
    }

}
