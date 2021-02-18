<?php

require_once 'htmlatributosglobais.class.php';

class HtmlCenter extends HtmlAtributosGlobais{
        
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $center = "<center{$atributosGlobais}>";
        
        $center .= parent::geraHtmlElementos();
        
        $center .= "</center>";
        
        return $center;
    }

}