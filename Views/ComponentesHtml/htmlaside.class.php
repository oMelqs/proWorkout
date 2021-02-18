<?php

require_once 'htmlatributosglobais.class.php';

class HtmlAside extends HtmlAtributosGlobais{
        
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $div = "<aside{$atributosGlobais}>";
        
        $div .= parent::geraHtmlElementos();
        
        $div .= "</aside>";
        
        return $div;
    }

}
