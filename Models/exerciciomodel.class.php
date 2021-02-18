<?php

require_once '../ADOs/exercicioado.class.php';

class ExercicioModel extends ExercicioAdo{

    protected $exerId;
    protected $exerNome;
    protected $exerDescricao;

    function __construct($exerId = null, $exerNome = null, $exerDescricao = null) {

        $this->exerId = $exerId;
        $this->exerNome = $exerNome;
        $this->exerDescricao = $exerDescricao;
        parent:: __construct();
    }

    public function checaAtributos() {
        if (is_null($this->exerNome) || trim($this->exerNome) == '') {
            $this->addMensagem("O nome do exercício deve ser informado");
            return false;
        } else {
            if (strlen($this->exerNome) > 45) {
                $this->addMesagem("O nome do exercicío deve conter menos de 45 caracteres");
                return false;
            }
        }
        if (is_null($this->exerDescricao) || trim($this->exerDescricao) == '') {
            $this->addMensagem("A descrição do exercício deve ser informada");
            return false;
        } else {
            if (strlen($this->exerDescricao) > 400) {
                $this->addMensagem("A descrição deve conter menos de 400 caracteres");
                return false;
            }
        }
        return true;
    }

    function getExerId() {
        return $this->exerId;
    }

    function getExerNome() {
        return $this->exerNome;
    }

    function getExerDescricao() {
        return $this->exerDescricao;
    }

    function setExerId($exerId) {
        $this->exerId = $exerId;
    }

    function setExerNome($exerNome) {
        $this->exerNome = $exerNome;
    }

    function setExerDescricao($exerDescricao) {
        $this->exerDescricao = $exerDescricao;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
