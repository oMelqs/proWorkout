<?php

class HtmlTBody extends HtmlAtributosGlobais {

    private $tr;

    public function __construct() {
        $this->tr = array();
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();
        $tbody = "<tbody {$atributosGlobais}>";

        foreach ($this->tr as $tr) {
            $tbody .= $tr->geraHtml();
        }

        $tbody .= "</tbody>";

        return $tbody;
    }
    
    function AddTr(HtmlTr $tr) {
        $this->tr [] = $tr;
    }



}

