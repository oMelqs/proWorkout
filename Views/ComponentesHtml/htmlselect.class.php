<?php

require_once 'htmlatributosglobais.class.php';

class HtmlSelect extends HtmlAtributosGlobais {

    private $autofocus;
    private $multiple;
    private $size;
    private $disabled;
    private $form;
    private $name;
    private $required;

    function __construct($autofocus = null, $multiple = false, $size = null, $disabled = null, $form = null, $name = null, $required = null) {

        parent::__construct();

        $this->setAutofocus($autofocus);
        $this->setMultiple($multiple);
        $this->setSize($size);
        $this->setForm($form);
        $this->setName($name);
        $this->setRequired($required);
        $this->setDisabled($disabled);
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();

        return "<select {$atributosGlobais}"  . $this->autofocus . $this->multiple . $this->size . $this->disabled . $this->form
                . $this->name . $this->required . ">" . parent::geraHtmlElementos() . "</select>";
    }

    function setAutofocus($autofocus) {
        $this->autofocus = " autofocus='" . $autofocus . "'";
    }

    function setMultiple($multiple = false) {
        if ($multiple) {
            $this->multiple = " multiple='multiple'";
        } else {
            $this->multiple = null;
        }
    }

    function setSize($size) {
        $this->size = " size" . $size . "'";
    }

    function setDisabled($disabled) {
        if ($disabled) {
            $this->disabled = " disabled='disabled'";
        } else {
            $this->disabled = null;
        }
    }

    function setForm($form) {
        if (is_null($form)) {
            $this->form = null;
        } else {
            $this->form = " form='" . $form . "'";
        }
    }

    function setName($name) {
        $this->name = " name='" . $name . "'";
    }

    function setRequired($required) {
        $this->required = " required='" . $required . "'";
    }

}
