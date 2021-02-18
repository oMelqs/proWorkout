<?php

require_once 'htmlatributosglobais.class.php';

class HtmlStrong extends HtmlAtributosGlobais{
       private $role;
       private $textoStrong;
       private $texto;
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $Strong = "<strong{$atributosGlobais}> ";
        
        $Strong .= parent::geraHtmlElementos();
        $Strong.= " ". $this->textoStrong;
        
        $Strong .= " </strong> ";
        
        $Strong.= $this->texto;
        return $Strong;
    }
    
    function setRole($role) {
        $this->role = "role= '".$role."'";
    }
    
    function setTextoStrong($textoStrong) {
        $this->textoStrong = $textoStrong;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }


    



}