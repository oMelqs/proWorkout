<?php

require_once '../ADOs/planoado.class.php';

class PlanoModel extends PlanoAdo{

    protected $planoId;
    protected $planoNome;
    protected $planoDesc;
    protected $planoValor;

    function __construct($planoId = null, $planoNome = null, $planoDesc = null, $planoValor = null) {
        $this->planoId = $planoId;
        $this->planoNome = $planoNome;
        $this->planoDesc = $planoDesc;
        $this->planoValor = $planoValor;
        parent:: __construct();
    }

    public function checaAtributos() {

        if (is_null($this->planoNome) || trim($this->planoNome) == '') {
            $this->addMensagem("O nome do seu tipo de plano deve ser informado!");
            return false;
        }

        if (is_null($this->planoDesc) || trim($this->planoDesc) == '') {
            $this->addMensagem("O seu tipo de plano deve ter uma descrição!");
            return false;
        }

        if (is_null($this->planoValor) || trim($this->planoValor) == '') {
            $this->addMensagem("O seu tipo de plano deve ter um valor!");
            
            return false;
        }
        
        return true;
    }

    function getPlanoId() {
        return $this->planoId;
    }

    function getPlanoNome() {
        return $this->planoNome;
    }

    function getPlanoDesc() {
        return $this->planoDesc;
    }

    function getPlanoValor() {
        return $this->planoValor;
    }

    function setPlanoId($planoId) {
        $this->planoId = $planoId;
    }

    function setPlanoNome($planoNome) {
        $this->planoNome = $planoNome;
    }

    function setPlanoDesc($planoDesc) {
        $this->planoDesc = $planoDesc;
    }

    function setPlanoValor($planoValor) {
        $this->planoValor = $planoValor;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
