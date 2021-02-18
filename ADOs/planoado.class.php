<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class PlanoAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Planos");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "planoId = ?";
        return $this->buscaObjetoComPs(array($this->planoId), $where);
    }

    public function alteraObjeto() {

        $arrayDeColunasEValores = array(
            "planoId" => $this->getPlanoId(),
            "planoNome" => $this->getPlanoNome(),
            "planoDesc" => $this->getPlanoDesc(),
            "planoValor" => $this->getPlanoValor()
        );

        $where = "planoId = ?";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(),
                 $arrayDeColunasEValores, $where);

        $arrayDeValores["planoId"] = $this->getPlanoId();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {

        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('planoId' => $this->getPlanoId()));
        return $this->executaPs($query, array($this->getPlanoId()));
    }

}
