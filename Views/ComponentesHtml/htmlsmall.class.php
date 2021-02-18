<?php

require_once 'htmlatributosglobais.class.php';

class HtmlSmall extends HtmlAtributosGlobais{

    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $small = "<small{$atributosGlobais}>";

        $small .= parent::geraHtmlElementos();
        
        $small .= "</small>";
        
        return $small;
    }



}