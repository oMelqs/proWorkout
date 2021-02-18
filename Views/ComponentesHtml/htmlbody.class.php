<?php

require_once 'htmlatributosglobais.class.php';

class HtmlBody extends HtmlAtributosGlobais {

    function __construct() {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<body{$atributosGlobais}>" . parent::geraHtmlElementos() . "</body>";
    }

}
