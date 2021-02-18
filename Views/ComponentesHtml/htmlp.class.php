<?php

require_once 'htmlatributosglobais.class.php';

class HtmlP extends HtmlAtributosGlobais {

    private $align = null;
    private $texto = null;

    function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        $p =  "<p{$atributosGlobais}{$this->align}>{$this->texto}";
        $p.= parent::geraHtmlElementos();
        $p.="</p>";
        return $p;
    }

    function setAlign($align) {
        $this->align = " align='" . $align . "'";
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

}
