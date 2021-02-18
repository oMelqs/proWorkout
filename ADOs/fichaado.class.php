<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class FichaAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Fichas");

        parent::__construct();
    }

    public function buscaObjeto() {
        $where = "clieUsuaCpf = ? and exerId = ?";
        return $this->buscaObjetoComPs(array($this->clieUsuaCpf, $this->exerId), $where);
    }

    public function buscaFichaCliente(){
        $where = "clieUsuaCpf = ?";
        return $this->buscaArrayObjetoComPs(array($this->clieUsuaCpf), $where);
    }

    public function alteraObjeto() {

    }



    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('clieUsuaCpf' => $this->getClieUsuaCpf(), 'exerId' => $this->getExerId()));
        return $this->executaPs($query, array($this->getClieUsuaCpf(), $this->getExerId()));
    }

}
