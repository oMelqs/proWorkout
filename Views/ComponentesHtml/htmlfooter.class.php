<?php

require_once 'htmlatributosglobais.class.php';

class HtmlFooter extends HtmlAtributosGlobais{
        private $role;
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $footer = "<footer{$atributosGlobais}{$this->role}>";
        
        $footer .= parent::geraHtmlElementos();
        
        
        
        $footer .= "</footer>";
        
        return $footer;
    } 
    public function setRole($role){
        $this->role="role ='".$role."'";
    }

}
