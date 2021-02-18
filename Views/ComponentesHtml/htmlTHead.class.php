<?php

class HtmlTHead extends HtmlAtributosGlobais {

    private $tr;

    public function __construct() {
        $this->tr = array();
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();
        $thead = "<thead {$atributosGlobais}>";

        foreach ($this->tr as $tr) {
            $thead .= $tr->geraHtml();
        }

        $thead .= "</thead>";

        return $thead;
    }
    
    function addTr(HtmlTr $tr) {
        $this->tr [] = $tr;
    }



}
