<?php

require_once 'htmlatributosglobais.class.php';

class HtmlTextArea extends HtmlAtributosGlobais {

    private $autofocus;
    private $cols;
    private $dirname;
    private $disabled;
    private $form;
    private $rows;
    private $wrap;
    private $maxLenght;
    private $name;
    private $placeholder;
    private $required;
    private $conteudo;


    function __construct($autofocus = null, $cols = null, $dirname = null, $disabled = null, $form = null, $rows = null
            , $wrap = null, $maxLenght = null, $name = null, $placeholder = null
            , $required = null, $conteudo = null) {
        $this->setAutofocus($autofocus);
        $this->setDirname($dirname);
        $this->setDisabled($disabled);
        $this->setForm($form);
        $this->setMaxLenght($maxLenght);
        $this->setName($name);
        $this->setPlaceholder($placeholder);
        $this->setRequired($required);
        $this->setRows($rows);
        $this->setWrap($wrap);
        $this->setCols($cols);
        $this->conteudo = $conteudo;
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();

        return "<textarea {$atributosGlobais}" . $this->autofocus . $this->cols . $this->dirname . $this->disabled . $this->form . $this->rows
                . $this->wrap . $this->maxLenght . $this->name
                . $this->placeholder . $this->required . ">" . $this->conteudo . "</textarea>";
    }

    function setAutofocus($autofocus) {
        $this->autofocus = " autofocus='" . $autofocus . "'";
    }

    function setCols($cols) {
        $this->cols = " cols='" . $cols . "'";
    }

    function setDirname($dirname) {
        $this->dirname = " dirname='" . $dirname . "'";
    }

    function setDisabled($disabled) {
        if (is_null($disabled)) {
            $this->disabled = "false";
        } else {
            $this->disabled = " disabled='" . $disabled . "'";
        }
    }

    function setForm($form) {
        $this->form = " form='" . $form . "'";
    }

    function setRows($rows) {
        $this->rows = " rows='" . $rows . "'";
    }

    function setWrap($wrap) {
        $this->wrap = " wrap='" . $wrap . "'";
    }

    function setMaxLenght($maxLenght) {
        $this->maxLenght = " maxlenght='" . $maxLenght . "'";
    }

    function setName($name) {
        $this->name = " name='" . $name . "'";
    }

    function setPlaceholder($placeholder) {
        $this->placeholder = " placeholder='" . $placeholder . "'";
    }

    function setRequired($required) {
        $this->required = " required='" . $required . "'";
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

}
