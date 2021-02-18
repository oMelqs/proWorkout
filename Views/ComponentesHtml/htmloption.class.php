<?php

class htmlOption extends HtmlAtributosGlobais {

    private $disabled;
    private $label;
    private $selected;
    private $value;
    private $conteudo;

    function __construct($disabled = false, $label = null, $selected = false, $value = null, $conteudo = null) {

        parent::__construct();

        $this->setDisabled($disabled);
        $this->setLabel($label);
        $this->setSelected($selected);
        $this->setValue($value);
        $this->conteudo = $conteudo;
    }

    public function geraHtml() {

        return "<option " . $this->label . $this->disabled . $this->selected . $this->value . ">"
                . $this->conteudo . "</option>";
    }

    function setDisabled($disabled = true) {
        if ($disabled) {
            $this->disabled = " disable='disabled'";
        } else {
            $this->disabled = null;
        }
    }

    function setLabel($label) {
        $this->label = " label='" . $label . "'";
    }

    function setSelected($selected = true) {
        if ($selected) {
            $this->selected = " selected='selected'";
        } else {
            $this->selected = null;
        }
    }

    function setValue($value) {
        $this->value = " value='" . $value . "'";
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

}
