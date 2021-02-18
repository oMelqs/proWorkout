<?php

require_once 'htmlatributosglobais.class.php';

class HtmlNoScript extends HtmlAtributosGlobais {

    private $conteudo;

    function __construct($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<noscript" . $atributosGlobais . ">" . $this->conteudo . "</noscript>";
    }

   
}

