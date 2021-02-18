<?php

require_once 'htmlatributosglobais.class.php';


class HtmlForm extends HtmlAtributosGlobais{
    
    private $acceptCharset;
    private $action;
    private $autocomplete;
    private $enctype;
    private $method;
    private $name;
    private $novalidade;
    private $target;
    
    
    function __construct($acceptCharset=null, $action=null, $autocomplete=null, $enctype=null, 
            $method=null, $name=null, $novalidade=null, $target=null) {
        
        parent::__construct();
        
        $this->setAcceptCharset($acceptCharset);
        $this->setAction($action);
        $this->setAutoComplete($autocomplete);
        $this->setEnctype($enctype);
        $this->setMethod($method);
        $this->setName($name);
        $this->setNovalidade($novalidade);
        $this->setTarget($target);
        
        
    }

    
    function geraHtml(){
        
        $atributosGlobais = parent::geraHtml();
        
        $form = "<form" . $atributosGlobais . $this->acceptCharset . $this->action . $this->autocomplete . $this->enctype 
                . $this->method . $this->name . $this->novalidade . $this->target . ">";
        
        $form .= parent::geraHtmlElementos();
        $form .= "</form>";
        
        return $form;
        
    }
    
    
    function setAcceptCharset($acceptCharset) {
        $this->acceptCharset = " accept-charset='" . $acceptCharset . "'";
    }

    function setAction($action) {
        $this->action = " action='" . $action . "'";
    }

    function setAutocomplete($autocomplete) {
        $this->autocomplete = " autocomplete='" . $autocomplete . "'";
    }

    function setEnctype($enctype) {
        $this->enctype = " enctype='" . $enctype . "'";
    }

    function setMethod($method) {
        $this->method = " method='" . $method . "'";
    }

    function setName($name) {
        $this->name = " name='" . $name . "'";
    }

    function setNovalidade($novalidade) {
        $this->novalidade = " novalidade='" . $novalidade . "'";
    }

    function setTarget($target) {
        $this->target = " target='" . $target . "'";
    }

    function addArrayForm($tag) {
        $this->arrayForm [] = $tag;
    }


}

