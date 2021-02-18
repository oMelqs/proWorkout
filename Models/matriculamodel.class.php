<?php

require_once '../ADOs/matriculaado.class.php';

class MatriculaModel extends MatriculaAdo{

    protected $matriId;
    protected $matriDataInicial;
    protected $matriDataUltimoPgto;
    protected $matriPlanoId;

    function __construct($matriId = null, $matriDataInicial = null, $matriDataUltimoPgto = null, $matriPlanoId = null) {
        $this->matriId = $matriId;
        $this->matriDataInicial = $matriDataInicial;
        $this->matriDataUltimoPgto = $matriDataUltimoPgto;
        $this->matriPlanoId = $matriPlanoId;

        parent:: __construct();
    }

    public function checaAtributos() {

        if (is_null($this->matriId) || trim($this->matriId) == '') {
            $this->addMensagem("O ID da matrícula deve ser informado");
            return false;
        }

        if (is_null($this->matriDataInicial) || trim($this->matriDataInicial) == "") {
            $this->addMensagem("A data inicial da reserva deve ser informada");
            return false;
        } else {
            if (strlen($this->matriDataInicial) > 45) {
                $this->addMensagem("A data inicial deve ter menos de 45 dígitos");
                return false;
            }
        }
        if (is_null($this->matriDataUltimoPgto) || trim($this->matriDataUltimoPgto) == "") {
            $this->addMensagem("A data inicial da reserva deve ser informada");
            return false;
        } else {
            if (strlen($this->matriDataUltimoPgto) > 45) {
                $this->addMensagem("A data inicial deve ter menos de 45 dígitos");
                return false;
            }
        }
        if (is_null($this->matriPlanoId) || trim($this->matriPlanoId) == '') {
            $this->addMensagem("O ID da matrícula deve ser informado");
            return false;
        }
    }

    function getMatriId() {
        return $this->matriId;
    }

    function getMatriDataInicial() {
        return $this->matriDataInicial;
    }

    function getMatriDataUltimoPgto() {
        return $this->matriDataUltimoPgto;
    }

    function getMatriPlanoId() {
        return $this->matriPlanoId;
    }

    function setMatriId($matriId) {
        $this->matriId = $matriId;
    }

    function setMatriDataInicial($matriDataInicial) {
        $this->matriDataInicial = $matriDataInicial;
    }

    function setMatriDataUltimoPgto($matriDataUltimoPgto) {
        $this->matriDataUltimoPgto = $matriDataUltimoPgto;
    }

    function setMatriPlanoId($matriPlanoId) {
        $this->matriPlanoId = $matriPlanoId;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
