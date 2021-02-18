<?php

require_once 'htmlatributosglobais.class.php';

class HtmlTitle extends HtmlAtributosGlobais {

    private $texto;

    function __construct($texto) {
        $this->texto = $texto;
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<title{$atributosGlobais}>" . $this->texto . "</title>";
    }

}
