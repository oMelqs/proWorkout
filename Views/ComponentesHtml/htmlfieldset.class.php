<?php

require_once 'htmlatributosglobais.class.php';

class HtmlFieldset extends HtmlAtributosGlobais {

    private $legend = null;

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();
        $elementos = parent::geraHtmlElementos();

        $fieldset = "<fieldset{$atributosGlobais}>";

        if (is_null($this->legend)) {
            //continua...
        } else {
            $fieldset .= $this->legend->geraHtml();
        }

        $fieldset .= $elementos;

        $fieldset .= "</fieldset>";

        return $fieldset;
    }

    function setLegend($legend) {
        $this->legend = $legend;
    }

}
