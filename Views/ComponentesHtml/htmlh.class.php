<?php

require_once 'htmlatributosglobais.class.php';

class HtmlH extends HtmlAtributosGlobais {

    private $tipo = null;
    private $texto = null;
    private $img = null;

    function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<h{$this->tipo}{$atributosGlobais}>"
        . "{$this->texto}"
        ."</h{$this->tipo}>";
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setImg(htmlImg $img) {
        $this->img = $img;
    }

}
