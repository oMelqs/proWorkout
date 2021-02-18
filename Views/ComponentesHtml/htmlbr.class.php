<?php

require_once 'htmlatributosglobais.class.php';

class HtmlBr extends HtmlAtributosGlobais{
    
    function geraHtml() {
        
        $atributosGlobais = parent::geraHtml();
        
        return "<br". $atributosGlobais . ">";
        
    }
    
}
