<?php

require_once 'htmlatributosglobais.class.php';

class HtmlNav extends HtmlAtributosGlobais{
    private $role;
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $nav = "<nav{$atributosGlobais}";
         $nav .= $this->role.">";
        $nav .= parent::geraHtmlElementos();
        
        $nav .= "</nav>";
        
        return $nav;
    }

    public function setRole($role){
        $this->role=" role ='".$role."'";
    }

}