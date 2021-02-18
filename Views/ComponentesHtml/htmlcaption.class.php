<?php

require_once 'htmlatributosglobais.class.php';

class HtmlCaption extends HtmlAtributosGlobais {

    private $texto;

    function __construct($texto) {
        $this->texto = $texto;
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<caption{$atributosGlobais}>{$this->texto}</caption>";
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

}
