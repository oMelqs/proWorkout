<?php

require_once '../ADOs/clienteado.class.php';

class ClienteModel extends ClienteAdo {

    protected $clieUsuaCpf;
    protected $clieFone1;
    protected $clieFone2;
    protected $clieEndereco;
    protected $clieComplementoEndereco;
    protected $clieCidade;
    protected $clieUf;
    protected $clieMatriId;

    function __construct($clieUsuaCpf = null, $clieFone1 = null, $clieFone2 = null, $clieEndereco = null, $clieComplementoEndereco = null, $clieCidade = null, $clieUf = null, $clieMatriId=null) {
        $this->clieUsuaCpf = $clieUsuaCpf;
        $this->clieFone1 = $clieFone1;
        $this->clieFone2 = $clieFone2;
        $this->clieEndereco = $clieEndereco;
        $this->clieComplementoEndereco = $clieComplementoEndereco;
        $this->clieCidade = $clieCidade;
        $this->clieUf = $clieUf;
        $this->clieMatriId = $clieMatriId;
        
        parent::__construct();
    }

    public function checaAtributos() {
        if (is_null($this->clieUsuaCpf) || trim($this->clieUsuaCpf) == "") {
            $this->addMensagem("O CPF deve ser informado");
            return false;
        }

        if (strlen($this->clieUsuaCpf) != 11) {
            $this->addMensagem("O CPF deve conter 11 dígitos");
            return false;
        }
        
        if (is_null($this->clieFone1) || trim($this->clieFone1) == "") {
            $this->addMensagem("O Primeiro telefone deve ser informado");
            return false;
        }
        if (strlen($this->clieFone1) > 15) {
            $this->addMensagem("O primeiro telefone deve conter no máximo 15 caracteres");
            return false;
        }

        if (strlen($this->clieFone2) > 15) {
            $this->addMensagem("O primeiro telefone deve conter no máximo 15 caracteres");
            return false;
        }
        if (is_null($this->clieEndereco) || trim($this->clieEndereco) == "") {
            $this->addMensagem("O Endereço deve ser informado");
            return false;
        }
        if (strlen($this->clieEndereco) > 100) {
            $this->addMensagem("O Endereço deve ter no máximo 100 caracteres");
            return false;
        }if (strlen($this->clieComplementoEndereco) > 45) {
            $this->addMensagem("O complemento do endereço deve ter no máximo 45 caracteres");
            return false;
        }
        if (is_null($this->clieCidade) || trim($this->clieCidade) == "") {
            $this->addMensagem("A cidade dever ser informada");
            return false;
        }
        if (strlen($this->clieCidade) > 45) {
            $this->addMensagem("A cidade deve ter no máximo 45 caracteres");
            return false;
        } if (is_null($this->clieUf) || trim($this->clieUf) == "") {
            $this->addMensagem("A UF deve ser informada");
            return false;
        }

        if (strlen($this->clieUf) > 2) {
            $this->addMensagem("A UF deve ter no máximo 2 dígitos");
            return false;
        }

        return true;
    }

    function getClieUsuaCpf() {
        return $this->clieUsuaCpf;
    }

    function getClieFone1() {
        return $this->clieFone1;
    }

    function getClieFone2() {
        return $this->clieFone2;
    }

    function getClieEndereco() {
        return $this->clieEndereco;
    }

    function getClieComplementoEndereco() {
        return $this->clieComplementoEndereco;
    }

    function getClieCidade() {
        return $this->clieCidade;
    }

    function getClieUf() {
        return $this->clieUf;
    }
    function getClieMatriId() {
        return $this->clieMatriId;
    }

    function setClieUsuaCpf($clieUsuaCpf) {
        $this->clieUsuaCpf = $clieUsuaCpf;
    }

    function setClieFone1($clieFone1) {
        $this->clieFone1 = $clieFone1;
    }

    function setClieFone2($clieFone2) {
        $this->clieFone2 = $clieFone2;
    }

    function setClieEndereco($clieEndereco) {
        $this->clieEndereco = $clieEndereco;
    }

    function setClieComplementoEndereco($clieComplementoEndereco) {
        $this->clieComplementoEndereco = $clieComplementoEndereco;
    }

    function setClieCidade($clieCidade) {
        $this->clieCidade = $clieCidade;
    }

    function setClieUf($clieUf) {
        $this->clieUf = $clieUf;
    }

    function setClieMatriId($clieMatriId) {
        $this->clieMatriId = $clieMatriId;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
