<?php

require_once 'htmlatributosglobais.class.php';

class HtmlUl extends HtmlAtributosGlobais{
        
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $div = "<ul{$atributosGlobais}>";
        
        $div .= parent::geraHtmlElementos();
        
        $div .= "</ul>";
        
        return $div;
    }

}
