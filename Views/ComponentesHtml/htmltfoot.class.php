<?php


class HtmlTFoot {
    
    private $tr;

    public function __construct() {
        $this->tr = array();
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();
        $tfoot = "<tfoot {$atributosGlobais}>";

        foreach ($this->tr as $tr) {
            $tfoot .= $tr->geraHtml();
        }

        $tfoot .= "</tfoot>";

        return $tfoot;
    }
    
    function AddTr(HtmlTr $tr) {
        $this->tr [] = $tr;
    }
}
