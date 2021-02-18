<?php

require_once 'htmlatributosglobais.class.php';

class HtmlInput extends HtmlAtributosGlobais {

    private $accept;
    private $alt;
    private $checked;
    private $disabled;
    private $form;
    private $height;
    private $list;
    private $max;
    private $maxLenght;
    private $min;
    private $multiple;
    private $name;
    private $placeholder;
    private $required;
    private $size;
    private $src;
    private $type;
    private $value;
    private $width;
    private $onkeypress;
    private $id;

    function __construct() {
        $accept;
        $alt = null;
        $checked = null;
        $disabled = null;
        $form = null;
        $height = null;
        $list = null;
        $max = null;
        $maxLenght = null;
        $min = null;
        $multiple = null;
        $name = null;
        $placeholder = null;
        $required = null;
        $size = null;
        $src = null;
        $type = null;
        $value = null;
        $width = null;
        $onkeypress = null;
        $id = null;
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();

        return "<input{$atributosGlobais} " . $this->accept . $this->alt . $this->checked . $this->disabled . $this->form . $this->height
                . $this->list . $this->max . $this->maxLenght . $this->min . $this->multiple . $this->name
                . $this->placeholder . $this->required . $this->size . $this->src . $this->type . $this->value
                . $this->width . $this->onkeypress . $this->id . ">";
    }

    function setAccept($accept) {
        $this->accept = " accept='" . $accept . "'";
    }

    function setAlt($alt) {
        $this->alt = " alt='" . $alt . "'";
    }

    function setChecked($checked = true) {
        if ($checked) {
            $this->checked = " checked='" . $checked . "'";
        } else {
            $this->checked = null;
        }
    }

    function setDisabled($disabled = true) {
        if ($disabled) {
            $this->disabled = " disabled='" . $disabled . "'";
        } else {
            $this->disabled = null;
        }
    }

    function setForm($form) {
        $this->form = " form='" . $form . "'";
    }

    function setHeight($height) {
        $this->height = " height='" . $height . "'";
    }

    function setList($list) {
        $this->list = " list='" . $list . "'";
    }

    function setMax($max) {
        $this->max = " max='" . $max . "'";
    }

    function setMaxLenght($maxLenght) {
        $this->maxLenght = " maxlength='" . $maxLenght . "'";
    }

    function setMin($min) {
        $this->min = " min='" . $min . "'";
    }

    function setMultiple($multiple) {
        $this->multiple = " multiple='" . $multiple . "'";
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

    function setSize($size) {
        $this->size = " size='" . $size . "'";
    }

    function setSrc($src) {
        $this->src = " src='" . $src . "'";
    }

    function setType($type) {
        $this->type = " type='" . $type . "'";
    }

    function setValue($value) {
        $this->value = " value='" . $value . "'";
    }

    function setWidth($width) {
        $this->width = " width='" . $width . "'";
    }

    function setOnkeypress($onkeypress) {
        $this->onkeypress = " onkeypress = '" . $onkeypress . "'";
    }

    function setId($id) {
        $this->id = "id = '{$id}'";
    }

}
