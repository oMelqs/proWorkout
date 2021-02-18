<?php

require_once 'htmlatributosglobais.class.php';

class HtmlLi extends HtmlAtributosGlobais{
    private $style ;
    private $texto;
    
    function __construct($align=null) {
        parent::__construct();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $li = "<li{$atributosGlobais} {$this->style}>";
        
        $li .= parent::geraHtmlElementos();

        
        $li .= $this->texto;
        
        $li .= "</li>";
        
        return $li;
    }
    function setStyle($style){
        $this->style="style ='".$style."'";
    }

    function getStyle(){
        return $this->style;
    }
    function setTexto($texto) {
        $this->texto = $texto;
    }



}
