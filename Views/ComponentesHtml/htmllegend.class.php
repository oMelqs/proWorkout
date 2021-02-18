<?php

require_once 'htmlatributosglobais.class.php';

class HtmlLegend extends HtmlAtributosGlobais {

    private $texto;

    function __construct($texto) {
        $this->texto = $texto;
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<legend{$atributosGlobais}>{$this->texto}</legend>";
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

}
