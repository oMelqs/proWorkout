<?php

require_once '../ADOs/usuarioado.class.php';

class UsuarioModel extends UsuarioAdo{

    protected $usuaCpf;
    protected $usuaNome;
    protected $usuaEmail;
    protected $usuaSenha;
    protected $usuaTipo;

    function __construct($usuaCpf = null, $usuaNome = null, $usuaEmail = null, $usuaSenha = null, $usuaTipo = null) {

        $this->usuaCpf = $usuaCpf;
        $this->usuaEmail = $usuaEmail;
        $this->usuaNome = $usuaNome;
        $this->usuaSenha = $usuaSenha;
        $this->usuaTipo = $usuaTipo;
        parent:: __construct();
    }

    public function checaAtributos() {
        if (is_null($this->usuaCpf) || trim($this->usuaCpf) == "") {
            $this->addMensagem("O CPF deve ser informado");
            return false;
        }
        if (strlen($this->usuaCpf) != 11) {
            $this->addMensagem("O CPF deve conter ao menos 11 dígitos");
            return false;
        }
        if (is_null($this->usuaNome) || trim($this->usuaNome) == "") {
            $this->addMensagem("O nome deve ser informado");
            return false;
        }
        if (strlen($this->usuaNome) > 45) {
            $this->addMensagem("O nome deve conter até 45 dígitos");
            return false;
        }
        if (is_null($this->usuaEmail) || trim($this->usuaEmail) == "") {
            $this->addMensagem("O email deve ser informado");
            return false;
        }
        if (strlen($this->usuaEmail) > 55) {
            $this->addMensagem("O email deve conter até 55 dígitos");
            return false;
        }
        if (is_null($this->usuaSenha) || trim($this->usuaSenha) == "") {
            $this->addMensagem("A senha deve ser informada");
            return false;
        }
        if (strlen($this->usuaSenha) > 45) {
            $this->addMensagem("A senha deve conter até 45 dígitos");
            return false;
        }
        return true;
    }

    function getUsuaCpf() {
        return $this->usuaCpf;
    }

    function getUsuaNome() {
        return $this->usuaNome;
    }

    function getUsuaEmail() {
        return $this->usuaEmail;
    }

    function getUsuaSenha() {
        return $this->usuaSenha;
    }

    function getUsuaTipo() {
        return $this->usuaTipo;
    }

    function setUsuaCpf($usuaCpf) {
        $this->usuaCpf = $usuaCpf;
    }

    function setUsuaNome($usuaNome) {
        $this->usuaNome = $usuaNome;
    }

    function setUsuaEmail($usuaEmail) {
        $this->usuaEmail = $usuaEmail;
    }

    function setUsuaSenha($usuaSenha) {
        $this->usuaSenha = $usuaSenha;
    }

    function setUsuaTipo($usuaTipo) {
        $this->usuaTipo = $usuaTipo;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
