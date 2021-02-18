<?php

require_once 'htmlatributosglobais.class.php';

class HtmlLabel extends HtmlAtributosGlobais{
    
    private $form;
    private $for;
    private $texto;
    
    function __construct($form=null, $for=null, $texto=null) {
        $this->setFor($for);
        $this->setForm($form);
        $this->setTexto($texto);
    }
    
    public function geraHtml(){
        
        $atributosGlobais = parent::geraHtml();
        
        return "<label" . $atributosGlobais . $this->for . $this->form . ">" . $this->texto
                . "</label>";
        
    }

    function setForm($form) {
        $this->form = " form='" . $form . "'";
    }

    function setFor($for) {
        $this->for = " for='" . $for . "'";
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }


    
}
