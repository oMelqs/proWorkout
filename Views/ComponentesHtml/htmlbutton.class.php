<?php

class htmlButton  extends HtmlAtributosGlobais{
    
    private $autofocus;
    private $formaction;
    private $formenctype;
    private $disabled;
    private $form;
    private $name;
    private $formmethod;
    private $formnovalidate;
    private $formtarget;
    private $type;
    private $value;
    private $conteudo;
    
    function __construct($autofocus=null, $formaction=null, $formenctype=null, $disabled=null
            , $form=null, $name=null, $formmethod=null, $formnovalidate=null, $formtarget=null
            , $type=null, $value=null, $conteudo=null) {
        $this->autofocus = $autofocus;
        $this->formaction = $formaction;
        $this->formenctype = $formenctype;
        $this->disabled = $disabled;
        $this->form = $form;
        $this->name = $name;
        $this->formmethod = $formmethod;
        $this->formnovalidate = $formnovalidate;
        $this->formtarget = $formtarget;
        $this->type = $type;
        $this->value = $value;
        $this->conteudo = $conteudo;
    }

    public function geraHtml(){
        $atributosGlobais = parent::geraHtml();
        return "<button {$atributosGlobais}" . $this->autofocus . $this->disabled . $this->form . $this->formaction
                . $this->formenctype . $this->formmethod . $this->formnovalidate . $this->formtarget
                . $this->name . $this->value . $this->type . ">" . $this->conteudo . "</button>";
        
    }
    
    function setAutofocus($autofocus) {
        $this->autofocus = "autofocus='" . $autofocus . "'";
    }

    function setFormaction($formaction) {
        $this->formaction = " formaction='" . $formaction . "'";
    }

    function setFormenctype($formenctype) {
        $this->formenctype = " formenctype='" . $formenctype . "'";
    }

    function setDisabled($disabled) {
        $this->disabled = " disabled='" . $disabled . "'";
    }

    function setForm($form) {
        $this->form = " form='" . $form . "'";
    }

    function setName($name) {
        $this->name = " name='" . $name . "'";
    }

    function setFormmethod($formmethod) {
        $this->formmethod = " formmethod='" . $formmethod . "'";
    }

    function setFormnovalidate($formnovalidate) {
        $this->formnovalidate = " formnovalidate='" . $formnovalidate . "'";
    }

    function setFormtarget($formtarget) {
        $this->formtarget = " formtarget='" . $formtarget . "'";
    }

    function setType($type) {
        $this->type = " type='" . $type . "'";
    }

    function setValue($value) {
        $this->value = " value='" . $value . "'";
    }
    
    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }



}
