<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class ClienteAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Clientes");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "clieUsuaCpf = ?";
        return $this->buscaObjetoComPs(array($this->clieUsuaCpf), $where);
    }

    public function alteraObjeto() {

        $arrayDeColunasEValores = array(
            "clieUsuaCpf" => $this->getClieUsuaCpf(),
            "clieFone1" => $this->getClieFone1(),
            "clieFone2" => $this->getClieFone2(),
            "clieEndereco" => $this->getClieEndereco(),
            "clieComplementoEndereco" => $this->getClieComplementoEndereco(),
            "clieCidade" => $this->getClieCidade(),
            "clieUf" => $this->getClieUf(),
        );

        $where = "clieUsuaCpf = ?";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["clieUsuaCpf"] = $this->getUsuaCpf();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {

        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('clieUsuaCpf' => $this->getUsuaCpf()));
        return $this->executaPs($query, array($this->getUsuaCpf()));
    }

}
