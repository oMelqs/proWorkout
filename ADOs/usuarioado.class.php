<?php

require_once '../Models/Abstract/modelabstract.class.php';

abstract class UsuarioAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Usuarios");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "usuaCpf = ?";
        return $this->buscaObjetoComPs(array($this->usuaCpf), $where);
    }

    public function alteraObjeto() {

        $arrayDeColunasEValores = array(
            "usuaCpf" => $this->getUsuaCpf(),
            "usuaNome" => $this->getUsuaNome(),
            "usuaEmail" => $this->getUsuaEmail(),
            "usuaSenha" => $this->getUsuaSenha()
        );

        $where = "usuaCpf = ?";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["usuaCpf"] = $this->getUsuaCpf();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {

        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('usuaCpf' => $this->getUsuaCpf()));
        return $this->executaPs($query, array($this->getUsuaCpf()));
    }

    public function buscaUsuarioPorCpfESenha() {

        $where = " usuaCpf = ? and usuaSenha = ?";

        return $this->buscaObjetoComPs(array($this->usuaCpf, $this->usuaSenha), $where);
    }

    public function buscaUsuarioPorEmailESenha() {

        $where = " usuaEmail = ? and usuaSenha = ?";

        return $this->buscaObjetoComPs(array($this->usuaEmail, $this->usuaSenha), $where);
    }

    public function buscaUsuarioAdmin(){

        $where = " usuaCpf = ? and usuaTipo = ?";

        return $this->buscaObjetoComPs(array($this->usuaCpf, $this->usuaTipo), $where);

    }

}
