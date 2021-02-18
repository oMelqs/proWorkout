<?php

require_once '../ADOs/fichaado.class.php';

class FichaModel extends FichaAdo{

    protected $clieUsuaCpf;
    protected $exerId;

    function __construct($clieUsuaCpf = null, $exerId = null) {

        $this->clieUsuaCpf = $clieUsuaCpf;
        $this->exerId = $exerId;
        parent:: __construct();
    }

    public function checaAtributos() {
        if (is_null($this->clieUsuaCpf) || trim($this->clieUsuaCpf) == '') {
            $this->addMensagem("O CPF    deve ser informado");
            return false;
        } else {
            if (is_null($this->exerId) || trim($this->exerId) == '') {
            $this->addMensagem("A ID do exercício deve ser informada");
            return false;
        }
    } 
        return true;
    }

    function getClieUsuaCpf() {
        return $this->clieUsuaCpf;
    }


    function getExerId() {
        return $this->exerId;
    }

    function setClieUsuaCpf($clieUsuaCpf) {
        $this->clieUsuaCpf = $clieUsuaCpf;
    }

    function setExerId($exerId) {
        $this->exerId = $exerId;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
