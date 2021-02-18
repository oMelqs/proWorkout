<?php

require_once 'htmlatributosglobais.class.php';

class HtmlI extends HtmlAtributosGlobais{
    
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $i = "<i{$atributosGlobais}>";
       
        $i .= parent::geraHtmlElementos();
        
        $i .= "</i>";
        
        return $i;
    }


}